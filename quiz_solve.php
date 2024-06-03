<?php
session_start();

if (!isset($_SESSION["exam_start"])) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION["exam_category"])) {
    echo "Exam Category not set<br>";
}

if (!isset($_SESSION["exam_time"])) {
    echo "Exam Time not set<br>";
} else {
    echo "Exam Time: " . $_SESSION["exam_time"] . "<br>";
}

if (!isset($_SESSION["end_time"])) {
    echo "End Time not set<br>";
} else {
    echo "End Time: " . $_SESSION["end_time"] . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Solve</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <!-- Aici adaugă întrebările și răspunsurile -->
</body>
</html>
