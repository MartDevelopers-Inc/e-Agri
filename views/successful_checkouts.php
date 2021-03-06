<?php
/*
 * Created on Thu Oct 28 2021
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
/* Update Cart */
if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_product_quantity = $_POST['cart_product_quantity'];
    /* Persist */
    $update = "UPDATE cart SET cart_product_quantity =? WHERE cart_id =?";
    $prepare = $mysqli->prepare($update);
    $bind = $prepare->bind_param('ss', $cart_product_quantity, $cart_id);
    $prepare->execute();
    if ($prepare) {
        $success = "Cart Updated, Proceed To Checkout";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Pay Order */
if (isset($_POST['pay'])) {
    $payment_id = $sys_gen_id;
    $payment_cart_id = $_POST['payment_cart_id'];
    $payment_transaction_code  = $_POST['payment_transaction_code'];
    $payment_amount = $_POST['payment_amount'];
    /* Product */
    $product_id = $_POST['product_id'];
    $product_qty = $_POST['product_qty'];
    $cart_quantity = $_POST['cart_quantity'];
    $new_quantity = $product_qty - $cart_quantity;
    $checkout_status = 'Paid';
    /* If Cart Quantity Is Huge Than The Current Quantity Dont Allow To Pay */
    if ($cart_quantity > $product_qty) {
        $err = "No Available Quantities To Process Your Order";
    } else {

        /* Post Payment */
        $payment = "INSERT INTO payment(payment_id, payment_cart_id, payment_transaction_code, payment_amount) VALUES(?,?,?,?)";
        /* Update Cart */
        $cart = "UPDATE cart SET cart_checkout_status = ? WHERE cart_id =?";
        /* Decrent Product Quantity */
        $product = "UPDATE products SET product_quantity =? WHERE product_id = ?";

        /* Prepare Statements */
        $payprep = $mysqli->prepare($payment);
        $cartprep = $mysqli->prepare($cart);
        $productprep = $mysqli->prepare($product);

        /* Binds */
        $paybind = $payprep->bind_param(
            'ssss',
            $payment_id,
            $payment_cart_id,
            $payment_transaction_code,
            $payment_amount
        );
        $cartbind = $cartprep->bind_param(
            'ss',
            $checkout_status,
            $payment_cart_id
        );
        $productbind = $productprep->bind_param(
            'ss',
            $new_quantity,
            $product_id
        );

        /* Executes */
        $payprep->execute();
        $cartprep->execute();
        $productprep->execute();

        if ($payprep && $cartprep && $productprep) {
            $success = "Payment Posted";
        } else {
            $err = "Failed!, Please Try Again Later";
        }
    }
}
require_once('../partials/head.php');
?>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once('../partials/sidebar.php'); ?>
        <div class="app-container">
            <?php require_once('../partials/header.php'); ?>
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="page-description">
                                    <h1>Processed Cart Checkouts</h1>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable1" class="display table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Customer Details</th>
                                                    <th>Product Details</th>
                                                    <th>Cart Details</th>
                                                    <th>Shipping Details</th>
                                                    <th>Payment Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ret = "SELECT * FROM cart c 
                                                INNER JOIN products p ON p.product_id = c.cart_product_id
                                                INNER JOIN users u ON u.user_id  = c.cart_user_id 
                                                INNER JOIN payment pd ON pd.payment_cart_id  = c.cart_id
                                                INNER JOIN shippings sh ON sh.shippings_order_id = c.cart_id
                                                WHERE cart_checkout_status  != 'Pending'
                                                ORDER BY c.cart_product_added_at DESC
                                                ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($products = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            Name: <?php echo $products->user_name; ?><br>
                                                            Phone: <?php echo $products->user_phone_no; ?><br>
                                                        </td>
                                                        <td>
                                                            Name: <?php echo $products->product_name; ?><br>
                                                            SKU: <?php echo $products->product_sku_code; ?><br>
                                                            Unit(Kg) Price: Ksh <?php echo $products->product_price; ?><br>
                                                        </td>
                                                        <td>
                                                            QTY: <?php echo $products->cart_product_quantity; ?> Kgs<br>
                                                            Amount: Ksh<?php echo ($products->cart_product_quantity * $products->product_price); ?><br>
                                                            Date Added: <?php echo  date('d M Y g:ia', strtotime($products->cart_product_added_at)); ?><br>
                                                        </td>
                                                        <td>
                                                            Shipping Status: <?php echo $products->cart_shipping_status; ?> <br>
                                                            Shipping Address: <?php echo ($products->shipping_address); ?>
                                                        </td>
                                                        <td>
                                                            Txn ID : <?php echo $products->payment_transaction_code; ?><br>
                                                            Amount : Ksh <?php echo $products->payment_amount; ?><br>
                                                            Date Paid: <?php echo date('d, M Y g:ia', strtotime($products->payment_date_posted)); ?>
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
    <!-- Javascripts -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>