<?php
session_start();
include 'database.php';
$worldInfo = getWorldInfo($_GET["id"]);
?>
<html>
    <head>
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
        
        <div class="container">
            <h1>Update</h1>
            <form method="get">
                <input type="hidden" name="id" value="<?=$worldInfo['id']?>" />
                <div class="form-group row">
                    <label for="kingdom-name" class="col-sm-3 col-form-label">Kingdom Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="kingdom-name" id="kingdom-name" value="<?=$worldInfo['name']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="coins-collected" class="col-sm-3 col-form-label">Purple Coins Collected:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="coins-collected" id="coins-collected" value="<?=$worldInfo['num_coins_collected']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="coins-total" class="col-sm-3 col-form-label">Total Purple Coins:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="coins-total" id="coins-total" value="<?=$worldInfo['num_coins']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="moons-collected" class="col-sm-3 col-form-label">Power Moons Collected:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="moons-collected" id="moons-collected" value="<?=$worldInfo['num_moons_collected']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="moons-total" class="col-sm-3 col-form-label">Total Power Moons:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="moons-total" id="moons-total" value="<?=$worldInfo['num_moons']?>">
                    </div>
                </div>
                <input class="btn btn-dark" type="submit" name="updateWorld" value="Enter">
            </form>
        </div>
        <?=updateWorld()?>
    </body>
</html>