<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Help Page</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bd_aside.css">
    <link rel="stylesheet" href="../assets/css/propdetails.css">
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
</head>

<body>
    <?php
    include "navbar2.inc.php";
    ?>
    <div class="row grid">
        <div class="col-md-2 bg-light">
            <div class="bd-aside sticky-xl-top align-self-start container-fluid">
                <h2 class="h6 pt-4 pb-3 mb-4 border-bottom">On this page</h2>
                <nav class="small" id="toc">
                    <ul class="list-unstyled">
                        <li class="my-2">
                            <button class="btn d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#contents-collapse" aria-controls="contents-collapse">Contents</button>
                            <ul class="list-styled ps-3 collapse" id="contents-collapse">
                                <li><a class="d-inline-flex align-items-center rounded" href="#welcome">Welcome!</a></li>
                                <li><a class="d-inline-flex align-items-center rounded" href="#create">Create an account</a></li>
                                <li><a class="d-inline-flex align-items-center rounded" href="#upload">Upload a property</a></li>
                                <li><a class="d-inline-flex align-items-center rounded" href="#rent">Rent a property</a></li>
                                <li><a class="d-inline-flex align-items-center rounded" href="#make">Make a shout out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-10">
            <section id="content">
                <h2 class=" fw-bold pt-3 pt-xl-5 pb-2 pb-xl-3">Contents</h2>

                <article class="my-3" id="welcome">
                    <div class="bd-heading align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                        <h3>Welcome</h3>
                        <hr>
                    </div>
                    <div>
                        Welcome To Umooza City, where all your rental products are in one location
                    </div>
                </article>

                <article class="my-3" id="create">
                    <div class="bd-heading align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                        <h3>Create an account</h3>
                        <hr>
                    </div>
                    <div>
                        <!-- PROPERTY OWNER REGISTRATION  -->
                        <div class="alert alert-info">
                            Create <b>Property Onwer</b> account: <br>
                        </div>
                        <ul class="list-style" style="list-style:decimal;">
                            <li class="border m-3 p-3">Click the "add property" button on the navbar and select the "register" option on the dropdown menu.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/1st.jpg" alt="image" height="100%" width="100%">
                                </div>
                                <div class="col-md-4 border">
                                    <img src="../assets/images/2nd.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>

                            <li class="border m-3 p-3">Accept the terms and conditions to register.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/3rd.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Fill in the form filled with the required details.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/4th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Verify the email address by clicking the link sent to your email address.</li>
                        </ul>
                        <div class="alert alert-info">
                            Create <b>Customer</b> account: <br>
                        </div>
                        <ul class="list-style" style="list-style:decimal;">
                            <li class="border m-3 p-3">Click the "account" button on the navbar and select the "register" option on the dropdown menu.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/5th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Accept the terms and conditions to register.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/6th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Fill in the form filled with the required details.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/7th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Verify the email address by clicking the link sent to your email address.</li>
                        </ul>
                    </div>
                </article>

                <article class="my-3" id="upload">
                    <div class="bd-heading align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                        <h3>Upload a property</h3>
                        <hr>
                    </div>
                    <div>
                        <ul class="list-style" style="list-style:decimal;">
                            <li class="border m-3 p-3">Click the "add property" button on the navbar and select the "login" option on the dropdown menu to login.</li>
                            <li class="border m-3 p-3">Click on the "add property" option on the dashboard menu.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/8th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Select the type of property you want to upload.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/9th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Fill the form fields with the required property details and submit.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/10th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Patiently wait for the administrator to approve your property.</li>
                        </ul>
                    </div>
                </article>

                <article class="my-3" id="rent">
                    <div class="bd-heading align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                        <h3>Rent a property</h3>
                        <hr>
                    </div>
                    <div>
                        <ul class="list-style" style="list-style:decimal;">
                            <li class="border m-3 p-3">Select a prefered property and click on "rent now".</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/11th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Go through the property details then click on "rent".</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/12th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Enter your credentials or register your customer account.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/13th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">On the customer dashboard, make payment to the number given.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/14th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Click on the "rent" button and confirm the payment using the transaction reference number.</li>
                            <li class="border m-3 p-3">BONUS BUT REQUIRED: Select a property shoutout or comment you like.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/15th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Go the "receipt" page to get you rental code.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/16th.jpg" alt="image" height="100%" width="100%">
                                </div>
                                <div class="col-md-4 border">
                                    <img src="../assets/images/17th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">On the property owner's dashboard, use the code to confirm the rental.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/18th.jpg" alt="image" height="100%" width="100%">
                                </div>
                                <div class="col-md-4 border">
                                    <img src="../assets/images/19th.jpg" alt="image" height="100%" width="100%">
                                </div>
                                <div class="col-md-4 border">
                                    <img src="../assets/images/20th.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                        </ul>
                    </div>
                </article>

                <article class="my-3" id="make">
                    <div class="bd-heading align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                        <h3>Make a shoutout </h3>
                        <hr>
                    </div>
                    <div>
                        <div class="alert alert-info text-center">
                            NOTE: A shoutout is basically a comment on the property
                        </div>
                        <ul class="list-style" style="list-style:decimal;">
                            <li class="border m-3 p-3">Click the "heart" icon on the top right corner of the property container.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/21st.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                            <li class="border m-3 p-3">Fill in your shoutout and the required personnal details in the modal/popup form.</li>
                            <div class="row m-3">
                                <div class="col-md-4 border">
                                    <img src="../assets/images/22nd.jpg" alt="image" height="100%" width="100%">
                                </div>
                            </div>
                        </ul>
                    </div>
                </article>
            </section>
        </div>
    </div>
    <?php
    include_once 'classautoloader.inc.php';
    include "footer2.inc.php"; ?>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>