<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
$quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : '';
require 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit quiz</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="edit-quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<section class="mt-5 gradient-form">
    <div class="container-fluid py-0 h-100 d-flex justify-content-center align-items-center">
        <p><? echo $quiz_id; ?></p>
    <form action="code.php" method="post" class="form-inline">
    <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
        <div class="row">
            <div class="col">
                <input name="question" type="text" class="form-control mb-5" placeholder="Enter question">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input name="correct" type="text" class="form-control mb-3" placeholder="Correct answer">
            </div>
            <div class="col">
                <input name="wrong[]" type="text" class="form-control mb-3" placeholder="Wrong answer 1">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input name="wrong[]" type="text" class="form-control" placeholder="Wrong answer 2">
            </div>
            <div class="col">
                <input name="wrong[]" type="text" class="form-control" placeholder="Wrong answer 3">
            </div>
        </div>
        <input type="submit" name="submitquestion" class="form-control mt-4">
        <div class="row">
        <div class="col">
    <a style="background-color:#6E88AF;border:none;" id="link" href="admin.php?username=<?php echo urlencode($_SESSION['username']); ?>" class="form-control btn btn-primary mt-5">Finish editing</a>
</div>
    </form>
    </div>
</section>
</body>
</html>
