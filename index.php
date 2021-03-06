<?php
	require('logic/inc/config.php');
	require('logic/inc/db.inc.php');
	require('logic/inc/node.inc.php');
	require('logic/inc/functions.inc.php');

?>
<?php require('parts/header.php'); ?>

  <!--==========================
    Header
  ============================-->
  <header id="header">
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
		  <? /*
          <li><a href="#team">Team</a></li>
          <li><a href="#gallery">Gallery</a></li>
		  */ ?>
		  <? /*
          <li class="menu-has-children"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="menu-has-children"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li>
		  */ ?>
		  <? /*
          <li><a href="#contact">Contact Us</a></li>
		  */ ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-text">
      <h2>Welcome to PAW</h2>
      <p>Love animals? Then this currency is for you.</p>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>

    <div class="product-screens">

      <div class="product-screen-1" data-aos="fade-up" data-aos-delay="400">
        <img src="img/product-screen-1.png?v1" alt="">
      </div>

      <div class="product-screen-2" data-aos="fade-up" data-aos-delay="200">
        <img src="img/product-screen-2.png?v1" alt="">
      </div>

      <div class="product-screen-3" data-aos="fade-up">
        <img src="img/product-screen-3.png?v1" alt="">
      </div>

    </div>

  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about" class="section-bg">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">What PAW is</h3>
          <span class="section-divider"></span>
          <p class="section-description">
            PAW is a decentralized digital currency that offers near-instant settlement (&lt;1 sec) and energy efficient transactions.<br>
            It's also building on a new reward model that allows for rapid growth of the network while using TGS for consensus.
          </p>
        </div>

        <div class="row">
          <div class="col-lg-6 about-img" data-aos="fade-right">
            <img src="img/POG_Illustration.png?x=3" alt="">
          </div>

          <div class="col-lg-6 content" data-aos="fade-left">
            <h2>Proof-Of-Growth Reward Model</h2>
            <h3>The mining free reward model that incentivizes network growth</h3>
            <p>
              Unlike Proof-Of-Work which incentivizes the network growth indirectly through block rewards, Proof-Of-Growth is directly incentivizing the network growth.
			  
			  Similar to mining, every <?= DISTRIBUTION_CYCLE ?> minutes a new PAW reward is being made available and shared among all participants who contributed to the network growth in various form ( e.g. the invitation of others to the network ).
            </p>

            <ul>
              <li><i class="ion-android-checkmark-circle"></i> No exclusion through powerful miners, lack of technical knowledge or resources.</li>
              <li><i class="ion-android-checkmark-circle"></i> Everyone contributes to network growth</li>
              <li><i class="ion-android-checkmark-circle"></i> No winner takes all. Everyone gets a reward in propotion to their contribution</li>
              <li><i class="ion-android-checkmark-circle"></i> Even distribution of the supply until 2025 </li>
            </ul>

            <p>
              Fewer participants will result in higher rewards for each participant. More participants will result in fewer rewards for each participants. 
			  <br />The reward amount every <?= DISTRIBUTION_CYCLE ?> minutes is fixed and with more people joining the rewards each participant can earn continues to shrink. 
            </p>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Product Featuress Section
    ============================-->
    <section id="features">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 offset-lg-4">
            <div class="section-header" data-aos="fade" data-aos-duration="1000">
              <h3 class="section-title">PAW Features</h3>
              <span class="section-divider"></span>
            </div>
          </div>

          <div class="col-lg-4 col-md-5 features-img">
            <img src="img/product-features.png?x=1" alt="" data-aos="fade-right" data-aos-easing="ease-out-back">
          </div>

          <div class="col-lg-8 col-md-7 ">

            <div class="row">

              <div class="col-lg-6 col-md-6 box" data-aos="fade-left">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                <h4 class="title"><a href="">Speed</a></h4>
                <p class="description">Instant irreversible settlement.</p>
              </div>
              <div class="col-lg-6 col-md-6 box" data-aos="fade-left" data-aos-delay="100">
                <div class="icon"><i class="ion-android-globe"></i></div>
                <h4 class="title"><a href="">Zero fees</a></h4>
                <p class="description">Send PAW to anyone anywhere in the world with no fees.</p>
              </div>
              <div class="col-lg-6 col-md-6 box" data-aos="fade-left" data-aos-delay="200">
                <div class="icon"><i class="ion-social-buffer-outline"></i></div>
                <h4 class="title"><a href="">Infinity Chains</a></h4>
                <p class="description">One blockchain per account with asynchronous send and receive allowing for instant settlements.</p>
              </div>
              <div class="col-lg-6 col-md-6 box" data-aos="fade-left" data-aos-delay="300">
                <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
                <h4 class="title"><a href="">Efficiency</a></h4>
                <p class="description">A DPOS/TRG model for consensus allows for an efficient transaction model that no longer relies on mining or Proof-Of-Work for confirmations.</p>
              </div>
            </div>

          </div>

        </div>

      </div>

    </section><!-- #features -->

    <!--==========================
      Product Advanced Featuress Section
    ============================-->
    <section id="advanced-features">

      <div class="features-row section-bg">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <img class="advanced-feature-img-right" src="img/TGS-illustration.png" alt="" data-aos="fade-left">
              <div data-aos="fade-right">
				<h2>Tribe Gather System (TGS) aka DPOS</h2>
				<h3>Fast transactions with little energy expensure</h3>
				<p>TGS is a consensus model in which users pick a tribe that will decide on their behalf on the legitimacy of a transaction.</p>
				<p>For every transaction tribes will gather and decide if a transaction is valid. The transaction will be added to the network when 67% of the tribes agree on the validity.</p>
				<p>A tribe's decision weight is determined by the amount of PAW it represents.</p>
				<p>TGS does not require mining and therefore comes with many advantages: e.g. very little energy usage and fast confirmation of transactions.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="features-row">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <img class="advanced-feature-img-left" src="img/collection-v1.png?3" alt="">
              <div data-aos="fade-left">
                <h2>The Paw-Universe!</h2>
                <h3>Pick your pawnimal and join the PAW-niverse.</h3>
                <p>The PAW-niverse is constantly expanding.</p>
				<p>Series 1 comes with a selection of 12 paw-nimals.</p>
                <p>Each pawnimal can come in a different color.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="features-row section-bg">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <img class="advanced-feature-img-right" src="img/Distribution NH.png" alt="" data-aos="fade-left">
              <div data-aos="fade-right">
                <h2>Tokenomics</h2>
                <h3>PAW's distribution model:</h3>
                <p>Total Supply: 340B PAW</p>
                <i class="ion-ios-pie-outline"></i>
                <p>
					80% - 272B Coins: Proof-Of-Growth Rewards<br />

					10% - 34B Coins: Expenses<br />

					10% - 34B Coins: Team
				</p>
				
				Expenses include: exchange listings, servers and other bills<br />
				Team: pays for the continous development and is split among all team members.<br /><br /><br />
				
				<p>There are no presales or airdrops to reduce any unnecessary sell pressure.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- #advanced-features -->

    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Get Your PAW Wallet</h3>
            <p class="cta-text"> To receive or earn PAW you first need to get yourself a PAW wallet.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="https://wallet.paw.digital">Online Wallet</a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action -->

    <!--==========================
      More Features Section
    ============================-->
    <section id="more-features" class="section-bg">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">Proof-Of-Growth</h3>
          <span class="section-divider"></span>
          <p class="section-description">Overall data of the proof-of-growth implementation. <span style="color: green;">The distribution has not started yet!</span></p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="box" data-aos="fade-right">
              <div class="icon"><i class="ion-ios-stopwatch-outline"></i></div>
              <h4 class="title"><a href="/distribution">Reward Time</a></h4>
              <p class="description">Next reward in <span style="font-weight: bold;"><?= getNextDistTime(db_last_dist_time()); ?> minutes</span></p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box" data-aos="fade-left">
              <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
              <h4 class="title"><a href="/distribution">Distribution</a></h4>
              <p class="description">Currently at distribution <span style="font-weight: bold;">#<?= db_last_dist_nr() ?></span>. Distribution is every <?= DISTRIBUTION_CYCLE ?> minutes.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box" data-aos="fade-right">
              <div class="icon"><i class="ion-ios-heart-outline"></i></div>
              <h4 class="title"><a href="/distribution">Contributors</a></h4>
              <p class="description">Next reward will be split among <span style="font-weight: bold;"><?= db_count_unpaid_distribution() ?></span> participants</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box" data-aos="fade-left">
              <div class="icon"><i class="ion-ios-star-outline"></i></div>
              <h4 class="title"><a href="/distribution">Reward</a></h4>
              <p class="description">Next reward being distributed: <span style="font-weight: bold;"><?= number_format(getCurrentRewardAmount(), 0); ?> PAW</span></p>
            </div>
          </div>

        </div>
      </div>
    </section><!-- #more-features -->
	
	<? /*
    <!--==========================
      Clients
    ============================-->
    <section id="clients">
      <div class="container">

        <div class="row">

          <div class="col-md-2">
            <img src="img/clients/client-1.png" alt=""  data-aos="fade-up">
          </div>

          <div class="col-md-2">
            <img src="img/clients/client-2.png" alt=""  data-aos="fade-up">
          </div>

          <div class="col-md-2">
            <img src="img/clients/client-3.png" alt=""  data-aos="fade-up">
          </div>

          <div class="col-md-2">
            <img src="img/clients/client-4.png" alt=""  data-aos="fade-up">
          </div>

          <div class="col-md-2">
            <img src="img/clients/client-5.png" alt=""  data-aos="fade-up">
          </div>

          <div class="col-md-2">
            <img src="img/clients/client-6.png" alt=""  data-aos="fade-up">
          </div>

        </div>
      </div>
    </section><!-- #more-features -->
*/ ?>
    <!--==========================
      Benefits Section
    ============================-->
    <section id="benefits">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">PAW Benefits</h3>
          <span class="section-divider"></span>
          <p class="section-description">The benefits of PAW</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box" data-aos="fade-right">
              <h3>Bitcoin</h3>
              <h4><sup>$</sup>2-60<span> network fees</span></h4>
              <ul>
                <li><i class="ion-android-checkmark-circle"></i> Rewards exclusive for miners</li>
                <li><i class="ion-android-checkmark-circle"></i> 30-60 minutes settlement</li>
                <li><i class="ion-android-checkmark-circle"></i> Slow with mining</li>
                <li><i class="ion-android-checkmark-circle"></i> Decentralized</li>
                <li><i class="ion-android-checkmark-circle"></i> Indirectly incentivized network growth</li>
              </ul>
              <? /*<a href="#" class="get-started-btn">Get Started</a>*/ ?>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="box featured" data-aos="fade-up">
              <h3>PAW</h3>
              <h4><sup>$</sup>0<span> network fees</span></h4>
              <ul>
                <li><i class="ion-android-checkmark-circle"></i> Rewards for every participant</li>
                <li><i class="ion-android-checkmark-circle"></i> Irreversible settled in seconds</li>
                <li><i class="ion-android-checkmark-circle"></i> Efficient with no mining</li>
                <li><i class="ion-android-checkmark-circle"></i> Decentralized with adoption</li>
                <li><i class="ion-android-checkmark-circle"></i> Directly incentivized network growth</li>
              </ul>
              <? /*<a href="#" class="get-started-btn">Get Started</a>*/ ?>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="box" data-aos="fade-left">
              <h3>ETH</h3>
              <h4><sup>$</sup>15-120<span> network fees</span></h4>
              <ul>
                <li><i class="ion-android-checkmark-circle"></i> Rewards exclusive for miners</li>
                <li><i class="ion-android-checkmark-circle"></i> Settled in 10 minutes</li>
                <li><i class="ion-android-checkmark-circle"></i> Slow with mining</li>
                <li><i class="ion-android-checkmark-circle"></i> Decentralized</li>
                <li><i class="ion-android-checkmark-circle"></i> Indirectly incentivized network growth</li>
              </ul>
              <? /*<a href="#" class="get-started-btn">Get Started</a>*/ ?>
            </div>
          </div>

        </div>
      </div>
    </section><!-- #benefits -->


    <!--==========================
      Frequently Asked Questions Section
    ============================-->
    <section id="faq" class="section-bg">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">Frequently Asked Questions</h3>
          <span class="section-divider"></span>
          <p class="section-description">The answers to most questions</p>
        </div>

        <ul id="faq-list" data-aos="fade-up">
          <li>
            <a data-toggle="collapse" href="#faq1" class="collapsed">How can I earn $PAW coins? <i class="ion-android-remove"></i></a>
            <div id="faq1" class="collapse" data-parent="#faq-list">
              <p>
				<? /*Step 1. Follow @PAW_digital and @TreatsBot on Twitter<br />
				Step 2. Invite someone on Twitter with @TreatsBot !invite @user and you receive $PAW<br />
				Step 3. Send a direct message to @Treatsbot for withdrawals and other commands*/ ?>
				We will be releasing the information on how PAW can be earned shortly.
				</p>
            </div>
          </li>
		  
          <li>
            <a data-toggle="collapse" href="#faq2" class="collapsed">How is Proof-Of-Growth distributed? <i class="ion-android-remove"></i></a>
            <div id="faq2" class="collapse" data-parent="#faq-list">
              <p>
                Every 10 minutes the reward is split among all participants.<br />
				95% of the reward goes to participants who have invited others on to the network. 5% goes to node operators.
              </p>
            </div>
          </li>
		  
          <li>
            <a data-toggle="collapse" class="collapsed" href="#faq3">Is PAW a fork? <i class="ion-android-remove"></i></a>
            <div id="faq3" class="collapse" data-parent="#faq-list">
              <p>
                Yes. PAW got hard forked of <a href="https://nano.org/" target="_blank">NANO</a>.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq4" class="collapsed">Are there any staking rewards? <i class="ion-android-remove"></i></a>
            <div id="faq4" class="collapse" data-parent="#faq-list">
              <p>
                There's no staking rewards however node (tribe) operators can earn a reward for helping the network grow.<br />That tribe needs at least 34,028,237 PAW delegated to it.<br />
				Tribes representing more than 1% of the total network supply (3.4B PAW) are not included in the rewarding.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq5" class="collapsed">What does the tokenomics look in detail? <i class="ion-android-remove"></i></a>
            <div id="faq5" class="collapse" data-parent="#faq-list">
              <p>
				Proof-Of-Growth takes up 80%.<br />
				Those 80% will be released in 10 minute cycles. Each cycle the reward will be split among all participant.<br />
				95% of the Proof-Of-Growth reward will be split among all participants who invited others on to the network.<br />
				5% of the reward will be split among all node operators that have anything from 34M to 3.4B PAW delegated to it.<br /><br />
				
                The team takes 10%.<br />
				6% was split among the initial 4 team members who did the first setup and release of PAW.<br />
				The remaining 4% will be used for the continous development and is split among all team members.<br /><br />
				
				Expenses take 10%.<br />
				This share will be used to pay for any reoccuring bills or one time bills. This includes exchange listings, server costs, company formation and potential bounties.
              </p>
            </div>
          </li>
		  
		  
		  

        </ul>

      </div>
    </section><!-- #faq -->
<? /*
    <!--==========================
      Our Team Section
    ============================-->
    <section id="team" class="section-bg">
      <div class="container">
        <div class="section-header">
          <h3 class="section-title">Our Team</h3>
          <span class="section-divider"></span>
          <p class="section-description">The team behind PAW</p>
        </div>
        <div class="row" data-aos="fade-up">
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="img/team/team-1.jpg" alt=""></div>
              <h4>Apollo River</h4>
              <span>Developer</span>
              <div class="social">
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href=""><i class="fab fa-google-plus"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="img/team/team-2.jpg" alt=""></div>
              <h4>Sarah Jhinson</h4>
              <span>Product Manager</span>
              <div class="social">
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href=""><i class="fab fa-google-plus"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="img/team/team-3.jpg" alt=""></div>
              <h4>William Anderson</h4>
              <span>CTO</span>
              <div class="social">
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href=""><i class="fab fa-google-plus"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="img/team/team-4.jpg" alt=""></div>
              <h4>Amanda Jepson</h4>
              <span>Accountant</span>
              <div class="social">
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href=""><i class="fab fa-google-plus"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- #team -->
*/ ?>
	<? /*
    <!--==========================
      Gallery Section
    ============================-->
    <section id="gallery">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">Gallery</h3>
          <span class="section-divider"></span>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>

        <div class="row no-gutters">

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item" data-aos="fade-up">
              <a href="img/gallery/gallery-1.jpg" class="gallery-popup">
                <img src="img/gallery/gallery-1.jpg" alt="">
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item" data-aos="fade-up">
              <a href="img/gallery/gallery-2.jpg" class="gallery-popup">
                <img src="img/gallery/gallery-2.jpg" alt="">
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item" data-aos="fade-up">
              <a href="img/gallery/gallery-3.jpg" class="gallery-popup">
                <img src="img/gallery/gallery-3.jpg" alt="">
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item" data-aos="fade-up">
              <a href="img/gallery/gallery-4.jpg" class="gallery-popup">
                <img src="img/gallery/gallery-4.jpg" alt="">
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item" data-aos="fade-up">
              <a href="img/gallery/gallery-5.jpg" class="gallery-popup">
                <img src="img/gallery/gallery-5.jpg" alt="">
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-item" data-aos="fade-up">
              <a href="img/gallery/gallery-6.jpg" class="gallery-popup">
                <img src="img/gallery/gallery-6.jpg" alt="">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #gallery -->
*/ ?>
    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container">
        <div class="row" data-aos="fade-up">

          <div class="col-lg-4 col-md-4">
            <div class="contact-about">
              <h3>PAW</h3>
              <p>Join our community or get in touch with the team via <script type="text/javascript">document.write('team@');</script>paw.digital</p>
              <div class="social-links">
                <a href="https://twitter.com/paw_digital" class="twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://reddit.com/r/PAW_digital/" class="reddit"><i class="fab fa-reddit"></i></a>
                <a href="https://t.me/paw_digital" class="telegram"><i class="fab fa-telegram"></i></a>
                <a href="https://discord.gg/DjXn6bb3aE" class="discord"><i class="fab fa-discord"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="info">


            </div>
          </div>

          <div class="col-lg-5 col-md-8">
            <div class="form">
            </div>
          </div>

        </div>

      </div>
    </section><!-- #contact -->

  </main>


<?php require('parts/footer.php'); ?>