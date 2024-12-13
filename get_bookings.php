<?php
include 'conn.php';

$eventsQuery = "
    SELECT e.event_name, e.location, e.booking_ticket, b.total, e.category_id, b.booking_date, b.qty, c.name AS customer_name, c.phone_no, c.city, categories.category_name 
    FROM bookings b
    INNER JOIN customers c ON b.customer_id = c.id
    INNER JOIN events e ON b.event_id = e.id
    INNER JOIN categories ON e.category_id = categories.id";

$eventsResult = mysqli_query($conn, $eventsQuery);

$events = [];
while ($row = mysqli_fetch_assoc($eventsResult)) {
    $events[] = [
        'title' => $row['event_name'],
        'start' => $row['booking_date'],
        'extendedProps' => [
            'customerName' => $row['customer_name'],
            'bookingQty' => $row['qty'],
            'customerPhone' => $row['phone_no'],
            'customerCity' => $row['city'],
            'eventPrice' => $row['booking_ticket'],
            'eventLocation' => $row['location'],
            'eventCategory' => $row['category_name'],
            'bookingTotal' => $row['total'],
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($events);
?>
