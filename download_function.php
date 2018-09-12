<?php
// 5 minit to execute browser
 ini_set('max_execution_time', 300);
 error_reporting(0);
 
 //set the image and image name
function zip_data_set($image_data)
{
			
				 global $only_name;
				 global $download_file;

             foreach($image_data as $file)
              {

				  
				    $download_file[] = file_get_contents($file);
					 $f_name=explode ("?",$file);
				     $only_name[]=$f_name[0];
			   }
				
}


//image name and image add in zip
function zip_folder($name,$file)
{
  global $album_name;
  $zip = new ZipArchive();

//create a temp file & open it
$tmp_file = tempnam('.','');
$zip->open($tmp_file, ZipArchive::CREATE);

//loop through each file 
    for($index=0;$index<count($name);$index++)
    {
       $zip->addFromString(basename($name[$index]),$file[$index]);
    }
   
    

// close zip
$zip->close();

// send the file to the browser as a download
header('Content-disposition: attachment; filename='.$album_name.'.zip');
header('Content-type: application/zip');
ob_clean();
flush();
readfile($tmp_file);
unlink($tmp_file);

}

?>