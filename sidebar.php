<?php

    $dBConnection = new DbConnection(
        $environment::SERVERNAME,
        $environment::DB_NAME,
        $environment::USERNAME,
        $environment::PASSWORD
    );

    $connection = $dBConnection->connect();
    $postRepository = new PostRepository($connection);
    $posts = $postRepository->getLatestPosts();
?>

<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>Latests posts</h4>
        <?php foreach($posts as $post): ?>
        <h1>
           <a href="/single-post.php?id=<?php echo $post['id']; ?>" class = "single-posts-titles"><?php echo $post['title']; ?></a> 
        </h1>
        <?php endforeach; ?>
</aside>



