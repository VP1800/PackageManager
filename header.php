<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/responsive.css">
    
    <!-- w3-css -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <title>Package Manager</title>
</head>
<body>

<!-- ajax loader -->
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>

<!-- Alert box -->
<div id="alert-box" class="w3-danger w3-center w3-padding w3-round w3-hide"></div>

<!-- Top Bar -->
<div class="top-bar w3-bar w3-white w3-card">
    <button class="w3-bar-item w3-button w3-large w3-left" onclick="toggleSidebar()">&#9776;</button>
    <div class="w3-bar-item">Welcome</div>
    <div class="w3-bar-item w3-right">
        <i class="w3-text-blue w3-xlarge w3-right w3-margin-right w3-circle w3-padding-small">&#128100;</i>
    </div>
</div>

<!-- Sidebar -->
<div id="sidebar" class="w3-sidebar w3-bar-block w3-light-grey w3-card w3-animate-left">
    <!-- <a href="#" class="w3-bar-item w3-button" onclick="loadPage('index.php')">Home</a> -->
    <a href="./home.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-home"></i>&nbsp; Home</a>
    <a href="./profile.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-edit"></i>&nbsp; Profile</a>
    <a href="./profile_list.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-list"></i>&nbsp; Profile_list</a>
    <a href="./sheet_weight_form.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-table"></i>&nbsp; Sheet Weights</a>
    <a href="./add_unit.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-fire"></i>&nbsp; Unit</a>
    <a href="./add_item.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-sign-in"></i>&nbsp; Item</a>
    <a href="./purchase.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-share-alt w3-text-info"></i>&nbsp; Purchase</a> 
    <a href="./payment.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-coffee w3-text-danger"></i>&nbsp; Payment</a>
    <a href="./sales.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-fire"></i>&nbsp; Sales</a>
    <a href="./issue_tracking.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary">
        <i class="fa fa-fw fa-user-circle"></i>&nbsp; Issue Tracking</a>

    <!-- <a href="./index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary" onclick="loadPage('login.php')">
        <i class="fa fa-fw fa-lock"></i>&nbsp; Login </a>
    <a href="./register.php" class="w3-bar-item w3-button w3-padding-large w3-hover-text-primary" onclick="loadPage('register.php')">
        <i class="fa fa-fw fa-sign-in"></i>&nbsp; Registration </a> -->
    
    <!-- Add more menu items as needed -->
</div>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="./jquery/headerfooter.js"></script>
</body>
</html> -->