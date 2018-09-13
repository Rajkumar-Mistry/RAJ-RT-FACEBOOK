<?php
session_start();
//error_reporting(0);
ob_start();  
ini_set('max_execution_time', 300);
include 'album_nextpage_function.php';

include 'album_zip_create_function.php';



?>

<html lang="en" >
<head>
 
    <!-- ALBUM -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  
    
    <link rel="stylesheet" href="css1/style.css">
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!--model-->
	<link rel="stylesheet" type="text/css" href="css/model.css">
        <script src="js/model.js"></script>
    <!-- ALBUM close -->
	
	
	<title>Facebook Album</title>
</head>

<body>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header" >
      <span class="close" onclick=stop()>&times;</span>
      <P>Modal Header<p>
    </div>
    <div class="modal-body">
       <img id="t1" style="width:100%">
    </div>
    
  </div>

</div>

<!-- The Modal -->


	
<!-- hearder -->
        <form method="GET" >

        <div>
         <?php include 'header.php';?>
         </div>
<!-- hearder -->

<!--*******************-->
        <div style="margin-top:80px"></div>
        <div class="container">
        <div class="row">
                 <div class="col-sm-3" id="name"></div>
                 <div class="col-sm-6" >
                    
                 </div>
                <!--album download link-->
                 <div class="col-sm-3"><a id="link" download><div id="downloadlink"></div></div></a></div>
         </div></div></br>
        <div class="container">
        <div class="well well-lg" style="">
        
                <div class="row">
                             
                            <div class="col-sm-2">
                            <input class="btn btn-info" type="button" name="checked" value="SELECT ALL" onclick=selectAll()>
                            </div>
                            <div class="col-sm-3">
                            <input class="btn btn-info" type="button" name="unchecked" value="UNSELECT ALL" onclick=UnSelectAll() >
                            </div>
                            <div class="col-sm-3">
                                <div class="dropdown"> 
                                    <select  class="btn btn-info " name="image_size">
  								        <option value="0"  selected>LARGE SIZE</option>
  								        <option value="5">MEDIUM SIZE</option>
  								        <option value="7">SMALL SIZE</option>
							        </select>
							     </div>
                            </div>

                            <div class="col-sm-2">
							   <input class="btn btn-warning" type="submit" name="download" value="download">
						
                            </div>


                            <div class="col-sm-2">
							   <input class="btn btn-warning" type="submit" name="google_drive" value="google drive">
						
                            </div>
                </div>
             </div><br/><br/>
          </div>   
<!-- ************************-->
<div id="main" class="container">
		<div id="gallery" class="row">
<?php
    try
    {
          $token=$_SESSION['fb_access_token'];
	
          $url="https://graph.facebook.com/v3.1/me?fields=id%2Cname%2Calbums%7Bcount%2Cname%2Cphotos.limit(100)%7Bimages%7D%7D&access_token=".$token;

           
            $header = array("Content-type: application/json");
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$st = curl_exec($ch);
			$retval = json_decode($st,true);
           
            $_SESSION['User_name']=$retval['name'];
            //user name  javascript call
            $User_name=$_SESSION['User_name'];

            if($_SESSION['User_name']!=NULL)
            {

            	echo "<script type='text/javascript'>login_user('$User_name');</script>";
            }
            

			$total_album=count($retval['albums']['data']);
            
			$All_album_picture_data= array ();
	           
			
            for($albums_index=0;$albums_index<$total_album;$albums_index++)
			{
				$albums_name=$retval['albums']['data'][$albums_index]['name'];
				$total_picture=$retval['albums']['data'][$albums_index]['count'];
			    if($total_picture==0)
			    {
			        continue;
			    }
		    	
			    if($total_picture > 0 && $total_picture < 100)
				{
					//album image add 
					$albums_picture=$retval['albums']['data'][$albums_index]['photos']['data'];
				}
				else
				{
					
				     //album image add  first page
					$albums_picture=$retval['albums']['data'][$albums_index]['photos']['data'];
					//album image add next page
					$albums_next_page_link=$retval['albums']['data'][$albums_index]['photos']['paging']['next'];
					//album image add function call

			         album_page_data($albums_picture,$albums_next_page_link);

				}	

				$All_album_picture_data[$albums_name][] =$albums_picture;
			}
	
	        $_SESSION['All_album_picture_data']= $All_album_picture_data;  

          
		    foreach($All_album_picture_data as $key=>$val)
			{
				
				 $album_vise_data=$val[0];
				 $album_picture_count=count($album_vise_data);
				
				
				echo "<a href='album_open.php?album_name=$key'>";
			   echo "<div class=\"col-md-4 col-sm-6 col-xs-12\">";
				 echo "<div class=\"gallery-item\">";
				echo "<div class=\"album\" style=\"margin-bottom: 25px; font-family:  fantasy;\"><center><span>$key</span></center></div>";
				echo "<div class=\"album\">";
				
				for($index=0;$index<$album_picture_count;$index++)
				{
					 $image_name=$All_album_picture_data[$key][0][0]['images'][0]['source'];
					
					
					echo "<img src=\"$image_name\"  height=\"180px\" wight=\"180px\">";
					
					 
				}
				
			   echo "</div></a>";
               
			  echo "<div class=\"row\" style=\"padding-top: 25px;\">";
			  echo  "<div class=\"panel panel-default\" style=\"width:90%\">";

		 echo "<div class=\"col-md-6 col-sm-6 col-xs-12\">";
                echo "<div  class=\"panel-body\" style=\" font-family:  fantasy;\"><input type='checkbox' class='profile_Albums' name='album_all_pic[]' value=\"$key\">Download</div>";
		echo "</div>";

				 echo "<div class=\"col-md-6 col-sm-6 col-xs-12\">";
                         //echo "<div class=\"panel-body\"> <a href='slide_show.php?album_name=$key'>SLIDE SHOW</a></div>";
			    echo "<div class=\"panel-body\"><a onclick=start();>Open Modal</a></div>";
			    
			   
			 
			
			    
			       
				echo "</div>";

                                 echo "</div>";
				echo "</div>";
			
                 
       			  //*****************
				echo "</div>";
			echo "</div>";
       			
			
    		}	
	
		
            }
            catch(Exception $e)
            {
               header("Location:index.php");  
            }		
					
	
?>
		
</div>
</div>
<div style="margin-top:60px">
         <?php include 'footer.html';?>
         </div>
</form>
</body>

</html>

<?php
if(isset($_GET['google_drive']))
{
		
		//main folder all path
        $main_folder="facebook_".$_SESSION['User_name']."_albums";
        //zip name
	//$zip_name="facebook_".$_SESSION['User_name']."_albums.zip";		
        
        //check zip file already exists then remove
       /* if(file_exists($main_folder.'.zip'))
        {
            unlink($main_folder.'.zip');
        }
        //create main folder with user name
		mkdir($main_folder);
        */ 
        //selected album name
		$select_album = $_GET['album_all_pic'];
		
		//size of image its download
		$size=$_GET['image_size'];
		
	    if((count($select_album)) > 0)	
	    {
		 
		 $_SESSION['main_folder'] = $main_folder;
		 $_SESSION['size_img'] = $size;
		 $_SESSION['select_album_drive']= $select_album;     
		 header("Location:upload_drive.php");
		    
		/*for($index=0;$index<count($select_album);$index++)
		{
			
		    $album_name=$select_album[$index];
		   
			 $all_pic=$All_album_picture_data[$album_name][0];
                         global  $main_folder;
                         global $size;

                         $folder_name=$main_folder."/".$album_name;
                        //sub folder create with album name
			 mkdir($folder_name);

			//call the function 
                         images_data_split($all_pic,$folder_name,$size);
            
		}
      		folder_zip($main_folder);
      		delete_folder($main_folder);*/
	    
	        // header("Location:upload_drive.php");
	    }
	  else
	   {
	     
		   echo "<script type='text/javascript'>show_message_album() ();</script>"; 
	   }
	  
		
}
if(isset($_GET['download']))
{
		
		$main_folder='all/facebook_'.$_SESSION['User_name'].'_albums';
	        $zip_name="facebook_".$_SESSION['User_name']."_albums.zip";	
		
		//file zip check all ready exist then remove
		if(file_exists($main_folder.'.zip'))
        {
            unlink($main_folder.'.zip');
        }
        
        //main directer create
	    mkdir($main_folder);
        
        //seleted album name
		$select_album = $_GET['album_all_pic'];
		
		//size of images selected in dropdown
		$size=$_GET['image_size'];
		
		if((count($select_album)) > 0)
		{
		
		for($index=0;$index<count($select_album);$index++)
		{
			
		    $album_name=$select_album[$index];
		   
			$all_pic=$All_album_picture_data[$album_name][0];
             global  $main_folder;
               global $size;
             $folder_name=$main_folder."/".$album_name;
             
             //sub directery create
			 mkdir($folder_name);

			
            images_data_split($all_pic,$folder_name,$size);
            
		}
         folder_zip($main_folder);
         delete_folder($main_folder);
         zip_download_pc($main_folder,$zip_name);
	
        // call javascript function and show download link
			
        // echo "<script type='text/javascript'>downloadlink('$main_folder');</script>";
			
		}
		else
		{
		    //alert message for select album
		   echo "<script type='text/javascript'>show_message_album() ();</script>"; 
		}
}
	

?>
