<?php

// include 'conn.php';

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     $deleteBookings = "DELETE FROM bookings WHERE event_id = ?";
//     $stmtBookings = mysqli_prepare($conn, $deleteBookings);
//     mysqli_stmt_bind_param($stmtBookings, "i", $id);
//     mysqli_stmt_execute($stmtBookings);
//     mysqli_stmt_close($stmtBookings);

//     $sql = "DELETE FROM events WHERE id = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $id);

//     if (mysqli_stmt_execute($stmt)) {
//         header("Location: all_events.php");
//     } else {
//         echo "Error deleting record: " . mysqli_error($conn);
//     }

//     mysqli_stmt_close($stmt);
//     mysqli_close($conn);
// } else {
//     header("Location: all_events.php");
// }


header('Content-Type: application/json');
include 'conn.php';

$response = array('success' => false, 'message' => '');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $checkBookings = "SELECT COUNT(*) FROM bookings WHERE event_id = ?";
    $stmtCheck = mysqli_prepare($conn, $checkBookings);
    mysqli_stmt_bind_param($stmtCheck, "i", $id);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_bind_result($stmtCheck, $bookingCount);
    mysqli_stmt_fetch($stmtCheck);
    mysqli_stmt_close($stmtCheck);

    if ($bookingCount > 0) {
        $response['message'] = 'Cannot delete event because there are bookings associated with it.';
    } else {

        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = 'Event deleted successfully.';
        } else {
            $response['message'] = 'Error deleting record: ' . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
} else {
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
