<?php
class EventController {
    public function validateForm($data) {
        $errors = [];

        if (empty($data['Title'])) {
            $errors[] = "Title is required,";
        }
        if (empty($data['volunteerLocation'])) {
            $errors[] = "volunteerLocation is required,";
        }
        if (empty($data['volunteerTime'])) {
            $errors[] = "volunteerTime is required,";
        }
        if (empty($data['volunteerDate'])) {
            $errors[] = "volunteerDate is required.";
        }
        if (empty($data['volunteerDescription'])) {
            $errors[] = "volunteerDescription is required.";
        }
        if (empty($data['volunteerBody'])) {
            $errors[] = "volunteerBody is required.";
        }
        if (empty($data['volunteerStatus'])) {
            $errors[] = "volunteerStatus is required.";
        }

        return $errors;
    }
}
?>
