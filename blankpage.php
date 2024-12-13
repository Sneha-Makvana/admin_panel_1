<!-- CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    gender ENUM('male', 'female') NOT NULL,
    address TEXT,
    city VARCHAR(100),  
    pincode VARCHAR(6),
    phone_no VARCHAR(10) NOT NULL,
    image_path VARCHAR(255),
    terms_accepted BOOLEAN NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_name` VARCHAR(255) NOT NULL
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    event_name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    booking_ticket DECIMAL(10, 2) NOT NULL,
    no_of_tickets INT NOT NULL,
    event_images VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);


CREATE TABLE Bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    customer_id INT NOT NULL,
    booking_date TIMESTAMP NOT NULL,
    qty INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(id),
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

-->
<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

include 'conn.php';

// Set the number of records to display per page
$results_per_page = 5;

// Find the total number of records in the table
$sql = "SELECT COUNT(id) AS total FROM customers";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_results = $row['total'];

// Calculate the total number of pages needed
$total_pages = ceil($total_results / $results_per_page);

// Get the current page or set to 1 if not present
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $total_pages)); // Ensure the page number is within bounds

// Calculate the starting limit for the results to display on the current page
$starting_limit = ($page - 1) * $results_per_page;

// Retrieve the current page's customers from the database
$sql = "SELECT * FROM customers ORDER BY id DESC LIMIT $starting_limit, $results_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View All Customers</title>
    <?php include "links.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main">
            <?php include "header.php"; ?>
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="mt-2">
                        <a href="add_customer.php">
                            <button type="button" class="btn btn-info btn-lg float-end mb-2">Add Customer</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header text-secondary fs-4">All Customers</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="bg-dark text-light">Name</th>
                                                <th class="bg-dark text-light">Email</th>
                                                <th class="bg-dark text-light">Address</th>
                                                <th class="bg-dark text-light">Phone No.</th>
                                                <th class="bg-dark text-light">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result->num_rows > 0): ?>
                                                <?php while ($row = $result->fetch_assoc()): ?>
                                                    <tr id='row_<?= $row['id'] ?>'>
                                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                                        <td><?= htmlspecialchars($row['address']) ?></td>
                                                        <td><?= htmlspecialchars($row['phone_no']) ?></td>
                                                        <td>
                                                            <a href='view_customer.php?id=<?= $row['id'] ?>'><i class='align-middle me-2' data-feather='eye'></i></a>
                                                            <a href='edit_customer.php?id=<?= $row['id'] ?>'><i class='align-middle me-2' data-feather='edit'></i></a>
                                                            <a href='javascript:void(0);' onclick='confirmDelete(<?= $row['id'] ?>)'><i class='align-middle me-2' data-feather='trash-2'></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr><td colspan='5' class='text-center'>No records found</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination Links -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item"><a class="page-link" href="all_customer.php?page=<?= $page - 1 ?>">Previous</a></li>
                                        <?php endif; ?>
                                        
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                                <a class="page-link" href="all_customer.php?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $total_pages): ?>
                                            <li class="page-item"><a class="page-link" href="all_customer.php?page=<?= $page + 1 ?>">Next</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include "flinks.php"; ?>

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this customer?')) {
                $.ajax({
                    url: 'delete_customer.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response && response.success) {
                            $('#row_' + id).remove();
                            alert('Customer deleted successfully');
                        } else {
                            alert(response.message || "Unknown error occurred.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        }
    </script>
</body>

</html>
<?php $conn->close(); ?>
