<?php

$main_folder="all/facebook_".$_SESSION['User_name']."_albums";
$zip_name="facebook_".$_SESSION['User_name']."_albums.zip";		
        
 session_start();
include_once 'gmail/src/Google_Client.php';
include_once 'gmail/src/contrib/Google_Oauth2Service.php';
require_once 'gmail/src/contrib/Google_DriveService.php';
//client id and secret key
$client = new Google_Client();
$client->setClientId('871462948008-5s5d4p10ku1anlssdk12ei8esgchk8lk.apps.googleusercontent.com');
$client->setClientSecret('jrtmJC7pOHsHXuH30b-LHofW');
$client->setRedirectUri('https://rajmistry.herokuapp.com/upload.php');
$client->setScopes(array('https://www.googleapis.com/auth/drive.file'));


if (isset($_GET['code']) || (isset($_SESSION['access_token'])))
{
    
    
    $service = new Google_DriveService($client);
    if (isset($_GET['code'])) 
    {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();      
    } 
    else
    {
        $client->setAccessToken($_SESSION['access_token']);
    }
    
    //Insert a file
    $fileName=$zip_name;
    $file = new Google_DriveFile();
    $file->setTitle($fileName);
    $file->setMimeType('application/zip');
    $file->setDescription('A User Details is uploading in json format');
  
   
    $createdFile = $service->files->insert($file, array(
          'data' =>file_get_contents($main_folder.'.zip'),
          'mimeType' => 'application/zip',
          'uploadType'=>'multipart'
        ));
    
    
    unlink('all/'.$fileName);
    header('Location:drive.php');
    


} 
else 
{
    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit();
}


?>
