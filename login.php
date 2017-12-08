<?php
session_start();

if ($_SESSION['admin'] == "true")
{
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Super Mario Odyssey Database</title>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Passion+One" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <h2 class="navbar-brand">
                <img src="/css/brand.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
                Odyssey DB
            </h2>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="worlds.php">Worlds</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="outfits.php">Outfits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="captures.php">Captures</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </nav>
        <div class="container">
            <h1>Administrator Login</h1>
        <?php
        if ($_SESSION['admin'] == "false")
        {
            echo "<h3>Login unsuccessful, please try again.</h3>";
        }
        ?>
        </div>
        <div class="container">
            <form action="login_attempt.php" method="get">
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username:</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="username" id="username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-6">
                        <input class="btn btn-dark" type="submit" id="submit" value="Enter">
                    </div>
                </div>
        </form>
        </div>
    </body>
</html>