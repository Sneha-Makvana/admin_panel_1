<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	include "links.php";
	?>
	<title>Tables</title>
	<!-- <link href="css/app.css" rel="stylesheet"> -->
</head>

<body>
	<div class="wrapper">
		<?php
		include "sidebar.php";
		?>

		<div class="main">
			<?php
			include "header.php";
			?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Tables</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<!-- ============================================================== -->
										<!-- basic table -->
										<!-- ============================================================== -->
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
											<div class="card">
												<h5 class="card-header">Basic Table</h5>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th scope="col" class="bg-dark text-light">#</th>
																<th scope="col" class="bg-dark text-light">First</th>
																<th scope="col" class="bg-dark text-light">Last</th>
																<th scope="col" class="bg-dark text-light">Handle</th>
															</tr>
														</thead>
														<tbody>
															<tr class="table-primary">
																<th scope="row">1</th>
																<td>Mark</td>
																<td>Otto</td>
																<td>@mdo</td>
															</tr>
															<tr class="table-primary">
																<th scope="row">2</th>
																<td>Jacob</td>
																<td>Thornton</td>
																<td>@fat</td>
															</tr>
															<tr class="table-primary">
																<th scope="row">3</th>
																<td>Larry</td>
																<td>the Bird</td>
																<td>@twitter</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- ============================================================== -->
										<!-- end basic table -->
										<!-- ============================================================== -->
										<!-- ============================================================== -->
										<!-- striped table -->
										<!-- ============================================================== -->
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
											<div class="card">
												<h5 class="card-header">Striped Table</h5>
												<div class="card-body">
													<table class="table table-striped">
														<thead>
															<tr>
																<th scope="col" class="bg-dark text-light">#</th>
																<th scope="col" class="bg-dark text-light">First</th>
																<th scope="col" class="bg-dark text-light">Last</th>
																<th scope="col" class="bg-dark text-light">Handle</th>
															</tr>
														</thead>
														<tbody>
															<tr class="table-info">
																<th scope="row">1</th>
																<td>Mark</td>
																<td>Otto</td>
																<td>@mdo</td>
															</tr>
															<tr class="table-info">
																<th scope="row">2</th>
																<td>Jacob</td>
																<td>Thornton</td>
																<td>@fat</td>
															</tr>
															<tr class="table-info">
																<th scope="row">3</th>
																<td>Larry</td>
																<td>the Bird</td>
																<td>@twitter</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- ============================================================== -->
										<!-- end striped table -->
										<!-- ============================================================== -->
									</div>
								</div>
								<div class="row">
									<!-- ============================================================== -->
									<!-- bordered table -->
									<!-- ============================================================== -->
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
										<div class="card">
											<h5 class="card-header">Bordered Table</h5>
											<div class="card-body">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th scope="col" class="bg-dark text-light">#</th>
															<th scope="col" class="bg-dark text-light">First</th>
															<th scope="col" class="bg-dark text-light">Last</th>
															<th scope="col" class="bg-dark text-light">Handle</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th scope="row">1</th>
															<td>Mark</td>
															<td>Otto</td>
															<td>@mdo</td>
														</tr>
														<tr>
															<th scope="row">2</th>
															<td>Jacob</td>
															<td>Thornton</td>
															<td>@fat</td>
														</tr>
														<tr>
															<th scope="row">3</th>
															<td colspan="2">Larry the Bird</td>
															<td>@twitter</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- ============================================================== -->
									<!-- end bordered table -->
									<!-- ============================================================== -->
									<!-- ============================================================== -->
									<!-- hoverable table -->
									<!-- ============================================================== -->
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
										<div class="card">
											<h5 class="card-header">Hoverable Table</h5>
											<div class="card-body">
												<table class="table table-hover table-success">
													<thead>
														<tr>
															<th scope="col" >#</th>
															<th scope="col" >First</th>
															<th scope="col" >Last</th>
															<th scope="col" >Handle</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th scope="row">1</th>
															<td>Mark</td>
															<td>Otto</td>
															<td>@mdo</td>
														</tr>
														<tr>
															<th scope="row">2</th>
															<td>Jacob</td>
															<td>Thornton</td>
															<td>@fat</td>
														</tr>
														<tr>
															<th scope="row">3</th>
															<td colspan="2">Larry the Bird</td>
															<td>@twitter</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- ============================================================== -->
									<!-- end hoverable table -->
									<!-- ============================================================== -->
								</div>
								<div class="row">
									<!-- ============================================================== -->
									<!-- contextual table -->
									<!-- ============================================================== -->
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
										<div class="card">
											<h5 class="card-header">Contextual classes</h5>
											<div class="card-body">
												<table class="table">
													<thead>
														<tr>
															<th scope="col" class="bg-dark text-light">#</th>
															<th scope="col" class="bg-dark text-light">First</th>
															<th scope="col" class="bg-dark text-light">Last</th>
															<th scope="col" class="bg-dark text-light">Handle</th>
														</tr>
													</thead>
													<tbody>
														<tr class="table-primary">
															<th scope="row">1</th>
															<td>Mark</td>
															<td>Otto</td>
															<td>@mdo</td>
														</tr>
														<tr class="table-success">
															<th scope="row">2</th>
															<td>Jacob</td>
															<td>Thornton</td>
															<td>@fat</td>
														</tr>
														<tr class="table-secondary">
															<th scope="row">3</th>
															<td colspan="2">Larry the Bird</td>
															<td>@twitter</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- ============================================================== -->
									<!-- end contextual table -->
									<!-- ============================================================== -->
									<!-- ============================================================== -->
									<!-- responsive table -->
									<!-- ============================================================== -->
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
										<div class="card">
											<h5 class="card-header">Responsive Table</h5>
											<div class="card-body">
												<div class="table table-striped">
													<table class="table">
														<thead>
															<tr>
																<th scope="col" class="bg-dark text-light">#</th>
																<th scope="col" class="bg-dark text-light">First</th>
																<th scope="col" class="bg-dark text-light">Last</th>
																<th scope="col" class="bg-dark text-light">Handle</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<th scope="row">1</th>
																<td>Mark</td>
																<td>Otto</td>
																<td>@mdo</td>
															</tr>
															<tr>
																<th scope="row">2</th>
																<td>Jacob</td>
																<td>Thornton</td>
																<td>@fat</td>
															</tr>
															<tr>
																<th scope="row">3</th>
																<td colspan="2">Larry the Bird</td>
																<td>@twitter</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
			</main>

			<?php
			include "footer.php";
			?>
		</div>
	</div>

	<?php
	include "flinks.php";
	?>
</body>

</html>