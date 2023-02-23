<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}
require __DIR__ . '/Database.php';

class User extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function authenticateLogin($email, $password)
    {
        $result = array();

        $query = "select username, user_type, photo, first_name, middle_name, last_name, prefix, birthdate, age, sex, civil_status, other_status, birthplace, religion, email, contact_no, purok_name from users where username=? and password=sha2(?, 512)";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows === 1) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = null;
            }
        } else {
            $result = ['request_error' => 'Failed to process request.'];
        }
        $stmt->close();

        return $result;
    }
}
