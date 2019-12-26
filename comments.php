<?php
    
    $dBConnection = new DbConnection("localhost", "blog", "drazen", "Drazen123*");
    $connection = $dBConnection->connect();
    $postRepository = new PostRepository($connection);
    $comments = $postRepository->getPostComments($_GET["id"]);
   
?>

<div>
        <?php foreach($comments as $comment): ?>
        <p>
           <?php echo $comment['text']; ?>
        </p>
        <?php endforeach; ?>
    </div>