<!DOCTYPE html>
<?php
    session_start();
    include 'connection.php';

    $idk = $_GET['idk'];
    $query = "select * from kategori where id_k=".$idk;
    $result = mysqli_query($con, $query);
    $kategori = mysqli_fetch_assoc($result);
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
    <div class="bread_area" style="background-color:#e6e6e6; margin-bottom:20px;"> </div>   
    <main class="site-main category-main" style="min-height: 70%">
        <div class="container">
            
            	<h2 class="category-title">Kategori Video : <?php echo $kategori['nama_k'] ?></h2>
                <?php
                    $query = "select * from video where kategori_v=".$idk;
                    $result = mysqli_query($con, $query);
                    $ressult = mysqli_query($con, $query);
                    if($ceklist = mysqli_fetch_assoc($result))
                    {
                        $i = 0;
                        while($list = mysqli_fetch_assoc($ressult))
                        {
                            $i++;
                ?>
                            <div class="box2">
                            	<div class="media-left">
                                    <a href="watch.php?idv=<?php echo $list['id_v']; ?>" title="Post">
                                        <?php
                                            $query = "select * from kategori where id_k = $list[kategori_v]";
                                            $result2 = mysqli_query($con, $query);
                                            $katevideo = mysqli_fetch_assoc($result2);
                                        ?>
                                        <video class="vid" src="videos/<?php echo $katevideo['nama_k']; ?>/<?php echo $list['nama_v']; ?>" type="video/mp4" width="256px" height="128px">
                                    </a>
                                </div>
                                <div>
                                	<h3 class="media-heading"><a href="watch.php?idv=<?php echo $list['id_v']; ?>" title="Post Title"><?php $name=pathinfo($list['nama_v']); custom_echo($name['filename'], 25); ?></a></h3>
                                    <!-- <p>deskripsi video ( jika ada ).</p> -->
                                   
                                    <?php
                                        $query = "select * from user where id_u = $list[user_v]";
                                        $result3 = mysqli_query($con, $query);
                                        $uploader = mysqli_fetch_assoc($result3)
                                    ?>
                                    <div class="arc-date">Di Upload Oleh : <?php echo $uploader['nama_u'] ?></div>                                
                                </div>
                            </div>
                <?php   
                        }
                    }
                    else
                    {
                ?>
                        <h1>TIDAK ADA VIDEO TERDAFTAR</h1>
                <?php
                    } 
                ?>
            
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
    <!--
    <script>
        var vid = document.getElementsByClassName("vid");
        for (i = 0; i < <?php echo $i ?>; i++)
        { 
            var durasi = "";
            var a = "";
            var b = "";
            var c = "";
            if(Math.floor(vid[i].duration/3600) < 10)
            {
                a += "0" + Math.floor(vid[i].duration/3600);
            }
            else
            {
                a += Math.floor(vid[i].duration/3600);
            }
            if(Math.floor(vid[i].duration%3600/60) < 10)
            {
                b += "0" + Math.floor(vid[i].duration%3600/60);
            }
            else
            {
                b += Math.floor(vid[i].duration%3600/60);
            }
            if(Math.floor(vid[i].duration%3600%60) < 10)
            {
                c += "0" + Math.floor(vid[i].duration%3600%60);
            }
            else
            {
                c += Math.floor(vid[i].duration%3600%60);
            }
            durasi += a + ":" + b + ":" + c;
            var j = i + 1;
            document.getElementById("vid"+j).innerHTML = durasi;
        }
    </script>
    -->
    <?php
        function custom_echo($x, $length)
        {
          if(strlen($x)<=$length)
          {
            echo $x;
          }
          else
          {
            $y=substr($x,0,$length) . '...';
            echo $y;
          }
        }
    ?>
</body>
</html>
