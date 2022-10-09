<?php
// Compress image 
function compressedImage($source, $path, $quality)
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $path, $quality);
}

if (isset($_POST['edit'])) {
    $prop_id =  strip_tags($_POST['prop_id']);
    $name =  (isset($_POST['name']) ? $_POST['name'] : null);
    $price =  strip_tags($_POST['price']);
    $period =  strip_tags($_POST['period']);
    $duration =  strip_tags($_POST['duration']);
    $quantity = (isset($_POST['quantity']) ? $_POST['quantity'] : 1);
    $land = (isset($_POST['land']) ? $_POST['land'] : null);
    $district =  strip_tags($_POST['district']);
    $area =  strip_tags($_POST['area']);
    $guest = (isset($_POST['guest']) ? $_POST['guest'] : null);
    $toilet = (isset($_POST['toilet']) ? $_POST['toilet'] : null);
    $bathroom = (isset($_POST['bathroom']) ? $_POST['bathroom'] : null);
    $quarters = (isset($_POST['quarters']) ? $_POST['quarters'] : null);
    $kitchen = (isset($_POST['kitchen']) ? $_POST['kitchen'] : null);
    $store = (isset($_POST['store']) ? $_POST['store'] : null);
    $dinning = (isset($_POST['dinning']) ? $_POST['dinning'] : null);
    $living = (isset($_POST['living']) ? $_POST['living'] : null);
    $dressing = (isset($_POST['dressing']) ? $_POST['dressing'] : null);
    $study = (isset($_POST['kitchen']) ? $_POST['study'] : null);
    $fence = (isset($_POST['fence']) ? $_POST['fence'] : null);
    $description = strip_tags($_POST['description']);
    $descript = $guest . $fence . $toilet . $bathroom . $quarters . $store . $living . $dinning . $kitchen . $dressing . $study . $description;

    foreach ($_FILES['images']['name'] as $key => $val) {

        $filename = $_FILES['images']['name'][$key];
        // Valid extension 
        $valid_ext = array('png', 'jpeg', 'jpg');
        $photoExt1 = @end(explode('.', $filename));

        //GET FILENAME WITHOUT EXTENSION
        $name_no_ext = pathinfo($filename, PATHINFO_FILENAME);
        // explode the image name to get the extension 	 
        $phototest1 = strtolower($photoExt1);
        $new_profle_pic = $name_no_ext . '.' . $phototest1;
        // Location 
        $location = "../../uploads/" . $new_profle_pic;
        // file extension 
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

        // Check extension 
        if (in_array($file_extension, $valid_ext)) {
            // Compress Image 
            compressedImage($_FILES['images']['tmp_name'][$key], $location, 60);
            //Here i am enter the insert code in the step ........ 
        }
    }
    //object passing data to the "ManagePropertyContr.class.php" file ----------------------------------------------->
    $upload = new ManagePropertyContr;
    $st = $upload->editProperty($prop_id, $name, $price, $period, $duration, $quantity, $land, $district, $area, $descript,  $_FILES['images']['name'][0],  $_FILES['images']['name'][1],  $_FILES['images']['name'][2],  $_FILES['images']['name'][3]);

    //checking if the data has been uploaded -------------------------------------------------------------------------->
    if ($st) {

        header("location: final_step.landlord.php");
    } else {

        $msg2 = "Error, failure editing property!";
    }
}
