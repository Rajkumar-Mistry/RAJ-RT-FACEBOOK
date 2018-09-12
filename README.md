# RAJ-RT-FACEBOOK



# FACEBOOK ALBUM
1. user login through facebook , where it will ask for authentication and providing  profile_photo and it will   redirect you to the callback page of the website with succesfull login.
2. Now your whole album list will come in the website like cover album , profile pictures and mobile uploads
just click on the album and you will get a slide show of of your pictures .

## Features 
* All album download in zip file folder vise (LARGE SIZE IMAGE, MEDIAM SIZE IMAGE, SMALL SIZE IMAGE)
* selected album download in zip file folder vise (LARGE SIZE IMAGE, MEDIAM SIZE IMAGE, SMALL SIZE IMAGE)
* All album move in google drive(ZIP file)
* Selected album move in google drive(ZIP file)
* Open a album and select images download in zip file
* Album slide show



### Language
   CORE PHP
   
### Install
    XAMPP
    https://www.apachefriends.org/download.html
  
## Third Party Library
* Facebook sdk
* Google drive api
* Bootstrap


# HOW-TO-USED CODE
Getting Started First, You need to add your own facebook developer configurations (app id, app secret, redirect URL) in facebook_app.php.

        $fb = new Facebook\Facebook([
	  
	   'app_id' => 'YOUR APP ID',
	   
	   'app_secret' => 'YOUR SECRET KEY',
	   
	   'default_graph_version' => 'VERSION',
	  
	    ]);
     
Then You need to add your own google developer configurations (id, secret,redirect url) in upload.php.

	$client = new Google_Client();
	$client->setClientId('YOUR CLIENT-ID');
	$client->setClientSecret('YOURSECRET KEY');
	$client->setRedirectUri('YOUR REDIRECT URL');


you need to add Facebook and Google drive library into facebook and gmail folder.

FACEBOOK API : Used Facebook Graph API Facebook Graph API is used to authenticated user. for this api you need facebook-php-sdk.
https://github.com/facebook/php-graph-sdk

Google Drive API : Used to access google drive and manage folders and files of authenticated used. for this api you need google-client or say google-php-sdk to communicate with google.

Curl :Used to retrive the facebook album data.Curl configuration in Album.php.
* me?fields=id,name,albums{count,name,photos.limit(100){images}} + ACCESS TOKEN
https://developers.facebook.com/tools/explorer/


#### Notice
* Third party library install via composer but you can host a site in www.000webhost.com can not install composer because they are face the fatal error.

