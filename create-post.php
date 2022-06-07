<?php include('db.php');

if (isset($_POST['submit'])) {
    $title = $_POST['title'];

    $body = $_POST['body'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    if (empty($title) || empty($ime) || empty($prezime) || empty($body)) {
        echo 'All fields must be filled';
    } else {
        $currentDate = date("Y-m-d h:i");
        $sql = "INSERT INTO posts (
            title, author_id, body, created_at, Id)
            VALUES ('$title', (SELECT ID from Author WHERE ime='$ime' and prezime='$prezime'), '$body', '$currentDate', 20)";
        $statement = $connection->prepare($sql);
        $statement->execute();
        header("Location: ./posts.php");
        echo ("Upisi u bazu");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create post</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

    <?php include('header.php') ?>

    <main role="main" class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <form class="form" action="create-post.php" method="POST" id="postsForma">
                        <ul class="form_post">
                            <li>
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" placeholder="Enter title" required>
                            </li>
                            <li>
                                <label for="author">Ime</label>
                                <input type="text" id="ime" name="ime" placeholder="Enter your name" required>
                            </li>
                            <li>
                                <label for="author">Prezime</label>
                                <input type="text" id="prezime" name="prezime" placeholder="Enter your name" required>
                            </li>

                            <li>
                                <label for="body">Body</label>
                                <textarea name="body" placeholder="Enter text" rows="10" id="bodyPosts"
                                    required></textarea><br>
                            </li>

                            <li>
                                <button class="btn btn-outline-primary" type="submit" name="submit">Submit</button>
                            </li>
                        </ul>
                    </form>

                </div><!-- /.blog-post -->




            </div><!-- /.blog-main -->

            <?php include('sidebar.php') ?>
    </main><!-- /.container -->
    <?php include('footer.php') ?>

</body>

</html>