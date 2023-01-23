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

    public function getSongs($sort = "")
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM songs $sort"); //ORDER BY title or artist
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->echoSongs($data);
    }

    public function getSum($column, $table = "songs")
    {
        global $pdo;
        $sql = "SELECT DISTINCT $column FROM $table";
        $stmt = $pdo->query($sql);
        return $stmt;
    }


    public function searchSong()
    {
        global $pdo;
        $chosen_word = $_POST["search-input"];
        $stmt = $pdo->prepare("SELECT * FROM songs WHERE title=? OR artist=?");
        $stmt->execute([$chosen_word, $chosen_word]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data) == 0) {
            $_SESSION["no-result"] = "There is no result try again";
        } else {
            $this->echoSongs($data);
        }
    }


    public function echoSongs($data)
    {
        $index = 1;
        foreach ($data as $row) {
            echo "<tr id='" . $row["id"] . "'>
                        <td class='index-td'>" . $index . "</td>
                        <td>" . $row["title"] . "</td>
                        <td>" . $row["artist"] . "</td>
                        <td><div class='lyrics' onclick='showLyrics(this);' data-bs-toggle='modal' data-bs-target='#lyrics-modal'>" . $row["song"] . "</div></td>
                        <td>" . $row["publication_date"] . "</td>
                        <td>
                            <button type='button' class='btn btn-warning' onclick='updateModal(this);' data-bs-toggle='modal' data-bs-target='#modal' >Edit</button>
                            <button type='button' class='btn' style='background-color:#f50472; color:white;' onclick='deleteModal(this);' data-bs-toggle='modal' data-bs-target='#modal'>Dlete</button>
                        </td>
                    </tr>";
            $index++;
        }
    }
}
