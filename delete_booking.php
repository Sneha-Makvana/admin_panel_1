<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $booking_id = intval($_POST['booking_id']);

    $deleteQuery = "DELETE FROM bookings WHERE booking_id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $booking_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Booking deleted successfully.";
    } else {
        echo "Failed to delete booking: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
