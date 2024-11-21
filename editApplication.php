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

        <?php $applicationData = getApplicationByID($pdo, $_GET['application_id'])['querySet'] ?>

        <?php if (isset($_SESSION['message'])) { ?>
            <h3 style="color: red;">	
                <?php echo $_SESSION['message']; ?>
            </h3>
	    <?php } unset($_SESSION['message']); ?>

        <form action="core/handleForms.php?application_id=<?php echo $_GET['application_id']?>" method="POST">
            <label for="subject_expertise">Subject Expertise</label>
            <input type="text" name="subject_expertise" value="<?php echo $applicationData['subject_expertise']?>"required>
            <br>

            <label for="experience_in_months">Experience (in months)</label>
            <input type="number" name="experience_in_months" min="0" value="<?php echo $applicationData['experience_in_months']?>" required>
            <br>

            <input type="submit" name="editApplicationButton" value="Edit application">
        </form>
    </body>
</html>