<!DOCTYPE html>
<?php
    session_start();
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
        <nav class="navbar navbar-default" style="background-color: #15286d">
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
    <div class="bread_area" style="background-color:#e6e6e6;"> 
    </div>   
    <main class="site-main category-main">
        <div class="container">
            <div class="col-sm-9">
                <?php
                    $query = "select * from video order by tanggal_v desc limit 1";
                    $result = mysqli_query($con, $query);
                    if($row = mysqli_fetch_assoc($result))
                    {
                        $query = "select * from kategori where id_k = $row[kategori_v]";
                        $result = mysqli_query($con, $query);
                        $katevideo = mysqli_fetch_assoc($result);
                ?>
                <h2 class="category-title">Video Terbaru</h2>
                <video width="100%" controls autoplay>
                    <source src="videos/<?php echo $katevideo['nama_k']; ?>/<?php echo $row['nama_v']; ?>" type="video/mp4">
                </video>
                <h2><?php $name=pathinfo($row['nama_v']); custom_echo($name['filename'], 30); ?></h2>
                <?php
                    $query = "select * from user where id_u = ".$row['user_v'];
                    $result = mysqli_query($con, $query);
                    $uploader = mysqli_fetch_assoc($result);
                ?>
                <h6>Di Upload Oleh : <?php echo $uploader['nama_u']; ?></h6>
                <h4><?php echo $row['deskripsi_v']; ?></h4>
                <?php
                    }
                ?>
            </div> 
            <div class="col-sm-3">
                <div class="widget">
                    <h4>Kategori</h4>
                    <ul>
                    <?php
                        $query = "select * from kategori where nama_k != 'Lainnya' order by nama_k limit 5";
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
                    <ul><li><a href="kategori-list.php" title="">Lihat Semua Kategori</a></li></ul>
                </div>
            </div>
        </div>
        <div class="container">
           <!-- <div class="garishorizontal"></div> -->
            <h2 class="category-title">Recent Video</h2>
            <?php
                $slide = 0;
                $query = "select * from video order by tanggal_v";
                $result = mysqli_query($con, $query);
                $num_rows = mysqli_num_rows($result);
                if($num_rows > 4)
                {
                    $slide = 2;
                }
                else
                {
                    $slide = 1;
                }
            ?>
           
                <?php
                    $q=0;
                    $i = 0;
                    for($x = $slide; $x > 0; $x--)
                    {
                ?>
                <div class="mySlides">
                    <?php
                        $query = "select * from video order by tanggal_v desc limit ".($q*4).",".(($q+1)*4);
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $i++;
                            $query2 = "select * from kategori where id_k = $row[kategori_v]";
                            $result2 = mysqli_query($con, $query2);
                            $katevideo = mysqli_fetch_assoc($result2);
                    ?>
                            <div class="col-sm-3">
                                <a href="watch.php?idv=<?php echo $row['id_v']; ?>" title="Post">
                                    <video class="vid" width="232" height="174">
                                        <source src="videos/<?php echo $katevideo['nama_k']; ?>/<?php echo $row['nama_v']; ?>" type="video/mp4">
                                    </video>
                                </a>
                                <a href="watch.php?idv=<?php echo $row['id_v']; ?>" title="Post">
                                    <h4><?php $name=pathinfo($row['nama_v']); custom_echo($name['filename'], 30); ?></h4>
                                </a>
                                <?php
                                    $queryup = "select * from user where id_u = ".$row['user_v'];
                                    $resultup = mysqli_query($con, $queryup);
                                    $uploaderup = mysqli_fetch_assoc($resultup);
                                ?>
                                <h6>Di Upload Oleh : <?php echo $uploaderup['nama_u']; ?></h6>
                            </div>
                    <?php
                        }
                        $q++;
                    ?>
                </div>
                <?php
                    }
                ?>
            
            <br>
            <div style="text-align:center">
                <?php
                    for($x = 1; $x <= $slide; $x++)
                    {
                ?>
                <span class="dot" onclick="currentSlide(<?php echo $x ?>)"></span>
                <?php
                    }
                ?>
            </div>      
        </div>
        <?php
            $query = "select * from kategori where jlvideo_k > 0 order by nama_k limit 3";
            $result = mysqli_query($con, $query);
            while($kategori = mysqli_fetch_assoc($result))
            {
        ?>
                    <div class="container">
                        <!--<div class="garishorizontal"></div>-->
                        <a href="kategori.php?idk=<?php echo $kategori['id_k']; ?>" title="Post">
                        <h2 class="category-title"><?php echo $kategori['nama_k']; ?></h2>
                        </a>
        <?php
                $query2 = "select * from video where kategori_v = $kategori[id_k]";
                $result2 = mysqli_query($con, $query2);
                while($video = mysqli_fetch_assoc($result2))
                {
                    $i++;
        ?>
                        <div class="col-sm-3">
                            <div class="videothumb">
                                <a href="watch.php?idv=<?php echo $video['id_v']; ?>" title="Post">
                                <video class="vid" width="256" height="192">
                                    <source src="videos/<?php echo $kategori['nama_k']; ?>/<?php echo $video['nama_v']; ?>" type="video/mp4">
                                </video>
                                </a>
                                
                            </div>
                            <a href="watch.php?idv=<?php echo $video['id_v']; ?>" title="Post">
                            <h4><?php $name=pathinfo($video['nama_v']); custom_echo($name['filename'], 30); ?></h4></a>
                            <?php
                                $query3 = "select * from user where id_u = $video[user_v]";
                                $result3 = mysqli_query($con, $query3);
                                $uploader = mysqli_fetch_assoc($result3)
                            ?>
                            <p>Di Upload Oleh : <?php echo $uploader['nama_u'] ?></p>
                        </div>  
        <?php
                }
        ?>  
                    </div>
        <?php
            }
        ?>
    </main>
    <footer class="site-footer">
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
    
    <script>
    var slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
    }
    </script>
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
