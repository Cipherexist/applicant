

function getexpiration(mydate)
{
    let givenDate1 =   new Date(mydate)  // Past Date
  
    let diff = new Date().getTime() - givenDate1.getTime();
    if (diff > 0) {
        return true; 
     }
}
