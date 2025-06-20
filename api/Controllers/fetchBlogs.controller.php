<?php

class FecthBlogController {
    private $blogsModel;

    public function __construct() {
        $this->blogsModel = new BlogsModel();
    }

    public function fetchBlogs() {
        $blogs = $this->blogsModel->getBlogs(5);
        header("Content-Type: application/json");
        echo json_encode($blogs);
    

   
        if ($blogs) {
            return true;
        } else {
            return false;
        }
    }
}
?>
