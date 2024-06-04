<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('b2.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .result-container, .quiz-container {
            height: 500px;
            width: 800px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            
        }

        * {
            font-family: "Poetsen One", sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 3vh;
        }

        .quiz-button {
            height: 200px;
            width: 200px;
            margin-top: 10px;
            margin-right: 10px;
            background-color: #7b73ac;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-size: 18px;
        }

        .quiz-button:hover {
            background-color: #45a049;
        }

        .pagination-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            position: fixed;
            bottom: 20px;
            left: 0;
            padding: 0 50px;
            box-sizing: border-box;
        }

        .pagination-button {
            background-color: #7b73ac;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-size: 18px;
            
        }

        .pagination-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION["username"])) {
        ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
        <?php
    }
    ?>
    <?php
    include "connect.php";
    include "header.php";
    ?>
    <div class="quiz-container" id="quizContainer">
        <?php
        $questionsPerPage = 6;
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($currentPage - 1) * $questionsPerPage;
        $query = "SELECT * FROM quizez LIMIT $offset, $questionsPerPage";
        $res = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<input type="button" class="quiz-button" value="' . $row["name"] . '" onclick="set_exam_type_session(this.value);">';
        }
        ?>
    </div>
    <div class="pagination-container">
        <?php
        $totalQuizzesQuery = "SELECT COUNT(*) as total FROM quizez";
        $totalQuizzesResult = mysqli_query($con, $totalQuizzesQuery);
        $totalQuizzesRow = mysqli_fetch_assoc($totalQuizzesResult);
        $totalQuizzes = $totalQuizzesRow['total'];
        $totalPages = ceil($totalQuizzes / $questionsPerPage);

        if ($currentPage > 1) {
            echo '<a href="?page=' . ($currentPage - 1) . '" class="pagination-button previous-button">Previous</a>';
        }

        if ($currentPage < $totalPages) {
            echo '<a href="?page=' . ($currentPage + 1) . '" class="pagination-button next-button">Next</a>';
        }
        ?>
    </div>
    <script type="text/javascript">
        function set_exam_type_session(exam_category) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    window.location = "dashboard.php";
                }
            };
            xmlhttp.open("GET", "forajax/set_exam_type_session.php?exam_category=" + exam_category, true);
            xmlhttp.send(null);
        }
    </script>
</body>
