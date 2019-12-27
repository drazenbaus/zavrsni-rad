<?php
class CommentRepository {
    private $connection;
    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createComment(string $name,string $comment, int $postid){
        if(!$name || !$comment || !$postid) {
            return;
        }
        $sql = "INSERT INTO comments (author, text, post_id) VALUES (?,?,?)";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute([$name, $comment, $postid]);

    }

    public function deleteComment($commentId) {

      if (!$commentId) {
        return;
      }

      $stmt = $this->connection->prepare("DELETE FROM comments WHERE id = :id");
      $stmt->bindParam(':id', $commentId);
      $stmt->execute();
    }
}
