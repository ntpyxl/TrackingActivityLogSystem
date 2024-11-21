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
        <h2>Welcome to the Teacher's Job Application website! Register your account below to start applying!</h2>

        <?php if (isset($_SESSION['message'])) { ?>
            <h3 style="color: red;">	
                <?php echo $_SESSION['message']; ?>
            </h3>
	    <?php } unset($_SESSION['message']); ?>

        <?php if (isset($_SESSION['message'])) { ?>
		    <h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	    <?php } unset($_SESSION['message']); ?>

        <form action="core/handleForms.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required> 
            
            <label for="confirm_password">Confirm password</label>
            <input type="password" name="confirm_password" required> <br><br>

            <hr style="width: 99%; height: 2px; color: black; background-color: black;">

            <label for="first_name">First name</label>
            <input type="text" name="first_name" id="first_name" required>

            <label for="last_name">Last name</label>
            <input type="text" name="last_name" id="last_name" required> <br>

            <label for="age">Age</label>
            <input type="number" name="age" id="age" min="0" required>

            <label for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate" min="1970-01-01" max="2024-12-31" required>

            <label for="gender">Gender</label>
            <select name="gender" id="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Gay">Gay</option>
                <option value="Lesbian">Lesbian</option>
                <option value="Transgender">Transgender</option>
                <option value="Prefer Not To Say">Prefer Not To Say</option>
            </select>

            <label for="religion">Religion:</label>
            <select name="religion" id="religion">
                <option value="Catholic">Catholic</option>
                <option value="Islam">Islam</option>
                <option value="Buddhism">Buddhism</option>
                <option value="INC">INC</option>
                <option value="None">None</option>
            </select> <br>

            <label for="email_address">Email Address</label>
            <input type="email" name="email_address" id="email_address" required> <br>

            <label for="home_address">Home Address</label>
            <input type="text" name="home_address" id="home_address" required> <br>

        <div style="display: flex; align-items: center;">
            <input type="submit" name="registerButton" value="Register account">
        </form>
            <input type="submit" name="returnButton" value="Return to login" onclick="window.location.href='login.php'">
        </div>
    </body>
</html>