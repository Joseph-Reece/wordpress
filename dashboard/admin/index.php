<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";


$result = mysqli_query($link, "SELECT * FROM user WHERE role='agent'");


require "header.php";
?>

<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <div class="row">
         <form id="total_income_form">
        <div class="col-sm-6">
            
            <div class="row">
            
               
            
                <div class="form-group col-sm-4">
                    <label>From Date</label>
                    <input type="date" name="fromdate" class="form-control" value="<?php echo date('Y-m-d'); ?>"/>
                </div>
                
                
                <div class="form-group col-sm-4">
                    <label>To Date</label>
                    <input type="date" name="todate" class="form-control" value="<?php echo date('Y-m-d'); ?>"/>
                </div>

                
                 <div class="form-group col-sm-4">
                    <label>Select Agent</label>
                    <select class="form-control" name="agent_id">
                        
                        
                        <option value="0">All Agents</option>
                        
                        <?php
                            
                            while($row=mysqli_fetch_object($result))
                            {
                            
                        ?>
                        
                            <option value="<?php echo $row->id ?>"> <?php echo $row->username; ?> </option>
                        
                        
                        <?php
                        
                            }
                            
                        ?>
                        
                    </select>
                </div>
                
                <br>
                <br>
                <br>
                
                <div class="row">
                    <div class="form-group col-sm-12 text-center">
                        <button type="button" class="btn btn-primary" onclick="total_income()">Search</button>
                    </div>
                    
                </div>
                
              
                
                
                
            </div>
            
            <br>
            <div>
              <canvas id="total_income_chart"></canvas>
            </div>
 
        </div>
        
         </form> 
        
    </div>
    
<?php
require "footer.php";
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var income_chart=null;
function total_income()
{
    
    var form = $("#total_income_form").serialize();
    
    if(income_chart!=null)
    {
        
        income_chart.destroy();
    
    }
     const labels = [
      'AUD',
      'USD',
      'EURO',
      'POUND'
    ];
   
   $.ajax({
      
      url:"total_income.php",
      type:"POST",
      data:form,
      success:function(data)
      {
          
          var json = JSON.parse(data);
          
         var data = {
              labels: labels,
              datasets: [
                  {
                    label: 'TOTAL INCOME',
                    backgroundColor: ["red", "blue","green","yellow"],
                   
                    data: [json.aud_income,json.usd_income,json.euro_income,json.pound_income],
                  }
                  
              
              ]
            };
            
            var config = {
              type: 'bar',
              data: data,
              options: {}
            };
            
            
            
              income_chart = new Chart(
                document.getElementById('total_income_chart'),
                config
              );
              
              
      }
       
   });
    
    
      
      
}


total_income();
</script>