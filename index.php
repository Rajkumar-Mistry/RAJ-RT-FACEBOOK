<?php
  session_start();
  //spl_autoload_register();
  require_once("Facebook/autoload.php");
  
include 'facebook_app.php';



     $helper = $fb->getRedirectLoginHelper();

     $permissions = ['user_photos']; // Optional permissions
     $loginUrl = $helper->getLoginUrl('https://rajmistry.herokuapp.com/callback.php',$permissions);
     
    
?>

<html lang="en">
    <head>
        <title>FaceBook Gallery</title>
          <link href="css/bootstrap.css" rel="stylesheet">
          <link rel="stylesheet" href="css/product.css">

    </head>

    <body>
          
       <!-- ****************-->
        <div>
          <?php include 'header.php';?>
         </div>  
           
           <div class="carousel-inner">
                         <div class="active item" style="background-image: url('Images/slide1.jpg')">
                            <div class="carousel-caption">
                                <div class="wow slideInRight center-image">
                              <a href=<?php echo $loginUrl ?>>
                                  <img src="Images/two.png" alt="Smiley face" class="img img-responsive" 
                                  style="margin-left:auto"></a>

                                </div>
                                <div class="wow slideInLeft">
                                    <h2>Welcome To Facebook Album Downlod </h2>
                                </div>
                            </div>
                        </div>
          </div>  
         

      <div>
            <?php include 'footer.html';?>
       </div>

    </body>
</html>
