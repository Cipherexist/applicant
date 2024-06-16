<?php 
include 'forcookie.php';
include 'modules.php';
include 'loadfunction2.php'; 

@$myusername = $_COOKIE['usname']; 

$qqq = "SELECT * from `monitoring_quiz` Where `username` Like '$myusername' and `active` Like 'yes'"; 

$das = mysqli_query($sqlcon,$qqq); 


if(!mysqli_error($sqlcon))
{
  while($dd = mysqli_fetch_assoc($das))
  {
    @$theviewtype =  $dd['functionid'];
    @$thehiring =  $dd['hiringid']; 
  }

  

}
else 
{
  echo mysqli_error($sqlcon); 
}

@$thecompetence =  "1";

@$sessionid = loadmysession($myusername,$thehiring,$theviewtype); 
@$thetimer = loadmytimer($myusername,$thehiring,$theviewtype); 
@$mycompetence = "1";
@$theqn = "10";







/*
@$theaverage = loadtextreturn("onlinetrainings","average","Where traineeid Like '$myusername' and classcode Like '$theclassno'");

if ($theaverage =="")
{
  loadquizfirsttime($theviewtype);
}
else 
{
  @$average = intval($theaverage); 

    if($average <75)
    {
      loadquizfirsttime($theviewtype);
    }
}
*/
//if loadnumberofdataall("onlineresults","Where course Like '$theviewtype' and session Like '$sessionid' and")
@$thenumber = 0;

@$numberofdata =  loadnumberofdataall("onlineresults","Where `username` Like '$myusername' and `course` Like '$theviewtype' and `hiringid` Like '$thehiring' and `session` Like '$sessionid'"); 

if ($numberofdata == 0)
{
  @$thenumber = 1;
 // echo 'First time: '. $theviewtype . " " . $thecompetence . " " . $theqn . " Session " . $sessionid; 

 echo "<script> document.getElementById('showtime').innerHTML = '10:00'; </script>"; 
 echo "<script> document.getElementById('mytime').value =  '10:00'; </script>"; 

loadquizfirsttime($theviewtype,$theqn,$sessionid,$thehiring);
}
else
{
  //echo 'Second time'; 
  $mysql = "Select * from `onlineresults` Where `username` Like '$myusername' and `course` Like '$theviewtype' and `hiringid` Like '$thehiring' and `session` Like '$sessionid' ORDER BY qno ASC"; 
  $dba = mysqli_query($sqlcon, $mysql); 

  if(!mysqli_error($sqlcon))
  {
      if(mysqli_num_rows($dba)!=0)
      {
        while($rows = mysqli_fetch_assoc($dba))
        {
          if($rows["status"]=='FAILED'||$rows["status"]=='PASSED')
          {
            $thenumber +=1;
          }
        }
      }
  
      
     // echo $thenumber;
      //echo $mysql;
  }
}





function checkstatus($viewtype, $competence, $session)
{
    include 'dbconfig.php';
  
    $queryko = "Select * from `onlineresults` Where course Like '".$viewtype . "' and session Like '". $session . "' and competence Like ".$competence. " and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC";
    $dax = mysqli_query($sqlcon, $queryko);
    $corrected = 0;
    $totalme = 0;
    $codecomplete =0;
    $status = "";
    if(!mysqli_error($sqlcon))
    {   
    
        if(mysqli_num_rows($dax)!=0)
        {
          $status = "pasok";
            $totalme = mysqli_num_rows($dax); 
            while($row3 = mysqli_fetch_assoc($dax)) 
            {
                if($row3['uranswer']!="")
                {
                $corrected += 1 ;
                }
            }

        }
   }
   else 
   {
    echo mysqli_error($sqlcon);
   }
      if($corrected >0)
      {
        $codecomplete = $corrected;
      }

   //   return $codecomplete;
     return $queryko;
}






?> 

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class='no-js lt-ie9 lt-ie8 lt-ie7'> <![endif]-->
<!--[if IE 7]>         <html class='no-js lt-ie9 lt-ie8'> <![endif]-->
<!--[if IE 8]>         <html class='no-js lt-ie9'> <![endif]-->
<!--[if gt IE 8]>      <html class='no-js'> <!--<![endif]-->
<html>
    <head>

        <style>
            .questionstyle 
            {
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 10px;
                padding-bottom: 10px;
                border-style: solid;
            }

            .choicesstyle 
            {
                padding-left: 20px;
                margin-top: 5px;
            }


            .noselect {
              font-size:20px;
              font-weight: 800;
              -webkit-touch-callout: none; /* iOS Safari */
                -webkit-user-select: none; /* Safari */
                -khtml-user-select: none; /* Konqueror HTML */
                  -moz-user-select: none; /* Old versions of Firefox */
                    -ms-user-select: none; /* Internet Explorer/Edge */
                        user-select: none; /* Non-prefixed version, currently
                                              supported by Chrome, Edge, Opera and Firefox */
             }

             
            .noselectlarge {
              font-size:25px;
             
              -webkit-touch-callout: none; /* iOS Safari */
                -webkit-user-select: none; /* Safari */
                -khtml-user-select: none; /* Konqueror HTML */
                  -moz-user-select: none; /* Old versions of Firefox */
                    -ms-user-select: none; /* Internet Explorer/Edge */
                        user-select: none; /* Non-prefixed version, currently
                                              supported by Chrome, Edge, Opera and Firefox */
             }


   
        </style>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title></title> 
        <meta name='description' content=''>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css'>
        <!--
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src='js/jquery.min.js'></script>
        <script src='js/bootstrap.min.js'></script>
        <script src='js/jquery.js'></script>
        <script src='js/jquery-1.10.2.js'></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        -->
         <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js'></script> 	
        
        <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js'></script>	
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        




      <script>



        function sendanswer()
        {

          try {

          var radioname = document.getElementsByName("radiochoices"); 
          var myanswer = $("input[name='radiochoices']:checked").val();
          //alert(myanswer); 
           if (myanswer != null)
           {
                  $('#ajaxloading2').show();
                  $('#errorshow').hide();
                  document.getElementById("buttonnext").disabled = true;
                  document.getElementById("buttonprev").disabled = true;
                
                  var mynumber = $("#questionno").val();
                  var mycode = $("#quizcode").val();
                  var myhiring = $("#hiringcode").val();
                  var totalquestion = $("#totalquestion").val(); 
                  $.post("quizsubmit2.php",
                  {
                    choiceanswer:myanswer,
                    choicenumber:mynumber, 
                    choicecode: mycode,
                    choicehiring: myhiring
                  },function(result){

                    var newadded = 0; 
                    newadded = parseInt(mynumber) + 1; 
                 
                    if(parseInt(newadded)<=parseInt(totalquestion))
                    {
                         document.getElementById("buttonnext").disabled = false;
                         document.getElementById("buttonprev").disabled = false;
                          $('#ajaxloading2').hide();
                          var newvalue= document.getElementById('questionno');
                          newvalue.value = newadded;
                          document.getElementById('mycurrentquestion').innerHTML = "Current Question: " + newadded + " To " + totalquestion; 

                        
                          $('#reloadquestion').empty();
                          $('#reloadquestion').append(result);
                    }
                    else 
                    {
                     
                      clearTimeout(startTimer);
                      $('#mytime').hide();
                      $('#showtime').hide();
                      document.getElementById("buttonnext").disabled = false;
                      document.getElementById("buttonprev").disabled = false;
                      $('#ajaxloading2').hide();
                      $('#buttonnext').hide();
                      $('#buttonprev').hide();
                      $('#buttonreturn').show();
                      $('#buttonretake').show();
                      $('#reloadquestion').empty();
                      $('#reloadquestion').append(result);
                    }
                  });

            }
            else
            {
              $('#errorshow').show();
              $('#errorshow').empty();
              document.getElementById("errorshow").innerHTML = "<p style='color:red;'>Error, please submit answer<p>";
            
            }

          } catch (error) {
              alert(error);
          }
  

        }

        function prevanswer()
        {

          try
          {


                $('#errorshow').hide();
                  $('#ajaxloading2').show();
                  document.getElementById("buttonprev").disabled = true;
                  document.getElementById("buttonnext").disabled = true;
                  var myanswer = $("input[name='radiochoices']:checked").val();
                  var mynumber = $("#questionno").val();
                  var mycode = $("#quizcode").val();
                  var mycompetence = $("#competencecode").val();
                  var totalquestion = $("#totalquestion").val(); 
                  var myhiring = $("#hiringcode").val();
                  $.post("quizsubmitback.php",
                  {
                    choiceanswer:myanswer,
                    choicenumber:mynumber, 
                    choicecode: mycode,
                    choicehiring: myhiring,
                    choicecompetence: mycompetence
                  },function(result){

                    var newadded = 0; 
                    newadded = parseInt(mynumber) - 1; 
                  //  timeupdating();
                    if(parseInt(newadded)>0)
                    {
                        document.getElementById("buttonprev").disabled = false;
                        document.getElementById("buttonnext").disabled = false;
                         $('#ajaxloading2').hide();
                          var newvalue= document.getElementById('questionno');
                          newvalue.value = newadded;
                          document.getElementById('mycurrentquestion').innerHTML = "Current Question: " + newadded + " To " + totalquestion; 

                      
                          $('#reloadquestion').empty();
                          $('#reloadquestion').append(result);
                    }
                    else 
                    {
                      document.getElementById("buttonprev").disabled = false;
                      document.getElementById("buttonnext").disabled = false;
                      $('#ajaxloading2').hide();
                       alert("Already the first question");
                    }
                  });

          } catch (error) 
          
          {
            alert(error);
          }
           


                  
        }


        function returnme()
        {
            window.close(); 

        }


        function showexam(classno,mycompetence)
        {
              document.getElementById("buttonverify").disabled = false ;
              $('#buttonverify').hide();
              $('#examform').show();
              $('#mainform').hide();
              $('#ajaxloading1').hide();
              startTimer(); 

        }

        function showresult()
        {
          document.getElementById("buttonverify").disabled = false ;
              $('#buttonverify').hide();
              $('#examform').show();
              $('#mainform').hide();
              $('#ajaxloading1').hide();
              $('#buttonnext').hide();
              $('#buttonprev').hide();
            $('#buttonreturn').show();
           $('#buttonretake').show();
           $('#mycurrentquestion').hide();
           
        }

        function resetbutton2()
        {
              $.post("quizreset.php",
                  {
                  },function(result){
                   // alert(result);
                        if(result==1)
                        {
                       // alert("Data Reset!");
                         location.reload();
                        }
                        else 
                        {
                          alert(result); 
                        }
                  });
        }


        function timereset()
        {    
          try {
            var remtime = "10:00";
            
           //alert(remtime); 
              

              $.post("quiz_updatetime.php",
                  {
                    savetime: remtime
                  },function(result){
                   // alert(result); 
                  });

          } catch (error) {
            alert(error)
          }
    

        }


        
        function timeupdating()
        {    
          try {
            var remtime = $("#mytime").val();
            
           //alert(remtime); 
              

              $.post("quiz_updatetime.php",
                  {
                    savetime: remtime
                  },function(result){
                   // alert(result); 
                  });

          } catch (error) {
            alert(error)
          }
    

        }


        function restartbutton()
        {


          location.reload();

          
        }

        function resetbutton(viewtype,competence,session)
        {
          // alert("wiw"); 

           Swal.fire({
              title: 'Do you want to reset the competence?:',
              showDenyButton: true,
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              denyButtonText: `Don't Reset`,
              confirmButtonText: `Reset`,
              }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed)
              {
                 alert("Data Reset!");
                location.reload();
        
              } 
              else if (result.isDenied) 
              {
                // Swal.fire('Changes are not saved', '', 'info')
              }
              }); 

        }





        
        function retakebutton(viewtype,competence,session,hiringid)
        {
          // alert("wiw"); 

           Swal.fire({
              title: 'Do you want to reset the competence?:',
              showDenyButton: true,
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              denyButtonText: `Don't Reset`,
              confirmButtonText: `Reset`,
              }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed)
              {
                

                $.post("quizreset.php",
                  {
                    rsviewtype:viewtype,
                    rscompetence:competence, 
                    rssession: session, 
                    rshiring: hiringid
                  },function(result){
                   // alert(result);
                        if(result==1)
                        {
                         alert("Data Reset!");
                         location.reload();
                        }
                        else 
                        {
                          alert(result); 
                        }




                  });
              } 
              else if (result.isDenied) 
              {
                // Swal.fire('Changes are not saved', '', 'info')
              }
              }); 

        }


      
        $(document).ready(function() 
        {
          let sec = 60; 

          

          window.opener.location.reload();
            $('#buttonreturn').hide();
            $('#buttonretake').hide();
            $('#examform').hide();
            $('#resultverify').hide();
            $('#ajaxloading1').hide();
            $('#ajaxloading2').hide();
            $('#errorshow').hide();
            
          var table = $('.mydatatable').DataTable();
              $('.mydatatable tbody').on( 'click', 'tr', function ()
              {
                if ( $(this).hasClass('selected') ) 
                {
                    $(this).removeClass('selected');
                }
                else 
                {
                      table.$('tr.selected').removeClass('selected');
                      $(this).addClass('selected');
                }
              });
          
        });
 <?php
 $settime = "60" . ":00";
 ?>


        document.getElementById('mytime').innerHTML = '<?php echo $settime; ?>';
        //03 + ":" + 00 ;


      function startTimer() {

        try 
        {
            var presentTime = $("#mytime").val();
            var timeArray = presentTime.split(/[:]+/);
            var m = timeArray[0];
            var s = checkSecond((timeArray[1] - 1));
            if(s==59)
            {
              timeupdating();
              m=m-1
          
            }
            if(m==0 && s==0)
            {
              clearTimeout(startTimer);
              $('#mytime').hide();
              $('#showtime').hide();
              alert('Session Ended'); 
              resetbutton2();
             
            }
            else 
            {
              document.getElementById('showtime').innerHTML = m + ":" + s;
            document.getElementById('mytime').value =  m + ":" + s;
            setTimeout(startTimer, 1000);  
            
            }
          
        } catch (error) {
          alert(error); 
        }
       
      }

      function checkSecond(sec) {
        try 
        {
              if (sec < 10 && sec >= 0) 
              {sec = "0" + sec
              };
              // add zero in front of numbers < 10
              if (sec < 0) 
              {sec = "59"
              };
          
            /*
              if(sec == 0 && m == 0)
              {
                alert('Session Ended'); 
                resetbutton2();

              }
            */

            
              return sec;
        } catch (error) 
        {
          alert(error); 

        }
       
      }


          


      </script>



    </head>
    
    

  <div id="mainform"  class='container' style='margin-top: 40px;'>
  <div class='row'>
  <?php echo "<h5> Session No: " . $sessionid . "</h5>"; ?>
  </div>
  <div class='row'>
    <h5> To Start your exam, please click the button below</h5>
  </div>

  <div class='row' id='resultverify'>
    <p > Unable to start this examination</p>
  </div>

  <div class='row' style="margin-top:10px;">
  <?php 
  if($thenumber>=$theqn)
  {
    echo "<button type='button' id='buttonverify' class='btn btn-success' onclick='showresult()'>Show Result</button>";
 
  }
  else 
  {

    echo "<button type='button' id='buttonverify' class='btn btn-success' onclick='showexam()'>Click to Start</button>";
 
  }
  //echo $_GET['qn'];
   ?>


  <?php
      $code = '"'. "Deck Management Level" . '"'; 
      @$resetsession = '"'. loadmysession($_COOKIE['usname'], $thehiring, $theviewtype ). '"'; 
      @$resetusername = '"'. $_COOKIE['usname'] . '"'; 
      @$resetclassno = '"'."Deck Management Level" . '"';
      @$resetcompetence = '"'. "1".'"';
      
      @$val = $thenumber;

      
      if($thenumber>1)
      {
       // echo "<button type='button' id='buttonverify' class='btn btn-danger' style='margin-left: 10px' onclick='resetbutton($resetclassno,$resetcompetence,$resetsession)'>Reset from Start?</button>"; 

      }
      
  ?>
</div>

  <div class='row' style="margin-top:10px;">
  <p id="ajaxloading1"><img src="image/ajax-loader.gif"/> Please wait </p>
  </div>

  </div>

  <div id="examform" class='container' style='margin-top: 40px; padding-left: 20px; padding-right: 20px; padding-top: 20px; padding-bottom: 20px;'>

    <div class='row'>
      <?php
      @$viewtypecode = $theviewtype; 
      
      echo "<p>Quiz: <input type='hidden' id='quizcode' value='$viewtypecode'>". loadquizname($viewtypecode) ."</input></p><br>"; 
      ?>
      </div> 

      <div class='row'>
      <?php
         @$competencecode = $_GET['competence'];
         @$myhiring = $thehiring;
         echo "<input type='hidden' id='competencecode' value='$competencecode'>"; 
         echo "<input type='hidden' id='hiringcode' value='$myhiring'>"; 
      //   echo "<p>Competence: $competencecode </input></p>"; 
      ?>
      </div>

    <div class='row'>
    <input type='hidden' id='questionno' value='<?php echo $thenumber; ?>'></input>
    <input type='hidden' id='totalquestion' value="<?php echo $theqn; ?>">
  </input>
    <p id='mycurrentquestion'> Current Question: <?php echo $thenumber; ?> to 
    <?php
         $code  =$theviewtype; 
         $mysession = loadmysession($_COOKIE['usname'],$thehiring, $theviewtype); 
         @$mytotalquestion =$theqn;
         @$myshow = "". $mytotalquestion; 

     echo "$myshow</p>"; 
    ?>

   
    
    </div> 
    <div class='row'>
      
   
   <?php 
   
    echo "<p style='size: 250px;' class='text-danger'>Remaining Time: <input type='hidden' id='mytime' value='$thetimer'><span id='showtime'> ".  $thetimer . "</span></input></p><br>";  
  
  ?>
  
  
  </div>



    <div class='row justify-content-md-center'>

    </div> 

    <div id="reloadquestion"> 
      <?php 
    //  $code  =$theviewtype; 
     // $mysession = loadmysession($_COOKIE['usname'],  $code ); 
    //  @$myusername = $_COOKIE['usname']; 
    //  @$theclassno =$theviewtype;
    //  @$mycompetence = $_GET['competence'];
     
               
       loadmyquestion($thenumber,$code,$mysession,$thehiring);
     


    


      ?>
    </div>

 
      <div class='row justify-content-md-left' style='margin-top: 10px;'>

         <button type='button' id="buttonprev" class='btn btn-primary' onclick='prevanswer()'>
          Previous
          </button>

          <button type='button' style="margin-left: 10px;" id="buttonnext" class='btn btn-info' onclick='sendanswer()'>
          Next
          </button>
      </div>

      
      <div class='row' style="margin-top:10px;">
      <p id="errorshow">Error show</p>
      <p id="ajaxloading2"><img src="images/ajax-loader.gif"/>Sending answer</p>
      </div>


      <div class='row justify-content-md-left' style='margin-top: 10px;'>
          <button type='button' id="buttonreturn" class='btn btn-primary' onclick='returnme()'>
          Return to Main page
          </button>

          <?php

            $code = '"'.$theviewtype . '"'; 
            @$resetsession = '"'. loadmysession($_COOKIE['usname'], $thehiring,$theviewtype). '"'; 
            @$resetusername = '"'. $_COOKIE['usname'] . '"'; 
            @$resetclassno = '"'.$theviewtype . '"';
            @$resetcompetence = '"'. $_GET['competence'] .'"';
            @$resethiring = '"'. $thehiring .'"';
            @$val = $thenumber;


        //  echo "<button type='button' id='buttonretake' style='margin-left:10px;' class='btn btn-danger' onclick='retakebutton($resetclassno,$resetcompetence,$resetsession,$resethiring)'>Re-take</button>"
           // echo "<button type='button' id='buttonretake' style='margin-left:10px;' class='btn btn-danger' onclick='restartbutton()'>Re-take</button>"
      
          ?>
      
      
      
        </div>

      <div class='row justify-content-md-left' style='margin-top: 10px;'>
          
      </div>
     

     

     

    <div class='md-6' style='margin-top: 50px;'>

    


              
    </div>


  </div>

  



</html>