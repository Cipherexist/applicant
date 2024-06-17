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
                 

            $('#yearstarted').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });

            
            $('#yearcompleted').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });



            var table = $('.mydatatable').DataTable();

          
        });


        function savedetails()
        {

          $.post("education_savedetails.php",
          {
            myhighesteducation: $("#highesteducation").val(), 
            mycoursedegree: $("#coursedegree").val(), 
            myyearstarted: $("#yearstarted").val(), 
            myschoolattended: $("#schoolattended").val(), 
            myyearcompleted: $("#yearcompleted").val()
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
                  <a class="nav-link active" aria-current="page" href="education.php">Educational attainment</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link " href="family.php">Family details</a>
                </li>  

                            
                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='national'){echo 'active';}?>" href="my_documents.php?content=national">National Document</a>
                </li> 

                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='marina'){echo 'active';}?>" href="my_documents.php?content=marina">Marina Document</a>
                </li> 

                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='all'){echo 'active';}?>" href="my_documents.php?content=all">All Documents</a>
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
                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="highesteducation" class="form-label">Highest Education</label>
                                    <input type="text" name="highesteducation" id="highesteducation" class="form-control" placeholder="" value="<?php echo $rows['highesteducation']; ?>">
                            </div>
                  </div>
                  
                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="coursedegree" class="form-label">Course / Degree</label>
                                    <input type="text" name="coursedegree" id="coursedegree" class="form-control" placeholder="" value="<?php echo $rows['coursedegree']; ?>">
                            </div>
                  </div>

                  <div class="col-md-2">
                            <div class="form-group"> 
                                    
                                    <label for="yearstarted" class="form-label">Year Started</label>
                                  <!--  <input type="text" name="yearcompleted" id="yearcompleted" class="form-control" placeholder="" value=""> -->
                                   <select class="form-control" name="yearstarted" id="yearstarted" >
                                   <?php 
                                    @$yearcompleted =   (int)$rows['yearstarted']; 
                                    @$x = 0;
                                    @$yearcount = 1951; 
                                    @$datetoday = (int)date('Y'); 
                                    for($x=$yearcount; $x<=$datetoday; $x++)
                                    {

                                        if($x==$yearcompleted)
                                        {
                                          echo '<option  value="'. $x  .'" selected>'.$x .'</option>';
                                        }
                                        else
                                        {
                                          echo '<option  value="'. $x  .'">'.$x .'</option>';
                                 
                                        }
                                         
                                    }
                                   
                                   ?>
                           
                                  </select>
                           
                           
                           
                           
                           
                           
                        </div>
                  </div>
        </div>

        <div class="row">
                 <div class="col-md-8">
                            <div class="form-group"> 
                                    <label for="schoolattended" class="form-label">School Attended</label>
                                    <input type="text" name="schoolattended" id="schoolattended" class="form-control" placeholder="" value="<?php echo $rows['schoolattended']; ?>">
                            </div>
                  </div>
                  
                  <div class="col-md-2">
                            <div class="form-group"> 
                                    <label for="yearcompleted" class="form-label">Year Completed</label>
                                  <!--  <input type="text" name="yearcompleted" id="yearcompleted" class="form-control" placeholder="" value=""> -->
                                   <select class="form-control" name="yearcompleted" id="yearcompleted" >
                                   <?php 
                                    @$yearcompleted =   (int)$rows['yearcompleted']; 
                                    @$x = 0;
                                    @$yearcount = 1951; 
                                    @$datetoday = (int)date('Y'); 
                                    for($x=$yearcount; $x<=$datetoday; $x++)
                                    {

                                        if($x==$yearcompleted)
                                        {
                                          echo '<option  value="'. $x  .'" selected>'.$x .'</option>';
                                        }
                                        else
                                        {
                                          echo '<option  value="'. $x  .'">'.$x .'</option>';
                                 
                                        }
                                         
                                    }
                                   
                                   ?>
                           
                                  </select>
                           
                           
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