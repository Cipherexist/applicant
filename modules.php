<?php 


function quiznext($email,$hiring)
{
	
    include 'dbconfig.php'; 

  
    @$hiringid = $hiring;
    @$username = $email;

        $callsql = "Select * from `monitoring_quiz` Where hiringid Like '$hiringid' and username Like '$username'"; 
        $daxme = mysqli_query($sqlcon,$callsql); 

	
		//echo $callsql;
        if(!mysqli_error($sqlcon))
        {
		  if(mysqli_num_rows($daxme)!=0)
		  {
				$count = 0; 
				while($dips = mysqli_fetch_assoc($daxme))
				{

				
					@$count = $count + 1;
					@$isactive =  $dips['active'];
					@$status =  $dips['status'];
					@$id =  $dips['id'];

				//	echo $id;
					if($status=='Pending')
					{
					//	echo $id;
						@$mysql = "UPDATE `monitoring_quiz` SET `active`='yes' Where id Like '$id'"; 
						//echo "UPDATE SESSION SQL: " . $mysql;
				
						mysqli_query($sqlcon,$mysql); 
						if(!mysqli_error($sqlcon))
						{
							break;
						}
						else 
						{
							echo mysqli_error($sqlcon);
						}
						
					}
					else 
					{
						@$mysql = "UPDATE `monitoring_quiz` SET `active`='' Where id Like '$id'"; 
						//echo "UPDATE SESSION SQL: " . $mysql;
				
						mysqli_query($sqlcon,$mysql); 
						if(!mysqli_error($sqlcon))
						{

						}
						else 
						{
							echo mysqli_error($sqlcon);
						}
					}
				
				}
		  }
		  else 
		  {
			echo "No data to show";
		  }
	
        }
        else 
        {
          echo mysqli_error($sqlcon);
        }

}


function updatestage2examfinish($hiringid,$username)
{
  $proceed = 0;

  include "dbconfig.php"; 
  
  $callsql = "Select * from `monitoring_quiz` Where hiringid Like '$hiringid' and username Like '$username'"; 
  $daxme = mysqli_query($sqlcon,$callsql); 

  if(!mysqli_error($sqlcon))
  {
	$totalpassed = mysqli_num_rows($daxme); 
	  if($totalpassed!=0)
	  {
			$colpass = 0; 
	  

			while($rows=mysqli_fetch_assoc($daxme))
			{
			  if($rows['status']=="Passed"||$rows['status']=="Failed")
			  {
				$colpass +=1; 
			  }
			}
  
			if($colpass==$totalpassed)
			{
			  updatethemonitor($hiringid,"Exam Finished"); 
			}
			elseif($colpass>=1)
			{
			  updatethemonitor($hiringid,"Exam Ongoing"); 
			}
			
	  }
 

  }
  else 
  {
	  echo mysqli_error($sqlcon); 

  }


return $proceed; 


}



function checkstage2exambeforefinish($hiringid,$username)
{
  $proceed = 0;

  include "dbconfig.php"; 
  
  $callsql = "Select * from `monitoring_quiz` Where hiringid Like '$hiringid' and username Like '$username'"; 
  $daxme = mysqli_query($sqlcon,$callsql); 

  if(!mysqli_error($sqlcon))
  {
	$totalpassed = mysqli_num_rows($daxme); 
	  if($totalpassed!=0)
	  {
			$colpass = 0; 
	  

			while($rows=mysqli_fetch_assoc($daxme))
			{
			  if($rows['status']=="Passed"||$rows['status']=="Failed")
			  {
				$colpass +=1; 
			  }
			}
			$totalcount = $totalpassed - $colpass;
  
			if($totalcount==1)
			{
			 return "Exam Finished";
			}
			elseif($totalcount==0)
			{
			  return "End of Examination";
			}
			else
			{
			  return "Exam Ongoing";
			}
			
	  }
 

  }
  else 
  {
	  echo mysqli_error($sqlcon); 

  }


return $proceed; 


}



function loadregistrationtime()
{

	$completetime = time(); 
	
	return $completetime; 
}


function loadmyposition()
{
	@$myusername = $_COOKIE['usname']; 

	$myrank = loadtextreturn("applicantinfo","currentrank","Where `username` Like '$myusername'"); 


	return $myrank; 

}

function loaddoctype($id)
{
    @$myid = $id; 
    $result = "none"; 
    $doctype = loadtextreturn("requirement","doctype","Where `ID` Like '$myid'"); 
    if($doctype!="")
    {
        $result = $doctype;  
    }

    return $result;
}



// function loadexpirationcheck($mydate)
// {
//     $getdate = loadregistrationformat($mydate);
//     $gettoday = loadregistrationdatetoday(); 
//     //explode the date to get month, day and year

//     $total  = $gettoday - $getdate; 



//     if($total<0)
//     {
//         return false;
//     }
//     else 
//     {
//         return true; 
//     }



// }


function checkstage2examfinish($hiringid,$username)
{
  $proceed = 0;

  include "dbconfig.php"; 
  
  $callsql = "Select * from `monitoring_quiz` Where hiringid Like '$hiringid' and username Like '$username'"; 
  $daxme = mysqli_query($sqlcon,$callsql); 

  if(!mysqli_error($sqlcon))
  {
	$totalpassed = mysqli_num_rows($daxme); 
	  if($totalpassed!=0)
	  {
			$colpass = 0; 
	  

			while($rows=mysqli_fetch_assoc($daxme))
			{
			  if($rows['status']=="Passed"||$rows['status']=="Failed")
			  {
				$colpass +=1; 
			  }
			}
  
			if($colpass==$totalpassed)
			{
			
			 return "Exam Finished";
			}
			elseif($colpass>=1)
			{
			  return "Exam Ongoing";
			}
			
	  }
 

  }
  else 
  {
	  echo mysqli_error($sqlcon); 

  }


return $proceed; 


}



function loadcompletename($username)
{
    @$completename = ""; 
    include "dbconfig.php";
    @$theusername = $username; 

    $sql = "SELECT * from `applicantinfo` Where username Like '$theusername'"; 

    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if (mysqli_num_rows($dbt)!=0) 
        {
            while ($rows = mysqli_fetch_assoc($dbt))
            {
                $firstname = $rows['firstname']; 
                $middlename = $rows['middlename']; 
                $lastname = $rows['lastname']; 

                $completename = $firstname . ' '. substr($middlename,0,1) . ". ". $lastname; 


                return $completename; 
            }


        }
    }
    else 
    {
        echo mysqli_error($sqlcon);
    }






}


function loadcompletecoursename($codes)
{
		include 'dbconfig.php'; 
		$query = "Select * from codes Where codes Like '". $codes. "'";
		$datame = mysqli_query($sqlcon, $query);

		if(!mysqli_error($sqlcon))
		{
			if(mysqli_num_rows($datame)!=0)
			{
				while($row = mysqli_fetch_assoc($datame)) 
				{
				$codecomplete = $row["coursename"]; 
				}
			}
			else 
			{
				$codecomplete = "";
			}
		}
		else 
		{
			$codecomplete = "";
		}

		
	    return $codecomplete;
}


function updatethemonitor($hiring,$yourupdate)
{
	include 'dbconfig.php'; 
	@$username = $_COOKIE['usname']; 
	@$updatetext = $yourupdate; 
	@$hiringid = $hiring; 


	$stage1 = "UPDATE `monitoring` SET `overallstatus`='$updatetext' Where `hiringid` Like '$hiringid' and `username` Like '$username'"; 
	mysqli_query($sqlcon,$stage1);

	if(!mysqli_error($sqlcon))
	{
	   
	}
	else 
	{
	  echo mysqli_error($sqlcon); 
	}
}

function loadquizname($id)
{

    include 'dbconfig.php'; 
    @$myid = $id; 

    @$mystring = "";
    $sql = "Select * from `function` Where ID Like '". $myid ."'";
    $dbt = mysqli_query($sqlcon,$sql); 

        if(!mysqli_error($sqlcon))
        {
          
            if(mysqli_num_rows($dbt)!=0)
            {
                while($rows = mysqli_fetch_assoc($dbt))
                {
                    @$function = $rows['functiontitle'];
                    @$conv = ""; 
    
                    if($rows['viewtype']=="Deck Management Level")
                    {
                        $conv = "DM"; 
                    }
                    else if($rows['viewtype']=="Deck Operational Level")
                    {
                        $conv = "DO"; 
                    }
                    else if($rows['viewtype']=="Engine Management Level")
                    {
                        $conv = "EM"; 
                    }
                    else if($rows['viewtype']=="Engine Operational Level")
                    {
                        $conv = "EO"; 
                    }
                    $mystring = $conv . "-F" . $rows['Function']. ": ". $rows['functiontitle']; 
                }
                return $mystring; 
            }
            else 
            {
                return $mystring; 
            }
        }
        else 
        {
            echo mysqli_error($sqlcon); 
        }


}

function loadcompleterank($myrank)
{
	@$therank = $myrank; 

	$convrank = loadtextreturn("rank","rankname","Where `ID` Like '". $therank ."'"); 
	return $convrank; 

}

function loadcompletevesselname($vesselname)
{
	@$vessel = $vesselname; 

	$convrank = loadtextreturn("vessel","vesselname","Where `ID` Like '". $vessel ."'"); 
	return $convrank; 

}

function loadquizshort($id)
{

    include 'dbconfig.php'; 
    @$myid = $id; 

    @$mystring = "";
    $sql = "Select * from `function` Where ID Like '". $myid ."'";
    $dbt = mysqli_query($sqlcon,$sql); 

        if(!mysqli_error($sqlcon))
        {
          
            if(mysqli_num_rows($dbt)!=0)
            {
                while($rows = mysqli_fetch_assoc($dbt))
                {
                    @$function = $rows['functiontitle'];
                    @$conv = ""; 
    
                    if($rows['viewtype']=="Deck Management Level")
                    {
                        $conv = "DM"; 
                    }
                    else if($rows['viewtype']=="Deck Operational Level")
                    {
                        $conv = "DO"; 
                    }
                    else if($rows['viewtype']=="Engine Management Level")
                    {
                        $conv = "EM"; 
                    }
                    else if($rows['viewtype']=="Engine Operational Level")
                    {
                        $conv = "EO"; 
                    }
                    $mystring = $conv . "-F" . $rows['Function']; 
                }
                return $mystring; 
            }
            else 
            {
                return $mystring; 
            }
        }
        else 
        {
            echo mysqli_error($sqlcon); 
        }


}

function loadregistrationtocompletedate($registrationdate) 
{
	
	if(strlen($registrationdate) >= 8)
	{
		$myyear = substr($registrationdate,0,4);
		$mymonth = substr($registrationdate,4,2);
		$myday = substr($registrationdate,6,2);
		
		
	if((int)$mymonth==1)
	{
$myconvmonth = "January";
	}
	elseif((int)$mymonth==2)
	{
$myconvmonth = "February";
	}
	elseif((int)$mymonth==3)
	{
$myconvmonth = "March";
	}
	elseif((int)$mymonth==4)
	{
$myconvmonth = "April";
	}
	elseif((int)$mymonth==5)
	{
$myconvmonth = "May";
	}
	elseif((int)$mymonth==6)
	{
$myconvmonth = "June";
	}
	elseif((int)$mymonth==7)
	{
$myconvmonth = "July";
	}
	elseif((int)$mymonth==8)
	{
$myconvmonth = "August";
	}
	elseif((int)$mymonth==9)
	{
$myconvmonth = "September";	
	}
	elseif((int)$mymonth==10)
	{
$myconvmonth = "October";	
	}
	elseif((int)$mymonth==11)
	{
$myconvmonth = "November";
	}
	elseif((int)$mymonth==12)
	{
$myconvmonth = "December";	
	}
		
		
	$mycompletedate = $myconvmonth. ' ' . $myday . ', ' . $myyear; 
	return $mycompletedate; 
	
	} 
} 


function loadtextreturn($selecttable, $itemtoshow, $sqlstat)
{	
		include 'dbconfig.php'; 

		$query = "Select * from `" .$selecttable. "` ". $sqlstat ;
		$datame = mysqli_query($sqlcon, $query);
		$datereturn = ""; 
		
		if(!mysqli_error($sqlcon))
		{
			if(mysqli_num_rows($datame)!=0)
			{
				while($row = mysqli_fetch_assoc($datame)) 
				{
				$datereturn = $row[$itemtoshow];
				break; 		
				}
			}
			else 
			{
				$datereturn = ""; 
			}
		}
		else 
		{
			$datereturn = mysqli_error($sqlcon) . "SQL: ". $query;
		}
	
		return $datereturn; 
}

function hiring_loaddocid($hiringid)
{
	$docid = loadtextreturn("hiring","docid"," Where `ID` Like  '$hiringid' "); 

	return $docid; 

}

function loadcompletedoctitle($docid)
{
	$doctitle = loadtextreturn("reqdocuments","reqtitle","Where `ID` Like '$docid'"); 

	return $doctitle;

}

function loadcompletereqtitle($recid)
{

	$rectitle = loadtextreturn("requirement","requirementname","Where `ID` Like '$recid'"); 

	return $rectitle; 

}


function loadnumberofdataall($table,$wherestr)
{ 
include 'dbconfig.php'; 

$returnmyno = 0; 
$query1 = "Select * from ".$table ." ".$wherestr;
//echo "LOADTOTAL: " . $query1; 

$datame = mysqli_query($sqlcon, $query1);
	if(!mysqli_error($sqlcon))
	{
		if(mysqli_num_rows($datame)!=0)
		{	
			
		$returnmyno = mysqli_num_rows($datame); 

		}
		else 
		$returnmyno = 0; 

	}
	else
	{
		$returnmyno = mysqli_error($sqlcon);
	}
	return $returnmyno; 
}



function loadcompletetrainingdate($classno)
{
		$fdate =""; 
		$ldate =""; 
		$ftime=""; 
		$ltime=""; 
		include 'dbconfig.php';
		$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth DESC";
		$datame = mysqli_query($sqlcon, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$fdate = $row["datestart"]; 
 			}
		}
	
     	$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth ASC";
		$datame = mysqli_query($sqlcon, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$ldate = $row["datestart"]; 
			$ftime = $row["timestart"];  
			$ltime = $row["timeend"];  
 			}
		}
		
	    return $fdate. " - " . $ldate. "(" .$ftime. "-" .$ltime. ")";
}



function loadcompletecoursecode($classno)
{
		include 'dbconfig.php'; 
		$query = "Select * from availdates Where classno Like '". $classno. "'";
		$datame = mysqli_query($sqlcon, $query);
		$codecomplete = ""; 

		if(!mysqli_error($sqlcon))
		{
			if(mysqli_num_rows($datame)!=0)
			{
				while($row = mysqli_fetch_assoc($datame)) 
				{
				$codecomplete = $row["Codes"]; 
				}
			}
			else 
			{
				$codecomplete = ""; 
			}
		}
		else 
		{
			$codecomplete = "";
		}

	    return $codecomplete;
}

function loadtraineecompletename($username)
{

		include 'dbconfig.php'; 
        $completename= ""; 

     	$query = "Select * from onlinetrainee Where username Like '$username'";
		$datame = mysqli_query($sqlcon, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $completename = $row["completename"]; 
 			}
		}
		
	    return $completename; 
}


function loadhiringdocid($hiringid) 
{
    include 'dbconfig.php'; 
    @$username = $myusername; 
    @$myname = ""; 
    $sqlme = "SELECT * from `hiring` Where `ID` Like '$hiringid'"; 

    $dbt = mysqli_query($sqlcon,$sqlme); 

    if(!mysqli_error($sqlcon))
    {
		if(mysqli_num_rows($dbt)!=0)
		{
			while($rows = mysqli_fetch_assoc($dbt))
			{
				$myname = $rows['docid'];
				return $myname; 
				
			}
		}
		else 
		{
			echo "No records"; 
		}
       
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }

}

function loadhiringname($id)
{

    include 'dbconfig.php'; 
    @$username = $myusername; 
    @$myname = ""; 
    $sqlme = "SELECT * from `hiring` Where `ID` Like '$id'"; 

    $dbt = mysqli_query($sqlcon,$sqlme); 

    if(!mysqli_error($sqlcon))
    {
        while($rows = mysqli_fetch_assoc($dbt))
        {
            $myname = $rows['hiringtitle'];
            return $myname; 
            
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }


}



function loadregistrationdatetoday()
{
	$myyear = date('Y'); 
	$mydate = date('d'); 
	$mymonth = date('m'); 
		
	
	$completeregdate = $myyear. $mymonth. $mydate; 
	
	return $completeregdate; 
}

function loadmysession($email,$hiring,$viewtype)
{
		@$myemail = $email; 
		@$myhiring = $hiring; 
		@$myviewtype = $viewtype; 

		include 'dbconfig.php'; 
     	$query = "Select * from `monitoring_quiz` Where username Like '$myemail' and `hiringid` Like '$myhiring' and `functionid` Like '$myviewtype'";
		$datame = mysqli_query($sqlcon, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
        
			if ($row["session"] == "") 
			{
				$mysession = "1"; 
				updatesession($myemail,$myhiring,$myviewtype,$mysession); 
			}
			else 
			{
				$mysession = $row["session"]; 
			} 
		
            return $mysession; 

 			}
		}
        else 
        {
            echo "SESSION: " . $query;
        }	
}


function updatestatus($email,$hiring,$viewtype,$thevalue)
{
		@$myemail = $email; 
		@$myhiring = $hiring; 
		@$myvalue = $thevalue; 
		@$myviewtype = $viewtype; 
			include "dbconfig.php"; 

		@$mysql = "UPDATE `monitoring_quiz` SET `status`='$myvalue' Where username Like '$myemail' and `hiringid` Like '$myhiring' and `functionid` Like '$myviewtype'"; 
		//echo "UPDATE SESSION SQL: " . $mysql;
		mysqli_query($sqlcon,$mysql); 

		if(!mysqli_error($sqlcon))
		{

		}
		else 
		{
			echo mysqli_error($sqlcon);
		}

}


function loadmytimer($email,$hiring,$viewtype)
{
		@$myemail = $email; 
		@$myhiring = $hiring; 
		@$myviewtype = $viewtype; 

		include 'dbconfig.php'; 
     	$query = "Select * from `monitoring_quiz` Where username Like '$myemail' and `hiringid` Like '$myhiring' and `functionid` Like '$myviewtype'";
		$datame = mysqli_query($sqlcon, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
				
			if ($row["timer"] == "") 
			{
				$mysession = "10:00"; 
				updatetimer($myemail,$myhiring,$myviewtype,$mysession); 
			}
			else 
			{
				$mysession = $row["timer"]; 
			} 
		
            return $mysession; 

 			}
		}
        else 
        {
            echo "timer: " . $query;
        }	
}

function updatetimer($email,$hiring,$viewtype,$thevalue)
{
		@$myemail = $email; 
		@$myhiring = $hiring; 
		@$myvalue = $thevalue; 
		@$myviewtype = $viewtype; 
			include "dbconfig.php"; 

		@$mysql = "UPDATE `monitoring_quiz` SET `timer`='$myvalue' Where username Like '$myemail' and `hiringid` Like '$myhiring' and `functionid` Like '$myviewtype'"; 
		//echo "UPDATE SESSION SQL: " . $mysql;
		
		if(!mysqli_error($sqlcon))
		{
			
		
		}
		else 
		{
			echo mysqli_error($sqlcon);
		}

}

function loaddocname($id)
{

    include 'dbconfig.php'; 
    @$myid = $id; 

    @$mystring = "";
    $sql = "Select * from `requirement` Where ID Like '". $myid ."'";
    $dbt = mysqli_query($sqlcon,$sql); 

        if(!mysqli_error($sqlcon))
        {
          
            if(mysqli_num_rows($dbt)!=0)
            {
                while($rows = mysqli_fetch_assoc($dbt))
                {
                    $mystring = $rows['requirementname'];
                }
                return $mystring; 
            }
            else 
            {
                return $mystring; 
            }
        }
        else 
        {
            echo mysqli_error($sqlcon); 
        }


}



function updatesession($email,$hiring,$viewtype,$thevalue)
{
		@$myemail = $email; 
		@$myhiring = $hiring; 
		@$myvalue = $thevalue; 
		@$myviewtype = $viewtype; 
			include "dbconfig.php"; 

		@$mysql = "UPDATE `monitoring_quiz` SET `session`='$myvalue' Where username Like '$myemail' and `hiringid` Like '$myhiring' and `functionid` Like '$myviewtype'"; 
		//echo "UPDATE SESSION SQL: " . $mysql;
		mysqli_query($sqlcon,$mysql); 

		if(!mysqli_error($sqlcon))
		{

		}
		else 
		{
			echo mysqli_error($sqlcon);
		}

}














?> 


