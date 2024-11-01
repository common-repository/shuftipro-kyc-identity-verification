<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://shuftipro.com/pricing
 * @since      1.0.0
 *
 * @package    Shuftipro_Kyc
 * @subpackage Shuftipro_Kyc/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Shuftipro_Kyc
 * @subpackage Shuftipro_Kyc/public
 * @author     WordPress Team ShuftiPro <tech@shuftipro.com>
 */
class Shuftipro_Kyc_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Shuftipro_Kyc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shuftipro_Kyc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/shuftipro-kyc-public.css', array(), 20220104);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Shuftipro_Kyc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shuftipro_Kyc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/shuftipro-kyc-public.js', array('jquery'), $this->version, false);
	}

	function wpexopite_multifilter_shortcodes($atts) {
		// Create the button with the data-name attribute
		$quick_kyc = '<div class="wpsp-demo-buttons1">
			<button type="button" id="quick-kyc-btn" class="submit wpsp-serv-btn">Perform KYC</button>
		</div>';

	?>
		<?php
		// update database
		$servername = DB_HOST;
		$username = DB_USER;
		$password = DB_PASSWORD;
		$dbname = DB_NAME;

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT id, client_id, secret_key FROM wp_kyc_verification";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		$printclintidnew_n_n =   $row["client_id"];
		$printsecretkeymnew_n =   $row["secret_key"];


		// $getinfo = "SELECT id, verification_mode, redirect_url, show_consent, callback_url, show_results, privacy_policy, enhanced_data, show_feedback, country, select_language FROM payloadsetting";
		// $resultget = $conn->query($getinfo);


		// while ($rowgetn = $resultget->fetch_assoc()) {
		// 	// 	$get_valdb_id = $rowgetn['id'];   
		// 	$get_valdb_verification_mode = $rowgetn['verification_mode'];
		// 	$get_valdb_redirect_url = $rowgetn['redirect_url'];
		// 	$get_valdb_show_consent = $rowgetn['show_consent'];
		// 	$get_valdb_callback_url = $rowgetn['callback_url'];
		// 	$get_valdb_show_results = $rowgetn['show_results'];
		// 	$get_valdb_privacy_policy = $rowgetn['privacy_policy'];
		// 	$get_valdb_enhanced_data = $rowgetn['enhanced_data'];
		// 	$get_valdb_show_feedback = $rowgetn['show_feedback'];
		// 	$get_valdb_country = $rowgetn['country'];
		// 	$get_valdb_select_language = $rowgetn['select_language'];
		// }

		$urlone = 'https://api.shuftipro.com/get/access/token';
		//Your Shufti Pro account Client ID
		$client_idone  = $printclintidnew_n_n;
		//Your Shufti Pro account Secret Key
		$secret_keyone = $printsecretkeymnew_n;

		$response_new = wp_remote_get(
			$urlone,
			array(
				'method'      => 'POST',
				'headers'     => array(
					'Authorization' => 'Basic ' . base64_encode($client_idone . ":" . $secret_keyone)
				)
			)
		);
	
		if (is_wp_error($response_new)) {
			$error_message = $response_new->get_error_message();
			echo esc_attr( "Something went wrong: $error_message");
		} else {
			$response_n = json_decode($response_new['body'], true);
			$accesstokenone = $response_n['access_token'];
		}

		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script type="text/javascript">
        jQuery(document).ready(function () {
                var payload;
                jQuery("#quick-kyc-btn").click(function () {

                        var requestOptions = {
                                method: 'POST',
                        };

                        fetch("<?php echo esc_attr( plugin_dir_url(dirname(__FILE__)) . 'admin/partials/data.json' ); ?>", requestOptions)
                                .then(response => {
                                        if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                        }
                                        return response.json(); // Parse the response as JSON
                                })
                                .then(result => {
                                        // Generate a new reference number
                                        var newrefnumber =  "wp_" + Math.random().toString(36).slice(2);

                                        // Add the new reference number to the result object
                                        result.reference = newrefnumber;

                                        // Store the reference number in localStorage
                                        localStorage.setItem('newrefnumber', newrefnumber);

                                        // Log the entire result object with the new reference number
                                        var payload = JSON.stringify(result);

                                        var token = "<?php echo esc_attr( $accesstokenone ) ; ?>";
                                        fetch('https://api.shuftipro.com/', {
                                                method: 'post',
                                                headers: {
                                                        'Accept': 'application/json',
                                                        'Content-Type': 'application/json',
                                                        'Authorization': 'Bearer ' + token
                                                },
                                                body: payload
                                        }).then(function (response) {
                                                return response.json();
                                        }).then(function (data) {
                                                console.log(data);
                                                if (data.verification_url && data.verification_url !== undefined) {
                                                        window.location = data.verification_url;
                                                }
                                        });
                                        // on click quick kyc button end

                                        // pollingforstatus
                                        function pollingforstatus() {
                                                var getrefnumber = localStorage.getItem('newrefnumber');
                                                var token2;
                                                var payloadnew = {
                                                        reference: getrefnumber
                                                }
                                                jQuery.when(jQuery.ajax({
                                                        url: "<?php echo esc_attr( plugin_dir_url(dirname(__FILE__)) . 'public/partials/api-poll.php' ); ?>",
                                                        type: 'post',
                                                        data: {
                                                                "callFunc1": "1",
                                                                "accesstokenuser": getrefnumber
                                                        }
                                                })).then(function (response) {

                                                        var response = response.replace(/\s/g, '');
                                                        console.log(response);

                                                        if (response == "verification.accepted") {
                                                                jQuery("#quick-kyc-btn").text("you're verified")
                                                                // jQuery("#quick-kyc-btn").after("<button id='savesetting'>Save Setting</button>")
                                                                jQuery(".showwaitingmessage").remove();
                                                                jQuery(".showdecverimessage").remove();
                                                                jQuery(".showmessageeror").remove();
                                                                jQuery(".showsuccesmessage").remove();
                                                                jQuery("button#quick-kyc-btn").after("<p class='showsuccesmessage'>you're verified.</p>");
                                                                jQuery("#quick-kyc-btn").attr('disabled', 'disabled')
                                                                clearInterval(interval);

                                                        }
                                                        if (response == "request.pending") {
                                                                jQuery(".showwaitingmessage").remove();
                                                                jQuery(".showdecverimessage").remove();
                                                                jQuery(".showmessageeror").remove();
                                                                jQuery(".showsuccesmessage").remove();
                                                                jQuery("button#quick-kyc-btn").after("<p class='showwaitingmessage'>verification processing.</p>");
                                                        }
                                                        if (response == "verification.declined") {
                                                                jQuery(".showwaitingmessage").remove();
                                                                jQuery(".showdecverimessage").remove();
                                                                jQuery(".showmessageeror").remove();
                                                                jQuery(".showsuccesmessage").remove();
                                                                jQuery("button#quick-kyc-btn").after("<p class='showdecverimessage'>verification declined, please try after some time.</p>");
                                                                clearInterval(interval);
                                                        }
                                                        if (response !== "verification.declined" && response !== "request.pending" && response !== "verification.accepted") {
                                                                jQuery(".showwaitingmessage").remove();
                                                                jQuery(".showdecverimessage").remove();
                                                                jQuery(".showmessageeror").remove();
                                                                jQuery(".showsuccesmessage").remove();
                                                                jQuery("button#quick-kyc-btn").after("<p class='showmessageeror'>" + response.error.message + "</p>");
                                                                jQuery("#quick-kyc-btn").text('Perform KYC')
                                                                clearInterval(interval);
                                                        }
                                                });
                                                //Use your Shufti Pro account client id and secret key
                                        }
                                        var interval = setInterval(pollingforstatus, 10000);
                                })
                })
        })

        // disableinspectmode
        /* To Disable Inspect Element */
        jQuery(document).bind("contextmenu", function (e) {
                e.preventDefault();
        });

        jQuery(document).keydown(function (e) {
                if (e.which === 123) {
                        return false;
                }
        });

        document.onkeydown = function (e) {
                if (event.keyCode == 123) {
                        return false;
                }
                if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)) {
                        return false;
                }
                if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
                        return false;
                }
        }
</script>
<?php
		return $quick_kyc;
	}

}