<?php 
session_start();
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[exam_time] minutes"));
include "header.php";
include "connect.php";
?>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

<style>
    body {
        background-image: url('b2.jpg');
        background-size: cover;
        background-position: center;
        margin: 0; /* Eliminăm marginile implicite ale body-ului */
        padding: 0; /* Eliminăm padding-ul implicite ale body-ului */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Setăm înălțimea corpului la 100% din înălțimea vizibilă a ecranului */
    }

    .result-container {
        height: 400px;
        width: 500px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); /* Adăugăm un fundal semi-transparent */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Adăugăm o umbră subtilă */
    }
    *{
    font-family: "Poetsen One", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 3vh;
}
.result {
    text-align: center;
}

</style>

<div class="result-container">
    <div class="row">
        <div class="result">
       
            <?php 
                $correct = 0;
                $wrong = 0;
                if(isset($_SESSION["answer"])){
                    for($i = 1; $i <= sizeof($_SESSION["answer"]); $i++){
                        $answer = "";
                        $res = mysqli_query($con, "SELECT * FROM questions WHERE quiz_id = '$_SESSION[exam_id]' && question_no=$i");
                        while($row = mysqli_fetch_array($res)){
                            $sql = "SELECT 
                            questions.id AS question_id,
                            questions.question_text,
                            questions.question_no,
                            questions.quiz_id,
                            answers.id AS answer_id,
                            answers.answer_text,
                            answers.correct
                                FROM questions
                                JOIN answers
                                ON questions.id = answers.question_id
                                WHERE questions.quiz_id = '$_SESSION[exam_id]' AND questions.question_no = $row[question_no] AND answers.correct = 1
                                ORDER BY questions.question_no, answers.id;";
                            $answer_query = mysqli_query($con, $sql);
                            $answer_row = mysqli_fetch_array($answer_query);
                            $answer = $answer_row["answer_text"];
                        }
                        
                        if(isset($_SESSION["answer"][$i])){
                                if($answer == $_SESSION["answer"][$i]){
                                    $correct = $correct + 1;
                                }else{
                                    $wrong = $wrong + 1;
                                }
                        }else{
                                $wrong = $wrong + 1;
                        }
                    }
                } 
                    $count = 0;
                    $res = mysqli_query($con, "SELECT * FROM questions where quiz_id = '$_SESSION[exam_id]'");
                    $count = mysqli_num_rows($res);
                    $wrong = $count - $correct;
                    echo 'Total questions: '.$count;
                    echo '<br>Correct answers: '.$correct;
                    echo '<br>Wrong answers: '.$wrong;
            ?>
             <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php 
    if(isset($_SESSION["exam_start"])){
        $date = date("Y-m-d");
        mysqli_query($con, "INSERT INTO exam_results(id, email, exam_name, total_question, correct_answer, wrong_answer, exam_time) VALUES (NULL, '$_SESSION[username]', '$_SESSION[exam_category]', '$count', '$correct', '$wrong', '$date')");
    }
    if(isset($_SESSION["exam_start"])){
        unset($_SESSION["exam_start"]);
        ?>
       
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script> 
        
        <?php
    }
?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total questions', 'Correct answers', 'Wrong answers'],
            datasets: [{
                label: 'Result',
                data: [
                    <?php echo $count; ?>,
                    <?php echo $correct; ?>,
                    <?php echo $wrong; ?>
                ],
                backgroundColor: [
                    'rgba(255, 255, 0, 0.2) X',
                    '   rgba(75, 192, 192, 0.2)',
                    
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
