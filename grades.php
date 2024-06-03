<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
require 'connect.php';

$query = "SELECT * FROM quizez";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="grades.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<section class="mt-4 gradient-form">
    <a href="edit-list.php?username=<?php echo urlencode($_SESSION['username']); ?>" style="text-decoration: none !important;color:black !important;"><span style='font-size:50px;'>&#128281;</span></a>
    <div class="container-fluid pt-3 h-auto">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col">
                    <div class="card">
                    <img style="width: 40px; height: 40px;" src="uploads/<?php echo $row['picture']; ?>" class="card-img-top mt-3 ms-3" alt="Quiz Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text">Numele student: 
                                <?php
                                $id = $_GET['id'] ?? '';
                                
                                if (!empty($id)) {
                                    $student_query = "SELECT username FROM registration WHERE id = '$id'";
                                    $student_result = mysqli_query($con, $student_query);

                                    if(mysqli_num_rows($student_result) > 0) {
                                        $student_row = mysqli_fetch_assoc($student_result);
                                        echo $student_row['username'];
                                    } else {
                                        echo "Nedeterminat";
                                    }
                                } else {
                                    echo "ID lipsă";
                                }
                                ?>
                            </p>
                            <p style="margin-bottom:2vh !important;" class="card-text">Lista notelor:</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

</body>
</html>
