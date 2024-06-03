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
    <title>Create a quiz</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="css/create-quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include 'message.php' ?>
    <form action="code.php" method="post" enctype="multipart/form-data">
        <div class="container mt pt pb mb">
            <div class="column1">
                <p class="coldesc">Quiz name</p>
                <label for="name">
                    <input type="text" required name="name" style="width:60vh; border-radius:10px;height:7vh; vertical-align: top; padding-top: 10px;font-size:5vh;text-align:center;border:none;border-bottom:3px solid black;">
                </label>
            </div>
            <div class="column2">
                <p class="coldesc">Provide a description for the quiz</p>
                <label for="description">
                    <textarea name="description" required id="description" style="width: 60vh; border-radius: 10px; height: 12vh; padding: 10px; font-size: 3vh; text-align: center; resize: none;"></textarea>
                </label>
            </div>
            <div class="column3">
                <button name="create_quiz">Fill Quiz</button>
            </div>
            <div class="column4">
                <label for="input-file" id="drop-area" class="drop-area">
                    <input type="file" hidden="hidden" name="image" id="input-file" accept=".jpg, .jpeg, .png">
                    <div id="img-view" class="img-view">
                        <p class="coldesc">Choose a picture for the quiz</p>
                        <img src="logo.jpg" style="height:15vh;width:15vh;margin-top:2vh;margin-bottom:10vh;">
                        <p>Drag and drop or click here <br> to upload an image</p>
                    </div>
                </label>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
