<!DOCTYPE html>
<html>
<?php include "title.php";
  include "loadcmb.php"; ?> 
<head>
	<meta charset="utf-8">
	<title>Registration</title>

	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="regcssjs/css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="regcssjs/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- datepicker -->
	<link rel="stylesheet" type="text/css" href="regcssjs/css/jquery-ui.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="regcssjs/css/style.css"/>

	


	<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

   <!--  <link rel="stylesheet" href="css/style.css"> -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->

 
   <script src="regcssjs/js/jquery-3.3.1.min.js"></script>
	<script src="regcssjs/js/jquery.steps.js"></script>
	<script src="regcssjs/js/jquery-ui.min.js"></script>
	<script src="regcssjs/js/main.js"></script>


	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 	
  
<script>

$(document).ready(function() 
  {
	$("#cardreminder").hide(); 

	const rankevent = document.getElementById("rank_applied"); 

		rankevent.addEventListener("change",function(){ 
			$("#cardreminder").hide(); 
			$("#cardreminder").delay(500).fadeIn(500); 
		
		}
		);

		

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

	$('#modalconsent').modal('show');
	}
	else 
	{

	}


  } catch (error) {
	alert(error); 
  }
  

}

function callsaveme()
{
	$("#modalconsent").modal("show"); 
}


function finalsave()
{

  try 
  {

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
	var therelation = $("#relation").val(); 
	var thecadet = $("#cadet").val(); 
	var theonboardexperience = $("#experience").val(); 
	var thepreviouscompany = $("#previouscompany").val(); 
	var theavailability = $("#availability").val();
	//var theresumeupload = $("#resumeupload").val() 
	//var theresumeupload = $('#resumeupload').prop('files')[0]; 
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
			mycontactnumber: thecontactnumber, 
			myrelation: therelation, 
			mycadet: thecadet, 
			myonboardexperience: theonboardexperience, 
			mypreviouscompany: thepreviouscompany, 
			myavailability: theavailability
		},function(result)
		{
			if(result==1)
			{
		///	  $('#modalconsent').modal('hide');
			//   document.getElementById("btnconsent_close").disabled = false;
			//   document.getElementById("btnconsent_save").disabled = false;
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
			//   $('#modalconsent').modal('hide');
			  document.getElementById("btnconsent_close").disabled = false;
			  document.getElementById("btnconsent_save").disabled = false;
			  $("#ajaxconsent").hide(); 
		   
	  
				document.getElementById('textresult').innerHTML = "<p class='text-danger'>Username is already been used</p>"; 
			}

			else if(result==3)
			{
			//   $('#modalconsent').modal('hide');
			  document.getElementById("btnconsent_close").disabled = false;
			  document.getElementById("btnconsent_save").disabled = false;
			  $("#ajaxconsent").hide(); 


				document.getElementById('textresult').innerHTML = "<p class='text-danger'>Data Duplication, please ask for forgot password</p>"; 
			}
			else 
			{

		   
			  document.getElementById("btnconsent_close").disabled = false;
			  document.getElementById("btnconsent_save").disabled = false;
			  $("#ajaxconsent").hide(); 
			//   $('#modalconsent').modal('hide');

				$('#textresult').empty();
				$('#textresult').append(result);
			  
			 
			}
		}); 

	  }
	  else 
	  {
		  document.getElementById("btnconsent_close").disabled = false;
		  document.getElementById("btnconsent_save").disabled = false;
		  $("#ajaxconsent").hide(); 
			
		document.getElementById('reloadconsent').innerHTML = "<p class='text-danger'>Kindly Click the checkbox if you agreed in accepting the terms of data privacy act</p>"; 
		 
	  }
	
  } catch (error) {
	alert(error); 
  }
  



}





</script> 







</head>

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
				
				  <div id="textresult"></div>
                </div>
              </div>
            </div>
          </div>















<body style="background-image: url('regcssjs/images/wizard-v4.jpg')">
	<div class="page-content" >
		<div class="wizard-v3-content">
			<div class="wizard-form">
				<div class="wizard-header">
					<p>Fill all form field to go next step</p>
				</div>
		        <form class="form-register" action="#" method="post">
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-account"></i></span>
			            	<span class="step-text">Applying</span>
			            </h2>
			            <section>
			                <div class="inner">

											<div class="form-group"> 
													<label for="rank_applied" class="form-label">Applying for Rank <span style="color:red"> *</span></label>
													<select class="form-control" id="rank_applied" >
											
													<?php rankcmb(); ?> 
													</select>
													<small id="error_rank_applied"  style="color:red">* Kindly fill up the following field</small>
									
													<div class="card text-left mt-4" id="cardreminder">
													  <img class="card-img-top" src="holder.js/100px180/" alt="">
													  <div class="card-body">
														<h4 class="card-title">Important Reminders</h4>
														<ul>
															<li>Must be a filipino citizen</li>
															<li>Bring all documents including prevs. Medical,MDR of philhealth, MDF of Pagibig and nbi clearance</li>
															<!-- <li>With US Visa</li> -->
														</ul>

													  </div>
													</div>


											</div>

											<div class="form-group">
											  <label for="availability">Date Availability</label>
											  <input type="text"
												class="form-control"  id="availability" aria-describedby="helpId" placeholder="Ex. Anytime, next june, this july">
											</div>
							</div>
			            </section>
						<!-- SECTION 2 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-lock"></i></span>
			            	<span class="step-text">Personal</span>
			            </h2>
			            <section>
			                <div class="inner">
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

							</div>
			            </section>
			            <!-- SECTION 3 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-card"></i></span>
			            	<span class="step-text">Questions</span>
			            </h2>
			            <section>
			                <div class="inner">

								<div class="form-group">
								  <label for="relation">Relation</label>
								  <select class="form-control" name="relation" id="relation">
									<option value='formercrew'>Former Crew</option>
									<option value='newapplicant'>New Applicant</option>
								  </select>
								</div>
								
								<div class="form-group">
								  <label for="cadet">Are you a Cadet?</label>
								  <select class="form-control" name="cadet" id="cadet">
									<option value='yes'>Yes</option>
									<option value='no'>No</option>
								  </select>
								</div>

								<div class="form-group">
								  <label for="experience">Onboard Experience</label>
								  <textarea class="form-control" name="experience" id="experience" rows="3"></textarea>
								</div>

								<div class="form-group">
								  <label for="previouscompany">Previous Company</label>
								  <input type="text"
									class="form-control" id="previouscompany" aria-describedby="helpId" placeholder="">
								</div>

								<!-- <div class="form-group">
								  <label for="resumeupload">Upload Resume (optional)</label>
								  <input type="file" class="form-control-file" id="resumeupload" placeholder="" aria-describedby="fileHelpId">
								</div> -->

							</div>
			            </section>
			            <!-- SECTION 4 -->
			            <h2>
			            	<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
			            	<span class="step-text">Account</span>
			            </h2>
			            <section>
			                <div class="inner">

								<div class="form-group"> 
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
			            </section>
		        	</div>
		        </form>
			</div>
		</div>
	</div>





	
</body>


	<script>

	</script>



</html>