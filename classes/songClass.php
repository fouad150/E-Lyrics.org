<?php
class song
{
    public function insert()
    {
        global $pdo;
        $title = $_POST["title"];
        $artist = $_POST["artist"];
        $song = $_POST["song"];
        $publication_date = $_POST["publication_date"];

        $sql = "INSERT INTO songs (title,artist,song,publication_date) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $artist, $song, $publication_date]);
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
    }

    public function delete()
    {
        global $pdo;
        $song_id = $_POST["song_id"];
        $sql = "DELETE FROM songs WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$song_id]);
    }
}
