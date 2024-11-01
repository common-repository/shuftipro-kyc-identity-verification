<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

for ($dir = __DIR__; !file_exists($dir . '/wp-load.php'); $dir = dirname($dir)) {
    if (dirname($dir) === $dir) die('wp-load.php could not be found.');
}
require_once($dir . '/wp-load.php');

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception('Invalid request method');
    }

    header('Content-Type: application/json'); // Set the content type to JSON

    $client_id_admin = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : null;
    $secret_key_admin = isset($_POST['secretkey']) ? sanitize_text_field($_POST['secretkey']) : null;

    if (empty($client_id_admin) || empty($secret_key_admin)) {
        throw new Exception('Client ID or Secret Key is missing');
    }

    $response_new_admin = wp_remote_post(
        'https://api.shuftipro.com/account/info/',
        array(
            'method'    => 'GET',
            'headers'     => array(
                'Authorization' => 'Basic ' . base64_encode($client_id_admin . ':' . $secret_key_admin)
            )
        )
    );

    if (is_wp_error($response_new_admin)) {
        $error_message_admin = $response_new_admin->get_error_message();
        throw new Exception("Something went wrong: $error_message_admin");
    }

    $decoded_jsonss = json_decode($response_new_admin['body'], true);

    if (!empty($decoded_jsonss['event']) && ($decoded_jsonss['event'] == 'request.unauthorized')) {
        $varerrormessage = $decoded_jsonss['error']['message'];
        throw new Exception($varerrormessage);
    } elseif (isset($decoded_jsonss)) {
        $newstatvar = $decoded_jsonss['account']['status'];
        echo json_encode(array('status' => $newstatvar));
    } else {
        throw new Exception('Unexpected response from API');
    }

} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>