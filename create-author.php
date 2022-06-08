<?php include('db.php');

if (isset($_POST['submit'])) {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $pol = $_POST['pol'];

    if (empty($ime) || empty($prezime) || empty($pol)) {
        echo 'All fields must be filled';
    } else {
        $sql = "INSERT INTO author (
            ime,prezime,pol, Id)
            VALUES ('$ime', '$prezime','$pol', 22)";
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
    <title>Create author</title>

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
                    <form class="form" action="create-author.php" method="POST" id="postsForma">
                        <ul class="form_post">
                            <li>
                                <label for="author">First Name</label>
                                <input type="text" id="ime" name="ime" placeholder="Enter your first name" required>
                            </li>
                            <li>

                                <label for="author">Last Name</label>
                                <input type="text" id="prezime" name="prezime" placeholder="Enter your last name"
                                    required>
                            </li>
                            <li>
                                <p> Select gender:</p>
                                <div>

                                    <label for="male">Male</label>
                                    <input type="radio" id="male" name="pol" value="m" required>

                                </div>

                                <div>
                                    <label for="female">Female</label>
                                    <input type="radio" id="female" name="pol" value="f">

                                </div>
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