<?php
session_start();

/* check if AJAX request  */
if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {

    $errors = array();     //array that will contain the errors if any
    $success = false;      //whether the ajax post and user creation are successful. Initial assumption is false

    /*
     * Unserialize the form data via parse_str() function
     */
    $formData = array();
    parse_str($_POST["formData"], $formData);

    if(isset($_SESSION["token"]) && $_SESSION["token"] === $formData["_token"])  //if tokens match
    {
        /*
         * Checking if posted fields are empty string (just in case) - e.g. user typing only whitespaces instead of actual name, email, username, password
         */
        if(trim($formData["name"]) == "")
        {
            $errors[] = "Name field can't be blank.";
        }
        if(trim($formData["email"]) == "")
        {
            $errors[] = "Email field can't be blank.";
        }
        if(!filter_var($formData["email"], FILTER_VALIDATE_EMAIL))
        {
            $errors[] = "Email must be a valid email address.";
        }
        if(trim($formData["username"]) == "")
        {
            $errors[] = "Username field can't be blank.";
        }
        if(trim($formData["password"]) == "")
        {
            $errors[] = "Password field can't be blank.";
        }

        require_once '../app/db.php';

        /*
         * If there is user already registered with submitted email or username
         */
        $check_if_user_exists = $db->prepare("SELECT id FROM users WHERE email = :email OR username = :username");
        $check_if_user_exists->execute(array(
            ":email" => $formData["email"],
            ":username" => $formData["username"]
        ));
        if($check_if_user_exists->rowCount() > 0)
        {
            $errors[] = "User with username " . $formData["username"] . " or email " . $formData["email"] . " already exists.";
        }

        /*
         * If no errors, create the user in database and sign in the user
         */
        if(empty($errors))
        {
            $hashed_password = password_hash($formData["password"], PASSWORD_DEFAULT);
            $create_user = $db->prepare("INSERT INTO users(name, email, username, password, created_at) VALUES(:name, :email, :username, :password, NOW())");
            $create_user->execute(array(
                ":name" => $formData["name"],
                ":email" => $formData["email"],
                ":username" => $formData["username"],
                ":password" => $hashed_password
            ));
            $user_id = $db->lastInsertId();
            $_SESSION["user"] = array(
              "id" => $user_id,
              "name" => $formData["name"],
              "email" => $formData["email"],
              "username" => $formData["username"],
              "password" => $hashed_password
            );
            $success = true;
        }
    }
    echo json_encode(array("errors" => $errors, "success" => $success));
}
