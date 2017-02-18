<?php
ini_set('session.cookie_httponly', 1);
session_start();

/* check if AJAX request  */
if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {

    $errors = array();      //array that will contain the errors if any
    $success = false;       //whether the ajax post and user signing in are successful. Initial assumption is false

    /*
     * Unserialize the form data via parse_str() function
     */
    $formData = array();
    parse_str($_POST["formData"], $formData);

    if(isset($_SESSION["token"]) && $_SESSION["token"] === $formData["_token"])  //if tokens match
    {

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
         * Check if the user exists in database, if so check the password and if match log in the user
         */
        $check_user = $db->prepare("SELECT * FROM users WHERE username = :username OR email = :username");
        $check_user->execute(array(
           ":username" => $formData["username"]
        ));
        if($check_user->rowCount() > 0)
        {
            $user = $check_user->fetch();
            if(password_verify($formData["password"], $user["password"]))
            {
                /*
                 * Log in the user
                 */
                $_SESSION["user"] = array(
                    "id" => $user["id"],
                    "name" => $user["name"],
                    "email" => $user["email"],
                    "username" => $user["username"],
                    "password" => $user["password"]
                );
                if(isset($formData["remember_me"]))
                {
                    setcookie("ajax_login_user", json_encode($_SESSION["user"]), time() + 86400, "/");
                }
                $success = true;
            }
        }  else $errors[] = "Incorrect username/password.";
    }
    echo json_encode(array("errors" => $errors, "success" => $success));
}
