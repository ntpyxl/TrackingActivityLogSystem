<?php
require_once "dbConfig.php";
require_once "abstractFunctions.php";

function addApplicant($pdo, $username, $password, $confirm_passwrd, $hashed_password, $first_name, $last_name, $age, $birthdate, $gender, $religion, $email_address, $home_address) {
    $response = array();
    if(checkUsernameExistence($pdo, $username)) {
        $response = array(
            "statusCode" => "400",
            "message" => "Username already exists!"
        );
        return $response;
    }
    if($password != $confirm_passwrd) {
        $response = array(
            "statusCode" => "400",
            "message" => "Password does not match!"
        );
        return $response;
    }
    if(!validatePassword($password)) {
        $response = array(
            "statusCode" => "400",
            "message" => "Password is invalid! Make sure it is 8 characters long, has both upper and lowercase letters, and has a number!" . $password
        );
        return $response;
    }

	$query1 = "INSERT INTO applicants_account (username, user_password) VALUES (?, ?)";
	$statement1 = $pdo -> prepare($query1);
	$executeQuery1 = $statement1 -> execute([$username, $hashed_password]);

    $query2 = "INSERT INTO applicants (first_name, last_name, age, birthdate, gender, religion, email_address, home_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement2 = $pdo -> prepare($query2);
	$executeQuery2 = $statement2 -> execute([$first_name, $last_name, $age, $birthdate, $gender, $religion, $email_address, $home_address]);
    
    if ($executeQuery1 && $executeQuery2) {
		$response = array(
            "statusCode" => "200",
            "message" => "Successfully registered applicant!"
        );
	} else {
        $response = array(
            "statusCode" => "400",
            "message" => "Something else went wrong.."
        );
    }
    return $response;
}

function editApplicant($pdo, $first_name, $last_name, $age, $birthdate, $gender, $religion, $email_address, $home_address, $applicant_id) {
    $response = array();
    $query = "UPDATE applicants
            SET first_name = ?,
                last_name = ?,
                age = ?,
                birthdate = ?,
                gender = ?,
                religion = ?,
                email_address = ?,
                home_address = ?
            WHERE applicant_id = ?";
    
    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([$first_name, $last_name, $age, $birthdate, $gender, $religion, $email_address, $home_address, $applicant_id]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "message" => "Applicant " . $applicant_id . "'s profile edited successfully!"
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to edit Applicant " . $applicant_id . "'s profile!"
        );
    }
    return $response;
}

function loginApplicant($pdo, $username, $password) {
    $response = array();
    if(!checkUsernameExistence($pdo, $username)) {
		$response = array(
            "statusCode" => "400",
            "message" => "Username does not exist!"
        );
        return $response;
	}

	$query = "SELECT * FROM applicants_account WHERE username = ?";
	$statement = $pdo -> prepare($query);
	$statement -> execute([$username]);
	$applicantAccountData = $statement -> fetch();

	if(password_verify($password, $applicantAccountData['user_password'])) {
		$_SESSION['applicant_id'] = $applicantAccountData['applicant_id'];
		$response = array(
            "statusCode" => "200",
            "message" => "Successfully logged in!"
        );
        return $response;
	} else {
		$response = array(
            "statusCode" => "400",
            "message" => "Incorrect password"
        );
        return $response;
	}
}

function getApplicantByID($pdo, $applicant_id) {
    $query = "SELECT * FROM applicants WHERE applicant_id = ?";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([$applicant_id]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "querySet" => $statement -> fetch()
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to get applicant " . $applicant_id . "!"
        );
    }
    return $response;
}

function addApplication($pdo, $applicant_id, $subject_expertise, $experience_in_months) {
    $response = array();
    $query = "INSERT INTO applications (applicant_id, subject_expertise, experience_in_months) VALUEs (?, ?, ?)";
    
    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([$applicant_id, $subject_expertise, $experience_in_months]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "message" => "Application submitted successfully!"
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to submit application!"
        );
    }
    return $response;
}

function editApplicationByID($pdo, $subject_expertise, $experience_in_months, $application_id) {
    $response = array();
    $query = "UPDATE applications
            SET subject_expertise = ?,
                experience_in_months = ?
            WHERE application_id = ?";
    
    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([$subject_expertise, $experience_in_months, $application_id]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "message" => "Application " . $application_id . " edited successfully!"
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to edit application " . $application_id . "!"
        );
    }
    return $response;
}

function getAllApplications($pdo) {
    $query = "SELECT * FROM applications";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute();

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "querySet" => $statement -> fetchAll()
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to get applications!"
        );
    }
    return $response;
}

function getApplicationByID($pdo, $application_id) {
    $query = "SELECT * FROM applications WHERE application_id = ?";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([$application_id]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "querySet" => $statement -> fetch()
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to get application " . $application_id . "!"
        );
    }
    return $response;
}

function searchForApplication($pdo, $searchQuery) {
    $query = "SELECT * FROM applications JOIN applicants ON applications.applicant_id = applicants.applicant_id
                WHERE CONCAT(first_name, last_name, age, birthdate, gender, religion, email_address, home_Address, experience_in_months)
                LIKE ?";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute(["%".$searchQuery."%"]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "querySet" => $statement -> fetchAll()
    );
        } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to search for applications!"
        );
    }
    return $response;
}

function deleteApplicationByID($pdo, $application_id) {
    $query = "DELETE FROM applications WHERE application_id = ?";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([$application_id]);

    if($executeQuery) {
        $response = array(
            "statusCode" => "200",
            "message" => "Application " . $application_id . " has been deleted!"
        );
    } else {
        $response = array(
            "statusCode" => "400",
            "message" => "Failed to delete application " . $application_id . "!"
        );
    }
    return $response;
}
?>