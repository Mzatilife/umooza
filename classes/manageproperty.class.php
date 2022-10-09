<?php
class ManageProperty extends Dbh
{
  // FUNCTION TO MANAGE PROPERTY SUBMISSION *********************************************************************>
  protected function submitsProperty($user_id, $type, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "INSERT INTO properties (`user_id`, `type`, `name`, `price`, `period`, `duration`, `quantity`, `land`, `district`, `area`, `description`, `image1`, `image2`, `image3`, `image4`, `status`, `views`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, NOW())";
    $stmt = $this->connect()->prepare($sql);

    $result = $stmt->execute([$user_id, $type, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO MANAGE PROPERTY EDIT *********************************************************************>
  protected function editsProperty($prop_id, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "UPDATE properties SET `name` = ?, `price` = ?, `period` = ?, `duration` = ?, `quantity` = ?, `land` = ?, `district` = ?, `area` = ?, `description` = ?, `image1` = ?, `image2` = ?, `image3` = ?, `image4` = ?, `status` = 0, `date` = NOW() WHERE `prop_id` = ?";
    $stmt = $this->connect()->prepare($sql);

    $result = $stmt->execute([$name, $price, $period, $duration, $quantity, $land, $district, $area, $descript, $image1, $image2, $image3, $image4, $prop_id]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO VIEW PROPERTY DETAILS ****************************************************************************>
  protected function viewsProperty($user_id, $st1, $st2, $st3, $st4, $st5)
  {
    $sql = "SELECT * FROM `properties` WHERE `user_id` = ? AND (`status` = ? OR `status` = ? OR `status` = ? OR `status` = ? OR `status` = ?) order by prop_id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $st1, $st2, $st3, $st4, $st5]);
    return $stmt->fetchAll();
  }

    // FUNCTION TO VIEW PROPERTY DETAILS FOR COORDINATE UPLOAD****************************************************************************>
    protected function viewsForCoord($user_id, $type, $dist, $area)
    {
      $sql = "SELECT * FROM `properties` WHERE `user_id` = ? AND `type` = ? AND `district` = ? AND `area` = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$user_id, $type, $dist, $area]);
      return $stmt->fetch();
    }

    // FUNCTION TO VIEW COORDINATES****************************************************************************>
    protected function viewsCoordinates($prop_id)
    {
      $sql = "SELECT * FROM `coordinates` WHERE `prop_id` = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$prop_id]);
      return $stmt->fetch();
    }

   // FUNCTION TO UPLOAD COORDINATES *****************************************************************************>
   protected function submitsCoordinates($prop_id, $lat, $long)
   {
     $sql = "INSERT INTO coordinates (`prop_id`, `latitude`, `longitude`, `date`) VALUES (?,?,?, NOW())";
     $stmt = $this->connect()->prepare($sql);
     $result = $stmt->execute([$prop_id, $lat, $long]);
 
       if ($result) {
         return true;
       } else {
         return false;
       }
   }

  // FUNCTION TO VIEW PROPERTY DETAILS ****************************************************************************>
  protected function viewsPropertyAdmin($st1, $st2, $st3, $st4, $st5)
  {
    $sql = "SELECT * FROM `properties`  INNER JOIN `users` ON properties.user_id = users.user_id WHERE properties.status = ? OR properties.status = ? OR properties.status = ? OR properties.status = ? OR properties.status = ? order by prop_id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$st1, $st2, $st3, $st4, $st5]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO COUNT PROPERTIES ****************************************************************************>
  protected function countsOwnerProperty($user_id, $st1, $st2, $st3, $st4)
  {
    $sql = "SELECT * FROM `properties` WHERE `user_id` = ? AND (`status` = ? OR `status` = ? OR `status` = ? OR `status` = ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $st1, $st2, $st3, $st4]);
    return $stmt->rowCount();
  }

  // FUNCTION TO COUNT PROPERTIES ****************************************************************************>
  protected function countsAdminProperty($st1, $st2, $st3, $st4)
  {
    $sql = "SELECT * FROM `properties` WHERE `status` = ? OR `status` = ? OR `status` = ? OR `status` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$st1, $st2, $st3, $st4]);
    return $stmt->rowCount();
  }

  // FUNCTION TO CHECK PROPERTY STATUS ****************************************************************************>
  protected function checksProperty($id, $st)
  {
    $sql = "SELECT * FROM `properties` WHERE `prop_id` = ? AND `status` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id, $st]);
    return $stmt->rowCount();
  }

  // FUNCTION TO VIEW SINGLE PROPERTY DETAILS ****************************************************************************>
  protected function viewsSingleProperty($id)
  {
    $sql = "SELECT * FROM `properties`  INNER JOIN `users` ON properties.user_id = users.user_id WHERE properties.prop_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO APPROVE WAREHOUSE FOR UPLOAD  *********************************************************************>
  protected function approvesProperty($id, $st)
  {
    $sql = "UPDATE properties SET `status` = ? WHERE `prop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$st, $id]);

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO REJECT PROPERTY *****************************************************************************>
  protected function rejectsProperty($id, $reasons)
  {
    $sql = "INSERT INTO reasons (`prop_id`, `reason`) VALUES (?,?)";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$id, $reasons]);

    if ($result) {
      $result2 = $this->approvesProperty($id, 2);

      if ($result2) {
        return true;
      } else {
        return false;
      }
    }
  }

  // FUNCTION TO DELETE THE PROPERTY  *********************************************************************>
  protected function deletesProperty($id)
  {
    $sql = "SELECT * FROM properties WHERE prop_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    unlink("../uploads/" . $row['image1']);
    unlink("../uploads/" . $row['image2']);
    unlink("../uploads/" . $row['image3']);
    unlink("../uploads/" . $row['image4']);

    if ($row) {
      $sql1 = "DELETE FROM properties WHERE prop_id = ?";
      $stmt1 = $this->connect()->prepare($sql1);
      $result1 = $stmt1->execute([$id]);

      if ($result1) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  // FUNCTION TO VIEW REASON FOR PROPERTY REJECTION ****************************************************************************>
  protected function viewsReason($id)
  {
    $sql = "SELECT * FROM `reasons`  INNER JOIN `properties` ON reasons.prop_id = properties.prop_id WHERE reasons.prop_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW WAREHOUSE DETAILS ****************************************************************************>
  protected function viewsProperties($status, $status2, $type, $type2, $type3, $type4, $type5, $type6, $type7, $type8, $start, $end)
  {
    $sql = "SELECT * FROM `properties` WHERE (`status` = ? OR `status` = ?) AND (`type` = ? OR `type` = ? OR `type` = ? OR `type` = ? OR `type` = ?  OR `type` = ? OR `type` = ?  OR `type` = ?) order by prop_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $status2, $type, $type2, $type3, $type4, $type5, $type6, $type7, $type8]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO SEARCH PROPERTY ****************************************************************************>
  protected function searchsProperties($status, $status2, $type, $district, $start, $end)
  {
    $sql = "SELECT * FROM `properties` WHERE (`status` = ? OR `status` = ?) AND ((`type` LIKE '%$type%' OR `name` LIKE '%$type%') AND (`district` LIKE '%$district%' OR `area` LIKE '%$district%')) order by prop_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $status2]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO COUNT SEARCHED PROPERTY ****************************************************************************>
  protected function countsSearchedProperties($status, $status2, $type, $district)
  {
    $sql = "SELECT * FROM `properties` WHERE (`status` = ? OR `status` = ?) AND ((`type` LIKE '%$type%' OR `name` LIKE '%$type%') AND (`district` LIKE '%$district%' OR `area` LIKE '%$district%'))";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $status2]);
    return $stmt->rowCount();
  }

  // FUNCTION TO SEARCH FOR RELATED PROPERTY ******************************************************************>
  protected function searchsRelatedProperty($prop_id, $status, $type, $district, $area, $start, $end)
  {
    $sql = "SELECT * FROM `properties` WHERE `prop_id` != ? AND `status` = ? AND (`type` LIKE '%$type%' OR `district` LIKE '%$district%' OR `area` LIKE '%$area%') order by prop_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$prop_id, $status]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO EDIT QUANTITY  *********************************************************************>
  protected function editsQuantity($id, $qty)
  {
    $sql = "UPDATE properties SET `quantity` = ? WHERE `prop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$qty, $id]);

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO CHANGE VIEWS ************************************************************************>
  protected function changesviews($id, $views)
  {
    $sql = "UPDATE properties SET `views` = ? WHERE `prop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    return $stmt->execute([$views, $id]);
  }

  // // FUNCTION TO VIEW WAREHOUSE DETAILS ****************************************************************************>
  // protected function viewsDistinctProperties($status, $start, $end)
  // {
  //   $sql = "SELECT DISTINCT(`type`) FROM `properties` WHERE `status` = ?  order by prop_id DESC limit $start, $end";
  //   $stmt = $this->connect()->prepare($sql);
  //   $stmt->execute([$status]);
  //   return $stmt->fetchAll();
  // }
}
