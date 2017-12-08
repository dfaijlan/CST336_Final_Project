<?php
function getDatabaseConnection()
    {
        // $host = 'localhost';
        // $username = 'dfajilan';
        // $password = 'E11ipsis';
        // $dbname = 'tech_devices_app';
        
        $host = 'us-cdbr-iron-east-05.cleardb.net';
        $username = 'be97f49e03d0cb';
        $password = '458a88c5';
        $dbname = 'heroku_647a998f6865e28';
        
        $dbConn =  new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        return $dbConn;
    }
    
function searchWorlds() {
    $dbConn = getDatabaseConnection();
    
    $sql = "SELECT * FROM worlds";
    
    if(isset($_GET['search']) && $_GET['search'] != "")
    {
        $sql .= " WHERE name LIKE '%" . $_GET['search'] . "%'";
    }
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th>#</th>
                    <th>Kingdom Name</th>
                    <th>Purple Coins</th>
                    <th>Power Moons</th>";
    if ($_SESSION['admin'] == true)
    {
        echo "<th></th>
                </tr>
                </thead>
                <tbody>";
    }
    else
    {
        echo    "</tr>
                </thead>
                <tbody>";
    }
    $i = 1;
    foreach($result as $row) {
        echo "<tr><th scope='row'>$i</th><td>" . $row["name"] . "</td><td>" .$row["num_coins_collected"] . "/" . $row['num_coins'] . "</td><td>" . $row["num_moons_collected"] . "/" . $row["num_moons"] . "</td>";
        $i++;
        if ($_SESSION['admin'] == "true")
        {
            echo "<td><a href='update.php?id=" . $row['id'] . "&location=worlds' class='btn btn-outline-secondary'>Update</a>  "; 
            echo "<a onclick='return confirmDelete();' href='delete.php?name=" . $row['name'] . "&location=worlds' class='btn btn-outline-secondary'>Delete</a></td></tr>";
        }
        else
        {
            echo "</tr>";
        }
    }
    echo "</tbody></table>";
}

function getWorldInfo($worldId) {
    $dbConn = getDatabaseConnection();
    
    $sql = "SELECT * FROM worlds WHERE id = " . $worldId;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $record;
}

function updateWorld() {
    $dbConn = getDatabaseConnection();
    
    if ($_GET['updateWorld'] == "Enter")
    {
        $sql = "UPDATE worlds
                SET name = :kingdomName,
                    num_coins_collected = :coinsCollected,
                    num_coins = :coinsTotal,
                    num_moons_collected = :moonsCollected,
                    num_moons = :moonsTotal
                WHERE id = :id";
        
        $np = array();
        $np[':kingdomName'] = $_GET['kingdom-name'];
        $np[':coinsCollected'] = $_GET['coins-collected'];
        $np[':coinsTotal'] = $_GET['coins-total'];
        $np[':moonsCollected'] = $_GET['moons-collected'];
        $np[':moonsTotal'] = $_GET['moons-total'];
        $np[':id'] = $_GET['id'];
      
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        
        header("Location: worlds.php?update=true&kingdom=" . $_GET['kingdom-name']);
    }
}

function addWorld() {
    $dbConn = getDatabaseConnection();
    
    if ($_GET['addWorld'] == "Enter")
    {
        $sql = "INSERT INTO worlds
                    (name, num_coins_collected, num_coins, num_moons_collected, num_moons)
                VALUES 
                    (:kingdomName, :coinsCollected, :coinsTotal, :moonsCollected, :moonsTotal)";
                
        $np = array();
        $np[':kingdomName'] = $_GET['kingdom-name'];
        $np[':coinsCollected'] = $_GET['coins-collected'];
        $np[':coinsTotal'] = $_GET['coins-total'];
        $np[':moonsCollected'] = $_GET['moons-collected'];
        $np[':moonsTotal'] = $_GET['moons-total'];
      
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        
       header("Location: worlds.php?add=true&kingdom=" . $_GET['kingdom-name']);
    }
}

function searchOutfits() {
    $dbConn = getDatabaseConnection();
    
    $sql = "SELECT * FROM outfits";
    
    if(isset($_GET['search']) && $_GET['search'] != "")
    {
        $sql .= " WHERE name LIKE '%" . $_GET['search'] . "%'";
    }
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th>#</th>
                    <th>Outfit Name</th>
                    <th>Where to Obtain</th>
                    <th>Gold or Purple Coins</th>
                    <th>Cost</th>
                    <th>Collected?</th>";
    if ($_SESSION['admin'] == true)
    {
        echo "<th></th>
                </tr>
                </thead>
                <tbody>";
    }
    else
    {
        echo    "</tr>
                </thead>
                <tbody>";
    }
    $i = 1;
    foreach($result as $row) {
        echo "<tr><th scope='row'>$i</th><td>" . $row["name"] . "</td><td>" .$row["where_to_get"] . "</td>";
        if ($row["gold_or_purple"] == "Purple") {
            echo "<td><img src='/css/purple.jpg' width='40' height='40' alt=''></td><td>" . $row['costs'] . "</td>";
        }
        elseif ($row["gold_or_purple"] == "Gold") {
            echo "<td><img src='/css/gold.jpg' width='40' height='40' alt=''></td><td>". $row['costs'] . "</td>";
        }
        else {
            echo "<td>" . $row['gold_or_purple'] . "</td><td>" . $row['costs'] . "</td>";
        }
        if ($row['collected'] == 1) {
            echo "<td><a href='#' id='yes' class='btn btn-success'>Yes</a></td>";
        }
        else
        {
            $id = $row['id'];
            echo "<td><a href='#' id='no' value='" . $id . "' class='btn btn-danger'>No</a></td>";
        }
        $i++;
        if ($_SESSION['admin'] == "true")
        {
            echo "<td><a onclick='return confirmDelete();' href='delete.php?name=" . $row['name'] . "&location=outfits' class='btn btn-outline-secondary'>Delete</a></td></tr>";
        }
        else
        {
            echo "</tr>";
        }
    }
    echo "</tbody></table>";
}

function searchCaptures() {
    $dbConn = getDatabaseConnection();
    
    $sql = "SELECT * FROM capture";
    
    if(isset($_GET['search']) && $_GET['search'] != "")
    {
        $sql .= " WHERE name LIKE '%" . $_GET['search'] . "%'";
    }
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th>#</th>
                    <th>Monster Name</th>
                    <th>Where to Capture</th>
                    <th>Collected?</th>";
    if ($_SESSION['admin'] == true)
    {
        echo "<th></th>
                </tr>
                </thead>
                <tbody>";
    }
    else
    {
        echo    "</tr>
                </thead>
                <tbody>";
    }
    $i = 1;
    foreach($result as $row) {
        echo "<tr><th scope='row'>$i</th><td>" . $row["name"] . "</td><td>" .$row["where_to_get"] . "</td>";
        if ($row['collected'] == 1) {
            echo "<td><a href='#' id='yes' class='btn btn-success'>Yes</a></td>";
        }
        else
        {
            $id = $row['id'];
            echo "<td><a href='#' id='no' value='$id' class='btn btn-danger'>No</a></td>";
        }
        $i++;
        if ($_SESSION['admin'] == "true")
        {
            echo "<td><a onclick='return confirmDelete();' href='delete.php?name=" . $row['name'] . "&location=capture' class='btn btn-outline-secondary'>Delete</a></td></tr>";
        }
        else
        {
            echo "</tr>";
        }
    }
    echo "</tbody></table>";
}

function worldReport() {
    $dbConn = getDatabaseConnection();
    
    $sql = "SELECT * FROM worlds";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $coinsLeft = 0;
    $moonsLeft = 0;
    foreach ($result as $row) {
        $coinsLeft += ($row['num_coins'] - $row['num_coins_collected']);
        $moonsLeft += ($row['num_moons'] - $row['num_moons_collected']);
    }
    
    header("Location: worlds.php?report=true&coins=" . $coinsLeft . "&moons=" . $moonsLeft);
}

function outfitReport() {
     $dbConn = getDatabaseConnection();
    
    $sql = "SELECT * FROM outfits";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $goldCoins = 0;
    $purpleCoins = 0;
    foreach ($result as $row) {
        if ($row['collected'] == 0)
        {
            if ($row['gold_or_purple'] == "Gold")
            {
                $goldCoins += $row['costs'];
            }
            else
            {
                $purpleCoins += $row['costs'];
            }
        }
    }
    
    header("Location: outfits.php?report=true&gold=" . $goldCoins . "&purple=" . $purpleCoins);
}

function captureReport() {
    $dbConn = getDatabaseConnection();
    
    $sql = "SELECT collected FROM capture";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $capturesLeft = 0;
    foreach ($result as $row) {
        if ($row['collected'] == 0)
        {
            $capturesLeft++;
        }
    }
    
    header("Location: captures.php?report=true&captures=" . $capturesLeft);
}

if ($_GET['action'] == 'worldReport')
{
    worldReport();
}
elseif ($_GET['action'] == 'outfitReport')
{
    outfitReport();
}
elseif ($_GET['action'] == 'captureReport')
{
    captureReport();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script>
            $("#no").click(function() {
                alert($(this).val());
            });
        </script>
    </head>
</html>