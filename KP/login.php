<?php
  session_start();
  include 'connection.php';

  $login = isset($_GET['login']) ? $_GET['login']:"";
  if ($login=="1")
  {
    $l_username=$_POST['username'];
    $l_password=$_POST['password'];
    
    $sql = "select * from user where (username_u = '$l_username') AND (password_u = MD5('$l_password'))";
    $result=mysqli_query($con, $sql);
    
    if($row = mysqli_fetch_assoc($result))
    {
      $_SESSION['user']=$row['nama_u'];
      header("location:admin-user.php");
    }
    else
    {
      echo "<script type='text/javascript'>alert('Username atau password salah')</script>";
    }
  }
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="form">
      <ul class="tab-group">
		<div class="gambar">
        <img src="img/logo.png">
        </div>
        <div class="judul">
        <h1><b>Poltekkes Surakarta<b></h1>
        <h2>Library Integrated Online Services Video</h2>
        </div>
        <!-- <li class="tab active"><a href="#signup">Daftar</a></li> --> 
        <!--<li class="tab active"><a href="#login">Masuk</a></li> -->
      </ul>
      
      <div class="tab-content">       
        <div id="login">   
          <!--<h1>Masuk sebagai User</h1> -->
          
          <form action="?login=1" method="post">

            <div class="field-wrap">
            <label style="color:#A8A8A8">
              Username</span>
            </label>
            <input name="username" id="username" type="text" required autocomplete="off"/>
            </div>
          
          <div class="field-wrap">
            <label style="color:#A8A8A8">
              Password</span>
            </label>
            <input name="password" id="password" type="password" required autocomplete="off"/>
          </div>
         <!-- 
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          -->
          <input type="submit" value="Masuk" class="button button-block"/>
          
          </form>

        </div>
	     <div id="signup">   
         <!-- <h1>Daftar Akun User</h1>
          
          <form action="/" method="post">
          
          <div class="top-row">  
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off"/>
            </div>
          </div>
		   
          <div class="field-wrap">
            <label>
              Username</span>
            </label>
            <input type="username"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password</span>
            </label>
            <input type="password"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Ulangi Password</span>
            </label>
            <input type="password2"required autocomplete="off"/>
          </div>
          
          <button type="submit" class="button button-block"/>Daftar</button>
          
          </form>

        </div>
         --> 
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
