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


/* Pop System Settings Here */
$ret = "SELECT * FROM  system_settings  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <header id="top-bar" class="top-bar top-bar--style-2">
        <div class="top-bar__bg" style="background-color: #FFF;background-image: url(img/top_bar_bg-2.png);background-repeat: no-repeat;background-position: center bottom;"></div>

        <div class="container position-relative">
            <div class="row justify-content-between no-gutters">

                <a class="top-bar__logo site-logo" href="index">
                    <img class="img-fluid" src="../public/backend_assets/images/neptune.png" alt="demo" />
                </a>

                <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--dark" href="javascript:void(0);"><span></span></a>

                <div id="top-bar__inner" class="top-bar__inner  text-lg-right">
                    <div>
                        <div class="d-lg-flex flex-lg-column-reverse align-items-lg-end">
                            <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                                <ul>

                                    <li>
                                        <a href="index">Home</a>
                                    </li>

                                    <li>
                                        <a href="about">About</a>
                                    </li>
                                    <li class="has-submenu" style="display: none;">
                                        <a href="javascript:void(0);">Shop</a>

                                        <ul class="submenu">
                                            <li><a href="shop_catalog.html">Shop Catalog</a></li>
                                            <li><a href="single_product.html">Single Product</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="sign_in.html">Sign In/Up</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="blogs">Blog</a>
                                    </li>

                                    <li>
                                        <a href="contacts">Contacts</a>
                                    </li>
                                    <li>
                                        <a href="customer_signup">Register Customer Account</a>
                                    </li>
                                    <li>
                                        <a href="farmer_signup">Register Farmer Account</a>
                                    </li>
                                    <li class="li-btn">
                                        <a class="custom-btn custom-btn--small custom-btn--style-2" href="login">Sign In</a>
                                    </li>
                                </ul>
                            </nav>

                            <div class="top-bar__contacts">
                                <span>523 Sylvan Ave, 5th Floor Mountain View, Katoloni, Machakos</span>
                                <span><a href="#"><?php echo $sys->sys_contacts; ?></a></span>
                                <span><a href="mailto:<?php echo $sys->sys_email; ?>"><?php echo $sys->sys_email; ?></a></span>

                                <div class="social-btns">
                                    <a class="fontello-twitter" href="#"></a>
                                    <a class="fontello-facebook" href="#"></a>
                                    <a class="fontello-linkedin-squared" href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
<?php } ?>