<?php
class ManagePropertyContr extends ManageProperty
{
    // This function manages the submission of property data ---------------------------------------------------->
    public function submitProperty($user_id, $type, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4)
    {
        return $this->submitsProperty($user_id, $type, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4);
    }

    // This function manages the submission of property data ---------------------------------------------------->
    public function editProperty($prop_id, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4)
    {
        return $this->editsProperty($prop_id, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4);
    }

    // This function views the property at the owner side --------------------------------------------------------->
    public function viewProperty($user_id, $st1, $st2, $st3, $st4, $st5)
    {
        return $this->viewsProperty($user_id, $st1, $st2, $st3, $st4, $st5);
    }

    // This function views the property at the owner side --------------------------------------------------------->
    public function viewForCoord($user_id, $type, $dist, $area)
    {
        return $this->viewsForCoord($user_id, $type, $dist, $area);
    }

    // This function views the property at the owner side --------------------------------------------------------->
    public function submitCoordinates($prop_id, $lat, $long)
    {
        return $this->submitsCoordinates($prop_id, $lat, $long);
    }

    // This function views the coordinates --------------------------------------------------------->
    public function viewCoordinates($prop_id)
    {
        return $this->viewsCoordinates($prop_id);
    }

    // This function views the property at the owner side --------------------------------------------------------->
    public function viewProperties($status, $status2, $type, $type2, $type3, $type4, $type5, $type6, $type7, $type8, $start, $end)
    {
        return $this->viewsProperties($status, $status2, $type, $type2, $type3, $type4, $type5, $type6, $type7, $type8, $start, $end);
    }

    public function searchProperties($status, $status2, $type, $district, $start, $end)
    {
        return $this->searchsProperties($status, $status2, $type, $district, $start, $end);
    }

    public function countSearchedProperties($status, $status2, $type, $district)
    {
        return $this->countsSearchedProperties($status, $status2, $type, $district);
    }

    // This function views the property at the owner side --------------------------------------------------------->
    // public function viewDIstinctProperties($status, $start, $end)
    // {
    //     return $this->viewsDistinctProperties($status, $start, $end);
    // }

    // This function views the property at the admin side --------------------------------------------------------->
    public function viewPropertyAdmin($st1, $st2, $st3, $st4, $st5)
    {
        return $this->viewsPropertyAdmin($st1, $st2, $st3, $st4, $st5);
    }

    // This function counts the property at the owner side --------------------------------------------------------->
    public function countOwnerProperty($user_id, $st1, $st2, $st3, $st4)
    {
        return $this->countsOwnerProperty($user_id, $st1, $st2, $st3, $st4);
    }

    // This function counts the property at the admin side --------------------------------------------------------->
    public function countAdminProperty($st1, $st2, $st3, $st4)
    {
        return $this->countsAdminProperty($st1, $st2, $st3, $st4);
    }

    // This function veiws single property --------------------------------------------------------->
    public function viewSingleProperty($id)
    {
        return $this->viewsSingleProperty($id);
    }

    // This function to check property status ---------------------------------------------------------------->
    public function checkProperty($id, $st)
    {
        return $this->checksProperty($id, $st);
    }

    // This function passes data to approve property ---------------------------------------------------------------->
    public function approveProperty($id, $st)
    {
        return $this->approvesProperty($id, $st);
    }

    // This function passes data to reject property ---------------------------------------------------------------->
    public function rejectProperty($id, $reason)
    {
        return $this->rejectsProperty($id, $reason);
    }

    // This function views the reason ---------------------------------------------------------------->
    public function viewReason($id)
    {
        return $this->viewsReason($id);
    }

    // This function deletes the property ---------------------------------------------------------------->
    public function deleteProperty($id)
    {
        return $this->deletesProperty($id);
    }

    // This function searches for related property --------------------------------------------------------->
    public function searchRelatedProperty($prop_id, $status, $type, $district, $area, $start, $end)
    {
        return $this->searchsRelatedProperty($prop_id, $status, $type, $district, $area, $start, $end);
    }

    // This function passes the data to edit the quantity ---------------------------------------------------------------->
    public function editQuantity($id, $qty)
    {
        return $this->editsQuantity($id, $qty);
    }

    // This function passes data to increment views ---------------------------------------------------------------------->
    public function changeViews($id, $views)
    {
        return $this->changesViews($id, $views);
    }
}
