<?php
	require('logic/inc/config.php');
	require('logic/inc/db.inc.php');
	require('logic/inc/node.inc.php');
	require('logic/inc/functions.inc.php');
	
	$picked_up = FALSE;
	$err = FALSE;
	$email_invite = FALSE;

	if(!isset($_GET['code']))
		$err = 'The link you followed does not contain a code to pick up PAW';
	
	if(!$err)
	{
		$email_invite = db_get_email_invite($_GET['code']);
		if(!$email_invite)
			$err = 'The pickup code in the link given to you does not exist';
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'receive')
	{
		
		if(!isset($_POST['paw_address']))
			$err = 'No PAW address specified';
		
		if(!$err)
		{
			if(!valid_paw_address($_POST['paw_address']))
				$err = 'Invalid PAW address entered';
		}
		
		if(!$err)
		{
			distributor_send_email_reward($email_invite->inviter_address, $_POST['paw_address'], 0, '{"invite_id":"'.$email_invite->id.'"}');
			distributor_send_email_reward($_POST['paw_address'], $email_invite->inviter_address, 1, '{"invite_id":"'.$email_invite->id.'"}');
			db_set_email_picked_up($email_invite->id, $_POST['paw_address']);
			
			$picked_up = TRUE;
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
      <p>Receive PAWs others have sent you.</p>
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
					<h3>Get your PAW</h3>
					<div style="display: inline-block;">
						<? if(!$email_invite): ?>
							<div style="color: #19adb3; font-weight: bold;">No valid pick up code found in the link you followed.</div>
						<? else: ?>
							<? if($email_invite->picked_up): ?>
								<div style="color: #19adb3; font-weight: bold;">Reward has been picked up already.</div>
							<? elseif($picked_up): ?>
								<div style="color: #19adb3; font-weight: bold;">PAW reward will be sent within 10 minutes.</div>
							<? else: ?>
								<form action="/receive.php?code=<?= htmlspecialchars($_GET['code']) ?>#distribution-form" method="post">
									<input type="hidden" name="action" value="receive" />
									<input type="text" name="paw_address" value="<?= isset($_POST['paw_address']) ? htmlspecialchars($_POST['paw_address']) : '' ?>" placeholder="Your paw_address" /><br />
									<input type="submit" value="Receive PAW" />
								</form>
								<div style="color: #19adb3; font-weight: bold;"><?php echo $err ? '<span>'.$err.'</span>' : ''; ?></div>
								
								<br /><br />
								Biota and <a href="https://wallet.paw.digital" target="_blank">Biome</a> are both recommended wallets to receive your PAW.
							<? endif; ?>
						<? endif; ?>
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
						<p>PAWs will be sent out with the reward cycle every 10 minute.</p>
						<p>The amount of PAW distributed individually is calculated at the end of each reward cycle.</p>
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