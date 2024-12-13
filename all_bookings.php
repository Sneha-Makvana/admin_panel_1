<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

?>

<?php
include 'conn.php';

$eventsQuery = "SELECT id, event_name, booking_ticket FROM events";
$eventsResult = mysqli_query($conn, $eventsQuery);

if (mysqli_num_rows($eventsResult) > 0) {
    $events = [];
    while ($row = mysqli_fetch_assoc($eventsResult)) {
        $events[] = $row;
    }
} else {
    echo "No events found!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <title>View All Bookings</title>
    <?php include "links.php"; ?>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main">
            <?php include "header.php"; ?>
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <a href="add_bookings.php"><button type="button" class="btn btn-info btn-lg float-end mt-2 mb-2">Add
                            Booking</button></a>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header text-secondary fs-4">All Bookings</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="bg-dark text-light">Customer Name</th>
                                                <th class="bg-dark text-light">Event Name</th>
                                                <th class="bg-dark text-light">Location</th>
                                                <th class="bg-dark text-light">Ticket Price</th>
                                                <th class="bg-dark text-light">Quantity</th>
                                                <th class="bg-dark text-light">Booking Date</th>
                                                <th class="bg-dark text-light">Total</th>
                                                <th class="bg-dark text-light">Booking Status</th>
                                                <th class="bg-dark text-light">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $bookingsQuery = "SELECT b.booking_id, b.qty, b.booking_date,b.booking_status, b.total, e.location, c.name AS customer_name, e.event_name, e.booking_ticket
                                                              FROM bookings b
                                                              INNER JOIN customers c ON b.customer_id = c.id
                                                              INNER JOIN events e ON b.event_id = e.id
                                                              ORDER BY b.booking_date DESC";
                                            $bookingsResult = mysqli_query($conn, $bookingsQuery);

                                            if (mysqli_num_rows($bookingsResult) > 0) {
                                                while ($row = mysqli_fetch_assoc($bookingsResult)) {
                                                    echo "<tr>
                                                            <td>" . $row['customer_name'] . "</td>
                                                            <td>" . $row['event_name'] . "</td>
                                                            <td>" . $row['location'] . "</td>
                                                            <td>$" . $row['booking_ticket'] . "</td>
                                                            <td>" . $row['qty'] . "</td>
                                                            <td>" . $row['booking_date'] . "</td>   
                                                            <td>$" . $row['total'] . "</td>
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
                                                }
                                            } else {
                                                echo "<tr><td colspan='8'>No bookings available</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        $(document).on('change', '.status-dropdown', function() {
            var bookingId = $(this).data('id');
            var newStatus = $(this).val();
            $.ajax({
                url: 'update_booking_status.php',
                type: 'POST',
                data: {
                    booking_id: bookingId,
                    booking_status: newStatus
                },
                success: function(response) {
                    alert(response);
                },
                error: function() {
                    alert("Failed to update booking status.");
                }
            });
        });
    </script>
</body>

</html>

<?php
mysqli_close($conn);
?>