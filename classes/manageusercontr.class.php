<?php

class ManageUserContr extends ManageUser
{
    // This function manages the registration data ---------------------------------------------------->
    public function userRegistration($fname, $lname, $phone, $phone2, $email, $address, $image, $pwd, $type, $token)
    {
        return $this->registerUser($fname, $lname, $phone, $phone2, $email, $address, $image, $pwd, $type, $token);
    }
    //This function checks if the user is verified ------------------------------------------->
    public function checkActivation($email, $validation_key)
    {
        return $this->checksActivation($email, $validation_key);
    }
    //This function validates user -------------------------------------------------------------->
    public function userActivation($email, $validation_key)
    {
        return $this->userActivates($email, $validation_key);
    }
    //This function manages the login data ------------------------------------------------------------------------>
    public function userLogin($email, $password)
    {
        return $this->loginUser($email, $password);
    }
    //This function views the users in the system ------------------------------------------------------------------>
    public function viewsUsers($st, $type1, $type2)
    {
        return $this->viewUsers($st, $type1, $type2);
    }
    //This function edits the user status in the system ------------------------------------------------------------>
    public function editStatus($user_id, $status)
    {
        return $this->editsStatus($user_id, $status);
    }

    //This function deletes the user in the system ----------------------------------------------------------------->
    public function deleteUser($user_id)
    {
        return $this->deletesUser($user_id);
    }

    //This function counts the user in the system ------------------------------------------------------------------>
    public function countUsers($type, $type2, $type3, $type4, $sta, $sta2)
    {
        return $this->countsUsers($type, $type2, $type3, $type4, $sta, $sta2);
    }

    //This function views the user in the system ------------------------------------------------------------------>
    public function viewUser($user_id)
    {
        return $this->viewsUser($user_id);
    }

    //This function checks the user in the system ----------------------------------------------------------------->
    public function checkUser($name, $email)
    {
        return $this->checksUser($name, $email);
    }

    //Tis function resets the password --------------------------------------------------------------------------->
    public function resetPassword($fname, $email, $password)
    {
        return $this->resetsPassword($fname, $email, $password);
    }
}
