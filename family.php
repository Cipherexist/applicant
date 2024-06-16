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

          $.post("family_savedetails.php",
          {
            mycivilstatus: $("#civilstatus").val(), 
            mymarriagedate: $("#marriagedate").val(), 
            mywifecompletename: $("#wifecompletename").val(), 
            mywifebirthdate: $("#wifebirthdate").val(), 
            mywifeoccupation: $("#wifeoccupation").val(),
            mychildrens: $("#childrens").val(),
            myfathername: $("#fathername").val(),
            myfatherbirthdate: $("#fatherbirthdate").val(),
            mymothername: $("#mothername").val(),
            mymotherbirthdate: $("#motherbirthdate").val(),
            mypersoncontact: $("#personcontact").val(),
            mypersonrelationship: $("#personrelationship").val(),
            mypersonaddress: $("#personaddress").val(),
            mypersoncontactno: $("#personcontactno").val(),
            mypersonaddress: $("#personaddress").val(),
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
                  <a class="nav-link active" href="family.php">Family details</a>
                </li>  
                <li class="nav-item">
                  <a class="nav-link" href="national_documents.php">National Document</a>
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

        
        <div class="row" style="margin-top:20px;  ">
                  <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="civilstatus" class="form-label">Civil / Marital Status</label>
                                    <input type="text" name="civilstatus" id="civilstatus" class="form-control" placeholder="" value="<?php echo $rows['civilstatus']; ?>">
                            </div>
                  </div>
                  
                  <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="marriagedate" class="form-label">Marriage Date</label>
                                    <input type="text" name="marriagedate" id="marriagedate" class="form-control" placeholder="" value="<?php echo $rows['marriagedate']; ?>">
                            </div>
                  </div>

        </div>

        <div class="row">
                 <div class="col-md-12">
                            <div class="form-group"> 
                                    <label for="wifecompletename" class="form-label">Spouse Complete Name</label>
                                    <input type="text" name="wifecompletename" id="wifecompletename" class="form-control" placeholder="" value="<?php echo $rows['wifecompletename']; ?>">
                            </div>
                  </div>
        </div>

        
        <div class="row">
                 <div class="col-md-5">
                            <div class="form-group"> 
                                    <label for="wifebirthdate" class="form-label">Spouse Birth date</label>
                                    <input type="text" name="wifebirthdate" id="wifebirthdate" class="form-control" placeholder="" value="<?php echo $rows['wifebirthdate']; ?>">
                            </div>
                  </div>

                  <div class="col-md-5">
                            <div class="form-group"> 
                                    <label for="wifeoccupation" class="form-label">Spouse Occupation</label>
                                    <input type="text" name="wifeoccupation" id="wifeoccupation" class="form-control" placeholder="" value="<?php echo $rows['wifeoccupation']; ?>">
                            </div>
                  </div>

                  <div class="col-md-2">
                            <div class="form-group"> 
                                    <label for="childrens" class="form-label">Children</label>
                                    <input type="text" name="childrens" id="childrens" class="form-control" placeholder="" value="<?php echo $rows['childrens']; ?>">
                            </div>
                  </div>
        </div>


        <div class="row">
                 <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="fathername" class="form-label">Father Complete Name</label>
                                    <input type="text" name="fathername" id="fathername" class="form-control" placeholder="" value="<?php echo $rows['fathername']; ?>">
                            </div>
                  </div>

                  <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="fatherbirthdate" class="form-label">Father Birthdate</label>
                                    <input type="text" name="fatherbirthdate" id="fatherbirthdate" class="form-control" placeholder="" value="<?php echo $rows['fatherbirthdate']; ?>">
                            </div>
                  </div>
        </div>

        <div class="row">
                 <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="mothername" class="form-label">Mother Complete Name</label>
                                    <input type="text" name="mothername" id="mothername" class="form-control" placeholder="" value="<?php echo $rows['mothername']; ?>">
                            </div>
                  </div>

                  <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="motherbirthdate" class="form-label">Mother Birthdate</label>
                                    <input type="text" name="motherbirthdate" id="motherbirthdate" class="form-control" placeholder="" value="<?php echo $rows['motherbirthdate']; ?>">
                            </div>
                  </div>
        </div>

        
        <div class="row">
                 <div class="col-md-12">
                            <div class="form-group"> 
                                    <label for="personcontact" class="form-label">Person/s to contact in case of Emergency</label>
                                    <input type="text" name="personcontact" id="personcontact" class="form-control" placeholder="" value="<?php echo $rows['personcontact']; ?>">
                            </div>
                  </div>
        </div>

        <div class="row">
                 <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="personrelationship" class="form-label">Relationship</label>
                                    <input type="text" name="personrelationship" id="personrelationship" class="form-control" placeholder="" value="<?php echo $rows['personrelationship']; ?>">
                            </div>
                  </div>

                  <div class="col-md-6">
                            <div class="form-group"> 
                                    <label for="personcontactno" class="form-label">Contact Number</label>
                                    <input type="text" name="personcontactno" id="personcontactno" class="form-control" placeholder="" value="<?php echo $rows['personcontactno']; ?>">
                            </div>
                  </div>
        </div>


       
        <div class="row">
                 <div class="col-md-12">
                            <div class="form-group"> 
                                    <label for="personaddress" class="form-label">Address</label>
                                    <input type="text" name="personaddress" id="personaddress" class="form-control" placeholder="" value="<?php echo $rows['personaddress']; ?>">
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

  

  </body>
</html>