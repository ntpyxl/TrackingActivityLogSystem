<?php 
require_once "core/dbConfig.php";
require_once "core/functions.php";
?>

<html>
    <head>
        <title>Teacher Job Application</title>
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <h2>Applicant Profile Editing Page</h2>

        <input type="submit" value="Return to homepage" onclick="window.location.href='index.php'">
        <br><br>

        <?php $applicantData = getApplicantByID($pdo, $_GET['applicant_id'])['querySet'] ?>

        <?php if (isset($_SESSION['message'])) { ?>
            <h3 style="color: red;">	
                <?php echo $_SESSION['message']; ?>
            </h3>
	    <?php } unset($_SESSION['message']); ?>

        <form action="core/handleForms.php?applicant_id=<?php echo $_GET['applicant_id']?>" method="POST">
            <label for="first_name">First name</label>
            <input type="text" name="first_name" value="<?php echo $applicantData['first_name']?>" required>

            <label for="last_name">Last name</label>
            <input type="text" name="last_name" value="<?php echo $applicantData['last_name']?>" required>
            <br>

            <label for="age">Age</label>
            <input type="number" name="age" min="0" value="<?php echo $applicantData['age']?>" required>

            <label for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" min="1900-01-01" value="<?php echo $applicantData['birthdate']?>" required>

            <label for="gender">Gender</label>
            <select name="gender">
                <option value="Male" <?php echo ($applicantData['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($applicantData['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                <option value="Gay" <?php echo ($applicantData['gender'] == 'Gay') ? 'selected' : ''; ?>>Gay</option>
                <option value="Lesbian" <?php echo ($applicantData['gender'] == 'Lesbian') ? 'selected' : ''; ?>>Lesbian</option>
                <option value="Transgender" <?php echo ($applicantData['gender'] == 'Transgender') ? 'selected' : ''; ?>>Transgender</option>
                <option value="Prefer Not To Say" <?php echo ($applicantData['gender'] == 'Prefer Not To Say') ? 'selected' : ''; ?>>Prefer Not To Say</option>
            </select>

            <label for="religion">Religion</label>
            <select name="religion">
                <option value="Catholic" <?php echo ($applicantData['religion'] == 'Catholic') ? 'selected' : ''; ?>>Catholic</option>
                <option value="Islam" <?php echo ($applicantData['religion'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                <option value="Buddhism" <?php echo ($applicantData['religion'] == 'Buddhism') ? 'selected' : ''; ?>>Buddhism</option>
                <option value="INC" <?php echo ($applicantData['religion'] == 'INC') ? 'selected' : ''; ?>>INC</option>
                <option value="None" <?php echo ($applicantData['religion'] == 'None') ? 'selected' : ''; ?>>None</option>
            </select>
            <br>

            <label for="email_address">Email Address</label>
            <input type="text" name="email_address" value="<?php echo $applicantData['email_address']?>" required>
            <br>

            <label for="home_address">Home Address</label>
            <input type="text" name="home_address" value="<?php echo $applicantData['home_address']?>" required>
            <br>

            <input type="submit" name="editApplicantButton" value="Edit profile">
        </form>
    </body>
</html>