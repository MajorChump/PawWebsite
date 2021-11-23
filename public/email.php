<?php
	require('logic/inc/config.php');
	require('logic/inc/db.inc.php');
	require('logic/inc/node.inc.php');
	require('logic/inc/functions.inc.php');
    require __DIR__ . '/../vendor/autoload.php';
	
	$send_result = FALSE;
	$err = FALSE;

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	if(isset($_POST['action']) && $_POST['action'] == 'send')
	{
		
		if(!isset($_POST['email']))
			$err = 'No email specified';
		if(!isset($_POST['paw_address']))
			$err = 'No PAW address specified';
		if(!isset($_POST['paw_reward_key']))
			$err = 'No reward key specified!';
		if(!isset($_POST['terms']))
			$err = 'Please check the vouch checkbox!';
		
		$db_reward_key = FALSE;
		if(!$err)
		{
			$db_reward_key = db_reward_key($_POST['paw_reward_key']);
			if(!$db_reward_key)
				$err = 'Reward Key Not Found';
			else if($db_reward_key->disabled)
				$err = 'Reward Key Suspended';
		}
		
		if(!$err)
		{
			$email_invited = db_email_invited($_POST['email']);
			if($email_invited)
				$err = 'Email got invited already';
		}
		
		if(!$err)
		{
			$last_invite = db_last_email_invite($_POST['paw_reward_key']);
			if($last_invite && (($last_invite->time_invited + 60*10) > time()))
				$err = 'Please wait 10 minutes between invites';
		}
		
		if(!$err)
		{
			if(!valid_paw_address($_POST['paw_address']))
				$err = 'Invalid PAW address entered';
		}
		
		if(!$err)
		{
			$email = $_POST['email'];
			$address = $_POST['paw_address'];
			$paw_reward_key = $_POST['paw_reward_key'];
			$pickup_code = rand_sha1(24);
			db_insert_email_invite($email, $paw_reward_key, $pickup_code, $address);
			
			$invitee_reward_key = rand_sha1(24);
			db_insert_reward_key($invitee_reward_key, $db_reward_key->id);
			
			$mail = new PHPMailer(true);
			try {
				//Server settings
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'smtppro.zoho.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'paws@paw.digital';                     //SMTP username
				$mail->Password   = '3b53D!2ed4f2';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('paws@paw.digital', 'PAW Digital');
				//$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
				$mail->addAddress($_POST['email']);               //Name is optional
				//$mail->addReplyTo('info@example.com', 'Information');
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');

				//Attachments
				//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'You have PAW for pickup';
				$mail->Body    = 'Your Reward Key '.$invitee_reward_key.'.<br />Keep this key confidential! The paw reward key allows you to receive more PAW rewards.<br /><br />Pick up your PAW at <a href="https://paw.digital/receive.php?code='.$pickup_code.'" /><b>https://paw.digital/receive.php?code='.$pickup_code.'</b></a>';
				$mail->AltBody = "Your Reward Key '.$invitee_reward_key.'.\r\nKeep this key confidential! The paw reward key allows you to receive more PAW rewards.\r\n\r\nPick up your PAW at https://paw.digital/receive.php?code=".$pickup_code."";

				$mail->send();
				$send_result = 'Message has been sent';
			} catch (Exception $e) {
				$send_result = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}
	}


?>
<?php require('parts/header.php'); ?>
	<style type="text/css">
		section .features-row {
			padding: 60px 0 30px 0;
		}
		section .advanced-feature-img-left {
			max-width: 100%;
			float: left;
			padding: 0 30px 30px 0;
		}
		input[type="submit"] {
			border: 1px solid #1dcaca;
			background: #1dde9c;
			color: #fff;
			cursor: pointer;
		}
		input[type="text"] {
			border: 1px solid #1dcdc3;
			margin: 5px 0;
			padding: 5px 10px;
			width: 400px;
		}
	</style>

  <!--==========================
    Header
  ============================-->
  <header id="header" class="header-fixed">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="/#intro" class="scrollto">PAW</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></img></a> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="/#intro">Home</a></li>
          <li><a href="/#about">About PAW</a></li>
          <li><a href="/#features">Features</a></li>
          <li><a href="/#benefits">Benefits</a></li>
          <li><a href="https://wallet.paw.digital">Online Wallet</a></li>
          <li><a href="https://tracker.paw.digital">Tracker</a></li>
          <li><a href="https://tribes.paw.digital">Tribes</a></li>
          <li><a href="https://paw.digital/PAW_Whitepawper.pdf" target="_blank">WhitePAWper</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
  

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-text">
      <h2>PAW Distribution</h2>
      <p>Receive PAWs for sending PAWs.</p>
	  <img src="img/paw-chest.png" width="250px" alt="" data-aos="fade-left">
      <a href="#distribution-form" class="btn-get-started scrollto">Get PAWs</a>
    </div>

    <div class="product-screens">


    </div>

  </section><!-- #intro -->

	<main id="main">
       
		<section id="distribution-form">
		  <div class="features-row">
			<div class="container">
			  <div class="row">
				<div class="col-12">
				  <img class="advanced-feature-img-left" src="img/paw.svg" width="250px" alt="" data-aos="fade-left" />
				  <div data-aos="fade-right">
					<h2>PAW Distribution</h2>
					<h3>Send PAW to someone and receive a reward</h3>
					<div style="display: inline-block;">
						<form action="/public/email.php#distribution-form" method="post">
							<input type="hidden" name="action" value="send" />
							<input type="text" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" placeholder="john@email.com" /><br />
							<input type="text" name="paw_address" value="<?= isset($_POST['paw_address']) ? htmlspecialchars($_POST['paw_address']) : '' ?>" placeholder="Your paw_address" /><br />
							<input type="text" name="paw_reward_key" value="<?= isset($_POST['paw_reward_key']) ? htmlspecialchars($_POST['paw_reward_key']) : '' ?>" placeholder="PAW Reward KEY" /><br />
							<input type="checkbox" name="terms" value="" <?= isset($_POST['terms']) ?'checked="checked"' : '' ?>/> I vouch that the person I send PAW is not a bot and will not abuse the system.<br /><br />
							<input type="submit" value="Send PAW" />
						</form>
						<div style="color: #19adb3; font-weight: bold;"><?php echo $send_result; echo $err ? '<span>'.$err.'</span>' : ''; ?></div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</section>
		<section id="distribution-limits">
		  <div class="features-row section-bg">
				<div class="container">
				  <div class="row">
					<div data-aos="fade-right">
						<h3>PAW Distribution Notes</h3>
						<p>Only invite who you trust not to be a bot or use a bot on PAW!</p>
						<p>Sending PAW to people that get flagged can result in a suspension of your own rewarding.</p>
						<p>The receiver must pick up their PAW for you to receive your reward.</p>
						<p>Receiver can only be invited once.</p>
						<p>Maximum 1 invite every 10 minutes.</p>
					</div>
				</div>
			  </div>
		  </div>
		</section>
		<? /*
		<section id="distribution-list">
		  <div class="features-row">
				<div class="container">
				  <div class="row">
					<div data-aos="fade-left">
						<h3>Previous Distributions</h3>
					</div>
				</div>
			  </div>
		  </div>
		</section>*/ ?>
	</main>


<?php require('parts/footer.php'); ?>