
<html lang="en">
<head>
   
    <title></title>

    <!-- Bootstrap -->

    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/product.css">

    <!-- ALBUM -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> 
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>  
    
    <link rel="stylesheet" href="css1/style.css">
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    
  
     <script  src='js/select_unselect.js'></script>
   
    
       
</head>
<body>
    

        <nav role="navigation" class="navbar navbar-default navbar-fixed-top" style="background-color: black; margin-bottom: 0px;">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand" style="font-size: 30px; color: white; font-stretch: wider; font-weight: 600;">FACEBOOK ALBUM</a>
                </div>

                <div id="navbarCollapse" class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                     
                        
                        <?php
                         if($_SESSION['fb_access_token']!=NULL)
                         {
                             
                           
                           echo "<li><a href=\"album.php\">Album</a></li>";
                           echo "<li><a href=\"logout.php\" class=\"user\"> <img src=\"Images/one.png\" alt=\"My Image\" height=\"20px\" width=\"20px\"> Log out</a></li>";
                         }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
            
       
</body>

</html>


