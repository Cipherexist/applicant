<!doctype html>
<?php include "dbconfig.php"; 

include "loadcmb.php"; 
include "loadtables.php";


?>
<html lang="en">
  <head>
  <?php include "title.php"; ?> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 	
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
        
    <link rel="stylesheet" href="css/style.css">

  <script>
        $(document).ready(function() 
          {
                 
            var table = $('.mydatatable').DataTable();

          
        });


        function addhiring()
        {
        
        //  alert("fes"); 
          var mytitle = $('#hiretitle').val(); 
          var myrank = $('#hireposition').val(); 
          var myvessel = $('#hirevessel').val(); 
          var mydocu = $('#hiredocument').val(); 
          var myquiz = $('#hirequiz').val();  


          if(mytitle!="")
          {
          //  if(myrank!=0 && mydocu!=0 && myquiz!=0)
           // {

              $.post("hiring_add.php",{
                thetitle: mytitle, 
                therank: myrank, 
                thevessel: myvessel, 
                thedocu: mydocu, 
                thequiz: myquiz
              },function(result)
              {
                $('#modelId').modal('hide');
                $('#reloadpage').empty();
                $('#reloadpage').append(result); 
              }); 

              
           // }
          }
          else 
          {
           alert("Please fill up the Hiring Title"); 
          }




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
          <?php include "usershow.php" ?> 
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
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

        <h2 class="mb-4">Manage Hiring</h2>

        <!-- Button trigger modal -->
        
        <button type="button" class="btn btn-primary btn" data-toggle="modal" data-target="#modelId" style="margin-bottom: 30px;">
          Add New Hiring 
      </button>
        
      
        
      

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Hiring</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                <div class="modal-body">
                  <div class="container-fluid">
                  <div class="form-group">
                          <label for="hiretitle" class="form-label">Title</label>
                          <input type="hiretitle" name="hiretitle" id="hiretitle" class="form-control" placeholder="Ex. Job Hiring for Master">
                  </div>
               
                  <div class="form-group" style="margin-top: 10px;">
                          <label for="hireposition" class="form-label">Position</label>
                          <select class="form-control" name="hireposition" id="hireposition" >
                        
                          <?php  ?> 
                          </select>
                  </div>

                  <div class="form-group" style="margin-top: 10px;">
                          <label for="hirevessel" class="form-label">Vessel</label>
                          <select class="form-control" name="hirevessel" id="hirevessel">
                    
                              <?php 
                             

                              ?>
                      
                          </select>
                  </div>

                  
                  <div class="form-group" style="margin-top: 10px;">
                          <label for="hiredocument" class="form-label">Requirements (Documents List) Format</label>
                          <select class="form-control" name="hiredocument" id="hiredocument">
                              <?php 
                                 
                              ?> 


                          </select>
                  </div>




                  <div class="form-group" style="margin-top: 10px;">
                          <label for="hirequiz" class="form-label">Quiz</label>
                          <select class="form-control" name="hirequiz" id="hirequiz" >
                              <?php 

                              ?> 
       
                          </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addhiring()">Save</button>
              </div>
            </div>
          </div>
        </div>

        <!--END OF MODAL -->



        
        
        <script>
          $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            
          });
        </script>

<div class="overflow-auto">
        <table class="table mydatatable">
          <thead> 
            <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Position</th>
            <th>Vessel</th>
            <th>No of Applied</th>
            <th>Quiz Selected</th>
            <th>Status</th>
            <th>Option</th>
          </tr>
          </thead>

          <tbody id="reloadpage">
           
          </tbody>


        </table>
  </div>
        <!-- INSERT YOUR CODE HERE-->
     
     
       </div>
		</div>

    <script src="js/main.js"></script>
  </body>
</html>