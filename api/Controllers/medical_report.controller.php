<?php



class MedicalReportController{

    public function functionMedical(){
        $errors = [];

        if (empty($_POST['name'])) {
            $errors[] = "Name is required,";
        }
        if (empty($_POST['email'])) {
            $errors[] = "Email is required,";
        }
        if (empty($_POST['number'])) {
            $errors[] = "Number is required,";
        }
        if (empty($_POST['message'])) {
            $errors[] = "Message is required.";
        }
        if (!empty($errors)) {
            return [
                "success" => false,
                "message" => $errors
            ];
        }
        

        $Name = $_POST['name'];
        $Email = $_POST['email'];
        $Number = $_POST['number'];
        $Message= $_POST['message'];


        $medicalModel = new MedicalModel();
     $success = $medicalModel->createReport([
            'name' => $Name,
            'email' => $Email,
            'phone' => $Number,
            'message' => $Message
        ]);

        if ($success) {

            return [
                'message'=> 'Request submitted successfully',
                'success'=> true
            ];
        } else {
            return [
            'message'=> 'Failed to submit report',
            'success'=> false
            ];
        }
    }

}