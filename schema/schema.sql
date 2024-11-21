CREATE TABLE applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_id INT,
    subject_expertise VARCHAR(128),
    experience_in_months INT,
    date_applied TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE applicants (
    applicant_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(64),
    last_name VARCHAR(64),
    age INT,
    birthdate DATE,
    gender VARCHAR(64),
    religion VARCHAR(64),
    email_address VARCHAR(256),
    home_address VARCHAR(512)
);

CREATE TABLE applicants_account (
    applicant_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(64),
    user_password VARCHAR(128)
);

CREATE TABLE activity_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    log_desc VARCHAR(128),
    application_id INT,
    applicant_id INT,
    done_by INT,
    date_logged TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
    