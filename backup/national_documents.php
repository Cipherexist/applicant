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

          $.post("national_documents_save.php",
          {
            mypassport_docs: $("#passport_docs").val(), 
            mypassport_issue: $("#passport_issue").val(), 
            mypassport_valid: $("#passport_valid").val(), 
            mysirb_docs: $("#sirb_docs").val(), 
            mysirb_issue: $("#sirb_issue").val(), 
            mysirb_valid: $("#sirb_valid").val(), 
            mypoea_docs: $("#poea_docs").val(), 
            mypoea_issue: $("#poea_issue").val(), 
            mypoea_valid: $("#poea_valid").val(), 
            mynbi_docs: $("#nbi_docs").val(), 
            mynbi_issue: $("#nbi_issue").val(), 
            mynbi_valid: $("#nbi_valid").val(), 
            mymarina_docs: $("#marina_docs").val(), 
            mymarina_issue: $("#marina_issue").val(), 
            mymarina_valid: $("#marina_valid").val(), 
            myvisa_docs: $("#visa_docs").val(), 
            myvisa_issue: $("#visa_issue").val(), 
            myvisa_valid: $("#visa_valid").val()
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
                  <a class="nav-link active" href="national_documents.php">National Document</a>
                </li> 

                <li class="nav-item" >
                  <a class="nav-link" href="marina_documents.php">Marina Document</a>
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



                                                                                                                  
        <div class="row" style="margin-top:20px; margin-left:10px; text-align:center">
        <h6>Passport<h6>
        </div>

        <div class="row" >
             <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" id="passport_docs" id="passport_docs" class="form-control" placeholder="Enter Document Number" value="<?php echo $rows['passport_doc']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter Passport Document Number</small>
                            </div>
                  </div>
                  
                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" id="passport_issue" id="passport_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['passport_issue']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter Passport Issue date</small>
                                  </div>
                  </div>


                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" id="passport_valid" id="passport_valid" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['passport_valid']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter PASSPORT Validity</small>
                                  </div>
                  </div>
        </div>

         
        <div class="row" style="margin-top:10px; margin-left:10px; text-align:center">
            <h6>SIRB<h6>
        </div>



        <div class="row" >
             <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="sirb_docs" id="sirb_docs" class="form-control" placeholder="Enter Document Number" value="<?php echo $rows['sirb_doc']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter SIRB Document Number</small>
                                  </div>
                  </div>
                  
                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="sirb_issue"  id="sirb_issue"  class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['sirb_issue']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter SIRB Issue date</small>
                                  </div>
                  </div>

                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="sirb_valid"  id="sirb_valid"  class="form-control" placeholder="Enter Validity" value="<?php echo $rows['sirb_valid']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter SIRB Validity</small>
                                  </div>
                  </div>
        </div>




        <div class="row" style="margin-top:10px; margin-left:10px; text-align:center">
            <h6>POEA - Ereg<h6>
        </div>

        <div class="row" >
             <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="poea_docs" id="poea_docs" class="form-control" placeholder="Enter Document Number" value="<?php echo $rows['poea_doc']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter POEA Document Number</small>
                             </div>
                  </div>
                  
                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="poea_issue" id="poea_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['poea_issue']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter POEA - Ereg Issue date</small>
                                  </div>
                  </div>

                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="number" name="poea_valid" id="poea_valid" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['poea_valid']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter POEA - Ereg Validity</small>
                                  </div>
                  </div>
        </div>

        

        <div class="row" style="margin-top:10px; margin-left:10px; text-align:center">
            <h6>NBI Clearance<h6>
        </div>

        <div class="row" >
             <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="nbi_docs" id="nbi_docs" class="form-control" placeholder="Enter Document Number" value="<?php echo $rows['nbi_doc']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter NBI Document Number</small>
                                   
                                  </div>
                  </div>
                  
                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="nbi_issue" id="nbi_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['nbi_issue']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter NBI-Clearance Issue date</small>
                                  </div>
                  </div>

                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="nbi_valid" id="nbi_valid" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['nbi_valid']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter NBI-Clearance Validity</small>
                                  </div>
                  </div>
        </div>

        <div class="row" style="margin-top:10px; margin-left:10px; text-align:center">
            <h6>MARINA License<h6>
        </div>

        <div class="row" >
             <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="marina_docs" id="marina_docs" class="form-control" placeholder="Enter Document Number" value="<?php echo $rows['marina_doc']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter MARINA License Document Number</small>
                                  </div>
                  </div>
                  
                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="marina_issue" id="marina_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['marina_issue']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter MARINA Issued date</small>
                                  </div>
                  </div>

                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="marina_valid" id="marina_valid" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['marina_valid']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter MARINA License Validity</small>
                                  </div>
                  </div>
        </div>

        <div class="row" style="margin-top:10px; margin-left:10px; text-align:center">
            <h6>VISA<h6>
        </div>

        <div class="row" >
                 <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="visa_docs" id="visa_docs" class="form-control" placeholder="Enter Document Number" value="<?php echo $rows['visa_doc']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter VISA Document Number</small>
                                  </div>
                  </div>
                  
                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="visa_issue" id="visa_issue" class="form-control" placeholder="Enter Issue date" value="<?php echo $rows['visa_issue']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter VISA Issue date</small>
                                  </div>
                  </div>

                  <div class="col-md-3">
                            <div class="form-group"> 
                                   <input type="text" name="visa_valid" id="visa_valid" class="form-control" placeholder="Enter Validity" value="<?php echo $rows['visa_valid']; ?>">
                                   <small id="helpId" class="form-text text-muted">Enter VISA Validity</small>
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
        <div class="form-group">
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
        
            $('#passport_issue').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#sirb_issue').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });

            $('#poea_issue').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });

            $('#nbi_issue').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });

            $('#marina_issue').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });

            $('#visa_issue').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });


            $('#passport_valid').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });


            $('#sirb_valid').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });


            $('#marina_valid').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#visa_valid').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            $('#nbi_valid').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });



          
     

  </script>

  </body>
</html>