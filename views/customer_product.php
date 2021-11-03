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

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
checklogin();
/* Add To Cart */
if (isset($_POST['add'])) {
    $cart_id = $sys_gen_id;
    $cart_user_id = $_SESSION['user_id'];
    $cart_product_id = $_POST['cart_product_id'];
    $cart_product_quantity = $_POST['cart_product_quantity'];

    /* Persist This */
    $insert = "INSERT INTO cart(cart_id, cart_user_id, cart_product_id, cart_product_quantity) VALUES(?,?,?,?)";
    $prepare = $mysqli->prepare($insert);
    $bind = $prepare->bind_param(
        'ssss',
        $cart_id,
        $cart_user_id,
        $cart_product_id,
        $cart_product_quantity
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Product Added To Cart, Proceed To Checkout";
    } else {
        $err = "Failed, Please Try Again Later";
    }
}
require_once('../partials/head.php');
?>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once('../partials/customer_sidebar.php'); ?>
        <div class="app-container">
            <?php require_once('../partials/customer_header.php');
            $view = $_GET['view'];
            $ret = "SELECT * FROM  products p
            INNER JOIN users s ON s.user_id = p.product_user_id
             WHERE product_id = '$view'  ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($product = $res->fetch_object()) {
            ?>
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="page-description">
                                        <h1><?php echo $product->product_name . ' -  ' . $product->product_sku_code; ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php if ($product->product_image_1 != '' || $product->product_image_2  != '' || $product->product_image_3 != '') {
                                                ?>
                                                    <div class="carousel-item active">
                                                        <img src="../public/backend_assets/images/products/<?php echo $product->product_image_1; ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="../public/backend_assets/images/products/<?php echo $product->product_image_2; ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="../public/backend_assets/images/products/<?php echo $product->product_image_3; ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="carousel-item active">
                                                        <img src="../public/backend_assets/images/products/no_img.jpg" class="d-block w-100" alt="...">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card widget widget-info">
                                        <div class="card-body">
                                            <div class="widget-info-container">
                                                <h5 class="widget-info-title"><span class="text-primary">Product SKU: </span> <?php echo $product->product_sku_code; ?></h5>
                                                <h5 class="widget-info-title"><span class="text-primary">Available Quantity:</span> <?php echo $product->product_quantity; ?> Kgs</h5>
                                                <h5 class="widget-info-title"><span class="text-primary">Price Per KG:</span> Ksh <?php echo $product->product_price; ?></h5>
                                                <h5 class="widget-info-title"><span class="text-primary">Farmer Name:</span> <?php echo $product->user_name; ?></h5>
                                                <h5 class="widget-info-title"><span class="text-primary">Farmer Phone Number:</span> <?php echo $product->user_phone_no; ?></h5>
                                                <h5 class="widget-info-title"><span class="text-primary">Farmer Email: </span> <?php echo $product->user_email; ?></h5>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Product To Cart -->
                                    <div class="modal fade" id="add_modal">
                                        <div class="modal-dialog  modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Kindly Select The Quantity (Kilograms) Of <?php echo $product->product_name; ?> You Want To Purchase</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST">
                                                        <div class="col-md-12">
                                                            <label for="inputPassword4" class="form-label">Quantity In Kgs</label>
                                                            <input type="number" value="1" required name="cart_product_quantity" class="form-control-rounded form-control">
                                                            <input type="hidden" value="<?php echo $view; ?>" required name="cart_product_id" class="form-control-rounded form-control">
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" name="add" class="btn btn-primary">Add To Cart</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                    <div class="card widget widget-info">
                                        <div class="card-body">
                                            <div class="widget-info-container">
                                                <h5 class="widget-info-title text-primary">Details</h5>
                                                <p>
                                                    <?php echo $product->product_details; ?>
                                                </p>

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                                    <i class="fas fa-cart-plus"></i> Add <?php echo $product->product_name; ?> To Cart
                                                </button>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_modal">
                                                    <i class="fas fa-heart"></i> Add <?php echo $product->product_name; ?> To Wish List
                                                </button>
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