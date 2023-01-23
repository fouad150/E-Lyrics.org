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
        <div class="statistics-container">
            <div class="statistics d-flex justify-content-between align-items-center">
                <div class="stats">
                    <h5 class="mb-0 yellow">Titles</h5>
                    <span><?php echo $song_object->getSum("title")->rowcount(); ?></span>
                </div>
                <div class="stats">
                    <h5 class="mb-0 yellow">Artists</h5>
                    <span><?php echo $song_object->getSum("artist")->rowcount(); ?></span>
                </div>
                <div class="stats">
                    <h5 class="mb-0 yellow">Admins</h5>
                    <span><?php echo $song_object->getSum("email", "admins")->rowcount(); ?></span>
                </div>
            </div>
        </div>

        <button type="button" class="btn mb-4" style="background-color:#1cc9e2;" onclick="addModal();" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa fa-plus fa-lg me-2 ms-n2"></i> <strong>Add Song</strong></button>

        <?php
        if (isset($_SESSION['successful-inserting'])) {
            echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong style='color:#002434;'>" . $_SESSION['successful-inserting'] . "</strong>  
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
            unset($_SESSION['successful-inserting']);
        }

        if (isset($_SESSION['successful-update'])) {
            echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong style='color:#002434;'>" . $_SESSION['successful-update'] . "</strong>  
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
            unset($_SESSION['successful-update']);
        }

        if (isset($_SESSION['successful-delete'])) {
            echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong style='color:#002434;'>" . $_SESSION['successful-delete'] . "</strong>  
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
            unset($_SESSION['successful-delete']);
        }
        ?>

        <div class="row mb-2">
            <div class="col-md-5 w-100 d-flex justify-content-end">
                <form action="dashboard.php" method="post" class="input-group" style="width:180px;">
                    <input class="form-control border " type="search" name="search-input">
                    <button class="btn btn-info" style="background-color:#1cc9e2;" type="submit" name="search">Search</button>
                </form>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-5 w-100 d-flex justify-content-end">
                <form action="dashboard.php" method="post" class="input-group" style="width:180px;">
                    <select class="form-select" name="select">
                        <option value="title" class="text-dark">By title</option>
                        <option value="artist" class="text-dark">By artist</option>
                    </select>
                    <button class="btn btn-info" style="background-color:#1cc9e2; width:73px;" type="submit" name="sort">Sort</button>
                </form>
            </div>
        </div>


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
                if (isset($_POST["search"])) {
                    $song_object->searchSong();
                } else {
                    if (isset($_POST["sort"])) {
                        if ($_POST["select"] == "title") {
                            $data = $song_object->getSongs("ORDER BY title");
                        } else if ($_POST["select"] == "artist") {
                            $data = $song_object->getSongs("ORDER BY artist");
                        }
                    } else {
                        $data = $song_object->getSongs();
                    }
                }


                if (isset($_SESSION['no-result'])) {
                    echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong style='color:#002434;'>" . $_SESSION['no-result'] . "</strong>  
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                    unset($_SESSION['no-result']);
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Model -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="scripts.php" method="POST" id="add-modal" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Lyrics</h5>
                        <a href="#" class="btn-close" data-bs-dismiss="modal"></a>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div>
                            <!-- This Input Allows Storing song id  -->
                            <input type="hidden" name="song_id">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title[]" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Artist</label>
                                <input type="text" class="form-control" name="artist[]" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Song</label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="" style="height: 100px" name="song[]"></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Publication date</label>
                                <input type="date" class="form-control" name="publication_date[]" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn task-action-btn multiple-button" id="duplicate-button" onclick="duplicateInputs();"><i class="fa fa-plus fa-lg me-2 ms-n2"></i>Multiple</button>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn bg-white" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" name="delete" class="btn btn-danger task-action-btn delete-button" id="song-delete-btn">Delete</button>
                            <button type="submit" name="update" class="btn btn-warning task-action-btn" id="song-update-btn">Update</button>
                            <button type="submit" name="save" class="btn btn-primary task-action-btn" id="song-save-btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Lyrics Model -->
    <div class="modal fade" id="lyrics-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lyrics</h5>
                    <a href="#" class="btn-close" data-bs-dismiss="modal"></a>
                </div>
                <div class="modal-body" id="lyrics-modal-body">
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