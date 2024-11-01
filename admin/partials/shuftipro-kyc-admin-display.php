<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://shuftipro.com/pricing
 * @since      1.0.0
 *
 * @package    Shuftipro_Kyc
 * @subpackage Shuftipro_Kyc/admin/partials
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<?php

// update database
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// echo esc_attr($servername . $username . $password . $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM wp_kyc_verification";
$result = $conn->query($sql);
// echo esc_attr("2" . $result->fetch_assoc());
if ($result->num_rows > 0) {
	// $row = $result->fetch_assoc();
	$row = $result->fetch_assoc();

	$getvalid =  $row["id"];
	$printclintidnew_n_n =   $row["client_id"];
	$printsecretkeymnew_n =   $row["secret_key"];
	// echo esc_attr("1" . $printclintidnew_n_n);
    // echo esc_attr("2" . $printsecretkeymnew_n);
}

// if (isset($_POST['username'])) {
//add keys first time
if (isset($getvalid) && isset($client_id_admin) && isset($secret_key_admin)) {
	$sql_if = "UPDATE wp_kyc_verification SET client_id='$client_id_admin', secret_key= '$secret_key_admin' WHERE id=1";
	$conn->query($sql_if);
} 
//update api keys
elseif (isset($client_id_admin) && isset($secret_key_admin)) {
	$sql_else = "INSERT INTO wp_kyc_verification (id, client_id, secret_key) VALUES ('1', '$client_id_admin', '$secret_key_admin')";
	$conn->query($sql_else);
}
// }
$sql = "SELECT id, client_id, secret_key FROM wp_kyc_verification";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();

	$getvalid =  $row["id"];
	$printclintidnew_njs =   $row["client_id"];
	$printsecretkeymnewjs =   $row["secret_key"];
}
// echo esc_attr( $printclintidnew_n_n );
// echo esc_attr( $printsecretkeymnew_n );


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['verification_mode'])) {
		$verificationmode = sanitize_text_field($_POST['verification_mode']);
	}
	if (isset($_POST['redirect_urlval'])) {
		$redirecturlval = sanitize_text_field($_POST['redirect_urlval']);
	}
	if (isset($_POST['show_consent'])) {
		$showconstval = sanitize_text_field($_POST['show_consent']);
	}
	if (isset($_POST['callbackval'])) {
		$callbackurljp = sanitize_text_field($_POST['callbackval']);
	}
	if (isset($_POST['privacy_policy'])) {
		$privacypolicy = sanitize_text_field($_POST['privacy_policy']);
	}
	if (isset($_POST['show_results'])) {
		$showresults = sanitize_text_field($_POST['show_results']);
	}
	if (isset($_POST['show_feedback'])) {
		$showfeedback = sanitize_text_field($_POST['show_feedback']);
	}
	if (isset($_POST['enhanced_data'])) {
		$enhanceddataval = sanitize_text_field($_POST['enhanced_data']);
	}
	if (isset($_POST['country_name'])) {
		$countryvalp = sanitize_text_field($_POST['country_name']);
	}
	if (isset($_POST['languages_val'])) {
		$languagejp = sanitize_text_field($_POST['languages_val']);
	}


	$paloadvalchk = "SELECT id, verification_mode, redirect_url, show_consent, callback_url, show_results, privacy_policy, enhanced_data, show_feedback, country, select_language FROM payloadsetting";
	$result22 = $conn->query($paloadvalchk);
	// $row11 = $result22->fetch_assoc();
	while ($row11 = $result22->fetch_assoc()) {
		$get_valdb_id = $row11['id'];
		$get_valdb_verification_mode = $row11['verification_mode'];
		$get_valdb_redirect_url = $row11['redirect_url'];
		$get_valdb_show_consent = $row11['show_consent'];
		$get_valdb_callback_url = $row11['callback_url'];
		$get_valdb_show_results = $row11['show_results'];
		$get_valdb_privacy_policy = $row11['privacy_policy'];
		$get_valdb_enhanced_data = $row11['enhanced_data'];
		$get_valdb_show_feedback = $row11['show_feedback'];
		$get_valdb_country = $row11['country'];
		$get_valdb_select_language = $row11['select_language'];
	}
	// if (isset($_POST['verification_mode']) && isset($_POST['redirect_urlval']) && isset($_POST['show_consent']) && isset($_POST['callbackval']) && isset($_POST['privacy_policy']) && isset($_POST['show_results']) && isset($_POST['show_feedback']) && isset($_POST['enhanced_data']) && isset($_POST['country_name']) && isset($_POST['languages_val']) && isset($_POST['doc_check']) && isset($_POST['face_check'])) {
	if (isset($get_valdb_id) && isset($verificationmode) && isset($redirecturlval)) {
		$valupdate = "UPDATE payloadsetting SET verification_mode='$verificationmode', redirect_url= '$redirecturlval',  show_consent= '$showconstval',  callback_url= '$callbackurljp',  show_results= '$showresults',  privacy_policy= '$privacypolicy',  enhanced_data= '$enhanceddataval',  show_feedback= '$showfeedback',  country= '$countryvalp',  select_language= '$languagejp' WHERE id=1";
		$conn->query($valupdate);
	}
	// }
	elseif (isset($verificationmode) && isset($redirecturlval) && isset($verificationmode) && isset($redirecturlval) && isset($showconstval) && isset($callbackurljp) && isset($showresults) && isset($privacypolicy) && isset($enhanceddataval) && isset($showfeedback) && isset($countryvalp) && isset($languagejp)) {
		$valinsert = "INSERT INTO payloadsetting (id, verification_mode, redirect_url, show_consent, callback_url, show_results, privacy_policy, enhanced_data, show_feedback, country, select_language) VALUES ('1', '$verificationmode', '$redirecturlval', '$showconstval', '$callbackurljp', '$showresults', '$privacypolicy', '$enhanceddataval', '$showfeedback', '$countryvalp', '$languagejp')";
		$conn->query($valinsert);
	}
}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var verificationmode = "<?php echo esc_attr($get_valdb_verification_mode) ?>",
			redirecturlval = "<?php echo esc_attr($get_valdb_redirect_url) ?>",
			showconstval = "<?php echo esc_attr($get_valdb_show_consent) ?>",
			callbackurljp = "<?php echo esc_attr($get_valdb_callback_url) ?>",
			privacypolicy = "<?php echo esc_attr($get_valdb_privacy_policy) ?>",
			showresults = "<?php echo esc_attr($get_valdb_show_results) ?>",
			showfeedback = "<?php echo esc_attr($get_valdb_show_feedback) ?>",
			enhanceddataval = "<?php echo esc_attr($get_valdb_enhanced_data) ?>",
			countryvalp = "<?php echo esc_attr($get_valdb_country) ?>",
			languagejp = "<?php echo esc_attr($get_valdb_select_language) ?>";

		if (showconstval == "on") {
			showconstval = true;
		}
		if (showresults == "on") {
			showresults = true;
		}
		if (privacypolicy == "on") {
			privacypolicy = true;
		}
		if (enhanceddataval == "on") {
			enhanceddataval = true;
		}
		if (showfeedback == "on") {
			showfeedback = true;
		}

		jQuery("input#show_consent").prop("checked", showconstval);
		jQuery("input#show_results").prop("checked", showresults);
		jQuery("input#enhanced_data").prop("checked", enhanceddataval);
		jQuery("input#privacy_policy").prop("checked", privacypolicy);
		jQuery("input#show_feedback").prop("checked", showfeedback);
		jQuery("select#verification_mode").val(verificationmode);
		jQuery("select#country_name").val(countryvalp);
		jQuery("select#languages_val").val(languagejp);
		jQuery("input#redirect_urlval").val(redirecturlval);
		jQuery("input#callbackval").val(callbackurljp);
	});
</script>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="wpsp-kyc-wizard-container">
	<div class="wpsp-kyc-steps-content">
		<!-- <h2>ShuftiPro KYC Services</h2>   -->
		<div class="wpsp-kyc-wizard-step">
			<div class="wpsp-kyc-wizard-step-illustration"><img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/kyc-banner.png'); ?>" width="500" alt=""></div>
			<div class="wpsp-kyc-wizard-step-content">
				<div class="wpsp-kyc-wizard-logo"><img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/sp_black_logo.svg'); ?>" width="160" height="50" alt="ShuftiPro logo"></div>
				<h1 class="wpsp-kyc-h1">Welcome! Let’s get you started on the right foot.</h1>
				<div class="wpsp-kyc-gap"></div>
				<p>Verify users through Digital KYC Services, and perform background checks in under 60 seconds to prevent fraud and identity theft with Shufti Pro.</p>
				<div class="wpsp-kyc-gap"></div>
				<form id="kyc_sender_form">
					<?php
					if ($getvalid == 1 && $printclintidnew_n_n && $printsecretkeymnew_n) { ?>
						<div class="wpsp-kyc-grid-two-columns">
							<label for="senderName"><span class="wpsp-kyc-wizard-label">Client ID*</span>
								<div class="wpsp-kyc-form-input kyc-full-width"><input class="clientkeynew atdis" name="username" type="password" readonly placeholder="Client ID" data-parsley-required="true" value="" required></div>
							</label>
							<label for="senderName"><span class="wpsp-kyc-wizard-label">Secret Key*</span>
								<div class="wpsp-kyc-form-input kyc-full-width"><input class="secretkey atdis" name="secretkey" type="password" readonly placeholder="Secret Key" data-parsley-required="true" value="" required></div>
							</label>
							<button type="button" class="wpsp-edit-keys"></button>
						</div>
						<p class="notenew">Note: Get Your <b>client id</b> and <b>secret key</b> from your Shufti Pro's <a target="_blank" href="https://backoffice.shuftipro.com/settings/api-keys">Backoffice.</a></p>
						<p class="wpsp-error-msg"></p>
						<div class="wpsp-kyc-gap-btn">
							<p id="submit-btn-1" class="submit-btn-1 button kyc-button kyc-full-width button-primary wpsp-update-key"><span>Update</span></p>
							<p id="submit-btn-2" class="submit-btn-1 button kyc-button kyc-full-width button-primary wpsp-cont-btn"><span>Continue</span></p>
						</div>
					<?php
					} else {
					?>
						<div class="wpsp-kyc-grid-two-columns">
							<label for="senderName"><span class="wpsp-kyc-wizard-label">Client ID*</span>
								<div class="wpsp-kyc-form-input kyc-full-width"><input class="clientkeynew" name="username" type="text" placeholder="Client ID" data-parsley-required="true" value="" required></div>
							</label>
							<label for="senderName"><span class="wpsp-kyc-wizard-label">Secret Key*</span>
								<div class="wpsp-kyc-form-input kyc-full-width"><input name="secretkey" class="secretkey" type="text" placeholder="Secret Key" data-parsley-required="true" value="" required></div>
							</label>
						</div>
						<p class="notenew">Note: Get Your <b>client id</b> and <b>secret key</b> from your Shufti Pro's <a target="_blank" href="https://backoffice.shuftipro.com/settings/api-keys">Backoffice.</a></p>
						<div class="wpsp-kyc-gap-btn">
							<p id="submit-btn-3" class="submit-btn-1 button kyc-button kyc-full-width button-primary"><span>Submit</span></p>
						</div>
					<?php
					}
					?>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="wpsp-kyc-wizard-container-step">
	<div class="wpsp-kyc-process-step">
		<img alt="back-button" class="backbtn-1" src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/back-button.png'); ?>">
		<form id="myForm" action="" method="post">
			<div class="wpsp-tab">
				<h3 class="kyc-main-heading">Settings</h3>
				<hr style="width:61.5%; margin-left:0;">
				<div class="wpsp-verification-settings">
					<div class="wpsp-kyc-verif-form">
						<div class="wpsp-kyc-col-form wpsp-form-left-col">
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading"> Verification Mode
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">What kind of proofs would you like to provide for verification?</span>
									</div>
								</h5>
								<select name="verification_mode" id="verification_mode">
									<option value="any" selected>Any</option>
									<option value="image_only">Image Only</option>
									<option value="video_only">Video Only</option>
								</select>
							</div>
							<div class="row wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading">Country
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">User can Select their Country for verification</span>
									</div>
								</h5>
								<select id="country_name" name="country_name">
									<option value=""> Select Country </option>
									<option value="AF"> Afghanistan </option>
									<option value="AX"> Aland Islands </option>
									<option value="AL"> Albania </option>
									<option value="DZ"> Algeria </option>
									<option value="AS"> American Samoa </option>
									<option value="AD"> Andorra </option>
									<option value="AO"> Angola </option>
									<option value="AI"> Anguilla </option>
									<option value="AQ"> Antarctica </option>
									<option value="AG"> Antigua and Barbuda </option>
									<option value="AR"> Argentina </option>
									<option value="AM"> Armenia </option>
									<option value="AW"> Aruba </option>
									<option value="AU"> Australia </option>
									<option value="AT"> Austria </option>
									<option value="AZ"> Azerbaijan </option>
									<option value="BS"> Bahamas </option>
									<option value="BH"> Bahrain </option>
									<option value="BD"> Bangladesh </option>
									<option value="BB"> Barbados </option>
									<option value="BY"> Belarus </option>
									<option value="BE"> Belgium </option>
									<option value="BZ"> Belize </option>
									<option value="BJ"> Benin </option>
									<option value="BM"> Bermuda </option>
									<option value="BT"> Bhutan </option>
									<option value="BO"> Bolivia </option>
									<option value="BA"> Bosnia and Herzegovina </option>
									<option value="BW"> Botswana </option>
									<option value="BV"> Bouvet Island </option>
									<option value="BR"> Brazil </option>
									<option value="IO"> British Indian Ocean Territory </option>
									<option value="BN"> Brunei </option>
									<option value="BG"> Bulgaria </option>
									<option value="BF"> Burkina Faso </option>
									<option value="MM"> Burma (Myanmar) </option>
									<option value="BI"> Burundi </option>
									<option value="KH"> Cambodia </option>
									<option value="CM"> Cameroon </option>
									<option value="CA"> Canada </option>
									<option value="CV"> Cape Verde </option>
									<option value="KY"> Cayman Islands </option>
									<option value="CF"> Central African Republic </option>
									<option value="TD"> Chad </option>
									<option value="CL"> Chile </option>
									<option value="CN"> China </option>
									<option value="CX"> Christmas Island </option>
									<option value="CC"> Cocos (Keeling) Islands </option>
									<option value="CO"> Colombia </option>
									<option value="KM"> Comoros </option>
									<option value="CD"> Congo, Dem. Republic </option>
									<option value="CG"> Congo, Republic </option>
									<option value="CK"> Cook Islands </option>
									<option value="CR"> Costa Rica </option>
									<option value="HR"> Croatia </option>
									<option value="CU"> Cuba </option>
									<option value="CY"> Cyprus </option>
									<option value="CZ"> Czech Republic </option>
									<option value="DK"> Denmark </option>
									<option value="DJ"> Djibouti </option>
									<option value="DM"> Dominica </option>
									<option value="DO"> Dominican Republic </option>
									<option value="TL"> East Timor </option>
									<option value="EC"> Ecuador </option>
									<option value="EG"> Egypt </option>
									<option value="SV"> El Salvador </option>
									<option value="GQ"> Equatorial Guinea </option>
									<option value="ER"> Eritrea </option>
									<option value="EE"> Estonia </option>
									<option value="ET"> Ethiopia </option>
									<option value="FK"> Falkland Islands </option>
									<option value="FO"> Faroe Islands </option>
									<option value="FJ"> Fiji </option>
									<option value="FI"> Finland </option>
									<option value="FR"> France </option>
									<option value="GF"> French Guiana </option>
									<option value="PF"> French Polynesia </option>
									<option value="TF"> French Southern Territories </option>
									<option value="GA"> Gabon </option>
									<option value="GM"> Gambia </option>
									<option value="GE"> Georgia </option>
									<option value="DE"> Germany </option>
									<option value="GH"> Ghana </option>
									<option value="GI"> Gibraltar </option>
									<option value="GR"> Greece </option>
									<option value="GL"> Greenland </option>
									<option value="GD"> Grenada </option>
									<option value="GP"> Guadeloupe </option>
									<option value="GU"> Guam </option>
									<option value="GT"> Guatemala </option>
									<option value="GG"> Guernsey </option>
									<option value="GN"> Guinea </option>
									<option value="GW"> Guinea-Bissau </option>
									<option value="GY"> Guyana </option>
									<option value="HT"> Haiti </option>
									<option value="HM"> Heard Island and McDonald Islands </option>
									<option value="HN"> Honduras </option>
									<option value="HK"> HongKong </option>
									<option value="HU"> Hungary </option>
									<option value="IS"> Iceland </option>
									<option value="IN"> India </option>
									<option value="ID"> Indonesia </option>
									<option value="IR"> Iran </option>
									<option value="IQ"> Iraq </option>
									<option value="IE"> Ireland </option>
									<option value="IL"> Israel </option>
									<option value="IT"> Italy </option>
									<option value="CI"> Ivory Coast </option>
									<option value="JM"> Jamaica </option>
									<option value="JP"> Japan </option>
									<option value="JE"> Jersey </option>
									<option value="JO"> Jordan </option>
									<option value="KZ"> Kazakhstan </option>
									<option value="KE"> Kenya </option>
									<option value="KI"> Kiribati </option>
									<option value="KP"> Korea, Dem. Republic of </option>
									<option value="KW"> Kuwait </option>
									<option value="KG"> Kyrgyzstan </option>
									<option value="LA"> Laos </option>
									<option value="LV"> Latvia </option>
									<option value="LB"> Lebanon </option>
									<option value="LS"> Lesotho </option>
									<option value="LR"> Liberia </option>
									<option value="LY"> Libya </option>
									<option value="LI"> Liechtenstein </option>
									<option value="LT"> Lithuania </option>
									<option value="LU"> Luxemburg </option>
									<option value="MO"> Macau </option>
									<option value="MK"> Macedonia </option>
									<option value="MG"> Madagascar </option>
									<option value="MW"> Malawi </option>
									<option value="MY"> Malaysia </option>
									<option value="MV"> Maldives </option>
									<option value="ML"> Mali </option>
									<option value="MT"> Malta </option>
									<option value="IM"> Man Island </option>
									<option value="MH"> Marshall Islands </option>
									<option value="MQ"> Martinique </option>
									<option value="MR"> Mauritania </option>
									<option value="MU"> Mauritius </option>
									<option value="YT"> Mayotte </option>
									<option value="MX"> Mexico </option>
									<option value="FM"> Micronesia </option>
									<option value="MD"> Moldova </option>
									<option value="MC"> Monaco </option>
									<option value="MN"> Mongolia </option>
									<option value="ME"> Montenegro </option>
									<option value="MS"> Montserrat </option>
									<option value="MA"> Morocco </option>
									<option value="MZ"> Mozambique </option>
									<option value="NA"> Namibia </option>
									<option value="NR"> Nauru </option>
									<option value="NP"> Nepal </option>
									<option value="NL"> Netherlands </option>
									<option value="AN"> Netherlands Antilles </option>
									<option value="NC"> New Caledonia </option>
									<option value="NZ"> New Zealand </option>
									<option value="NI"> Nicaragua </option>
									<option value="NE"> Niger </option>
									<option value="NG"> Nigeria </option>
									<option value="NU"> Niue </option>
									<option value="NF"> Norfolk Island </option>
									<option value="MP"> Northern Mariana Islands </option>
									<option value="NO"> Norway </option>
									<option value="OM"> Oman </option>
									<option value="PK"> Pakistan </option>
									<option value="PW"> Palau </option>
									<option value="PS"> Palestinian Territories </option>
									<option value="PA"> Panama </option>
									<option value="PG"> Papua New Guinea </option>
									<option value="PY"> Paraguay </option>
									<option value="PE"> Peru </option>
									<option value="PH"> Philippines </option>
									<option value="PN"> Pitcairn </option>
									<option value="PL"> Poland </option>
									<option value="PT"> Portugal </option>
									<option value="PR"> Puerto Rico </option>
									<option value="QA"> Qatar </option>
									<option value="RE"> Reunion Island </option>
									<option value="RO"> Romania </option>
									<option value="RU"> Russian Federation </option>
									<option value="RW"> Rwanda </option>
									<option value="XK"> Republic of Kosovo </option>
									<option value="BL"> Saint Barthelemy </option>
									<option value="KN"> Saint Kitts and Nevis </option>
									<option value="LC"> Saint Lucia </option>
									<option value="MF"> Saint Martin </option>
									<option value="PM"> Saint Pierre and Miquelon </option>
									<option value="VC"> Saint Vincent and the Grenadines </option>
									<option value="WS"> Samoa </option>
									<option value="SM"> San Marino </option>
									<option value="SA"> Saudi Arabia </option>
									<option value="SN"> Senegal </option>
									<option value="RS"> Serbia </option>
									<option value="SC"> Seychelles </option>
									<option value="SL"> Sierra Leone </option>
									<option value="SG"> Singapore </option>
									<option value="SK"> Slovakia </option>
									<option value="SI"> Slovenia </option>
									<option value="SB"> Solomon Islands </option>
									<option value="SO"> Somalia </option>
									<option value="ZA"> South Africa </option>
									<option value="GS"> South Georgia and the South Sandwich Islands </option>
									<option value="KR"> South Korea </option>
									<option value="ES"> Spain </option>
									<option value="LK"> Sri Lanka </option>
									<option value="SD"> Sudan </option>
									<option value="SR"> Suriname </option>
									<option value="SJ"> Svalbard and Jan Mayen </option>
									<option value="SZ"> Swaziland </option>
									<option value="SE"> Sweden </option>
									<option value="CH"> Switzerland </option>
									<option value="SY"> Syria </option>
									<option value="ST"> São Tomé and Príncipe </option>
									<option value="TW"> Taiwan </option>
									<option value="TJ"> Tajikistan </option>
									<option value="TZ"> Tanzania </option>
									<option value="TH"> Thailand </option>
									<option value="TG"> Togo </option>
									<option value="TK"> Tokelau </option>
									<option value="TO"> Tonga </option>
									<option value="TT"> Trinidad and Tobago </option>
									<option value="TN"> Tunisia </option>
									<option value="TR"> Turkey </option>
									<option value="TM"> Turkmenistan </option>
									<option value="TC"> Turks and Caicos Islands </option>
									<option value="TV"> Tuvalu </option>
									<option value="UG"> Uganda </option>
									<option value="UA"> Ukraine </option>
									<option value="AE"> United Arab Emirates </option>
									<option value="GB"> United Kingdom </option>
									<option value="US"> United States </option>
									<option value="UM"> United States Minor Outlying Islands </option>
									<option value="UY"> Uruguay </option>
									<option value="UZ"> Uzbekistan </option>
									<option value="VU"> Vanuatu </option>
									<option value="VA"> Vatican City State </option>
									<option value="VE"> Venezuela </option>
									<option value="VN"> Vietnam </option>
									<option value="VG"> Virgin Islands (British) </option>
									<option value="VI"> Virgin Islands (U.S.) </option>
									<option value="WF"> Wallis and Futuna </option>
									<option value="EH"> Western Sahara </option>
									<option value="YE"> Yemen </option>
									<option value="ZM"> Zambia </option>
									<option value="ZW"> Zimbabwe </option>
								</select>
							</div>
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading"> Select Language
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">User can Select their Language for verification</span>
									</div>
								</h5>
								<select id="languages_val" name="languages_val">
									<option value=""> Select Language </option>
									<option value="AF"> Afrikaans </option>
									<option value="SQ"> Albanian </option>
									<option value="AM"> Amharic </option>
									<option value="AR"> Arabic </option>
									<option value="HY"> Armenian </option>
									<option value="AZ"> Azerbaijani </option>
									<option value="EU"> Basque </option>
									<option value="BE"> Belarusian </option>
									<option value="BN"> Bengali </option>
									<option value="BS"> Bosnian </option>
									<option value="BG"> Bulgarian </option>
									<option value="MY"> Burmese </option>
									<option value="CA"> Catalan </option>
									<option value="NY"> Chichewa </option>
									<option value="ZH"> Chinese </option>
									<option value="CO"> Corsican </option>
									<option value="HR"> Croatian </option>
									<option value="CS"> Czech </option>
									<option value="DA"> Danish </option>
									<option value="NL"> Dutch </option>
									<option value="EN"> English </option>
									<option value="EO"> Esperanto </option>
									<option value="ET"> Estonian </option>
									<option value="TL"> Filipino </option>
									<option value="FI"> Finnish </option>
									<option value="FR"> French </option>
									<option value="FY"> Frisian </option>
									<option value="GL"> Galician </option>
									<option value="KA"> Georgian </option>
									<option value="DE"> German </option>
									<option value="EL"> Greek (modern) </option>
									<option value="GU"> Gujarati </option>
									<option value="HT"> Haitian, Haitian Creole </option>
									<option value="HA"> Hausa </option>
									<option value="HE"> Hebrew (modern) </option>
									<option value="HI"> Hindi </option>
									<option value="HU"> Hungarian </option>
									<option value="ID"> Indonesian </option>
									<option value="GA"> Irish </option>
									<option value="IG"> Igbo </option>
									<option value="IS"> Icelandic </option>
									<option value="IT"> Italian </option>
									<option value="JA"> Japanese </option>
									<option value="JV"> Javanese </option>
									<option value="KN"> Kannada </option>
									<option value="KK"> Kazakh </option>
									<option value="KM"> Khmer </option>
									<option value="KY"> Kirghiz, Kyrgyz </option>
									<option value="KO"> Korean </option>
									<option value="KU"> Kurdish </option>
									<option value="LA"> Latin </option>
									<option value="LB"> Luxembourgish, Letzeburgesch </option>
									<option value="LO"> Lao </option>
									<option value="LT"> Lithuanian </option>
									<option value="LV"> Latvian </option>
									<option value="MK"> Macedonian </option>
									<option value="MG"> Malagasy </option>
									<option value="MS"> Malay </option>
									<option value="ML"> Malayalam </option>
									<option value="MT"> Maltese </option>
									<option value="MI"> Maori </option>
									<option value="MR"> Marathi </option>
									<option value="MN"> Mongolian </option>
									<option value="NE"> Nepali </option>
									<option value="NO"> Norwegian </option>
									<option value="PA"> Punjabi </option>
									<option value="FA"> Persian </option>
									<option value="PL"> Polish </option>
									<option value="PS"> Pashto </option>
									<option value="PT"> Portuguese </option>
									<option value="RO"> Romanian </option>
									<option value="RU"> Russian </option>
									<option value="SD"> Sindhi </option>
									<option value="SM"> Samoan </option>
									<option value="SR"> Serbian </option>
									<option value="GD"> Scottish Gaelic </option>
									<option value="SN"> Shona </option>
									<option value="SI"> Sinhala </option>
									<option value="SK"> Slovak </option>
									<option value="SL"> Slovenian </option>
									<option value="SO"> Somali </option>
									<option value="ST"> Sesotho </option>
									<option value="ES"> Spanish </option>
									<option value="SU"> Sundanese </option>
									<option value="SW"> Swahili </option>
									<option value="SV"> Swedish </option>
									<option value="TA"> Tamil </option>
									<option value="TE"> Telugu </option>
									<option value="TG"> Tajik </option>
									<option value="TH"> Thai </option>
									<option value="TR"> Turkish </option>
									<option value="UK"> Ukrainian </option>
									<option value="UR"> Urdu </option>
									<option value="UZ"> Uzbek </option>
									<option value="VI"> Vietnamese </option>
									<option value="CY"> Welsh </option>
									<option value="XH"> Xhosa </option>
									<option value="YI"> Yiddish </option>
									<option value="YO"> Yoruba </option>
									<option value="ZU"> Zulu </option>
								</select>
							</div>
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading">Redirect URL
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">URL where user will be redirected after verification</span>
									</div>
								</h5>
								<input name="redirect_urlval" type="url" placeholder="http://www.yourdomain.com" class="redirect_url" id="redirect_urlval" pattern="https?://.+">
							</div>
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading">Callback URL
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">Allows the clients to keep the request updated on their end</span>
									</div>
								</h5>
								<input type="text" placeholder="http://www.yourdomain.com" class="callback" name="callbackval" id="callbackval" pattern="https?://.+">
							</div>
						</div>
						<div class="wpsp-kyc-col-form">
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading">Allow Online
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">User have to capture a live image(s).</span>
									</div>
								</h5>

								<label class="switch">
									<input type="checkbox" id="show_consent" name="show_consent">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading">Allow Offline
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">Users can upload images</span>
									</div>
								</h5>
								<label class="switch">
									<input type="checkbox" id="privacy_policy" name="privacy_policy">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading">Show Results
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">Verification Results will be shown to end-user</span>
									</div>
								</h5>
								<label class="switch">
									<input type="checkbox" id="show_results" name="show_results">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="row wpsp-justify-content-center wpsp-hd-face">
								<h5 class="wpsp-selection-heading">Enhanced Data
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">Successfully fetch additional verification data</span>
									</div>
								</h5>
								<label class="switch">
									<input type="checkbox" id="enhanced_data" name="enhanced_data">
									<span class="slider round"></span>
								</label>
							</div>
							<div class="wpsp-justify-content-center">
								<h5 class="wpsp-selection-heading"> Show Feedback
									<div class="tooltip">
										<span class="icon p-cehcked"></span>
										<span class="tooltiptext">Feedback form is displayed to the end-user</span>
									</div>
								</h5>
								<label class="switch">
									<input type="checkbox" id="show_feedback" name="show_feedback">
									<span class="slider round"></span>
								</label>
							</div>


						</div>
						<div class="wpsp-kyc-col-form wpsp-form-img">
						</div>
					</div>
				</div>
			</div>
			<!-- here popup model  -->
			<div class="popupmodalnew">
				<img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/Cross-icon.svg'); ?>" class="popcrossicon">
				<h2>You are verified.</h2>
				<p class="popuptext">If you want to live this for your end user, then click on "Go Live" button.</p>
				<button type="submit" id='savesettin' disabled>Go Live</button>
				<p class="popuptext">For end-user verification, you may generate a short code for the button by clicking "Generate Short Code". You may apply this generated code at your site.</p>
				<p class="generate-shortcode">Generate Shortcode</p>
				<div class="wpsp-btn-shortcode">
					<span id="wpsp-shortcode"> </span>
					<span class="dashicons dashicons-admin-page copy-icon" id="wpsp-copy-btn" onclick="myFunction('#wpsp-shortcode')"></span>
					<p class="wpsp-copied">Copied.</p>
				</div>
			</div>
			<!-- here popup model ends  -->
			<script>
				jQuery("img.popcrossicon").click(function() {
					jQuery(".popupmodalnew").fadeOut();
					jQuery(".wpsp-kyc-process-step").removeClass('wpopacityaddnew');
				})
				setInterval(function() {
					if (jQuery('p.wpsp-copied').is(':visible')) {
						setTimeout(function() {
							jQuery('p.wpsp-copied').fadeOut();
							console.log("hide")
						}, 4000);
					}
				}, 1000)

				// Log the concatenated string to the console
				jQuery('.generate-shortcode').click(function() {
					jQuery('#wpsp-shortcode').html('[kyc_live]');
					jQuery('.wpsp-btn-shortcode').show();
				})

				function copyToClipboard(text) {
					var sampleTextarea = document.createElement("textarea");
					document.body.appendChild(sampleTextarea);
					sampleTextarea.value = text; //save main text in it
					sampleTextarea.select(); //select textarea contenrs
					document.execCommand("copy");
					document.body.removeChild(sampleTextarea);
				}

				function myFunction() {
					var copyText = document.getElementById("wpsp-shortcode");
					copyToClipboard('[kyc_live]');
					jQuery('.wpsp-copied').show();
				}
			</script>

		</form>
		<div style="overflow:auto; display:inline">
			<div class="wpsp-live-btn-row">
				<!-- <button type="button" class="previous">Previous</button> -->
				<!-- <button type="button" id="wpsp-next-btn" disabled class="next">Proceed</button> -->
				<button type="button" id="quick-kyc-btn" class="submit wpsp-serv-btn">Try Demo</button>
			</div>
		</div>


	</div>
	<div class="face-verification-s">
		<img alt="back-button" class="backbtn-2" src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/back-button.png'); ?>">
		<h3 class="kyc-main-heading">Face Verification</h3>
		<div class="wpsp-justify-content-center">
			<h5 class="wpsp-selection-heading"> Duplicate Account Detection
			<div class="tooltip">
				<span class="icon p-cehcked"></span>
				<span class="tooltiptext">Detect duplicate account using face mapping technology</span>
			</div>
			</h5>
			<label class="switch">
				<input type="checkbox" id="check_duplicate_request" name="check_duplicate_request">
				<span class="slider round"></span>
			</label>
		</div>
		<p class="submit-btn-5 button-primary">Continue</p>
	</div>
	<div class="document-verification-s">
		<img alt="back-button" class="backbtn-3" src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/back-button.png'); ?>">
		<h3 class="kyc-main-heading">Document Verification</h3>
        <div class="section">
            <h2>Types of Proof</h2>
            <label><input type="radio" name="proof_type_doc" value="image_only"  checked="checked"> Image Only</label>
            <label><input type="radio" name="proof_type_doc" value="video_only"> Video Only</label>
            <label><input type="radio" name="proof_type_doc" value="any"> Both</label>
        </div>

        <div class="section">
            <h2>Select Document Types*</h2>
            <label><input type="checkbox" name="document_type" value="id_card"> ID Card</label>
            <label><input type="checkbox" name="document_type" value="driving_license"> Driving License</label>
            <label><input type="checkbox" name="document_type" value="passport"> Passport</label>
            <label><input type="checkbox" name="document_type" value="credit_or_debit_card"> Credit/Debit Card</label>
        </div>

        <div class="section">
            <h2>Document’s Backside Proof</h2>
            <label><input type="radio" name="backside_proof_doc" value="required"  checked="checked"> Required</label>
            <label><input type="radio" name="backside_proof_doc" value="not_required"> Not Required</label>
        </div>

		<div class="section">
            <h2>Extended Document Settings</h2>
            <label><input type="checkbox" name="extended_settings" value="allow_paper_based"> Allow Paper Based</label>
            <label><input type="checkbox" name="extended_settings" value="allow_photocopy"> Allow Photocopy</label>
            <label><input type="checkbox" name="extended_settings" value="allow_laminated"> Allow Lamination</label>
            <label><input type="checkbox" name="extended_settings" value="allow_screenshot"> Allow Screenshot</label>
            <label><input type="checkbox" name="extended_settings" value="allow_cropped"> Allow Cropped</label>
            <label><input type="checkbox" name="extended_settings" value="allow_scanned"> Allow Scanned</label>
        </div>

        <div class="section">
            <h2>Data Extraction &amp; Verification*</h2>
            <label><input type="checkbox" name="data_extraction" value="name"> Name<label style="width: 100%;margin-left: 0;display: none;"><input type="checkbox" value="fuzzy_match"> Allow Name Partial Match</label></label>
            <label><input type="checkbox" name="data_extraction" value="document_number"> Document Number</label>
            <label><input type="checkbox" name="data_extraction" value="date_of_birth"> Date of Birth</label>
            <label><input type="checkbox" name="data_extraction" value="issue_date"> Issue Date</label>
            <label><input type="checkbox" name="data_extraction" value="expiry_date"> Expiry Date</label>
            <label><input type="checkbox" name="data_extraction" value="gender"> Gender</label>
            <label><input type="checkbox" name="data_extraction" value="age"> Age Verification with min or max range<label style="width: 100%;margin-left: 0;display: none;"><input type="number" value="min" min="1" max="170"> Minimum Age</label><label style="width: 100%;margin-left: 0;display: none;"><input type="number" value="max" min="1" max="170"> Maximum Age</label></label>
        </div>
		<p class="submit-btn-6 button-primary">Continue</p>
	</div>
	<div class="address-verification-s">
		<img alt="back-button" class="backbtn-4" src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/back-button.png'); ?>">
		<h3 class="kyc-main-heading">Address Verification</h3>
		<div class="section">
			<h2>Types of Proof</h2>
			<label><input type="radio" name="proof_type_address" value="image_only" checked> Image Only</label>
			<label><input type="radio" name="proof_type_address" value="video_only"> Video Only</label>
			<label><input type="radio" name="proof_type_address" value="any"> Both</label>
		</div>

		<div class="section">
			<h2>Supported Document Types*</h2>
			<label><input type="checkbox" name="document_type" value="id_card"> ID Card</label>
			<label><input type="checkbox" name="document_type" value="driving_license"> Driving License</label>
			<label><input type="checkbox" name="document_type" value="passport"> Passport</label>
			<label><input type="checkbox" name="document_type" value="utility_bill"> Utility Bill</label>
			<label><input type="checkbox" name="document_type" value="bank_statement"> Bank Statement</label>
			<label><input type="checkbox" name="document_type" value="rent_agreement"> Rent Agreement</label>
			<label><input type="checkbox" name="document_type" value="tax_bill"> Tax Bill</label>
			<label><input type="checkbox" name="document_type" value="employer_letter"> Employer Letter</label>
			<label><input type="checkbox" name="document_type" value="insurance_agreement"> Insurance Agreement</label>
			<label><input type="checkbox" name="document_type" value="envelope"> Envelope</label>
			<label><input type="checkbox" name="document_type" value="cpr_smart_card_reader_copy"> CPR Smart Card</label>
			<label><input type="checkbox" name="document_type" value="permanent_residence_permit"> Permanent Residence Permit</label>
			<label><input type="checkbox" name="document_type" value="lease_agreement"> Lease Agreement</label>
			<label><input type="checkbox" name="document_type" value="birth_certificate"> Birth Certificate</label>
			<label><input type="checkbox" name="document_type" value="insurance_card"> Insurance Card</label>
			<label><input type="checkbox" name="document_type" value="e_commerce_receipt"> E-Commerce Receipt</label>
			<label><input type="checkbox" name="document_type" value="property_tax"> Property Tax</label>
			<label><input type="checkbox" name="document_type" value="insurance_policy"> Insurance Policy</label>
			<label><input type="checkbox" name="document_type" value="salary_slip"> Salary Slip</label>
			<label><input type="checkbox" name="document_type" value="credit_card_statement"> Credit Card Statement</label>
			<label><input type="checkbox" name="document_type" value="any"> Others (Allow any other valid document with an address and name on it)</label>
		</div>

		<div class="section">
			<h2>Document’s Backside Proof</h2>
			<label><input type="radio" name="backside_proof" value="required" checked> Required</label>
			<label><input type="radio" name="backside_proof" value="not_required"> Not Required</label>
		</div>

		<div class="section">
			<h2>Extended Address Settings</h2>
			<label><input type="checkbox" name="extended_settings" value="allow_paper_based"> Allow Paper Based</label>
			<label><input type="checkbox" name="extended_settings" value="allow_photocopy"> Allow Photocopy</label>
			<label><input type="checkbox" name="extended_settings" value="allow_laminated"> Allow Lamination</label>
			<label><input type="checkbox" name="extended_settings" value="allow_screenshot"> Allow Screenshot</label>
			<label><input type="checkbox" name="extended_settings" value="allow_cropped"> Allow Cropped</label>
			<label><input type="checkbox" name="extended_settings" value="allow_scanned"> Allow Scanned</label>
		</div>

		<div class="section">
			<h2>Data Extraction &amp; Verification*</h2>
			<label><input type="checkbox" name="data_extraction" value="name"> Name<label style="width: 100%;margin-left: 0;display: none;"><input type="checkbox" value="fuzzy_match"> Allow Name Partial Match</label></label>
			<label><input type="checkbox" name="data_extraction" value="full_address" onclick="return false;" checked> Address<label style="width: 100%;margin-left: 0;display: none;"><input type="checkbox" name="data_extraction" value="address_fuzzy_match"> Allow Address Partial Match</label></label>
			<label><input type="checkbox" name="data_extraction" value="issue_date"> Issue Date</label>
		</div>
		<p class="submit-btn-7 button-primary">Continue</p>
	</div>
	<div class="showservices">
		<div class="showservices-inr showservices-inr-1">
			<img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/kyc-img.svg'); ?>" class="animation-img">
			<h4 class="service-name">Basic KYC</h4>
			<p>Verify via live video, image, or upload a selfie.</p>
		</div>
		<div class="showservices-inr showservices-inr-2">
			<img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/kyc-img.svg'); ?>" class="animation-img">
			<h4 class="service-name">Detailed KYC</h4>
			<p>Verify via live video, image, or upload a selfie.</p>
		</div>
	</div>
	<div class="show-kyc-services">
		<img alt="back-button" class="backbtn" src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/back-button.png'); ?>">
		<div class="show-kyc-services-inr show-kyc-services-inr-1" data-name="face">
			<img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/face-verification.svg'); ?>" class="animation-img">
			<h4 class="service-name">Face Verification</h4>
			<p>Verify via live video, image, or upload a selfie.</p>
		</div>
		<div class="show-kyc-services-inr show-kyc-services-inr-2" data-name="document">
			<img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/document-verification.svg'); ?>" class="animation-img">
			<h4 class="service-name">Document Verification</h4>
			<p>Verify the authenticity of an ID document.</p>
		</div>
		<div class="show-kyc-services-inr show-kyc-services-inr-3" data-name="address">
			<img src="<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'images/address-verification.svg'); ?>" class="animation-img">
			<h4 class="service-name">Address Verification</h4>
			<p>Verify the authenticity of an address document.</p>
		</div>
		<p class="submit-btn-4 button-primary">Continue</p>
	</div>
</div>
</div>
<div class="newpreloader">
	<div class="loader"></div>
	<p>Your verification demo is processing...</p>
</div>
</div>
</div>


<script>
	jQuery(document).ready(function() {
		jQuery("input#show_consent, input#privacy_policy").prop("checked", true);
		jQuery("select#verification_mode").val("any");
		jQuery('input, select').on('input', function(e) {
			jQuery(".wpsp-live-btn-row").show()
			jQuery("p.generate-shortcode").hide()
			jQuery("#quick-kyc-btn").removeAttr('disabled')
		})
		// jQuery("#myForm").multiStepForm({
		// 	// defaultStep:0,
		// 	beforeSubmit: function(form, submit) {
		// 		console.log("called before submiting the form");
		// 		console.log(form);
		// 		console.log(submit);
		// 	},
		// }).navigateTo(0);
		jQuery('.address-verification-s input[value="full_address"], .address-verification-s input[value="age"], .document-verification-s input[value="age"]').on('change', function() {
			if (jQuery(this).is(":checked")) {
				jQuery(this).parent("label").find("label").show();
			} else {
				jQuery(this).parent("label").find("label").hide();
			}
		});
		jQuery('.address-verification-s input[value="name"], .document-verification-s input[value="name"]').on('change', function() {
			if (jQuery(this).is(":checked")) {
				jQuery(this).parent("label").find("label").show();
			} else {
				jQuery(this).parent("label").find("label").hide();
			}
		});
		
		$('.document-verification-s input[value="min"], .document-verification-s input[value="max"]').on('input', function() {
			var value = $(this).val();
			if (value < 1) {
				$(this).val(1);
			} else if (value > 170) {
				$(this).val(170);
			}
		});
	});
	function updatedata() {
        verificationmode = document.querySelector("#verification_mode").value,
		redirecturlval = jQuery("#redirect_urlval").val(),
		showconstval = jQuery("#show_consent").prop('checked') == false ? '0' : '1';
		callbackurljp = jQuery("#callbackval").val(),
		privacypolicy = jQuery("#privacy_policy").prop('checked') == false ? '0' : '1',
		showresults = jQuery("#show_results").prop('checked') == false ? '0' : '1',
		showfeedback = jQuery("#show_feedback").prop('checked') == false ? '0' : '1',
		enhanceddataval = jQuery("#enhanced_data").prop('checked') == false ? '0' : '1',
		countryvalp = jQuery("#country_name").val(),
		languagejp = jQuery("#languages_val").val(),
		
		check_face_duplication = jQuery("input#check_duplicate_request").prop('checked') == false ? '0' : '1',

		proofTypeDoc = jQuery('.document-verification-s input[name="proof_type_doc"]:checked').val(),
		documentTypesDoc = [],
		backsideProofDoc = jQuery('.document-verification-s input[name="backside_proof_doc"]:checked').val() === 'required' ? '1' : '0',
		extendedSettingsDoc = {
        "allow_paper_based": 0,
        "allow_photocopy": 0,
        "allow_laminated": 0,
        "allow_screenshot": 0,
        "allow_cropped": 0,
        "allow_scanned": 0
    	},
		dataExtractionDoc = {},

		proofTypeAdd = jQuery('.address-verification-s input[name="proof_type_address"]:checked').val(),
		addressTypesAdd = [],
		backsideProofAdd = jQuery('.address-verification-s  input[name="backside_proof_doc"]:checked').val() === 'required' ? '1' : '0',
		extendedSettingsAdd = {
        "allow_paper_based": 0,
        "allow_photocopy": 0,
        "allow_laminated": 0,
        "allow_screenshot": 0,
        "allow_cropped": 0,
        "allow_scanned": 0
    	},
		dataExtractionAdd = {},


		jQuery('.document-verification-s input[name="document_type"]:checked').each(function() {
			documentTypesDoc.push(jQuery(this).val());
		});
		jQuery('.document-verification-s input[name="extended_settings"]:checked').each(function() {
			extendedSettingsDoc[$(this).val()] = 1;
		});
		var dataExtractionDoc = {};

		// Extract checked data extraction values
		jQuery('.document-verification-s input[name="data_extraction"]:checked').each(function() {
			dataExtractionDoc[$(this).val()] = "";
		});

		// Check if the age input is checked
		if (jQuery('.document-verification-s input[name="data_extraction"][value="age"]').is(':checked')) {
			var minAge = jQuery('.document-verification-s input[value="min"]').val();
			var maxAge = jQuery('.document-verification-s input[value="max"]').val();
			
			// Add age key with min and max values to the dataExtractionDoc object
			dataExtractionDoc['age'] = {
				"min": minAge,
				"max": maxAge
			};
		}
		// Check if the age input is checked
		if (jQuery('.document-verification-s input[name="data_extraction"][value="name"]').is(':checked') && jQuery('.document-verification-s input[value="fuzzy_match"]').prop('checked')) {
			var namefuzzy = jQuery('.document-verification-s input[value="fuzzy_match"]').prop('checked') == false ? '0' : '1';
			
			// Add age key with min and max values to the dataExtractionDoc object
			dataExtractionDoc['name'] = {
				"fuzzy_match": namefuzzy,
			};
		}


		jQuery('.address-verification-s input[name="document_type"]:checked').each(function() {
			addressTypesAdd.push(jQuery(this).val());
		});
		jQuery('.address-verification-s input[name="extended_settings"]:checked').each(function() {
			extendedSettingsAdd[$(this).val()] = 1;
		});
		jQuery('.address-verification-s input[name="data_extraction"]:checked').each(function() {
			dataExtractionAdd[$(this).val()] = "";
		});
		// Check if the age input is checked
		if (jQuery('.address-verification-s input[name="data_extraction"][value="name"]').is(':checked') && jQuery('.address-verification-s input[value="fuzzy_match"]').prop('checked')) {
			var namefuzzyadd = jQuery('.address-verification-s input[value="fuzzy_match"]').prop('checked') == false ? '0' : '1';
			
			// Add age key with min and max values to the dataExtractionDoc object
			dataExtractionAdd['name'] = {
				"fuzzy_match": namefuzzyadd,
			};
		}
        // if (!redirecturlval) {
        // 	redirecturlval = window.location.href;
        // }
        // on click quick kyc button start
        var newrefnumber = "wp_" + Math.random().toString(36).slice(2);
        localStorage.setItem('newrefnumber', newrefnumber)
        let payload = {
            email: "",
            reference: newrefnumber,
            verification_mode: verificationmode,
            redirect_url: redirecturlval,
            show_consent: "1",
            show_privacy_policy: "1",
            allow_online: showconstval,
            allow_offline: privacypolicy,
            callback_url: callbackurljp,
            show_results: showresults,
            fetch_enhanced_data: enhanceddataval,
            show_feedback_form: showfeedback,
            country: countryvalp,
            "initiated_source": "wordpress",
            "initiated_source_version": "1.1.6",
            language: languagejp
        }
		if(jQuery(".show-kyc-services-inr-1").hasClass("activn")){
			payload['face'] = {
				"proof": "",
				"allow_offline" : "1",
				"allow_online" : "1",
				"verification_mode": "any",
				"check_duplicate_request" : check_face_duplication
			}
		}
		if(jQuery(".show-kyc-services-inr-2").hasClass("activn")){
			payload['document'] = {	
				"full_address": "",
				'verification_mode': proofTypeDoc,
				'supported_types': documentTypesDoc,
				'backside_proof_required': backsideProofDoc,
				'verification_instructions': extendedSettingsDoc,
				...dataExtractionDoc
			}
		}
		if(jQuery(".show-kyc-services-inr-3").hasClass("activn")){
			payload['address'] = {	
				"full_address": "",
				"proof": "",
				"enhanced_address_verification": "1",
				'verification_mode': proofTypeAdd,
				'supported_types': addressTypesAdd,
				'backside_proof_required': backsideProofAdd,
				'verification_instructions': extendedSettingsAdd, //change this into json
				...dataExtractionAdd
			}
		}
		else{
			payload['face'] = {
				proof: ""
			}
			payload['document'] = {
				proof: ""
			}
		}
        // var token = btoa("<?php echo esc_attr($printclintidnew_n_n . ':' . $printsecretkeymnew_n) ?>");
		// if(!token){
		var nclientkeyew = jQuery('input.clientkeynew').val();
		var nsecretkeyew = jQuery('input.secretkey').val();
		var token = btoa(nclientkeyew + ':' + nsecretkeyew);
		// }
        fetch('https://api.shuftipro.com/', {
            method: 'post',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Basic ' + token
            },
            body: JSON.stringify(payload)
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            console.log(data);
            if (data.verification_url && data.verification_url !== undefined) {
                window.open(data.verification_url);
            }
            else if (data.event == "request.invalid" && data.error) {
                clearInterval(interval);
                jQuery("#wpsp-kyc-wizard-container-step").show()
                jQuery(".newpreloader").hide()
                jQuery("#quick-kyc-btn").text('Try Demo');
                jQuery(".notverifadmin").remove();
                jQuery("#quick-kyc-btn").after("<br><p class='notverifadmin' style='color: red;'>" + data.error.message + "</p>")
            }
        });
        // on click quick kyc button end

        // pollingforstatus
        function pollingforstatus() {
            var getrefnumber = localStorage.getItem('newrefnumber')
            var payloadnew = {
                reference: getrefnumber
            }
            //Use your Shufti Pro account client id and secret key
            // var token2 = btoa("<?php echo esc_attr($printclintidnew_n_n . ':' . $printsecretkeymnew_n) ?>");
			var nclientkeyew = jQuery('input.clientkeynew').val();
			var nsecretkeyew = jQuery('input.secretkey').val();
			var token2 = btoa(nclientkeyew + ':' + nsecretkeyew);

            fetch('https://api.shuftipro.com/status', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': 'Basic ' + token2
                },
                body: JSON.stringify(payloadnew)
            })
                .then(function (response) {
                    return response.json();
                }).then(function (data) {
                    console.log(data.event)
                    if (data.event == "verification.accepted") {
                        clearInterval(interval);
                        // jQuery("p.generate-shortcode").after("<br><p class='wpyouverify'>You're verified. Now if you want Go Live with these settings for your end users please click on Go Live BUTTON.</p>")
                        // jQuery("#quick-kyc-btn").after("<button id='savesetting'>Save Setting</button>")
                        jQuery("#quick-kyc-btn").attr('disabled', 'disabled')
                        jQuery(".wpsp-live-btn-row").hide()
                        jQuery("p.generate-shortcode, button#savesettin").show()
                        jQuery("#wpsp-kyc-wizard-container-step").show()
                        jQuery(".newpreloader").hide()
                        jQuery(".popupmodalnew").show()
                        jQuery(".wpsp-kyc-process-step").addClass('wpopacityaddnew');
						<?php
						$update_url = plugin_dir_url(dirname(__FILE__)) . 'partials/data-update.php';
						?>
						var myHeaders = new Headers();
						myHeaders.append("Content-Type", "application/json");

						var updateUrl = "<?php echo $update_url; ?>";

						var requestOptions = {
							method: 'POST',
							headers: myHeaders,
							body: JSON.stringify(payload),
							redirect: 'follow'
						};

						fetch(updateUrl, requestOptions)
							.then(response => response.text())
							.then(result => console.log(result))
							.catch(error => console.log('error', error));

                    }
                    else if (data.event !== "request.invalid" && data.error) {
                        clearInterval(interval);
                        jQuery("#wpsp-kyc-wizard-container-step").show()
                        jQuery(".newpreloader").hide()
                        jQuery("#quick-kyc-btn").text('Try Demo');
                        jQuery(".notverifadmin").remove();
                        jQuery("#quick-kyc-btn").after("<br><p class='notverifadmin'>" + data.error.message + "</p>");
                    }
                    else if (data.event !== "request.pending") {
                        clearInterval(interval);
                        jQuery("#wpsp-kyc-wizard-container-step").show()
                        jQuery(".newpreloader").hide()
                        jQuery("#quick-kyc-btn").text('Try Demo');
                        jQuery(".notverifadmin").remove();
                        jQuery("#quick-kyc-btn").after("<br><p class='notverifadmin'>You're not verified. please try again.</p>");
                    } else if (data.event == "request.pending") {
                        jQuery(".newpreloader").show()
                        jQuery("#wpsp-kyc-wizard-container-step").hide();
                    }
                });
        }
        var interval = setInterval(pollingforstatus, 8000);
    }

	jQuery('#wpsp-kyc-wizard-container').show()


	var clientsavekey;
	var secretsavekey;
	clientsavekey = "<?php echo esc_attr($printclintidnew_njs) ?>";
	secretsavekey = "<?php echo esc_attr($printsecretkeymnewjs) ?>";

	jQuery('input.clientkeynew').val("<?php echo esc_attr($printclintidnew_njs) ?>");
	jQuery('input.secretkey').val("<?php echo esc_attr($printsecretkeymnewjs) ?>");

	jQuery('.kyc-button.button-primary').click(function() {
		clientsavekey = jQuery('input.clientkeynew').val();
		secretsavekey = jQuery('input.secretkey').val();
	})

	jQuery('.generate-shortcode').click(function() {
		jQuery(".wpyouverify").hide();
		jQuery("#savesettin").removeAttr('disabled')
	})
	jQuery('.showservices-inr-1').click(function() {
		jQuery('.wpsp-kyc-process-step').css('display', 'block');
		jQuery('#wpsp-kyc-wizard-container-step').css('display', 'block');
		jQuery('.showservices, .show-kyc-services').css('display', 'none');
	})
	jQuery('.submit-btn-4').click(function() {
		if(jQuery(".show-kyc-services-inr-1").hasClass("activn")){
			jQuery('.face-verification-s').css('display', 'block');
		}
		else if(jQuery(".show-kyc-services-inr-2").hasClass("activn")){
			jQuery(".document-verification-s").css('display', 'block');
		}
		else if(jQuery(".show-kyc-services-inr-3").hasClass("activn")){
			jQuery(".address-verification-s").show();
		}
		jQuery('#wpsp-kyc-wizard-container-step').css('display', 'block');
		jQuery('.showservices, .show-kyc-services').css('display', 'none');
	})
	jQuery('.showservices-inr-2').click(function() {
		jQuery('.show-kyc-services').css('display', 'block');
		jQuery('.showservices').css('display', 'none');
		// jQuery('#wpsp-kyc-wizard-container-step').css('display', 'block');
	})
	jQuery(".backbtn").click(function(){
		jQuery('.showservices').css('display', 'block');
		jQuery('.show-kyc-services').css('display', 'none');
	})
	jQuery(".backbtn-1").click(function(){
		jQuery('.showservices').css('display', 'block');
		jQuery('.wpsp-kyc-process-step, .show-kyc-services').css('display', 'none');
	});
	jQuery(".show-kyc-services-inr").click(function(){
		jQuery(this).toggleClass("activn")
	});
	//on click face verification button
	jQuery(".submit-btn-5").click(function(){
		jQuery(".face-verification-s").hide();
		if(jQuery(".show-kyc-services-inr-2").hasClass("activn")){
			jQuery(".document-verification-s").show();
		}	
		else if(jQuery(".show-kyc-services-inr-3").hasClass("activn")){
			jQuery(".address-verification-s").show();
		}	
		else {
			jQuery('.wpsp-kyc-process-step').css('display', 'block');
			jQuery('#wpsp-kyc-wizard-container-step').css('display', 'block');
			// updatedata();
		}

	});
	//on click document verification button
	jQuery(".submit-btn-6").click(function(){
		if(jQuery(".document-verification-s input[name='document_type']:checked").length > 0 && jQuery(".document-verification-s input[name='data_extraction']:checked").length > 0) {
			jQuery(".document-verification-s").hide();
			if(jQuery(".show-kyc-services-inr-3").hasClass("activn")){
				jQuery(".address-verification-s").show();
				jQuery(".req-field").remove();
			}
			else{
				jQuery('.wpsp-kyc-process-step').css('display', 'block');
				jQuery('#wpsp-kyc-wizard-container-step').css('display', 'block');
				jQuery(".req-field").remove();
				// updatedata();
			}
		}	
		else{
			jQuery(".req-field").remove();
			jQuery("p.submit-btn-6.button-primary").before('<p class="req-field" style="color: red; font-size:16px;">Please select all required fields.</p>');
		}
	});
	//on address document verification button
	jQuery('.submit-btn-7').click(function() {
		if(jQuery(".address-verification-s input[name='document_type']:checked").length > 0) {
			jQuery('.wpsp-kyc-process-step').css('display', 'block');
			jQuery('#wpsp-kyc-wizard-container-step').css('display', 'block');
			jQuery('.showservices, .show-kyc-services').css('display', 'none');
			jQuery(".address-verification-s").hide();
		}
		else{
			jQuery(".req-field-1").remove();
			jQuery("p.submit-btn-7.button-primary").before('<p class="req-field-1" style="color: red; font-size:16px;">Please select all required fields.</p>');
		}
	})
	jQuery(".backbtn-2").click(function(){
		jQuery(".showservices").show();
		jQuery(".face-verification-s").hide();
	});
	jQuery(".backbtn-3").click(function(){
		if(jQuery(".show-kyc-services-inr-1").hasClass("activn")){
			jQuery(".wpsp-kyc-process-step").hide();
			jQuery(".document-verification-s").hide();
			jQuery(".face-verification-s").show();
		}
		else {
			jQuery(".wpsp-kyc-process-step").hide();
			jQuery(".showservices").show();
			jQuery(".face-verification-s, .address-verification-s, .document-verification-s").hide();
		}		
	});
	jQuery(".backbtn-4").click(function(){
		if(jQuery(".show-kyc-services-inr-2").hasClass("activn")){
			jQuery(".wpsp-kyc-process-step").hide();
			jQuery(".document-verification-s").show();
			jQuery(".address-verification-s").hide();
		}	
		else if(jQuery(".show-kyc-services-inr-1").hasClass("activn")){
			jQuery(".wpsp-kyc-process-step").hide();
			jQuery(".face-verification-s").show();
			jQuery(".address-verification-s, .document-verification-s").hide();
		}	
		else {
			jQuery(".wpsp-kyc-process-step").hide();
			jQuery(".showservices").show();
			jQuery(".face-verification-s, .address-verification-s, .document-verification-s").hide();
		}	
	});
	var statvla = jQuery("#printstatuse").text();

	//check account exist or not
	jQuery('.submit-btn-1').click(function(){
		jQuery(this).text("Submitting...");
		event.preventDefault();
		
		var formData = {
			'username': jQuery('.clientkeynew').val(),
			'secretkey': jQuery('.secretkey').val()
		};
		
		$.ajax({
			type: 'POST',
			url: '<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'partials/info.php'); ?>', // Replace with your actual PHP script URL
			data: formData,
			dataType: 'json',
			encode: true,
			success: function(data) {
				jQuery(".submit-btn-2, .submit-btn-1").text("Continue")
				if (data.error) {
					jQuery('.wpsp-error-msg').text(data.error);
				} 
				else if (data.status == 'trial' || data.status == 'production') {
					jQuery("#wpsp-kyc-wizard-container").hide()
					jQuery('.wpsp-kyc-process-step, .show-kyc-services').css('display', 'none');
					jQuery('.showservices').css('display', 'block');
					jQuery('#wpsp-kyc-wizard-container-step').css('display', 'block');
				} 
				else {
					jQuery("#wpsp-kyc-wizard-container").show()
					jQuery('#wpsp-kyc-wizard-container-step, .wpsp-kyc-process-step, .show-kyc-services').css('display', 'none');
				}
			},
			error: function(xhr, status, error) {
				jQuery(".submit-btn-2, .submit-btn-1").text("Continue")
				jQuery('.wpsp-error-msg').text('Something went wrong: ' + error);
			}
		});
		// Make second AJAX call to add-update.php
		$.ajax({
			type: 'POST',
			url: '<?php echo esc_attr(plugin_dir_url(dirname(__FILE__)) . 'partials/add-update.php'); ?>', // Second PHP script URL
			data: formData,
			dataType: 'json',
			encode: true,
			success: function(response) {
				console.log('Data successfully sent to add-update.php');
			},
			error: function(xhr, status, error) {
				jQuery('.wpsp-error-msg').text('Something went wrong with add-update: ' + error);
			}
		});
	});

	var verificationmode;
	var redirecturlval;
	var showconstval;
	var callbackurljp;
	var privacypolicy;
	var showresults;
	var showfeedback;
	var enhanceddataval;
	var countryvalp;
	var languagejp;
	var check_face_duplication;
	var proofTypeDoc;
	var documentTypesDoc;
	var backsideProofDoc;
	var extendedSettingsDoc;
	var dataExtractionDoc;
	var proofTypeAdd;
	var addressTypesAdd;
	var backsideProofAdd;
	var extendedSettingsAdd;
	var dataExtractionAdd;

	jQuery("#quick-kyc-btn").click(function() {
		// if(jQuery(".show-kyc-services-inr-1").hasClass("activn")){
		// 	jQuery(".wpsp-kyc-process-step").hide();
		// 	jQuery(".face-verification-s").show();
		// }		
		// else if(jQuery(".show-kyc-services-inr-2").hasClass("activn")){
		// 	jQuery(".document-verification-s").show();
		// }		
		// else if(jQuery(".show-kyc-services-inr-3").hasClass("activn")){
		// 	jQuery(".address-verification-s").show();
		// }		
		// else{
			updatedata();
		// }
	})
	// show/hide password functionality
	jQuery(".wpsp-edit-keys").click(function() {
		var chpkpashide = jQuery(".atdis").attr('type');
		if (chpkpashide == 'text') {
			jQuery(this).removeClass('hidepass');
			jQuery(".atdis").attr('readonly', 'readonly');
			jQuery(".atdis").focusout();
			jQuery(".atdis").removeClass('active-field-focus');
			jQuery(".atdis").attr('type', 'password');
			jQuery(".button.kyc-full-width.wpsp-update-key").css('display', 'none');
			jQuery(".wpsp-cont-btn").css('display', 'block');
		} else {
			jQuery(this).addClass('hidepass');
			jQuery(".atdis").removeAttr('readonly');
			// jQuery(".atdis").attr("readonly", false);
			jQuery(".atdis").focus();
			jQuery(".atdis").addClass('active-field-focus');
			jQuery(".atdis").attr('type', 'text');
			jQuery(".button.kyc-full-width.wpsp-update-key").css('display', 'block');
			jQuery(".wpsp-cont-btn").css('display', 'none');
		}
	})
</script>