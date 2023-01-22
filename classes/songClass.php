<?php
class song
{
    public function insert()
    {
        global $pdo;
        for ($i = 0; $i < count($_POST["title"]); $i++) {
            $title = $_POST["title"][$i];
            $artist = $_POST["artist"][$i];
            $song = $_POST["song"][$i];
            $publication_date = $_POST["publication_date"][$i];

            $sql = "INSERT INTO songs (title,artist,song,publication_date) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $artist, $song, $publication_date]);
        }

        $_SESSION["successful-inserting"] = "the songs have been added successfully";
        header("location:dashboard.php");
    }

    public function getSongs()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM songs");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update()
    {
        global $pdo;
        $song_id = $_POST["song_id"];
        $title = $_POST["title"];
        $artist = $_POST["artist"];
        $song = $_POST["song"];
        $publication_date = $_POST["publication_date"];
        $sql = "UPDATE songs SET title=?, artist=?, song=?, publication_date=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $artist, $song, $publication_date, $song_id]);
        $_SESSION["successful-update"] = "the song has been updated successfully";
        header("location:dashboard.php");
    }

    public function delete()
    {
        global $pdo;
        $song_id = $_POST["song_id"];
        $sql = "DELETE FROM songs WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$song_id]);
        $_SESSION["successful-delete"] = "the song has been deleted successfully";
        header("location:dashboard.php");
    }


    public function getTitlesSum()
    {
        global $pdo;
        $sql = "SELECT DISTINCT title FROM songs";
        $stmt = $pdo->query($sql);
        return $stmt;
    }
}
