<?php
session_start();
include 'header.php';
?>
<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div id = "current_que" style="float:left">0</div>
            <div style="float:left">/</div>
            <div id="total_que" style="float:left">0</div>
        </div>

        <div class="row" style="margin-top 30px;">
            <div class="row">
                <div class="col-lg-10" id="load_questions">

                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 30px">
            <div class="col-lg-6">
                <div class="col-lg-12 text-center">
                    <input type="button" class="btn btn-warning" value="previous" onclick="load_previous();">
                    <input type="button" class="btn btn-warning" value="next" onclick="load_next();" hide>
                </div>
            </div>
        </div>
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
</script>

