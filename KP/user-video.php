<?php
  session_start();
  include 'connection.php';
  if(!isset($_SESSION['user']))
  {
      header("location:login.php");
  }
  elseif($_SESSION['user'] == "admin1")
  {
      header("location:admin-video.php");
  }
  $sql = "select * from user where username_u = '".$_SESSION['user']."'";
  $result=mysqli_query($con, $sql);
  $user = mysqli_fetch_assoc($result);
  $ubah = isset($_GET['ubah']) ? $_GET['ubah']:"";
  $hapus = isset($_GET['hapus']) ? $_GET['hapus']:"";
  if(isset($hapus))
  {
    $sql = "select * from video where id_v = '$hapus'";
    $result=mysqli_query($con, $sql);
    if($cekhapus = mysqli_fetch_assoc($result))
    {
      $sql = "select * from kategori where id_k = $cekhapus[kategori_v]";
      $result=mysqli_query($con, $sql);
      $katehapus=mysqli_fetch_assoc($result);
      unlink("videos/".$katehapus['nama_k']."/".$cekhapus['nama_v']);
      $sql = "delete from video where id_v = '$hapus'";
      $result=mysqli_query($con, $sql);
      $successhapus=1;
      // $message = "videos/".$katehapus['nama_k']."/".$cekhapus['nama_v'];
      // echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
  $upload = isset($_GET['upload']) ? $_GET['upload']:"";
  if ($upload=="1")
  {
    if(isset($_FILES['vidtoupload']['name']))
    {
      $t_deskripsi=$_POST['deskripsi'];
      $t_kategori=$_POST['kategori'];

      $sql = "select * from kategori where id_k = '$t_kategori'";
      $result=mysqli_query($con, $sql);
      $row = mysqli_fetch_assoc($result);
      $t_a_kategori=$row['nama_k'];
      $target_dir = "videos/$t_a_kategori/";
      $target_file = $target_dir . basename($_FILES['vidtoupload']['name']);
      $uploadOk = 1;
      //echo $_FILES['vidtoupload']['error'];
      $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if file already exists
      if (file_exists($target_file))
      {
          $success = 3;
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($FileType != "mp4" && $FileType != "ogg" && $FileType != "webm")
      {
          $success = 2;
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 1)
      {
        if (move_uploaded_file($_FILES["vidtoupload"]["tmp_name"], $target_file))
        {
            $sql = "select * from user where username_u = '".$_SESSION['user']."'";
            $result=mysqli_query($con, $sql);
            $uploader = mysqli_fetch_assoc($result);
            $success = 1;
            $sql = "insert into video( nama_v, lihat_v, deskripsi_v, kategori_v, user_v) VALUES ('".$_FILES['vidtoupload']['name']."','','$t_deskripsi','$t_kategori', '$uploader[id_u]')";
            $result=mysqli_query($con, $sql);
        } 
        else
        {
           $success = 0;
        }
      } 
    }
    else
    {
      $success = 2;
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
            <div class="user"><p style="font-size:15px;">Login Sebagai : <br><?php echo $_SESSION['nama']; ?></p></div>
            <ul><li><a href="logout.php" class="logout">Logout</a></li></ul>
           
        </samping>
        
        <div style="position:fixed; left:250px; right:0; height:140px; top:0; background-color:#fff;"></div>
        <div style="position:fixed; left:300px; right:50px; height:5px; top:100px; background-color:#000;"></div>
        <p style="position:fixed; left:310px; right:50px; top:20px; font-size:50px; color:#000;">User Video</p>
    
        <div class="konten">
        <?php
          if(isset($success))
          {
            if($success == 3)
            {
        ?>
              <div class="alertfail">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Terdapat File Dengan Nama Sama</strong>
              </div>
        <?php 
            }
            elseif ($success == 2)
            {
        ?>   
              <div class="alertfail">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Format Video Tidak Diterima (Disarankan MP4, OGG, dan WEBM)</strong>
              </div>
        <?php 
            }
            elseif ($success == 0)
            {
        ?>   
              <div class="alertfail">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Video Gagal Di Upload</strong>
              </div> 
        <?php 
            }
            elseif ($success == 1)
            {
        ?>   
              <div class="alertsuccess">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Video Berhasil Ditambah</strong>
              </div>
        <?php 
            }
          }
          elseif ($ubah == "1")
          {
        ?>   
          <div class="alertsuccess">
            <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Video Berhasil Diubah</strong>
          </div> 
        <?php 
          }
          elseif (isset($successhapus))
          {
        ?>   
          <div class="alertsuccess">
            <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Video Berhasil Dihapus</strong>
          </div>
        <?php
          }
        ?>      
            <table width="95%" border="2">
              <tbody>
                <tr>
                  <th onclick="#">No</th>
                  <th onclick="#">Nama</th>
                  <th onclick="#">Kategori</th>
                  <th onclick="#">Tangal</th>
                  <th onclick="#">Deskripsi</th>
                  <th onclick="#">Lihat</th>
                  <th onclick="#">Manage</th>
                </tr>
                <?php
                   $i = 0; 
                   $sql = "select * from video where user_v = $user[id_u]";
                   $result = mysqli_query($con, $sql);
                   while($row = mysqli_fetch_assoc($result))
                   {
                    $i++;
                ?>  
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $row['nama_v']; ?></td>
                  <td><?php $sql = "select * from kategori where id_k=".$row['kategori_v'];
                        $result2=mysqli_query($con, $sql);
                        $namak = mysqli_fetch_assoc($result2);
                        echo $namak['nama_k']; ?></td>
                  <td><?php echo $row['tanggal_v']; ?></td>
                  <td><?php echo $row['deskripsi_v']; ?></td>
                  <td><?php echo $row['lihat_v']; ?></td>
                  <td>
                    <a href="user-video_edit.php?idv=<?php echo $row['id_v']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <?php echo "<a onClick=\"javascript: return confirm('Yakin Ingin Menghapus $row[nama_v] ?');\" href='user-video.php?hapus=".$row['id_v']."'><i class='fa fa-times' aria-hidden='true' style='padding-left:10px'></i></a>"; ?>
                  </td>
                </tr>
                <?php
                   } 
                ?>
              </tbody>
            </table>
            
            <button id="tambah-user" style="background-color:#fff; margin-top:10px; color:#000;">Tambah Video</button></a>            
        </div>
    
	    <div id="myModal" class="modal">
    
        <!-- Modal content -->
            <div class="modal-content" style="height:400px;">
              <span class="close">&times;</span>
                <form action="?upload=1" enctype="multipart/form-data" method="post" class="col-md-4 col-lg-push-4" style="margin-top:50px">
                  Upload Video<br><input type="file" id="vidtoupload" name="vidtoupload" style="margin-bottom:20px;">
                  Kategori<br><select id="kategori" name="kategori" class="form-control" style="margin-bottom:20px;">
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
                  Deskripsi<br><textarea id="deskripsi" name="deskripsi" rows="5" placeholder="Deskripsi" class="form-control input-sm" type="text" style="margin-bottom:20px;"></textarea>
                  <input type="submit" value="Tambahkan" class="btn btn-primary">
                </form>
          </div>
        </div>   
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
   <script>
		// Get the modal
		var modal = document.getElementById('myModal');
		
		// Get the button that opens the modal
		var btn = document.getElementById("tambah-user");
		
		// Get the <span> element that closes the modal
		var span = document.getElementById("close");
			
		
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