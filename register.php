<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	include "links.php";
	?>
	<title>Sign Up</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
	<style>
		.icons i {
			background: lightgray;
			padding: 8px;
			margin: 10px;
			font-size: 25px;
			border-radius: 25px;
		}
	</style>
</head>

<body>
	<!-- Login 7 - Bootstrap Brain Component -->
	<section class="vh-100">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col col-xl-10">
					<div class="card">
						<div class="row g-0">
							<div class="col-md-6 col-lg-5 d-none d-md-block">
								<img src="img/photos/login.webp" width="100%" height="600px" alt="login form" class="" style="border-radius: 1rem 0 0 1rem;" />
							</div>
							<div class="col-md-6 col-lg-7 d-flex align-items-center">
								<div class="card-body p-4 pb-lg-0 text-black">
									<form>
										<div class="d-flex align-items-center mb-3 pb-1">
											<img src="img/photos/logo.webp" alt="">
										</div>
										<h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign Up Your Account</h5>
										<div data-mdb-input-init class="form-outline mb-4">
											<label class="form-label" for="form2Example17">First Name</label>
											<input type="name" id="form2Example17" class="form-control form-control-lg" />

										</div>
										<div data-mdb-input-init class="form-outline mb-4">
											<label class="form-label" for="form2Example17">Last Name</label>
											<input type="email" id="form2Example17" class="form-control form-control-lg" />

										</div>
										<div data-mdb-input-init class="form-outline mb-4">
											<label class="form-label" for="form2Example17">Email address</label>
											<input type="email" id="form2Example17" class="form-control form-control-lg" />

										</div>

										<div data-mdb-input-init class="form-outline mb-4">
											<label class="form-label" for="form2Example27">Password</label>
											<input type="password" id="form2Example27" class="form-control form-control-lg" />
										</div>
										<div class="pt-1 mb-4">
											<button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="button">Sign Up</button>
										</div>
										<a class="small text-muted" href="#!">Forgot password?</a>
										<p class="mb-2 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="login.php" class="text-info">Login </a></p>
										<div class="text-center pe-4 icons mb-4 mt-3">
											<i class="ri-facebook-fill"></i><i class="ri-twitter-fill"></i><i class="ri-google-fill"></i>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	include "flinks.php";
	?>
	<!-- <script src="js/app.js"></script> -->

</body>

</html>