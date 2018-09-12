<?php
session_start();

?>

<html lang="en" >
<head>

 <style rel="stylesheet" type="text/css">
.slide
{
  height:50px;
  width:0px auto;
  position:relative;
  top:-8px;
  
} 
</style>

<script>
  
  var time_set;
  function stop()
  {
   
     window.clearInterval(time_set);
  }   
  //start slide show
  function dtime()
  {  
    
    time_set=window.setInterval(displaytime,3000);
      
  }

  var position=0;
  function displaytime()
  {
   
   <?php
      $slider_image=array();
    
      $album_name =$_REQUEST['album_name'];
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
  
  

</script>
 
</head>

<body onload='dtime()'>
<!-- hearder -->
        <form method="GET" >

        <div>
         <?php include 'header.php';?>
         </div></br></br></br>
<!-- hearder -->
<!--*******************-->
        
        
                             
                        
                            <div style=" position: absolute; top: 65px; z-index: 1;left: 25px;">
                            <input class="btn btn-info" type="button" name="START" value="START" onclick=dtime()>
                             <input class="btn btn-info" type="button" name="STOP" value="STOP" onclick=stop() >
                            </div>
<!--******************-->  


 
  <div class="slide">
      <div class="col-sm-12">
              <img id="t1" height="400px" width="1550px" class="img-responsive" style="max-height: 600px;">
      </div>
  </div> 
 

   

</form>
</body>
</html>