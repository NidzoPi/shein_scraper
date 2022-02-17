<?php

include('simplehtmldom_1_9_1/simple_html_dom.php');
$websiteUrl = "https://us.shein.com/";

$html = file_get_html($websiteUrl);
$sum = 0;
$currentImagePath = "";

$file = "/home/npilipovic/shein_scraper/scraped_data.txt";
$data = file($file);
$line = $data[count($data)-1];
echo $line;


echo '<pre>';

if ($currentImage = $html->find('img[data-src="'.$line.'"]')){
	echo $currentImage[0]->getAttribute('data-src');
}

else{

	$currentImage = $html->find('.falcon-lazyload.j-index-banner');
	$currentImagePath = $currentImage[4]->attr['data-src'];
	echo $currentImagePath;

	$fp = fopen($file, 'w');
	fwrite($fp, $currentImagePath);
	fclose($fp);

	require 'PHPMailerAutoload.php';

			$mail = new PHPMailer;

			//$mail->SMTPDebug = 3;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'apikey';                 // SMTP username
			$mail->Password = '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';                 //SMTPpassword
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('probnisamp@gmail.com', 'Mailer');
			$mail->addAddress('sladjana@addshoppers.com');     // Add a recipient
			$mail->addAddress('nikola@addshoppers.com');               // Name is optional

			$mail->isHTML(true); 
			$mail->Subject = 'Shein-Scraper';
			$mail->Body    = '<b> Shein code has been changed </b> <br> <a href ="' . $currentImagePath . '"> OPEN IMAGE </a><img src="'.$currentImagePath.'?w=320" alt="img" width="1080" height="320" />';
			$mail->AltBody = $currentImagePath;

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';

			}		
}
?>