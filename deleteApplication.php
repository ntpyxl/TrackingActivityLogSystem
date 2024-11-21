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
        <h2>Teacher Job Application Editing Page</h2>

        <input type="submit" value="Return to homepage" onclick="window.location.href='index.php'">
        <br><br>

        <?php if (isset($_SESSION['message'])) { ?>
            <h3 style="color: red;">	
                <?php echo $_SESSION['message']; ?>
            </h3>
	    <?php } unset($_SESSION['message']); ?>

        <h2 style="color: red;"> DELETE THIS APPLICATION? </h2>

        <table>
            <tr>
                <th>Application <br> ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Religion</th>
                <th>Email Address</th>
                <th>Home Address</th>
                <th>Subject Expertise</th>
                <th>Experience <br> (months)</th>
                <th>Date Applied</th>
                <th>Last Updated</th>
            </tr>

            <?php
            $applicationData = getApplicationByID($pdo, $_GET['application_id'])['querySet'];
            $local_applicantData = getApplicantByID($pdo, $applicationData['applicant_id'])['querySet'];
            ?>
            <tr>
                <td><?php echo $applicationData['application_id']?></td>
                <td><?php echo $local_applicantData['first_name'] . ' ' . $local_applicantData['last_name']?></td>
                <td><?php echo $local_applicantData['age']?></td>
                <td><?php echo $local_applicantData['birthdate']?></td>
                <td><?php echo $local_applicantData['gender']?></td>
                <td><?php echo $local_applicantData['religion']?></td>
                <td><?php echo $local_applicantData['email_address']?></td>
                <td><?php echo $local_applicantData['home_address']?></td>
                <td><?php echo $applicationData['subject_expertise']?></td>
                <td><?php echo $applicationData['experience_in_months']?></td>
                <td><?php echo $applicationData['date_applied']?></td>
                <td><?php echo $applicationData['last_updated']?></td>
            </tr>
        </table>

        <form action="core/handleForms.php?application_id=<?php echo $_GET['application_id']; ?>" method="POST">
            <input type="submit" name="deleteApplicationButton" value="Delete application">
        </form>
    </body>
</html>