<?php
class Shoutout extends dbh
{
    protected function submitsShoutout($prop_id, $name, $phone, $email, $shoutout)
    {
        $sql1 = "SELECT * FROM `shoutouts` WHERE `prop_id` = ? AND `email`= ?";
        $stmt1 = $this->connect()->prepare($sql1);
        $stmt1->execute([$prop_id, $email]);

        //checking if the email and username are unavailable ----------------------------------------------------->
        if ($stmt1->rowCount() > 0) {
            return 1;
        } else {
            $sql = "INSERT INTO shoutouts (`prop_id`, `user_name`, `phone`, `email`, `shoutout`, `status`, `date`) VALUES (?, ?, ?, ?, ?, 0, NOW())";
            $stmt = $this->connect()->prepare($sql);
            $result = $stmt->execute([$prop_id, $name, $phone, $email, $shoutout]);

            if ($result) {
                return 2;
            } else {
                return 0;
            }
        }
    }

    // FUNCTION TO COUNT SHOUTOUTS ****************************************************************************>
    protected function countsShoutout($prop_id)
    {
        $sql = "SELECT * FROM `shoutouts` WHERE `prop_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$prop_id]);
        return $stmt->rowCount();
    }

    // FUNCTION TO COUNT SHOUTOUTS ****************************************************************************>
    protected function viewsShoutout($prop_id)
    {
        $sql = "SELECT * FROM `shoutouts` WHERE `prop_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$prop_id]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO EDIT SHOUTOUT STATUS ****************************************************************************>
    // protected function editsShoutoutStatus($id)
    // {
    //     $sql = "UPDATE `shoutouts` SET `status` = ? WHERE `shoutout_id` = ? ";
    //     $stmt = $this->connect()->prepare($sql);
    //     return $stmt->execute([1, $id]);
    // }

    // FUNCTION TO VIEW WINNING SHOUTOUT ****************************************************************************>
    // protected function viewsWinningShoutout($prop_id)
    // {
    //     $sql = "SELECT * FROM `shoutouts` WHERE `prop_id` = ? AND `status` = ?";
    //     $stmt = $this->connect()->prepare($sql);
    //     $stmt->execute([$prop_id, 1]);
    //     return $stmt->fetch();
    // }
}
