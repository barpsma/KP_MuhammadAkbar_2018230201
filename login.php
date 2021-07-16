<!DOCTYPE html>
<html>
<head>
	<title>Login Ananda Motor</title>
	<style type="text/css">
		body {
			background-color: #DDDDDD;
			font-family: "Segoe UI";
		}
		#wrapper {
			background-color: #fff;
			width: 400px;
			height: 330px;
			margin-top: 60px;
			margin-left: auto;
			margin-right: auto;
			padding: 20px;
			border-radius: 4px;
		}
		input[type=text], input[type=password] {
			border: 1px solid #ddd;
			padding: 10px;
			width: 95%;
			border-radius: 2px;
			outline: none;
			margin-top: 10px;
			margin-bottom: 20px;
		}
		label, h1 {
			text-transform: uppercase;
			font-weight: bold;
		}
		h1 {
			text-align: center;
			font-size: 40px;
			color: #355c7d;
		}
		button {
			border-radius: 2px;
			padding: 10px;
			width: 120px;
			background-color: #355c7d;
			border: none;
			color: #fff;
			font-weight: bold;
		}

        button:hover{
            background-color: #e23e57;
            cursor: pointer;
        }
		.error {
			background-color: #e23e57;
			width: 400px;
			height: auto;
			margin-top: 20px;
			margin-left: auto;
			margin-right: auto;
			padding: 20px;
			border-radius: 4px;
			color: #fff;

		}

        .kembali button{
            background-color: #355c7d;
        }

        .kembali button a{
            text-decoration: none;
            color: #ffffff;
        }

        .kembali button:hover{
            cursor: pointer;
            background-color:  #e23e57;
        }

		.daftar a{
			color : #355c7d;
			text-decoration: none;
		}

		.daftar a:hover{
			color : #e23e57;
			text-decoration: underline;
		}
	</style>
</head>
<body>
    <div class="kembali">
    <button type="submit"><a href="index.html">Kembali</a></button>
    </div>
	<div id="wrapper">
		<form action="logincontroller.php" method="POST">
			<h1>Login</h1>
			<label>Username</label>
			<input type="text" name="username" placeholder="masukkan username" required="" autofocus="">
			<label>Password </label>
			<input type="password" name="password" placeholder="masukkan password" required="" >
			<button type="submit">LOGIN</button> 
			<div class="daftar"><a href="register.php">belum punya akun?</a></div>
		</form>
	</div>
		<?php if(isset($_GET['pesan'])) { ?>
			<div class="error">
				<label><?php echo $_GET['pesan']; ?></label>
			</div>
		<?php } ?>
</body>
</html>