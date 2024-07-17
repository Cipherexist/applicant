<!doctype html>
<html lang="en">
  <head>

  <?php
  include "dbconfig.php";
  include "forcookie.php"; 
  include "title.php"; 
  include "modules.php";
  include "loadcmb.php"; 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 	
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>    



<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>





   <!--  <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/style.css">
  <script>
        $(document).ready(function() 
          {
            $("#loading").hide();
            $("#ajaxloadingforpic").hide();
            $("#ajaxloading2").hide();
            $("#ajaxsave").hide()
           // var table = $('.mydatatable').DataTable();


            $('#birthdate').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'DD/MM/YYYY' },
            });

            document.getElementById("age").disabled = true;

          
        });



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





        function savedetails()
        {
            document.getElementById("btn_submit").disabled = true 
            $("#ajaxsave").show()
             let philhealth = document.getElementById("philhealth")
             let sss = document.getElementById("sss")
             let tin = document.getElementById("tin")
             let pagibig = document.getElementById("pagibig")
             
             let nooferrors = 0

             //String(philhealth.value).length
         ///    console.log(philhealth)
           //  console.log(sss)
            // console.log(tin)
            // console.log(pagibig)


            
            if(String(pagibig.value).length < 14)
            {
               nooferrors +=1
               document.getElementById("error_pagibig").className = "text-danger"; 
               document.getElementById("error_pagibig").textContent = "* Fill up the following fields"
               document.getElementById("error_pagibig").focus()
            }
            else 
            {
               document.getElementById("error_pagibig").className = "text-dark"; 
               document.getElementById("error_pagibig").textContent = "Ex. Format: 1210-0000-0000'"
            }

            if(String(tin.value).length < 15)
            {
               nooferrors +=1
               document.getElementById("error_tin").className = "text-danger"; 
               document.getElementById("error_tin").textContent = "* Fill up the following fields"
               document.getElementById("error_tin").focus()
            }
            else 
            {
               document.getElementById("error_tin").className = "text-dark"; 
               document.getElementById("error_tin").textContent = "Ex. Format: 437-000-000-000'"
            }



            if(String(philhealth.value).length < 14)
            {
               nooferrors +=1
               document.getElementById("error_philhealth").className = "text-danger"; 
               document.getElementById("error_philhealth").textContent = "* Fill up the following fields"
               document.getElementById("error_philhealth").focus()
            }
            else 
            {
               document.getElementById("error_philhealth").className = "text-dark"; 
               document.getElementById("error_philhealth").textContent = "Ex. Format: 02-000000000-0'"
            }


            if(String(sss.value).length < 12)
            {
               nooferrors +=1
               document.getElementById("error_sss").className = "text-danger"; 
               document.getElementById("error_sss").textContent = "* Fill up the following fields"
               document.getElementById("error_sss").focus()
            }
            else 
            {
               document.getElementById("error_sss").className = "text-dark"; 
               document.getElementById("error_sss").textContent = "Ex. Format: 02-000000000-0'"
            }



            if(nooferrors==0)
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
                myaddress: $("#address").val(), 
                mycurrentaddress: $("#currentaddress").val(), 
                mypagibig: $("#pagibig").val(), 
                mymobilenumber: $("#mobilenumber").val(),  
                myrank: $("#rank").val(),  
                myrankapplied: $("#rank_applied").val(),  
                myemailadd: $("#emailadd").val(),
                myheight: $("#height").val(),
                myweight: $("#weight").val(), 
                myfacebookaccount: $("#facebookaccount").val(), 
                mydateavailability: $("#availability").val()
              },function(result)
              {
                document.getElementById("btn_submit").disabled = false 
                $("#ajaxsave").hide()
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
             

        }




  </script> 



<style> 


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
                  <a class="nav-link active" href="home.php">Personal</a>
                </li>
               
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="education.php">Education</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link " href="family.php">Family</a>
                </li>  

                            
                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='national'){echo 'active';}?>" href="my_documents.php?content=national">National</a>
                </li> 

                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='marina'){echo 'active';}?>" href="my_documents.php?content=marina">Marina</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='training'){echo 'active';}?>" href="my_documents.php?content=training">Training</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='medical'){echo 'active';}?>" href="my_documents.php?content=medical">Medical</a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='foreign'){echo 'active';}?>" href="my_documents.php?content=foreign">Foreign</a>
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
      
      <div class="row" style="margin-top:20px;  " >
               <div class="col-md-4" > 
                    <div class="form-group"> 
                            <label for="rank_applied" class="form-label">Applying for Rank</label>
                                  <select class="form-control" name="rank_applied" id="rank_applied" >
                            <?php 
                            
                            @$username = $_COOKIE['usname'];
                            @$myrank = loadtextreturn("applicantinfo","applyingrank","Where `username` Like '$username'"); 
                            if($myrank==null)
                            {
                              rankcmb();
                            } 
                            else 
                            {
                              rankcmbset($myrank);
                            }               
                            ?>  
                          </select>
                    </div>
                </div>
                <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="availability" class="form-label">Availability</label>
                                    <input type="text" name="availability" id="availability" class="form-control" placeholder="Ex. Anytime" value="<?php echo $rows['dateavailability']; ?>">
                            </div>
                </div>
      </div>

        <div class="row">
                <div class="col-md-2" > 
                    <div class="form-group"> 
                            <label for="rank" class="form-label">Rank</label>
                            <select class="form-control" name="rank" id="rank" >
                            <?php 
                            
                            @$username = $_COOKIE['usname'];
                            @$myrank = loadtextreturn("applicantinfo","currentrank","Where `username` Like '$username'"); 
                            if($myrank==null)
                            {
                              rankcmb();
                            } 
                            else 
                            {
                              rankcmbset($myrank);
                            }               
                            ?>  
                            </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="firstname" class="form-label">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="" value="<?php echo $rows['firstname']; ?>">
                            </div>
                  </div>
                  
                  <div class="col-md-3">
                            <div class="form-group"> 
                                    <label for="middlename" class="form-label">Middlename</label>
                                    <input type="text" name="middlename" id="middlename" class="form-control" placeholder="" value="<?php echo $rows['middlename']; ?>">
                            </div>
                  </div>

                  <div class="col-md-3">
                            <div class="form-group"> 
                                    <label for="lastname" class="form-label">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="" value="<?php echo $rows['lastname']; ?>">
                            </div>
                  </div>
        </div>

        <div class="row">
        <div class="col-md-4">
                          
                      <div class="form-group"> 
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="text" name="birthdate" id="birthdate" class="form-control" value="<?php echo $rows['birthdate']; ?>">
                            <small id="helpId" class="text-muted">please enter birthdate</small>
                     </div>
                  </div>
                  
                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="placeofbirth" class="form-label">Place of birth</label>
                                    <input type="text" name="placeofbirth" id="placeofbirth" class="form-control" placeholder="" value="<?php echo $rows['birthplace']; ?>">
                            </div>
                  </div>

                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" name="age" id="age" class="form-control" placeholder="" value="<?php 
 
                                    $birthDate = $rows['birthdate'];
                                    //explode the date to get month, day and year
                                    $birthDate = explode("/", $birthDate);
                                    //get age from date or birthdate
                                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                      ? ((date("Y") - $birthDate[2]) - 1)
                                      : (date("Y") - $birthDate[2]));
                                    echo $age;
                                    
                                    
                                    ?>">
                            </div>
                  </div>  
        </div>

        <div class="row">
             <div class="col-md-6">
                    <div class="form-group"> 
                              <label for="height" class="form-label">Height (CM)</label>
                              <input type="number" name="height" id="height" class="form-control" placeholder="" value="<?php echo $rows['height']; ?>">
                    </div>
              </div>
              <div class="col-md-6">
                        <div class="form-group"> 
                                        <label for="weight" class="form-label">Weight (KG)</label>
                                        <input type="number" name="weight" id="weight" class="form-control" placeholder="" value="<?php echo $rows['weight']; ?>">
                        </div>
              </div>

        </div>

        <div class="row">
             <div class="col-md-12">
                    <div class="form-group"> 
                              <label for="address" class="form-label">Permanent Address</label>
                              <input type="text" name="address" id="address" class="form-control" placeholder="" value="<?php echo $rows['address']; ?>">
                    </div>
              </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group"> 
                          <label for="currentaddress" class="form-label">Present Address</label>
                          <input type="text" name="currentaddress" id="currentaddress" class="form-control" placeholder="" value="<?php echo $rows['currentaddress']; ?>">
                </div>
            </div>
        </div>


        
        <div class="row">
              <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <input type="text" name="nationality" id="nationality" class="form-control" placeholder="" value="<?php echo $rows['nationality']; ?>">
                            </div>
                  </div>
                  
                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="citizenship" class="form-label">Citizenship</label>
                                    <input type="text" name="citizenship" id="citizenship" class="form-control" placeholder="" value="<?php echo $rows['citizenship']; ?>">
                            </div>
                  </div>

                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" name="religion" id="religion" class="form-control" placeholder="" value="<?php echo $rows['religion']; ?>">
                            </div>
                  </div>  
        
        </div>



        <div class="row">
              <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="gender" class="form-label">Gender</label>
                                   <select class="form-control" name="gender" id="gender" >
                                   <?php 
                                    @$currentgender =    $rows['gender']; 

                                    if($currentgender!=null)
                                    {
                                      @$gen1 = ""; 
                                      @$gen2 = ""; 
                                      if($currentgender=='Male'){  $gen1 = 'selected';}
                                      if($currentgender=='Female'){  $gen2 = 'selected';}
                                       echo '<option  value="Male"'. $gen1  .'>Male</option>';
                                      echo '<option  value="Female"' . $gen2. '>Female</option>';
                                    }
                                    else 
                                    {
                                      echo '<option selected value="0">--Select Gender--</option>';
                                      echo '<option value="Male">Male</option>';
                                      echo '<option value="Female">Female</option>';
                                    }

                                  
                                   
                                   ?>
                           
                                  </select>
                              </div>
                  </div>
                  
                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="haircolor" class="form-label">Hair Color</label>
                                    <input type="text" name="haircolor" id="haircolor" class="form-control" placeholder="" value="<?php echo $rows['haircolor']; ?>">
                            </div>
                  </div>

                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="eyecolor" class="form-label">Eye Color</label>
                                    <input type="text" name="eyecolor" id="eyecolor" class="form-control" placeholder="" value="<?php echo $rows['eyecolor']; ?>">
                            </div>
                  </div>  
        
        </div>


        <div class="row">
              <div class="col-md-2">
                            <div class="form-group"> 
                                    <label for="sss" class="form-label">SSS Number</label>
                                    <input type="text" name="sss" id="sss" class="form-control" placeholder="" value="<?php echo $rows['sss']; ?>">
                                    <small id="error_sss">Ex. Format: 34-0000000-0</small>
             
                            </div>
                  </div>
                  
                  <div class="col-md-2">
                            <div class="form-group"> 
                                    <label for="philhealth" class="form-label">PhilHealth No</label>
                                    <input type="text" name="philhealth" id="philhealth" class="form-control" placeholder="" value="<?php echo $rows['philhealth']; ?>">
                                    <small id="error_philhealth">Ex. Format: 02-000000000-0'</small>
                            </div>
                  </div>

                  <div class="col-md-2">
                            <div class="form-group"> 
                                    <label for="tin" class="form-label">TIN</label>
                                    <input type="text" name="tin" id="tin" class="form-control" placeholder="" value="<?php echo $rows['tin']; ?>">
                                    <small id="error_tin">Ex. Format: 437-000-000-000'</small>
                             </div>
                  </div>  

                  <div class="col-md-2">
                            <div class="form-group"> 
                                    <label for="pagibig" class="form-label">Pag-IBIG No</label>
                                    <input type="text" name="pagibig" id="pagibig" class="form-control" placeholder="" value="<?php echo $rows['pagibig']; ?>">
                                    <small id="error_pagibig">Ex. Format: 1210-0000-0000'</small>
                                  </div>
                  </div>  
        </div>

        
        <div class="row">
                  <div class="col-md-4">
                                <div class="form-group"> 
                                    <label for="mobilenumber" class="form-label">Contact Nos</label>
                                    <input type="number" name="mobilenumber" id="mobilenumber" class="form-control" placeholder="" value="<?php echo $rows['contactnumber']; ?>">
                            </div>
                  </div>
                  
                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="emailadd" class="form-label">Email Address</label>
                                    <input type="email" name="emailadd" id="emailadd" class="form-control" placeholder="" value="<?php echo $rows['email']; ?>">
                            </div>
                  </div>

                  <div class="col-md-4">
                            <div class="form-group"> 
                                    <label for="facebookaccount" class="form-label">Facebook Account/Link</label>
                                    <input type="text" name="facebookaccount" id="facebookaccount" class="form-control" placeholder="" value="<?php echo $rows['facebookaccount']; ?>">
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
              <button type="button" class="btn btn-success" id="btn_submit" onclick="savedetails()">Save</button> <img src='images/ajax-loader.gif' class='ml-2' id='ajaxsave'/>
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
        $(document).ready(function(){
          $('#sss').mask('00-0000000-0');
          $('#philhealth').mask('00-000000000-0');
          $('#tin').mask('000-000-000-000');
          $('#pagibig').mask('0000-0000-0000');
        });
    </script>
  

  </body>
</html>