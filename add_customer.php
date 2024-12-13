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
    <title>Customer Form</title>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
    <?php include "links.php"; ?>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main">
            <?php include "header.php"; ?>
            <main class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-secondary fs-4">Add Customer</h5>
                                </div>
                                <form action="" id="customerForm" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-row align-items-center">
                                            <input type="hidden" name="id">

                                            <!-- Name Field -->
                                            <div class="form-group col-md-3">
                                                <label for="name" class="col-form-label">Name</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                                </div>
                                                <div class="error" id="nameError"></div>
                                            </div>

                                            <!-- Email Field -->
                                            <div class="form-group col-md-3">
                                                <label for="email" class="col-form-label">Email</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="mail"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                                                </div>
                                                <div class="error" id="emailError"></div>

                                            </div>

                                            <!-- Gender Field -->
                                            <div class="form-group col-md-3">
                                                <label class="col-form-label">Gender</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="male">
                                                    <label class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="female">
                                                    <label class="form-check-label">Female</label>
                                                </div>
                                                <div class="error" id="genderError"></div>
                                            </div>
                                            <!-- Address field -->
                                            <div class="form-group col-md-3">
                                                <label for="address" class="col-form-label">Address</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="disc"></i>
                                                        </span>
                                                    </div>
                                                    <textarea class="form-control" name="address" id="address" rows="2" placeholder="Enter your address"></textarea>

                                                </div>
                                                <div class="error" id="addressError"></div>
                                            </div>

                                            <!-- Pincode Field -->
                                            <div class="form-group col-md-3">
                                                <label for="pincode" class="col-form-label">Pincode</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="crosshair"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter your pincode" pattern="[0-9]{6}">
                                                </div>
                                                <div class="error" id="pincodeError"></div>
                                            </div>

                                            <!-- City Field -->
                                            <div class="form-group col-md-3">
                                                <label for="city" class="col-form-label">City</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="map-pin"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-select" name="city" id="city" required>
                                                        <option selected disabled>Select City</option>
                                                        <option value="India">India</option>
                                                        <option value="London">London</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Canada">USA</option>
                                                        <option value="Canada">Dubai</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Canada">UK</option>
                                                        <option value="Canada">Africa</option>
                                                    </select>
                                                </div>
                                                <div class="error" id="cityError"></div>
                                            </div>

                                            <!-- Phone Field -->
                                            <div class="form-group col-md-3">
                                                <label for="phone_no" class="col-form-label">Phone No.</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="phone-call"></i>
                                                        </span>
                                                    </div>
                                                    <input type="tel" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your Phone no" pattern="[0-9]{10}">
                                                </div>
                                                <div class="error" id="phoneError"></div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="image" class="col-form-label">Profile Image</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                                <div class="error" id="imgError"></div>
                                            </div>
                                        
                                            <div class="form-group col-md-12 text-center">
                                                <button type="submit" id="submitBtn" class="btn btn-info btn-lg mt-3">Submit</button>
                                            </div>
                                        </div>
                                        <div id="message"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#submitBtn").click(function(e) {
                e.preventDefault();
                var isValid = true;
                $(".error").text("");

                var imageInput = $("#image")[0];
                var allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                if (imageInput.files.length > 0) {
                    var fileName = imageInput.files[0].name;
                    var fileExtension = fileName.split(".").pop().toLowerCase();
                    if (!allowedExtensions.includes(fileExtension)) {
                        $("#imageError").text("Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");
                        isValid = false;
                    }
                }

                if ($("#name").val().trim() === "") {
                    $("#nameError").text("Name is required.");
                    isValid = false;
                }
                var email = $("#email").val().trim();
                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (email === "" || !emailPattern.test(email)) {
                    $("#emailError").text("Please enter a valid email address.");
                    isValid = false;
                }
                if (!$("input[name='gender']:checked").val()) {
                    $("#genderError").text("Please select your gender.");
                    isValid = false;
                }
                var pincode = $("#pincode").val().trim();
                var pinPattern = /^[0-9]{6}$/;
                if (!pinPattern.test(pincode)) {
                    $("#pincodeError").text("Please enter a valid 6-digit pincode.");
                    isValid = false;
                }
                if ($("#address").val().trim() === "") {
                    $("#addressError").text("Address is required.");
                    isValid = false;
                }
                if ($("#city").val() === null) {
                    $("#cityError").text("Please select a city.");
                    isValid = false;
                }
                var phone_no = $("#phone_no").val().trim();
                var phonePattern = /^[0-9]{10}$/;
                if (!phonePattern.test(phone_no)) {
                    $("#phoneError").text("Please enter a valid 10-digit phone number.");
                    isValid = false;
                }

                if ($("#image")[0].files.length === 0) {
                    $("#imgError").text("Please upload profile image.");
                    isValid = false;
                }

                if (isValid) {
                    var formData = new FormData($('#customerForm')[0]);
                    $.ajax({
                        url: 'insert_customer.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.includes('success')) {
                                $("#message").html(`<div class="text-success">${response} <a href="all_customer.php" class="fs-4"> View </a></div>`);
                            } else {
                                $("#message").html(`<div class="text-danger">${response}</div>`);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#message").html(`<div class="text-danger">An error occurred: ${error}</div>`);
                        }
                    });
                }
            });
        });
    </script>

    <?php include "flinks.php"; ?>
</body>

</html>