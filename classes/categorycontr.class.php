<?php
class CategoryContr extends Category
{
    public function addCategory($name)
    {
        return $this->addsCategory($name);
    }

    public function viewCategory()
    {
        return $this->viewsCategory();
    }

    public function deleteCategory($id)
    {
        return $this->deletesCategory($id);
    }
}
?>