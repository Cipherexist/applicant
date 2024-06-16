<!doctype html>
<html lang="en">
  <head>

  <?php
  include "dbconfig.php";
  include "forcookie.php"; 
  include "title.php"; 
  include "modules.php";
  include "loadtables.php";

  @$nav1 =  ""; 
  @$nav2 =  "active"; 
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





   <!--  <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/style.css">
  <script>
        $(document).ready(function() 
          {
            $("#ajaxloadingforpic").hide(); 
             
            $("#ajaxapply").hide();
           // var table = $('.mydatatable').DataTable();
           $("#loading").hide();

            $('#birthdate').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });

         
            $("#ajaxloading2").hide();
        });

        
        function newshow(myid,mytitle,myposition,mycaption,mydescription,myexam)
        {
          try {
                $("#loading").show();
        
                document.getElementById('applyjobtitle').innerHTML = mytitle; 
                document.getElementById('applycaption').innerHTML = mycaption; 
              // document.getElementById('applyexam').innerHTML = myexam; 
                document.getElementById('applydescription').innerHTML = mydescription; 
                document.getElementById('applyjobtitleid').value = myid; 
                let mynumber = myexam; 
               
                if(mynumber==0)
                {
                  document.getElementById('applyreload').innerHTML = "<p class='text-danger'>Sorry, Application is not available</p>"; 
                  document.getElementById("btnapply_save").disabled = true;
                }
                else 
                {
                  document.getElementById('applyreload').innerHTML = ""; 
                document.getElementById("btnapply_save").disabled = false;
                }

                  $("#loading").hide();
                  $('#modalapply').modal('show');
          } catch (error) {
          alert(error); 
          }
        
        }




        function applicationproceed()
        {
          $("#ajaxapply").show();
          document.getElementById("btnapply_close").disabled = true ;
          document.getElementById("btnapply_save").disabled = true;

          var theid = $("#applyjobtitleid").val(); 

          $.post("application_new.php",
          {
            idme: theid
          },function(result)
          {
            $("#loading").hide();
            if(result=1)
            {
              document.getElementById("btnapply_close").disabled = false ;
              document.getElementById("btnapply_save").disabled = false;
         
              $("#ajaxapply").hide();
              document.getElementById('applyreload').innerHTML = "<p class='text-success'>Successfully Added</p>"; 
              location.replace("application_status.php"); 
            }
            else 
            {
              document.getElementById("btnapply_close").disabled = false ;
              document.getElementById("btnapply_save").disabled = false;
         
              $("#ajaxapply").hide();
             // $('#modalapply').modal('hide');
              //    $("#applyerror").empty();
                // $("#applicationstatus").append(result); 
                 document.getElementById('applyreload').innerHTML = "<p class='text-danger'>"+ result +" </p>"; 
            }

          }); 



        }

        function popupwindow(thefunction,thehiringid,theuser)
        {
          var myfunction = thefunction; 
          var myhiringid = thehiringid; 
          var myuser = theuser; 

          $.post("application_activate.php",
          {
            functionset: myfunction, 
            hiringidset: myhiringid, 
            username: myuser
          },function(result)
          {

            if(result==1)
            {
              window.open("quizmode.php","windowName", "width=4000,height=4000,scrollbars=yes");
            }
            else 
            {
            alert(result); 
            }
          


          }); 


          
        }


        function savedetails()
        {

          $.post("home_savedetails.php",
          {
            myfirstname: $("#firstname").val(), 
            mymiddlename: $("#middlename").val(), 
            mylastname: $("#lastname").val(), 
            mybirthdate: $("#birthdate").val(), 
            myplaceofbirth: $("#placeofbirth").val(), 
            myage: $("#age").val(), 
            mynationality: $("#nationality").val(), 
            mycitizenship: $("#citizenship").val(), 
            myreligion: $("#religion").val(), 
            mygender: $("#gender").val(), 
            myhaircolor: $("#haircolor").val(), 
            myeyecolor: $("#eyecolor").val(), 
            mysss: $("#sss").val(), 
            myphilhealth: $("#philhealth").val(), 
            mytin: $("#tin").val(), 
            mypagibig: $("#pagibig").val(), 
            mymobilenumber: $("#mobilenumber").val(),  
            myemailadd: $("#emailadd").val()
          },function(result)
          {
            $("#reloadpage").empty();
            $("#reloadpage").append(result); 
          }); 




        }

        function uploadfile() {
              $("#ajaxloadingforpic").show();
                document.getElementById("upload-buttonclose").disabled = true ;
                document.getElementById("upload-button").disabled = true;
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
                      $("#ajaxloadingforpic").hide();
                        document.getElementById("upload-buttonclose").disabled = false ;
                        document.getElementById("upload-button").disabled = false;
                         alert("Upload Error"); 
                     }
                     else 
                     {
                      $('#reloadpic').empty();
                       $('#reloadpic').append(result);
                      
                      $("#ajaxloadingforpic").hide();
                       document.getElementById("upload-buttonclose").disabled = false ;
                       document.getElementById("upload-button").disabled = false;
                                          $('#pictureuploadmodal').modal('hide');
                                        //   $('#modal').modal().hide();
                                         //  $('#pictureuploadmodal').modal('toggle')
                
                     } 
                   }
     
     
     
                 }); 
                 
     
     
               }








  </script> 

<style> 
.btnupload 
{
      top: 10px;
      right: 10px;
      width: 30px;
      height: 30px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 50%;
      cursor: pointer;
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
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
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
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
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


  <div class="loading" id="loading" name="loading">Loading&#8230;</div>

  
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		
              <?php include "navigation.php"; ?>

	        <div class="footer">
         <!-- <a href='#' class='img logo rounded-circle mb-5' style='background-image: url(images/logo.png);'></a> -->
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

      

<div class='modal fade' id='pictureuploadmodal' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
<div class='modal-dialog' role='document'>
  <div class='modal-content'>
    <div class='modal-header'>
      <h5 class='modal-title'><p>Picture Upload</p></h5>
      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <div class='modal-body'>
     
         <div class='form-group'>
              <label for='fileupload'>Upload Picture</label>
              <input type='file' accept='.png, .jpg, .jpeg' class='form-control' id='fileupload' />
             
        </div>


        <div class='form-group' id='uploaderror' >
        </div>

    </div>
    <div class='modal-footer'>
      <button id='upload-buttonclose' type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
       <!-- <button type='submit' class='btn btn-primary btn-large' value='submit' name='submit' id='myBtn' onclick='addingfunction()'>add</button> !-->
       <button id='upload-button' class='btn btn-primary btn-large' onclick='uploadfile()'> Upload </button> <img src='images/ajax-loader.gif' id='ajaxloadingforpic'/>
    </div>
  </div>
</div>
</div>




        <!-- Modal -->
        <div class="modal fade" id="modalapps" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobtitle">JOB HIRING FOR ENGINE OFFICERS</h5>
                    <input type="hidden" id="jobtitleid" name="jobtitleid">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <div class="modal-body">
                <div class="container" id="applicationstatus">

                  


               </div>
        
          
                </div>
              
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save</button>
                </div>
              </div>
            </div>
          </div>

                  <!-- Modal -->
        <div class="modal fade" id="modalapply" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">APPLY FOR <span id="applyjobtitle">ENGINE OFFICER</span></h5>
                    <input type="hidden" id="applyjobtitleid" name="applyjobtitleid">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <div class="modal-body">
                <div class="container" id="applicationstatus">
                
                  <div class="row">
                    <h5>Caption</h5>
                  </div>
                  <div class="row">
                  <p id="applycaption">Hiring for Deck Officer Urgent</p>
                  </div>

                  <div class="row">
                    <h5>Description</h5>
                  </div>
                  <div class="row">
                  <p id="applydescription">Hiring for Deck Officer Urgent</p>
                  </div>

                  <input type="hidden" id="applyexam" name="applyexam">

                  <div class="row">
                    <p id="applyreload"></p>
                  </div>
                 
                
 

               </div>
        
          
                </div>
              
                <div class="modal-footer">
                  <button type="button" id="btnapply_close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" id="btnapply_save"class="btn btn-success" onclick="applicationproceed()">Apply Now</button> <img src='images/ajax-loader.gif' id='ajaxapply'/>
             
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





<!-- START --> 
<div class="row">
          <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="application.php" aria-current="page">Find New Job</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="application_status.php">Application Status</a>
                </li>
                
               
          </ul>
</div>

<div class="container" style="padding: 10px; height:70%;">
<input type="hidden" id="mycurrentrank" value="<?php echo loadmyposition(); ?>">
<div class="row">
          <h4>Hiring for: <?php @$myusername = $_COOKIE['usname'];
               @$getrank = loadtextreturn("applicantinfo","applyingrank","Where `username` Like '$myusername'"); 
              echo loadcompleterank($getrank);
             ?></h4>

</div>
  
<?php  loadhirings(); ?>







<!--
      <div class="col-md-6" style="margin-top: 10px;"> 
          <div class="card">
            <div class="card-header">
              JOB HIRING FOR ENGINE OFFICERS
            </div>
            
            <div class="card-body">
              <h5 class="card-title">URGENT!! MASTER - 01/12/2023</h5>
              <p class="card-text">REQ: Must be master mariner in order to apply</p>
            <button type="button" class="btn btn-sm btn-success" data-toggle='modal' data-target='#modelId'>Apply</button>
            <button type="button" class="btn btn-sm btn-danger">hide</button>
            </div>
          </div>
      </div>
-->
<!--       
      <div class="col-md-6" style="margin-top: 10px;">
          <div class="card">
            <div class="card-header">
              JOB HIRING FOR C/M
            </div>
            
            <div class="card-body">
              <h5 class="card-title">URGENT!! CHIEFMATE BULK  - 01/12/2023</h5>
              <p class="card-text">Required to passed the examination</p>
            <button type="button" class="btn btn-sm btn-success">Apply</button>
            <button type="button" class="btn btn-sm btn-danger">hide</button>
            </div>

          </div>
      </div>     
      
        -->
     <!-- INSERT YOUR CODE HERE-->




		</div>

    <script src="js/mainjava.js"></script> 

  

  </body>
</html>