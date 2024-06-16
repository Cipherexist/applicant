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
  @$nav2 =  ""; 
  @$nav3 =  "active"; 
  @$nav4 =  ""; 
  ?> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

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

   <!--  <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/style.css">
  <script>



    function uploadshow()
    {

   //   alert("click");
      $('#modalinupload').modal('show');
    try {
   //   $('#uploadmodal').modal('show');
      var mydoctit = $("#doccmb").val();  
     // alert(mydoctit); 
      document.getElementById('doctext').innerHTML = $('#doccmb option:selected').text();
      document.getElementById("docid").value = mydoctit; 
      $("#ajaxloading2").hide(); 


    } catch (error) {
      alert(error);
    }  
    }

    function uploadshowupdate(myid,myname,hiringid)
    {

   //   alert("click");
      $('#modalinupload').modal('show');
    try {
   //   $('#uploadmodal').modal('show');
      var mydoctit = myid;  
      var mydocname = myname; 
     // alert(mydoctit); 
      document.getElementById('doctext').innerHTML = mydocname;
      document.getElementById("docid").value = mydoctit; 
      document.getElementById("dochiringid").value = hiringid; 
      $("#ajaxloading2").hide(); 


    } catch (error) {
      alert(error);
    }  
    }



        $(document).ready(function() 
          {
            $("#loading").hide();
            $("#ajaxloadingforpic").hide();
        });


        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })



        function popupwindow(thelink)
        { 
            var linkage = thelink; 

              window.open(linkage,"windowName", "width=4000,height=4000,scrollbars=yes");
        }

        function deletelist(delid,delname,hiringid)
        {
          $("#loading").show()

          var theid = $('#editid').val();
          Swal.fire({
              title: 'Do you want to Delete this List?: ' + delname,
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
                $.post("uploads_delete.php",{
                  id: delid, 
                  thehiring: hiringid
                },function(result){
                $("#loading").hide()
               //  alert(result); 
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




        function uploadfile() {
              $("#ajaxloadingforpic").show();
                document.getElementById("upload-buttonclose").disabled = true ;
                document.getElementById("upload-button").disabled = true;
               //  var filename = $('#classnumberupload').val(); 
                 var file_data = $('#filepic').prop('files')[0]; 
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


        function uploadsend() {
              $("#ajaxloading2").show();
                document.getElementById("upload-btnclose").disabled = true ;
                document.getElementById("upload-btn").disabled = true;
               //  var filename = $('#classnumberupload').val(); 
                 var file_data = $('#fileupload').prop('files')[0]; 
                 var form_data = new FormData(); 
                  var doc_id =  $("#docid").val();
                  var doc_hiring =  $("#dochiringid").val();
                 form_data.append("file",file_data); 
                 form_data.append("mydocid",doc_id);
                 form_data.append("myhiring",doc_hiring);
               //  form_data.append("filename",filename); 
     
                 $.ajax({
                   url: "upload_save.php",
                   type: "POST", 
                   dataType: 'script', 
                   cache: false, 
                   contentType: false,  
                   processData: false, 
                   data: form_data,
                   success:function(result)
                   {

                    /*
                     if(result==1)
                     {
                      $("#ajaxloading2").hide();
                        document.getElementById("upload-btnclose").disabled = false ;
                        document.getElementById("upload-btn").disabled = false;
                         alert("Upload Error"); 
                     }
                     else 
                     {
                      $('#reloadpage').empty();
                       $('#reloadpage').append(result);
                      
                      $("#ajaxloading2").hide();
                       document.getElementById("upload-btnclose").disabled = false ;
                       document.getElementById("upload-btn").disabled = false;
                        $('#modalinupload').modal('hide');
                        e.stopPropagation(); //This line would take care of it
                                        //   $('#modal').modal().hide();
                                         //  $('#pictureuploadmodal').modal('toggle')
                
                     } 
                     */

                     $('#reloadpage').empty();
                       $('#reloadpage').append(result);
                      
                      $("#ajaxloading2").hide();
                       document.getElementById("upload-btnclose").disabled = false ;
                       document.getElementById("upload-btn").disabled = false;
                        $('#modalinupload').modal('hide');
                        e.stopPropagation(); //This line would take care of it
                                        //   $('#modal').modal().hide();
                                         //  $('#pictureuploadmodal').modal('toggle')
                



                   }
     
     
     
                 }); 
                 
     
     
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

  <?php

@$username = $_COOKIE['usname']; 

if (!file_exists('uploads/' . $username)) {
  mkdir('uploads/' . $username, 0777, true);
}


?> 

		
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
              <label for='filepic'>Upload Picture</label>
              <input type='file' accept='.png, .jpg, .jpeg' class='form-control' id='filepic' />
             
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
      
  

        <!-- START OF MODAL -->
        <div class='modal fade' id='modalinupload'  tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title'><p>Document Upload</p></h5>
                  <input type='hidden' id='docid' name='docid'></input>
                  <input type='hidden' id='dochiringid' name='dochiringid'></input>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                
                    <div class='form-group'>
                          <label for='fileupload'>Document: <span id="doctext" name="doctext"></span></label>
                          <input type='file' accept='.png, .jpg, .jpeg' class='form-control' id='fileupload' />
                        
                    </div>


                    <div class='form-group' id='uploaderror' >
                    </div>

                </div>
                <div class='modal-footer'>
                  <button id='upload-btnclose' type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                  <!-- <button type='submit' class='btn btn-primary btn-large' value='submit' name='submit' id='myBtn' onclick='addingfunction()'>add</button> !-->
                  <button id='upload-btn' class='btn btn-primary btn-large' onclick='uploadsend()'  data-dismiss='modal'> Upload </button> <img src='images/ajax-loader.gif' id='ajaxloading2'/>
                </div>
              </div>
            </div>
      </div>
      <!-- END OF MODAL --> 





<!-- START --> 
    <div class="container-fluid">
    



    <h2 class="mb-4">My Documents</h2>
    <div class="row" style="margin-top: 10px;">
        <!-- <div class="col-md-6">
   
            <select name="doccmb" id="doccmb" class="form-control" style="margin-top: 10px;">
          
              <?php 
              //require "loadcmb.php"; 

             // documentscmball();
              ?>
        
            </select>

        </div> -->
        
        <!-- <div class="col-md-4" style="margin-top: 10px;"> 
       <button type="button" class="btn btn-primary btn" onclick="uploadshow()"> 
        <button type="button" class="btn btn-primary btn" onclick="uploadshow()">
          Upload
        </button>
        </div> -->





        <div class="form-group">
          <label for="hiringcmb">Active Applied Hirings</label>
          <select class="form-control" id="hiringcmb">
         
          <?php 
            require "loadcmb.php"; 
            loadhiringcmb(); 
          ?> 
          </select>
        </div>
  </div>


      <div class="row" style="margin-top: 50px;">
          <table class="table table">
            <thead>
              <tr>
                <th>Required</th>
                <th>Document Name</th>
                <th>Status</th>
                <th>Option</th>
              </tr>
            </thead>
            <tbody id="reloadpage">
              <?php 

             // loadmydocuments();

              ?>
          
            </tbody>
          </table>



      </div>
        




    </div>






		</div>

  
    <script src="js/mainjava.js"></script> 

  
  </body>




  <script>

  const hiringcmb = document.getElementById("hiringcmb"); 


  hiringcmb.addEventListener("change",function()
  {
   
    let thehiringid = $("#hiringcmb").val(); 
    $("#loading").show(); 
    $.post("upload_browse.php",
    {
      myhiringid: thehiringid
    },function(result)
    {
      $("#loading").hide(); 
      $("#reloadpage").empty(); 
      $("#reloadpage").append(result); 

    }); 


    console.log("enter");



  })


  </script>
</html>