<?php
    include('connection/DbConnection.php');
    include('repository/PostRepository.php');
    include('constants/Environment.php');

    $environment = new Environment();

    $dBConnection = new DbConnection(
        $environment::SERVERNAME,
        $environment::DB_NAME,
        $environment::USERNAME,
        $environment::PASSWORD
    );

    $connection = $dBConnection->connect();
    $postRepository = new PostRepository($connection);
    $posts = $postRepository->getPosts();
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link href="styles/blog.css" rel="stylesheet">
<link rel="stylesheet" href="styles/styles.css">

<?php include('header.php') ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div>
                <?php foreach($posts as $post): ?>
                <h1>
                <a href="/single-post.php?id=<?php echo $post['id']; ?>" class = "single-posts-titles"><?php echo $post['title']; ?></a> 
                </h1>
                <p><?php echo $post['body']; ?></p>
            <?php endforeach; ?>
    </div>

</div>
<?php include('sidebar.php') ?>
</main>
<?php include('footer.php') ?>

