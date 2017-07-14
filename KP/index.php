<!DOCTYPE html>
<?php
    include 'connection.php';
?>
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
				<a href="index.html" class="navbar-brand">
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
    <div class="bread_area" style="background-color:#e6e6e6; margin-bottom:20px; height:45px;"> </div>   
    <main class="site-main category-main">
        <div class="container">
            <div class="row">
                <section class="category-content col-sm-9">
                    <h2 class="category-title">Video Terbaru</h2>
                    <ul class="media-list">
                    <?php
                        $query = "select * from video";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result))
                        {
                    ?>
                        <li class="media">
                            <div class="media-left">
                                <a href="#" title="Post">
                                    <video src="videos/<?php echo $row['nama_v']; ?>" type="video/mp4" width="256px">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading"><a href="#" title="Post Title"><?php $name=pathinfo($row['nama_v']); echo $name['filename']; ?></a></h3>
                                <p><?php echo $row['deskripsi_v']; ?></p>
                                <aside class="meta category-meta">
                                    <div class="pull-left">
                                        <div class="arc-comment"><em class="fa fa-eye"></em> <?php echo $row['lihat_v']; ?></div>
                                        <div class="arc-date"><?php echo $row['tanggal_v']; ?></div>
                                    </div>
                                </aside>                                
                            </div>
                        </li>
                        <!-- <li class="media">
                            <div class="media-left">
                                <a href="#" title="Post">
                                    <video src="videos/vid5.mp4" type="video/mp4" width="256px">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading"><a href="#" title="Post Title">Judul Video</a></h3>
                                <p>deskripsi video ( jika ada ).</p>
                                <aside class="meta category-meta">
                                    <div class="pull-left">
                                        <div class="arc-comment"><em class="fa fa-eye"></em> 0</div>
                                        <div class="arc-date">10/15/2016</div>
                                    </div>
                                <div class="pull-right">
                                        <ul class="arc-share">
                                            <li><a href="#" title="Post"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" title="Post"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" title="Post"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#" title="Post"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </aside>                                
                            </div>
                        </li> -->
                    <?php } ?>                          
                    </ul>                    
                </section>
                <aside class="sidebar col-sm-3">
                    <div class="widget">
                        <h4>Kategori</h4>
                        <ul>
                            <?php
                                $query = "select * from kategori";
                                $result = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($result))
                                {
                            ?>
                            <li><a href="#" title=""><?php echo $row['nama_k']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </aside>
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
</body>
</html>
