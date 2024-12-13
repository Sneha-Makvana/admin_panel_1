<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = $_POST['customer_id'];
    $events = json_decode($_POST['events'], true);

    $stmt = $conn->prepare("INSERT INTO bookings (customer_id, event_id, qty, total, booking_date) VALUES (?, ?, ?, ?, NOW())");
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("iiid", $customerId, $eventId, $qty, $total);

    foreach ($events as $event) {
        $eventId = $event['event_id'];
        $qty = $event['qty'];
        $price = $event['price'];
        $total = $qty * $price;

        if ($qty <= 0) {
            echo "Invalid quantity for event ID: $eventId";
            exit;
        }

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
            exit;
        }
    } 
    
    echo "Booking Successfully.";
    exit;
}

?>
