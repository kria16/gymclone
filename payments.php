<?php
include 'conne.php';
session_start();

$query = "SELECT * FROM payments ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$payments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $payments[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Payment Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: white;
            color: black;
        }
        .container {
            padding: 20px;
            margin-left: 274px;
        }
        .sidebar {
        width: 270px;
        position: fixed; 
        top: 0;
        left: 0;
        height: 100%;
        background-color: #6D8196;
        padding-top: 20px;
        border-right: 1px solid #e4e5e7;
    }
span{
    padding-left:6px;
}
    #logo{
        padding-left:3px;
    }
.sidebar .navbar-brand {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding: -2px 15px;
}

.sidebar .navbar-nav {
    flex-direction: column;
    width: 100%;
}

.sidebar .nav-item {
    width: 100%;
}

.sidebar .nav-link {
    color: white;
    padding: 10px 15px;
    display: block;
    width: 100%;
    text-align: left;
}

.sidebar .nav-link:hover {
    background-color: white;
    color: black;
}

.sidebar .nav-item.active .nav-link {
    background-color: white;
    color: black;
}
        .card {
            background-color: white;
            border: 1px solid white;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #6D8196;
            color: white;
            border-bottom: 1px solid black;
        }
        .table {
            color: black;
        }
        .table thead th {
            border-bottom: 2px solid black;
        }
        .table td, .table th {
            border-top: 1px solid white;
        }
        .btn-primary {
            background-color: #6D8196;
            border-color: #6D8196;
        }
        .btn-primary:hover {
            background-color: #6D8196;
            border-color: #6D8196;
        }
        .modal-content {
            background-color: #222;
            color: white;
            border: 1px solid #6D8196;
        }
        .modal-header {
            border-bottom: 1px solid white;
        }
        .modal-footer {
            border-top: 1px solid white;
        }
        .invoice-container {
            padding: 20px;
            border: 1px solid white;
            margin-bottom: 20px;
        }
        .invoice-header {
            border-bottom: 1px solid white;
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
            border-bottom: 1px solid white;
        }
        .invoice-total {
            text-align: right;
            margin-top: 20px;
            border-top: 1px solid white;
            padding-top: 20px;
        }
        @media print {
            body {
                background-color: white !important;
                color: black !important;
            }
            .no-print {
                display: none !important;
            }
            .invoice-container {
                border: 1px solid #ddd !important;
            }
            .invoice-header {
                border-bottom: 1px solid #ddd !important;
            }
            .invoice-table th, .invoice-table td {
                border-bottom: 1px solid #ddd !important;
            }
            .invoice-total {
                border-top: 1px solid #ddd !important;
            }
            .card {
                background-color: white !important;
                border: none !important;
            }
            .card-header {
                background-color: white !important;
                color: black !important;
                border-bottom: 1px solid #ddd !important;
            }
        }
    </style>
</head>
<body>
<div class="d-flex">
        <!-- Side Navbar -->
        <nav class="sidebar">
            <div class="sidebar-sticky">
                <a class="navbar-brand">
                    <img class="media-imlocation rounded-circle" id="logo" src="LOGO.jpg" alt="logo" height="70" width="70" margin="2px">
                    <span style="color: white;">GYMSHINE ADMIN</span>
                </a>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="admindash.php">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="adcareer.php">Careers</a></li>
                    <li class="nav-item"><a class="nav-link" href="admembership.php">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="aduserdetails.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="adtrainer.php">Trainers</a></li>
                    <li class="nav-item"><a class="nav-link" href="payments.php">Payment</a></li>
                    <li class="nav-item"><a class="nav-link" href="adbranch.php">Branch</a></li>
                    <li class="nav-item"><a class="nav-link" href="adfranchise.php">Franchise</a></li>
                    <li class="nav-item"><a class="nav-link" href="adcontact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="adlogout.php">Logout</a></li>
                </ul>
            </div>
        </nav>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-credit-card"></i> Payment Management</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Name</th>
                                <th>Plan</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($payments) > 0): ?>
                                <?php foreach ($payments as $index => $payment): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($payment['invoice_number']); ?></td>
                                        <td><?php echo htmlspecialchars($payment['full_name']); ?></td>
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
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No payments found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
    </script>
</body>
</html>

