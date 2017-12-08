<?php
session_start();
include 'database.php';
?>
<!DOCTYPE html>
<html>
     <head>
        <title>Super Mario Odyssey Database</title>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa|Passion+One" rel="stylesheet">
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this world?");
            }
        </script>
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
                <li class="nav-item active">
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
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search by Kingdom">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>

        <div class='container'>
            <div class='row'>
                <div class='col-sm-2'>
                    <h1>Worlds</h1>
                </div>
            <?php
            if ($_SESSION['admin'] == "true") {
                echo    "<div class='col-sm-1'>
                            <h1><a href='insert.php' class='btn btn-primary'>Add</a></h1>
                        </div>";
            }
            echo "<div class='col-sm-1'>
                      <h1><a href='database.php?action=worldReport' class='btn btn-primary'>Generate Collectable Report</a></h1>
                </div>
            </div>";
            if ($_GET['update'] == "true")
            {
                echo "<h3 class='text-success'>" . $_GET['kingdom'] . " has been updated!</h3>";
            }
            elseif ($_GET['delete'] == "true")
            {
                echo "<h3 class='text-danger'>" . $_GET['kingdom'] . " has been deleted!</h3>";
            }
            elseif ($_GET['add'] == "true")
            {
                echo "<h3 class='text-success'>" . $_GET['kingdom'] . " has been added!</h3>";
            }
            elseif ($_GET['report'] == "true")
            {
                echo "<h3 class='text-info'>There are " . $_GET['coins'] . " coins and " . $_GET['moons'] . " moons left to collect, good luck!</h3>";
            }
            searchWorlds();
            ?>
        </div>
    </body>
</html>