<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

?>
<?php
include 'conn.php';

$customerSql = "SELECT id, name FROM customers";
$customerResult = mysqli_query($conn, $customerSql);

$eventSql = "SELECT id, event_name, booking_ticket FROM events";
$eventResult = mysqli_query($conn, $eventSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booking Model</title>
    <?php include "links.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #eventTableContainer {
            display: none;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main">
            <?php include "header.php"; ?>
            <main class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">

                    <div class="row">
                        <div class="col-12 col-lg-6 mx-5 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <label for="name">Customers</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i data-feather="user-plus"></i>
                                            </span>
                                        </div>
                                        <select id="customer" name="customer_id" class="form-control" required onchange="disableCustomerSelect()">
                                            <option value="">Select Customer</option>
                                            <?php while ($customer = mysqli_fetch_assoc($customerResult)) { ?>
                                                <option value="<?php echo $customer['id']; ?>">
                                                    <?php echo $customer['name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label for="name">Events</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i data-feather="file-plus"></i>
                                            </span>
                                        </div>
                                        <select id="event" name="event_id" class="form-control" required>
                                            <option value="">Select Event</option>
                                            <?php while ($event = mysqli_fetch_assoc($eventResult)) { ?>
                                                <option value="<?php echo $event['id']; ?>" data-price="<?php echo $event['booking_ticket']; ?>" data-name="<?php echo $event['event_name']; ?>">
                                                    <?php echo $event['event_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <button type="button" class="btn btn-info btn-lg " id="addMoreBtn">Add More</button>
                                    <div id="message" style="color: red;"></div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-lg-10 mx-5 mt-5">
                            <div class="card">
                                <h5 class="card-header fs-4 text-center">Events Bookings</h5>
                                <div class="card-body">
                                    <div class="table table-striped table-hover table-bordered" id="eventTableContainer">
                                        <table class="table" id="eventTable">
                                            <thead>
                                                <tr>
                                                    <th class="bg-dark text-light">Event Name</th>
                                                    <th class="bg-dark text-light">Price</th>
                                                    <th class="bg-dark text-light">Qty</th>
                                                    <th class="bg-dark text-light">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-right"><strong>Total Price:</strong></td>
                                                    <td id="totalPrice">$0</td>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                    </div>
                                    <div class="text-right">
                                        <strong>Total Price:</strong> <span id="totalPrice">0</span>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-info btn-lg float-end" id="submitBookingBtn">Submit</button>
                                    </div>
                                    <div id="messageContainer" class="text d-none" role="text"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include "flinks.php"; ?>

    <script>
        $('#addMoreBtn').click(function() {
            var eventSelect = $('#event');
            var eventId = eventSelect.val();
            var eventName = eventSelect.find('option:selected').text();
            var eventPrice = parseFloat(eventSelect.find('option:selected').data('price')) || 0;

            if (eventId !== '') {
                var eventExists = false;

                $('#eventTable tbody tr').each(function() {
                    var row = $(this);
                    if (row.find('td:eq(0)').data('event-id') == eventId) {
                        eventExists = true;

                        var qtyInput = row.find('.qtyInput');
                        var currentQty = parseInt(qtyInput.val()) || 0;
                        var newQty = currentQty + 1;
                        qtyInput.val(newQty);

                        var newTotal = eventPrice * newQty;
                        row.find('.totalCell').text('$' + newTotal.toFixed(2));

                        calculateTotal();

                        $('#message').text("");
                        return false;
                    }
                });

                var customerExists = $('#customer').val();
                if (customerExists === '') {
                    $('#message').removeClass('d-none text-success').addClass('text-danger');
                    $('#message').text("Please select a customer.");
                    return;
                }

                if (!eventExists) {
                    var newRow = `
                <tr>
                    <td data-event-id="${eventId}">${eventName}</td>
                    <td>$${eventPrice.toFixed(2)}</td>
                    <td>
                        <input 
                            type="number" 
                            class="w-25 form-control qtyInput" 
                            value="1"
                            min="1"
                            data-price="${eventPrice}">
                    </td>
                    <td class="totalCell">$${eventPrice.toFixed(2)}</td>
                </tr>`;

                    $('#eventTable tbody').append(newRow);
                    calculateTotal();

                    $('#eventTableContainer').show();
                }
            } else {
                $('#message').text("Please select an Event.");
            }
        });

        $(document).on('input', '.qtyInput', function() {
            var row = $(this).closest('tr');
            var price = parseFloat($(this).data('price')) || 0;
            var qty = parseInt($(this).val()) || 0;
            var total = price * qty;

            row.find('.totalCell').text('$' + total.toFixed(2));
            calculateTotal();
        });

        function calculateTotal() {
            var totalPrice = 0;
            $('#eventTable tbody tr').each(function() {
                var rowTotal = parseFloat($(this).find('.totalCell').text().replace('$', '')) || 0;
                totalPrice += rowTotal;
            });

            $('#totalPrice').text('$' + totalPrice.toFixed(2));
        }

        function disableCustomerSelect() {
            var customerSelect = document.getElementById('customer');
            if (customerSelect.value !== "") {
                customerSelect.disabled = true;
                $('#message').text("");
            }
        }

        $('#submitBookingBtn').click(function() {
            var customerId = $('#customer').val();
            if (customerId === '') {
                $('#message').removeClass('d-none text-success').addClass('text-danger');
                $('#message').text("Please select a customer.");
                return;
            }

            var selectedEvents = [];
            var isValid = true;

            $('#eventTable tbody tr').each(function() {
                var eventId = $(this).find('td:eq(0)').data('event-id');
                var price = parseFloat($(this).find('td:eq(1)').text().replace('$', ''));
                var qty = parseInt($(this).find('.qtyInput').val());

                if (!qty || qty <= 0) {
                    isValid = false;
                    $(this).find('.qtyInput').addClass('is-invalid');
                } else {
                    $(this).find('.qtyInput').removeClass('is-invalid');
                }

                var total = parseFloat($(this).find('td:eq(3)').text().replace('$', ''));

                if (qty > 0) {
                    selectedEvents.push({
                        event_id: eventId,
                        price: price,
                        qty: qty,
                        total: total
                    });
                }
            });

            if (!isValid) {
                $('#messageContainer').removeClass('d-none text-success').addClass('text-danger');
                $('#messageContainer').text("Please enter qty.");
                return;
            }

            $.ajax({
                url: 'submit_booking.php',
                type: 'POST',
                data: {
                    customer_id: customerId,
                    events: JSON.stringify(selectedEvents)
                },
                success: function(response) {
                    $('#messageContainer').removeClass('d-none text-danger').addClass('text-success');
                    $('#messageContainer').text(response);
                },
                error: function() {
                    $('#messageContainer').removeClass('d-none text-success').addClass('text-danger');
                    $('#messageContainer').text("There was an error submitting the booking.");
                }
            });
        });
    </script>

</body>

</html>