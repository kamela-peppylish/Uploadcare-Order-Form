<?php 
require 'vendor/autoload.php';
use \Uploadcare;

$sendgrid = new SendGrid('sendgrid api key');// sendgrid api key
$api = new Uploadcare\Api(' uploadcare api key', ' uploadcare secret key');// uploadcare api key

$mail = new SendGrid\Email();// send email to Metrodesk
$mail2 = new SendGrid\Email();// send confirmation email to client

$name = "example";// Sender name
$email = "example@example.com";// Sender Email

$fileurl = $_POST['uploader'];//get files URL
$wlayer = $_POST['white-layer'];//get white layer input
$alayer = $_POST['adhesive-layer'];//get adhesive layer input
$blayer = $_POST['block-layer'];//get blocking layer input
$clayer = $_POST['clear-layer'];//get clear layer input
$llayer = $_POST['line-layer'];//get outline input
$token = $_POST['token'];//get token to create Order Id
// Color codes
$cmykc = $_POST['cmyk-c'];// CMYK code - C
$cmykm = $_POST['cmyk-m'];// CMYK code - M
$cmyky = $_POST['cmyk-y'];// CMYK code - Y
$cmykk = $_POST['cmyk-k'];// CMYK code - K
$pantonev = $_POST['pantone'];// Pantone color code

$group = $api->getGroup($fileurl);
$group->store();
$files = $group->getFiles();

$total = count($files);//total number of files
$msg = "Order Id: $token \n$total images were uploaded by user. Please see instructions below and download link to proccess order.\nAll files download Link: $fileurl \n\n\n";

for($i = 0, $w = 0, $a = 0, $b = 0, $c = 0, $l = 0, $tone = 0, $cc = 0,$mm = 0,$yy = 0,$kk = 0; $i < count($files) || $w <count($wlayer) || $a <count($alayer) || $b <count($blayer) || $c <count($clayer) || $l <count($llayer) || $tone <count($pantonev) || $cc <count($cmykc) || $mm <count($cmykm) || $yy <count($cmyky) || $kk <count($cmykk); $i++, $w++, $a++, $b++, $c++, $l++, $tone++,$cc++, $mm++,$yy++,$kk++) {
    	$msg.= "Download Link: ".$files[$i]->getUrl(). "\nWhite Layer: ".$wlayer[$w]."PX  |  Adhesive Layer: ".$alayer[$a]."PX  |  Blocking Layer: ".$blayer[$b]."PX  |  Clear Layer: ".$clayer[$c]."PX\nOutline Size: ".$llayer[$l]."PX  |  Pantone Code: ".$pantonev[$tone]."  |  CMYK C: ".$cmykc[$cc]." M: ".$cmykm[$mm]." Y: ".$cmyky[$yy]." K: ".$cmykk[$kk]."\n\n";
    }
$msg .= "Kind Regards \nXYZ \nVisit: www.example.com \nSkype: XYZ[24 hours] \nEmail: support@example.com";
// Order  Reciever
$recipient ="xyz@example.com";
$subject = "New Order by DST - $token";
// Confirmation reciever
$confirm_recipient ="xyz@example.com";
$confirm_subject = "Thank you. Your Order: $token has been submitted to XYZ. ";
$confirm_msg = "Order Id: $token \n\nNumber of images submitted: $total.\n\nThank you for your order. We will notify you when your order is ready.\n\nFor any support you can reply to this email or call us at 123456789.\n\nKind Regards \nXYZ \nVisit: www.example.com \nSkype: XYZ[24 hours] \nEmail: support@example.com";

	// $mail:Send Order to Metrodesk
	$mail->
	addTo( $recipient )->
	setFromName($name)->
	setFrom( $email )->
    setSubject($subject)->
	setText($msg);
	// $mail2: Send Confirmation mail to client
	$mail2->
	addTo( $confirm_recipient )->
	setFromName($name)->
	setFrom( $email )->
    setSubject($confirm_subject)->
	setText($confirm_msg);
  	//Send Mail.
	if ( ($sendgrid->send($mail)) && ($sendgrid->send($mail2)) ){
		exit(header('Location: thank-you.html'));
	}
	else{
		echo "Order submission failed. Please check for error or report to support@example.com for Support.";
	}
	
?>


