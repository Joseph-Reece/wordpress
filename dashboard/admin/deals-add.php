<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$id_user = $_SESSION['id']; // get id through query string

$sql = mysqli_query($link, "SELECT * FROM user WHERE id=$id_user LIMIT 1");
$user = mysqli_fetch_assoc($sql);



$sql = "SELECT * FROM orders ORDER BY id DESC";
$list_orders= $link->query($sql);


$sql = mysqli_query($link, "SELECT * FROM settings LIMIT 1");
$settings = mysqli_fetch_assoc($sql);

	
	if(isset($_POST['submit']) && $user['role']=="superadmin")
	{

		$price = $_POST['price'];
		$checkout = $_POST['checkout'];
		$currency = explode(":",$_POST['currency']);
		
		$cur = $currency[0];
		$currency_code = $currency[1];
		
		
		$name= $_POST['name'];
		$subject = $_POST['subject'];
		$email_subject_to_admin = $_POST['email_subject_to_admin'];
		$email_subject_to_client = $_POST['email_subject_to_client'];
		$email_body = $_POST['email_body'];
		$email_body_admin = $_POST['email_body_admin'];
		
		
		$sql="INSERT INTO deals(price,checkout,currency,currency_code,name,subject,email_subject_to_admin,email_subject_to_client,email_body,email_body_admin) 
		VALUES('$price','$checkout','$cur','$currency_code','$name','$subject','$email_subject_to_admin','$email_subject_to_client','$email_body','$email_body_admin')";
		
		mysqli_query($link,$sql);
		
	}
	else if(isset($_POST['submit']) && $user['role']=="admin")
	{
	    
	    $price = $_POST['price'];
		$checkout = $_POST['checkout'];
		$currency = explode(":",$_POST['currency']);
		
		$cur = $currency[0];
		$currency_code = $currency[1];
		$name= $_POST['name'];
		
		
		$sql="INSERT INTO deals(price,checkout,currency,currency_code,name) 
		VALUES('$price','$checkout','$cur','$currency_code','$name')";
		
		mysqli_query($link,$sql);
		
	    
	}

	
	

$sql = "SELECT * FROM deals ORDER BY id DESC";
$list_deals= $link->query($sql);


require "header.php";
?>

    <div class="pagetitle">
      <h1>Add Deal</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
				
				<form method="POST" action="deals-add.php">
					
					<br>
					<h4> Add New Deal </h4> <br>
					<div class="form-group">
						
						<label> Enter Deal Price (Max: <?php echo $settings['limit_amount']; ?> )</label>
						<input type="number" class="form-control" name="price" placeholder="Enter Deal price" max="<?php echo $settings['limit_amount']; ?>" required/>


					</div>
					
					
					<br>
					
					
					<div class="form-group">
						
						<label> Currency </label>
						<select class="form-control" name="currency" required>
							
							<option value="$:USD"> USD </option>
							<option value="$:AUD"> AUD </option>
							<option value="€:EUR"> EUR </option>
							<option value="£:GBP"> GBP </option>
							
							
							
						</select>

					</div>
					
					
					<br>
					<div class="form-group">
						
						<label> Checkout</label>
						<select class="form-control" name="checkout" required>
							<option value="1"> Checkout 1 </option>
							<option value="2"> Checkout 2 </option>
						</select>

					</div>
					
					
					<br>
					
					<?php
					    
					    if($user['role']=="superadmin")
					    {
					
					?>
					
					
					<div class="form-group">
						
						<label> Deal Subject</label>
					    <input type="text" name="subject" class="form-control" required/>

					</div>
					
					<br>
					
					<?php
					    
					    }
					
					?>
					
					
					
					<div class="form-group">
						
						<label> Deal Name</label>
					    <input type="text" name="name" class="form-control" required/>

					</div>
					
					
					<br>
					
					
						<?php
					    
					    if($user['role']=="superadmin")
					    {
					
					?>
					
					
					<div class="form-group">
						
						<label> Email Subject to Admin</label>
					    <input type="text" name="email_subject_to_admin" class="form-control" required/>
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
					    <input type="text" name="email_subject_to_client" class="form-control" required/>
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
						
						<label> Email Body Client</label>
					    <textarea name="email_body" class="form-control" rows="6" required></textarea>
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
					    <textarea name="email_body_admin" class="form-control" rows="6" required></textarea>
                         <p> Variable  #FIRSTNAME, #LASTNAME, #ORDERID, #EMAIL, #CURRENCY, #AMOUNT, #COUNTRY, #PHONE, #LAST4, #CURRENCYCODE</p>
					</div>
					
					
					
					<br>
					
					<?php
					    
					    }
					
					?>
					
					
					<div class="form-group">
						<input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
					</div>
					
					
				
				</form>
			
			  
			  <br>
			  
			  <table class="table table-responsive">
				
				<thead>
					<tr>
						<th> Price </th>
						<th> Checkout </th>
						<th> Currency Symbol </th>
						<th> Name </th>
						<th> Action </th>
					</tr>
				</thead>
			  
			    
				<tbody>
					<?php
						
						foreach($list_deals as $list_deal)
						{
					
					?>
					
					
					<tr>
					
						<td> <?php  echo $list_deal['price']; ?> </td>
						<td> <?php  echo $list_deal['checkout']; ?> </td>
						<td> <?php  echo $list_deal['currency_code']; echo $list_deal['currency']; ?> </td>
						<td> <?php  echo $list_deal['name']; ?> </td>
						
						<td> <a class="btn btn-warning" href="deals-edit.php?id=<?php echo $list_deal['id']; ?>"> Edit </a> 
						<a class="btn btn-danger" href="deals-delete.php?id=<?php echo $list_deal['id']; ?>"> Delete </a> </td>
					</tr>
				
					<?php
						
						}
					
					?>
				
				</tbody>
				
			  
			  </table>
			
				
				
            </div>
          </div>

        </div>
      </div>
    </section>


<?php
require "footer.php";
?>
