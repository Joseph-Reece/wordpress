<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}



include_once "connection.php";

$user_id = $_SESSION['id'];

$sql="SELECT * FROM user WHERE id=".$user_id;
$data = mysqli_query($link,$sql);
$user = mysqli_fetch_assoc($data);



$sql="SELECT * FROM settings LIMIT 1";
$settings = mysqli_query($link,$sql);
$settings = mysqli_fetch_assoc($settings);

        
$sql="SELECT * FROM user WHERE created_by=".$user_id;
$created_by = mysqli_query($link,$sql);
$total_created = mysqli_num_rows($created_by);


    
    if($settings['limit_user']<$total_created || $total_created==$settings['limit_user'])
    {
        
        echo "<h4> You cant create more user </h4>";
        exit();
    }


	if(isset($_POST['submit'])) 
	{	
	
		
		$username = $_POST['username'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$company = $_POST['company'];
		$merchant = $_POST['merchant'];
		$role = $_POST['role'];
		
		
		$checkout1=0;
		$checkout2=0;
		
		if($_POST['checkout1']>0)
		    $checkout1 = $_POST['checkout1'];
        
        if($_POST['checkout2']>0)
            $checkout2 = $_POST['checkout2'];
		

		$sql = "INSERT INTO user (username , password , company , merchant , role,checkout1,checkout2,created_by)
		 VALUES ('$username','$password','$company' , '$merchant','$role','$checkout1','$checkout2','$user_id')";
		
		if (mysqli_query($link, $sql)) 
		{
			header('Location:users-index.php');
		} 
		else 
		{
			echo "Error: " . $sql . ":-" . mysqli_error($link);
		}
		mysqli_close($link);
		
	}



require "header.php";
?>

<div class="pagetitle">
    <h1>Users</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Users</a></li>
            <li class="breadcrumb-item active">Add user</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Add user</h5>

        <!-- Vertical Form -->
        <form class="row g-3" action="users-add.php" method="post" enctype="multipart/form-data">
            <div class="col-12">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-12">
                <label for="company" class="form-label">Company</label>
                <input type="text" class="form-control" id="company" name="company" required>
            </div>
            <div class="col-12">
                <label for="merchant" class="form-label">Merchant</label>
                <input type="text" class="form-control" id="merchant" name="merchant" required>
            </div>
            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
            
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role" value="agent">
                    <label class="form-check-label" for="role">
                        Agent
                    </label>
                </div>
                
                <?php
                    
                    if($user['role']=="superadmin")
                    {
                ?>
                
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role" value="admin" checked>
                    <label class="form-check-label" for="role">
                        Admin
                    </label>
                </div>
                
                
                <?php
                    
                    }
                
                ?>
                
            </div>
            
            
          
            
            
            <legend class="col-form-label col-sm-2 pt-0">Permissions</legend>
             <div class="col-sm-10">
                <div class="form-check">
                    Checkout 1 <input class="form-check-input" type="checkbox" name="checkout1" value="1"> <br>
                    Checkout 2 <input class="form-check-input" type="checkbox" name="checkout2" value="1">
                  
                </div>
                

            </div>
            
            
            
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
                <a type="reset" class="btn btn-secondary" href="users-index.php">Cancel</a>
            </div>
        </form><!-- Vertical Form -->

    </div>
</div>

<?php
require "footer.php";



?>

<script>

</script>