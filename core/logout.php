<?php
session_start();
unset($_SESSION['applicant_id']);
header("Location: ../login.php");
?>