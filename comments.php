<?php
    $dBConnection = new DbConnection(
        $environment::SERVERNAME,
        $environment::DB_NAME,
        $environment::USERNAME,
        $environment::PASSWORD
    );

    $connection = $dBConnection->connect();
    $postRepository = new PostRepository($connection);
    $comments = $postRepository->getPostComments($_GET["id"]);
   
?>

<div id = "myDIV">
        <?php foreach($comments as $comment): ?>
    <ul class = 'single-post-comment-section' >
    <li class = 'single-post-comments' ><?php echo $comment['text']; ?></li>
    <li>Commented at <?php echo $post['created_at']?> by <?php echo $comment['author'];?> </li>
    </ul>
    <form action="single-post.php?id=<?php echo $post['id']?>&delComment=<?php echo $comment['id']?>" method = 'POST'>    
        <button type="submit" class="btn btn-danger">Delete comment</button>
    </form>
    
        <?php endforeach; ?>
</div>


<script type="text/javascript" src="scripts.js"></script>
