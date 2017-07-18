<?php
  session_start();
  include 'connection.php';
  if(!isset($_SESSION['user']))
  {
      header("location:login.php");
  }
  
  $idk = $_GET['idk'];
  $sql = "select * from kategori where id_k=".$idk;
  $result=mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);

  $ubah = isset($_GET['ubah']) ? $_GET['ubah']:"";
  if ($ubah=="1")
  {
    $u_id = $_POST['id'];
    $u_kategori=$_POST['kategori'];
    
    $sql = "select * from kategori where nama_k = '$u_kategori' and id_k != '$u_id'";
    $result=mysqli_query($con, $sql);
    
    if($kategori = mysqli_fetch_assoc($result))
    {
      $success = 0;
    }
    else
    {
      $sql = "update kategori set nama_k='$u_kategori' where id_k = '$u_id'";
      $result=mysqli_query($con, $sql);
      header("location:admin-kategori.php?ubah=1");
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
                <li><a href="admin-video.php">Manajemen Video</a></li>
                <li><a href="admin-kategori.php" class="active">Manajemen Kategori</a></li>
            </ul>
            
            <div class="user"><p style="font-size:15px;">Login Sebagai : <br><?php echo $_SESSION['user']; ?></p></div>
            <ul><li><a href="logout.php" class="logout">Logout</a></li></ul>
           
        </samping>
        
        <div style="position:fixed; left:250px; right:0; height:140px; top:0; background-color:#fff;"></div>
        <div style="position:fixed; left:300px; right:50px; height:5px; top:100px; background-color:#000;"></div>
        <p style="position:fixed; left:310px; right:50px; top:20px; font-size:50px; color:#000;">Manajemen Kategori</p>
    
        <div class="konten">
        <?php
          if(isset($success))
          {
        ?>
              <div class="alertfail">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Nama Kategori Sudah Terpakai</strong>
              </div>
        <?php 
          }
        ?> 
        	<form method="post" action="admin-kategori_edit.php?ubah=1&idk=<?php echo $row['id_k'] ?>" class="col-md-4 col-lg-push-4" style="margin-top:50px">
                ID<br><input value="<?php echo $row['id_k'] ?>" id="id" name="id" placeholder="ID" class="form-control input-md" type="text" style="margin-bottom:20px;" readonly>
            	Nama Kategori<br><input value="<?php echo $row['nama_k'] ?>" id="kategori" name="kategori" placeholder="Nama Kategori" class="form-control input-md" type="text" style="margin-bottom:20px;">
              <center><input type="submit" id="ubah" value="Ubah" class="btn btn-primary">
                  <a href="admin-kategori.php"><button type="button" class="btn btn-danger">Batal</button></a></center>
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