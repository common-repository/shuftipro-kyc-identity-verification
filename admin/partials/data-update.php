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

    // Check the referer to ensure the request comes from the same domain or contains the site's URL dynamically
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $host = parse_url($referer, PHP_URL_HOST);
    $siteDomain = parse_url($_SERVER['HTTP_HOST'], PHP_URL_HOST); // Get the site's domain dynamically

    if (!$host || (strpos($referer, $siteDomain) === false)) {
        throw new Exception('Unauthorized request', 403);
    }


    // Ensure the WP filesystem is loaded
    if (!function_exists('WP_Filesystem')) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
    }

    // Initialize the WP filesystem
    global $wp_filesystem;
    WP_Filesystem();

    // Define the file path using plugin_dir_path()
    $file_path = plugin_dir_path(dirname(__FILE__)) . 'partials/data.json';

    // Get the JSON data from the POST request
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON data', 400);
    }

    // Encode the data to JSON format
    $json_data = wp_json_encode($data);

    // Log JSON data for debugging
    error_log("JSON Data: " . print_r($json_data, true));

    // Write the JSON data to the file
    if (!$wp_filesystem->put_contents($file_path, $json_data, FS_CHMOD_FILE)) {
        throw new Exception('Failed to write to the file', 500);
    }

    jsonResponse(200, 'JSON file updated successfully', $data);
} catch (Exception $e) {
    // Log detailed error for debugging
    error_log("Error: " . $e->getMessage());
    jsonResponse($e->getCode() ?: 500, $e->getMessage());
}
?>
