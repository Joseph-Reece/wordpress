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


$sql="SELECT * FROM deals where checkout=1";
$deals_checkout_1=mysqli_query($link,$sql);




$sql="SELECT * FROM deals where checkout=2";
$deals_checkout_2=mysqli_query($link,$sql);



$id_user = $_SESSION['id']; // get id through query string

$sql = mysqli_query($link, "SELECT * FROM user WHERE id=$id_user LIMIT 1");
$user = mysqli_fetch_assoc($sql);

require "header.php";
?>

    <div class="pagetitle">
      <h1>Deals</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
			
				<div id="copy_status" style="margin-top:10px;"> </div>
				<br>
				
				<?php
					
					if($user['role']=="admin" || $user['role']=="superadmin")
					{
				
				?>
				<a href="deals-add.php" class="btn btn-primary"> Add/Edit </a>
				
				
				<?php
					
					}
					
				?>
				
				
			
			    
			    <div class="row">
			
			
			    <?php
			        
			        if(($user['role']=="admin" || $user['role']=="superadmin") || ($user['role']=="agent" && $user['checkout1']==1))
			        {
			    
			    ?>
				
				
				<br><br>
			        
			
				<h4> Credit Cards Only </h4>
				
				
				<?php
					
					while($row=mysqli_fetch_object($deals_checkout_1))
					{
					
				?>
				
			    <div class="col-sm-3">
			        
			       
			        
    			    <b style="margin:10px;"><?php echo $row->name; ?></b><br>
    				<a href="javascript:create_link(<?php echo $row->price; ?>,1,<?php echo $row->id ?>)" class="btn btn-success" style="width:100%;margin:10px;"> Pay <?php echo $row->currency; ?><?php echo $row->price; ?> <?php echo $row->currency_code; ?> </a> 
    				
				</div>
			
				<?php
				   
					}
					
			        }
				
				?>
				
			</div>	
				
				
				<?php
				    
				    if(($user['role']=="admin" || $user['role']=="superadmin") || ($user['role']=="agent" && $user['checkout2']==1))
				    {
				
				?>
				
				
				
				
				<br><br>
				
				<h4> Credit Card, Paypal, Crypto </h4>
				
				
			    <div class="row">
				
				<?php
					
					while($row=mysqli_fetch_object($deals_checkout_2))
					{
					
				?>
				
				 <div class="col-sm-3">
				     <b style="margin:10px;"><?php echo $row->name; ?></b><br>
			    	<a href="javascript:create_link(<?php  echo $row->price; ?>,2,<?php echo $row->id ?>)" class="btn btn-success" style="width:20%;margin:10px;"> Pay <?php echo $row->currency; ?><?php  echo $row->price; ?> <?php echo $row->currency_code; ?></a> 
				
				</div>
				
				<?php
					
					}
					
				    }
					
				?>
				
				
			    
			    <div>
			
			
				
				
            </div>
          </div>

        </div>
      </div>
    </section>


<?php
require "footer.php";
?>

<script>
	
	function create_link(amount,checkout,deal_id)
	{
		
		$.ajax({
			
			url:"create_link.php?amount="+amount+"&checkout="+checkout+"&deal_id="+deal_id,
			type:"POST",
			success:function(data)
			{
				var json= JSON.parse(data);
				var text="";
				
				if(checkout==1)
				{
					 text = "http://192.236.162.175/dashboard/checkout.php?order_id="+json.order_id+"&tkn="+json.tkn+"&amount="+json.amount;
				
				}
				else if(checkout==2)
				{
					 text = "http://192.236.162.175/dashboard/check-out/?order_id="+json.order_id+"&tkn="+json.tkn+"&amount="+json.amount;
				
					
				}
				
				
				  const el = document.createElement('textarea');
				  el.value = text;
				  document.body.appendChild(el);
				  el.select();
				  document.execCommand('copy');
				  document.body.removeChild(el);
				  
				  var html="<div class='alert alert-success'> Link Copied </div>";
				  
				  $("#copy_status").html(html);
				  
				 setTimeout(function(){ 
					
					$("#copy_status").html('');

				 }, 3000);

				
			}
			
		});
		
	}

</script>