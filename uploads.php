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
      var mydoctit = $("#adddoc_cmb").val();  
     // alert(mydoctit); 
      document.getElementById('doctext').innerHTML = $('#adddoc_cmb option:selected').text();
      document.getElementById("docuid").value = mydoctit; 
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
          //  $("#showhiring").hide();
            $("#showaddcmb").hide();
            $("#showaddbtn").hide()
        });


        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })



        function saveupdate()
        {
          var idall = document.getElementById("editid").value 
          var contenttype = $("#contentupload").val()
          if(contenttype=='Training')
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
          else if(contenttype=='Foreign')
          {
            let expiryvalue = ""; 

            if( $("#unlimitedcmb").is(" :checked"))
            {
              expiryvalue = "Unlimited"
            }
            else 
            {
              expiryvalue =  $("#expirydate").val() 
            }


            $.post("my_documents_edit.php",
              {
                id: idall, 
                docnumber: $("#docunumber").val().trim(), 
                country: $("#country").val(), 
                issuedate: $("#issuedate").val(), 
                expirydate: expiryvalue
              },function(result)
              {
                if(result==1)
                {
                $("#modaledit").modal("hide");
                document.getElementById("docnumber_" + idall).textContent = $("#docunumber").val()
                document.getElementById("country_" + idall).textContent = $("#country").val()
                document.getElementById("issuedate_" + idall).textContent = $("#issuedate").val()
                document.getElementById("expirydate_" + idall).textContent =expiryvalue

                    var ifexpired = false; 

                   if(expiryvalue!="Unlimited")
                  {
                    ifexpired = getexpiration($("#expirydate").val())
                  }


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
                let expiryvalue = ""; 

                if( $("#unlimitedcmb").is(" :checked"))
                {
                  expiryvalue = "Unlimited"
                }
                else 
                {
                  expiryvalue =  $("#expirydate").val() 
                }

                $.post("my_documents_edit.php",
                {
                  id: idall, 
                  docnumber: $("#docunumber").val().trim(), 
                  issuedate: $("#issuedate").val(), 
                  expirydate: expiryvalue
                },function(result)
                {
                  if(result==1)
                  {
                  $("#modaledit").modal("hide");
                  document.getElementById("docnumber_" + idall).textContent = $("#docunumber").val()
                  document.getElementById("issuedate_" + idall).textContent = $("#issuedate").val()
                  document.getElementById("expirydate_" + idall).textContent = expiryvalue

                  var ifexpired = false; 

                    if(expiryvalue!="Unlimited")
                    {
                      ifexpired = getexpiration($("#expirydate").val())
                    }

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


              $("#loading").hide()
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
            var getid = id; 
            var getcontent = "all";
            $.post("upload_genre.php",{id: getid},function(result){
                  getcontent = result
                
                  $("#showissuedate").hide();
                  $("#showtrainingcert").hide(); 
                  $("#showforeign").hide();
                  var doc_content =  $("#contentupload").val();
                  var contenttype = getcontent.trim();
                  document.getElementById("contentupload").value = getcontent.trim()
                  console.log(contenttype)
                  if(contenttype == "Training")
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
                  else if(contenttype == "Foreign")
                  {
                    $("#showforeign").show()
                    $("#showissuedate").show()
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
                  
                
                
            
            
            })


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
                 form_data.append("content","all"); 
     
                 
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

                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="" id="unlimitedcmb" value="">
                        Set Expiration as Unlimited
                      </label>
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

@$upload_hiringid = 0; 
if(isset($_GET['content']))
{
  echo "<input type='hidden' id='contentupload' value='". $_GET['content'] ."'>";  
}
if(isset($_GET['hiringid']))
{
  $upload_hiringid =  $_GET['hiringid'];
  echo "<input type='hidden' id='hiringupload' value='". $_GET['hiringid'] ."'>";  
}
else 
 {
  echo "<input type='hidden' id='hiringupload' value='0'>";  
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
      
  



<!-- START --> 
    <div class="container-fluid">
    



    <h2 class="mb-4">My Documents</h2>
    <div class="row" style="margin-top: 10px;">
       

       <div class="form-group" style="margin-right: 10px;">
         <label for="viewtype">Browse Document</label>
         <select class="form-control" name="" id="viewtype">
           <option value="0">-- Select Document--</option>
           <option value="All">All</option>
           <option value="National">National Documents</option>
           <option value="Marina">Marina Documents</option>
           <option value="Training">Training Documents</option>
           <option value="Foreign">Foreign Documents</option>
           <option value="Medical">Medical Documents</option>
           <option value="Application">Application Documents</option>
         </select>
       </div>


       <div id="showhiring">
              <div class="form-group">
                    <label for="hiringcmb">Select Application</label>
                    <select class="form-control" id="hiringcmb">
                  
                    <?php 
                      require "loadcmb.php"; 
                      loadhiringcmb(); 
                    ?> 
                    </select>
                </div>
       </div>

      
       <div id="showaddcmb">
        <div class='form-group'>
            <label for='adddoc_cmb'>Select Document</label>
            <select class='form-control' id='adddoc_cmb'> 
            
                <span id="doccmbresult"></span>

        
            </select>
          </div>
       
       </div>
  </div>

  
  <div class="row" id="showaddbtn">
        <button type="button" class="btn btn-primary btn-sm" onclick="uploadshow()">Upload</button> 

</div>




      <div class="row" id="reloadpage" style="margin-top: 10px;">
            <?php 
              if(isset($_GET['content']))
              {
                  loaddocumentlist($_GET['content']);
              }
              if(isset($_GET['hiringid']))
              {
                if($upload_hiringid==0)
                {
                  loadmydocumentsbyhiring($_GET['hiringid']);
                }
           
              }
           
            ?> 
      </div>
        




    </div>






		</div>

  
    <script src="js/mainjava.js"></script> 

  
  </body>




  <script>

  const hiringupload =document.getElementById("hiringupload"); 

  const hiringcmb = document.getElementById("hiringcmb"); 
  const viewtypecmb = document.getElementById("viewtype"); 


  if(hiringupload.value!=0)
  {
    viewtypecmb.value = "Application"; 
    $("#showhiring").show()
   document.getElementById("hiringcmb").value = hiringupload.value
  }
  else 
  {
    $("#showhiring").hide()
  }
  
  viewtypecmb.addEventListener("change",function()
  {

    var myvalue = viewtypecmb.value

    if(myvalue=="Application")
    {
      $("#showhiring").show();
    }
    else 
    {
      $.post("uploads_cmb.php",
      {
        doctype: myvalue
      },function(result)
      { 
        $("#showaddcmb").show();
        $("#showaddbtn").show();
        document.getElementById("adddoc_cmb").innerHTML = result;
       // console.log(result)
      })
    }

  })


  hiringcmb.addEventListener("change",function()
  {
   
        let thehiringid = $("#hiringcmb").val(); 
        // $("#loading").show(); 
          $.post("upload_browse.php",
          {
            myhiringid: thehiringid
          },function(result)
          {
          // $("#loading").hide(); 
          $("#showaddcmb").show();
          document.getElementById("adddoc_cmb").innerHTML = result;
        }); 
    


  })

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

  
<script src="js/modules.js"></script> 


</html>