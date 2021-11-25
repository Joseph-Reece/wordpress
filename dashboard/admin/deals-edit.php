<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$sql = "SELECT * FROM orders ORDER BY id DESC";
$list_orders= $link->query($sql);


$id_user = $_SESSION['id']; // get id through query string

$sql = mysqli_query($link, "SELECT * FROM user WHERE id=$id_user LIMIT 1");
$user = mysqli_fetch_assoc($sql);



$sql = mysqli_query($link, "SELECT * FROM settings LIMIT 1");
$settings = mysqli_fetch_assoc($sql);

	
	if(isset($_POST['submit']) && $user['role']=="superadmin")
	{

		$price = $_POST['price'];
		$checkout = $_POST['checkout'];
		$id=$_POST['id'];
		$currency = explode(":",$_POST['currency']);
		
		$cur = $currency[0];
		$currency_code =  $currency[1];
		
		
		
		$name= $_POST['name'];
		$subject = $_POST['subject'];
		$email_subject_to_admin = $_POST['email_subject_to_admin'];
		$email_subject_to_client = $_POST['email_subject_to_client'];
		$email_body = $_POST['email_body'];
		$email_body_admin = $_POST['email_body_admin'];
		
		
		
		$sql="UPDATE deals SET price=$price, checkout=$checkout, currency='$cur',currency_code='$currency_code', name='$name', subject='$subject',email_subject_to_admin='$email_subject_to_admin',email_subject_to_client='$email_subject_to_client', email_body='$email_body', email_body_admin='$email_body_admin' WHERE id=".$id;
		
		mysqli_query($link,$sql);
		
		header('Location:deals-add.php');
		
	}
    else if(isset($_POST['submit']) && $user['role']=="admin")
    {
        
        $price = $_POST['price'];
		$checkout = $_POST['checkout'];
		$id=$_POST['id'];
		$currency = explode(":",$_POST['currency']);
		
		$cur = $currency[0];
		$currency_code =  $currency[1];

		$name= $_POST['name'];
		
		$sql="UPDATE deals SET price=$price, checkout=$checkout, currency='$cur',currency_code='$currency_code', name='$name' WHERE id=".$id;
		
		mysqli_query($link,$sql);
		
		header('Location:deals-add.php');
        
    }
	
	
$id=$_GET['id'];
$sql = "SELECT * FROM deals WHERE id=".$id;
$list_deal= mysqli_query($link,$sql);

$list_deal = mysqli_fetch_assoc($list_deal);


require "header.php";
?>

    <div class="pagetitle">
      <h1>Edit Deal</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
				
				<form method="POST" action="deals-edit.php">
					
					<br>
					<h4> Edit Deal </h4> <br>
					<div class="form-group">
						
						<label> Enter Deal Price (Max:<?php echo $settings['limit_amount']; ?> )</label>
						<input value="<?php echo $list_deal['price']; ?>"  type="number" class="form-control" max="<?php echo $settings['limit_amount']; ?>" name="price" placeholder="Enter Deal price"/>


					</div>
					
					<br>
						
					<div class="form-group">
						
						<label> Currency </label>
						<select class="form-control" name="currency">
							
							<option value="$:USD" <?php if($list_deal['currency']=="$") { echo "selecetd";  } ?>> USD </option>
							<option value="$:AUD" <?php if($list_deal['currency']=="$") { echo "selecetd";  } ?>> AUD </option>
							<option value="€:EUR" <?php if($list_deal['currency']=="€") { echo "selecetd";  } ?>> EUR </option>
							<option value="£:GBP" <?php if($list_deal['currency']=="£") { echo "selecetd";  } ?>> GBP </option>
							
							
							
						</select>

					</div>
					
					
					<br>
					<div class="form-group">
						
						<label> Checkout</label>
						<select class="form-control" name="checkout">
							<option value="1" <?php if($list_deal['checkout']==1) { echo "selected";  }  ?>> Checkout 1 </option>
							<option value="2" <?php if($list_deal['checkout']==2) { echo "selected";  }  ?>> Checkout 2 </option>
						</select>

					</div>
					
					
					<br>
					
					<?php
					    
					    if($user['role']=="superadmin")
					    {
					
					?>
					
					
					<div class="form-group">
						
						<label> Deal Subject</label>
					    <input type="text" name="subject" class="form-control" value="<?php echo $list_deal['subject']; ?>" required/>

					</div>
					
					<br>
					
					<?php
					    
					    }
					?>
					
					
					
					<div class="form-group">
						
						<label> Deal Name</label>
					    <input type="text" name="name" class="form-control" value="<?php echo $list_deal['name']; ?>" required/>

					</div>
					
					
					<br>
					
					
					<?php
					    
					    if($user['role']=="superadmin")
					    {
					
					?>
					
					<div class="form-group">
						
						<label> Email Subject to Admin</label>
					    <input type="text" name="email_subject_to_admin" class="form-control" value="<?php echo $list_deal['email_subject_to_admin']; ?>" required/>
                        <p> Variable  #FIRSTNAME, #LASTNAME, #ORDERID, #EMAIL</p>
					</div>
					
					<br>
					
					<?php
					    
					    }
					    
					?>
					
					
					<?php
					    
					    if($user['role']=="superadmin")
					    {
					
					?>
					
					<div class="form-group">
						
						<label> Email Subject to Client</label>
					    <input type="text" name="email_subject_to_client" class="form-control" value="<?php echo $list_deal['email_subject_to_client']; ?>" required/>
                         <p> Variable  #FIRSTNAME, #LASTNAME, #ORDERID, #EMAIL</p>
					</div>  
					
					<br>
					
					<?php
					    
					    }
					    
					?>
					
					
					<?php
					    
					    if($user['role']=="superadmin")
					    {
					
					?>
					
					<div class="form-group">
						
						<label> Email Body </label>
					    <textarea name="email_body" class="form-control" rows="6" required><?php echo $list_deal['email_body']; ?></textarea>
                         <p> Variable  #FIRSTNAME, #LASTNAME, #ORDERID, #EMAIL, #CURRENCY, #AMOUNT, #COUNTRY, #PHONE, #LAST4, #CURRENCYCODE</p>
					</div>
					
					<br>
					
					<?php
					    
					    }
					    
					?>
					
					
					<?php
					    
					    if($user['role']=="superadmin")
					    {
					
					?>
					
					<div class="form-group">
						
						<label> Email Body Admin</label>
					    <textarea name="email_body_admin" class="form-control" rows="6" required><?php echo $list_deal['email_body_admin']; ?></textarea>
                         <p> Variable  #FIRSTNAME, #LASTNAME, #ORDERID, #EMAIL, #CURRENCY, #AMOUNT, #COUNTRY, #PHONE, #LAST4, #CURRENCYCODE</p>
					</div>
					
					
					<br>
					
					<?php
					    
					    }
					    
					?>
					
					<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
					
					<div class="form-group">
						<input type="submit" name="submit" value="Update" class="btn btn-warning"/>
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
