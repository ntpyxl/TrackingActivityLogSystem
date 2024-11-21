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

        <input type="submit" value="Submit an application" onclick="window.location.href='submitApplication.php';">
        <input type="submit" value="Edit your profile" onclick="window.location.href='editProfile.php?applicant_id=<?php echo $_SESSION['applicant_id']?>';">
        <input type="submit" value="View system logs" onclick="window.location.href='viewLogs.php';">
        <input type="submit" value="Logout" onclick="window.location.href='core/logout.php';">
        <br>

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
        
        <hr style="width: 99%; height: 2px; color: black; background-color: black;">

        <div style="display: flex; align-items: center;">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                <label for="searchBar">Search</label>
                <input type="text" name="searchBar">
                <input type="submit" name="searchButton" value="Search application">
            </form>
            <input type="submit" name="clearButton" value="Clear search query" onclick="window.location.href='index.php'">
        </div>

        <table name="applicantsTable">
            <tr>
                <th colspan="13", style="font-size: 18px;">Teacher Job Applications</th>
            </tr>

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
                <th>Actions</th>
            </tr>

            <?php
            if(isset($_GET['searchButton'])) {
                $searchedApplicationsData = searchForApplication($pdo, $_GET['searchBar'])['querySet'];
                foreach($searchedApplicationsData as $row) {
                    $local_applicantData = getApplicantByID($pdo, $row['applicant_id'])['querySet'];
            ?>
                    <tr>
                        <td><?php echo $row['application_id']?></td>
                        <td><?php echo $local_applicantData['first_name'] . ' ' . $local_applicantData['last_name']?></td>
                        <td><?php echo $local_applicantData['age']?></td>
                        <td><?php echo $local_applicantData['birthdate']?></td>
                        <td><?php echo $local_applicantData['gender']?></td>
                        <td><?php echo $local_applicantData['religion']?></td>
                        <td><?php echo $local_applicantData['email_address']?></td>
                        <td><?php echo $local_applicantData['home_address']?></td>
                        <td><?php echo $row['subject_expertise']?></td>
                        <td><?php echo $row['experience_in_months']?></td>
                        <td><?php echo $row['date_applied']?></td>
                        <td><?php echo $row['last_updated']?></td>
                        <td>
                            // SHOULD NOT BE ABLE TO EDIT AND DELETE IF THIS IS NOT YOUR APPLICATION
                            <input type="submit" value="EDIT" onclick="window.location.href='editApplication.php?application_id=<?php echo $row['application_id']; ?>';">
                            <input type="submit" value="DELETE" onclick="window.location.href='deleteApplication.php?application_id=<?php echo $row['application_id']; ?>';">
                        </td>
                    </tr>
            <?php 
                }
            } else {
                $applicationsData = getAllApplications($pdo)['querySet'];
                foreach($applicationsData as $row) {
                    $local_applicantData = getApplicantByID($pdo, $row['applicant_id'])['querySet'];
            ?>
                <tr>
                    <td><?php echo $row['application_id']?></td>
                    <td><?php echo $local_applicantData['first_name'] . ' ' . $local_applicantData['last_name']?></td>
                    <td><?php echo $local_applicantData['age']?></td>
                    <td><?php echo $local_applicantData['birthdate']?></td>
                    <td><?php echo $local_applicantData['gender']?></td>
                    <td><?php echo $local_applicantData['religion']?></td>
                    <td><?php echo $local_applicantData['email_address']?></td>
                    <td><?php echo $local_applicantData['home_address']?></td>
                    <td><?php echo $row['subject_expertise']?></td>
                    <td><?php echo $row['experience_in_months']?></td>
                    <td><?php echo $row['date_applied']?></td>
                    <td><?php echo $row['last_updated']?></td>
                    <td>
                        // SHOULD NOT BE ABLE TO EDIT AND DELETE IF THIS IS NOT YOUR APPLICATION
                        <input type="submit" value="EDIT" onclick="window.location.href='editApplication.php?application_id=<?php echo $row['application_id']; ?>';">
                        <input type="submit" value="DELETE" onclick="window.location.href='deleteApplication.php?application_id=<?php echo $row['application_id']; ?>';">
                    </td>
                </tr>
            <?php 
                }
            }
            ?>
        </table>
    </body>
</html>