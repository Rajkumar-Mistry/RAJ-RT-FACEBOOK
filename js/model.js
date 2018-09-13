var time_set;
function start()
{
alert("raj");	
 var modal = document.getElementById('myModal');
  modal.style.display = "block";
  dtime();
}
function stop()
{
   var modal = document.getElementById('myModal');
   modal.style.display = "none";
   window.clearInterval(time_set);	
}

  
		
  function dtime()
  {
	//time_set=window.setInterval("displaytime()",3000);
  }
  
 
var position=0;
  function displaytime(album_name_slide)
  {
   
   <?php
      $slider_image=array();
    
      $album_name ='album_name_slide';
      $All_album_picture_data=array();

   //seleted album data
    $All_album_picture_data=$_SESSION['All_album_picture_data'];
   
  
   $seleted_album=$All_album_picture_data[$album_name][0];
      
   
       
    
   for ($index=0;$index<count($seleted_album);$index++)
    {   
         global $slider_image;
        //image url add in array
        $img_name=$seleted_album[$index]['images'][0]['source'];
        array_push($slider_image,$img_name);
    }  
     
      
    ?>
    //image url data array add in javascript variable
    var image_url = <?php echo json_encode($slider_image); ?>;
    
    if(position==image_url.length)
    {
      position=0;
    }
    //set the source of image tag
     document.getElementById("t1").src =image_url[position];
  	  
     position++;
  
  }
  

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
