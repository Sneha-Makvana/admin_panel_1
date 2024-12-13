<?php

header('Content-Type: application/json');
include 'conn.php';

$response = array('success' => false, 'message' => '');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $checkBookings = "SELECT COUNT(*) FROM bookings WHERE customer_id = ?";
    $stmtCheck = mysqli_prepare($conn, $checkBookings);
    mysqli_stmt_bind_param($stmtCheck, "i", $id);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_bind_result($stmtCheck, $bookingCount);
    mysqli_stmt_fetch($stmtCheck);
    mysqli_stmt_close($stmtCheck);

    if ($bookingCount > 0) {
        $response['message'] = 'Cannot delete customer because there are bookings associated with it.';
    } else {
        $sql = "DELETE FROM customers WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = 'Customer deleted successfully.';
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







// include 'conn.php';

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     $sql = "DELETE FROM customers WHERE id = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $id);

//     if (mysqli_stmt_execute($stmt)) {
//         header("Location: all_customer.php");
//     } else {
//         echo "Error deleting record: " . mysqli_error($conn);
//     }

//     mysqli_stmt_close($stmt);
//     mysqli_close($conn);
// } else {
//     header("Location: all_customer.php");
// }

?>
