<?php
/*
 * Created on Sun Oct 31 2021
 *
 *  MartDevelopers Inc - martdev.info 
 *
 * mail@martdev.info
 *
 * +254 740 847 563
 *
 * The MartDevelopers Inc End User License Agreement
 *
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * 1. GRANT OF LICENSE
 * MartDevelopers Inc hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 * install and activate this system on two separated computers solely for your personal and non-commercial use,
 * unless you have purchased a commercial license from MartDevelopers. Sharing this Software with other individuals, 
 * or allowing other individuals to view the contents of this Software, is in violation of this license.
 * You may not make the Software available on a network, or in any way provide the Software to multiple users
 * unless you have first purchased at least a multi-user license from MartDevelopers.
 *
 * 2. COPYRIGHT 
 * The Software is owned by MartDevelopers and protected by copyright law and international copyright treaties. 
 * You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 * 3. RESTRICTIONS ON USE
 * You may not, and you may not permit others to
 * (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 * (b) modify, distribute, or create derivative works of the Software;
 * (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 * otherwise exploit the Software.  
 *
 * 4. TERM
 * This License is effective until terminated. 
 * You may terminate it at any time by destroying the Software, together with all copies thereof.
 * This License will also terminate if you fail to comply with any term or condition of this Agreement.
 * Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 * 5. NO OTHER WARRANTIES. 
 * MartDevelopers Inc  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 * MartDevelopers Inc SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 * EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 * SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 * ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 * INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 * SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 * THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 * HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 * 6. SEVERABILITY
 * In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 * affect the validity of the remaining portions of this license.
 *
 * 7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL MartDevelopers Inc  OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 * CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 * USE OF THE SOFTWARE, EVEN IF MartDevelopers Inc HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 * IN NO EVENT WILL MartDevelopers Inc  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 * TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 */

require_once('../config/config.php');
require_once('../partials/landing_head.php');
?>

<body>
    <div id="app">
        <!-- start header -->
        <?php require_once('../partials/landing_header.php');
        /* Pop System Settings Here */
        $ret = "SELECT * FROM  system_settings  ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($sys = $res->fetch_object()) {
        ?>
            <!-- end header -->

            <!-- start hero -->
            <div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%" style="background-image: url(../public/landing_assets/img/home_img/img_9.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <h1 class="__title"><span>About</span><?php echo $sys->sys_name; ?></h1>

                            <p>
                                <?php echo $sys->sys_tagline; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end hero -->

            <!-- start main -->
            <main role="main">
                <!-- Common styles
				================================================== -->
                <link rel="stylesheet" href="../public/landing_assets/css/style.min.css" type="text/css">

                <!-- Load lazyLoad scripts
				================================================== -->
                <script>
                    (function(w, d) {
                        var m = d.getElementsByTagName('main')[0],
                            s = d.createElement("script"),
                            v = !("IntersectionObserver" in w) ? "8.17.0" : "10.19.0",
                            o = {
                                elements_selector: ".lazy",
                                data_src: 'src',
                                data_srcset: 'srcset',
                                threshold: 500,
                                callback_enter: function(element) {

                                },
                                callback_load: function(element) {
                                    element.removeAttribute('data-src')

                                    oTimeout = setTimeout(function() {
                                        clearTimeout(oTimeout);

                                        AOS.refresh();
                                    }, 1000);
                                },
                                callback_set: function(element) {

                                },
                                callback_error: function(element) {
                                    element.src = "../../../placeholdit.imgix.net/_textc349?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
                                }
                            };
                        s.type = 'text/javascript';
                        s.async = true; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
                        s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
                        m.appendChild(s);
                        // m.insertBefore(s, m.firstChild);
                        w.lazyLoadOptions = o;
                    }(window, document));
                </script>

                <!-- start section -->
                <section class="section section--no-pb section--custom-01">
                    <div class="container">
                        <div class="section-heading">
                            <h2 class="__title">We are <span>An Online Marketplace For Farmers</span></h2>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 col-xl-8">
                                <p>
                                    <?php echo $sys->sys_about; ?>
                                </p>
                                <p>
                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="contacts">Get in Touch</a>
                                </p>
                                <br>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <!-- end main -->
        <?php } ?>

        <!-- start footer -->
        <?php require_once('../partials/landing_footer.php'); ?>
        <!-- end footer -->
    </div>

    <div id="btn-to-top-wrap">
        <a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
    </div>

    <?php require_once('../partials/landing_scripts.php'); ?>
</body>

</html>