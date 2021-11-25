<?php

$sql="SELECT * FROM settings WHERE id=1";
$data = mysqli_query($link,$sql);
$data = mysqli_fetch_assoc($data);
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/dashboard/admin/assets/img/<?php echo $data['favicon']; ?>" rel="icon">
  <link href="/dashboard/admin/assets/img/<?php echo $data['favicon']; ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    th {
      font-size: 13px;
    }

    td {
      font-size: 12px;
    }
  </style>
</head>



<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img width="100px" src="/dashboard/admin/assets/img/<?php echo $data['logo']; ?>" alt="">
        
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
    
    <?php
        
        echo base64_decode($data['chat_code']);
    
    ?>
    
    
    
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
  
     
      <?php
      $id_user = $_SESSION['id']; // get id through query string

      $sql = mysqli_query($link, "SELECT * FROM user WHERE id=$id_user LIMIT 1");
      $user = mysqli_fetch_assoc($sql);

      if ($user['role'] == "admin") {




      ?>
        <li class="nav-item">
          <a class="nav-link " href="orders.php">
            <i class="bi bi-people-fill"></i>
            <span>Orders</span>
          </a>
        </li>
		
		
		<li class="nav-item">
          <a class="nav-link " href="deals.php">
            <i class="bi bi-people-fill"></i>
            <span>Deals</span>
          </a>
        </li>
		
		
		<li class="nav-item">
          <a class="nav-link " href="users-index.php">
            <i class="bi bi-people-fill"></i>
            <span>Agents</span>
          </a>
        </li>
		
		
      <?php   } else if($user['role'] == "agent")  {?>

		
		<li class="nav-item">
          <a class="nav-link " href="orders.php">
            <i class="bi bi-people-fill"></i>
            <span>Orders</span>
          </a>
        </li>
		
		<li class="nav-item">
          <a class="nav-link " href="deals.php">
            <i class="bi bi-people-fill"></i>
            <span>Deals</span>
          </a>
        </li>
		
		
		<?php
			
	  }
	   else if($user['role'] == "superadmin")
	  {
			
		?>
		
		
		<li class="nav-item">
          <a class="nav-link " href="users-index.php">
            <i class="bi bi-people-fill"></i>
            <span>Users</span>
          </a>
        </li>
		
		
	    <li class="nav-item">
          <a class="nav-link " href="deals.php">
            <i class="bi bi-people-fill"></i>
            <span>Deals</span>
          </a>
        </li>
        
		<li class="nav-item">
          <a class="nav-link " href="orders.php">
            <i class="bi bi-people-fill"></i>
            <span>Orders</span>
          </a>
        </li>
        
        
	
	
	    <li class="nav-item">
          <a class="nav-link " href="settings.php">
            <i class="bi bi-people-fill"></i>
            <span>Settings</span>
          </a>
        </li>
	
	
	
	<?php
	  
	  }
	?>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">