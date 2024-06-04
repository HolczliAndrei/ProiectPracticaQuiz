<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Online Quiz System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css1/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .logout {
            position: absolute;
            top: 0;
            right: 20px;
            margin: 10px;

            
         
            
           
            border: none;
           
            padding: 15px 30px;
           
        }
    </style>
</head>

<body>

<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 text-center">
                <ul class="breadcome-menu" style="list-style-type: none;">
                    <li><div id="countdowntimer" style="display: block; font-size: 35px;"></div></li>
                </ul>
            </div>
            <div class="logout">
                <form action="logout.php">
                <button type="submit" class="logout" style="background-color: white; color: black;">Log out</button>

                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        setInterval(function(){
            timer();
        },1000);
        function timer()
        {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    if(xmlhttp.responseText=="00:00:01")
                    {
                        window.location="result.php";
                    }

                    document.getElementById("countdowntimer").innerHTML=xmlhttp.responseText;

                }
            };
            xmlhttp.open("GET","forajax/load_timer.php",true);
            xmlhttp.send(null);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
