<?php
include('include/verify.php');
?>
<?php
 $amount = $_POST['total'];
 require_once 'phpqrcode/qrlib.php';
 $phonepe_upi = "9692439651@ybl";

 // Create UPI URL for Payment
 $upi_url = "upi://pay?pa=$phonepe_upi&pn=Praveen&am=$amount&cu=INR";
 $file_name = 'payment_qr.png';

 QRcode::png($upi_url, $file_name, QR_ECLEVEL_L, 10);

 echo "
<div class='container d-flex justify-content-center mt-3 align-items-center vh-60'>
<div class='text-center'>
 <h1 class='mb-4'>Scan to Pay</h1>
 <h1 class='mb-3 text-danger'>₹$amount</h1>
 <img src='$file_name' alt='QR Code' class='img-fluid'>
 <p class='text-muted'>Use any UPI app to scan and pay</p>
</div>
</div>";
?>