<?php
  session_start();
  include 'connection.php';
  if(!isset($_SESSION['user']))
  {
      header("location:login.php");
  }
  $upload = isset($_GET['upload']) ? $_GET['upload']:"";
  if ($upload=="1")
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
        echo "<script type='text/javascript'>alert('Terdapat file dengan nama sama')</script>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($FileType != "mp4" && $FileType != "ogg" && $FileType != "webm")
    {
        echo "<script type='text/javascript'>alert('Maaf, file yang upload harus berekstensi mp4, ogg, webm')</script>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
    {
        echo "<script type='text/javascript'>alert('File gagal diupload')</script>";
    // if everything is ok, try to upload file
    }
    else
    {
      if (move_uploaded_file($_FILES["vidtoupload"]["tmp_name"], $target_file))
      {
          echo "<script type='text/javascript'>alert('File Berhasil di Upload')</script>";
          $sql = "insert into video( nama_v, lihat_v, deskripsi_v, kategori_v) VALUES ('$t_a_kategori/".$_FILES['vidtoupload']['name']."','','$t_deskripsi','$t_kategori')";
          $result=mysqli_query($con, $sql);
      } 
      else
      {
         echo "<script type='text/javascript'>alert('Terjadi error pada proses upload')</script>";
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
            	<li><a href="admin-user.php">Manajemen User</a></li>
                <li><a class="active">Manajemen Video</a></li>
                <li><a href="admin-kategori.php">Manajemen Kategori</a></li>
            </ul>
            
            <div class="user"><p style="font-size:15px;">Login Sebagai : <br><?php echo $_SESSION['user']; ?></p></div>
            <ul><li><a href="logout.php" class="logout">Logout</a></li></ul>
           
        </samping>
        
        <div style="position:fixed; left:250px; right:0; height:140px; top:0; background-color:#fff;"></div>
        <div style="position:fixed; left:300px; right:50px; height:5px; top:100px; background-color:#000;"></div>
        <p style="position:fixed; left:310px; right:50px; top:20px; font-size:50px; color:#000;">Manajemen Video</p>
    
        <div class="konten">      
            <table width="95%" border="2">
              <tbody>
                <tr>
                  <th onclick="#">Id</th>
                  <th onclick="#">Nama</th>
                  <th onclick="#">Kategori</th>
                  <th onclick="#">Tangal</th>
                  <th onclick="#">Deskripsi</th>
                  <th onclick="#">Lihat</th>
                  <th onclick="#">Manage</th>
                </tr>
                <?php
                   $i = 0; 
                   $sql = "select * from video";
                   $result=mysqli_query($con, $sql);
                   while($row = mysqli_fetch_assoc($result))
                   {
                    $i++;
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php $name=pathinfo($row['nama_v']); echo $name['basename']; ?></td>
                  <td><?php 
                        $sql = "select * from kategori where id_k=".$row['kategori_v'];
                        $result2=mysqli_query($con, $sql);
                        $namak = mysqli_fetch_assoc($result2);
                        echo $namak['nama_k'];
                      ?></td>
                  <td><?php echo $row['tanggal_v']; ?></td>
                  <td><?php echo $row['deskripsi_v']; ?></td>
                  <td><?php echo $row['lihat_v']; ?></td>
                  <td></td>
                </tr>
                <?php } ?>
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
                    $sql = "select * from kategori where id_k = 1";
                    $result=mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result)
                    ?>
                    <option value="<?php echo $row['id_k'] ?>"><?php echo $row['nama_k'] ?></option>
                    <?php 
                    $sql = "select * from kategori where id_k != 1 order by nama_k";
                    $result=mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                  ?>
                      <option value="<?php echo $row['id_k'] ?>"><?php echo $row['nama_k'] ?></option>
                  <?php } ?>
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