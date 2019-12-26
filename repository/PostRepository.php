<?php
class PostRepository {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getPosts() {
        $stmt = $this->connection->prepare("SELECT * FROM posts");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getPostById($id) {  
        $stmt = $this->connection->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetch();

        return $result;
    }

    public function getPostComments($postId) {
        $stmt = $this->connection->prepare("SELECT * FROM comments WHERE post_id = :post_id");
        $stmt->execute(array(':post_id' => $postId));
        $result = $stmt->fetchAll();

        return $result;
    }
}