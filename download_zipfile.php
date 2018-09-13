<?php
session_start();
ob_start();

	
$zip_path = 'all/facebook_'.$_SESSION['User_name'].'_albums';
if(file_exists($zip_path))
{
echo $zip_path;	
$zip_name ="facebook_".$_SESSION['User_name']."_albums.zip";
header( "Pragma: public" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "Cache-Control: public" );
header( "Content-Description: File Transfer" );
header( "Content-type: application/zip" );
header( "Content-Disposition: attachment; filename=\"" . $zip_name . "\"" );
header( "Content-Transfer-Encoding: binary" );
header( "Content-Length: " . filesize( $zip_path ) );
readfile( $zip_path );
}
else
{
	echo "not a file ";
}
?>
