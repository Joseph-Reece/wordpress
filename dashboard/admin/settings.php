<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$sql="SELECT * FROM settings WHERE id=1";
$data = mysqli_query($link,$sql);
$data = mysqli_fetch_assoc($data);



if(isset($_POST['submit']))
{
    
    
    if(!empty($_FILES['logo']['tmp_name']))
    {
     
       
        if(move_uploaded_file($_FILES['logo']['tmp_name'], __DIR__.'/assets/img/'. $_FILES["logo"]['name']))
        {
            
              $file_name=$_FILES["logo"]['name'];
                
                $sql="UPDATE settings SET logo='$file_name' WHERE id=1";
                mysqli_query($link,$sql);
            
        }
       
       
       
       
    }
    
    
    
    if(!empty($_FILES['favicon']['tmp_name']))
    {
     
       
        if(move_uploaded_file($_FILES['favicon']['tmp_name'], __DIR__.'/assets/img/'. $_FILES["favicon"]['name']))
        {
            
              $file_name=$_FILES["favicon"]['name'];
                
                $sql="UPDATE settings SET favicon='$file_name' WHERE id=1";
                mysqli_query($link,$sql);
            
        }
       
       
       
       
    }
    
    $webhook= $_POST['webhook'];
    $chat_code = base64_encode($_POST['chat_code']);
    $limit_amount = $_POST['limit_amount'];
    $limit_user = $_POST['limit_user'];
    
   
    
    $sql="UPDATE settings SET webhook='$webhook',chat_code='$chat_code', limit_amount='$limit_amount', limit_user='$limit_user' WHERE id=1";


   
    mysqli_query($link,$sql);
    
    
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
        
        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    
                    <h4> Settings </h4>
                    
                    <form method="POST" action="settings.php" enctype="multipart/form-data">
                    
                        <div class="form-group">
                            <label> Webhook Link </label>
                            
                            <div style="display:flex;">
                            <input readonly id="webhook" type="text" value="<?php echo $data['webhook']; ?>" name="webhook" class="form-control"/>
                            
                            <button onclick="enable_edit()" style="margin-left:10px;" class="btn btn-primary btn-xs" type="button">Edit</button>
                            
                            </div>
                        </div>
                        
                        <br>
                        
                        <div class="form-group">
                            <label> Upload Logo </label>
                            <input type="file" name="logo" class="form-control"/>
                            <br>
                            
                            <img src="/dashboard/admin/assets/img/<?php echo $data['logo']; ?>" width="70"/>
                           <br>
                        <br>
                        
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <label> Favicon </label>
                            <input type="file" name="favicon" class="form-control"/>
                            <br>
                            
                            <img src="/dashboard/admin/assets/img/<?php echo $data['favicon']; ?>" width="70"/>
                           <br>
                        <br>
                        
                        </div>
                        
                        
                        <div class="form-group">
                            
                            <label>Limit Deal Amount</label>
                            <input value="<?php echo $data['limit_amount']; ?>" type="number" class="form-control" name="limit_amount"/>
                        </div>
                        <br>
                        
                        
                        
                        <div class="form-group">
                            
                            <label>Limit Users</label>
                            <input value="<?php echo $data['limit_user']; ?>" type="number" class="form-control" name="limit_user"/>
                        </div>
                        
                        
                        <br>
                        
                        
                        
                        <div class="form-group">
                            
                            <textarea name="chat_code" class="form-control" rows="6" placeholder="Enter Chat Widget Code"> 
                                <?php echo base64_decode($data['chat_code']); ?> 
                            </textarea>
                            
                        </div>
                        
                        <br>
                        
                       
                        
                        <div class="form-group">
                           <input type="submit" name="submit" value="Update" class="btn btn-primary"/>
                        </div>
                    
                    
                    </form>
                    
                    
                </div>
            </div>

        </div>
    </div>
</section>


<?php
require "footer.php";



?>

<script>
    function enable_edit()
    {
        
        $("#webhook").removeAttr("readonly");
        
    }
</script>