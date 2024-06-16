<?php 



function rankcmb() 
{
    include "dbconfig.php"; 
    
    $sql = "Select * from `rank` ORDER BY rankname ASC"; 
    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<option selected value="0">--Select Rank--</option>';
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$id = $rows['ID']; 
                @$name = $rows['rankname'];

                echo "<option value='$id'>$name</option>"; 
    
            }
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }

}

function rankcmbset($idrank) 
{
    include "dbconfig.php"; 
    
    $sql = "Select * from `rank` ORDER BY rankname ASC"; 
    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<option selected value="0">--Select Rank--</option>';
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$id = $rows['ID']; 
                @$name = $rows['rankname'];
                if($idrank==$id)
                {
                    echo "<option value='$id' selected>$name</option>"; 
                }
                else 
                {
                    echo "<option value='$id'>$name</option>"; 
                }
             
    
            }
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }

}





function quizmanagementcmb() 
{
    include "dbconfig.php"; 
    
    $sql = "Select * from `quizmanagement` ORDER BY quiztitle ASC"; 
    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<option selected value="0">--Select Quiz Title--</option>';
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$id = $rows['ID']; 
                @$name = $rows['quiztitle'];

                echo "<option value='$id'>$name</option>"; 
      
            }
        }
        else 
        {
            echo '<option selected value="0">--Select Quiz Title--</option>';
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }
}




function vesselcmb() 
{
    include "dbconfig.php"; 
    
    $sql = "Select * from `vessel` ORDER BY vesselname ASC"; 
    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<option selected value="0">--Select Vessel--</option>';
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$id = $rows['ID']; 
                @$name = $rows['vesselname'];
                echo "<option value='$id'>$name</option>"; 
    
            }
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }
}



function loadhiringcmb()
{
    include "dbconfig.php"; 
    @$myusername = $_COOKIE['usname']; 
   
    @$sqlme = "Select * from `monitoring` Where `username` Like '$myusername' and `stage` Like '2'"; 

    @$dbt = mysqli_query($sqlcon,$sqlme); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<option selected value="0">--Select Application--</option>';
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$hiringid = $rows['hiringid']; 
                @$hiringname = loadhiringname($hiringid); 

                echo "<option value='$hiringid'>$hiringname</option>";
    
            }
        }
        else 
        {
            echo '<option value="0">--No Application--</option>';
        }
      
    }
    else 
    {
        echo mysqli_error($sqlcon);

    }




}



function documentcmb() 
{
    include "dbconfig.php"; 
    @$myusername = $_COOKIE['usname']; 
    @$numberofhiring = loadnumberofdataall("monitoring","Where `username` Like '$myusername'"); 
   // echo $numberofhiring; 
   
    if ($numberofhiring==0)
    {
        $sql = "Select * from `requirement` ORDER BY requirementname ASC"; 

        @$hiringid = loadtextreturn("monitoring","docid","Where username Like '$myusername' ORDER BY ID DESC"); 
        $sql = "Select * from `reqlist` ORDER BY requirementname ASC"; 

        $dbt = mysqli_query($sqlcon,$sql); 

        if(!mysqli_error($sqlcon))
        {
            if(mysqli_num_rows($dbt)!=0)
            {
                echo '<option selected value="0">--Select Document--</option>';
                while($rows = mysqli_fetch_assoc($dbt))
                {
                    if($rows['foradmin']!='admin')
                    {
                        @$id = $rows['ID']; 
                        @$name = $rows['requirementname'];
                        echo "<option value='$id'>$name</option>"; 
            
                    }
                
                }
            }
            else 
            {
                echo '<option selected value="0">--No Record Available--</option>';
            }
        }
        else 
        {
            echo mysqli_error($sqlcon); 
        }

    }
    else 
    {
        @$docid = loadtextreturn("monitoring","docid","Where username Like '$myusername' ORDER BY ID DESC"); 
        $sql = "Select * from `reqlist` Where `reqid` Like '$docid' ORDER BY ID ASC"; 

        $dbt = mysqli_query($sqlcon,$sql); 

        if(!mysqli_error($sqlcon))
        {
            if(mysqli_num_rows($dbt)!=0)
            {
                echo '<option selected value="0">--Select Document--</option>';
                while($rows = mysqli_fetch_assoc($dbt))
                {
                    if($rows['foradmin']!='admin')
                    {
                        @$id = $rows['doclistid']; 
                        @$name = loaddocname($id);
                       
                        echo "<option value='$id'>$name</option>"; 
            
                    }
                
                }
            }
            else 
            {
                echo '<option selected value="0">--No Record Available--</option>';
            }
        }
        else 
        {
         //   echo mysqli_error($sqlcon); 

            echo '<option selected value="0">--'. mysqli_error($sqlcon). '--</option>';
        }
    }
}

function documentscmball()
{

    include 'dbconfig.php'; 
    @$myid = $id; 

    @$mystring = "";
    $sql = "Select * from `requirement` ORDER BY requirementname ASC";
    $dbt = mysqli_query($sqlcon,$sql); 

        if(!mysqli_error($sqlcon))
        {
          
            if(mysqli_num_rows($dbt)!=0)
            {
                echo '<option selected value="0">--Select Document--</option>';
                while($rows = mysqli_fetch_assoc($dbt))
                {
                    
                    @$id = $rows['ID']; 
                    @$name = $rows['requirementname'];
                   
                    echo "<option value='$id'>$name</option>"; 

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

function requirementcmb() 
{
    include "dbconfig.php"; 
    
    $sql = "Select * from `reqdocuments` ORDER BY reqtitle ASC"; 
    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<option selected value="0">--Select Document--</option>';
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$id = $rows['ID']; 
                @$name = $rows['reqtitle'];
                echo "<option value='$id'>$name</option>"; 
    
            }
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }


}

function functioncmb() 
{
    include "dbconfig.php"; 
    
    $sql = "Select * from `function` ORDER BY ID ASC"; 
    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<option selected value="0">--Select Examination--</option>';
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$id = $rows['ID']; 
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
                @$complete = $conv . " F". $rows['Function']. ": ". $function; 

                echo "<option value='$id'>$complete</option>"; 
    
            }
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }


}









?> 





