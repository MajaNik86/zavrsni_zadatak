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
        if (isset($_GET['post_id'])) {
            $sql = "SELECT Id, title, body, author, created_at 
            FROM posts  
            WHERE Id = {$_GET['post_id']}";
            $SinglePost = fetch($sql, $connection);

            $sql_comments = "SELECT c.author, c.text, p.Id 
            FROM comments AS c INNER JOIN posts as p
            ON c.posts_id = p.Id
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
                            href="#"><?php echo ($SinglePost['author']) ?></a></p>

                    <p><?php echo ($SinglePost['body']) ?></p>
                    <hr>

                    <ul>
                        <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                        <li>Donec id elit non mi porta gravida at eget metus.</li>
                        <li>Nulla vitae elit libero, a pharetra augue.</li>
                    </ul>
                    <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.
                    </p>
                    <ol>
                        <li>Vestibulum id ligula porta felis euismod semper.</li>
                        <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
                        <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
                    </ol>
                    <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
                </div><!-- /.blog-post -->
                <hr>
                <h3>Comments</h3>
                <?php foreach ($comments as $comment) { ?>
                <ul>
                    <li>Posted by <strong><?php echo $comment['author'] ?> </strong> : <?php echo $comment['text'] ?>
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
    </main><!-- /.container -->

    <?php include('footer.php') ?>

</body>

</html>