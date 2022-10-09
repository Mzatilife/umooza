<?php
class Category extends Dbh
{
  // FUNCTION TO ADD CATEGORY
  protected function addsCategory($name)
  {
    $sql = "INSERT INTO categories (`category_name`) VALUES (?)";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$name]);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO DISPLAY CATEGORIES
  protected function viewsCategory()
  {
    $sql = "SELECT * FROM categories";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO DELETE CATEGORY
  protected function deletesCategory($id)
  {
    $sql = "DELETE FROM categories WHERE category_id = ?";
    $stmt = $this->connect()->prepare($sql);
    return $stmt->execute([$id]);
  }
}
