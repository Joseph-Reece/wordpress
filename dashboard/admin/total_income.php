<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$aud_income=0;
$usd_income=0;
$euro_income=0;
$pound_income=0;


$fromdate =date('Y-m-d');
$todate= date('Y-m-d');

if(isset($_POST['fromdate']))
$fromdate = date('Y-m-d',strtotime($_POST['fromdate']));

if(isset($_POST['todate']))
$todate = date('Y-m-d',strtotime($_POST['todate']));



$user_id = $_POST['agent_id'];
//usd total

$sql="SELECT * FROM deals WHERE currency_code='USD'";
$data = mysqli_query($link,$sql);
$deals_id="";

while($row=mysqli_fetch_object($data))
{
    
    $deals_id.=$row->id.",";
}

$deals_id= rtrim($deals_id, ',');

$sql="";

if($user_id>0)
{
    

    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.") AND created_at>='$fromdate' AND created_at<='$todate' AND user_id='$user_id'";

}
else
{
    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.") AND created_at>='$fromdate' AND created_at<='$todate'";

}


$usd_income = mysqli_query($link,$sql);
$usd_income = mysqli_fetch_assoc($usd_income)['amount'];




//aud total

$sql="SELECT * FROM deals WHERE currency_code='AUD'";
$data = mysqli_query($link,$sql);
$deals_id="";

while($row=mysqli_fetch_object($data))
{
    
    $deals_id.=$row->id.",";
}

$deals_id= rtrim($deals_id, ',');

$sql="";

if($user_id>0)
{
    
    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.") AND created_at>='$fromdate' AND created_at<='$todate' AND user_id='$user_id'";

}
else
{
    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.") AND created_at>='$fromdate' AND created_at<='$todate'";
}

$aud_income = mysqli_query($link,$sql);
$aud_income = mysqli_fetch_assoc($aud_income)['amount'];








//EUR total

$sql="SELECT * FROM deals WHERE currency_code='EUR'";
$data = mysqli_query($link,$sql);
$deals_id="";

while($row=mysqli_fetch_object($data))
{
    
    $deals_id.=$row->id.",";
}

$deals_id= rtrim($deals_id, ',');

$sql="";

if($user_id>0)
{
    
    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.") AND created_at>='$fromdate' AND created_at<='$todate' AND user_id='$user_id'";

}
else
{
    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.") AND created_at>='$fromdate' AND created_at<='$todate'"; 
}

$euro_income = mysqli_query($link,$sql);
$euro_income = mysqli_fetch_assoc($euro_income)['amount'];









// pounds income

$sql="SELECT * FROM deals WHERE currency_code='GBP'";
$data = mysqli_query($link,$sql);
$deals_id="";

while($row=mysqli_fetch_object($data))
{
    
    $deals_id.=$row->id.",";
}

$deals_id= rtrim($deals_id, ',');

$sql="";

if($user_id>0)
{
    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.")  AND created_at>='$fromdate' AND created_at<='$todate' AND user_id='$user_id'";
}
else
{
    $sql="SELECT sum(amount) as amount FROM orders WHERE deal_id in (".$deals_id.")  AND created_at>='$fromdate' AND created_at<='$todate'";
}

$pound_income = mysqli_query($link,$sql);
$pound_income = mysqli_fetch_assoc($pound_income)['amount'];



echo json_encode(["usd_income"=>$usd_income,"aud_income"=>$aud_income,"euro_income"=>$euro_income,"pound_income"=>$pound_income]);

?>