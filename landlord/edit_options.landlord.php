<?php
if (isset($_GET['edit'])) {
    $property = new ManagePropertyContr();
    $row = $property->viewSingleProperty($_GET['edit']);
    $type = $row['type'];

    if ($type == 'house') {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/house.landlord.php");
    } elseif ($type == 'office') {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/office.landlord.php");
    } elseif ($type == 'hostel') {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/hostel.landlord.php");
    } elseif ($type == 'flats') {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/flats.landlord.php");
    } elseif ($type == 'land') {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/land.landlord.php");
    } elseif ($type == 'electronic') {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/electronic.landlord.php");
    } elseif ($type == 'other') {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/other.landlord.php");
    } else {
        $_SESSION['prop_edit_id'] = $_GET['edit'];
        $_SESSION['prop_type'] = $type;
        header("location: edit/other.landlord.php");
    }
}
