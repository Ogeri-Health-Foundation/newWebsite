<?php
class EventController {
    public function validateForm($data) {
        $errors = [];

        if (empty($data['Title'])) {
            $errors[] = "Title is required.";
        }
        if (empty($data['volunteerLocation'])) {
            $errors[] = "Volunteer location is required.";
        }
        if (empty($data['volunteerTime'])) {
            $errors[] = "Volunteer time is required.";
        }
        if (empty($data['volunteerDate'])) {
            $errors[] = "Volunteer date is required.";
        }
        if (empty($data['volunteerDescription'])) {
            $errors[] = "Volunteer description is required.";
        }
        if (empty($data['volunteerBody'])) {
            $errors[] = "Volunteer body is required.";
        } else {
            // ✅ Validate CKEditor body size (limit: 2MB)
            $bodySize = strlen($data['volunteerBody']);
            $maxBodySize = 2 * 1024 * 1024; // 2 MB in bytes

            if ($bodySize > $maxBodySize) {
                $kbSize = round($bodySize / 1024, 2);
                $maxKB = round($maxBodySize / 1024, 2);
                $errors[] = "Volunteer body content is too large ({$kbSize} KB). Please keep it under {$maxKB} KB or remove large embedded images.";
            }
        }
        if (empty($data['volunteerStatus'])) {
            $errors[] = "Volunteer status is required.";
        }

        return $errors;
    }
}
?>
