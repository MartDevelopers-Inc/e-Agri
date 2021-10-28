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

/* add product  */
if (isset($_POST['add'])) {
    $product_id = $sys_gen_id;
    $product_sku_code = $a . $b;
    $product_user_id = $_POST['product_user_id'];
    $product_category_id = $_POST['product_category_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_details = $_POST['product_details'];



    /* Post Product Details */
    $insert = "INSERT INTO products (product_id, product_sku_code, product_user_id, product_category_id, 
    product_name, product_price, product_quantity, product_details) VALUES(?,?,?,?,?,?,?,?)";
    $prepare = $mysqli->prepare($insert);
    $rc = $prepare->bind_param(
        'ssssssss',
        $product_id,
        $product_sku_code,
        $product_user_id,
        $product_category_id,
        $product_name,
        $product_price,
        $product_quantity,
        $product_details
    );
    $prepare->execute();
    if ($prepare) {
        $success = "$product_name, Added";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Update Product Images */
if (isset($_POST['update_images'])) {
}

/* Update product */
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_details = $_POST['product_details'];

    /* Persist Product details */
    $update = "UPDATE products SET product_name =?, product_price =?, product_quantity =?, product_details =? WHERE product_id =?";
    $prepare = $mysqli->prepare($update);
    $bind = $prepare->bind_param(
        'ssss',
        $product_name,
        $product_price,
        $product_quantity,
        $product_details,
        $product_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "$product_name, Updated";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Delete Product */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];

    /* Delete */
    $del = "DELETE FROM products WHERE product_id = ?";
    $prepare  = $mysqli->prepare($del);
    $bind = $prepare->bind_param('s', $delete);
    $prepare->execute();

    if ($prepare) {
        $success = "Deleted" && header('refresh:1; products');
    } else {
        $err = "Failed!, Please Try Again Later";
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
                                    <h1>Agricultural Products</h1>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                            <i class="fas fa-plus"></i> Register New Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Modal -->
                        <div class="modal fade" id="add_modal">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Register New Agricultural Product</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="POST">
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Name</label>
                                                <input type="text" required name="product_name" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Product Category</label>
                                                <select class="js-states form-control" tabindex="-1" style="width: 100%" name="product_category_id">
                                                    <?php
                                                    $ret = "SELECT * FROM  product_categories ORDER BY category_name ASC ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($categories = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $categories->category_id; ?>"><?php echo $categories->category_code . ' - ' . $categories->category_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label">Farmer Name</label>
                                                <select class="js-states form-control" tabindex="-1" style="width: 100%" name="product_user_id">
                                                    <?php
                                                    $ret = "SELECT * FROM  users WHERE user_access_level = 'farmer'  ";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($farmer = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $farmer->user_id; ?>"><?php echo $farmer->user_number . ' - ' . $farmer->user_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Product Unit Price (Ksh)</label>
                                                <input type="text" required name="product_price" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Product Available Quantity (Kgs)</label>
                                                <input type="text" required name="product_quantity" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Details</label>
                                                <textarea type="text" required name="product_details" rows="5" class="form-control-rounded form-control"></textarea>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="add" class="btn btn-primary">Add Product</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                        <div class="row">
                            <div class="row">

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