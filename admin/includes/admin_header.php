<?php ob_start() ?>
<?php include "../includes/db.php" ?>
<!-- bu kodları yazmayı unutmamak lazım -->
<?php 
session_start();
if(isset($_SESSION['userrole'])){
  if($_SESSION['userrole']!=="Admin"){
    header("location:../index.php");
  }
  
}else{
  header("location:../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <!-- google chars -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php">HD Kalite</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <h5 class="text-white mx-5">Welcome to Admin Page Dear <span class="text-success"><?php echo $_SESSION['userrole']; ?></span></h5>


    <!-- Navbar Search -->
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <a href="logout.php" class="nav-link"><span>Log out</span> <i class="fa fa-sign-out-alt"></i></a>

    </div>
  </nav>