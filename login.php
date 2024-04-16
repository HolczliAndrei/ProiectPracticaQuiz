<?php
$login = 0;
$invalid = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sqlAdmin = "SELECT * FROM `admin` WHERE username='$username' AND password='$password'";
        $resultAdmin = mysqli_query($con, $sqlAdmin);
        
        if(mysqli_num_rows($resultAdmin) > 0) {
            $login = 1;
            session_start();
            $_SESSION['username'] = $username;
            header('location: admin.php');
            exit();
        } else {
            $sqlRegistration = "SELECT * FROM `registration` WHERE username='$username' AND password='$password'";
            $resultRegistration = mysqli_query($con, $sqlRegistration);

            if(mysqli_num_rows($resultRegistration) > 0) {
                $login = 1;
                session_start();
                $_SESSION['username'] = $username;
                header('location: home.php');
                exit();
            } else {
                $invalid = 1;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php
if($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}
?>
<?php
if($invalid) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> Incorrect name or password!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}
?>
<section class="vh-60">
  <div class="container py-5 h-70">
    <div class="row d-flex justify-content-center align-items-center h-90">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="b1.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;
                height:100%;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form action="" method="post">
                <div style="text-align: left;"><span class="mdi mdi-cube-outline cube" style=" font-size: 6rem;color: #BF5252;"></span>
</p>
                </div>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                  <div class="form-outline mb-4">
                    <input type="text" id="username" class="form-control form-control-lg" name="username">
                    <label class="form-label" for="username">Username</label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" id="password" class="form-control form-control-lg" name="password">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="sign.php"
                      style="color: #A5AF6E;">Register here</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
