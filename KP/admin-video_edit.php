<?php
  session_start();
  include 'connection.php';
  if(!isset($_SESSION['user']))
  {
      header("location:login.php");
  }
  elseif($_SESSION['user'] != "admin1")
  {
      header("location:user-video_edit.php");
  }
  $idv = isset($_GET['idv']) ? $_GET['idv']:"";
  if($idv == "")
  {
      header("location:admin-video.php");
  }
  $sql = "select * from video where id_v=".$idv;
  $result=mysqli_query($con, $sql);
  $datav = mysqli_fetch_assoc($result);

  $sql = "select * from kategori where id_k = '$datav[kategori_v]'";
  $result=mysqli_query($con, $sql);
  $alphak = mysqli_fetch_assoc($result);
  $oldk = $alphak['id_k'];

  $ubah = isset($_GET['ubah']) ? $_GET['ubah']:"";
  if ($ubah=="1")
  {
    $u_id = $_POST['id'];
    $u_namavideo = $_POST['namavideo'];
    $u_kategori = $_POST['kategori'];
    $sql = "select * from kategori where id_k = '$u_kategori'";
    $result=mysqli_query($con, $sql);
    $alphaknew = mysqli_fetch_assoc($result);
    $u_deskripsi = $_POST['deskripsi'];
    
    $sql = "select * from video where nama_v = '$u_namavideo' and id_v != '$u_id'";
    $result=mysqli_query($con, $sql);
    
    if($namav = mysqli_fetch_assoc($result))
    {
      $success = 0;
    }
    else
    {
      $sql = "update kategori set jlvideo_k=jlvideo_k-1 where id_k = ".$oldk;
      $result=mysqli_query($con, $sql);
      $sql = "update kategori set jlvideo_k=jlvideo_k+1 where id_k = ".$u_kategori;
      $result=mysqli_query($con, $sql);
      $sql = "update video set nama_v='$u_namavideo', deskripsi_v='$u_deskripsi', kategori_v='$u_kategori' where id_v = '$u_id'";
      $result=mysqli_query($con, $sql);
      rename("videos/".$alphak['nama_k']."/".$datav['nama_v'], "videos/".$alphaknew['nama_k']."/".$u_namavideo);
      header("location:admin-video.php?ubah=1");
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Admin</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&amp;subset=latin-ext" rel="stylesheet">
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
	<body style="background-color:#ccf">
        <samping>
        <div class="title">
        	<img src="img/logo.png" width="85px" style="margin:10px; float:left">
      		<div style="width:145px; height:100px; float:left; margin-top:20px">
            	<p style="color:white; font-size:14px; margin:0;">Poltekkes Surakarta</p>
                <p style="color:white; font-size:26px; margin:0;">LIOS Video</p>
        	</div>
        </div>
        <div class="garis"></div>
            
            <ul>
            	<li><a href="admin-user.php">Manajemen User</a></li>
                <li><a href="admin-video.php" class="active">Manajemen Video</a></li>
                <li><a href="admin-kategori.php">Manajemen Kategori</a></li>
            </ul>
            
            <div class="user"><p style="font-size:15px;">Login Sebagai : <br><?php echo $_SESSION['nama']; ?></p></div>
            <ul><li><a href="logout.php" class="logout">Logout</a></li></ul>
           
        </samping>
        
        <div style="position:fixed; left:250px; right:0; height:140px; top:0; background-color:#fff;"></div>
        <div style="position:fixed; left:300px; right:50px; height:5px; top:100px; background-color:#000;"></div>
        <p style="position:fixed; left:310px; right:50px; top:20px; font-size:50px; color:#000;">Manajemen Video</p>
    
        <div class="konten">
        <?php
          if(isset($success))
          {
        ?>
              <div class="alertfail">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Nama Video Sudah Terpakai</strong>
              </div>
        <?php 
          }
        ?> 
       		<form method="post" action="admin-video_edit.php?ubah=1&idv=<?php echo $datav['id_v']; ?>" class="col-md-4 col-lg-push-4" style="margin-top:50px">
                  ID<br><input value="<?php echo $datav['id_v'] ?>" id="id" name="id" placeholder="ID" class="form-control input-md" type="text" style="margin-bottom:20px;" readonly>
              Nama Video<br><input value="<?php echo $datav['nama_v'] ?>" id="namavideo" name="namavideo" placeholder="Nama Video" class="form-control input-md" type="text" style="margin-bottom:20px;">
                  Kategori<br><select name="kategori" id="kategori" value="<?php echo $datav['kategori_v'] ?>" class="form-control" style="margin-bottom:20px;">
                  <?php 
                    $sql = "select * from kategori where nama_k != 'Lainnya' order by nama_k";
                    $result=mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                  ?>
                      <option value="<?php echo $row['id_k'] ?>"><?php echo $row['nama_k'] ?></option>
                  <?php } ?>
                  <?php
                    $sql = "select * from kategori where nama_k = 'Lainnya'";
                    $result=mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result)
                    ?>
                    <option value="<?php echo $row['id_k'] ?>"><?php echo $row['nama_k'] ?></option>
				  </select>
                  Deskripsi<br><textarea rows="5" id="deskripsi" name="deskripsi" placeholder="Deskripsi" class="form-control input-sm" type="text" style="margin-bottom:20px;"><?php echo $datav['deskripsi_v']; ?></textarea>
                  <center><input type="submit" id="ubah" value="Ubah" class="btn btn-primary">
                  <a href="admin-video.php"><button type="button" class="btn btn-danger">Batal</button></a></center>
           	</form>       
        </div>
            
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   

   <!-- <script type="text/javascript">
    
	(function() {
		var bodyEL = $('body'),
			navtogglebtm = bodyEL.find('.nav-toggle-btm');
		
		navtogglebtm.on('click', function(e) {
			bodyEL.toggleClass('active-nav');
			e.preventDefault();	 
		});
		
	})();
    </script>
	-->
</body>
</html>