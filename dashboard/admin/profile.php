<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";
$password_err = "";
$password_changed = "";


switch ((isset($_GET['status']) ? $_GET['status'] : '')) {
    case 'success':
        $password_changed = "password has been reset !!";
        break;
    case 'error':
        $password_err = "Current password is not correct !!";
        break;
}


$id = $_SESSION['id']; // get id through query string

$result = mysqli_query($link, "SELECT * FROM user WHERE id=$id LIMIT 1");
$row = mysqli_fetch_assoc($result);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (password_verify($_POST['password'], $row['password'])) {

        $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

        $sql = "UPDATE user set password='$password'  where id=$id";

        if (mysqli_query($link, $sql)) {
            header('location:profile.php?status=success');

?>
            <!-- <script type="text/javascript">
                window.location = "profile.php?pass=ok";
            </script> -->

<?php
        } else {
            echo "Error: " . $sql . ":-" . mysqli_error($link);
        }
        mysqli_close($link);
    } else {
        header('location:profile.php?status=error');
    }
}


require "header.php";


?>

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <i class="bi bi-person-circle"></i>
                    <h2><?php echo $_SESSION["username"] ?></h2>
                    <h3><?php echo $row["role"] ?></h3>
                    <h3><?php echo $row["company"] ?></h3>
                    <h3><?php echo $row["merchant"] ?></h3>


                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <span class="help-block" style="color:limegreen ;"><?php echo $password_changed; ?></span>

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>

                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show pt-3 active" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="currentPassword" required>
                                        <span class="help-block" style="color:crimson ;"><?php echo $password_err; ?></span>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>


<?php
require "footer.php";



?>