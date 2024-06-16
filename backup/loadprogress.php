<?php 

function showprogress()
{
    include 'dbconfig.php'; 
    @$username = $_COOKIE['usname']; 
    @$count = 0; 
    @$total = 0; 
    $sqlme = "Select * from `applicantinfo` Where `username` Like '$username'"; 

    $dbt = mysqli_query($sqlcon,$sqlme); 


    if(!mysqli_error($sqlcon))
    {
        while($rows = mysqli_fetch_assoc($dbt))
        {
            $total +=1; 
            if($rows['firstname']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['middlename']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['lastname']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['birthdate']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['birthplace']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['currentrank']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['address']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['contactnumber']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['nationality']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['citizenship']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['religion']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['haircolor']!="")
            {
                $count +=1;
            }
            
            $total +=1; 
            if($rows['eyecolor']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['sss']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['philhealth']!="")
            {
                $count +=1;
            }


            $total +=1; 
            if($rows['tin']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['pagibig']!="")
            {
                $count +=1;
            }

            
            $total +=1; 
            if($rows['email']!="")
            {
                $count +=1;
            }

                     
            $total +=1; 
            if($rows['highesteducation']!="")
            {
                $count +=1;
            }

                             
            $total +=1; 
            if($rows['coursedegree']!="")
            {
                $count +=1;
            }

                                   
            $total +=1; 
            if($rows['yearstarted']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['schoolattended']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['yearcompleted']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['wifecompletename']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['childrens']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['fathername']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['mothername']!="")
            {
                $count +=1;
            }
        }
    }
    else
    {
        echo mysqli_error($sqlcon); 
    }
    @$average =  ($count / $total) * 100; 
    @$averound = round($average); 

    @$statusbar = ""; 
    @$statusstyle = ""; 
   // $averound = 80; 
    if($averound>=0&&$averound<=20)
    {   $statusbar = "Poor";
        $statusstyle = "bg-danger"; 
    }
    else if ($averound>=21&&$averound<=40)
    {
        $statusbar = "Good";
        $statusstyle = "bg-warning"; 
    }
    else if ($averound>=41&&$averound<=60)
    {
        $statusbar = "Very Good";
        $statusstyle = "bg-info"; 
    }
    else if ($averound>=61&&$averound<=100)
    {
        $statusbar = "Satisfactory";
        $statusstyle = "bg-success"; 
    }
    echo "<div><p>Completion: $statusbar</p></div>";
    echo "<div class='progress'>
        <div class='progress-bar progress-bar-striped progress-bar-animated $statusstyle' role='progressbar' style='width: $averound%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$averound%</div>
    </div>";

}


function averageprogress()
{
    include 'dbconfig.php'; 
    @$username = $_COOKIE['usname']; 
    @$count = 0; 
    @$total = 0; 
    $sqlme = "Select * from `applicantinfo` Where `username` Like '$username'"; 

    $dbt = mysqli_query($sqlcon,$sqlme); 


    if(!mysqli_error($sqlcon))
    {
        while($rows = mysqli_fetch_assoc($dbt))
        {
            $total +=1; 
            if($rows['firstname']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['middlename']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['lastname']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['birthdate']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['birthplace']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['currentrank']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['address']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['contactnumber']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['nationality']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['citizenship']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['religion']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['haircolor']!="")
            {
                $count +=1;
            }
            
            $total +=1; 
            if($rows['eyecolor']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['sss']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['philhealth']!="")
            {
                $count +=1;
            }


            $total +=1; 
            if($rows['tin']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['pagibig']!="")
            {
                $count +=1;
            }

            
            $total +=1; 
            if($rows['email']!="")
            {
                $count +=1;
            }

                     
            $total +=1; 
            if($rows['highesteducation']!="")
            {
                $count +=1;
            }

                             
            $total +=1; 
            if($rows['coursedegree']!="")
            {
                $count +=1;
            }

                                   
            $total +=1; 
            if($rows['yearstarted']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['schoolattended']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['yearcompleted']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['wifecompletename']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['childrens']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['fathername']!="")
            {
                $count +=1;
            }

            $total +=1; 
            if($rows['mothername']!="")
            {
                $count +=1;
            }
        }
    }
    else
    {
        echo mysqli_error($sqlcon); 
    }
    @$average =  ($count / $total) * 100; 
    @$averound = round($average); 

    return $averound; 

}




?> 
