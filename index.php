<?php
session_start();
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
                <li class="nav-item active">
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
                <?php
                if ($_SESSION['admin'] == "true")
                {
                    echo    "<li class='nav-item'>
                                <a class='nav-link' href='login.php'>Logout</a>
                            </li>";
                }
                else
                {
                    echo    "<li class='nav-item'>
                                <a class='nav-link' href='login.php'>Login</a>
                            </li>";
                }
                ?>
            </ul>
        </nav>
        <div class="bg">
            <div class="container"><br>
                <div class="col-sm-10 bg-dark text-white rounded">
                    <h1>Welcome to Super Mario Odyssey Database!</h1><br />
                    <?php
                    if ($_SESSION['admin'] == "true")
                    {
                        echo "<h3>You are in admin mode.</h3>";
                    }
                    else
                    {
                        echo "<h3>You are in guest mode.</h3>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>