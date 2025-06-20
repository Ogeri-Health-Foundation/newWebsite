<?php
class StaffController {
    public function validateForm($data) {
        $errors = [];

        if (empty($data['Specialization'])) {
            $errors[] = "Specialization is required,";
        }
        if (empty($data['Name'])) {
            $errors[] = "Name is required,";
        }
        if (empty($data['Category'])) {
            $errors[] = "Category is required.";
        }
        
        return $errors;
    }
}
?>
