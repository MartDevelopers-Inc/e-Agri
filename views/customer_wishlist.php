<?php
/*
 * Created on Wed Nov 03 2021
 *
 *  Devlan - devlan.co.ke 
 *
 * hello@devlan.info
 *
 *
 * The Devlan End User License Agreement
 *
 * Copyright (c) 2021 Devlan
 *
 * 1. GRANT OF LICENSE
 * Devlan hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 * install and activate this system on two separated computers solely for your personal and non-commercial use,
 * unless you have purchased a commercial license from Devlan. Sharing this Software with other individuals, 
 * or allowing other individuals to view the contents of this Software, is in violation of this license.
 * You may not make the Software available on a network, or in any way provide the Software to multiple users
 * unless you have first purchased at least a multi-user license from Devlan.
 *
 * 2. COPYRIGHT 
 * The Software is owned by Devlan and protected by copyright law and international copyright treaties. 
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
 * Devlan  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 * Devlan SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
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
 * 7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL DEVLAN  OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 * CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 * USE OF THE SOFTWARE, EVEN IF DEVLAN HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 * IN NO EVENT WILL DEVLAN  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 * TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 */

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
checklogin();

/* Remove Product From Cart */
if (isset($_POST['remove'])) {
    $wishlist_id = $_POST['wishlist_id'];
    /* Persist */
    $sql = "DELETE FROM wishlist WHERE wishlist_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param('s', $wishlist_id);
    $prepare->execute();
    if ($prepare) {
        $success = "Removed From Wishlist";
    } else {
        $err = "Failed!, Try Again Or Later";
    }
}
require_once('../partials/head.php');
?>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once('../partials/customer_sidebar.php'); ?>
        <div class="app-container">
            <?php require_once('../partials/customer_header.php'); ?>
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="page-description">
                                    <h1>My Wishlist</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $ret = "SELECT * FROM wishlist w
                                INNER JOIN products p ON p.product_id = w.wishlist_product_id
                                INNER JOIN users u ON u.user_id = p.product_user_id
                                INNER JOIN product_categories pc ON pc.category_id = p.product_category_id
                                WHERE w.wishlist_user_id = '$user_id'
                                ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($products = $res->fetch_object()) {

                                ?>

                                    <div class="col">
                                        <div class="card h-100">
                                            <a href="customer_product?view=<?php echo $products->product_id; ?>">

                                                <?php if ($products->product_image_1 != '' || $products->product_image_2  != '' || $products->product_image_3 != '') {
                                                ?>
                                                    <img src="../public/backend_assets/images/products/<?php echo $products->product_image_2; ?>" class="card-img-top" alt="...">
                                                <?php } else { ?>
                                                    <img src="../public/backend_assets/images/products/no_img.jpg" class="card-img-top" alt="...">
                                                <?php } ?>
                                            </a>
                                            <div class="d-flex justify-content-center">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><?php echo $products->product_name; ?></li>
                                                    <li class="list-group-item">Ksh <?php echo $products->product_price; ?> Per Kg</li>
                                                    <li class="list-group-item">Wishlisted On : <?php echo date('M, d Y g:ia', strtotime($products->wishlist_created_on)); ?></li>
                                                    <li class="list-group-item">
                                                        <form method="POST">
                                                            <input type="hidden" name="wishlist_id" value="<?php echo $products->wishlist_id; ?>">
                                                            <button type="submit" name="remove" class="btn btn-danger">
                                                                <i class="fas fa-heart-broken"></i> Remove <?php echo $product->product_name; ?> From Wish List
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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