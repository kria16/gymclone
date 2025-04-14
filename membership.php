<?php
session_start();
include 'conne.php';

// Fetch membership data
$qry = "SELECT * FROM membership";
$result = mysqli_query($conn, $qry);
$memberships = [];
while ($row = mysqli_fetch_assoc($result)) {
    $memberships[] = $row;
}

// Fetch user data from register table if user is logged in
$userData = null;
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $userQuery = "SELECT * FROM register WHERE email = '$email'";
    $userResult = mysqli_query($conn, $userQuery);
    $userData = mysqli_fetch_assoc($userResult);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">    
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
     <script src="bootstrap.min.css"></script>
     <link rel="stylesheet" href="index.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="agymfinal/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Membership</title>
    <style>
        body {
            background-color: #121212;
            color: white;
        }
        .spad {
            padding-top: 10px;
            padding-bottom: 100px;
        }
        .membership{
            max-width: 960px;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        /* .header{
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            justify-content: center;
        } */
        .heading{
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .membership .memb-title{
            margin-bottom: 56px;
        }
        .memb-title{
            text-align: center;
        }
        .memb-title span {
            font-size: 16px;
            color: #f36100;
            text-transform: uppercase;
            font-weight: 700;
        }
        .memb-title h2 {
            color: #ffffff;
            font-size: 32px;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 8px;
        }
        .row-justify{
            justify-content: center;
            display: flex;
            flex-direction: row;
            margin-right: 2%;
            margin-left: 5%;
        }
        .col-lg-4 .col-2{
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            color: white;
        }
        .price-plan{
            text-align: center;
            padding: 40px 30px 52px;
            border: 1px solid #464646;
            border-radius: 6%;
            margin-bottom: 30px;
            position: relative;
        }
        .price-plan h3{
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 3px;
        }
        .price-p{
            margin-bottom: 30px;
            text-align: center;
            padding: 30px 30px 40px;
            margin-bottom: 2px;
        }
        .price-p h2{
            font-size: 60px;
            color: #f36100;
            font-weight: 600;
            margin: 0;
            font-family: "Oswald", sans-serif;
            line-height: 1.2;
            display: block;
            font-size: 1.5em;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
            unicode-bidi: isolate;
        }
        .price-plan ul{
            margin-bottom: 40px;
        }
        .price-plan.ul {
            display: block;
            list-style-type: disc;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 40px;
            unicode-bidi: isolate;
            padding: 0%;
            margin: 0%;
        }
        .price-plan ul li {
            font-size: 17px;
            line-height: 32px;
            list-style: none;
        }
        .price-plan.li {
            display: list-item;
            text-align: -webkit-match-parent;
            unicode-bidi: isolate;
        }
        #pricebtn{
            background: #333333;
            display: inline-block;
            font-size: 14px;
            padding: 17px 30px 16px;
            color: #ffffff;
            line-height: normal;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 700;
        }
        .price-plan:hover{
            background-color: white;
            display: block;
            position: relative;
            color: black;
        }
        .price-plan a:link{
            color: white;
        }
        #pricebtn:hover{
            text-decoration: none;
            background-color: #f36100;
        }
        
        /* Modal styles */
        .modal-content {
            background-color: #222;
            color: white;
            border: 1px solid #f36100;
        }
        .modal-header {
            border-bottom: 1px solid #444;
        }
        .modal-footer {
            border-top: 1px solid #444;
        }
        .form-control {
            background-color: #333;
            color: white;
            border: 1px solid #555;
        }
        .form-control:focus {
            background-color: #444;
            color: white;
        }
        .btn-primary {
            background-color: #f36100;
            border-color: #f36100;
        }
        .btn-primary:hover {
            background-color: #d55600;
            border-color: #d55600;
        }
        .success-icon {
            font-size: 50px;
            color: green;
            margin-bottom: 10px;
        }
        .success-icon {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
        
        /* User info styles */
        .user-info {
            background-color: #333;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .user-info h5 {
            color: #f36100;
            margin-bottom: 15px;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        .info-label {
            width: 120px;
            font-weight: bold;
        }
        .info-value {
            flex: 1;
        }
        .readonly-field {
            background-color: #2a2a2a !important;
            cursor: not-allowed;
        }
        
        @media (max-width :992px){
        .col-2{
            max-width: 33.333%;
            flex: 33.333%;
            
        }
        .row-justify{
            padding-left: 3%;
            padding-right: 5%;
            flex-direction: column;
        }
        }
    </style>
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand">
            <img class="media-image rounded-circle" src="LOGO.jpg" alt="logo" height="70" width="70">
            <h5 style="color: black;">GYM<span style="color: orangered;">SHINE</span></h5>
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
                    <a class="nav-link" href="login.php">login</a>
                </li>
            </ul>
            <ul>
                <li class="nav-item">
                    <a href="userprofile1.php"><img src="user 2.png" width="30px" ></a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <br><br>

    <!--membership-->
<section class="pricing-section spad">
    <table class="member-tab">
    <div class="membership">
        <div class="header">
            <div class="heading">
                <div class="memb-title">
                    <span style="color: #f36100;">Our Plans</span>
                    <h2>CHOOSE YOUR PLAN</h2>
                </div>
            </div>
        </div>
        <div class="row-justify">
    <?php foreach ($memberships as $membership): ?>
        <div class="row col-lg-4 col-2" id="myDiv">
            <div class="price-plan">
                <h3><?php echo htmlspecialchars($membership['month']); ?></h3>
                <div class="price-p">
                    <h2>₹<?php echo htmlspecialchars($membership['price']); ?>/- </h2>
                </div>
                <ul>
                    <li><?php echo htmlspecialchars($membership['datamonth']); ?></li>
                    <li>Unlimited equipment</li>
                    <li><?php echo htmlspecialchars($membership['trainer']); ?></li>
                    <li><?php echo htmlspecialchars($membership['restriction']); ?></li>
                    <?php if (isset($membership['yaz']) && $membership['yaz']): ?>
                        <li><?php echo htmlspecialchars($membership['yaz']); ?></li>
                    <?php endif; ?>
                </ul>
                <button type="button" id="pricebtn" class="enroll-btn" 
                    onclick="checkLoginStatus('<?php echo htmlspecialchars($membership['month']); ?>', '<?php echo htmlspecialchars($membership['price']); ?>')"
                    data-plan="<?php echo htmlspecialchars($membership['month']); ?>"
                    data-price="<?php echo htmlspecialchars($membership['price']); ?>">
                    Enroll now
                </button>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    </div>
    </table>
</section>
 <!--footer-->
 <footer class="bg-footer">
        <div class="containerr">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-test">
                        <p>Contact Us</p>
                        <ul class="mt-4">
                            <li><a href="tel:7096004208"><i class="fas fa-mobile-alt"></i> +91 7096646378</a></li>
                            <li><a href="gymshine234@gmail.com"><i class="fas fa-envelope"></i>
                                    gymshine111@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="footer-test">
                        <p>Pages</p>
                        <ul class="mt-4">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="branch.php">Branch</a></li>
                            <li><a href="membership.php">Membership</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <li><a href="franchies.php">franchies</a></li>
                            <li><a href="careers.php">careers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="footer-test">
                        <p>Our Branches</p>
                        <ul class="mt-4">
                            <li><a href="#ourBranch">Vesu </a></li>
                            <li><a href="#ourBranch">Ghod Dod</a></li>
                            <li><a href="#ourBranch">Adajan</a></li>
                            <li><a href="#ourBranch">Vip Road</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 p-0">
                    <div class="footer-test">
                        <p>Follow Us</p>
                        <div class="social_icon">
                            <img src="instagram.png" width="10%" height="10%">
                            <img src="whatsapp.png" width="10%" height="10%">
                            <img src="facebook.png" width="10%" height="10%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer-copyright">
        <center><p style="color: black;">© 2024-2025All Rights Reserved</p></center>
        </div>
    </footer>

    <!-- Login Required Modal -->
    <div class="modal fade" id="loginRequiredModal" tabindex="-1" role="dialog" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginRequiredModalLabel">Login Required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-user-lock" style="font-size: 50px; color: #f36100;"></i>
                    </div>
                    <h4>Please Login First</h4>
                    <p>You need to be logged in to purchase a membership.</p>
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">Login Now</a>
                    <a href="register.php" class="btn btn-secondary">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <input type="hidden" id="planName" name="planName">
                        <input type="hidden" id="planPrice" name="planPrice">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Personal Information</h5>                                
                                <?php if($userData): ?>
                                <div class="user-info">
                                    <div class="info-row">
                                        <div class="info-label">Full Name:</div>
                                        <div class="info-value"><?php echo htmlspecialchars($userData['name']); ?></div>
                                    </div>
                                    <input type="hidden" name="fullName" value="<?php echo htmlspecialchars($userData['name']); ?>">
                                    
                                    <div class="info-row">
                                        <div class="info-label">Email:</div>
                                        <div class="info-value"><?php echo htmlspecialchars($userData['email']); ?></div>
                                    </div>
                                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>">
                                    
                                    <div class="info-row">
                                        <div class="info-label">Phone:</div>
                                        <div class="info-value"><?php echo htmlspecialchars($userData['contact']); ?></div>
                                    </div>
                                    <input type="hidden" name="phone" value="<?php echo htmlspecialchars($userData['contact']); ?>">
                                    
                                    <div class="info-row">
                                        <div class="info-label">Address:</div>
                                        <div class="info-value"><?php echo htmlspecialchars($userData['address']); ?></div>
                                    </div>
                                    <input type="hidden" name="address" value="<?php echo htmlspecialchars($userData['address']); ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <h5>Payment Information</h5>
                                <div class="form-group">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expiryDate">Expiry Date</label>
                                            <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cvv">CVV</label>
                                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nameOnCard">Name on Card</label>
                                    <input type="text" class="form-control" id="nameOnCard" name="nameOnCard" required>
                                </div>
                                <div class="form-group">
                                    <label>Selected Plan: <span id="selectedPlan"></span></label>
                                </div>
                                <div class="form-group">
                                    <label>Total Amount: ₹<span id="selectedPrice"></span>/-</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="processPayment">Process Payment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Payment Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="success-icon">
                        <i class="fas fa-check-circle" style="font-size: 50px; color: green;"></i>
                    </div>
                    <h4>Thank You!</h4>
                    <p>Your payment has been processed successfully.</p>
                    <p>A confirmation email has been sent to your email address.</p>
                    <p>Your membership is now active.</p>
                </div>
                <div class="modal-footer">
                    <a href="userprofile1.php" class="btn btn-primary">View Invoice</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to check login status before showing payment modal
        function checkLoginStatus(plan, price) {
            <?php if(isset($_SESSION['email'])): ?>
                // User is logged in, show payment modal
                showPaymentModal(plan, price);
            <?php else: ?>
                // User is not logged in, show login required modal
                showLoginRequiredModal(plan, price);
            <?php endif; ?>
        }

        // Function to show payment modal
        function showPaymentModal(plan, price) {
            var modal = $('#paymentModal');
            modal.find('#selectedPlan').text(plan);
            modal.find('#selectedPrice').text(price);
            modal.find('#planName').val(plan);
            modal.find('#planPrice').val(price);
            modal.modal('show');
        }

        // Function to show login required modal
        function showLoginRequiredModal(plan, price) {
            // Store plan info in localStorage to use after login
            localStorage.setItem('selectedPlan', plan);
            localStorage.setItem('selectedPrice', price);
            $('#loginRequiredModal').modal('show');
        }
        
        // Format card number with spaces
        $('#cardNumber').on('input', function() {
            var val = $(this).val().replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            var formatted = val.replace(/\d{4}(?=.)/g, '$& ');
            $(this).val(formatted);
        });
        
        // Format expiry date
        $('#expiryDate').on('input', function() {
            var val = $(this).val().replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            if (val.length > 2) {
                val = val.substring(0, 2) + '/' + val.substring(2, 4);
            }
            $(this).val(val);
        });
        
        // Limit CVV to 3 or 4 digits
        $('#cvv').on('input', function() {
            var val = $(this).val().replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            $(this).val(val.substring(0, 4));
        });
        
        // Process payment
        $('#processPayment').click(function() {
            var form = document.getElementById('paymentForm');
            if (form.checkValidity()) {
                // Show loading state
                $(this).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                $(this).prop('disabled', true);
                
                // Generate invoice number
                var invoiceNumber = 'INV-' + new Date().toISOString().slice(0,10).replace(/-/g,'') + '-' + Math.floor(Math.random() * 10000);
                
                // Add invoice number to form data
                var formData = $('#paymentForm').serialize() + '&invoiceNumber=' + invoiceNumber;
                
                // Send data to server using AJAX
                $.ajax({
                    url: 'process_payment.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        try {
                            var result = JSON.parse(response);
                            if (result.success) {
                                $('#paymentModal').modal('hide');
                                $('#successModal').modal('show');
                                form.reset();
                            } else {
                                alert('Error: ' + result.message);
                            }
                        } catch (e) {
                            console.error(e);
                            alert('There was an error processing your payment. Please try again.');
                        }
                        $('#processPayment').html('Process Payment');
                        $('#processPayment').prop('disabled', false);
                    },
                    error: function() {
                        alert('There was an error processing your payment. Please try again.');
                        $('#processPayment').html('Process Payment');
                        $('#processPayment').prop('disabled', false);
                    }
                });
            } else {
                form.reportValidity();
            }
        });
        
        // Check if user just logged in and has a selected plan
        $(document).ready(function() {
            var selectedPlan = localStorage.getItem('selectedPlan');
            var selectedPrice = localStorage.getItem('selectedPrice');
            
            if (selectedPlan && selectedPrice && <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>) {
                // Clear localStorage
                localStorage.removeItem('selectedPlan');
                localStorage.removeItem('selectedPrice');
                
                // Show payment modal with the selected plan
                showPaymentModal(selectedPlan, selectedPrice);
            }
        });
    </script>
</body>
</html>