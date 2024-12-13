<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = intval($_POST['booking_id']); // Sanitize booking ID
    $booking_status = mysqli_real_escape_string($conn, $_POST['booking_status']); // Sanitize status

    $updateQuery = "UPDATE bookings SET booking_status = ? WHERE booking_id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "si", $booking_status, $booking_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Booking status updated successfully.";
    } else {
        echo "Failed to update booking status.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
