<!doctype html>
<html lang="en">
  <head>

  <?php
  include "dbconfig.php";
  include "forcookie.php"; 
  include "title.php"; 
  include "modules.php";
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
        $(document).ready(function() 
          {
                 
            var table = $('.mydatatable').DataTable();



        });



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

    function uploadshowupdate(myid,myname,username)
    {

      //   alert("click");
          $('#modalinupload').modal('show');
        try {
      //   $('#uploadmodal').modal('show');
         var uploadid = myid;  

        // alert(mydoctit); 
        document.getElementById('docusername').value = username;
          document.getElementById('doctext').innerHTML = myname;
          document.getElementById("docuid").value = uploadid; 
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

        
        function saveupdate()
        {
          var idall = document.getElementById("editid").value 
          var contenttype = $("#contentupload").val()
          if(contenttype=='training')
          {
            $.post("my_documents_edit.php",
              {
                id: idall, 
                docnumber: $("#docunumber").val().trim(), 
                trainingcenter: $("#trainingcenter").val(), 
                datestart: $("#datestart").val(), 
                dateend: $("#dateend").val()
              },function(result)
              {
                if(result==1)
                {
                $("#modaledit").modal("hide");
                document.getElementById("docnumber_" + idall).textContent = $("#docunumber").val()
                document.getElementById("trainingcenter_" + idall).textContent = $("#trainingcenter").val()
                document.getElementById("datestart_" + idall).textContent = $("#datestart").val()
                document.getElementById("dateend_" + idall).textContent = $("#dateend").val() 

                var ifexpired = false; 

                  ifexpired = getexpiration($("#expirydate").val())

                  if(ifexpired)
                  {
                    document.getElementById("expirydate_" + idall).className  = "text-danger";  
                  }
                  else 
                  {
                    document.getElementById("expirydate_" + idall).className  = "text-dark";  
                  }
                }
                else 
                {
                  console.log(result)
                } 
            })
          }
          else if(contenttype=='foreign')
          {
            $.post("my_documents_edit.php",
              {
                id: idall, 
                docnumber: $("#docunumber").val().trim(), 
                country: $("#country").val(), 
                issuedate: $("#issuedate").val(), 
                expirydate: $("#expirydate").val()
              },function(result)
              {
                if(result==1)
                {
                $("#modaledit").modal("hide");
                document.getElementById("docnumber_" + idall).textContent = $("#docunumber").val()
                document.getElementById("country_" + idall).textContent = $("#country").val()
                document.getElementById("issuedate_" + idall).textContent = $("#issuedate").val()
                document.getElementById("expirydate_" + idall).textContent = $("#expirydate").val() 

                var ifexpired = false; 

                  ifexpired = getexpiration($("#expirydate").val())

                  if(ifexpired)
                  {
                    document.getElementById("expirydate_" + idall).className  = "text-danger";  
                  }
                  else 
                  {
                    document.getElementById("expirydate_" + idall).className  = "text-dark";  
                  }
                }
                else 
                {
                  console.log(result)
                }
            })
          }
          else 
          {
            $.post("my_documents_edit.php",
          {
            id: idall, 
            docnumber: $("#docunumber").val().trim(), 
            issuedate: $("#issuedate").val(), 
            expirydate: $("#expirydate").val()
          },function(result)
          {
            if(result==1)
            {
            $("#modaledit").modal("hide");
            document.getElementById("docnumber_" + idall).textContent = $("#docunumber").val()
            document.getElementById("issuedate_" + idall).textContent = $("#issuedate").val()
            document.getElementById("expirydate_" + idall).textContent = $("#expirydate").val() 

            var ifexpired = false; 

              ifexpired = getexpiration($("#expirydate").val())

              if(ifexpired)
              {
                document.getElementById("expirydate_" + idall).className  = "text-danger";  
              }
              else 
              {
                document.getElementById("expirydate_" + idall).className  = "text-dark";  
              }





            }
            else 
            {
              console.log(result)
            }
          })
          }
        }


        function popupwindow(thelink)
        { 
            var linkage = thelink; 

              window.open(linkage,"windowName", "width=4000,height=4000,scrollbars=yes");
        }

        function deletelist(delid,delname,hiringid)
        {
          $("#loading").show()

          var theid = $('#editid').val();
          var content = $('#contentupload').val();
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
                  thehiring: hiringid,
                  mycontent: content
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

        
        function editshow(id,idname)
        {
            $("#showissuedate").hide();
            $("#showtrainingcert").hide(); 
            $("#showforeign").hide();
            var doc_content =  $("#contentupload").val();
          var contenttype = $("#contentupload").val()
          if(contenttype == "training")
          {
            $("#showtrainingcert").show()
          var docnumber  = document.getElementById("docnumber_" + id).textContent.trim();
          var trainingcenter  = document.getElementById("trainingcenter_" + id).textContent.trim();
          var issuedate = document.getElementById("datestart_" + id).textContent.trim(); 
          var expirtydate = document.getElementById("dateend_" + id).textContent.trim(); 

         // console.log("training cert");
          document.getElementById("editid").value = id; 
          document.getElementById("modal-title").textContent = "Edit: " + idname;
          document.getElementById("docunumber").value = docnumber
          document.getElementById("trainingcenter").value = trainingcenter
          document.getElementById("datestart").value = issuedate
          document.getElementById("dateend").value = expirtydate
          }
          else if(contenttype == "foreign")
          {
            $("#showforeign").show()
          console.log("foreign");
          var docnumber  = document.getElementById("docnumber_" + id).textContent.trim();
          var country  = document.getElementById("country_" + id).textContent.trim();
          var issuedate = document.getElementById("issuedate_" + id).textContent.trim(); 
          var expirtydate = document.getElementById("expirydate_" + id).textContent.trim(); 

       
          document.getElementById("editid").value = id; 
          document.getElementById("modal-title").textContent = "Edit: " + idname;
          document.getElementById("docunumber").value = docnumber
          document.getElementById("country").value = country
          document.getElementById("issuedate").value = issuedate
          document.getElementById("expirydate").value = expirtydate
          }
          else 
          {
            $("#showissuedate").show();
            var docnumber  = document.getElementById("docnumber_" + id).textContent.trim();
          var issuedate = document.getElementById("issuedate_" + id).textContent.trim(); 
          var expirtydate = document.getElementById("expirydate_" + id).textContent.trim(); 

          document.getElementById("editid").value = id; 
          document.getElementById("modal-title").textContent = "Edit: " + idname;
          document.getElementById("docunumber").value = docnumber
          document.getElementById("issuedate").value = issuedate
          document.getElementById("expirydate").value = expirtydate
          }
    
           $("#modaledit").modal("show");
        }

            function uploadsend() {
                  $("#ajaxloading2").show();
                document.getElementById("upload-btnclose").disabled = true ;
                document.getElementById("upload-btn").disabled = true;
               //  var filename = $('#classnumberupload').val(); 
                 var file_data = $('#fileupload').prop('files')[0]; 
                 var form_data = new FormData(); 
                  var doc_id =  $("#docuid").val();
                  var doc_username =  $("#docusername").val();
                  var doc_content =  $("#contentupload").val();
                 form_data.append("file",file_data); 
                 form_data.append("mydocid",doc_id);
                 form_data.append("theuser",doc_username); 
                 form_data.append("content",doc_content); 
     
                 
                 $.ajax({
                   url: "my_documents_uploads_save.php",
                   type: "POST", 
                   dataType: 'script', 
                   cache: false, 
                   contentType: false,  
                   processData: false, 
                   data: form_data,
                   success:function(result)
                   {
                    console.log(result)
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

  </head>
  <body> 

          <!-- Modal -->
          <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-title">Edit Information</h5>
                        <input type="hidden" id="editid">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="modal-body">
                      
                    <div class="form-group">
                <label for="docunumber">Certificate / Document No</label>
                <input type="text"
                  class="form-control"  id="docunumber" aria-describedby="helpId" placeholder="">
              </div>

              <div id="showissuedate">
                    <div class="form-group">
                      <label for="issuedate">Issue Date (DD/MM/YYYY)</label>
                      <input type="text"
                        class="form-control" id="issuedate" aria-describedby="helpId" placeholder="">
                    </div>
                    
                    <div class="form-group">
                      <label for="expirydate">Expiry Date   (DD/MM/YYYY)</label>
                      <input type="text"
                        class="form-control" id="expirydate" aria-describedby="helpId" placeholder="">
                    </div>
              </div>

              <div id="showtrainingcert">
                    <div class="form-group">
                      <label for="trainingcenter">Training Center</label>
                      <input type="text"
                        class="form-control" id="trainingcenter" aria-describedby="helpId" placeholder="">
                    </div>
                    
                    <div class="form-group">
                      <label for="datestart">Date Start (DD/MM/YYYY)</label>
                      <input type="text"
                        class="form-control" id="datestart" aria-describedby="helpId" placeholder="">
                    </div>
                    
                    <div class="form-group">
                      <label for="dateend">Date End (DD/MM/YYYY)</label>
                      <input type="text"
                        class="form-control" id="dateend" aria-describedby="helpId" placeholder="">
                    </div>
              </div>

              <div id="showforeign">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <input type="text"
                        class="form-control" id="country" aria-describedby="helpId" placeholder="">
                    </div>
                    
                    <div class="form-group">
                      <label for="issuedate">Issue Date (DD/MM/YYYY)</label>
                      <input type="text"
                        class="form-control" id="issuedate" aria-describedby="helpId" placeholder="">
                    </div>
                    
                    <div class="form-group">
                      <label for="expirydate">Expiry Date   (DD/MM/YYYY)</label>
                      <input type="text"
                        class="form-control" id="expirydate" aria-describedby="helpId" placeholder="">
                    </div>
              </div>

          

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" onclick="saveupdate()">Update</button>
                    </div>
                  </div>
                </div>
        </div>


        <!-- START OF MODAL -->
        <div class='modal fade' id='modalinupload'  tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title'>Document: <span id="doctext" name="doctext"></span></h5>
                      <input type='hidden' id='docuid' name='docid'></input>
                      <input type='hidden' id='docusername' name='docusername'></input>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
                    <div class='modal-body'>
                    
                        <div class='form-group'>
                              <label for='fileupload'>Select File</label>
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



  <?php

  @$username = $_COOKIE['usname']; 

  if (!file_exists('../userdocuments/uploads/' . $username)) {
    mkdir('../userdocuments/uploads/' . $username, 0777, true);
  }

  echo "<input type='hidden' id='contentupload' value='". $_GET['content'] ."'>";  
      
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

          </div>
        </nav>

     




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
                  <a class="nav-link" href="home.php">Personal</a>
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
<style>
h6 
{
  color:black;
}

</style>


<div style="padding: 10px; height:70%;">


    <div class="row" id="reloadpage">
      <?php 
        if(isset($_GET['content']))
        {
            if($_GET['content']=='training')
            {
              loaddocumentlistfortraining($_GET['content']);
            }
            else if($_GET['content']=='foreign')
            {
              loaddocumentlistforforeign($_GET['content']); 
            }
            else
            {
              loaddocumentlist($_GET['content']);
            }
        }
      ?> 

      
    </div>



</div>



  


</div>
          


          


     <!-- INSERT YOUR CODE HERE-->
     
     







		</div>

    <script src="js/mainjava.js"></script> 

  
    <script>
        
          
      

            $('#issuedate').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-2000',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            document.getElementById("issuedate").value = "01-01-2000";

            $('#expirydate').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-2000',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            document.getElementById("expirydate").value = "01-01-2000";

            $('#datestart').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-2000',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            document.getElementById("datestart").value = "01-01-2000";

            $('#dateend').daterangepicker({
                "singleDatePicker": true,
                 "showDropdowns": true,
                "startDate": '01-01-2000',
                locale: { 
                  format: 'DD/MM/YYYY'
                 },
            });

            document.getElementById("dateend").value = "01-01-2000";
          
     

  </script>

  </body>

  
  <script src="js/modules.js"></script> 


</html>