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
							<a href="https://www.nicholls.edu/current-students">Current Students</a>
						</li>
						<li class="menu-item">
							<a href="https://www.nicholls.edu/faculty-staff">Faculty &amp; Staff</a>
						</li>
						<li class="menu-item">
							<a href="https://www.nicholls.edu/alumni-friends">Alumni &amp; Friends</a>
						</li>
						<li class="menu-item">
							<a href="https://www.nicholls.edu/online">Nicholls Online</a>
						</li>
					</ul>
				</div>
				<div class="menu-search">
					<?php nicholls_form_google_search(); ?>
					<a id="n-button-search" class="n-button-search-" href="https://www.nicholls.edu/search">Search</a>
				</div>
			</nav><!-- #site-secondary-navigation -->
		</div>

		<div class="nicholls-cta-secondary nicholls-cta">
			<a class="button nicholls-cta-request-info" href="https://www.nicholls.edu/request-info/">Request Information</a>
			<a class="button nicholls-cta-tours" href="https://www.nicholls.edu/tours">Tour Campus</a>
		</div>

		<div id="nicholls-ui-mobile"></div>

		<div class="nicholls-site-branding">
			<div class="nicholls-site-title"><a href="https://www.nicholls.edu/" rel="home">Nicholls State University</a></div>
		</div><!-- .nicholls-site-branding -->

		<div class="nicholls-cta-primary nicholls-cta">
			<a class="button nicholls-cta-apply" href="https://www.nicholls.edu/apply/">Apply Now</a>
			<a class="button nicholls-cta-donate" href="http://www.nichollsfoundation.org/" target="_blank">Donate</a>
		</div>

		<div id="nicholls-primary-navigation-wrapper">
			<nav id="nicholls-primary-navigation" class="nicholls-primary-navigation-" role="navigation">
				<div class="menu">
					<ul>
						<li class="menu-item">
							<a href="https://www.nicholls.edu/programs/">Programs</a>
						</li>
						<li class="menu-item">
							<a href="https://www.nicholls.edu/admission/">Admissions</a>
						</li>
						<li class="menu-item">
							<a href="https://www.nicholls.edu/campus-life/">Student Life</a>
						</li>
						<li class="menu-item">
							<a href="http://geauxcolonels.com">Athletics</a>
						</li>
						<li class="menu-item">
							<a href="https://www.nicholls.edu/about/">About Us</a>
						</li>
					</ul>
				</div>
			</nav><!-- #site-secondary-navigation -->
		</div>
	</header>
</div>
<!-- #nicholls-header-wrapper - END -->
