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

  // ensure $dir ends with a slash 
  function delTree($dir) { 
      $files = glob( $dir . '*', GLOB_MARK ); 
      foreach( $files as $file ){ 
          if( substr( $file, -1 ) == '/' ) 
              delTree( $file ); 
          else 
              unlink( $file ); 
      } 
      rmdir( $dir ); 
  }

  $ubah = isset($_GET['ubah']) ? $_GET['ubah']:"";
  
  $hapus = isset($_GET['hapus']) ? $_GET['hapus']:"";
  if(isset($hapus))
  {
    $sql = "select * from kategori where id_k = '$hapus'";
    $result=mysqli_query($con, $sql);
    if($cekhapus = mysqli_fetch_assoc($result))
    {
      $dir = "videos/".$cekhapus['nama_k']."/";
      delTree($dir);
      $sql = "delete from kategori where id_k = '$hapus'";
      $result=mysqli_query($con, $sql);
      $hapusfolder=mysqli_fetch_assoc($result);
      $successhapus=1;
    }
    $sql = "delete from video where kategori_v = '$hapus'";
    $result=mysqli_query($con, $sql);
  }
  
  $tambahk = isset($_GET['tambahk']) ? $_GET['tambahk']:"";
  if ($tambahk=="1")
  {
    $tk_nama = $_POST['kategori'];
    $sql = "select * from kategori where nama_k = '$tk_nama'";
    $result=mysqli_query($con, $sql);
    
    if($row = mysqli_fetch_assoc($result))
    {
      $success=0;
    }
    else
    {
      $sql = "insert into kategori(nama_k) VALUES ('$tk_nama')";
      $result=mysqli_query($con, $sql);
      mkdir("videos/$tk_nama");
      $success = 1;
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
            
            <div class="user"><p style="font-size:15px;">Login Sebagai : <br><?php echo $_SESSION['nama']; ?></p></div>
            <ul><li><a href="logout.php" class="logout">Logout</a></li></ul>
           
        </samping>
        
        <div style="position:fixed; left:250px; right:0; height:140px; top:0; background-color:#fff;"></div>
        <div style="position:fixed; left:300px; right:50px; height:5px; top:100px; background-color:#000;"></div>  
        <p style="position:fixed; left:310px; right:50px; top:20px; font-size:50px; color:#000;">Manajemen Kategori</p>
        <div class="konten">
        <?php
        if(isset($success))
        {
          if($success == 0)
          {
        ?>
            <div class="alertfail">
              <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
              <strong>Kategori Sudah Ada</strong>
            </div>
        <?php 
          }
          elseif ($success == 1)
          {
          ?>   
            <div class="alertsuccess">
              <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
              <strong>Kategori Berhasil Ditambah</strong>
            </div>
        <?php 
          } 
        }
        elseif ($ubah == "1")
        {
        ?>   
          <div class="alertsuccess">
            <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Kategori Berhasil Diubah</strong>
          </div>
        <?php 
        }
        elseif (isset($successhapus))
        {
        ?>
          <div class="alertsuccess">
            <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Kategori Berhasil Dihapus</strong>
          </div>
        <?php
        }
        ?>
            <table width="60%" border="2">
              <tbody>
                <tr>
                  <th onclick="#">Nama</th>
                  <th onclick="#">Manage</th>
                </tr>
                <?php 
                   $sql = "select * from kategori";
                   $result=mysqli_query($con, $sql);
                   while($row = mysqli_fetch_assoc($result))
                   {
                ?>
                <tr>
                  <td><?php echo $row['nama_k']; ?></td>
                  <td>
                    <a href="admin-kategori_edit.php?idk=<?php echo $row['id_k']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <?php echo "<a onClick=\"javascript: return confirm('Yakin Ingin Menghapus $row[nama_k] ? SEMUA VIDEO BERKATEGORI INI JUGA AKAN IKUT TERHAPUS ! ');\" href='admin-kategori.php?hapus=".$row['id_k']."'><i class='fa fa-times' aria-hidden='true' style='padding-left:10px'></i></a>"; ?>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            
            <button id="tambah-kategori" style="background-color:#fff; margin-top:10px; color:#000;">Tambah Kategori</button></a>            
        </div>
    
	    <div id="myModal" class="modal">
        <!-- Modal content -->
            <div class="modal-content" style="height:200px;">
            	<span class="close">&times;</span>
                <form action="?tambahk=1" method="post" class="col-md-4 col-lg-push-4" style="margin-top:50px">
                    Nama Kategori<br><input id="kategori" name="kategori" placeholder="Nama Kategori" class="form-control input-md" type="text" required="" style="margin-bottom:20px;">
                  	<input type="submit" id="tambahkan" value="Tambahkan" class="btn btn-primary">
                </form>
      		</div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
   <script>
		// Get the modal
		var modal = document.getElementById('myModal');
		
		// Get the button that opens the modal
		var btn = document.getElementById("tambah-kategori");
		
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		
		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			modal.style.display = "block";
		}
		
		// When the user clicks on <span> (x), close the modal		}
		span.onclick = function() {
			modal.style.display = "none";
			
		}
		
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>

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