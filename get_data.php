<?php
header('Content-Type: application/json');

include 'connect.php';

$data = [];

$sql = "SELECT COUNT(*) as count FROM `registration` WHERE `username` = 'Darius'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$data[] = ["Promoted", (int)$row['count']];

$sql = "SELECT COUNT(*) as count FROM `registration` WHERE `username` = 'Andrei'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$data[] = ["Failed", (int)$row['count']];

mysqli_close($con);

echo json_encode($data);
?>
