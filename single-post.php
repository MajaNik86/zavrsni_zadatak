<?php include('db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

    <?php include('header.php') ?>

    <main role="main" class="container">

        <?php
        $postId = $_GET['post_id'];
        if (isset($postId)) {
            $sql = "SELECT p.Id, p.title, p.body, a.ime, a.prezime, p.created_at 
            FROM posts p INNER JOIN author as a ON p.author_id = a.Id 
            WHERE p.Id = {$_GET['post_id']}";
            $SinglePost = fetch($sql, $connection);

            $sql_comments = "SELECT c.text, p.Id, a.ime, a.prezime
            FROM comments AS c INNER JOIN posts as p
            ON c.posts_id = p.Id INNER JOIN author as a ON c.author_id = a.Id
            WHERE c.posts_id = {$_GET['post_id']}";
            $comments = fetch($sql_comments, $connection, true);
            // echo '<pre>';
            // var_dump($comments);
            // echo '</pre>';
        ?>

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="#"><?php echo ($SinglePost['title']) ?><a></h2>
                    <p class="blog-post-meta"><?php echo ($SinglePost['created_at']) ?> by <a
                            href="#"><?php echo ($SinglePost['ime'] . ' ' . $SinglePost['prezime']) ?></a></p>

                    <p><?php echo ($SinglePost['body']) ?></p>
                    <hr>


                    <h3>Comments</h3>
                    <?php foreach ($comments as $comment) { ?>
                    <ul>
                        <li>Posted by <strong><?php echo $comment['ime'] . ' ' . $comment['prezime'] ?> </strong>
                            <?php echo $comment['text'] ?>
                        </li>
                        <hr>

                    </ul>

                    <?php } ?>
                    <nav class="blog-pagination">
                        <a class="btn btn-outline-primary" href="#">Older</a>
                        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                    </nav>

                    <?php } ?>

                </div><!-- /.blog-main -->

                <?php include('sidebar.php') ?>

            </div><!-- /.row -->

    </main><!-- /.container -->

    <?php include('footer.php') ?>

</body>

</html>