<?php
/*
 * Created on Wed Oct 27 2021
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
require_once('../config/codeGen.php');
checklogin();
require_once('../partials/head.php');
?>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once('../partials/sidebar.php'); ?>
        <div class="app-container">
            <?php require_once('../partials/header.php');
            $view = $_GET['view'];
            $ret = "SELECT * FROM  users WHERE user_id = '$view'  ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($customer = $res->fetch_object()) {
                /* User Profile */
                /* Check User Has Profile Image */
                if ($customer->user_dpic == '') {
                    $img = "../public/backend_assets/images/avatars/no-profile.png";
                } else {
                    $img = "../public/backend_assets/images/avatars/$customer->user_dpic";
                }
            ?>
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="page-description">
                                        <h1><?php echo $customer->user_name; ?> Profile</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <div class="card widget widget-info">
                                        <div class="card-body">
                                            <div class="widget-info-container">
                                                <div class="widget-info-image" style="background: url('<?php echo $img; ?>')"></div>
                                                <h5 class="widget-info-title"><?php echo $customer->user_name; ?></h5>
                                                <h5 class="widget-info-title"><i class="fas fa-user-tag"></i> <?php echo $customer->user_idno; ?></h5>
                                                <h5 class="widget-info-title"><i class="fas fa-phone"></i> <?php echo $customer->user_phone_no; ?></h5>
                                                <h5 class="widget-info-title"><i class="fas fa-envelope-open-text"></i> <?php echo $customer->user_email; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="card widget widget-info">
                                        <div class="card-body">
                                            <div class="widget-info-container">
                                                <h5 class="widget-info-title"><?php echo $customer->user_name; ?> Linked Credit / Debit Cards</h5>
                                                <table id="datatable1" class="display table" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Card Number</th>
                                                            <th>Card CVV</th>
                                                            <th>Exp Month</th>
                                                            <th>Card Vendor</th>
                                                            <th>Date Added</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM user_cards WHERE card_user_id = '$view'";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($cards = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo substr($cards->card_number, 0, 5); ?>XXXXXX
                                                                </td>
                                                                <td>
                                                                    <?php echo $cards->card_cvv; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $cards->card_month; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $cards->card_vendor; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date('d M Y g:ia', strtotime($cards->date_card_added)); ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card widget widget-info">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Purchases Records</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <table class="table display" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Farmer Details</th>
                                                                <th>Product Details</th>
                                                                <th>Cart Details</th>
                                                                <th>Payment Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            /* Load All Farmer Sales */
                                                            $ret = "SELECT * FROM  payment pa
                                                            INNER JOIN cart c ON c.cart_id = pa.payment_cart_id
                                                            INNER JOIN products p ON p.product_id = c.cart_product_id
                                                            INNER JOIN product_categories pc ON pc.category_id = p.product_category_id
                                                            INNER JOIN users u ON u.user_id = p.product_user_id
                                                            WHERE c.cart_user_id = '$view'  ";
                                                            $stmt = $mysqli->prepare($ret);
                                                            $stmt->execute(); //ok
                                                            $res = $stmt->get_result();
                                                            while ($sales = $res->fetch_object()) {
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        Name: <?php echo $sales->user_name; ?><br>
                                                                        Phone No: <?php echo $sales->user_phone_no; ?><br>
                                                                        Email: <?php echo $sales->user_email; ?>
                                                                    </td>
                                                                    <td>
                                                                        Name: <?php echo $sales->product_name; ?><br>
                                                                        SKU: <?php echo $sales->product_sku_code; ?><br>
                                                                        Price: Ksh <?php echo $sales->product_price; ?><br>
                                                                        Category: <?php echo $sales->category_name; ?>
                                                                    </td>
                                                                    <td>
                                                                        Qty: <?php echo $sales->cart_product_quantity; ?><br>
                                                                        Date Purchased: <?php echo date('d, M Y g:ia', strtotime($sales->cart_product_added_at)); ?>
                                                                    </td>
                                                                    <td>
                                                                        Txn ID : <?php echo $sales->payment_transaction_code; ?><br>
                                                                        Amount : Ksh <?php echo $sales->payment_amount; ?><br>
                                                                        Date Paid: <?php echo date('d, M Y g:ia', strtotime($sales->payment_date_posted)); ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Javascripts -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>