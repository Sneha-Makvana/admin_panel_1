<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
	header('Location: login.php');
	exit();
}

?>

<?php
include 'conn.php';

$totalEventsQuery = "SELECT COUNT(*) AS total_events FROM events";
$totalCustomersQuery = "SELECT COUNT(*) AS total_customers FROM customers";
$totalBookingsQuery = "SELECT COUNT(*) AS total_bookings FROM bookings";

$totalEventsResult = mysqli_query($conn, $totalEventsQuery);
$totalCustomersResult = mysqli_query($conn, $totalCustomersQuery);
$totalBookingsResult = mysqli_query($conn, $totalBookingsQuery);

$totalEvents = mysqli_fetch_assoc($totalEventsResult)['total_events'];
$totalCustomers = mysqli_fetch_assoc($totalCustomersResult)['total_customers'];
$totalBookings = mysqli_fetch_assoc($totalBookingsResult)['total_bookings'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
	<title>Event Management System</title>
	<?php include "links.php"; ?>
	<style>
		#calendar1 {
			height: 600px;
			width: 800px;
			margin: auto;
		}

		.custom-event {
			border: none;
			font-weight: bold;
			background-color: lightgray !important;
			color: #ffffff !important;
			border-radius: 5px;
			padding: 2px;
			text-align: center;
		}
	</style>
</head>

<body>

	<div class="wrapper">
		<?php include "sidebar.php"; ?>
		<div class="main">
			<?php include "header.php"; ?>
			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<div class="row">
						<div class="col-xl-12 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-4">
										<div class="card bg-info-subtle">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<a href="all_events.php" style="text-decoration: none;">
															<h5 class="text-secondary fs-4">Events</h5>
														</a>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= htmlspecialchars($totalEvents); ?></h1>
												<div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card bg-success-subtle">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<a href="all_customer.php" style="text-decoration: none;">
															<h5 class="text-secondary fs-4">Customers</h5>
														</a>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= htmlspecialchars($totalCustomers); ?></h1>
												<div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card bg-primary-subtle">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<a href="all_bookings.php" style="text-decoration: none;">
															<h5 class="text-secondary fs-4">Bookings</h5>
														</a>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= htmlspecialchars($totalBookings); ?></h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-9 d-flex">
							<!-- <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1"> -->
							<div class="card flex-fill">
								<div class="card-header bg-secondary-subtle">
									<h5 class="text-secondary fs-4 mb-0"><strong>Event</strong> Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<!-- <div class="chart"> -->
										<div id='calendar1'></div>
										<!-- </div> -->
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header bg-secondary-subtle">
									Event Name: <h5 class="modal-title" id="modalEventTitle"> </h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											<p><strong>Customer Name:</strong> <span id="modalCustomerName"></span></p>
											<hr>
											<p><strong>Event Price:</strong> <span id="modalEventPrice"></span></p>
											<hr>
											<p><strong>Booking Qty:</strong> <span id="modalBookingQty"></span></p>
											<hr>
											<p><strong>Event Category:</strong> <span id="modalEventCategory"></span></p>
										</div>
										<div class="col-md-6">
											<p><strong>Customer Phone:</strong> <span id="modalCustomerPhone"></span></p>
											<hr>
											<p><strong>Event Location:</strong> <span id="modalEventLocation"></span></p>
											<hr>
											<p><strong>Booking Date:</strong> <span id="modalBookingDate"></span></p>
											<hr>
											<p><strong>Total Price:</strong> <span id="modalBookingTotal"></span></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-9 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h5 class="text-secondary fs-4 mb-0">Latest Bookings</h5>
								</div>
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th class="bg-dark text-light">No.</th>
											<th class="bg-dark text-light">Customer Name</th>
											<th class="bg-dark text-light">Event Name</th>
											<th class="bg-dark text-light">Location</th>
											<th class="bg-dark text-light">Category</th>
											<th class="bg-dark text-light">Ticket Price</th>
											<th class="bg-dark text-light">Quantity</th>
											<!-- <th class="bg-dark text-light">Booking Date</th> -->
											<th class="bg-dark text-light">Booking Status</th>
											<th class="bg-dark text-light">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php

										$bookingsQuery = "SELECT b.booking_id, b.qty,b.booking_date,b.booking_status, b.total,e.category_id, e.location, b.booking_date, c.name AS customer_name, e.event_name, e.booking_ticket, categories.category_name as category_name
                                                              FROM bookings b
                                                              INNER JOIN customers c ON b.customer_id = c.id
                                                              INNER JOIN events e ON b.event_id = e.id
                                                              INNER JOIN categories ON e.category_id = categories.id
                                                              ORDER BY b.booking_date DESC";
										$bookingsResult = mysqli_query($conn, $bookingsQuery);

										$count = 1;
										if (mysqli_num_rows($bookingsResult) > 0) {
											while ($row = mysqli_fetch_assoc($bookingsResult)) {
												echo "<tr>
														<td>" . $count . "</td>
                
                                                            <td>" . $row['customer_name'] . "</td>
                                                            <td>" . $row['event_name'] . "</td>
                                                            <td>" . $row['location'] . "</td>
                                                            <td>" . $row['category_name'] . "</td>
                                                            <td>" . $row['booking_ticket'] . "</td>
                                                            <td>" . $row['qty'] . "</td>
                                                            
															<td>
                                                            <select class='status-dropdown' data-id='" . $row['booking_id'] . "'>
                                                            <option value='Pending' style='color: gray;' " . ($row['booking_status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                                            <option value='Processing' style='color: blue;' " . ($row['booking_status'] == 'Processing' ? 'selected' : '') . ">Processing</option>
                                                            <option value='Delivered' style='color: green;' " . ($row['booking_status'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                                                            <option value='Confirmed' style='color: orange;' " . ($row['booking_status'] == 'Confirmed' ? 'selected' : '') . ">Confirmed</option>
                                                            <option value='Cancelled' style='color: red;' " . ($row['booking_status'] == 'Cancelled' ? 'selected' : '') . ">Cancelled</option>
                                                            </select>
                                            				</td>
															<td>
															<a href='view_booking.php?id=" . $row['booking_id'] . "'>
															<i class='align-middle me-2' data-feather='eye'></i>
															</a>
															<a href='javascript:void(0)'>
															<i class='align-middle me-2 delete-btn' data-id='" . $row['booking_id'] . "' data-feather='trash-2'></i>
															</a>
															</td>
                                                           
                                                            
                                                        </tr>";
												$count++;
											}
										} else {
											echo "<tr><td colspan='7'>No bookings available</td></tr>";
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php include "footer.php"; ?>
		</div>
	</div>
	<?php include "flinks.php"; ?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).on('click', '.delete-btn', function() {
			var bookingId = $(this).data('id');
			var row = $(this).closest('tr');
			if (confirm("Are you sure you want to delete this booking?")) {
				$.ajax({
					url: 'delete_booking.php',
					type: 'POST',
					data: {
						booking_id: bookingId
					},
					success: function(response) {
						alert(response);
						if (response.trim() === "Booking deleted successfully.") {
							row.remove();
						}
					},
					error: function() {
						alert("There was an error deleting the booking.");
					}
				});
			}
		});
	</script>
</body>

</html>