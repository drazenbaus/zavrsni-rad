<?php
    include('connection/DbConnection.php');
    include('repository/PostRepository.php');

    $dBConnection = new DbConnection("localhost", "blog", "drazen", "Drazen123*");
    $connection = $dBConnection->connect();
    $postRepository = new PostRepository($connection);
    $post = $postRepository->getPostById($_GET["id"]);
    
?>

<div>
        <h3>
           <?php echo $post['title']; ?>
        </h3>
        <?php include('comments.php') ?>
</div>