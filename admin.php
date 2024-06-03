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
    <title>Admin</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<section class="mt-5 gradient-form">
    <div class="container-fluid py-0 h-100">
        <div class="row h-50">
            <div class="col-md d-flex justify-content-center align-items-center" id="col1">
                <div class="text-center column1">
                    <div class="container-fluid d-flex flex-column align-items-center justify-content-center px-0" id="square">
                        <div class="row w-100 h-50 sqr1">
                            <div class="col d-flex justify-content-center align-items-center" id="form1">
                                <div class="triangle"></div>
                            </div>
                            <div class="col d-flex justify-content-center align-items-center">
                                <div class="square-shape"></div>
                            </div>
                        </div>
                        <div class="row w-100 h-50">
                            <div class="col d-flex justify-content-center align-items-center" id="form3">
                                <div class="circle"></div>
                            </div>
                            <div class="col d-flex justify-content-center align-items-center">
                                <div class="rhombus"></div>
                            </div>
                        </div>
                    </div>
                    <a target="" href="create-quiz.php?username=<?php echo urlencode($_SESSION['username']); ?>" class="custom-link"><p class="coldesc">Create a quiz</p></a>
                </div>
            </div>

            <div class="col-md d-flex justify-content-center align-items-center" id="col2">
                <div class="text-center col2">
                    <p class="coldesc">Quizez promovation percentage</p>
                    <div id="myChart"></div>
                </div>
            </div>
        </div>
        <div class="row h-50">
            <div class="col-md d-flex justify-content-center align-items-center">
                <div class="text-center col3">
                    <a target="" href="edit-list.php" class="custom-link"><p class="coldesc">Modify/view users list</p></a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></th>
                                    <th scope="col"><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></th>
                                    <th scope="col"><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">&#x2022;</th>
                                    <td><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></td>
                                    <td><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></td>
                                    <td><div class="d-flex justify-content-center align-items-center"><div class="green"></div><div class="red"></div></div></td>
                                </tr>
                                <tr>
                                    <th scope="row">&#x2022;</th>
                                    <td><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></td>
                                    <td><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></td>
                                    <td><div class="d-flex justify-content-center align-items-center"><div class="green"></div><div class="red"></div></div></td>
                                </tr>
                                <tr>
                                    <th scope="row">&#x2022;</th>
                                    <td><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></td>
                                    <td><hr style="height:2px;border-width:0;color:black;background-color:black;width:50%;margin-left:5vh;"></td>
                                    <td><div class="d-flex justify-content-center align-items-center"><div class="green"></div><div class="red"></div></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex justify-content-center align-items-center " id="col4">
            <div class="text-center emj-container">
                <a target="" href="inbox.php" class="custom-link"><p class="coldesc">Reports / Inbox </p></a>
        <span class="emj" style='margin-right: 10px;'>&#9888;</span>
        <span class="emj" style='margin-left: 10px; margin-right: 10px;'>/</span>
        <span class="emj" style='margin-left: 10px;'>&#128233;</span>
    </div>
</div>

</div>

        </div>
    </div>
</section>


<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    fetch('get_data.php')
    .then(response => response.json())
    .then(data => {
        const formattedData = [['Name', 'Count']].concat(data);
        const dataTable = google.visualization.arrayToDataTable(formattedData);

        const options = {
            title:'',
            colors: ['#FF5733', '#33FF57'],
            legend: {
                textStyle: {
                    fontName: 'Poetsen One', 
                    fontSize: 15,            
                    color: 'black'           
                }
            },
        };

        const chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(dataTable, options);
    })
    .catch(error => console.error('Error fetching data:', error));
}
</script>
</body>
</html>
