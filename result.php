<?php 
session_start();
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[exam_time] minutes"));
include "header.php";
include "connect.php";
?>
<div class="row">
    <div class="col-lg-6">
        <?php 
            $correct = 0;
            $wrong = 0;
            if(isset($_SESSION["answer"])){
                for($i=1;$i<=sizeof($_SESSION["answer"]);$i++){
                    $answer = "";
                    $res = mysqli_query($con, "SELECT * FROM questions WHERE quiz_id = '$_SESSION[exam_id]' && question_no=$i");
                    while($row=mysqli_fetch_array($res)){
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
    </div>
</div>
<?php 
    if(isset($_SESSION["exam_start"])){
        $date = date("Y-m-d");
        mysqli_query($con, "INSERT INTO exam_results(id, email, exam_name, total_question, correct_answer, wrong_answer, exam_time) VALUES (NULL, '$_SESSION[username]', '$_SESSION[exam_category]', '$count', '$correct', '$wrong', '$date')");
    }
    if(isset($_SESSION["exam_start"])){
        unset($_SESSION["exam_start"])
        ?>
       
        <script type = "text/javascript">
            window.location.href = window.location.href;
        </script> 
        
        <?php
    }
?>
