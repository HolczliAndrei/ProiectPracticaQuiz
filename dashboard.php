<?php
session_start();
include 'header.php';
?>

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
    .quiz-container {
    width: 500px;
    height: 300px;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}



    .question{
        text-align: left;
    }
    *{
    font-family: "Poetsen One", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 3vh;
}
</style>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

<div class="quiz-container">
<div class="question-counter">
    <div id="current_que" style="float:left">0</div>
    <div style="float:left; margin-left: 5px; margin-right: 5px;">/</div>
    <div id="total_que" style="float:left">0</div>
</div>


 
       <div style="text-align: left;">
            <div class="" id="load_questions" style>

            </div>
        </div>
           
    
    <div class="question" style="margin-top: 30px">
        
          
            <input type="button" class="btn btn-warning" value="previous" onclick="load_previous();" style="margin-right: 10px;">

        <input type="button" class="btn btn-warning" value="next" onclick="load_next();" style="margin-left: 10px;">

          
    </div>
</div>

<script type="text/javascript">
    function load_total_que(){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","forajax/load_total_que.php",true);
        xmlhttp.send(null);
    }

    var questionno = '1';
    load_questions(questionno);

    function load_questions(questionno){
        document.getElementById("current_que").innerHTML = questionno;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                console.log("Response:", xmlhttp.responseText);
                if(xmlhttp.responseText.trim() == "over"){
                    window.location="result.php";
                }else{
                    document.getElementById("load_questions").innerHTML= xmlhttp.responseText;
                    load_total_que();
                }
            }
        };
        xmlhttp.open("GET","forajax/load_questions.php?questionno="+questionno,true);
        xmlhttp.send(null);
    }

    function radiocheck(radiovalue, questionno){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            }
        };
        xmlhttp.open("GET","forajax/save_answer_in_session.php?questionno=" + questionno + "&value1=" + radiovalue,true);
        xmlhttp.send(null);
    }

    function load_previous(){
        if(questionno == "1"){
            load_questions(questionno);
        }else{
            questionno = eval(questionno)-1;
            load_questions(questionno);
        }
    }

    function load_next(){
        questionno = eval(questionno)+1;
        load_questions(questionno);
    }
    function getRandomColor(colors) {
    return colors[Math.floor(Math.random() * colors.length)];
}

document.addEventListener("DOMContentLoaded", function() {
    var colors = ['#cbc052', '#ced2a7', '#c1c17c']; // Serie de culori disponibile
    var container = document.querySelector('.quiz-container');
    var gradient = "linear-gradient(135deg, ";

    for (var i = 0; i < colors.length; i++) {
        gradient += getRandomColor(colors);
        if (i < colors.length - 1) {
            gradient += " " + (i * 33.33) + "%, ";
        } else {
            gradient += " 100%)";
        }
    }

    container.style.background = gradient;
});

</script>
