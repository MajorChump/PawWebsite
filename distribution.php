<?php
	require('logic/inc/config.php');
	require('logic/inc/db.inc.php');
	require('logic/inc/node.inc.php');
	require('logic/inc/functions.inc.php');

	$DISTRIBUTIONS = db_recent_distributions();
	$REWARDS = db_recent_rewards();
?>
<?php require('parts/header.php'); ?>


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
  

  <section id="distribution" style="padding-top:150px;">
	<div class="container">
		<h2>PAW Rewards</h2>
		<table style="width: 100%; ">
			<tr>
				<td>Distribution NR</td>
				<td>Platform</td>
				<td>Weight</td>
				<td>Address</td>
				<td>Amount</td>
			</tr>
			<? if($REWARDS): ?>
				<? foreach($REWARDS as $REWARD){ 
						$platform = '';
						if($REWARD['platform'] == 0)
							$platform = 'twitter';
						if($REWARD['platform'] == 2)
							$platform = 'tribe operator';
						
						$amount = 'Outstanding';
						if($REWARD['amount'] != 0)
							$amount = $REWARD['amount']
					?>
					<tr>
						<td><?= $REWARD['distribution_nr'] ?></td>
						<td><?= $platform ?></td>
						<td><?= $REWARD['multiplier'] ?>x</td>
						<td><?= $REWARD['payout_address'] ?></td>
						<td><?= $amount ?></td>
					</tr>
				<? } ?>
			<? endif; ?>
		</table><br /><br /><br /><br /><br /><br /><br /><br />
	</div>
  </section>
  
  <section id="distribution" class="section-bg" style="padding-top:15px;">
	<div class="container">
		<h2>Distributions</h2>
		<table style="width: 100%; ">
			<tr>
				<td>Distribution Nr</td>
				<td>Time</td>
				<td>Amount</td>
			</tr>
			<? if($DISTRIBUTIONS): ?>
				<? foreach($DISTRIBUTIONS as $DIST){ ?>
					<tr>
						<td>#<?= $DIST['id'] ?></td>
						<td><?= $DIST['amount'] ?></td>
						<td><?= getTimeAgo(date($DIST['time'])) ?></td>
					</tr>
				<? } ?>
			<? endif; ?>
		</table><br /><br /><br /><br /><br /><br /><br /><br />
	</div>
  </section>



<?php require('parts/footer.php'); ?>