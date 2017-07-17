<!DOCTYPE html>
<?php
    include 'connection.php';

    $idv = $_GET['idv'];
    $query = "update video set lihat_v=lihat_v+1 where id_v=".$idv;
    $result = mysqli_query($con, $query);
    $query = "select * from video where id_v=".$idv;
    $result = mysqli_query($con, $query);
    $video = mysqli_fetch_assoc($result);
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
    <div class="bread_area" style="background-color:#e6e6e6; margin-bottom:20px;"> 
    	<!--	<div class="collapse navbar-collapse id="bs-navbar-collapse"  style="margin-left:6%">
                    <ul class="nav navbar-nav main-navbar-nav">
                        <li class="active"><a href="index.html" title="">HOME</a></li>
                        <li class="dropdown">
                            <a href="#" title="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DROPDOWN MENU <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" title="">SUB MENU 1</a></li>
                                <li><a href="#" title="">SUB MENU 2</a></li>
                                <li><a href="#" title="">SUB MENU 3</a></li>
                            </ul>
                        </li>
                        <li><a href="page.html" title="">PAGE</a></li>
                        <li><a href="category.html" title="">CATEGORY</a></li>
                        <li><a href="#" title="">MENU ITEM</a></li>
                        <li><a href="#" title="">MENU ITEM</a></li>
                    </ul>                           
                </div> -->
    </div>   
    <main class="site-main category-main">
        <div class="container">
            <div class="row">
                <section class="category-content col-sm-9">
                 <!--   <h2 class="category-title">Putar Video</h2> -->
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-left">
                                <video src="videos/<?php echo $video['nama_v']; ?>" type="video/mp4" width="720px" controls controlsList="nodownload">
                            </div>
                        </li>                        
                    </ul>
                    <div class="media-body">
                                <p style="font-size:30px; color:#55555"><b><?php $vname=pathinfo($video['nama_v']); echo $vname['filename']; ?></b></p>
                                <p><?php echo $video['deskripsi_v']; ?></p>                                    
                     </div>
                     <div class="arc-comment"><em class="fa fa-eye"></em> <?php echo $video['lihat_v']; ?></div>
                  <a href="videos/<?php echo $video['nama_v']; ?>" download><button type="button" class="btn btn-success">Download</button></a>
                </section>
                <aside class="sidebar col-sm-3">
                	<div class="widget">
                		<h4>Video Berkategori Sama</h4>
                	</div>
                    <?php
                        $query = "select * from video where kategori_v=".$video['kategori_v']." and id_v !=".$video['id_v']." limit 3";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result))
                        {
                    ?>
                    <div class="media">
                		<div class="media-left">
                			<a href="watch.php?idv=<?php echo $row['id_v']; ?>" title="Post">
                   	 			<video src="videos/<?php echo $row['nama_v']; ?>" type="video/mp4" width="144px">
                   	 		</a>
	          			</div>
                    	<div class="media-body">
            				<p class="media-heading"><a href="watch.php?idv=<?php echo $row['id_v']; ?>"><?php $name=pathinfo($row['nama_v']); echo $name['filename']; ?></a></p>
                   		</div>
                    </div>
                    <?php } ?>
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