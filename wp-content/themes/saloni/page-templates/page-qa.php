<?php
/**
 * Template Name: Q&A Page
 * Description: Template for the Q&A/FAQ page
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/9.jpg);">
    <div class="overlay-main site-bg-secondry opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary">Q&A'S</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Q&A'S</li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- Q&A SECTION START -->
<div class="section-full p-t80 p-b50 bg-orange-light">
    <div class="container">
        <div class="section-content">

            <div class="row d-flex justify-content-center">

                <div class="col-lg-10 col-md-12 col-sm-12">

                    <!-- Accordian -->
                    <div class="wt-accordion acc-bg-white" id="accordion5">

                        <div class="panel wt-panel">
                            <div class="acod-head acc-actives">
                                <h4 class="acod-title">
                                    <a data-toggle="collapse" href="#collapseOne5" data-parent="#accordion5">
                                        What is your cancellation policy?
                                        <span class="indicator"><i class="fa fa-plus"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne5" class="acod-body collapse show">
                                <div class="acod-content p-a20 bg-white">Providing outstanding service is the core of
                                    our business. Because spa services are reserved especially for you, we ask that you
                                    notify us 24 hours in advance to change or cancel appointments without penalty.
                                    Without 24 hour notice, we will charge a fee of 50% of the price of the cancelled
                                    service, and 100% of the service in the event of a "no-show." We thank you in
                                    advance for your cooperation and understanding. Spa packages and groups must give a
                                    minimum 48 hour cancellation notice.</div>
                            </div>
                        </div>

                        <div class="panel wt-panel">
                            <div class="acod-head">
                                <h4 class="acod-title">
                                    <a data-toggle="collapse" href="#collapseTwo5" class="collapsed"
                                        data-parent="#accordion5">
                                        What are your hours?
                                        <span class="indicator"><i class="fa fa-plus"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo5" class="acod-body collapse">
                                <div class="acod-content p-a20 bg-white">
                                    Monday – Friday: 9 to 7pm Saturday: 8 to 6pm Sunday: Closed
                                </div>
                            </div>
                        </div>

                        <div class="panel wt-panel">
                            <div class="acod-head">
                                <h4 class="acod-title">
                                    <a data-toggle="collapse" href="#collapseThree5" class="collapsed"
                                        data-parent="#accordion5">
                                        How do I schedule an appointment?
                                        <span class="indicator"><i class="fa fa-plus"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree5" class="acod-body collapse">
                                <div class="acod-content p-a20 bg-white">You can schedule your appointment by phone, in
                                    person or online. Reservations for your appointment are held with a credit card or
                                    gift certificate.</div>
                            </div>
                        </div>

                        <div class="panel wt-panel">
                            <div class="acod-head">
                                <h4 class="acod-title">
                                    <a data-toggle="collapse" href="#collapseFour5" class="collapsed"
                                        data-parent="#accordion5">
                                        What should I wear for a spa or salon treatment?
                                        <span class="indicator"><i class="fa fa-plus"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour5" class="acod-body collapse">
                                <div class="acod-content p-a20 bg-white">No special clothing is required; come as you
                                    are! If you are enjoying several services, you will be provided with a robe and
                                    slippers. Towels for the eucalyptus steam shower are available. Your personal
                                    comfort is always most important to us!</div>
                            </div>
                        </div>

                        <div class="panel wt-panel">
                            <div class="acod-head">
                                <h4 class="acod-title">
                                    <a data-toggle="collapse" href="#collapseFive5" class="collapsed"
                                        data-parent="#accordion5">
                                        What if I have lost my gift certificate?
                                        <span class="indicator"><i class="fa fa-plus"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive5" class="acod-body collapse">
                                <div class="acod-content p-a20 bg-white">Your certificate is considered the same as
                                    cash. It is necessary to keep track of this valuable property.</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Q&A SECTION END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>