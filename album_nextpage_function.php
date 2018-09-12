<?php
    //1st parameter array and second is a next page link
	function album_page_data(&$albums_first_page,$albums_next_page_link)
	{
		 
        $url=$albums_next_page_link;

       
       $header = array("Content-type: application/json");
	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
	   curl_setopt($ch, CURLOPT_URL,$url);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   $st = curl_exec($ch);
	   $retval = json_decode($st,true);
           
       $total_next_page_image=count($retval['data']);
       
        //next page data add in array
       for($i=0;$i<$total_next_page_image;$i++)
       {
          
       	   array_push($albums_first_page,$retval['data'][$i]);
       }
       //stop condiction
        if($retval['paging']['next'] == NULL)
        {
            
        	return;
        }
        else
        {
             //recursion
              $next=$retval['paging']['next'];
              album_page_data($albums_first_page,$next);
        }
      
     
           
	  
	   

	}







?>
