<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="edit-list.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<section class="mt-5 gradient-form">
    <div class="container-fluid pt-5 h-100">
    <div class="card">
    <?php include 'message.php' ?>
        <div class="card-header">
            <h4>Student details
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT * FROM registration";
                    $query_run = mysqli_query($con, $query);
                    include "message.php";
                    if (mysqli_num_rows($query_run) > 0) {
                        foreach($query_run as $student) {
                            ?>
                            <tr>
                                <td><?=$student['id']; ?></td>
                                <td><?=$student['username']; ?></td>
                                <td><?=$student['email']; ?></td>
                                <td>
                                    <form action="code.php" method="POST" class="d-inline">
                                    <input type="hidden" name="delete_student" value="<?=$student['id'];?>">
                                        <button type="submit" name="delete_student" value="<?=$student['id'];?>" class="btn btn-outline-danger me-5">Delete</button>
                                    </form>
                                    <a href="grades.php?username=<?php echo urlencode($_SESSION['username']); ?>&id=<?=$student['id'];?>" class="btn btn-outline-info ">Grades</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<h5>No record found</h5>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</section>


</body>
</html>
