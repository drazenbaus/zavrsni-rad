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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postRepository = new PostRepository($connection);
        $postRepository->createPost($_POST['title'], $_POST['body'], $_POST['author']);
        header("Location: posts.php");
    }
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link href="styles/blog.css" rel="stylesheet">
<link rel="stylesheet" href="styles/styles.css">

<?php include('header.php') ?>
<main role="main" class="container">

     <div class="row">

        <div class="col-sm-8 blog-main" >

            <div>
                <h3>Create Post</h3>

                <div>
                    <span id="validation-message" class="alert alert-danger" style="display: none;">Please fill all fields!</span>
                </div>

                <form name='post-form' method='POST' action="create-post.php" onsubmit="return validatePost();">   
                    <label for="author">Author</label>
                    <input type="author" name="author" id="author" onkeyup="togleMessage('post-form')"><br>

                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" onkeyup="togleMessage('post-form')"><br>

                    <label for="body">Body</label>
                    <textarea class='sss' name="body" id="body" onkeyup="togleMessage('post-form')"></textarea><br>

                    <input type="submit" value="Submit">
                </form> 
            </div>

        </div>

        <?php include('sidebar.php') ?>
</main>
<?php include('footer.php') ?>
<script type="text/javascript" src="scripts.js"></script>
