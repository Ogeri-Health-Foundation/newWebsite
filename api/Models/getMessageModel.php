<?php

require_once "../Database/DatabaseConn.php";

class getMessageModel extends DatabaseConn{

    public function getMessage() {
        $stmt = $this->connect()->prepare("
        SELECT COUNT(*) AS message FROM messages WHERE is_read = 0
     ");
     $stmt->execute();
     return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}