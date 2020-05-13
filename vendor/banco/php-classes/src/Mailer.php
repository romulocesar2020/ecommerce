<?php

	namespace Banco;

	use Rain\Tpl;	

	class Mailer{

		const USERNAME = "seu email";
		const PASSWORD = "sua senha";
		const NAME_FROM = "Aula Php 7 com PHPMailer";

		private $mail;

		public function __construct($toAddress, $toName, $subject, $tplName, $data = array())
		{

			$config = array(

					"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . "/views/email/",
					"cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
					"debug"         => false // set to false to improve the speed
				   );

			Tpl::configure( $config );

			$tpl = new Tpl;

			foreach ($data as $key => $value) {
				
				$tpl->assign($key, $value);

			}

			$html = $tpl->draw($tplName, true);

			$this->mail = new \PHPMailer;

			//Tell PHPMailer to use SMTP
			$this->mail->isSMTP();	

			$this->mail->SMTPOptions = array(
		    	'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    	)
			);

			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$this->mail->SMTPDebug = 0; //SMTP::DEBUG_CONNECTION; //SMTP::DEBUG_LOWLEVEL; SMTP::DEBUG_SERVER

			//$this->$mail->Debugoutput = 'html';

			//Set the hostname of the mail server
			
			$this->mail->Host = 'smtp.gmail.com';
			// use
			// $this->$mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6

			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$this->mail->Port = 587;

			//Set the encryption mechanism to use - STARTTLS or SMTPS
			$this->mail->SMTPSecure = "tls";//PHPMailer::ENCRYPTION_STARTTLS; 

			//Whether to use SMTP authentication
			$this->mail->SMTPAuth = true;

			$this->mail->IsHTML(true);

			//Username to use for SMTP authentication - use full email address for gmail
			$this->mail->Username = Mailer::USERNAME;

			//Password to use for SMTP authentication
			$this->mail->Password = Mailer::PASSWORD;

			//Set who the message is to be sent from
			$this->mail->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);

			//Set an alternative reply-to address
			//$this->$mail->addReplyTo('replyto@example.com', 'First Last');

			//Set who the message is to be sent to
			$this->mail->addAddress($toAddress, $toName);

			$this->mail->WordWrap = 50;//Define quebra de linha

			//$this->$mail->IsHTML = true ;
			//Set the subject line
			$this->mail->Subject = $subject;

			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$this->mail->msgHTML(utf8_decode($html));

			//Replace the plain text body with one created manually
			$this->mail->AltBody = 'This is a plain-text message body';

			//Attach an image file
			//$this->$mail->addAttachment('images/phpmailer_mini.png');

		}

			public function send()
			{

				return $this->mail->send();

			}		

	}

?>