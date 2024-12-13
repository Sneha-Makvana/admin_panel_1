<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

include 'conn.php';

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    $sql = "SELECT b.booking_id, e.event_images, b.qty, b.booking_status, b.booking_date, b.total, e.location, 
                   c.name AS customer_name, e.event_name, e.booking_ticket, b.customer_id
            FROM bookings b
            INNER JOIN customers c ON b.customer_id = c.id
            INNER JOIN events e ON b.event_id = e.id
            WHERE b.booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if (!$booking) {
        header("Location:all_booking.php");
        exit;
    }
} else {
    header("Location:all_booking.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php
    include "links.php";
    ?>
    <style>
        body {
            /* margin-top: 20px; */
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
    </style>
    <title>Profile</title>

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
            <div class="container">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-7">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4 class="mb-4  text-secondary">Booking Details</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Customer Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['customer_name']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Event Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['event_name']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Location</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['location']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Ticket Price</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['booking_ticket']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Quality</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['qty']); ?>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Booking Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['booking_date']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Booking Status</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['booking_status']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Total</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($booking['total']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Event Images</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
                                            $images = json_decode($booking['event_images'], true);
                                            if ($images) {
                                                foreach ($images as $image) {
                                                    echo "<img src='" . htmlspecialchars($image) . "' alt='Event Image' class='mx-2 mb-2' width='180' height='150'>";
                                                }
                                            } else {
                                                echo "<p>No images available</p>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="all_bookings.php" class="btn btn-info">Back to List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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