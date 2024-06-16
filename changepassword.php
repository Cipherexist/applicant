<!doctype html>
<html lang="en">
  <head>
  <?php
  
  include "dbconfig.php";
  include "forcookie.php"; 
  include "title.php"; 
  include "modules.php";
  include "loadcmb.php"; 
  @$nav1 =  ""; 
  @$nav2 =  ""; 
  @$nav3 =  ""; 
  @$nav4 =  "active"; 
  
  
  
  ?> 
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
        



<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>






<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/style.css">



  <script>
        $(document).ready(function() 
          {
                 
            var table = $('.mydatatable').DataTable();
            $("#optquiz").change(function()
            {
              loadquizlist();
            });

            $("#ajaxloading").hide(); 


            //show password 




            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });


            
        });

        function showpassword() {
            var x = document.getElementById("newpassword");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }


          function updatepassword()
          {
            
            $("#ajaxloading").show(); 
            document.getElementById('btnsave').disabled = true ; 
      
    
            $.post("changepassword_save.php",
            {
              oldpass: $("#oldpassword").val(), 
              newpass: $("#newpassword").val(), 
              newpass2: $("#newpasswordconfirm").val()
            },function(result)
            {
              $("#ajaxloading").hide(); 
              document.getElementById('btnsave').disabled = false ; 
              if(result==1)
              {
                document.getElementById('reloadpage').innerHTML = "<p class='text-danger'>Please fill up the fields</p>" ;
              }
              else if(result==2)
              {
                document.getElementById('reloadpage').innerHTML = "<p class='text-danger'>Incorrect Password</p>" ;
              
              }
              else if(result==3)
              {
                document.getElementById('reloadpage').innerHTML = "<p class='text-danger'>Password Does not match</p>" ;
              }
              else 
              {
                document.getElementById('oldpassword').value = ""; 
                document.getElementById('newpassword').value = ""; 
                document.getElementById('newpasswordconfirm').value = ""; 
                document.getElementById('reloadpage').innerHTML = "<p class='text-success'>Password Successfully Change</p>" ;

              }
                
            });

          }

          function deleteuser(delid,delname)
        {
          Swal.fire({
              title: 'Do you want to Delete this User:' + delname,
              showDenyButton: true,
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              denyButtonText: `Don't Delete`,
              confirmButtonText: `Delete`,
              }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed)
              {
                $.post("users_delete.php",{
                  id: delid
                },function(result){

                  $('#reloadpage').empty();
               $('#reloadpage').append(result); 
                });
                


              } 
              else if (result.isDenied) 
              {
                // Swal.fire('Changes are not saved', '', 'info')
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


      

    <div class="container-fluid">




        


    <h2 class="mb-4">Change Password</h2>
<!-- Button trigger modal -->
     
    
                    <div class="form-group">
                            <label class="form-label" for="oldpassword">Old Password</label>
                            <input type="password" name="oldpassword" id="oldpassword" class="form-control">
                    </div>

                    <div class="form-group">
                            <label class="form-label" for="newpassword">Password</label>
                            <input type="password" name="newpassword" id="newpassword" class="form-control">
                          
                    </div>
  
                    <!-- 
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"  onclick="showpassword()">
                            <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                            </label>
                    </div>
                      -->
               
                    <div class="form-group">
                            <label class="form-label" for="newpasswordconfirm">Confirm Password</label>
                            <input type="password" name="newpasswordconfirm" id="newpasswordconfirm" class="form-control">
                          
                    </div>

                      
                  
                    <div class="form-group">
                    <button type="button" id="btnsave" class="btn btn-success btn" onclick="updatepassword()">
                     Change Password
                     
                    </button>
                 
                      </div>
                      <div class="form-group">
                      <p id="ajaxloading">Please wait <img src="images/ajax-loader.gif"/></p>
                      </div>

                      <div class="form-group">
                    <p id='reloadpage' class="text-danger"></p>  
                    </div>

    <script src="js/main.js"></script>
  </body>
</html>