<?php include 'header.php'; ?>
<?php 
    require_once("connect.php");
    $result = mysqli_query($con, "SELECT * FROM quizez");
    while ($row = mysqli_fetch_array($result)) {
?>
    <input type="button" value="<?php echo $row['name']; ?>" class="btn btn-success" onclick="set_exam_name_session(this.value);">
<?php
    }
?>
<script type="text/javascript">
    function set_exam_name_session(exam_category) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText.trim() === "success") {
                    window.location = "quiz_solve.php";
                } else {
                    console.error("Error: " + xmlhttp.responseText);
                }
            }
        };
        xmlhttp.open("GET", "forajax/set_exam_name_session.php?exam_category=" + exam_category, true);
        xmlhttp.send(null);
    }
</script>
</body>
