<?php
ob_start();  
session_start();
error_reporting(0);
include 'download_function.php';
?>
<html>
<head>
 <meta charset="UTF-8">
  <title>ALBUM OPEN</title>
  
  
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>
  <link rel="stylesheet" href='css/xyz.css'>
  
 
  
    

</head>
<body>
  <form action="#" method="POST">

    <div>
        <!-- start Header -->
        
            <?php include 'header.php';?>
           
        <!-- End Header -->
  </div></br></br></br>
    <!--*******************-->
      
       <div class="container">
            
        <div class="well well-lg">
        
                <div class="row">
                             
                            <div class="col-sm-4">
                            <input class="btn btn-info" type="button" name="checked" value="SELECT ALL" onclick=selectAll_single_image()>
                            </div>
                            <div class="col-sm-4">
                            <input class="btn btn-info" type="button" name="unchecked" value="UNSELECT ALL" onclick=UnSelectAll_single_image()>
                            </div>
                            <div class="col-sm-4">
                               <input class="btn btn-warning" type="submit" name="submit" value="download">
                           </div>
                           
                           
                </div>
             </div>
          </div>   
 <!--***************************-->
 <!--*************ALBUM NAME************-->
          <div class="container">
        
        
                <div class="row">
                             
                            <div class="col-sm-12">
                               
                                   <h3 style="font-size: 30px; color:black; font-stretch: wider; font-weight: 600; font-style: italic">
                                    <center><?php echo $_REQUEST['album_name']; ?></center></h3>
                                
                            </div>
                            
                </div>
             </div>
           

<!-- ************************-->
  
    <?php

   
    //selected album name
    $album_name =$_REQUEST['album_name'];
    
    //selected album data add in array
    $All_album_picture_data=array();
    
    $All_album_picture_data=$_SESSION['All_album_picture_data'];
   
      //album images all size
      $seleted_album=$All_album_picture_data[$album_name][0];

   
       echo "<div class=\"container\">";
       echo "<div class=\"row\">";
  
    
    for ($i=0;$i<count($seleted_album);$i++)
    {
        //large size image select in this array
        $img_name=$seleted_album[$i]['images'][2]['source'];
        
        echo "<div class=\"col-md-3 col-sm-6 col-xs-12\">";
       
        echo "<label class=\"image-checkbox\" >";

		echo "<img src=\"$img_name\" style=\"width:200px;height: 200px;\">";
			echo "<input type=\"checkbox\" name=\"Albums_images[]\" value=\"$img_name\" class=\"album\">";
      
         echo "</label>";
      
        echo "</div>";
       
    }
	 echo "</div";
    echo "</div>";
    ?>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
  <script  src="js/index.js"></script>
  <script  src='js/select_unselect.js'></script>

    </form>

   
</body>
</html>
<?php
    
  

  if(isset($_REQUEST['submit']))
  {
     
      //selected images 
      $select_images=$_REQUEST['Albums_images'];
      if(count($select_images) > 0)
      {
          
     
      $only_name=array();
      $download_file=array();
      
      //selected images split in to 40 size 
      $select_images_split=array();
      $select_images_split=array_chunk($select_images,40, true);
      

      for($index=0;$index<count($select_images_split);$index++)
      {
         global $select_images_split;
         //set images into arrray 40 next time next 40 continue...
         zip_data_set($select_images_split[$index]);
        
         
      } 
       //download zip
       zip_folder($only_name,$download_file);
      }
      else
       {
            //alert message for select images and click download
          	echo "<script type='text/javascript'>show_message();</script>";
       
       }
         
  
 
    
   }
    
             
               

?>