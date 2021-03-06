<?php
session_start();

require_once 'google/vendor/autoload.php';
//ini_set('max_execution_time', 300);
//ini_set('max_execution_time', 300);

	
$client = new Google_Client();
$client->setAuthConfigFile('api.json');
$client->setRedirectUri("https://rajmistry.herokuapp.com/upload_drive.php");
$client->addScope(Google_Service_Drive::DRIVE);

if (! isset($_GET['code'])) 
{
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} 
else 
{
    $client->authenticate($_GET['code']);
    $_SESSION['access_token_google'] = $client->getAccessToken();
	
	 $client->setAccessToken($_SESSION['access_token_google']);
	 $drive = new Google_Service_Drive($client);
	 //album data retrive
	          $main_folder_name =$_SESSION['main_folder'] ;
		  $size_img = $_SESSION['size_img'];
		  $select_album_drive=$_SESSION['select_album_drive']; 
	         	 
	//***********************
	
	 //main folder create
	$fileMetadata = new Google_Service_Drive_DriveFile(array(
        'name' =>  $main_folder_name,
        'mimeType' => 'application/vnd.google-apps.folder'));
          $file = $drive->files->create($fileMetadata, array('fields' => 'id'));
          $folderId = $file->id;
	
	    try
	    {		    
	      for($index=0;$index<count($select_album_drive);$index++)
	     { 
		       $album_name= $select_album_drive[$index];
		      
		        $All_album_picture_data_drive =$_SESSION['All_album_picture_data'];
		        $all_pic=$All_album_picture_data_drive[$album_name][0];
		        
		      //image_url + ? + id 
                       $image_url_id_drive=array();

                        for($index=0;$index<count($all_pic);$index++)
                        {
			   
     	                   array_push($image_url_id_drive,$all_pic[$index]['images'][$size_img]['source']);
        
                         }
                        
                               moveToDrive($image_url_id_drive,$album_name,$folderId,$drive);
                               header("Location:drive.php");
		       
             }
	    }
	    catch(Exception $e) 
	    {
		  header("Location:drive.php");   
	    }
   
   
}




//********
	    
//********************	
function moveToDrive($image_url_id_drive,$album_id,$folderId,$drive)
{
	//$img=array("https://scontent.xx.fbcdn.net/v/t1.0-9/39760439_859661354230615_8995455293735305216_o.jpg?_nc_cat=0&oh=c1fe7ab85e829a26f1472d22138dc019&oe=5BEE1000", "https://scontent.xx.fbcdn.net/v/t1.0-0/p75x225/39799614_859661517563932_7874550640016359424_n.jpg?_nc_cat=0&oh=5a886fffc5164bf264fdc26a472d5aea&oe=5C33F5D5", "https://scontent.xx.fbcdn.net/v/t1.0-9/39917099_861599617370122_1588937861418188800_o.jpg?_nc_cat=0&oh=b8c60db2df8bb2278e709fef960e8ac6&oe=5C266E8B","https://scontent.xx.fbcdn.net/v/t1.0-0/p75x225/39944419_859661610897256_1205816779931123712_n.jpg?_nc_cat=0&oh=b828a9f10e9bd7ccc436af0a38afb1bd&oe=5C2CF670");
	
    $fileMetadata1 = new Google_Service_Drive_DriveFile(array(
        'name' => $album_id,
        'mimeType' => 'application/vnd.google-apps.folder',
        'parents' => array($folderId)
    ));
	
    $file = $drive->files->create($fileMetadata1, array('fields' => 'id'));
    $album_folder = $file->id;
	
	for($i=0;$i<count($image_url_id_drive);$i++)
	{
		$fileMetadata2 = new Google_Service_Drive_DriveFile(array(
                'name' => $i.'.jpg',
                'parents' => array($album_folder)
            ));
            $imgname=$image_url_id_drive[$i];
		
            $content = file_get_contents($imgname);
		
            $file = $drive->files->create($fileMetadata2, array(
                'data' => $content,
                'mimeType' => 'image/jpeg',
                'uploadType' => 'multipart',
                'fields' => 'id'));
	}
    
    
}


?>

