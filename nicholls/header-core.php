<!-- emergency notifiction and messages -->
<?php if ( function_exists( 'nicholls_emergency_notices') ) nicholls_emergency_notices(); ?>

<!-- #nicholls-header-wrapper - START -->
<div id="nicholls-header-wrapper" class="nicholls-header-wrapper-">
	<header id="nicholls-masthead" class="nicholls-site-header" role="banner">

		<div id="nicholls-secondary-navigation-wrapper">
			<nav id="nicholls-secondary-navigation" class="nicholls-secondary-navigation-" role="navigation">
				<div class="menu">
					<ul>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/parents">Parents</a>
						</li>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/current-students">Current Students</a>
						</li>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/faculty-staff">Faculty &amp; Staff</a>
						</li>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/alumni-friends">Alumni &amp; Friends</a>
						</li>
					</ul>
				</div>
				<div class="menu-search">
					<?php nicholls_form_google_search(); ?>
					<a id="n-button-search" class="n-button-search-" href="http://www.nicholls.edu/search">Search Nicholls</a>
				</div>
			</nav><!-- #site-secondary-navigation -->
		</div>

		<div class="nicholls-cta-secondary nicholls-cta">
			<a class="button nicholls-cta-request-info" href="http://www.nicholls.edu/request-info/">Request Information</a>
			<a class="button nicholls-cta-tours" href="http://www.nicholls.edu/tours">Tour Campus</a>
		</div>

		<div id="nicholls-ui-mobile"></div>

		<div class="nicholls-site-branding">
			<div class="nicholls-site-title"><a href="http://www.nicholls.edu/" rel="home">Testing site</a></div>
		</div><!-- .nicholls-site-branding -->

		<div class="nicholls-cta-primary nicholls-cta">
			<a class="button nicholls-cta-apply" href="http://www.nicholls.edu/apply/">Apply Now</a>
		</div>

		<div id="nicholls-primary-navigation-wrapper">
			<nav id="nicholls-primary-navigation" class="nicholls-primary-navigation-" role="navigation">
				<div class="menu">
					<ul>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/programs/">Programs</a>
						</li>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/admission/">Admissions</a>
						</li>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/campus-life/">Student Life</a>
						</li>
						<li class="menu-item">
							<a href="http://geauxcolonels.com">Athletics</a>
						</li>
						<li class="menu-item">
							<a href="http://www.nicholls.edu/about/">About Us</a>
						</li>
					</ul>
				</div>
			</nav><!-- #site-secondary-navigation -->
		</div>
	</header>
</div>
<!-- #nicholls-header-wrapper - END -->
