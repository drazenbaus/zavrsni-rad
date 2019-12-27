<?php
    $postId = isset($_GET["id"]) ? $_GET["id"] : null;

    if(!isset($postId)) {
        header("Location: not-found.php");
    }

    include('connection/DbConnection.php');
    include('repository/PostRepository.php');
    include('repository/CommentRepository.php');
    include('constants/Environment.php');

    $environment = new Environment();

    $dBConnection = new DbConnection(
        $environment::SERVERNAME,
        $environment::DB_NAME,
        $environment::USERNAME,
        $environment::PASSWORD
    );

    $connection = $dBConnection->connect();
    $isCommentDelete = isset($_GET['delComment']);
    $isPostDelete = isset($_GET['deletePost']);

    $commentRepository = new CommentRepository($connection);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isCommentDelete) {
        $commentRepository->createComment($_POST['firstname'], $_POST['comment'], $postId);
        header("Location: single-post.php?id=" . $postId);
    }

    $postRepository = new PostRepository($connection);

    if ($isPostDelete) {
        $postRepository->deletePost($postId);
        header("Location: posts.php");
    }

    if ($isCommentDelete) {
        $commentRepository->deleteComment($_GET['delComment']);
        header("Location: single-post.php?id=" . $postId);
    }

    $post = $postRepository->getPostById($postId);

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<link href="styles/blog.css" rel="stylesheet">
<link rel="stylesheet" href="styles/styles.css">
<?php include('header.php') ?>
<main role="main" class="container">

     <div class="row">

        <div class="col-sm-8 blog-main" >

        <div >
        <h3>
           <?php echo $post['title']; ?>
        </h3>
        <p>
        <?php echo $post['created_at']?> by <?php echo $post['author']?> 
        </p>
        <p>
           <?php echo $post['body']; ?>
        </p>

        <a
            class="btn btn-danger"
            href="single-post.php?id=<?php echo $post['id']?>&deletePost=true"
            onclick="return confirm('Are you sure you want to delete this post?')"
        >
            Delete Post
        </a>

        <span id = "validation-message" class="alert alert-danger" style = "display: none;">Please fill all fields!</span>
        <form name = 'comment-form' method = 'POST' action="single-post.php?id=<?php echo $post["id"]; ?> "onsubmit="return validateComment();">   
            <legend>Comment here:</legend>
            First name:<br>
            <input type="text" name="firstname" value="" onkeyup="togleMessage('comment-form')"><br>
            <textarea name="comment" class = 'sss' onkeyup="togleMessage('comment-form')"></textarea>
            <input type="submit" value="Submit">
        </form> 
        
        <button class="btn btn-default" onclick="myFunction()">Hide/Show comments</button>
        <p><?php include('comments.php') ?></p>
        
</div>

    </div>
    <?php include('sidebar.php') ?>
</main>

<?php include('footer.php') ?>
<script type="text/javascript" src="scripts.js"></script>
