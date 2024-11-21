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
        <h2>Teacher Job Application Submission Page</h2>

        <input type="submit" value="Return to homepage" onclick="window.location.href='index.php'">
        <br><br>

        <table>
            <tr>
                <th colspan="12", style="font-size: 18px;">Your profile</th>
            </tr>

            <tr>
                <th>Applicant ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Religion</th>
                <th>Email Address</th>
                <th>Home Address</th>
            </tr>

            <?php $applicantData = getApplicantByID($pdo, $_SESSION['applicant_id'])['querySet']; ?>
            <tr>
                <td><?php echo $_SESSION['applicant_id']?></td>
                <td><?php echo $applicantData['first_name'] . ' ' . $applicantData['last_name']?></td>
                <td><?php echo $applicantData['age']?></td>
                <td><?php echo $applicantData['birthdate']?></td>
                <td><?php echo $applicantData['gender']?></td>
                <td><?php echo $applicantData['religion']?></td>
                <td><?php echo $applicantData['email_address']?></td>
                <td><?php echo $applicantData['home_address']?></td>
            </tr>
        </table>

        <b>Your profile will be added along with your application. You may edit it in the homepage.</b>

        <hr style="width: 99%; height: 2px; color: black; background-color: black;">

        <form action="core/handleForms.php" method="POST">
            <label for="subject_expertise">Subject Expertise</label>
            <input type="text" name="subject_expertise" required>
            <br>

            <label for="experience_in_months">Experience (in months)</label>
            <input type="number" name="experience_in_months" min="0" required>
            <br>

            <input type="submit" name="submitApplicationButton" value="Submit application">
        </form>
    </body>
</html>