<?php
    session_start();
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
        
        <nav class="navbar navbar-default" style="background-color:#15286d">
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
    <main class="site-main category-main" style="min-height: 70%">
        <div class="container">
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
    </main>
    <footer class="site-footer" style="position: fixed; bottom: 0;">
        <div class="container">
        </div>
        <div id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <p class="pull-left">&copy; 2017 Library Integrated Online Services (LIOS)</p>
                    </div>
                </div>
            </div>
        </div>        
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://vjs.zencdn.net/6.2.0/video.js"></script>
</body>
</html>
