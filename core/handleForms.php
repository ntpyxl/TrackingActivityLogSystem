<?php 
require_once "dbConfig.php";
require_once "functions.php";

if(isset($_POST['registerButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $email_address = $_POST['email_address'];
    $home_address = $_POST['home_address'];

    $function = addApplicant($pdo, $username, $password, $confirm_password, $hashed_password, $first_name, $last_name, $age, $birthdate, $gender, $religion, $email_address, $home_address);
    if($function['statusCode'] == "200") {
        $_SESSION['message'] = $function['message'];
        header('Location: ../login.php');
    } elseif($function['statusCode'] == "400") {
        $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../register.php');
    }
}

if(isset($_POST['loginButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $function = loginApplicant($pdo, $username, $password);
    if($function['statusCode'] == "200"){
        $_SESSION['message'] = $function['message'];
        header("Location: ../index.php");
    } elseif($function['statusCode'] == "400") {
        $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../login.php');
    }
}

if(isset($_POST['editApplicantButton'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $email_address = $_POST['email_address'];
    $home_address = $_POST['home_address'];
    $applicant_id = $_SESSION['applicant_id'];

    $function = editApplicant($pdo, $first_name, $last_name, $age, $birthdate, $gender, $religion, $email_address, $home_address, $applicant_id);
    if($function['statusCode'] == "200") {
        $_SESSION['message'] = $function['message'];
        header('Location: ../index.php');
    } elseif($function['statusCode'] == "400") {
        $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../index.php');
    }
}

if(isset($_POST['submitApplicationButton'])) {
    $applicant_id = $_SESSION['applicant_id'];
    $experience_in_months = $_POST['experience_in_months'];
    $subject_expertise = $_POST['subject_expertise'];

    $function = addApplication($pdo, $applicant_id, $subject_expertise, $experience_in_months);
    if($function['statusCode'] == "200") {
        $_SESSION['message'] = $function['message'];
        header('Location: ../index.php');
    } elseif($function['statusCode'] == "400") {
        $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../index.php');
    }
}

if(isset($_POST['editApplicationButton'])) {
    $subject_expertise = $_POST['subject_expertise'];
    $experience_in_months = $_POST['experience_in_months'];
    $application_id = $_GET['application_id'];

    $function = editApplicationByID($pdo, $subject_expertise, $experience_in_months, $application_id);
    if($function['statusCode'] == "200") {
        $_SESSION['message'] = $function['message'];
        header('Location: ../index.php');
    } elseif($function['statusCode'] == "400") {
        $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../index.php');
    }
}

if(isset($_POST['deleteApplicationButton'])) {
    $function = deleteApplicationByID($pdo, $_GET['application_id']);
    if($function['statusCode'] == "200") {
        $_SESSION['message'] = $function['message'];
        header('Location: ../index.php');
    } elseif($function['statusCode'] == "400") {
        $_SESSION['message'] = "Error " . $function['statusCode'] . ": " . $function['message'];
        header('Location: ../index.php');
    }
}
?>