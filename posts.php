<?php
    include('connection/DbConnection.php');
    include('repository/PostRepository.php');

    $dBConnection = new DbConnection("localhost", "blog", "drazen", "Drazen123*");
    $connection = $dBConnection->connect();
    $postRepository = new PostRepository($connection);
    $posts = $postRepository->getPosts();
?>

<div class="blog-post">
    <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>

    <div>
        <?php foreach($posts as $post): ?>
        <h3>
           <a href="/single-post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a> 
        </h3>
        <?php endforeach; ?>
    </div>

</div>
