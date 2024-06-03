<?php 
    session_start();
    include '../connect.php';
    $question_no = "";
    $question = "";
    $opt1 = "";
    $opt2 = "";
    $opt3 = "";
    $opt4 = "";
    $opt1_text = "";
    $opt2_text = "";
    $opt3_text = "";
    $opt4_text = "";
    $answer = "";
    $count = 0;
    $ans = "";

    $queno = $_GET["questionno"];
    if(isset($_SESSION["answer"][$queno])){
        $ans = $_SESSION["answer"][$queno];
    }
    $res = mysqli_query($con, "SELECT * FROM questions WHERE quiz_id = '$_SESSION[exam_id]' && question_no = '$_GET[questionno]'");
    $count = mysqli_num_rows($res);
    if($count == 0)
    {
        echo "over";
    }else{
        while($row = mysqli_fetch_array($res)){
            $question_no = $row["question_no"];
            $question = $row["question_text"];
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
                WHERE questions.quiz_id = '$_SESSION[exam_id]' AND questions.question_no = '$question_no'
                ORDER BY questions.question_no, answers.id;";

            $ansres = mysqli_query($con, $sql);
            $counter = 1;
            while ($row = $ansres->fetch_assoc()) {
                switch ($counter) {
                    case 1:
                        $opt1 = $row;
                        break;
                    case 2:
                        $opt2 = $row;
                        break;
                    case 3:
                        $opt3 = $row;
                        break;
                    case 4:
                        $opt4 = $row;
                        break;
                }
                $counter++;
            }
            $opt1_text = $opt1["answer_text"];
            $opt2_text = $opt2["answer_text"];
            $opt3_text = $opt3["answer_text"];
            $opt4_text = $opt4["answer_text"];

        }
    
?>
<br>
    <table>
        <tr>
            <td>
                <?php echo "(".$question_no.")". $question; ?>
            </td>
        </tr>

    </table>

    <table>
        <tr>
            <td>
                <input type="radio" name="rl" id="rl" value = "<?php echo $opt1_text;?>" onclick="radiocheck(this.value,<?php echo $question_no;?>)"
                <?php 
                    if($ans == $opt1_text){
                        echo "checked";
                    }
                ?>>
            </td>
            <td>
                <?php 
                    echo $opt1_text;
                ?>         
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="rl" id="rl" value = "<?php echo $opt2_text;?>" onclick="radiocheck(this.value,<?php echo $question_no;?>)"
                <?php 
                    if($ans == $opt2_text){
                        echo "checked";
                    }
                ?>>
            </td>
            <td>
                <?php 
                    echo $opt2_text;
                ?>         
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="rl" id="rl" value = "<?php echo $opt3_text;?>" onclick="radiocheck(this.value,<?php echo $question_no;?>)"
                <?php 
                    if($ans == $opt3_text){
                        echo "checked";
                    }
                ?>>
            </td>
            <td>
                <?php 
                    echo $opt3_text;
                ?>         
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="rl" id="rl" value = "<?php echo $opt4_text;?>" onclick="radiocheck(this.value,<?php echo $question_no;?>)"
                <?php 
                    if($ans == $opt4_text){
                        echo "checked";
                    }
                ?>>
            </td>
            <td>
                <?php 
                    echo $opt4_text;
                ?>         
            </td>
        </tr>
    </table>
    <?php
}
?>