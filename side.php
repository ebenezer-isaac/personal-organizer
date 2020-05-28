<?php
date_default_timezone_set("Asia/Calcutta");
session_start();
if (isset($_SESSION["userid"])) {
    ?><!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" href="img/logo.png" type="image/gif">
            <title>Organizer</title>
            <script src="https://kit.fontawesome.com/1ca2da442a.js" crossorigin="anonymous"></script>
            <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
            <link href="css/sb-admin.css" rel="stylesheet">
            <link href="css/dropdowns.css" rel="stylesheet">
            <link rel="stylesheet" href="css/loader.css" type="text/css">
            <link rel="stylesheet" href="css/anim.css" type="text/css">
            <link rel="stylesheet" href="css/side.css" type="text/css">
            <style>#wrapper{}#main{} </style>
        </head>
        <body id="page-top">
            <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
                <img src="img/logo.png" height="40" align='center' width="40"> 
                <a class="navbar-brand mr-1" href="about.html" style='color:black;'>Organizer</a>
                <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#"> 
                    <i style='color:black;' class="fas fa-bars"></i> </button> 
                <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"> </form>
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown no-arrow">
                        <a id='profile-menu' class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img style='border-radius:50%;border:solid 0.1px #2764a3; box-shadow: 0 0 2px 2px #2764a3;' height='30px' width='30px' src='img/ebi.png'>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="nav-link" href="javascript:setContent('profile.php');" style='color:black;'>My Profile</a> 
                            <div class="dropdown-divider"></div>
                            <a class="nav-link" href="#" id='logout-modal' data-toggle="modal" data-target="#logoutModal" style='color:black;'>Logout</a> 
                        </div>
                    </li>
                </ul>
            </nav>
            <div id="wrapper">
                <ul class="sidebar navbar-nav">
                    <li class="nav-item"> 
                        <a class="nav-link" href="javascript:setContent('home.php');" style="color:black">
                            <i style='margin:5px' class="fas fa-home"></i><span>Homepage</span></a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:setContent('calendar.php');" style="color:black">
                            <i style='margin:5px' class="fas fa-calendar-alt"></i><span>Calendar</span></a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" href="javascript:setContent('events.php');" style="color:black">
                            <i style='margin:5px' class="fas fa-eye"></i><span>View Events</span></a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:setContent('reports.php');" style="color:black">
                            <i style='margin:5px' class="fas fa-chart-bar"></i><span>Reports</span></a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:setContent('addevent.php');" style="color:black">
                            <i style='margin:5px' class="fa fa-plus"></i><span>Add Event</span></a>
                    </li>
                    <div style="height:100%" onclick="javascript:document.getElementById('sidebarToggle').click();"></div>
                </ul>
                <div id="content-wrapper">
                    <div class="container-fluid">
                        <ol class="breadcrumb" id='navigator'>
                            <li class="breadcrumb-item"> <a href="javascript:setContent('home.php');">Homepage</a> </li>
                            <li class="breadcrumb-item active">Overview</li>
                        </ol>
                        <div id='main' style='display: none;color:black;' align='center'>     
                            <?php
                        } else {
                            echo "<script>window.location.replace('index.php');</script>";
                        }
