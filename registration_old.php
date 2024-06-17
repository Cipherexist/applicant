<!doctype html>
<html lang="en">
  <head>
  <?php include "title.php"; include "loadcmb.php"; ?> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 	
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>	


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<!--DATA PICKER --> 

   <!--  <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/style.css">
  <script>

        $(document).ready(function() 
          {

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


            $("#loading").hide();
            $("#error_myusername").hide();
            $("#error_mypassword").hide();
            $("#error_firstname").hide();
            $("#error_middlename").hide();
            $("#error_lastname").hide();
            $("#error_gender").hide();
            $("#error_rank").hide();
            $("#error_rank_applied").hide();
            $("#error_address").hide();
            $("#error_birthdate").hide();
            $("#error_contact").hide();
            $('#birthdate').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "startDate": '01-01-1970',
                locale: { format: 'DD/MM/YYYY' },
            });

           // $("#birthdate").datepicker( "setDate" , "7/11/2011" );

         //   document.getElementById("birthdate").value = "01/01/1990";

              $("#ajaxconsent").hide();
            var table = $('.mydatatable').DataTable();

        //    $("#datepick1").datepicker("option", "monthNames", ["Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December"]);

          /*  $( "#datepick1" ).datepicker({
                shortYearCuroff: 150,
                changeMonth: true,
                changeYear: true, 
                defaultDate: '01/01/1980'
                });
                */

          //  $("#datepick1").datepicker().datepicker("setDate", new Date());
        });

        function returnmain()
        {
            location.replace("index.html"); 
        }

        function savedetails()
        {   

          try 
          {
          
            document.getElementById("btnregister").disabled = true;
            document.getElementById("btncancel").disabled = true;
                            var theusername = $("#myusername").val(); 
            var thepassword = $("#mypassword").val(); 
            var thefirstname = $("#firstname").val(); 
            var themiddlename = $("#middlename").val(); 
            var thelastname = $("#lastname").val(); 
            var thegender = $("#gender").val(); 
            var therank = $("#rank").val(); 
            var theappliedrank = $("#rank_applied").val(); 
            var theaddress = $("#address").val(); 
            var thebirthdate = $("#birthdate").val();
            var thecontactnumber = $("#contactnumber").val(); 
            var split = $("#birthdate").val().split('/');
            let birthyear = split[2]; 
            const d = new Date();
            let yearnow = d.getFullYear();
            let myage = yearnow - birthyear;  
            let x = 0; 
            

            if(thecontactnumber=="")
            {
                    x +=1;
                    $("#error_contact").show(); 
                    document.getElementById("contactnumber").focus();
            }
            else 
            {
                $("#error_contact").hide(); 
            }


            if(myage<18)
            {
                    x +=1;
                    document.getElementById('error_birthdate').innerHTML = "<p class='text-danger'>Age Error!, Kindly put your actual birthdate</p>"; 
                    $("#error_birthdate").show(); 
                    document.getElementById("birthdate").focus();
            }
            else 
            {
                $("#error_birthdate").hide(); 
            }

            if(theaddress=="")
            {
                    x +=1;
                    $("#error_address").show(); 
                    document.getElementById("address").focus();
            }
            else 
            {
                $("#error_address").hide(); 
            }

            if(therank==0)
            {
                    x +=1;
                    $("#error_rank").show(); 
                    document.getElementById("rank").focus();
            }
            else 
            {
                $("#error_rank").hide(); 
            }

            if(theappliedrank==0)
            {
                    x +=1;
                    $("#error_rank_applied").show(); 
                    document.getElementById("rank_applied").focus();
            }
            else 
            {
                $("#error_rank_applied").hide(); 
            }





            if(thelastname=="")
            {
                    x +=1;
                    $("#error_lastname").show(); 
                    document.getElementById("lastname").focus();
            }
            else 
            {
                $("#error_lastname").hide(); 
            }

            if(themiddlename=="")
            {
                    x +=1;
                    $("#error_middlename").show(); 
                    document.getElementById("middlename").focus();
            }
            else 
            {
                $("#error_middlename").hide(); 
            }

            if(thefirstname=="")
            {
                    x +=1;
                    $("#error_firstname").show(); 
                    document.getElementById("firstname").focus();
            }
            else 
            {
                $("#error_firstname").hide(); 
            }
            

            
            if(thepassword=="")
            {
                    x +=1;
                    $("#error_mypassword").show(); 
                    document.getElementById("mypassword").focus();
            }
            else 
            {
                $("#error_mypassword").hide(); 
            }
            
            

            if(theusername=="")
            {
                    x +=1;
                    $("#error_myusername").show(); 
                    document.getElementById("myusername").focus();
            }
            else 
            {
                $("#error_myusername").hide(); 
            }

            


            if(x==0)
            {
            //  finalsave(); 
            document.getElementById("btnregister").disabled = false ;
            document.getElementById("btncancel").disabled = false;
            $('#modalconsent').modal('show');
            }
            else 
            {
            document.getElementById("btnregister").disabled = false ;
            document.getElementById("btncancel").disabled = false;
            }


          } catch (error) {
            alert(error); 
          }
          

        }


        function finalsave()
        {

          try 
          {
         
            document.getElementById("btnregister").disabled = true ;
            document.getElementById("btncancel").disabled = true;
            document.getElementById('reloadconsent').innerHTML = "";

            var agreedcheck=$("#consentcheck").is(":checked");

            document.getElementById("btnconsent_close").disabled = true;
            document.getElementById("btnconsent_save").disabled = true;
            $("#ajaxconsent").show(); 
            var theusername = $("#myusername").val(); 
            var thepassword = $("#mypassword").val(); 
            var thefirstname = $("#firstname").val(); 
            var themiddlename = $("#middlename").val(); 
            var thelastname = $("#lastname").val(); 
            var thegender = $("#gender").val(); 
            var therank = $("#rank").val(); 
            var theaddress = $("#address").val(); 
            var thebirthdate = $("#birthdate").val();
            var thecontactnumber = $("#contactnumber").val(); 
            var theappliedrank = $("#rank_applied").val(); 

         if(agreedcheck)
         {       
                $.post("registration_save.php",
                {
                    myusername: theusername, 
                    mypassword: thepassword, 
                    myfirstname: thefirstname, 
                    mymiddlename: themiddlename, 
                    mylastname: thelastname, 
                    myaddress: theaddress, 
                    mybirthdate: thebirthdate, 
                    myrank: therank, 
                    myrankapplied: theappliedrank, 
                    mygender: thegender, 
                    mycontactnumber: thecontactnumber
                },function(result)
                {
                    if(result==1)
                    {
                      $('#modalconsent').modal('hide');
                      document.getElementById("btnconsent_close").disabled = false;
                      document.getElementById("btnconsent_save").disabled = false;
                      $("#ajaxconsent").hide(); 
                        document.getElementById('textresult').innerHTML = "<p class='text-success'>Successfully Registered!, Redirecting in 5secs</p>"; 
                        let tID = setTimeout(function () {

                        // redirect page.
                        window.location.href = 'index.html';
                        window.clearTimeout(tID);		// clear time out.

                        }, 5000);	// call function after 5000 milliseconds or 5 seconds

                    }
                    else if(result==2)
                    {
                      $('#modalconsent').modal('hide');
                      document.getElementById("btnconsent_close").disabled = false;
                      document.getElementById("btnconsent_save").disabled = false;
                      document.getElementById("btnregister").disabled = false ;
                      document.getElementById("btncancel").disabled = false;
                      $("#ajaxconsent").hide(); 
                   
              
                        document.getElementById('textresult').innerHTML = "<p class='text-danger'>Username is already been used</p>"; 
                    }

                    else if(result==3)
                    {
                      $('#modalconsent').modal('hide');
                      document.getElementById("btnconsent_close").disabled = false;
                      document.getElementById("btnconsent_save").disabled = false;
                      document.getElementById("btnregister").disabled = false ;
                      document.getElementById("btncancel").disabled = false;
                      $("#ajaxconsent").hide(); 

        
                        document.getElementById('textresult').innerHTML = "<p class='text-danger'>Data Duplication, please ask for forgot password</p>"; 
                    }
                    else 
                    {

                   
                      document.getElementById("btnconsent_close").disabled = false;
                      document.getElementById("btnconsent_save").disabled = false;
                      document.getElementById("btnregister").disabled = false ;
                      document.getElementById("btncancel").disabled = false;
                      $("#ajaxconsent").hide(); 
                      $('#modalconsent').modal('hide');

                        $('#textresult').empty();
                        $('#textresult').append(result);
                      
                     
                    }
                }); 

              }
              else 
              {
                  document.getElementById("btnconsent_close").disabled = false;
                  document.getElementById("btnconsent_save").disabled = false;
                  document.getElementById("btnregister").disabled = false ;
                  document.getElementById("btncancel").disabled = false;
                  $("#ajaxconsent").hide(); 
                    
                document.getElementById('reloadconsent').innerHTML = "<p class='text-danger'>Kindly Click the checkbox if you agreed in accepting the terms of data privacy act</p>"; 
                 
              }
            
          } catch (error) {
            alert(error); 
          }
          



        }




  </script> 

  <style>
.headerstyle 
{
    background-color:#1c41a1;
     color:yellow;
     border-top-right-radius:20px; 
     border-top-left-radius: 20px;
     padding:10px;
      height:auto; 
      width:100%;



}

.borderall 
{
margin-top: 10px;
    margin-top: -15px;
}

label 
{
    font-size: 20px;
}

.form-control
{
    border-radius: 10px;
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

                <!-- Modal -->
          <div class="modal fade" id="modalconsent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DATA PRIVACY ACT</h5>
                    <input type="hidden" id="applyjobtitleid" name="applyjobtitleid">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <div class="modal-body">
                <div class="container" id="applicationstatus">
                
                  <div class="row">
                    <h5>DATA PROTECTION POLICY</h5>
                  </div>
                  <div class="row">
                  <p>We are aware of our responsibility to protect your personal data. We act in accordance with the principles introduced by applicable legal regulations and the general principle on good faith in the processing of personal data</p>
                  </div>

                  <div class="row">
                  <p>We determine clearly and precisely its legitimate and lawful purpose for processing personal data and process personal data to the extent necessary and in connection with the products and services we offer</p>
                  </div>

                  <div class="row">
                  <p>We transfer your personal data in compliance with applicable laws and only when it is necessary. We take required technical and administrative measures to protect your personal data and also we ensure that Data Processors take administrative and technical measures regarding data security by signing non-disclosure agreements.</p>
                  </div>

                  <div class='form-group' style="margin-left: 10px;">

                     <input type="checkbox" class="form-check-input " name="consentcheck" id="consentcheck" value="checkedValue" >
                            I Read and accept the data proctection policy
                      </label>

                  </div>

                  <div class="row">
                    <p id="reloadconsent"></p>
                  </div>
                 
               </div>
        
          
                </div>
              
                <div class="modal-footer">
                  <button type="button" id="btnconsent_close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" id="btnconsent_save"class="btn btn-success" onclick="finalsave()">Proceed</button> <img src='images/ajax-loader.gif' id='ajaxconsent'/>
             
                </div>
              </div>
            </div>
          </div>


       <div class="container-fluid" style="padding: 40px;">
            
          

            <div class="row ">
                <div class="form-control headerstyle"> 
                    <h3 style="color:#0fc61b;"> Login-Details </h3>
                </div>

                <div class="container-fluid borderall">

                <div class="form-group" style="margin-top: 20px;"> 
                            <label for="myusername" class="form-label">Email Address<span style="color:red"> *</span></label>
                            <input type="email" name="myusername" id="myusername" class="form-control" style="width: 100%" placeholder="Enter your Email">
                            <small id="error_myusername"  style="color:red">* Kindly fill up the following field</small>
                   
                </div>

                    <div class="form-group"> 
                            <label  for="mypassword" >Password <span style="color:red"> *</span></label>
                            <div class="input-group" id="show_hide_password">
                                <input class="form-control" type="password" name="mypassword" id="mypassword" placeholder="Enter your password">
                                <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true" style="margin-left: 10px;"></i></a>
                                </div>
                                <small id="error_mypassword"  style="color:red">* Kindly fill up the following field</small>
                   
                            </div>
                    </div>
                </div>

                <div class="form-control headerstyle"> 
                    <h3 style="color:#0fc61b;">Information </h3>
                </div>
                  
                <div class="container-fluid borderall" style="margin-top: 20px;">
                    <div class="form-group"> 
                            <label for="firstname" class="form-label">Firstname <span style="color:red"> *</span> </label>
                            <input type="text" name="firstname" id="firstname" class="form-control" style="width: 100%" placeholder="Enter your Firstname">
                            <small id="error_firstname"  style="color:red">* Kindly fill up the following field</small>
                    </div>

                    <div class="form-group"> 
                            <label for="middlename" class="form-label">Middlename <span style="color:red"> *</span> </label>
                            <input type="text" name="middlename" id="middlename" class="form-control" style="width: 100%" placeholder="Enter your middlename">
                            <small id="error_middlename"  style="color:red">* Kindly fill up the following field</small>
             
                    </div>

                    <div class="form-group"> 
                            <label for="lastname" class="form-label">Lastname <span style="color:red"> *</span></label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your Lastname">
                            <small id="error_lastname"  style="color:red">* Kindly fill up the following field</small>
             
                    </div>

                    <div class="form-group"> 
                            <label for="gender" class="form-label">Gender <span style="color:red"> *</span></label>
                            <select class="form-control" name="gender" id="gender" >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <?php //rankcmb(); ?> 
                            </select>
                            <small id="error_gender"  style="color:red">* Kindly fill up the following field</small>
             
                    </div>

                    <div class="form-group"> 
                            <label for="rank" class="form-label">Current Rank <span style="color:red"> *</span></label>
                            <select class="form-control" name="rank" id="rank" >
                       
                            <?php rankcmb(); ?> 
                            </select>
                            <small id="error_rank"  style="color:red">* Kindly fill up the following field</small>
             
                    </div>

                    <div class="form-group"> 
                            <label for="rank_applied" class="form-label">Applying for Rank <span style="color:red"> *</span></label>
                            <select class="form-control" name="rank_applied" id="rank_applied" >
                       
                            <?php rankcmb(); ?> 
                            </select>
                            <small id="error_rank_applied"  style="color:red">* Kindly fill up the following field</small>
             
                    </div>



                    <div class="form-group"> 
                            <label for="address" class="form-label">Address <span style="color:red"> *</span></label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter your Address">
                            <small id="error_address"  style="color:red">* Kindly fill up the following field</small>
             
                    </div>



                    <div class="form-group"> 
                            <label for="birthdate" class="form-label">Birthdate <span style="color:red"> *</span></label>
                            <input type="text" name="birthdate" id="birthdate" class="form-control">
                            <small id="error_birthdate"  style="color:red">* Kindly fill up the following field</small>
             
                     </div>

                     <div class="form-group"> 
                            <label for="contactnumber" class="form-label">Contact Number <span style="color:red"> *</span></label>
                            <input type="number" name="contactnumber" id="contactnumber" class="form-control" placeholder="Enter your Active Number">
                            <small id="error_contact"  style="color:red">* Kindly fill up the following field</small>
             
                    </div>


                    <div class="form-group">
                      <label for=""></label>
                     <button name="btnregister" id="btnregister" type="button" class="btn btn-success" onclick="savedetails()">Register</button>
                     <button name="btncancel" id="btncancel" type="button" class="btn btn-danger" onclick="returnmain()">Cancel</button>
                      
                    </div>


                    <div class="form-group">
                     <p id="textresult" name="textresult"></p>
                    </div>


                </div>
            </div>
            



        </div>      


  </body>



</html>