<?php
/*
 * Created on Fri Oct 22 2021
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
$user_id = $_SESSION['user_id'];
$ret = "SELECT * FROM  users s 
JOIN  system_settings  
WHERE s.user_id = '$user_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    /* Check User Has Profile Image */
    if ($sys->user_dpic == '') {
        $img = "../public/backend_assets/images/avatars/no-profile.png";
    } else {
        $img = "../public/backend_assets/images/avatars/$sys->user_dpic";
    }

?>
    <div class="app-sidebar">
        <div class="logo">
            <a href="dashboard" class="logo-icon"><span class="logo-text"><?php echo $sys->sys_name; ?></span></a>
            <div class="sidebar-user-switcher user-activity-online">
                <a href="dashboard">
                    <img src="<?php echo $img; ?>">
                    <span class="activity-indicator"></span>
                    <span class="user-info-text"><?php echo $sys->user_name; ?>
                    </span>
                </a>
            </div>
        </div>
        <div class="app-menu">
            <ul class="accordion-menu">
                <li class="sidebar-title">
                    Apps
                </li>
                <li class="active-page">
                    <a href="index.html" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
                </li>
                <li>
                    <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Mailbox<span class="badge rounded-pill badge-danger float-end">87</span></a>
                </li>
                <li>
                    <a href="file-manager.html"><i class="material-icons-two-tone">cloud_queue</i>File Manager</a>
                </li>
                <li>
                    <a href="calendar.html"><i class="material-icons-two-tone">calendar_today</i>Calendar<span class="badge rounded-pill badge-success float-end">14</span></a>
                </li>
                <li>
                    <a href="todo.html"><i class="material-icons-two-tone">done</i>Todo</a>
                </li>
                <li>
                    <a href=""><i class="material-icons-two-tone">star</i>Pages<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="pricing.html">Pricing</a>
                        </li>
                        <li>
                            <a href="invoice.html">Invoice</a>
                        </li>
                        <li>
                            <a href="settings.html">Settings</a>
                        </li>
                        <li>
                            <a href="#">Authentication<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="sign-in.html">Sign In</a>
                                </li>
                                <li>
                                    <a href="sign-up.html">Sign Up</a>
                                </li>
                                <li>
                                    <a href="lock-screen.html">Lock Screen</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="error.html">Error</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">
                    UI Elements
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">color_lens</i>Styles<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="styles-typography.html">Typography</a>
                        </li>
                        <li>
                            <a href="styles-code.html">Code</a>
                        </li>
                        <li>
                            <a href="styles-icons.html">Icons</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">grid_on</i>Tables<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="tables-basic.html">Basic</a>
                        </li>
                        <li>
                            <a href="tables-datatable.html">DataTable</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="material-icons-two-tone">sentiment_satisfied_alt</i>Elements<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="ui-alerts.html">Alerts</a>
                        </li>
                        <li>
                            <a href="ui-avatars.html">Avatars</a>
                        </li>
                        <li>
                            <a href="ui-badge.html">Badge</a>
                        </li>
                        <li>
                            <a href="ui-breadcrumbs.html">Breadcrumbs</a>
                        </li>
                        <li>
                            <a href="ui-buttons.html">Buttons</a>
                        </li>
                        <li>
                            <a href="ui-button-groups.html">Button Groups</a>
                        </li>
                        <li>
                            <a href="ui-collapse.html">Collapse</a>
                        </li>
                        <li>
                            <a href="ui-dropdown.html">Dropdown</a>
                        </li>
                        <li>
                            <a href="ui-images.html">Images</a>
                        </li>
                        <li>
                            <a href="ui-pagination.html">Pagination</a>
                        </li>
                        <li>
                            <a href="ui-popovers.html">Popovers</a>
                        </li>
                        <li>
                            <a href="ui-progress.html">Progress</a>
                        </li>
                        <li>
                            <a href="ui-spinners.html">Spinners</a>
                        </li>
                        <li>
                            <a href="ui-toast.html">Toast</a>
                        </li>
                        <li>
                            <a href="ui-tooltips.html">Tooltips</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">card_giftcard</i>Components<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="components-accordions.html">Accordions</a>
                        </li>
                        <li>
                            <a href="components-block-ui.html">Block UI</a>
                        </li>
                        <li>
                            <a href="components-cards.html">Cards</a>
                        </li>
                        <li>
                            <a href="components-carousel.html">Carousel</a>
                        </li>
                        <li>
                            <a href="components-countdown.html">Countdown</a>
                        </li>
                        <li>
                            <a href="components-lightbox.html">Lightbox</a>
                        </li>
                        <li>
                            <a href="components-lists.html">Lists</a>
                        </li>
                        <li>
                            <a href="components-modals.html">Modals</a>
                        </li>
                        <li>
                            <a href="components-tabs.html">Tabs</a>
                        </li>
                        <li>
                            <a href="components-session-timeout.html">Session Timeout</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="widgets.html"><i class="material-icons-two-tone">widgets</i>Widgets</a>
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">edit</i>Forms<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="forms-basic.html">Basic</a>
                        </li>
                        <li>
                            <a href="forms-input-groups.html">Input Groups</a>
                        </li>
                        <li>
                            <a href="forms-input-masks.html">Input Masks</a>
                        </li>
                        <li>
                            <a href="forms-layouts.html">Form Layouts</a>
                        </li>
                        <li>
                            <a href="forms-validation.html">Form Validation</a>
                        </li>
                        <li>
                            <a href="forms-file-upload.html">File Upload</a>
                        </li>
                        <li>
                            <a href="forms-text-editor.html">Text Editor</a>
                        </li>
                        <li>
                            <a href="forms-datepickers.html">Datepickers</a>
                        </li>
                        <li>
                            <a href="forms-select2.html">Select2</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">analytics</i>Charts<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="charts-apex.html">Apex</a>
                        </li>
                        <li>
                            <a href="charts-chartjs.html">ChartJS</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">
                    Layout
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">view_agenda</i>Content<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="content-page-headings.html">Page Headings</a>
                        </li>
                        <li>
                            <a href="content-section-headings.html">Section Headings</a>
                        </li>
                        <li>
                            <a href="content-left-menu.html">Left Menu</a>
                        </li>
                        <li>
                            <a href="content-right-menu.html">Right Menu</a>
                        </li>
                        <li>
                            <a href="content-boxed-content.html">Boxed Content</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">menu</i>Menu<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="menu-off-canvas.html">Off-Canvas</a>
                        </li>
                        <li>
                            <a href="menu-standard.html">Standard</a>
                        </li>
                        <li>
                            <a href="menu-dark-sidebar.html">Dark Sidebar</a>
                        </li>
                        <li>
                            <a href="menu-hover-menu.html">Hover Menu</a>
                        </li>
                        <li>
                            <a href="menu-colored-sidebar.html">Colored Sidebar</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">view_day</i>Header<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="header-basic.html">Basic</a>
                        </li>
                        <li>
                            <a href="header-full-width.html">Full-width</a>
                        </li>
                        <li>
                            <a href="header-transparent.html">Transparent</a>
                        </li>
                        <li>
                            <a href="header-large.html">Large</a>
                        </li>
                        <li>
                            <a href="header-colorful.html">Colorful</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-title">
                    Other
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">bookmark</i>Documentation</a>
                </li>
                <li>
                    <a href="#"><i class="material-icons-two-tone">access_time</i>Change Log</a>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>