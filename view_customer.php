<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

?>
<?php

// include 'conn.php';

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     $sql = "SELECT * FROM customers WHERE id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $customer = $result->fetch_assoc();

//     if (!$customer) {
//         header("Location: all_customer.php");
//         exit;
//     }
// } else {
//     header("Location: all_customer.php");
//     exit;
// }

include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();

    if (!$customer) {
        header("Location: all_customer.php");
        exit;
    }

    $bookingsSql = "SELECT b.booking_id, e.event_name, e.location, b.booking_date, b.booking_status, b.qty, b.total
                    FROM bookings b
                    INNER JOIN events e ON b.event_id = e.id
                    WHERE b.customer_id = ?
                    ORDER BY b.booking_date DESC";
    $bookingsStmt = $conn->prepare($bookingsSql);
    $bookingsStmt->bind_param("i", $id);
    $bookingsStmt->execute();
    $bookingsResult = $bookingsStmt->get_result();
} else {
    header("Location: all_customer.php");
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
            <div class="container mt-4">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <?php if ($customer['image_path']) : ?>
                                            <img src="<?php echo htmlspecialchars($customer['image_path']); ?>" alt="Admin" class="rounded-circle" alt="Profile Image" width="150">
                                        <?php else : ?>
                                            No image available
                                        <?php endif; ?>
                                        <div class="mt-3">
                                            <h4><?php echo htmlspecialchars($customer['name']); ?></h4>
                                            <p class="text-secondary mb-1">Full Stack Developer</p>
                                            <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                            <button class="btn btn-primary">Follow</button>
                                            <button class="btn btn-outline-primary">Message</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($customer['name']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($customer['email']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Gender</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($customer['gender']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($customer['phone_no']); ?>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($customer['address']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">City</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($customer['city']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Pincode</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($customer['pincode']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="all_customer.php" class="btn btn-info">Back to List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="mb-4 text-secondary">Bookings by <?php echo htmlspecialchars($customer['name']); ?></h4>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Event Name</th>
                                            <th>Location</th>
                                            <th>Booking Date</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($bookingsResult->num_rows > 0) {
                                            while ($row = $bookingsResult->fetch_assoc()) {
                                                echo "<tr>
                                                <td>" . htmlspecialchars($row['booking_id']) . "</td>
                                                <td>" . htmlspecialchars($row['event_name']) . "</td>
                                                <td>" . htmlspecialchars($row['location']) . "</td>
                                                <td>" . htmlspecialchars($row['booking_date']) . "</td>
                                                <td>" . htmlspecialchars($row['booking_status']) . "</td>
                                                <td>" . htmlspecialchars($row['qty']) . "</td>
                                                <td>" . htmlspecialchars($row['total']) . "</td>
                                              </tr>";
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