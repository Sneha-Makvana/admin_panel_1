<?php
session_start();

if (isset($_SESSION['logged_in'])) {
	header('Location: dashbord.php');
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	include "links.php";
	?>
	<title>Login</title>
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
								<img src="img/photos/login.webp" width="100%" height="500px" alt="login form" class="" style="border-radius: 1rem 0 0 1rem;" />
							</div>
							<div class="col-md-6 col-lg-7 d-flex align-items-center">
								<div class="card-body p-4 p-lg-5 text-black">
									<form id="loginForm" method="POST">
										<div class="d-flex align-items-center mb-3 pb-1">
											<img src="img/photos/logo.webp" alt="">
										</div>
										<h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
										<div data-mdb-input-init class="form-outline mb-4">
											<label class="form-label" for="username">Email address</label>
											<input type="text" id="username" name="username" class="form-control form-control-lg" />
											<span id="usernameError" class="text-danger small"></span>
										</div>

										<div data-mdb-input-init class="form-outline mb-4">
											<label class="form-label" for="password">Password</label>
											<input type="password" id="password" name="password" class="form-control form-control-lg" />
											<span id="passwordError" class="text-danger small"></span>
										</div>

										<div class="text-danger error-msg mb-2"></div> <!-- General error message -->

										<div class="pt-1 mb-4">
											<button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">
												Login
											</button>
										</div>

										<a class="small text-muted" href="#!">Forgot password?</a>
										<p class="mb-2 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register.php" class="text-info">Register</a></p>
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			// On form submit
			$('#loginForm').on('submit', function(e) {
				e.preventDefault(); // Prevent default form submission

				// Clear any previous error messages
				$('.error-msg').text('');

				// Get form data
				let username = $('#username').val().trim();
				let password = $('#password').val().trim();
				let isValid = true;

				// Validate username
				if (username === '') {
					$('#usernameError').text('Username is required');
					isValid = false;
				}

				// Validate password
				if (password === '') {
					$('#passwordError').text('Password is required');
					isValid = false;
				}

				if (isValid) {
					// Send AJAX request
					$.ajax({
						url: 'login_handler.php', // URL to PHP handler
						type: 'POST',
						dataType: 'json',
						data: {
							username: username,
							password: password
						},
						success: function(response) {
							if (response.success) {
								// Redirect on successful login
								window.location.href = 'dashbord.php';
							} else {
								// Show error message
								$('.error-msg').text(response.message);
							}
						},
						error: function() {
							$('.error-msg').text('An error occurred. Please try again.');
						}
					});
				}
			});
		});
	</script>

</body>

</html>

