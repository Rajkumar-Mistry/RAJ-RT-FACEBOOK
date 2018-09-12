<?php
$zip_path = "all/raj.zip";
$zip_name ="raj.zip";
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

?>