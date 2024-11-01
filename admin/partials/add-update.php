<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


for ($dir = __DIR__; !file_exists($dir . '/wp-load.php'); $dir = dirname($dir)) {
    if (dirname($dir) === $dir) die('wp-load.php could not be found.');
}
require_once($dir . '/wp-load.php');




function jsonResponse($status, $message, $data = null) {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode(['message' => $message, 'data' => $data]);
    exit;
}

try {
    // Check if request method is POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception('Invalid request method', 405);
    }

    // Database connection credentials
    $servername = DB_HOST;
    $username = DB_USER;
    $password = DB_PASSWORD;
    $dbname = DB_NAME;

    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error, 500);
    }

    // Fetch existing KYC verification data
    $sql = "SELECT id, client_id, secret_key FROM wp_kyc_verification";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $getvalid = $row['id'] ?? null;

    // Sanitize and retrieve POST data
    $verificationmode = isset($_POST['verification_mode']) ? sanitize_text_field($_POST['verification_mode']) : null;
    $redirecturlval = isset($_POST['redirect_urlval']) ? sanitize_text_field($_POST['redirect_urlval']) : null;
    $showconstval = isset($_POST['show_consent']) ? sanitize_text_field($_POST['show_consent']) : null;
    $callbackurljp = isset($_POST['callbackval']) ? sanitize_text_field($_POST['callbackval']) : null;
    $privacypolicy = isset($_POST['privacy_policy']) ? sanitize_text_field($_POST['privacy_policy']) : null;
    $showresults = isset($_POST['show_results']) ? sanitize_text_field($_POST['show_results']) : null;
    $showfeedback = isset($_POST['show_feedback']) ? sanitize_text_field($_POST['show_feedback']) : null;
    $enhanceddataval = isset($_POST['enhanced_data']) ? sanitize_text_field($_POST['enhanced_data']) : null;
    $countryvalp = isset($_POST['country_name']) ? sanitize_text_field($_POST['country_name']) : null;
    $languagejp = isset($_POST['languages_val']) ? sanitize_text_field($_POST['languages_val']) : null;

    // Collecting data for debugging
    $debugData = [
        'verification_mode' => $verificationmode,
        'redirect_url' => $redirecturlval,
        'show_consent' => $showconstval,
        'callback_url' => $callbackurljp,
        'privacy_policy' => $privacypolicy,
        'show_results' => $showresults,
        'show_feedback' => $showfeedback,
        'enhanced_data' => $enhanceddataval,
        'country_name' => $countryvalp,
        'languages_val' => $languagejp,
    ];

    // Add or update API keys
    if (isset($getvalid) && isset($_POST['username']) && isset($_POST['secretkey'])) {
        $client_id_admin = sanitize_text_field($_POST['username']);
        $secret_key_admin = sanitize_text_field($_POST['secretkey']);
        $stmt = $conn->prepare("UPDATE wp_kyc_verification SET client_id=?, secret_key=? WHERE id=1");
        $stmt->bind_param("ss", $client_id_admin, $secret_key_admin);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['username']) && isset($_POST['secretkey'])) {
        $client_id_admin = sanitize_text_field($_POST['username']);
        $secret_key_admin = sanitize_text_field($_POST['secretkey']);
        $stmt = $conn->prepare("INSERT INTO wp_kyc_verification (id, client_id, secret_key) VALUES (1, ?, ?)");
        $stmt->bind_param("ss", $client_id_admin, $secret_key_admin);
        $stmt->execute();
        $stmt->close();
    }

    // Check existing payload settings
    $stmt = $conn->prepare("SELECT id FROM payloadsetting WHERE id=1");
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();

    // Update or insert payload settings
    if ($exists && isset($verificationmode) && isset($redirecturlval)) {
        $stmt = $conn->prepare("UPDATE payloadsetting SET verification_mode=?, redirect_url=?, show_consent=?, callback_url=?, show_results=?, privacy_policy=?, enhanced_data=?, show_feedback=?, country=?, select_language=? WHERE id=1");
        $stmt->bind_param("ssssssssss", $verificationmode, $redirecturlval, $showconstval, $callbackurljp, $showresults, $privacypolicy, $enhanceddataval, $showfeedback, $countryvalp, $languagejp);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($verificationmode) && isset($redirecturlval)) {
        $stmt = $conn->prepare("INSERT INTO payloadsetting (id, verification_mode, redirect_url, show_consent, callback_url, show_results, privacy_policy, enhanced_data, show_feedback, country, select_language) VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $verificationmode, $redirecturlval, $showconstval, $callbackurljp, $showresults, $privacypolicy, $enhanceddataval, $showfeedback, $countryvalp, $languagejp);
        $stmt->execute();
        $stmt->close();
    }

    jsonResponse(200, "Data processed successfully", $debugData);

} catch (Exception $e) {
    jsonResponse($e->getCode() ?: 500, $e->getMessage());
}
?>