<?php
class PostRepository {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getPosts() {
        $stmt = $this->connection->prepare("SELECT * FROM posts ORDER BY created_at DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getLatestPosts() {
        $stmt = $this->connection->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT 5");
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

    public function createPost(string $title, string $body, string $author): void {

        if(!$title || !$body || !$author) {
            return;
        }

        $sql = "INSERT INTO posts (title, body, author, created_at) VALUES (?,?,?,?)";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute([
            $title,
            $body,
            $author,
            date_create()->format('Y-m-d H:i:s')
        ]);
    }

    public function deletePost(int $postId): void {
      if (!$postId) {
        return;
      }

      $stmt = $this->connection->prepare("DELETE FROM posts WHERE id = :id");
      $stmt->bindParam(':id', $postId);
      $stmt->execute();

    //   da bi sve radilo kako treba potrebno je da se napravi on delete cascade u bazi na tabeli comments na foreign key post_id. 
    }
}
