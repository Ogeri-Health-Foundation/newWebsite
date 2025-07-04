<?php
require_once '../Database/DatabaseConn.php';

class VolunModel extends DatabaseConn {
    public function insertVolunteer($data) {
        try {
            $stmt = $this->connect()->prepare("INSERT INTO volunteers (
                    name, email, phone, gender, home_address, profession, role,
                    profile_picture, resume, bio, linkedin, twitter, facebook,
                    instagram, skills, motivation
                ) VALUES (
                    :name, :email, :phone, :gender, :home_address, :profession, :role,
                    :profile_picture, :resume, :bio, :linkedin, :twitter, :facebook,
                    :instagram, :skills, :motivation
                )");
            
            // Explicitly bind each parameter
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':gender', $data['gender']);
            $stmt->bindParam(':home_address', $data['home_address']);
            $stmt->bindParam(':profession', $data['profession']);
            $stmt->bindParam(':role', $data['role']);
            $stmt->bindParam(':profile_picture', $data['profile_picture']);
            $stmt->bindParam(':resume', $data['resume']);
            $stmt->bindParam(':bio', $data['bio']);
            $stmt->bindParam(':linkedin', $data['linkedin']);
            $stmt->bindParam(':twitter', $data['twitter']);
            $stmt->bindParam(':facebook', $data['facebook']);
            $stmt->bindParam(':instagram', $data['instagram']);
            $stmt->bindParam(':skills', $data['skills']);
            $stmt->bindParam(':motivation', $data['motivation']);
            
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Log the detailed error message
            error_log("Database insertion error: " . $e->getMessage());
            throw $e; // Re-throw to be caught by the controller
        }
    }
}

class VolunController {
    public function handleFormSubmission($data, $files) {
        // Validate required fields
        $requiredFields = ['name', 'email', 'phone'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                echo json_encode(['status' => 'error', 'message' => "Field '$field' is required."]);
                return;
            }
        }
        
        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => "Invalid email format."]);
            return;
        }
        
        // Validate mandatory social links
        if (
            empty($data['linkedin']) &&
            empty($data['twitter']) &&
            empty($data['facebook']) &&
            empty($data['instagram'])
        ) {
            echo json_encode(['status' => 'error', 'message' => "At least one social media link is required."]);
            return;
        }

        // Handle profile picture upload
        $profilePath = null;
        if (!empty($files['profile_picture']['tmp_name'])) {
            // Create base directory for volunteer uploads
            $baseDir = __DIR__ . '/../../volunteer_uploads/';
            if (!is_dir($baseDir)) {
                mkdir($baseDir, 0777, true);
            }
            
            // Create profiles directory
            $profilesDir = $baseDir . 'profiles/';
            if (!is_dir($profilesDir)) {
                mkdir($profilesDir, 0777, true);
            }
            
            $profileFileName = time() . '_' . basename($files['profile_picture']['name']);
            $profilePath = $profilesDir . $profileFileName;
            
            // Check file type
            $profileFileType = strtolower(pathinfo($profilePath, PATHINFO_EXTENSION));
            $allowedProfileTypes = ["jpg", "jpeg", "png", "gif"];
            
            if (!in_array($profileFileType, $allowedProfileTypes)) {
                echo json_encode(['status' => 'error', 'message' => "Invalid file type for profile picture. Allowed types: JPG, PNG, GIF"]);
                return;
            }
            
            // Upload the file
            if (!move_uploaded_file($files['profile_picture']['tmp_name'], $profilePath)) {
                echo json_encode(['status' => 'error', 'message' => "Failed to upload profile picture."]);
                return;
            }
            
            // Store relative path for database
            $profilePath = 'volunteer_uploads/profiles/' . $profileFileName;
        }

        // Handle resume upload
        $resumePath = null;
        if (!empty($files['resume']['tmp_name'])) {
            // Create base directory for volunteer uploads
            $baseDir = __DIR__ . '/../../volunteer_uploads/';
            if (!is_dir($baseDir)) {
                mkdir($baseDir, 0777, true);
            }
            
            // Create resumes directory
            $resumesDir = $baseDir . 'resumes/';
            if (!is_dir($resumesDir)) {
                mkdir($resumesDir, 0777, true);
            }
            
            $resumeFileName = time() . '_' . basename($files['resume']['name']);
            $resumePath = $resumesDir . $resumeFileName;
            
            // Check file type
            $resumeFileType = strtolower(pathinfo($resumePath, PATHINFO_EXTENSION));
            $allowedResumeTypes = ["pdf", "doc", "docx"];
            
            if (!in_array($resumeFileType, $allowedResumeTypes)) {
                echo json_encode(['status' => 'error', 'message' => "Invalid file type for resume. Allowed types: PDF, DOC, DOCX"]);
                return;
            }
            
            // Upload the file
            if (!move_uploaded_file($files['resume']['tmp_name'], $resumePath)) {
                echo json_encode(['status' => 'error', 'message' => "Failed to upload resume."]);
                return;
            }
            
            // Store relative path for database
            $resumePath = 'volunteer_uploads/resumes/' . $resumeFileName;
        }

        // Format skills
        $skills = [];
        if (!empty($data['skills'])) {
            $skills = explode(',', $data['skills']);
        }

        // Prepare data without sanitization as requested
        $volunteerData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => isset($data['gender']) ? $data['gender'] : null,
            'home_address' => isset($data['home_address']) ? $data['home_address'] : null,
            'profession' => isset($data['profession']) ? $data['profession'] : null,
            'role' => isset($data['role']) ? $data['role'] : null,
            'profile_picture' => $profilePath,
            'resume' => $resumePath,
            'bio' => isset($data['bio']) ? $data['bio'] : null,
            'linkedin' => isset($data['linkedin']) ? $data['linkedin'] : null,
            'twitter' => isset($data['twitter']) ? $data['twitter'] : null,
            'facebook' => isset($data['facebook']) ? $data['facebook'] : null,
            'instagram' => isset($data['instagram']) ? $data['instagram'] : null,
            'skills' => json_encode($skills),
            'motivation' => isset($data['motivation']) ? $data['motivation'] : null,
        ];

        try {
            $model = new VolunModel();
            $result = $model->insertVolunteer($volunteerData);
            
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Application submitted successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to submit application. No rows affected.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            error_log("Database error in controller: " . $e->getMessage());
        }
    }
}

// Entry point for form handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new VolunController();
    $controller->handleFormSubmission($_POST, $_FILES);
}
?>