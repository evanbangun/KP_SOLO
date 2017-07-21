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
  $ubah = isset($_GET['ubah']) ? $_GET['ubah']:"";
  $hapus = isset($_GET['hapus']) ? $_GET['hapus']:"";
  if(isset($hapus))
  {
    $sql = "select * from user where id_u = '$hapus'";
    $result=mysqli_query($con, $sql);
    if($cekhapus = mysqli_fetch_assoc($result))
    {
      $sql = "delete from user where id_u = '$hapus'";
      $result=mysqli_query($con, $sql);
      $sql = "update video set user_v=1 where user_v = '$hapus'";
      $result=mysqli_query($con, $sql);
      $successhapus=1;
    }
  }
  $tambah = isset($_GET['tambah']) ? $_GET['tambah']:"";
  if ($tambah=="1")
  {
    $t_username=$_POST['username'];
    $t_password=$_POST['password'];
    $t_password2=$_POST['password2'];
    $t_nama=$_POST['nama'];
    
    $sql = "select * from user where username_u = '$t_username'";
    $result=mysqli_query($con, $sql);
    
    if($row = mysqli_fetch_assoc($result))
    {
      $success = 3;
    }
    else
    {
      if($t_password != $t_password2)
      {
        $success = 2;
      }
      else
      {
        $sql = "insert into user(id_u, username_u, password_u, nama_u) VALUES ('','$t_username',md5('$t_password'),'$t_nama')";
        $result=mysqli_query($con, $sql);
        $success = 1;
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
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
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
            elseif ($success == 1)
            {
        ?>   
              <div class="alertsuccess">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>User Berhasil Ditambah</strong>
              </div>
        <?php 
            }
          }
          else if($ubah == "1")
          {
        ?>
              <div class="alertsuccess">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>User Berhasil Diubah</strong>
              </div>
        <?php
          }
          else if(isset($successhapus))
          {
        ?>
              <div class="alertsuccess">
                <span class="closebtnalert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>User Berhasil Dihapus</strong>
              </div>
        <?php
          } 
        ?>
            <table width="80%" border="2">
              <tbody>
                <tr>
                  <th onclick="#">Username</th>
                  <th onclick="#">Password (Encrypted)</th>
                  <th onclick="#">Nama</th>
                  <th onclick="#">Manage</th>
                </tr>
                <?php 
                   $sql = "select * from user where id_u != 1";
                   $result=mysqli_query($con, $sql);
                   while($row = mysqli_fetch_assoc($result))
                   {
                ?>
                <tr>
                  <td><?php echo $row['username_u']; ?></td>
                  <td><?php echo $row['password_u']; ?></td>
                  <td><?php echo $row['nama_u']; ?></td>
                  <td>
                    <a href="admin-user_edit.php?idu=<?php echo $row['id_u']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <?php echo "<a onClick=\"javascript: return confirm('Yakin Ingin Menghapus $row[username_u] ?');\" href='admin-user.php?hapus=".$row['id_u']."'><i class='fa fa-times' aria-hidden='true' style='padding-left:10px'></i></a>"; ?>
                    </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            
            <button id="tambah-user" style="background-color:#fff; margin-top:10px; color:#000;">Tambah User</button></a>            
        </div>
    
	    <div id="myModal" class="modal">
		
        <!-- Modal content -->
            <div class="modal-content" style="height:430px;">
            	<span class="close">&times;</span>
                <form action="?tambah=1" method="post" class="col-md-4 col-lg-push-4" style="margin-top:50px">
                  	Username<br><input id="username" name="username" placeholder="Username" class="form-control input-md" type="text" required="" style="margin-bottom:20px;">
                   	Password<br><input id="password" name="password" placeholder="Password" class="form-control input-md" type="password" required="" style="margin-bottom:20px;">
                    Ulangi Password<input id="password2" name="password2" placeholder="Ulangi Password" class="form-control input-md" type="password" style="margin-bottom:20px;">
                    Nama<br><input id="nama" name="nama" placeholder="Nama" class="form-control input-md" type="text" required="" style="margin-bottom:20px;">
                  	<input type="submit" value="Tambah" class="btn btn-primary">
                </form>
      		</div>
        </div>
            
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
   <script>
      function myFunction()
      {
        var txt;
        if (confirm("Yakin Ingin Menghapus ?") == true)
        {
            txt = "You pressed OK!";
        }
        else
        {
            txt = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = txt;
      }
    </script>

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