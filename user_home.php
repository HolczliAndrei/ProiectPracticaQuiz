<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Document</title>
    <link href = "user_home.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="row">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "proiectquiz";

            $con = new mysqli($servername, $username, $password, $dbname);
            if($con -> connect_error){
                die("Conexiune esuata: " . $con -> connect_error);
            }

            $sql = "SELECT * FROM quizzes";
            $results = $con -> query($sql);
            if($results->num_rows > 0){
                while($row = $results->fetch_assoc()){
                    echo '
                        <div class="col-12 col-md-6 col-lg-4 mb-1">
                            <div class="card w-60">
                                <img src="imagini/'.$row['imagine'].'" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row['nume'].'</h5>
                                    <p class="card-text">'.$row['categorie'].'</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>';
                }
            }
            ?>
            </div>
        </div>
</body>
</html>

