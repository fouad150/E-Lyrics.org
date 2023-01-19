<?php
include("scripts.php");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assist/style.css">
    <title></title>
</head>

<body class="dashboard-body">
    <div class="container mt-4">
        <table id="trains" class="table table-striped display nowrap" width="100%">
            <thead class="text-white">

                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Lyrics</th>
                    <th>Publication date</th>
                    <th>action</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $data = $song_object->getSongs();
                $index = 1;
                foreach ($data as $row) {
                    echo "<tr id='" . $row["id"] . "'>
                        <td class='index-td'>" . $index . "</td>
                        <td>" . $row["title"] . "</td>
                        <td>" . $row["artist"] . "</td>
                        <td data-bs-toggle='modal' data-bs-target='#lyrics-modal'><div class='lyrics'>" . $row["song"] . "</div></td>
                        <td>" . $row["publication_date"] . "</td>
                        <td>
                            <button type='button' class='btn btn-warning' onclick='showModal(this);' data-bs-toggle='modal' data-bs-target='#modal' >Edit</button>
                            <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modal'>Dlete</button>
                        </td>
                    </tr>";
                    $index++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
        modal
    </button>
    <!-- Model -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="scripts.php" method="POST" id="add-modal" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Lyrics</h5>
                        <a href="#" class="btn-close" data-bs-dismiss="modal"></a>
                    </div>
                    <div class="modal-body">
                        <!-- This Input Allows Storing song id  -->
                        <input type="text" id="song-id" name="song_id">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" id="song-title" name="title" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Artist</label>
                            <input type="text" class="form-control" id="song" name="artist" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Song</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px" name="song"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Publication date</label>
                            <input type="date" class="form-control" id="publication_date" name="publication_date" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn bg-white" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" name="delete" class="btn btn-danger task-action-btn delete-button" id="song-delete-btn">Delete</button>
                        <button type="submit" name="update" class="btn btn-warning task-action-btn" id="song-update-btn">Update</button>
                        <button type="submit" name="save" class="btn btn-primary task-action-btn" id="song-save-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Lyrics Model -->
    <div class="modal fade" id="lyrics-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="scripts.php" method="POST" id="form-modal" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Lyrics</h5>
                        <a href="#" class="btn-close" data-bs-dismiss="modal"></a>
                    </div>
                    <div class="modal-body">
                        <!-- This Input Allows Storing song id  -->
                        <input type="text" id="song-id" name="song_id">

                    </div>
                </form>
            </div>
        </div>
    </div>


    <style>
        * {
            color: white;
        }
    </style>

    <!-- js -->
    <script src="assist/main.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>