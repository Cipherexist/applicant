<!doctype html>
<html lang="en">
  <head>

  <?php
  include "dbconfig.php";
  include "forcookie.php"; 
  include "title.php"; 
  include "modules.php";
  include "loadcmb.php"; 
  include "loadtables.php"; 

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



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


   <!--  <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/style.css">
  <script>
        $(document).ready(function() 
          {
            $("#loading").hide();
            $("#ajaxloadingforpic").hide();
            $("#ajaxloading2").hide();
           // var table = $('.mydatatable').DataTable();


    
        
          
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
                mypagibig: $("#pagibig").val(), 
                mymobilenumber: $("#mobilenumber").val(),  
                myrank: $("#rank").val(),  
                myrankapplied: $("#rank_applied").val(),  
                myemailadd: $("#emailadd").val()
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



<div class='modal fade' id='seaservicemodal' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
<div class='modal-dialog' role='document'>
  <div class='modal-content'>
    <div class='modal-header'>
      <h5 class='modal-title'><p>Add Sea Service</p></h5>
      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <div class='modal-body'>
     
         <div class='form-group'>
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
         
       
        <div class="form-group">
          <label for="vesselnname">Vessel Name</label>
          <input type="text" class="form-control" name="vesselnname" id="vesselnname" aria-describedby="helpId" placeholder="Input Vessel Name">
        </div>

        <div class="form-group">
          <label for="flagname">Flag</label>
          <input type="text" class="form-control" name="flagname" id="flagname" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
          <label for="agencyname">Agency</label>
          <input type="text" class="form-control" name="agencyname" id="agencyname" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
          <label for="vesseltype">Vessel Type</label>
          <input type="text" class="form-control" name="vesseltype" id="vesseltype" aria-describedby="helpId" placeholder="">
        </div>


        <div class="form-group">
          <label for="grosstonnage">Gross Tonnage</label>
          <input type="number" class="form-control" name="grosstonnage" id="grosstonnage" aria-describedby="helpId" placeholder="">
        </div>
        
        <div class="form-group">
          <label for="kwpower">Kw Power</label>
          <input type="text" class="form-control" name="kwpower" id="kwpower" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
          <label for="signin">Sign-In</label>
          <input type="text" class="form-control" name="signin" id="signin" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
          <label for="signout">Sign-Out</label>
          <input type="text" class="form-control" name="signout" id="signout" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
        <p id="monthdiff"></p>
        <input type="hidden" id="totalmonths">
        </div>
   
        <div class="form-group">
          <label for="reason">Reason</label>
          <textarea class="form-control" name="reason" id="reason" rows="3"></textarea>
        </div>

     


        <div class='form-group text-danger' id='adderror' >
    
      </div>

    </div>
    <div class='modal-footer'>
      <button id='add-buttonclose' type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
       <button id='add-button' class='btn btn-primary btn-large' onclick="seaservicesave()">Add</button> <img src='images/ajax-loader.gif' id='ajaxloadingforadd'/>
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
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='national'){echo 'active';}?>" href="my_documents.php?content=national">National Document</a>
                </li> 

                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='marina'){echo 'active';}?>" href="my_documents.php?content=marina">Marina Document</a>
                </li> 

                <li class="nav-item">
                  <a class="nav-link <?php if(isset($_GET['content'])&&$_GET['content']=='all'){echo 'active';}?>" href="my_documents.php?content=all">All Documents</a>
                </li> 

                <li class="nav-item">
                  <a class="nav-link active" href="seaservice.php">Sea Service</a>
                </li>  
            
          </ul>
</div>
<!-- START --> 

<div style="padding: 10px; height:70%;">

      
      <div class="row" style="margin-top:20px;" >
        <?php 
        @$username = $_COOKIE['usname']; 

        if (loadnumberofdataall("seaservice","Where `username` Like '$username'")==0)
        {
          echo "<div class='form-check'>";
          echo "<input class='form-check-input ' type='checkbox' id='cmbwithexp' checked>";
          echo "<label class='form-check-label' for='cmbwithexp'> Check if No Experience </label>";
          echo "<button type='button' class='btn btn-success btn-sm' id='btn-final'>Save</button>";
          echo "</div>";
       
        }
        else 
        {
          echo '<script>
          $("#btn-add").show(); 
          </script>';
        }
   
        ?>
            <button type="button" class="btn btn-primary btn-sm" id="btn-add">Add Sea Service</button>

      </div>

      <div id='seaservicelist' class="row"  style='margin-top: 10px; '>
          
      <?php loadseaservice() ?>

      </div>
</div>

<style>


.form-check-input
{
  margin-top: 15px !important;
  
}
.form-check-label
{
  padding: 10px !important; 
  
}

</style>



  


</div>
          


          


     <!-- INSERT YOUR CODE HERE-->
     
     







		</div>

    <script src="js/mainjava.js"></script> 

    <script>
      
     const withexpcmb = document.getElementById("cmbwithexp")
     const btnadd = document.getElementById("btn-add")
     const signin = document.getElementById("signin")
     const signout = document.getElementById("signout")

    //    console.log(signout)

    

     $('#signin').on('change', function() {
      let thediff = getdifferencemonths(signin.value,signout.value)
      if(thediff > 0) 
      {
        document.getElementById("monthdiff").textContent =  "Total Months: " + thediff
        document.getElementById("totalmonths").value = thediff
      }
      else 
      {
        document.getElementById("monthdiff").textContent =  ""
        document.getElementById("totalmonths").value = 0
      }
      
    });
  
     $('#signout').on('change', function() {
      let thediff = getdifferencemonths(signin.value,signout.value)
      if(thediff > 0) 
      {
        document.getElementById("monthdiff").textContent =  "Total Months: " + thediff
        document.getElementById("totalmonths").value = thediff
      }
      else 
      {
        document.getElementById("monthdiff").textContent =  ""
        document.getElementById("totalmonths").value = 0
      }
    });


     function getdifference(date1,date2)
     {
      try {
         var date1 = new Date(date1);
        var date2 = new Date(date2);
        var diffDays = parseInt((date2 - date1) / (1000 * 60 * 60 * 24), 10); 

        return diffDays
      } catch (error) {
          console.log("error",error)
      }
       
     }

     function getdifferencemonths(date1,date2)
     {
          var d1 = new Date(date1);
           var d2 = new Date(date2);
          var months;
          months = (d2.getFullYear() - d1.getFullYear()) * 12;
          months -= d1.getMonth();
          months += d2.getMonth();
          return months <= 0 ? 0 : months;
     }

      $("#ajaxloadingforadd").hide()
     //   $('#pictureuploadmodal').modal('hide');
   
     if(withexpcmb)
     {
      if(withexpcmb.checked)
      {
        console.log("Checked")
        $("#btn-final").show()
        $("#btn-add").hide()
        $("#seaservicelist").hide()
      }
      else 
      {
        console.log("Unchecked")
        $("#btn-final").hide()
        $("#btn-add").show()
        $("#seaservicelist").show()
      }

     }



      btnadd.addEventListener("click",function()
      {
      
      document.getElementById("rank").value = 0; 
      document.getElementById("vesselnname").value = ""; 
      document.getElementById("flagname").value = ""; 
      document.getElementById("agencyname").value = ""; 
      document.getElementById("vesseltype").value = ""; 
      document.getElementById("grosstonnage").value = ""; 
      document.getElementById("kwpower").value = ""; 
      document.getElementById("reason").value = ""; 
      document.getElementById("totalmonths").value = 0 
      $('#seaservicemodal').modal('show');
      })
      
    if(withexpcmb)
    {
      withexpcmb.addEventListener("click",function()
     {
        if(withexpcmb.checked)
      {
        console.log("Checked")
        $("#btn-final").show()
        $("#btn-add").hide()
        $("#seaservicelist").hide()
      }
      else 
      {
        console.log("Unchecked")
        $("#btn-final").hide()
        $("#btn-add").show()
        $("#seaservicelist").show()
      }

      })

    }

            $('#signin').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'MM/DD/YYYY' },
            });

            $('#signout').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: { format: 'MM/DD/YYYY' },
            });


    function seaservicesave()
    {
      document.getElementById("add-buttonclose").disabled = true; 
      document.getElementById("add-button").disabled = true; 
      $("#ajaxloadingforadd").show(); 

      let rank =        $("#rank").val()
      let vesselnname = $("#vesselnname").val()
      let flagname =    $("#flagname").val()
      let agencyname =  $("#agencyname").val()
      let vesseltype =  $("#vesseltype").val()
      let grosstonnage= $("#grosstonnage").val()
      let kwpower    =  $("#kwpower").val()
      let signin     =  $("#signin").val()
      let signout   =   $("#signout").val()
      let reason   =    $("#reason").val()
      let totalmonths = $("#totalmonths").val()

      if(rank!="" && vesselnname!="" && flagname!="" && agencyname!="")
      {
        $.post("seaservice_add.php",
      {
        myrank: rank,
        myvesselnname:  vesselnname,
        myflagname: flagname,
        myagencyname:  agencyname,
        myvesseltype: vesseltype,
        mygrosstonnage:  grosstonnage,
        mykwpower:  kwpower,
        mysignin:  signin,
        mysignout: signout,
        myreason:  reason,
        mytotalmonths:  totalmonths
      }
      ,function(result)
      {
         
        $("#seaservicelist").empty(); 
        $("#seaservicelist").append(result); 
              document.getElementById("add-buttonclose").disabled = false; 
          document.getElementById("add-button").disabled = false; 
          $("#ajaxloadingforadd").hide(); 
          $('#seaservicemodal').modal('hide');

      })
      }
      else
      {
        document.getElementById("add-buttonclose").disabled = false; 
        document.getElementById("add-button").disabled = false; 
        $("#ajaxloadingforadd").hide(); 
          document.getElementById("adderror").textContent = "Error, Kindly fill up the following"
      }




    }

    function deletelist(delid,delname)
        {
          var theid = delid;
          Swal.fire({
              title: 'Do you want to Delete this Sea Service?: ' + delname,
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
                $("#loading").show();
                $.post("seaservice_delete.php",{
                  id: theid
                },function(result){
                //  console.log(result)
               //  alert(result); 
               $("#loading").hide();
                 $('#seaservicelist').empty();
                 $('#seaservicelist').append(result); 
                });
                

              } 
              else if (result.isDenied) 
              {
                // Swal.fire('Changes are not saved', '', 'info')
              }
              }); 



        }





    </script>
  

  </body>
</html>