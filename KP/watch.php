<!DOCTYPE html>
<?php
    include 'connection.php';

    $idv = $_GET['idv'];
    $query = "update video set lihat_v=lihat_v+1 where id_v=".$idv;
    $result = mysqli_query($con, $query);
    $query = "select * from video where id_v=".$idv;
    $result = mysqli_query($con, $query);
    $video = mysqli_fetch_assoc($result);

    $comment = isset($_GET['comment']) ? $_GET['comment']:"";
    if ($comment=="1")
    {
        $c_video=$_POST['idvideo'];
        $c_nama=$_POST['nama'];
        $c_isi=$_POST['comment'];
        $sql = "insert into komen( nama_c, isi_c, video_c) VALUES ('$c_nama','$c_isi','$c_video')";
        $result=mysqli_query($con, $sql);
    }
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
    <div class="bread_area" style="background-color:#e6e6e6; margin-bottom:20px;"> 
    	
    </div>   
    <main class="site-main category-main">
        <div class="container">
            <div class="row">
                <section class="category-content col-sm-9">
                 <!--   <h2 class="category-title">Putar Video</h2> -->
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-left">
                                <?php
                                        $query = "select * from kategori where id_k = $video[kategori_v]";
                                        $result2 = mysqli_query($con, $query);
                                        $katevideo = mysqli_fetch_assoc($result2);
                                    ?>
                                <video src="videos/<?php echo $katevideo['nama_k']; ?>/<?php echo $video['nama_v']; ?>" type="video/mp4" width="720px" controls controlsList="nodownload">
                            </div>
                        </li>                        
                    </ul>
                    <div class="media-body">
                                <p style="font-size:30px; color:#55555"><b><?php $vname=pathinfo($video['nama_v']); echo $vname['filename']; ?></b></p>
                                <p><?php echo $video['deskripsi_v']; ?></p>                                    
                     </div>
                     <div class="arc-comment"><em class="fa fa-eye"></em> <?php echo $video['lihat_v']; ?></div>
                  <a href="videos/<?php echo $katevideo['nama_k']; ?>/<?php echo $video['nama_v']; ?>" download><button type="button" class="btn btn-success">Download</button></a>
                
		<div class="garishorizontal"  style="margin-top:50px;"></div>
                <h2 class="category-title">Komentar</h2>
                   
                <form method="post" class="form-horizontal" action="?idv=<?php echo $idv; ?>&comment=1" >
                	<div class="form-group">
                            <input type="hidden" value="<?php echo $idv; ?>" class="form-control" id="idvideo" placeholder="Masukkan Nama" name="idvideo">
                        	<label class="control-label col-sm-1" for="Nama">Nama:</label>
                          	<div class="col-sm-4">
                            		<input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama">
                          	</div>
                       	</div>
                        <div class="form-group">
                        	<label class="control-label col-sm-1" for="komentar">Komentar:</label>
                          	<div class="col-sm-9">
                            		<textarea class="form-control" rows="4" name="comment" id="comment" placeholder="Masukkan Komentar"></textarea>
                          	</div>
                       	</div>
                        <input type="submit" value="Kirim" class="btn btn-primary">
                  </form>
                        
                  <div class="garishorizontal"  style="margin-top:50px;"></div>
                  <?php
                        $query = "select * from komen where video_c = ".$idv;
                        $result = mysqli_query($con, $query);
                        while($komen = mysqli_fetch_assoc($result))
                        {
                  ?>
                              <div style="margin-bottom:20px;">
                               	    <h4 style="color:#000;"><?php echo $komen['nama_c']; ?></h4>
                                    <p><?php echo $komen['isi_c']; ?></p>
                                    <button id="delcomment" style="background-color:#ddd; color: #000; float: right; margin-right: 50px;">Hapus komentar ini</button>
                                    <center><div class="garishorizontal2"></div></center>
                              </div>
                  <?php
                        }
                  ?>
		    
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
                                <?php
                                    $query = "select * from kategori where id_k = $row[kategori_v]";
                                    $result2 = mysqli_query($con, $query);
                                    $katevideo = mysqli_fetch_assoc($result2);
                                ?>
                   	 			<video src="videos/<?php echo $katevideo['nama_k']; ?>/<?php echo $row['nama_v']; ?>" type="video/mp4" width="144px">
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
</body>
</html>
