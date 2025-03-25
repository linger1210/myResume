<?php
// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the Turnstile token from the form data
    $token = isset($_POST['cf-turnstile-response']) ? $_POST['cf-turnstile-response'] : '';

    if (empty($token)) {
        die("Turnstile token is missing. Please complete the challenge.");
    }

    // Your Turnstile secret key from Cloudflare dashboard
    $secretKey = '0x4AAAAAABCZBQ7S--yu-Izzxhc70g7IOn8';

    // Build the POST request data for verification
    $data = [
        'secret'   => $secretKey,
        'response' => $token,
    ];

    // Initialize cURL to send the POST request to Cloudflare Turnstile verification endpoint
    $ch = curl_init('https://challenges.cloudflare.com/turnstile/v0/siteverify');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    // Check the verification result
    if (isset($result['success']) && $result['success'] === true) {
        echo "Turnstile verification passed!";
        // Here you can process the form (e.g., send an email, save to a database, etc.)
    } else {
        echo "Turnstile verification failed. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
