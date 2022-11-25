<?php
include('session.php');
require "autoloader.php";
use Database\Handler;
$handler = new Handler();

?>


<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        .btn{
            margin: 20px;
        }
        /* input{
          background-color: #cbb007!important;
        } */
        .tabs .tab a{
            color: black!important;
            font-weight: bold;
            font-size: 10px!important;
        }
        .row{
            margin-bottom:5px!important;
        }
        .brand{
            color: black!important;
            font-weight: 500;
            font-size: 13.5px;
        }
        .brand-btn{
            background-color: #cbb007!important;
        }
        .brand-btn:focus{
            background-color: #6e6000!important;
        }

        label {
            font-weight:600;
            width:100px;
            font-size:.9em!important;
        }
        select {
            display: block !important;
        }

        .okok{
            margin-left: 6px;
            margin-top:6px;

        }



        .hiddenn{
            display:none!important;
        }
        @media screen and (min-width: 1000px) {

            div.wrap_table__{
                overflow: auto;
                width: 70%;
                height: 500px;
                margin-top:10px;
            }



        }

        table.okok {
            border-collapse: collapse;
        }

        table.okok, th, td {
            border: 1px solid black;
        }
        table.okok > tr > a {
            display: block;
        }

        .okok  td,th{
            padding: 5px 2px!important;
            border-width:4px!important;
            border-right-width: 4px;
            border-left-width:4px;
            border-color: black!important;
            display: table-cell!important;
            text-align: left!important;
            vertical-align: middle!important;
            /* border-radius: 2px; */
            /* width: 100%; */
            white-space: nowrap!important;
            font-size: 12px!important;
            font-weight: 700;

        }

        @media screen and (max-width: 800px) {
            a.brand-logo.brand {
                /* width: 20px; */
                font-size: 20px;
            }
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- font awesome -->

    <!--Import Google Icon Font-->
    <link href="css/mat_icon.css" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="css/mat.css">
    <!-- icon @ favicon -->
    <link rel="shortcut icon" href="favicon.ico" />

    <?php
    if(empty($page_title)){
        $page_title="";
    }

    ?>

    <title><?php echo "$page_title"; ?></title>
</head>

<?php


$user_current = $_SESSION['login_user'];
$company_current = 'Farm Connect';




// echo $user_current ." - ".$company_current;


?>

<body class="grey lighten-4" >



<nav class="white">


    <ul id="slide-out" class="sidenav hide-on-large-only">
        <li><div class="user-view">
                <div class="background" style="background: rgb(2,0,36);
background: linear-gradient(167deg, rgba(2,0,36,1) 0%, rgba(1,14,97,1) 28%, rgba(0,212,255,1) 100%);">

                </div>
                <a href="#user" style="margin-top:20px;margin-bottom:-10px;"><svg   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="38px" height="38px"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/><path d="M0 0h24v24H0z" fill="none"/></svg></a>
                <a href="#name"><span class="white-text name"><?php echo $user_current; ?></span></a>
                <a href="#company"><span class="white-text email"><?php echo $company_current ?></span></a>
            </div></li>
        <li><a href="index.php" class="brand">Home</a></li>
        <li><a class = "brand" href ="thinksspeak.php">Update ThinksSpeak</a>  </li>

        <li class="divider" tabindex="-1"></li>
        <li><a href="logout.php"class="brand">Logout</a></li>

    </ul>

    <a href="#" data-target="slide-out" class="sidenav-trigger hide-on-large-only"><i class="material-icons brand">menu</i></a>





    <div class="nav-wrapper" style="width:95% ;margin-left:20px;">
        <a href="index.php" class="brand-logo brand"><?php echo $company_current; ?></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php" class="brand">Home</a></li>

        <li><a class = "brand" href ="thinksspeak.php">Update ThingsSpeak</a>  </li>

            <li><a href="logout.php" class="brand">Logout</a></li>

        </ul>


            <!-- Dropdown Structure -->











    </div>
</nav>



