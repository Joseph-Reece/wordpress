<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$id = $_GET['id']; // get id through query string

$result = mysqli_query($link, "SELECT * FROM user WHERE id=$id LIMIT 1");
$row = mysqli_fetch_assoc($result);

require "header.php";
?>

<div class="pagetitle">
    <h1>Users</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Users</a></li>
            <li class="breadcrumb-item active">Edit user</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Edit user</h5>

        <!-- Vertical Form -->
        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
            <div class="col-12">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-12">
                <label for="company" class="form-label">Company</label>
                <input type="text" class="form-control" id="company" name="company" value="<?php echo $row['company'] ?>" required>
            </div>
            <div class="col-12">
                <label for="merchant" class="form-label">Merchant</label>
                <input type="text" class="form-control" id="merchant" name="merchant" value="<?php echo $row['merchant'] ?>" required>
            </div>
            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role" value="agent" <?php if ($row['role'] == "agent") echo "checked"  ?>>
                    <label class="form-check-label" for="role">
                        Agent
                    </label>
                </div>
               

            </div>
            
           
            
            
            
             <legend class="col-form-label col-sm-2 pt-0">Permissions</legend>
             <div class="col-sm-10">
                <div class="form-check">
                    Checkout 1 <input class="form-check-input" type="checkbox" name="checkout1" value="1" <?php if($row['checkout1']==1) { echo "checked";  }  ?>> <br>
                    Checkout 2 <input class="form-check-input" type="checkbox" name="checkout2" value="1" <?php if($row['checkout2']==1) { echo "checked";  }  ?>>
                  
                </div>
                

            </div>
            
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a type="reset" class="btn btn-secondary" href="users-index.php">Cancel</a>
            </div>
        </form><!-- Vertical Form -->

    </div>
</div>

<?php
require "footer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    if (isset($_POST['password']))
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    else
        $password = $row['password'];
    $company = $_POST['company'];
    $merchant = $_POST['merchant'];
    $role = $_POST['role'];
    
    $checkout1=0;
    $checkout2=0;
    
    if($_POST['checkout1']>0)
        $checkout1= $_POST['checkout1'];
    
    if($_POST['checkout2']>0)
        $checkout2= $_POST['checkout2'];

    $sql = "UPDATE user set username='$username', password='$password' , company='$company' , merchant='$merchant' , role='$role', checkout2='$checkout2', checkout1='$checkout1'  where id=$id";

    if (mysqli_query($link, $sql)) {
?>

        <script type="text/javascript">
            window.location = "users-index.php";
        </script>
<?php

    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($link);
    }
    mysqli_close($link);
}


?>

<script>

</script>