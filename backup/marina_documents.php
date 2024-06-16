<!doctype html>
<html lang="en">
  <head>

  <?php
  include "dbconfig.php";
  include "forcookie.php"; 
  include "title.php"; 
  include "modules.php";

  @$nav1 =  "active"; 
  @$nav2 =  ""; 
  @$nav3 =  ""; 
  @$nav4 =  ""; 

  
  ?> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 	
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
        




<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

   <!--  <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/style.css">


  <script>
        $(document).ready(function() 
          {
                 
            var table = $('.mydatatable').DataTable();

        });


        function savedetails()
        {

          $.post("marina_documents_save.php",
          {
            mybt_cop_doc: $("#bt_cop_doc").val(), 
            mybt_cop_issue: $("#bt_cop_issue").val(), 
            mybt_cop_expiry: $("#bt_cop_expiry").val(), 
            mysdsd_cop_doc: $("#sdsd_cop_doc").val(), 
            mysdsd_cop_issue: $("#sdsd_cop_issue").val(), 
            mysdsd_cop_expiry: $("#sdsd_cop_expiry").val(), 
            mypscrb_cop_doc: $("#pscrb_cop_doc").val(), 
            mypscrb_cop_issue: $("#pscrb_cop_issue").val(), 
            mypscrb_cop_expiry: $("#pscrb_cop_expiry").val(), 
            myaff_cop_doc: $("#aff_cop_doc").val(), 
            myaff_cop_issue: $("#aff_cop_issue").val(), 
            myaff_cop_expiry: $("#aff_cop_expiry").val(), 
            myfrb_cop_doc: $("#frb_cop_doc").val(), 
            myfrb_cop_issue: $("#frb_cop_issue").val(), 
            myfrb_cop_expiry: $("#frb_cop_expiry").val(), 
            mybtlgt_cop_doc: $("#btlgt_cop_doc").val(), 
            mybtlgt_cop_issue: $("#btlgt_cop_issue").val(), 
            mybtlgt_cop_expiry: $("#btlgt_cop_expiry").val(), 
            myatlgt_cop_doc: $("#atlgt_cop_doc").val(), 
            myatlgt_cop_issue: $("#atlgt_cop_issue").val(), 
            myatlgt_cop_expiry: $("#atlgt_cop_expiry").val(), 
            mybtoc_cop_doc: $("#btoc_cop_doc").val(), 
            mybtoc_cop_issue: $("#btoc_cop_issue").val(), 
            mybtoc_cop_expiry: $("#btoc_cop_expiry").val(), 
            myatoc_cop_doc: $("#atoc_cop_doc").val(), 
            myatoc_cop_issue: $("#atoc_cop_issue").val(), 
            myatoc_cop_expiry: $("#atoc_cop_expiry").val(), 
            myatot_cop_doc: $("#atot_cop_doc").val(), 
            myatot_cop_issue: $("#atot_cop_issue").val(), 
            myatot_cop_expiry: $("#atot_cop_expiry").val()
          },function(result)
          {
            const date = new Date();

              let day = date.getDate();
              let month = date.getMonth() + 1;
              let year = date.getFullYear();

              // This arrangement can be altered based on how we want the date's format to appear.
              let currentDate = `${day}-${month}-${year}`;
              var showdate = "Successfull Saved: " + currentDate;
              $("#reloadpage").empty();
              $("#reloadpage").append(showdate); 

              $('#reloadprogress').empty();
              $('#reloadprogress').append(result);

          }); 




        }

        function uploadfile() {
               
               //  var filename = $('#classnumberupload').val(); 
                 var file_data = $('#fileupload').prop('files')[0]; 
                 var form_data = new FormData(); 
     
                 form_data.append("file",file_data); 
               //  form_data.append("filename",filename); 
     
                 $.ajax({
                   url: "uploadpicture.php",
                   type: "POST", 
                   dataType: 'script', 
                   cache: false, 
                   contentType: false,  
                   processData: false, 
                   data: form_data, 
                   success:function(result)
                   {
                     if(result==1)
                     {
                         alert("Upload Error"); 
                     }
                     else 
                     {
                       $('#pictureuploadmodal').modal('hide');
                      $('#reloadpic').empty();
                       $('#reloadpic').append(result);
                     } 
                   }
     
     
     
                 }); 
                 
     
     
               }
               




  </script> 

  </head>
  <body> 


		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		
              <?php include "navigation.php"; ?>

	        <div class="footer">
	        	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
           
            <button type="button" id="sidebarCollapse" class="btn btn-info">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <?php include "usershow.php" ?> 
                  <!-- 
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

      
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                  </ul>
                </div>
            -->
          </div>
        </nav>

        <!-- Button trigger modal 
        <button type="button" class="btn btn-primary btn" data-toggle="modal" data-target="#modelId">
          Launch
        </button>
        -->

      

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Quiz Results (Fernandez, Mark)</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <div class="modal-body">
                <div class="container-fluid">
                
                <div class="row" style="margin-top: 10px; overflow:auto;">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Session</th>
                        <th>Result</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td scope="row">1</td>
                        <td>80</td>
                        <td>Passed</td>
                      </tr>
                      <tr>
                      <td scope="row">2</td>
                        <td>50</td>
                        <td>Failed</td>
                      </tr>
                    </tbody>
                  </table>

                </div>




          
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        




        <script>
          $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            
          });



        </script>


<div class="row">
          <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="home.php">Personal Details</a>
                </li>
               
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="education.php">Educational attainment</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link " href="family.php">Family details</a>
                </li>  

                <li class="nav-item">
                  <a class="nav-link " href="national_documents.php">National Document</a>
                </li> 

                <li class="nav-item" >
                  <a class="nav-link active" href="marina_documents.php">Marina Document</a>
                </li> 
                
                <li class="nav-item">
                  <a class="nav-link" href="seaservice.php">Sea Service</a>
                </li>  
            
          </ul>
</div>

<!-- START --> 
<style>
h6 
{
  color:black;
}

</style>


<div style="padding: 10px; height:70%;">

        <?php
        @$username =  $_COOKIE['usname']; 
        $sql = "Select * from `applicantinfo` Where username Like '$username'"; 
        $dbt = mysqli_query($sqlcon,$sql); 

        if(!mysqli_error($sqlcon))
        {
          while($rows=mysqli_fetch_assoc($dbt))
          {


            

        ?> 


<div class="card">
        <div class="card-header">
              BASIC TRAINING (COP)
            </div>
          
  <div class="card-body">
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="bt_cop_doc" id="bt_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['bt_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="bt_cop_issue" id="bt_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['bt_cop_issue']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="bt_cop_expiry" id="bt_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['bt_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>


 <div class="card" style="margin-top: 10px;">
        <div class="card-header">
             SDSD (COP)
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="sdsd_cop_doc" id="sdsd_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['sdsd_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="sdsd_cop_issue" id="sdsd_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['sdsd_cop_issue']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="sdsd_cop_expiry" id="sdsd_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['sdsd_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>

<div class="card" style="margin-top: 10px;">
        <div class="card-header">
            PSCRB COP
            </div>
          
  <div class="card-body" >
  
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="pscrb_cop_doc" id="pscrb_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['pscrb_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="pscrb_cop_issue" id="pscrb_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['pscrb_cop_issue']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="pscrb_cop_expiry" id="pscrb_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['pscrb_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>

<div class="card" style="margin-top: 10px;">
        <div class="card-header">
            AFF COP
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="aff_cop_doc" id="aff_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['aff_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="aff_cop_issue" id="aff_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['aff_cop_issue']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="aff_cop_expiry" id="aff_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['aff_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>


<div class="card" style="margin-top: 10px;">
        <div class="card-header">
         FRB COP
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="frb_cop_doc" id="frb_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['frb_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="frb_cop_issue" id="frb_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['frb_cop_issue']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>                 <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="frb_cop_expiry" id="frb_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['frb_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>

<div class="card" style="margin-top: 10px;">
        <div class="card-header">
        BTLGT COP 
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="btlgt_cop_doc" id="btlgt_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['btlgt_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="btlgt_cop_issue" id="btlgt_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['btlgt_cop_issue']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="btlgt_cop_expiry" id="btlgt_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['btlgt_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>



<div class="card" style="margin-top: 10px;">
        <div class="card-header">
       ATLGT COP
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atlgt_cop_doc" id="atlgt_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['atlgt_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atlgt_cop_issue" id="atlgt_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['atlgt_cop_issue']; ?>">
          
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atlgt_cop_expiry" id="atlgt_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['atlgt_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>

     

<div class="card" style="margin-top: 10px;">
        <div class="card-header">
        BTOC COP
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="btoc_cop_doc" id="btoc_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['btoc_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="btoc_cop_issue" id="btoc_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['btoc_cop_issue']; ?>">
          
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="btoc_cop_expiry" id="btoc_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['btoc_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>


<div class="card" style="margin-top: 10px;">
        <div class="card-header">
        ATOC COP
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atoc_cop_doc" id="atoc_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['atoc_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atoc_cop_issue" id="atoc_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['atoc_cop_issue']; ?>">
          
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                              <input type="text" id="atoc_cop_expiry" id="atoc_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['atoc_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>

<div class="card" style="margin-top: 10px;">
        <div class="card-header">
        ATOT COP
            </div>
          
  <div class="card-body" >
          
            <div class="row" >
                <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atot_cop_doc" id="atot_cop_doc" class="form-control" placeholder="Enter Certificate Number" value="<?php echo $rows['atot_cop_doc']; ?>">
                                      <small id="helpId" class="form-text text-muted">Certificate Number</small>
                                </div>
                      </div>
                      
                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atot_cop_issue" id="atot_cop_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['atot_cop_issue']; ?>">
          
                                      <small id="helpId" class="form-text text-muted">Enter Issue date</small>
                                      </div>
                      </div>


                      <div class="col-md-3">
                                <div class="form-group"> 
                                      <input type="text" id="atot_cop_expiry" id="atot_cop_expiry" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['atot_cop_expiry']; ?>">
                                      <small id="helpId" class="form-text text-muted">Enter Validity</small>
                                      </div>
                      </div>
            </div>
  </div>
</div>


     

     



        <?php 


                }

                }
                else 
                {
                  echo mysqli_error($sqlcon); 
                }
        ?>

   
        <div class="form-group" style="margin-top:10px;">
              <button type="button" class="btn btn-success" onclick="savedetails()">Save</button>
            </div>

            <div class="form-group">
             <p id="reloadpage" name="reloadpage"></p>
            </div>





</div>



  


</div>
          


          


     <!-- INSERT YOUR CODE HERE-->
     
     







		</div>

    <script src="js/mainjava.js"></script> 

  
    <script>
        
            $('#bt_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#bt_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#sdsd_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#sdsd_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });


            //START
            $('#pscrb_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#pscrb_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END

            
            //START
            $('#aff_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#aff_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END


            
            //START
            $('#frb_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#frb_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END


            
            //START
            $('#btlgt_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#btlgt_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END


            
            //START
            $('#atlgt_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#atlgt_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END


            
            //START
            $('#btoc_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#btoc_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END


            
            //START
            $('#atoc_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#atoc_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END


            
            //START
            $('#atot_cop_issue').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#atot_cop_expiry').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });
            //END


            



          
     

  </script>

  </body>
</html>