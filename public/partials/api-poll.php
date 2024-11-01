<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://shuftipro.com/pricing
 * @since      1.0.0
 *
 * @package    Shuftipro_Kyc
 * @subpackage Shuftipro_Kyc/public/partials
 */
?>
<?php
if (isset($_POST['callFunc1'])) {

    for ($dir = __DIR__; !file_exists($dir . '/wp-config.php'); $dir = dirname($dir)) {
        if (dirname($dir) === $dir) die('wp-config.php could not be found.');
    }
    include_once($dir . '/wp-config.php');
    
    global $wpdb;
    $results_new = $wpdb->get_results("SELECT id, client_id, secret_key FROM wp_kyc_verification");

    foreach ($results_new as $reservation_n) {
        $printclintidnew_n_n = $reservation_n->client_id;
        $printsecretkeymnew_n = $reservation_n->secret_key;
    }

    if (isset($_POST['accesstokenuser'])) {
        $accesstokenuser  = sanitize_text_field($_POST["accesstokenuser"]);
    }

    $url = 'https://api.shuftipro.com/status';

    // Your Shufti Pro account Client ID
    $client_id  = $printclintidnew_n_n;
    //Your Shufti Pro account Secret Key
    $secret_key = $printsecretkeymnew_n;

    $response_new = wp_remote_get(
        $url,
        array(
            'method'      => 'POST',
            'headers'     => array(
                'Authorization' => 'Basic ' . base64_encode($client_id . ":" . $secret_key)
            ),
            'body'        => array(
                'reference' => $accesstokenuser
            ),
        )
    );

    if (is_wp_error($response_new)) {
        $error_message = $response_new->get_error_message();
        echo esc_attr("Something went wrong: $error_message");
    } else {
        $response_n = json_decode($response_new['body'], true);
        print_r($response_n['event']);
    }
}
?>