<?php
/*
Template Name: Careers
*/
get_header();
?>
				<!-- Main -->
					<article id="careers">
						<header>
							<!-- <h2>Careers</h2> -->
							<p>Fill out the form below to apply today</p><br>
						</header>
                        <?php if (isset($_GET['status']) && $_GET['status'] === 'sent'): ?>
                            <div class="alert success" style="padding:1rem;background:#c7f9cc;border:1px solid #38a169;color:#22543d;margin-bottom:1rem;">
                                ✅ Application received. Thank you!
                            </div>
                            <?php elseif (isset($_GET['status']) && $_GET['status'] === 'sent-no-pdf'): ?>
                            <div class="alert" style="padding:1rem;background:#fff7cc;border:1px solid #f6c343;color:#6b5100;margin-bottom:1rem;">
                                ⚠️ Application received, but the PDF engine isn’t set up yet. We emailed the details without a PDF.
                            </div>
                            <?php elseif (isset($_GET['status']) && $_GET['status'] === 'incomplete'): ?>
                            <div class="alert" style="padding:1rem;background:#ffe1e1;border:1px solid #e53e3e;color:#7b1d1d;margin-bottom:1rem;">
                                ❌ Please complete all required fields.
                            </div>
                        <?php endif; ?>
						<section class="wrapper style6">
							<div class="inner">

								<section>
									<h4>Employment Application</h4>
									<p>Please enter your information. Fill in all boxes.</p><br>

                                    <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
                                        <input type="hidden" name="action" value="alk_careers_submit">
                                        <?php wp_nonce_field('alk_careers_nonce', 'alk_careers_nonce_field'); ?>
                                            <div class="row gtr-uniform">
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="text" name="first-name" id="first-name" placeholder="First Name" />
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="email" name="applicant-email" id="applicant-email" placeholder="Email" />
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="text" name="middle-name" id="middle-name" placeholder="Middle Name" />
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="tel" name="applicant-phone" id="applicant-phone" placeholder="Phone Number" />
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="text" name="last-name" id="last-name" placeholder="Last Name" />
                                                </div>
                                            </div>

                                            <div class="row gtr-uniform location-group">
                                                <div class="col-12">
                                                    <br><p class="location-label">Where are you located?</p>
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="text" name="city" id="city" placeholder="City" />
                                                </div>
                                                <div class="col-6 col-12-xsmall">
                                                    <input type="text" name="state" id="state" placeholder="State" />
                                                </div>
                                            </div>


                                            <ul class="questions">

                                                <div class="questions">Are you comfortable with using portable devices (cell phones, tablets, apps, etc.)?
                                                    <div class="question-radio" data-question="1">
                                                        <label><input type="radio" name="q1" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q1" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">Are you at least 18 years of age?
                                                    <div class="question-radio" data-question="2">
                                                        <label><input type="radio" name="q2" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q2" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">Are you legally able to work in the U.S.?
                                                    <div class="question-radio" data-question="3">
                                                        <label><input type="radio" name="q3" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q3" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">Have you worked for Alert Lock & Key before?
                                                    <div class="question-radio" data-question="4">
                                                        <label><input type="radio" name="q4" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q4" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">Do you have a valid driver's license?
                                                    <div class="question-radio" data-question="5">
                                                        <label><input type="radio" name="q5" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q5" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">Do you have a clean driving record?
                                                    <div class="question-radio" data-question="6">
                                                        <label><input type="radio" name="q6" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q6" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">
                                                    <div class="question-radio" data-question="7">Are you able to reliably get to work on time?
                                                        <label><input type="radio" name="q7" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q7" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">
                                                    <div class="question-radio" data-question="8">Are you willing to participate in random drug screenings?
                                                        <label><input type="radio" name="q8" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q8" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">
                                                    <div class="question-radio" data-question="10">Are you willing to travel for work?
                                                        <label><input type="radio" name="q10" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q10" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">
                                                    <div class="question-radio" data-question="11">Are you willing to be out of town overnight?
                                                        <label><input type="radio" name="q11" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q11" value="No"> No</label>
                                                    </div>
                                                </div>

                                                <div class="questions">
                                                    <div class="question-radio" data-question="12">Are you willing to be out of town multiple days/nights in a row?
                                                        <label><input type="radio" name="q12" value="Yes" required> Yes</label>
                                                        <label><input type="radio" name="q12" value="No"> No</label>
                                                    </div>
                                                </div>
                                                
												<br><div class="experience">Please check all the experience you have: (Hold Ctrl to select multiple experience types)
                                                    <br>
													<!-- <br><span class="experiences"> -->
														<select name="experience-selection[]" id="checkbox" class="experience-selection" aria-required="true" aria-invalid="false" multiple="multiple">
															<option value="">---</option>
															<option value="None">None</option>
															<option value="Home Renovations/D.I.Y">Home Renovations/D.I.Y</option>
															<option value="Locksmith">Locksmith</option>
															<option value="Commercial Construction">Commercial Construction</option>
															<option value="Residential Construction">Residential Construction</option>
															<option value="Carpentry">Carpentry</option>
															<option value="Finish Carpentry">Finish Carpentry</option>
															<option value="Electrical">Electrical</option>
															<option value="Access Control">Access Control</option>
															<option value="Low Voltage">Low Voltage</option>
															<option value="Door Hardware Installation">Door Hardware Installation</option>
															<option value="Facilities Maintenance">Facilities Maintenance</option>
														</select>
													<!-- </span> -->
												</div>


                                                <br><div class="tools">Which best describes the tools you own:
													<br>
														<select name="tool-category"  id="checkbox" class="experience-selection" aria-required="true" aria-invalid="false" multiple="multiple">
															<option value="">- Select One -</option>
															<option value="None">None</option>
															<option value="Basic Tools (Electric Drill, Pliers, Screw Driver, Measuring Tape, Hammer)">Basic Tools (Electric Drill, Pliers, Screw Driver, Measuring Tape, Hammer)</option>
															<option value="Experienced Tools (Basic Tools+)">Experienced Tools (Basic Tools+)</option>
														</select>
                                                </div>

                                                <br><div class="col-12">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Submit" /></li>
                                                        <li><input type="reset" value="Reset" /></li>
                                                    </ul>
                                                </div>
                                            </ul>
										</div>
									</form>
								</section>
							</div>
						</section>
					</article>

<?php get_footer(); ?>