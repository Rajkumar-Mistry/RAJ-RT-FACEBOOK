<?php
//all function to album.php file

//image split and set data
function images_data_split($all_pic,$folder_name,$size)
{
	 
     //image_url + ? + id 
     $image_url_id=array();

     for($index=0;$index<count($all_pic);$index++)
     {
     	
          array_push($image_url_id,$all_pic[$index]['images'][$size]['source']);
        
     }
     //split the array in 40 size	
      $select_images_split=array();
      $select_images_split=array_chunk($image_url_id,40, true);
       
      
       for($index1=0;$index1<count($select_images_split);$index1++)
       {  
      	 global $folder_name;
      	 //images add in folder
      	 images_add_folder($select_images_split[$index1],$folder_name);
      	
      	 
       } 			
     
     
}
//get the image data add in folder
function images_add_folder($image_data_url,$folder_name)
{
	    
	
	          foreach($image_data_url as $file)
              {
                    //get image contents
                     $image = file_get_contents($file);
					 $f_name=explode ("?",$file);
				     $image_url=explode('/',$f_name[0]);
                     $only_name=$image_url[count($image_url)-1];
                     //put image contents
                     file_put_contents($folder_name."/".$only_name, $image);
			   }
}
//zip create after main(facebook_username_albums)folder delete
function delete_folder($main_folder)
{
    
	$dir = $main_folder;
 	chmod($dir, 0755);
 	$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
 	$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
 	foreach ( $ri as $file ) 
 	{
    	 $file->isDir() ?  rmdir($file) : unlink($file);
 	}
 	rmdir($dir);

}
//main folder add in zip
function folder_zip($main_folder)
{
	
	$rootPath = realpath($main_folder);
	
	$zip = new ZipArchive();
    $zip->open($rootPath.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

   $files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();

}
function zip_download_pc($main_folder,$zipname)
{
$url = $main_folder.'.zip';
if(file_exists($url))
{
  echo '<script language="javascript">';
  echo 'alert(message successfully sent)';  //not showing an alert box.
  echo '</script>';
  exit;
}	
$file = basename($url);
 
$fp = fopen($file, 'w');
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FILE, $fp);
 
$data = curl_exec($ch);
 
curl_close($ch);
fclose($fp);
 
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file);
//unlink('https://rajmistry.000webhostapp.com/56.zip');
exit;

}
	


?>
