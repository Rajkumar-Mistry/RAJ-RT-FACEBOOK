<?php
ob_start();
session_start();
require_once("Facebook/autoload.php");
include("facebook_app.php");

	$helper = $fb->getRedirectLoginHelper();

	try 
	{
		$accessToken = $helper->getAccessToken();
	} 
	catch(Facebook\Exceptions\FacebookResponseException $e) 
	{
		header("Location:index.php");
		exit;
	}
	catch(Facebook\Exceptions\FacebookSDKException $e)
	{
	    header("Location:index.php");
		exit;
	}







if (! $accessToken->isLongLived()) 
{
  // Exchanges a short-lived access token for a long-lived one
  try 
  {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } 
  catch (Facebook\Exceptions\FacebookSDKException $e) 
  {
     header("Location:index.php");
   
  }

 
}
//access token store in session
 $_SESSION['fb_access_token'] = (string) $accessToken;
 
 header("Location:album.php");
?>
