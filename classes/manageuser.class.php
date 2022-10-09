<?php
class ManageUser extends Dbh
{
    // FUNCTION TO MANAGE THE USER REGISTRATION *********************************************************************>
    protected function registerUser($fname, $lname, $phone, $phone2, $email, $address, $image, $pwd, $type, $token)
    {

        $sql = "SELECT * FROM `users` WHERE `email` = ? AND `user_type`= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $type]);

        //checking if the email and username are unavailable ----------------------------------------------------->
        if ($stmt->rowCount() > 0) {
            return $errorMsg[] = "Error, email is already registered!";
        } else {

            //adding the user data into the database ----------------------------------------------------------------->

            $sql1 = "INSERT INTO users (`first_name`, `last_name`, `phone`, `phone_2`, `email`, `address`, `national_id`, `password`, `user_type`, `reg_date`, `user_status`, `validation_key`, `is_active`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1, ?, 0)";
            $stmt1 = $this->connect()->prepare($sql1);
            $passwd = password_hash($pwd, PASSWORD_DEFAULT);

            $result = $stmt1->execute([$fname, $lname, $phone, $phone2, $email, $address, $image, $passwd, $type, $token]);

            //Checking if the data was uploaded ----------------------------------------------------------------------->

            if ($result) {
                $sql2 = "SELECT * FROM `users` WHERE `user_type` = ? AND `email` = ?";
                $stmt2 = $this->connect()->prepare($sql2);
                $stmt2->execute([$type, $email]);
                $row = $stmt2->fetch();

                if ($stmt2->rowCount() > 0) {
                    return $msg = "Please go to your email and verify it!";
                }
            } else {
                return $errorMsg[] = "Error, registration was not done!";
            }
        }
    }

    // FUNCTION TO MANAGE THE USER LOGIN ****************************************************************************>
    protected function loginUser($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            //checking if email was verified--------------------------------------------------------------------------->
            if ($row['is_active'] == 1) {
                //checking if the account is active ----------------------------------------------------------------------->
                if ($row['user_status'] == 1) {
                    //checking if the username is correct ----------------------------------------------------------------->
                    if ($email == $row['email']) {
                        //verifying the password --------------------------------------------------------------------------> 
                        if (password_verify($password, $row['password'])) {
                            session_start();
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['fname'] = $row['first_name'];
                            $user_type = $row['user_type'];
                            return header("location: ../$user_type/index.$user_type.php");
                        } else {
                            return $errorMsg[] = "incorrect password";
                        }
                    } else {
                        return $errorMsg[] = "incorrect email";
                    }
                } else {
                    return $errorMsg[] = "Your account is deactivated";
                }
            } else {
                return $errorMsg[] = "Email not verified";
            }
        } else {
            return $errorMsg[] = "incorrect email or password";
        }
    }

    // FUNCTION TO CHECK USER VERIFICATION ****************************************************************************>
    protected function checksActivation($email, $validation_key)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ? AND `validation_key` = ? AND `is_active` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $validation_key, 1]);
        return $stmt->rowCount();
    }

    // FUNCTION TO ACTIVATE USER ****************************************************************************>
    protected function userActivates($email, $validation_key)
    {
        $sql = "UPDATE users SET `is_active` = ? WHERE `email` = ? AND `validation_key` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([1, $email, $validation_key]);
    }

    // FUNCTION TO VIEW USER DETAILS ****************************************************************************>
    protected function viewUsers($st, $type1, $type2)
    {
        $sql = "SELECT * FROM users WHERE `is_active` = ? AND (user_type = ? OR user_type = ?) ORDER BY `user_id` DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $type1, $type2]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO EDIT USER STATUS ****************************************************************************>
    protected function editsStatus($user_id, $status)
    {
        $sql = "UPDATE users SET `user_status` = ? WHERE `user_id` = ? ";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$status, $user_id]);
    }

    // FUNCTION TO DELETE ***************************************************************************************>
    protected function deletesUser($user_id)
    {
        $sql1 = "SELECT * FROM users WHERE `user_id` = ? ";
        $stmt1 = $this->connect()->prepare($sql1);
        $stmt1->execute([$user_id]);
        $row = $stmt1->fetch();

        unlink("../uploads/nationalIDs/" . $row['national_id']);
        if ($row) {
            $sql = "DELETE FROM users WHERE `user_id` = ? ";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([$user_id]);
        } else {
            return $stmt1->execute([$user_id]);
        }
    }

    // FUNCTION TO COUNT USERS ****************************************************************************>
    protected function countsUsers($st1, $st2, $st3, $st4, $sta, $sta2)
    {
        $sql = "SELECT * FROM `users` WHERE (`user_status` = ? AND `is_active` = ?) AND (`user_type` = ? OR `user_type` = ? OR `user_type` = ? OR `user_type` = ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$sta, $sta2, $st1, $st2, $st3, $st4]);
        return $stmt->rowCount();
    }

    // FUNCTION TO VIEW USER DETAILS ****************************************************************************>
    protected function viewsUser($id)
    {
        $sql = "SELECT * FROM users WHERE `user_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // FUNCTION TO CHECK USER DETAILS ****************************************************************************>
    protected function checksUser($name, $email)
    {
        $sql = "SELECT * FROM `users` WHERE `first_name`=? and `email`=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $email]);
        $result = $stmt->rowCount();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO RESET PASSWORD *********************************************************************************>
    protected function resetsPassword($fname, $email, $password)
    {
        $pwd = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `password` = ? WHERE `first_name` = ? AND `email` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$pwd, $fname, $email]);

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
}
