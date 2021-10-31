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

/* POP System Settings */
$ret = "SELECT * FROM  system_settings  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <footer id="footer" class="footer footer--style-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md col-lg-6">
                    <div class="footer__item">
                        <h5 class="footer__item__title h6">Quick Links</h5>
                        <ul>
                            <li><a href="index">Home</a></li>
                            <li><a href="about">About Us</a></li>
                            <li><a href="contacts">Contact Us</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-12 col-md col-lg-6">
                    <div class="footer__item">
                        <h5 class="footer__item__title h6">Contacts</h5>

                        <address>
                            <p>
                                523 Sylvan Ave, 5th Floor Mountain View, CA 940 Katoloni
                            </p>

                            <p>
                                <?php echo $sys->sys_contacts; ?>
                            </p>

                            <p>
                                <a href="mailto:<?php echo $sys->sys_email; ?>"><?php echo $sys->sys_email; ?></a>
                            </p>
                        </address>

                        <div class="social-btns">
                            <a href="#"><i class="fontello-twitter"></i></a>
                            <a href="#"><i class="fontello-facebook"></i></a>
                            <a href="#"><i class="fontello-linkedin-squared"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-lg-end justify-content-lg-between copyright">
                <div class="col-12 col-lg-6">
                    <div class="footer__item">
                        <span class="__copy">© 2021 - <?php echo date('Y'); ?>, <?php echo $sys->sys_name; ?>. Crafted by <a class="__dev" href="https://martdev.info" target="_blank">MartDevelopers Inc</a></span>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="footer__item">
                        <form class="form--horizontal no-gutters" action="#">
                            <div class="col-sm-6">
                                <div class="input-wrp">
                                    <input class="textfield" name="s" type="text" placeholder="Your E-mail" />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php } ?>