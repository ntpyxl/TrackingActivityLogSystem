<?php 
require_once "core/dbConfig.php";
require_once "core/functions.php";

if(isset($_SESSION['applicant_id'])) {
    header("Location: index.php");
}
?>

<html>
    <head>
        <title>Teacher Job Application</title>
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <h2>Welcome to the Teacher's Job Application website! Login to your account below!</h2>

        <?php if (isset($_SESSION['message'])) { ?>
            <h3 style="color: red;">	
                <?php echo $_SESSION['message']; ?>
            </h3>
	    <?php } unset($_SESSION['message']); ?>

        <form action="core/handleForms.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required> <br>
                
        <div style="display: flex; align-items: center;">
            <input type="submit" name="loginButton" value="Log in">
        </form>
            <input type="submit" name="registerButton" value="Register" onclick="window.location.href='register.php'">
        </div>
    </body>
</html>