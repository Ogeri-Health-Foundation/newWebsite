<?php
class PostController {
    public function validateForm($data) {
        $errors = [];

        if (empty($data['Title'])) {
            $errors[] = "Title is required,";
        }
        if (empty($data['Description'])) {
            $errors[] = "Description is required,";
        }
        if (empty($data['Category'])) {
            $errors[] = "Category is required,";
        }
        if (empty($data['Body'])) {
            $errors[] = "Body is required.";
        }

        return $errors;
    }
}
?>
