<?php
session_start();
include 'database.php';

if($_GET['location'] == "worlds")
{
    $dbConn = getDatabaseConnection();
    
    $sql = "DELETE FROM worlds
            WHERE name='" . $_GET['name'] . "'";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    
    header("Location: worlds.php?delete=true&kingdom=" . $_GET['name']);
}
elseif($_GET['location'] == "outfits")
{
    $dbConn = getDatabaseConnection();
    
    $sql = "DELETE FROM outfits
            WHERE name='" . $_GET['name'] . "'";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    
    header("Location: outfits.php?delete=true&outfit=" . $_GET['name']);
}
elseif($_GET['location'] == "capture")
{
    $dbConn = getDatabaseConnection();
    
    $sql = "DELETE FROM capture
            WHERE name='" . $_GET['name'] . "'";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    
    header("Location: captures.php?delete=true&monster=" . $_GET['name']);
}
?>