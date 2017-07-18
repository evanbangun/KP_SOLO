<?php
  session_start();
  include 'connection.php';
  if(!isset($_SESSION['user']))
  {
      header("location:login.php");
  }
  elseif($_SESSION['user'] != "admin1")
  {
      header("location:user-video.php");
  }
  
  $idu = isset($_GET['idu']) ? $_GET['idu']:"";
  if($idk == "")
  {
      header("location:admin-kategori.php");
  }
  $sql = "select * from user where id_u=".$idu;
  $result=mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);

  $ubah = isset($_GET['ubah']) ? $_GET['ubah']:"";
  if ($ubah=="1")
  {
    $u_id = $_POST['id'];
    $u_username=$_POST['username'];
    $u_password=$_POST['password'];
    $u_password2=$_POST['password2'];
    $u_nama=$_POST['nama'];

    $sql = "select * from user where username_u = '$u_username' and id_u != '$u_id'";
    $result=mysqli_query($con, $sql);
    
    if($user = mysqli_fetch_assoc($result))
    {
      $success = 3;
    }
    else
    {
      if($u_password != $u_password2)
      {
        $success = 2;
      }
      else
      {
        $sql = "update user set username_u='$u_username', password_u=md5('$u_password'), nama_u='$u_nama' where id_u = '$u_id'";
        $result=mysqli_query($con, $sql);
        header("location:admin-user.php?ubah=1");
      }
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
            	<li><a href="admin-user.php" class="active">Manajemen User</a></li>
                <li><a href="admin-video.php">Manajemen Video</a></li>
                <li><a href="admin-kategori.php">Manajemen Kategori</a></li>
            </ul>
            
            <div class="user"><p style="font-size:15px;">Login Sebagai : <br><?php echo $_SESSION['nama']; ?></p></div>
            <ul><li><a href="logout.php" class="logout">Logout</a></li></ul>
           
        </samping>
        
        <div style="position:fixed; left:250px; right:0; height:140px; top:0; background-color:#fff;"></div>
        <div style="position:fixed; left:300px; right:50px; height:5px; top:100px; background-color:#000;"></div>
        <p style="position:fixed; left:310px; right:50px; top:20px; font-size:50px; color:#000;">Manajemen User</p>
    
        <div class="konten">
        <?php
          if(isset($success))
          {
            if($success == 3)
            {
        ?>
              <div class="alertfail">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Username Sudah Terpakai</strong>
              </div>
        <?php 
            }
            elseif ($success == 2)
            {
        ?>   
              <div class="alertfail">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Password yang Dimasukkan Tidak Sama</strong>
              </div>
        <?php 
            }
           }
        ?>     
        	<form method="post" action="admin-user_edit.php?ubah=1&idu=<?php echo $idu ?>" id="id" class="col-md-4 col-lg-push-4" style="margin-top:50px">
                ID<br><input value="<?php echo $row['id_u'] ?>" id="id" name="id" placeholder="ID" class="form-control input-md" type="text" style="margin-bottom:20px;" readonly>
            	Username<br><input value="<?php echo $row['username_u'] ?>" id="username" name="username" placeholder="Username" class="form-control input-md" type="text" style="margin-bottom:20px;" required>
                Password<br><input id="password" name="password" placeholder="Password" class="form-control input-md" type="password" style="margin-bottom:20px;" required>
                Ulangi Password<input id="password2" name="password2" placeholder="Ulangi Password" class="form-control input-md" type="password" style="margin-bottom:20px;" required>
                Nama<br><input value="<?php echo $row['nama_u'] ?>" id="nama" name="nama" placeholder="Nama" class="form-control input-md" type="text" style="margin-bottom:20px;" required>
                <center><input type="submit" id="ubah" value="Ubah" class="btn btn-primary">
                <a href="admin-user.php"><button type="button" class="btn btn-danger">Batal</button></a></center>
          	</form>
        </div>
    
            <script> var f = document.getElementsByClassName(
    
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