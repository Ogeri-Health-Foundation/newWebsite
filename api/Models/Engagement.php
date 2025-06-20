<?php
require_once "../Database/DatabaseConn.php";

class Engagement extends DatabaseConn {

    // Update engagement count
    public function updateEngagement($engagement = 1) {
        $day = strtolower(date('D')); 
        $month = date('m');
        $year = date('Y');
        $week = date('W'); 

        try {
            // Check if record for current week, month, and year exists
            $stmt = $this->connect()->prepare("SELECT id, sun, mon, tue, wed, thu, fri, sat FROM weekly_engagement WHERE week = ? AND month = ? AND year = ?");
            $stmt->execute([$week, $month, $year]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Update the existing record
                $updateQuery = "UPDATE weekly_engagement SET $day = $day + ?, total = sun + mon + tue + wed + thu + fri + sat WHERE week = ? AND month = ? AND year = ?";
                $stmt = $this->connect()->prepare($updateQuery);
                $stmt->execute([$engagement, $week, $month, $year]);
            } else {
                // Insert a new record for the new week
                $insertQuery = "INSERT INTO weekly_engagement (week, month, year, $day, total) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->connect()->prepare($insertQuery);
                $stmt->execute([$week, $month, $year, $engagement, $engagement]);
            }

            return ["message" => "Engagement updated successfully"];
        } catch (PDOException $e) {
            return ["error" => "Database error: " . $e->getMessage()];
        }
    }

    // Fetch engagement details for the current week
    public function fetchEngagement() {
        $week = date('W');
        $month = date('m');
        $year = date('Y');

        try {
            $stmt = $this->connect()->prepare("SELECT week, month, year, sun, mon, tue, wed, thu, fri, sat, total FROM weekly_engagement WHERE week = ? AND month = ? AND year = ?");
            $stmt->execute([$week, $month, $year]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ?: [
                "week" => $week,
                "month" => $month,
                "year" => $year,
                "sun" => 0, "mon" => 0, "tue" => 0, "wed" => 0, "thu" => 0, "fri" => 0, "sat" => 0,
                "total" => 0
            ];
        } catch (PDOException $e) {
            return ["error" => "Database error: " . $e->getMessage()];
        }
    }
}
