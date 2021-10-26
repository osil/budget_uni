<?php
session_start();
include "./config/global.php";
include "./config/database.php";
?>
<!doctype html>
<html lang="th">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta -->
	<meta name="description" content="Priject Request RMU">
	<meta name="author" content="Avenger Team">
	<link rel="shortcut icon" href="img/fav.png" />

	<!-- Title -->
	<title><?php echo $_CONFIG["system_name"]; ?> : เข้าสู่ระบบ</title>


	<!-- *************
			************ Common Css Files *************
		************ -->
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Main css -->
	<link rel="stylesheet" href="css/main.css">


	<!-- *************
			************ Vendor Css Files *************
		************ -->

	<style>
		body.authentication {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			background: url('./img/bg-02.jpeg') no-repeat;
			background-size: cover;
			background-attachment: fixed;
			overflow: auto;
		}
	</style>

</head>

<body class="authentication">

	<!-- Loading wrapper start -->
	<div id="loading-wrapper">
		<div class="spinner-border"></div>
		กำลังโหลดข้อมูล ...
	</div>
	<!-- Loading wrapper end -->

	<!-- *************
			************ Login container start *************
		************* -->
	<div class="login-container">

		<div class="container-fluid h-100">

			<!-- Row start -->
			<div class="row g-0 h-100">
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
					<div class="login-about">
						<div class="slogan">

							<span><?php echo $_CONFIG["system_name"]; ?></span>
						</div>
						<div class="about-desc">
							ในปีงบประมาณ 2565 เป็นต้นไป การส่งคำขอโครงการต่างๆ หน่วยงานจะต้องทำการบันทึกข้อมูลผ่านระบบเท่านั้น เพื่อความสะดวกและความถูกต้องของข้อมูล
						</div>
						<!-- <a href="#" class="know-more">Know More <img src="img/right-arrow.svg" alt="Uni Pro Admin"></a> -->

					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
					<div class="login-wrapper">
						<form action="script-login.php" method="post">
							<div class="login-screen">
								<div class="login-body">
									<div class="text-center">

										<img src="img/rmu-logo.png" class="mb-3" alt="LOGO" style="width: 80px;">
										<h6>เข้าสู่ระบบด้วยรหัสผ่านของท่าน<br></h6>

									</div>

									<div class="field-wrapper">
										<input type="text" name="username" autocomplete="false" autofocus required>
										<div class="field-placeholder">ชื่อผู้ใช้</div>
									</div>
									<div class="field-wrapper mb-3">
										<input type="password" name="password" required>
										<div class="field-placeholder">รหัสผ่าน</div>
									</div>
									<div class="actions">
										<a href="#">ลืมรหัสผ่าน ?</a>
										<button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
									</div>
								</div>
								<div class="login-footer">
									<span class="additional-link">ไม่มีบัญชีเข้าใช้งาน กรุณาติดต่อกองนโยบายและแผน</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Row end -->

		</div>
	</div>
	<!-- *************
			************ Login container end *************
		************* -->

	<!-- *************
			************ Required JavaScript Files *************
		************* -->
	<!-- Required jQuery first, then Bootstrap Bundle JS -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/modernizr.js"></script>
	<script src="js/moment.js"></script>

	<!-- *************
			************ Vendor Js Files *************
		************* -->

	<!-- Main Js Required -->
	<script src="js/main.js"></script>

</body>

</html>