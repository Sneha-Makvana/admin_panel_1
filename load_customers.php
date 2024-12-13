<?php

include 'conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$sql = "SELECT events.*, categories.category_name 
        FROM events 
        JOIN categories ON events.category_id = categories.id
        ORDER BY events.id DESC 
        LIMIT $offset, $limit";

$result = $conn->query($sql);
$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventImages = json_decode($row['event_images'], true);
        $firstImage = isset($eventImages[0]) ? $eventImages[0] : 'default.jpg';

        $events[] = [
            'id' => $row['id'],
            'event_name' => $row['event_name'],
            'location' => $row['location'],
            'booking_ticket' => $row['booking_ticket'],
            'no_of_tickets' => $row['no_of_tickets'],
            'category_name' => $row['category_name'],
            'event_image' => $firstImage,
        ];
    }
}

$sqlCount = "SELECT COUNT(*) AS total FROM events";
$countResult = $conn->query($sqlCount);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

echo json_encode([
    'events' => $events,
    'totalPages' => $totalPages,
]);

$conn->close();
?>

