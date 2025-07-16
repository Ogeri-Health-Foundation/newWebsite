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
            $profileFullPath = $profilesDir . $profileFileName;
            
            // Check file type
            $profileFileType = strtolower(pathinfo($profileFullPath, PATHINFO_EXTENSION));
            $allowedProfileTypes = ["jpg", "jpeg", "png", "gif"];
            
            if (!in_array($profileFileType, $allowedProfileTypes)) {
                echo json_encode(['status' => 'error', 'message' => "Invalid file type for profile picture. Allowed types: JPG, PNG, GIF"]);
                return;
            }
            
            // Upload the file
            if (!move_uploaded_file($files['profile_picture']['tmp_name'], $profileFullPath)) {
                echo json_encode(['status' => 'error', 'message' => "Failed to upload profile picture."]);
                return;
            }
            
            // Store only the filename for database
            $profilePath = $profileFileName;
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
            $resumeFullPath = $resumesDir . $resumeFileName;
            
            // Check file type
            $resumeFileType = strtolower(pathinfo($resumeFullPath, PATHINFO_EXTENSION));
            $allowedResumeTypes = ["pdf", "doc", "docx"];
            
            if (!in_array($resumeFileType, $allowedResumeTypes)) {
                echo json_encode(['status' => 'error', 'message' => "Invalid file type for resume. Allowed types: PDF, DOC, DOCX"]);
                return;
            }
            
            // Upload the file
            if (!move_uploaded_file($files['resume']['tmp_name'], $resumeFullPath)) {
                echo json_encode(['status' => 'error', 'message' => "Failed to upload resume."]);
                return;
            }
            
            // Store only the filename for database
            $resumePath = $resumeFileName;
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

// Let's add some debug information to see if the directories are created correctly
function debugDirectoryCreation() {
    $baseDir = __DIR__ . '/../../volunteer_uploads/';
    $profilesDir = $baseDir . 'profiles/';
    $resumesDir = $baseDir . 'resumes/';
    
    error_log("Controller location: " . __DIR__);
    error_log("Base directory should be: " . $baseDir);
    error_log("Base directory exists: " . (is_dir($baseDir) ? 'Yes' : 'No'));
    
    // Try to create the directories and log the results
    if (!is_dir($baseDir)) {
        $result = mkdir($baseDir, 0777, true);
        error_log("Created base directory: " . ($result ? 'Success' : 'Failed'));
        if ($result) {
            chmod($baseDir, 0777);
        }
    }
    
    if (!is_dir($profilesDir)) {
        $result = mkdir($profilesDir, 0777, true);
        error_log("Created profiles directory: " . ($result ? 'Success' : 'Failed'));
        if ($result) {
            chmod($profilesDir, 0777);
        }
    }
    
    if (!is_dir($resumesDir)) {
        $result = mkdir($resumesDir, 0777, true);
        error_log("Created resumes directory: " . ($result ? 'Success' : 'Failed'));
        if ($result) {
            chmod($resumesDir, 0777);
        }
    }
}

// Run the debug function when the script is loaded
debugDirectoryCreation();

// Entry point for form handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new VolunController();
    $controller->handleFormSubmission($_POST, $_FILES);
}
?>