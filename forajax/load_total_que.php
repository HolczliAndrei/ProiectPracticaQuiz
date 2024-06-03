<?php 
    session_start();
    include '../connect.php';
    $total_que=0;
    $resl=mysqli_query($con, "SELECT * FROM questions WHERE quiz_id ='$_SESSION[exam_id]'");
    $total_que = mysqli_num_rows($resl);
    echo $total_que;
?>