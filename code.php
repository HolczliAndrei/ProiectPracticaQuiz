<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    include 'connect.php';
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sqlAdmin = "SELECT * FROM `admin` WHERE username='$username' AND password='$password'";
        $resultAdmin = mysqli_query($con, $sqlAdmin);

        if (mysqli_num_rows($resultAdmin) > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = 'admin';  
            header('Location: admin.php?username=' . $username);
            exit();
        } else {
            $sqlRegistration = "SELECT * FROM `registration` WHERE username='$username' AND password='$password'";
            $resultRegistration = mysqli_query($con, $sqlRegistration);
            
            if (mysqli_num_rows($resultRegistration) > 0) {
                $_SESSION['username'] = $username;
                $_SESSION['user_role'] = 'user';  
                header('Location: select_exam.php?username=' . $username);
                exit();
            } else {
                $_SESSION['message'] = 'Incorrect username or password!';
                
                header('Location: login.php');
                exit();
            }
        }
    } else {
        $_SESSION['message'] = 'Please enter username and password!';
        
        header('Location: login.php');
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    include 'connect.php';
    
    if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['confirm_password'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

        $check_email_query = "SELECT * FROM `registration` WHERE email='$email'";
        $check_email_result = mysqli_query($con, $check_email_query);

        if ($check_email_result && mysqli_num_rows($check_email_result) > 0) {
            $_SESSION['message'] = "Email address already exists!";
            header('Location: sign.php');
            exit();
        } else {
            $insert_user_query = "INSERT INTO `registration` (username, password, email) VALUES ('$username', '$password', '$email')";
            $insert_user_result = mysqli_query($con, $insert_user_query);
            if ($insert_user_result) {
                $_SESSION['username'] = $username;
                $_SESSION['user_role'] = 'user';
                header('Location: home.php');
                exit();
            }
        }
    } else {
        $_SESSION['message'] = "Please fill in all the fields!";
        header('Location: sign.php');
        exit();
    }
} elseif (isset($_POST["create_quiz"])) {
    include 'connect.php';

    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $username = $_SESSION['username'];
    
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
        $validImageExtension = ['jpg', 'jpeg', 'png'];  
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            $_SESSION['messagebad'] = "Invalid image extension!";
            header('Location: create-quiz.php?username=' . urlencode($username));
            exit();
        } elseif ($fileSize > 100000) { 
            $_SESSION['messagebad'] = "Invalid image size!";
            header('Location: create-quiz.php?username=' . urlencode($username));
            exit();
        }
        $picture = uniqid() . '.' . $imageExtension;

        // Calea unde va fi salvată imaginea încărcată
        $targetPath = "uploads/" . $picture;

        // Mută fișierul încărcat în locația dorită
        if (!move_uploaded_file($tmpName, $targetPath)) {
            $_SESSION['messagebad'] = "Error uploading image!";
            header('Location: create-quiz.php?username=' . urlencode($username));
            exit();
        }
    }

    $query = "INSERT INTO `quizez` (name, description, picture) VALUES ('$name', '$description', '$picture')";
    if (mysqli_query($con, $query)) {
        $quiz_id = mysqli_insert_id($con);
        $_SESSION['messagegood'] = "Quiz created successfully!";
        header("Location: edit-quiz.php?username=$username&quiz_id=$quiz_id");
        exit();
    } else {
        $_SESSION['messagebad'] = "Error: " . mysqli_error($con);
        header('Location: create-quiz.php');
        exit();
    }
} elseif (isset($_POST["submitquestion"])) {
    include 'connect.php';
    if (!isset($_SESSION['question_number'])) {
        $_SESSION['question_number'] = 1;
    }
    $question_text = mysqli_real_escape_string($con, $_POST["question"]);
    $quiz_id = mysqli_real_escape_string($con, $_POST["quiz_id"]);
    $correct_answer = mysqli_real_escape_string($con, $_POST["correct"]);
    $wrong_answers = $_POST["wrong"]; 

    $insert_question_query = "INSERT INTO questions (question_text, question_no, quiz_id) VALUES ('$question_text', '$_SESSION[question_number]','$quiz_id')";
    $_SESSION['question_number']++;

    if (mysqli_query($con, $insert_question_query)) {
        $question_id = mysqli_insert_id($con);

        $insert_correct_answer_query = "INSERT INTO answers (question_id, quiz_id, correct, answer_text) VALUES ('$question_id', '$quiz_id', 1, '$correct_answer')";
        mysqli_query($con, $insert_correct_answer_query);

        foreach ($wrong_answers as $wrong_answer) {
            $escaped_wrong_answer = mysqli_real_escape_string($con, $wrong_answer);
            $insert_wrong_answer_query = "INSERT INTO answers (question_id, quiz_id, correct, answer_text) VALUES ('$question_id', '$quiz_id', 0, '$wrong_answer')";
            mysqli_query($con, $insert_wrong_answer_query);
        }

        $_SESSION['messagegood'] = "Error: " . mysqli_error($con);
        header("Location: edit-quiz.php?username={$_SESSION['username']}&quiz_id=$quiz_id");

        exit();
    } else {
        $_SESSION['messagebad'] = "Error: " . mysqli_error($con);
        header("Location: edit-quiz.php?username={$_SESSION['username']}&quiz_id=$quiz_id");

        exit();
    }

} elseif (isset($_POST['delete_student'])) {
    include 'connect.php';

    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $delete_query = "DELETE FROM `registration` WHERE id='$student_id'";
    $delete_query_run = mysqli_query($con, $delete_query);
    $username = mysqli_real_escape_string($con, $_SESSION['username']);
    if ($delete_query_run) {
        $_SESSION['messagegood'] = "Student record deleted successfully!";
        header('Location: edit-list.php?username=' . urlencode($username));
        exit();
    } else {
        $_SESSION['messagebad'] = "Failed to delete student record!";
        header('Location:edit-list.php?username=' . urlencode($username));
        exit();
    }
}elseif(isset($_POST['logout'])){
    include 'connect.php';
    session_destroy();
} elseif(isset($_POST['finishquiz'])) {
    unset($_SESSION['question_number']);
    header('Location: admin.php?username=' . urlencode($_SESSION['username']));
    exit();
}
else{
    header('Location: login.php');
    exit();
}

mysqli_close($con);
?>
