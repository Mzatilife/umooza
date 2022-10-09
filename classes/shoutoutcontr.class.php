<?php

class ShoutoutContr extends Shoutout
{
    // This function manages the registration data ---------------------------------------------------->
    public function submitShoutout($prop_id, $name, $phone, $email, $shoutout)
    {
        return $this->submitsShoutout($prop_id, $name, $phone, $email, $shoutout);
    }

    // This function manages the counting of shoutouts ---------------------------------------------------->
    public function countShoutout($prop_id)
    {
        return $this->countsShoutout($prop_id);
    }

    // This function manages the viewing of shoutouts ---------------------------------------------------->
    public function viewShoutout($prop_id)
    {
        return $this->viewsShoutout($prop_id);
    }

    // This function manages the viewing of shoutouts ---------------------------------------------------->
    // public function viewWinningShoutout($prop_id)
    // {
    //     return $this->viewsWinningShoutout($prop_id);
    // }

    // This function manages the editing of shoutouts ---------------------------------------------------->
    // public function editShoutoutStatus($id)
    // {
    //     return $this->editsShoutoutStatus($id);
    // }
}
