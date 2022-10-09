<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $property = new ManagePropertyContr();
        $row = $property->viewProperties(1, 4, "house", "hostel", "land", "office", "flats", "electronic", "equipment", "other", 0, 4);
        if (empty($row)) {
        } else {
        ?>
            <div class="carousel-item active">
                <div class="row flex-row flex-nowrap overflow-auto mb-3">
                    <?php
                    foreach ($row as $rw) {
                        $price = number_format($rw['price']);
                        $shoutout_count = $shout->countShoutout($rw['prop_id']);
                    ?>
                        <div class="col-6 col-md-3 themed-grid-col mt-3">
                            <div class="thumb-wrapper item">
                                <?php if ($shoutout_count >= 4) {
                                } else { ?>
                                    <span class="wish-icon"><button class="btn shout" value="<?php echo $rw['prop_id'] ?>"><i class="fa fa-star"></i></button></span>
                                <?php } ?>
                                <div class="img-box">
                                    <img class="w-100" src="uploads/<?php echo $rw['image1']; ?>" style="height: 120px;" alt="image">
                                </div>
                                <div class="thumb-content">
                                    <h4 class="text-primary" style="text-transform: capitalize;"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic') ? $rw['name'] : $rw['type']; ?></h4>
                                    <p class="item-price text-secondary bg-light p-1 rounded-pill"><span class="fa fa-map-marker-alt"></span> <?php echo  $rw['district'] . ", " . $rw['area']; ?></p>
                                    <p class="item-price text-danger"><?php echo "K" . $price . " / " . $rw['period'] . " " . $rw['duration']; ?></p>
                                    <a href="index.php?id=<?php echo $rw['prop_id']; ?>&views=<?php echo $rw['views']; ?>" class="btn btn-primary rounded-pill btn-sm">Rent now</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php }
        $row = $property->viewProperties(1, 4, "house", "hostel", "land", "office", "flats", "electronic", "equipment", "other", 5, 8);
        if (empty($row)) {
        } else {
        ?>
            <div class="carousel-item">
                <div class="row flex-row flex-nowrap overflow-auto mb-3">
                    <?php
                    foreach ($row as $rw) {
                        $price = number_format($rw['price']);
                        $shoutout_count = $shout->countShoutout($rw['prop_id']);
                    ?>
                        <div class="col-6 col-md-3 themed-grid-col mt-3">
                            <div class="thumb-wrapper item">
                                <?php if ($shoutout_count >= 4) {
                                } else { ?>
                                    <span class="wish-icon"><button class="btn shout" value="<?php echo $rw['prop_id'] ?>"><i class="fa fa-star"></i></button></span>
                                <?php } ?>
                                <div class="img-box">
                                    <img class="w-100" src="uploads/<?php echo $rw['image1']; ?>" style="height: 120px;" alt="image">
                                </div>
                                <div class="thumb-content">
                                    <h4 class="text-primary" style="text-transform: capitalize;"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic') ? $rw['name'] : $rw['type']; ?></h4>
                                    <p class="item-price text-secondary bg-light p-1 rounded-pill"><span class="fa fa-map-marker-alt"></span> <?php echo  $rw['district'] . ", " . $rw['area']; ?></p>
                                    <p class="item-price text-danger"><?php echo "K" . $price . " / " . $rw['period'] . " " . $rw['duration']; ?></p>
                                    <a href="index.php?id=<?php echo $rw['prop_id']; ?>&views=<?php echo $rw['views']; ?>" class="btn btn-primary rounded-pill btn-sm">Rent now</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php }
        $row = $property->viewProperties(1, 4, "house", "hostel", "land", "office", "flats", "electronic", "equipment", "other", 9, 12);
        if (empty($row)) {
        } else {
        ?>
            <div class="carousel-item">
                <div class="row flex-row flex-nowrap overflow-auto mb-3">
                    <?php
                    foreach ($row as $rw) {
                        $price = number_format($rw['price']);
                        $shoutout_count = $shout->countShoutout($rw['prop_id']);
                    ?>
                        <div class="col-6 col-md-3 themed-grid-col mt-3">
                            <div class="thumb-wrapper item">
                                <?php if ($shoutout_count >= 4) {
                                } else { ?>
                                    <span class="wish-icon"><button class="btn shout" value="<?php echo $rw['prop_id'] ?>"><i class="fa fa-star"></i></button></span>
                                <?php } ?>
                                <div class="img-box">
                                    <img class="w-100" src="uploads/<?php echo $rw['image1']; ?>" style="height: 120px;" alt="image">
                                </div>
                                <div class="thumb-content">
                                    <h4 class="text-primary" style="text-transform: capitalize;"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic') ? $rw['name'] : $rw['type']; ?></h4>
                                    <p class="item-price text-secondary bg-light p-1 rounded-pill"><span class="fa fa-map-marker-alt"></span> <?php echo  $rw['district'] . ", " . $rw['area']; ?></p>
                                    <p class="item-price text-danger"><?php echo "K" . $price . " / " . $rw['period'] . " " . $rw['duration']; ?></p>
                                    <a href="index.php?id=<?php echo $rw['prop_id']; ?>&views=<?php echo $rw['views']; ?>" class="btn btn-primary rounded-pill btn-sm">Rent now</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>