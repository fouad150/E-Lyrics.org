<?php
include "databaseClass.php";
$dbConnection = new databaseConnection();
$pdo = $dbConnection->connection();

class song
{
    public function insert($title, $artist, $song, $publication_date)
    {
        global $pdo;
        $sql = "INSERT INTO songs (title,artist,song,publication_date) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $artist, $song, $publication_date]);
    }
}
