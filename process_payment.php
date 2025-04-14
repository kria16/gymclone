<?php
include 'conne.php';
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $planName = $_POST['planName'];
    $planPrice = $_POST['planPrice'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $nameOnCard = $_POST['nameOnCard'];
    
    // Mask card number for storage (only store last 4 digits)
    $maskedCardNumber = 'XXXX XXXX XXXX ' . substr(str_replace(' ', '', $cardNumber), -4);
    
    // Generate invoice number
    $invoiceNumber = 'INV-' . date('Ymd') . '-' . rand(1000, 9999);
    
    // Get current date and time
    $purchaseDate = date('Y-m-d');
    $purchaseTime = date('H:i:s');
    
    // Insert payment data into database
    $sql = "INSERT INTO payments (invoice_number, full_name, email, phone, address, plan_name, amount, card_number, purchase_date, purchase_time) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdsss", $invoiceNumber, $fullName, $email, $phone, $address, $planName, $planPrice, $maskedCardNumber, $purchaseDate, $purchaseTime);
    
    if ($stmt->execute()) {
        // Payment successful
        echo json_encode(['success' => true, 'message' => 'Payment processed successfully']);
    } else {
        // Payment failed
        echo json_encode(['success' => false, 'message' => 'Error processing payment: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    // Not a POST request
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>

