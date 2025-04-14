<?php
session_start();
include 'conne.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Process profile update
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $email = $_SESSION['email'];
    
    // Update user data
    $sql = "UPDATE register SET name=?, contact=?, age=?, address=?, city=?, zip=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $contact, $age, $address, $city, $zip, $email);
    
    if ($stmt->execute()) {
        $update_success = true;
    } else {
        $update_error = "Error updating profile: " . $stmt->error;
    }
}

// Process password change
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];
    
    // Check if current password is correct
    $sql = "SELECT password FROM register WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (password_verify($current_password, $user['password'])) {
        // Check if new passwords match
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update password
            $sql = "UPDATE register SET password=? WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashed_password, $email);
            
            if ($stmt->execute()) {
                $password_success = true;
            } else {
                $password_error = "Error updating password: " . $stmt->error;
            }
        } else {
            $password_error = "New passwords do not match";
        }
    } else {
        $password_error = "Current password is incorrect";
    }
}

// Get user information
$email = $_SESSION['email'];
$sql = "SELECT * FROM register WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get user's payments/invoices
$sql = "SELECT * FROM payments WHERE email = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$payments = [];
while ($row = $result->fetch_assoc()) {
    $payments[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - GymShine</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            background-color: #121212;
            color: white;
        }
        .profile-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        .profile-header {
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #444;
        }
        .profile-tabs {
            background-color: #222;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #444;
        }
        .nav-tabs {
            border-bottom: 1px solid #444;
        }
        .nav-tabs .nav-link {
            color: white;
            border: none;
        }
        .nav-tabs .nav-link.active {
            background-color: #333;
            color: #f36100;
            border: none;
            border-bottom: 2px solid #f36100;
        }
        .tab-content {
            padding-top: 20px;
        }
        .card {
            background-color: #333;
            border: 1px solid #444;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #444;
            color: white;
            border-bottom: 1px solid #555;
        }
        .btn-primary {
            background-color: #f36100;
            border-color: #f36100;
        }
        .btn-primary:hover {
            background-color: #d55600;
            border-color: #d55600;
        }
        .table {
            color: white;
        }
        .table th, .table td {
            border-top: 1px solid #444;
        }
        .invoice-container {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .invoice-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .invoice-total {
            text-align: right;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .alert {
            margin-bottom: 20px;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .invoice-print-container, .invoice-print-container * {
                visibility: visible;
            }
            .invoice-print-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand">
            <img class="media-image rounded-circle" src="LOGO.jpg" alt="logo" height="70" width="70">
            <h5 style="color: black;">GYM<span style="color: #f36100;">SHINE</span></h5>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="branch.php">Branch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="membership.php">Membership</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-header">
            <div class="row">
                <div class="col-md-6">
                    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>
                    <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($user['contact']); ?></p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p><i class="fas fa-calendar-alt"></i> Member since: <?php echo date('F j, Y', strtotime($user['create_date'])); ?></p>
                </div>
            </div>
        </div>

        <?php if(isset($update_success)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Your profile has been updated successfully!
        </div>
        <?php endif; ?>

        <?php if(isset($update_error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> <?php echo $update_error; ?>
        </div>
        <?php endif; ?>

        <?php if(isset($password_success)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Your password has been changed successfully!
        </div>
        <?php endif; ?>

        <?php if(isset($password_error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> <?php echo $password_error; ?>
        </div>
        <?php endif; ?>

        <div class="profile-tabs">
            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab">Edit Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab">Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab">Invoices</a>
                </li>
            </ul>
            <div class="tab-content" id="profileTabsContent">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
                                    <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
                                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Address Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                                    <p><strong>City:</strong> <?php echo htmlspecialchars($user['city']); ?></p>
                                    <p><strong>Zip Code:</strong> <?php echo htmlspecialchars($user['zip']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Edit Profile Tab -->
                <div class="tab-pane fade" id="edit" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Phone Number</label>
                                            <input type="tel" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo htmlspecialchars($user['address']); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="zip">Zip Code</label>
                                            <input type="text" class="form-control" id="zip" name="zip" value="<?php echo htmlspecialchars($user['zip']); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Change Password Tab -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" onsubmit="return validatePasswordForm()">
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                    <small class="form-text text-muted">Password must be at least 8 characters long.</small>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <div id="password_error" class="text-danger mb-3" style="display: none;"></div>
                                <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Invoices Tab -->
                <div class="tab-pane fade" id="invoices" role="tabpanel">
                    <?php if (count($payments) > 0): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $payment): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($payment['invoice_number']); ?></td>
                                            <td><?php echo htmlspecialchars($payment['plan_name']); ?></td>
                                            <td>₹<?php echo htmlspecialchars($payment['amount']); ?>/-</td>
                                            <td><?php echo date('d M Y', strtotime($payment['purchase_date'])); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary view-invoice" 
                                                    data-id="<?php echo $payment['id']; ?>"
                                                    data-invoice="<?php echo htmlspecialchars($payment['invoice_number']); ?>"
                                                    data-name="<?php echo htmlspecialchars($payment['full_name']); ?>"
                                                    data-email="<?php echo htmlspecialchars($payment['email']); ?>"
                                                    data-phone="<?php echo htmlspecialchars($payment['phone']); ?>"
                                                    data-address="<?php echo htmlspecialchars($payment['address']); ?>"
                                                    data-plan="<?php echo htmlspecialchars($payment['plan_name']); ?>"
                                                    data-amount="<?php echo htmlspecialchars($payment['amount']); ?>"
                                                    data-card="<?php echo htmlspecialchars($payment['card_number']); ?>"
                                                    data-date="<?php echo date('d M Y', strtotime($payment['purchase_date'])); ?>"
                                                    data-time="<?php echo date('h:i A', strtotime($payment['purchase_time'])); ?>">
                                                    <i class="fas fa-eye"></i> View Invoice
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <p>You don't have any invoices yet. <a href="membership.php" class="alert-link">Purchase a membership</a> to get started!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Invoice Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="invoice-print-container">
                        <div class="invoice-container" id="invoice-printable">
                            <div class="invoice-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2>GYMSHINE</h2>
                                        <p>123 Fitness Street, Gym City</p>
                                        <p>Phone: +91 7096646378</p>
                                        <p>Email: gymshine111@gmail.com</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h2>INVOICE</h2>
                                        <p><strong>Invoice #:</strong> <span id="invoice-number"></span></p>
                                        <p><strong>Date:</strong> <span id="invoice-date"></span></p>
                                        <p><strong>Time:</strong> <span id="invoice-time"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Billed To:</h4>
                                        <p><strong>Name:</strong> <span id="customer-name"></span></p>
                                        <p><strong>Email:</strong> <span id="customer-email"></span></p>
                                        <p><strong>Phone:</strong> <span id="customer-phone"></span></p>
                                        <p><strong>Address:</strong> <span id="customer-address"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Payment Method:</h4>
                                        <p><strong>Card Number:</strong> <span id="card-number"></span></p>
                                    </div>
                                </div>
                            </div>
                            <table class="invoice-table">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span id="plan-name"></span> Membership</td>
                                        <td>1</td>
                                        <td>₹<span id="plan-price"></span>/-</td>
                                        <td>₹<span id="plan-total"></span>/-</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="invoice-total">
                                <p><strong>Subtotal:</strong> ₹<span id="subtotal"></span>/-</p>
                                <p><strong>Tax (18% GST):</strong> ₹<span id="tax"></span>/-</p>
                                <h4><strong>Total:</strong> ₹<span id="total"></span>/-</h4>
                            </div>
                            <div class="text-center mt-4">
                                <p>Thank you for choosing GYMSHINE!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-print">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="printInvoice">
                        <i class="fas fa-print"></i> Print Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // View invoice
            $('.view-invoice').click(function() {
                var id = $(this).data('id');
                var invoice = $(this).data('invoice');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var address = $(this).data('address');
                var plan = $(this).data('plan');
                var amount = $(this).data('amount');
                var card = $(this).data('card');
                var date = $(this).data('date');
                var time = $(this).data('time');
                
                // Calculate tax and total
                var subtotal = parseFloat(amount);
                var tax = subtotal * 0.18;
                var total = subtotal + tax;
                
                // Fill invoice details
                $('#invoice-number').text(invoice);
                $('#invoice-date').text(date);
                $('#invoice-time').text(time);
                $('#customer-name').text(name);
                $('#customer-email').text(email);
                $('#customer-phone').text(phone);
                $('#customer-address').text(address);
                $('#card-number').text(card);
                $('#plan-name').text(plan);
                $('#plan-price').text(amount);
                $('#plan-total').text(amount);
                $('#subtotal').text(subtotal.toFixed(2));
                $('#tax').text(tax.toFixed(2));
                $('#total').text(total.toFixed(2));
                
                // Show modal
                $('#invoiceModal').modal('show');
            });
            
            // Print invoice
            $('#printInvoice').click(function() {
                window.print();
            });
        });

        // Validate password form
        function validatePasswordForm() {
            var currentPassword = document.getElementById('current_password').value;
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var errorElement = document.getElementById('password_error');
            
            // Reset error message
            errorElement.style.display = 'none';
            
            // Check if new password is at least 8 characters
            if (newPassword.length < 8) {
                errorElement.textContent = 'New password must be at least 8 characters long.';
                errorElement.style.display = 'block';
                return false;
            }
            
            // Check if passwords match
            if (newPassword !== confirmPassword) {
                errorElement.textContent = 'New passwords do not match.';
                errorElement.style.display = 'block';
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>