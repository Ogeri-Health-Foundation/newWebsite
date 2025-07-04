<?php
require_once "../Models/AllBlogs.php";

class AllBlogController extends AllBlogs {
    public function getBlogs() {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 5;

        $result = $this->getAllBlogs($page, $perPage);

        header("Content-Type: application/json");
        echo json_encode($result);
    }
}
?>
