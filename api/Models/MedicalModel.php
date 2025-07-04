<?php

require_once "../Database/DatabaseConn.php";
require_once "../Traits/MailGrid.php";


class MedicalModel extends DatabaseConn 
 
{
    use sendMail;
    public function createReport($data){

        try {

            $report_Id = bin2hex(random_bytes(6));

            $stmt = $this->connect()->prepare("INSERT INTO medical_rep (report_id, name, email, phone, message) VALUES (:report_id, :name, :email, :phone, :message)");
            $stmt->bindParam(":report_id", $report_Id);
            $stmt->bindParam(":name", $data['name']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":phone", $data['phone']);
            $stmt->bindParam(":message", $data['message']);
            
            if($stmt->execute()){

                // $getEmail = $this->connect()->prepare("SELECT email FROM admins");
                // $getEmail->execute();

                // $result = $getEmail->fetch(PDO::FETCH_ASSOC);


                $email= "praiseonojs@gmail.com";
                $this->sendMedicalMail(senderEmail: $data['email'], senderName: $data['name'], senderPhone: $data['phone'], senderMessage: $data['message'], Adminemail: $email);
                return true;

                
            }else {
                echo "Error: " . $stmt->errorInfo()[2];
                return false;
            }

        } catch (Exception $e) {
            return [
                "success" => false,
                "message" => "Error: " . $e->getMessage()
            ];
        }

    }
}