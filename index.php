<?php get_header(); ?>

<!-- Banner -->
<section id="banner">
  <div class="inner">
    <div class="image"><img src="<?php echo get_template_directory_uri(); ?>/images/alk_logo_2016.png" height="66%" width= "66%" alt="" /></div><br>
    <h2><?php bloginfo('name'); ?></h2>
    <p>
      <span>#1 DOOR & HARDWARE COMPANY <br>IN CENTRAL AND SOUTH TEXAS</span>
      <!-- <span>LOCALLY FAMILY OWNED AND OPERATED</span> -->
      <span>BONDED AND INSURED SINCE 1976</span>
      <span>AVAILABLE 24/7!</span>
      <span>(210) 342-6678</span>
    </p>
  </div>
  <ul class="actions special">
    <li><br><a href="#contact" class="button primary">Contact Us</a></li>
  </ul>
  <a href="#one" class="more scrolly"> </a>
</section>

<!-- About -->
<section id="one" class="wrapper style1 special">
	<div class="inner">
		<header class="major">
			<h2>About Us<br />
				</h2>
				<p>
					Alert Lock & Key offers a full range door and hardware services, from new installs to remodels, service work, or door and hardware supply. We work with suppliers, general contractors, and businesses to ensure that your needs are met professionally and on time. The hardworking men and women of this company are our foundation, with decades of experience you can rest assured that AL&K is the right fit for your needs. We look forward to working with every single one of our customers. Give us a call today, so we can serve you in the best way possible.
				</p><br>
				<!-- Always visible paragraph -->
				<!-- <p>
					Alert Lock & Key offers a full range of San Antonio locksmith services, from lockouts to rekeying doors. We work with families and businesses to ensure that your home or office is completely secure. The professionals on our team can help you protect your home from criminals or can help you get into your home if you’ve locked yourself out. We can help you rekey after buying a new home so you can be confident that only selected people have access. We can also help you upgrade your security technology with smart locks and alarm systems so that you know that you and your valuables are as safe as possible.
				</p><br> -->

				<!-- Collapsible content -->
				<!-- <div class="more-content" id="more-content">
					<p>
					Family owned and operated for more than 40 years, Alert Lock and Key has been committed to providing prompt and quality service. We offer 24 hour full locksmith services, residential and commercial locksmith services, access control, CCTV, construction, installation of doors and hardware, storefront glass installation, along with safe openings, moved, serviced and sold. Alert Lock and Key is fully licensed, bonded and insured, and we guarantee that when you work with us, you are in good hands.
					</p><br>

					<p>
					Alert Lock & Key is happy to be up-to-date on the latest technology so that we can assist you to select smart locks and alarm systems that are right for your lifestyle. There are a wide variety of alternatives available on the marketplace, and we’re ready to spell out the advantages and disadvantages of each. We’ll help you select your very best option, followed by a complete installation that is done quickly and correctly. You will be confident your house will be completely protected, even when you’re on a trip thousands of miles away.
					</p><br>

					<p>
					Alert Lock & Key has been a reliable San Antonio company since 1976. For more than forty years, we’ve taken pride in providing excellent high quality locksmith services to the people and businesses of San Antonio. We provide free consultations on larger projects and quick turnarounds on immediate requests including lockouts and broken keys. You can always trust our locksmiths will perform a high-quality job and will keep your building as secure as possible.
					</p><br>
				</div> -->

				<!-- Toggle button -->
				<!-- <a class="toggle-btn" id="toggle-btn">Show More</a> -->
				<script>
					document.addEventListener("DOMContentLoaded", function () {
					const link = document.getElementById("toggle-btn");
					const content = document.getElementById("more-content");
					const section = document.getElementById("one"); 
					link.addEventListener("click", () => {
						const isExpanded = content.classList.toggle("show");
						link.textContent = isExpanded ? "Show Less" : "Show More";
						link.classList.add("reset-color");
						requestAnimationFrame(() => link.classList.remove("reset-color"));
						link.blur();
						if (!isExpanded) {
						section.scrollIntoView({ behavior: "smooth", block: "start" });
						}
					});
					});
				</script>

		</header>
		<ul class="icons major">
			<li><i class="fa fa-lock major style1"><i class="label"></i></i></li>
		</ul>
	</div>
</section>

<!-- Services -->
<section id="two" class="wrapper alt style2">
	<section class="spotlight">
		<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/images/secured_panic.png" alt="" /></div><div class="content">
			<h2>Doors & Hardware</h2>
			<p>
				Alert Lock & Key offers expert door and hardware installation in addition to supplying all your door and hardware needs. We provide durable door solutions and seamless installation to ensure optimal functionality and protection.</p>
		</div>
	</section>
	<section class="spotlight">
		<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/images/locksmith.png" alt="" /></div><div class="content">
			<h2>Locksmith Services</h2>
			<p>Alert Lock & Key offers fast, reliable key replacement and key making services for homes and businesses, ensuring secure access and swift resolution for lost keys. We also provide advanced High Security Restricted Keys for enhanced protection against unauthorized duplication and entry.</p>
		</div>
	</section>
	<section class="spotlight">
		<!-- <div class="image"><img src="<?php echo get_template_directory_uri(); ?>/images/pdk-banner-product-img.png" alt="" /></div><div class="content"> -->
		<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/images/PDK-Red-Family-1600x1226.png" alt="" /></div><div class="content">
			<h2>Access Control</h2>
			<p>Alert Lock & Key provides a full range of access control and enhanced security features to protect your business. Our solutions include remote monitoring and comprehensive safety measures to ensure peace of mind and efficient protection.</p>
		</div>
	</section>

</section>

<!-- Features -->
<section id="three" class="wrapper style3 special">
	<div class="inner">
		<header class="major">
			<h2>Services</h2>
			<p>In addition to general maintenance work, we specialize in the following services.</p>
		</header>
		<ul class="features">
			<li class="icon solid fa-building">
				<h3>Doors & Hardware</h3>
				<p>Alert Lock & Key offers complete commercial wood, hollow metal and commercial storefront glass solutions in Central and South Texas as well frames and all associated harware, ensuring security and functionality. No distance is too far!</p>
			</li>
			<li class="icon solid fa-lock">
				<h3>Locksmith</h3>
				<p>Alert Lock & Key offers fast and professional key replacement and rekeying services for homes and businesses in Central and South Texas, providing customized key systems, high-security restricted keys, and secure access control for all levels of users.</p>
			</li>
			<li class="icon solid fa-unlock">
				<h3>Access Control</h3>
				<p>Alert Lock & Key offers advanced access control systems in Central and South Texas, providing convenient, secure, and customizable smart locks for businesses that allow remote control, digital key management, easy lock changes, and enhanced security.</p>
			</li>
			<!-- <li class="icon solid fa-home">
				<h3>Residential</h3>
				<p>Alert Lock & Key offers comprehensive residential locksmith services in San Antonio, including lockouts, rekeying, lock replacement, and key extraction, ensuring homeowners' security and peace of mind.</p>
			</li> -->
			<!-- <li class="icon solid fa-car">
				<h3>Automobile</h3>
				<p>If you're locked out of your car in San Antonio, Alert Lock & Key offers fast, professional 24/7 auto locksmith services that prioritize safety and ensure no damage to your vehicle, whether you have traditional locks or modern fob technology.</p>
			</li> -->
			<!-- <li class="icon solid fa-bell">
				<h3>Alarm Systems</h3> 
				<p>Alert Lock & Key offers comprehensive San Antonio alarm systems that protect homes from intruders, fires, carbon monoxide, and other dangers, while also providing remote monitoring, potential insurance savings, and peace of mind through central monitoring and smartphone integration.</p>
			</li> -->
		</ul>
	</div>
</section>

<!-- Contact -->
<article id="contact">
	<section class="wrapper style5">
		<div class="inner">

			<section>
				<h4>Use the form below to send us a message</h4><br>
				<?php if (isset($_GET['form']) && $_GET['form'] === 'success') : ?>
					<div class="alert success" style="padding: 1rem; background: #c7f9cc; border: 1px solid #38a169; color: #22543d; margin-bottom: 1rem;">
						✅ Your message has been sent successfully. We'll get back to you shortly!
					</div>
				<?php endif; ?>
				
				<?php// echo do_shortcode('[contact-form-7 id="8875450" title="new contact form"]'); ?>
				<?php echo do_shortcode('[contact-form-7 id="87" title="new contact form"]'); ?>

			</section>
			<a href="mailto:workorders@alertlock.net" class="icon solid fa-envelope"> workorders@alertlock.net</a>
			<p class="icon solid fa-phone"> 210-342-6678
			<p class="icon solid fa-building"> 84 NE Interstate 410 Loop
			<br> San Antonio, TX 78216</p>
			<br>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3471.9177879829176!2d-98.48827322379279!3d29.518755443285087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865c60006672fe5b%3A0x804803b1b91be9cf!2s84%20NE%20Interstate%20410%20Loop%2C%20San%20Antonio%2C%20TX%2078216!5e0!3m2!1sen!2sus!4v1724881543732!5m2!1sen!2sus" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</section>
</article>

<!-- CTA -->
<section id="cta" class="wrapper style4">
	<div class="inner">
		<div class="swiper">
			<div class="swiper-wrapper">

				<div class="swiper-slide">
					<div class="brands"><img src="<?php echo get_template_directory_uri(); ?>/images/logo_medeco.png" class="logo1" /></div>
				</div>

				<div class="swiper-slide">
					<div class="brands"><br><img src="<?php echo get_template_directory_uri(); ?>/images/logo_x-09.png" class="logo2" /></div>
				</div>

				<div class="swiper-slide">
					<div class="brands"><br></vr><img src="<?php echo get_template_directory_uri(); ?>/images/logo_kaba_mas.png" class="logo3" /></div>
				</div>

				<div class="swiper-slide">
					<div class="brands"><br><img src="<?php echo get_template_directory_uri(); ?>/images/alarm_lock.png" class="logo4" /></div><br>
				</div>

				<div class="swiper-slide">
					<div class="brands"><br><img src="<?php echo get_template_directory_uri(); ?>/images/allegion.png" class="logo5" /></div>
				</div>

				<div class="swiper-slide">
					<div class="brands"><br><img src="<?php echo get_template_directory_uri(); ?>/images/assa_abloy.png" class="logo6" /></div><br>
				</div>

				<div class="swiper-slide">
					<div class="brands"><br><img src="<?php echo get_template_directory_uri(); ?>/images/pdk.png" class="logo7" /></div>
				</div>

			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			</div>
			
			<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
			<script>
			new Swiper(".swiper", {
				slidesPerView: 1,
				centeredSlides: true,
				centeredSlidesBounds: true,
				loop: true,
				// spaceBetween: 10,
				direction: "horizontal",
				loop: true,
				autoplay: {
					delay: 3000, // 5 seconds delay between slides
					disableOnInteraction: false, // Pause autoplay on interaction
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
			</script>
	</div>
</section>
<?php get_footer(); ?>