<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

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
    <script src="https://unpkg.com/feather-icons"></script>

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
                                    <table class="table table-hover table-bordered" id="myTable">
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
                                            <?php

                                            include 'conn.php';

                                            $sql = "SELECT * FROM customers ORDER BY id DESC";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr id='row_" . $row['id'] . "'>";
                                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['phone_no']) . "</td>";
                                                    echo "<td>
                                                            <a href='view_customer.php?id=" . $row['id'] . "'><i class='align-middle me-2' data-feather='eye'></i></a>
                                                            <a href='edit_customer.php?id=" . $row['id'] . "'><i class='align-middle me-2' data-feather='edit'></i></a>
                                                            <a href='javascript:void(0);' onclick='confirmDelete(" . $row['id'] . ")'><i class='align-middle me-2' data-feather='trash-2'></i></a>
                                                          </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                                            }

                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
            if (confirm('Are you sure you want to delete this event?')) {
                $.ajax({
                    url: 'delete_customer.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('Customer deleted successfully');
                            location.reload();
                        } else {
                            alert('Cannot delete Customer because there are bookings associated with it.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        alert('An error occurred while deleting the event.');
                    }
                });
            }
        }
    </script>
</body>
</html>