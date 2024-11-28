<?php 
require_once "core/dbConfig.php";
require_once "core/functions.php";

if(!isset($_SESSION['applicant_id'])) {
    header("Location: login.php");
}
?>

<html>
    <head>
        <title>Teacher Job Application</title>
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <h2>Teacher Job Application</h2>

        <?php if (isset($_SESSION['message'])) { ?>
            <h3 style="color: red;">	
                <?php echo $_SESSION['message']; ?>
            </h3>
	    <?php } unset($_SESSION['message']); ?>

        <input type="submit" value="Return to Homepage" onclick="window.location.href='index.php';">
        <br>

        <table>
            <tr>
                <th colspan="6", style="font-size: 18px;">Activity Logs</th>
            </tr>

            <tr>
                <th>Log ID</th>
                <th>Description</th>
                <th>Application ID</th>
                <th>Applicant ID</th>
                <th>Done By</th>
                <th>Date Logged</th>
            </tr>

            <?php
            $activityLogsData = getAllActivityLogs($pdo)['querySet'];
            foreach($activityLogsData as $row) {
                $applicantData = getApplicantByID($pdo, $row['applicant_id'])['querySet'];
                $done_byApplicantData = getApplicantByID($pdo, $row['done_by'])['querySet'];
            ?>
                <tr>
                    <td><?php echo $row['log_id']?></td>
                    <td><?php echo $row['log_desc']?></td>
                    <td><?php echo $row['application_id']?></td>
                    <td><?php echo $row['applicant_id'] == FALSE ? "" : $row['applicant_id'] . " - " . $applicantData['first_name'] . " " . $applicantData['last_name']?></td>
                    <td><?php echo $row['done_by'] . " - " . $done_byApplicantData['first_name'] . " " . $done_byApplicantData['last_name']?></td>
                    <td><?php echo $row['date_logged']?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        
    </body>
</html>