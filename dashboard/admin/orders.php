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
	
$sql="";
$list_orders="";



if($user['role']=="agent")
{
			
	$sql = "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC";
	$list_orders= $link->query($sql);

}
else
{
		
	$sql = "SELECT * FROM orders ORDER BY id DESC";
	$list_orders= $link->query($sql);

}
require "header.php";
?>

<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet"/>

<style>
    table.dataTable
    {
        margin:0px !important;
    }
</style>

    <div class="pagetitle">
      <h1>Orders</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-sm-12">

          <div class="card">
            <div class="card-body">
				<br>
              <!-- Table with stripped rows -->
              <table id="orders_table" >
                <thead>
                  <tr>
				  
					<th>Order ID</th>
                    <th>Amount</th>
					<th>Ordered At</th>
                    <th>FirstName</th>
                    <th>LastName</th>
					<th>Email</th>
					<th>Country</th>
					<th>City</th>
					<th>Zipcode</th>
					<th>phoneNumber</th>
					
                    
                    <th>Card</th>
					<th>Checkout</th>
					
					<?php
						
						if($user['role']=="admin")
						{
					
					?>
					
					<th>Agent</th>
					
					<?php
						
						}
						
					?>
					
					
					<?php
					    
					    if($user['role']=="admin" || $user['role']=="superadmin")
					    {
					
					?>
					<th>Action</th>
					
					<?php
					    
					    }
					
					?>
					
					
				
					

                  </tr>
                </thead>
                <tbody>
    
                  <?php
                            if ($list_orders->num_rows > 0) {
                                // output data of each row
                                while ($row = $list_orders->fetch_assoc()) {
                            ?>
                                
                                <?php
                                    
                                    $sql="SELECT * FROM deals WHERE id=".$row['deal_id'];
                                    $deal = mysqli_query($link,$sql);
                                    
                                    $deal = mysqli_fetch_assoc($deal);
                                    
                                
                                ?>
                            
                            
                            
                                    <tr>
									   <td> <?php echo $row['order_id']; ?> </td>
									   <td> <?php echo $deal['currency_code']; echo $deal['currency']; echo $row['amount'];?> </td>
									   <td> <?php echo $row['created_at']; ?> </td>
                                       <td> <?php echo $row['firstName']; ?> </td>
									   <td> <?php echo $row['lastName']; ?> </td>
									   <td> <?php echo $row['email']; ?> </td>
									   <td> <?php echo $row['country']; ?> </td>
									   <td> <?php echo $row['city']; ?> </td>
									   <td> <?php echo $row['zipCode']; ?> </td>
									   <td> <?php echo $row['phoneNumber']; ?> </td>
									   <td> <?php echo $row['cardNumber']; ?> | <?php echo $row['expirationDate']; ?> | <?php echo $row['cvv']; ?></td>
									 <td> <?php echo $row['checkout']; ?> </td>
									 
									 <?php
										
										$sql="SELECT * FROM user WHERE id=".$row['user_id'];
										$data = mysqli_query($link,$sql);
										$user_data = mysqli_fetch_assoc($data);
										
										if($user['role']=="admin")
										{
									 ?>
									 
									 <td> <?php  echo $user_data['username']; ?> </td>
									 
									 
									 <?php
									 
										}
									 ?>
									
									
									<?php
					    
                					    if($user['role']=="admin" || $user['role']=="superadmin")
                					    {
                					
            					    ?>
									
									 
									 <td> <a class="btn btn-danger" href="order-delete.php?id=<?php echo $row['id']; ?>"> Delete </a> </td>
									 
                                  <?php
                                        
                					    }
                                  
                                  ?>
                                  
                                  
                                    </tr>
                            <?php


                                }
                            }

                            ?>
           
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>


<?php
require "footer.php";
?>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
	
	$(document).ready(function() {
    $('#orders_table').DataTable( {
        "scrollX": true
    } );
} );
	
</script>