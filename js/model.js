function start()
{
 var modal = document.getElementById('myModal');
  modal.style.display = "block";
  dtime();
}
function stop()
{
   var modal = document.getElementById('myModal');
   modal.style.display = "none";
}

  t=21;
		
  function dtime()
  {
	window.setInterval("displaytime()",3000);
  }
  
  function displaytime()
  {
	if(t>23)
	{
		t=21;
	}
	document.getElementById("t1").src = t + ".jpg";
	t=t+1;  
  }


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
