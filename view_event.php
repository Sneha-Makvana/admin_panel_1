<?php
session_start(); 

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

?>

<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT events.*, categories.category_name FROM events
            LEFT JOIN categories ON events.category_id = categories.id 
            WHERE events.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    if (!$event) {
        header("Location: all_events.php");
        exit;
    }
} else {
    header("Location: all_events.php");
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

        .event-images img {
            margin-top: 10px;
            max-width: 150px;
            max-height: 150px;
        }
    </style>
    <title>Event Details</title>

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

                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4 class="mb-4  text-secondary"> Event Details</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Event Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['event_name']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Description</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['description']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Location</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['location']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Start Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['start_date']); ?>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">End Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['end_date']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Booking Ticket Price</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['booking_ticket']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">No Of Ticket</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['no_of_tickets']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo htmlspecialchars($event['category_name']); ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Display Event Images -->
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Event Images</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary event-images">
                                            <?php
                                            $images = json_decode($event['event_images'], true);
                                            if ($images) {
                                                foreach ($images as $image) {
                                                    echo "<img src='" . htmlspecialchars($image) . "' alt='Event Image' class='mx-2 mb-2' width='150' height='150' >";
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
                                            <a href="all_events.php" class="btn btn-info">Back to List</a>
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