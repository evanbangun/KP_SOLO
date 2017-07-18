<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIOS Video</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&amp;subset=latin-ext" rel="stylesheet">
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header class="site-header">
        
        <nav class="navbar navbar-default" style="background-color:#404040">
			<div class="container">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<i class="fa fa-bars"></i>
				</button>
				<a href="index.php" class="navbar-brand">
					<img style="margin-bottom:10px; margin-top:10px" src="img/logo.png" alt="Post">
				</a>
                <div class="box1">
                  <p style="padding-top:35px; font-size:35px;"><b>Library Integrated Online Services (LIOS) Video</b></p>
                </div>
                <div class="collapse navbar-collapse" id="bs-navbar-collapse"> </div><!-- /.navbar-collapse -->                
				<!-- END MAIN NAVIGATION -->
			</div>
		</nav>        
    </header>
    <div class="bread_area" style="background-color:#e6e6e6; margin-bottom:20px;"> </div>   
    <main class="site-main category-main">
        <div class="container">
            <div class="row">
            	<h2 class="category-title">Daftar Kategori</h2>
                <kategori1>
                	<ul>
                    	<?php
                                $query = "select * from kategori where nama_k != 'Lainnya' order by nama_k";
                                $result = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($result))
                                {
                            ?>
                            <li><a href="kategori.php?idk=<?php echo $row['id_k'] ?>" title=""><?php echo $row['nama_k']; ?></a></li>
                            <?php } ?>
                            <?php
                                $query = "select * from kategori where nama_k = 'Lainnya'";
                                $result = mysqli_query($con, $query);
                                $row = mysqli_fetch_assoc($result)
                            ?>
                            <li><a href="kategori.php?idk=<?php echo $row['id_k'] ?>" title=""><?php echo $row['nama_k']; ?></a></li>
                    </ul>
                </kategori1>
                
                
                
            </div>
        </div>
    </main>
    <footer class="site-footer">
        <div class="container">
        
        <!--
            <div class="row">
                <div class="col-md-3 col-sm-6 fbox">
                    <h4>COMPANY NAME</h4>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue lectus diam, sit amet cursus massa efficitur sed. </p>
                    <ul class="list-inline">
                        <li><a href="#" title="Post"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" title="Post"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" title="Post"><i class="fa fa-linkedin"></i></a></li>                        
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 fbox">
                    <h4>SERVICES</h4>
                    <ul class="big">
                        <li><a href="#" title="">Title One</a></li>
                        <li><a href="#" title="">Title Two</a></li>
                        <li><a href="#" title="">Title Three</a></li>
                        <li><a href="#" title="">Title Four</a></li>
                        <li><a href="#" title="">Title Five</a></li>
                        <li><a href="#" title="">Title Six</a></li>
                        <li><a href="#" title="">Title Seven</a></li>
                        <li><a href="#" title="">Title Eight</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 fbox">
                    <h4>CONTENT</h4>
                    <ul class="big">
                        <li><a href="#" title="">Title One</a></li>
                        <li><a href="#" title="">Title Two</a></li>
                        <li><a href="#" title="">Title Three</a></li>
                        <li><a href="#" title="">Title Four</a></li>
                        <li><a href="#" title="">Title Five</a></li>
                        <li><a href="#" title="">Title Six</a></li>
                        <li><a href="#" title="">Title Seven</a></li>
                        <li><a href="#" title="">Title Eight</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 fbox">
                    <h4>CONTENT</h4>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p><a href="tel:+902222222222"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> +90 222 222 22 22</a></p>
                    <p><a href="mailto:iletisim@agrisosgb.com"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> mail@awebsitename.com</a></p>
                </div>
            </div>
        -->
        </div>
        <div id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <p class="pull-left">&copy; 2017 Library Integrated Online Services (LIOS)</p>
                    </div>
                    <!--
                    <div class="col-md-8">
                        <ul class="list-inline navbar-right">
                            <li><a href="#" title="Post">HOME</a></li>
                            <li><a href="#" title="Post">MENU ITEM</a></li>
                            <li><a href="#" title="Post">MENU ITEM</a></li>
                            <li><a href="#" title="Post">MENU ITEM</a></li>
                            <li><a href="#" title="Post">MENU ITEM</a></li>
                            <li><a href="#" title="Post">MENU ITEM</a></li>
                        </ul>
                    </div>
                	-->
                </div>
            </div>
        </div>        
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://vjs.zencdn.net/6.2.0/video.js"></script>
</body>
</html>