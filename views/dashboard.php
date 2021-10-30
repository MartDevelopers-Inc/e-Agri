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
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../partials/analytics.php');
checklogin();
require_once('../partials/head.php');
?>


<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <!-- Sidebar -->
        <?php require_once('../partials/sidebar.php'); ?>
        <!-- End Sidebar -->

        <div class="app-container">
            <!-- Header -->
            <?php require_once('../partials/header.php'); ?>
            <!-- End Header -->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="page-description">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">paid</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">Overall Sales Revenue</span>
                                                <span class="widget-stats-amount">Ksh <?php echo $revenue; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">people_outline</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">Customers</span>
                                                <span class="widget-stats-amount"><?php echo $customers; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">supervised_user_circle</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">Farmers</span>
                                                <span class="widget-stats-amount"><?php echo $farmers; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">redeem</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">Agri Products</span>
                                                <span class="widget-stats-amount"><?php echo $products; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">redeem</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">Processed Orders</span>
                                                <span class="widget-stats-amount"><?php echo $paid_orders; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card widget widget-stats">
                                    <div class="card-body">
                                        <div class="widget-stats-container d-flex">
                                            <div class="widget-stats-icon widget-stats-icon-primary">
                                                <i class="material-icons-outlined">redeem</i>
                                            </div>
                                            <div class="widget-stats-content flex-fill">
                                                <span class="widget-stats-title">Pending Orders</span>
                                                <span class="widget-stats-amount"><?php echo $pending_orders; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card widget widget-list">
                                    <div class="card-header">
                                        <h5 class="card-title">Recent Purchases <a href="successful_checkouts" class="badge badge-success badge-style-light">View All</a></h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="widget-list-content list-unstyled">
                                            <?php
                                            /* Load All Purchased Done Today */
                                            $ret = "SELECT * FROM cart c 
                                            INNER JOIN products p ON p.product_id = c.cart_product_id
                                            INNER JOIN users u ON u.user_id  = c.cart_user_id 
                                            ORDER BY c.cart_product_added_at DESC
                                            ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($purchases = $res->fetch_object()) {
                                            ?>
                                                <li class="widget-list-item widget-list-item-green">
                                                    <span class="widget-list-item-icon"><i class="material-icons-outlined">shopping_basket</i></span>
                                                    <span class="widget-list-item-description">
                                                        <a href="successful_checkouts" class="widget-list-item-description-title">
                                                            <?php echo $purchases->user_name; ?>, Purchased <?php echo $purchases->cart_product_quantity . ' Kgs Of ' . $purchases->product_name; ?> <br>
                                                            <span class="text-primary">Payment Status: <?php echo $purchases->cart_checkout_status; ?></span>
                                                        </a>
                                                        <span class="widget-list-item-description-subtitle badge badge-success badge-style-light">
                                                            <?php echo  date('d M Y g:ia', strtotime($purchases->cart_product_added_at)); ?>
                                                        </span>
                                                    </span>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card widget widget-list">
                                    <div class="card-header">
                                        <h5 class="card-title">Recent Payments Logs <a href="payments" class="badge badge-success badge-style-light">View All</a></h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="widget-list-content list-unstyled">
                                            <?php
                                            /* Load All Purchased Done Today */
                                            $ret = "SELECT * FROM payment pa
                                            INNER JOIN cart c ON c.cart_id = pa.payment_cart_id 
                                            INNER JOIN products p ON p.product_id = c.cart_product_id
                                            INNER JOIN users u ON u.user_id  = c.cart_user_id
                                            ORDER BY pa.payment_date_posted DESC
                                            ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($payments = $res->fetch_object()) {
                                            ?>
                                                <li class="widget-list-item widget-list-item-green">
                                                    <span class="widget-list-item-icon"><i class="material-icons-outlined">paid</i></span>
                                                    <span class="widget-list-item-description">
                                                        <a href="payments" class="widget-list-item-description-title">
                                                            <span class="text-success"><?php echo $payments->payment_transaction_code; ?></span> CONFIRMED<br>
                                                            <span class="text-primary"><?php echo $payments->user_name; ?></span>
                                                            Paid Ksh <?php echo $payments->payment_amount; ?>
                                                            For <?php echo $payments->product_name; ?> <br> Order.
                                                        </a>
                                                        <span class="widget-list-item-description-subtitle text-successs">
                                                            Posted On: <?php echo date('d M Y g:ia', strtotime($payments->payment_date_posted)); ?>
                                                        </span>
                                                    </span>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>