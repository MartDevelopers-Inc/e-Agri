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

/* add product  */
if (isset($_POST['add'])) {
    $product_id = $sys_gen_id;
    $product_sku_code = $a . $b;
    $product_user_id = $_SESSION['user_id'];
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
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];

    /* Process Posted Images */
    $img_1 = explode(".", $_FILES['product_image_1']["name"]);
    $img_2 = explode(".", $_FILES['product_image_2']["name"]);
    $img_3 = explode(".", $_FILES['product_image_3']["name"]);

    /* Give New File Names */
    $new_img_1 = $sys_img_code_alpha . '.' . end($img_1);
    $new_img_2 = $sys_img_code_beta . '.' . end($img_2);
    $new_img_3 = $sys_img_code_gamma . '.' . end($img_3);

    /* Move Uploaded Images */
    move_uploaded_file($_FILES["product_image_1"]["tmp_name"], "../public/backend_assets/images/products/" . $new_img_1);
    move_uploaded_file($_FILES["product_image_2"]["tmp_name"], "../public/backend_assets/images/products/" . $new_img_2);
    move_uploaded_file($_FILES["product_image_3"]["tmp_name"], "../public/backend_assets/images/products/" . $new_img_3);

    /* Persist Changes */
    $update = "UPDATE products SET product_image_1 =?, product_image_2 =?, product_image_3 =? WHERE product_id = ?";
    $prepare = $mysqli->prepare($update);
    $bind = $prepare->bind_param(
        'ssss',
        $new_img_1,
        $new_img_2,
        $new_img_3,
        $product_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Images Uploaded";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
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
        'sssss',
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
    /* Get Product Images */
    $img_1 = $_GET['img_1'];
    $img_2 = $_GET['img_2'];
    $img_3 = $_GET['img_3'];
    /* Delete */
    $del = "DELETE FROM products WHERE product_id = ?";
    $prepare  = $mysqli->prepare($del);
    $bind = $prepare->bind_param('s', $delete);
    $prepare->execute();

    /* Delete File Images */
    $img1_dir = '../public/backend_assets/images/products/' . $img_1;
    $img2_dir = '../public/backend_assets/images/products/' . $img_2;
    $img3_dir = '../public/backend_assets/images/products/' . $img_3;


    if ($prepare && unlink($img1_dir) && unlink($img2_dir) && unlink($img3_dir)) {
        $success = "Deleted" && header('refresh:1; products');
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}



require_once('../partials/head.php');
?>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once('../partials/farmer_sidebar.php'); ?>
        <div class="app-container">
            <?php require_once('../partials/farmer_header.php'); ?>
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
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Product Unit Price (Ksh)</label>
                                                <input type="number" required name="product_price" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Product Available Quantity (Kgs)</label>
                                                <input type="number" required name="product_quantity" class="form-control-rounded form-control">
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
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable1" class="display table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>SKU #</th>
                                                    <th>QTY</th>
                                                    <th>Price Per Kg</th>
                                                    <th>Category</th>
                                                    <th>Farmer Details</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $user_id = $_SESSION['user_id'];
                                                /* Load All Farmers */
                                                $ret = "SELECT * FROM  products p
                                                INNER JOIN users u ON u.user_id = p.product_user_id
                                                INNER JOIN product_categories pc ON pc.category_id = p.product_category_id
                                                WHERE p.product_user_id = '$user_id'
                                                ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($products = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $products->product_name; ?></td>
                                                        <td><?php echo $products->product_sku_code; ?></td>
                                                        <td><?php echo $products->product_quantity; ?> Kgs</td>
                                                        <td>Ksh <?php echo $products->product_price; ?></td>
                                                        <td><?php echo $products->category_name; ?></td>
                                                        <td>
                                                            Name: <?php echo $products->user_name; ?><br>
                                                            Phone: <?php echo $products->user_phone_no; ?><br>
                                                        </td>
                                                        <td>
                                                            <a href="farmer_product?view=<?php echo $products->product_id; ?>" class="badge rounded-pill badge-success">
                                                                <i class="fas fa-tag"></i> View
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#edit-<?php echo $products->product_id; ?>" class="badge rounded-pill badge-warning">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#images-<?php echo $products->product_id; ?>" class="badge rounded-pill badge-primary">
                                                                <i class="fas fa-file-image"></i> Edit Images
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#delete-<?php echo $products->product_id; ?>" class="badge rounded-pill badge-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                            <!-- Update Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $products->product_id; ?>">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update <?php echo $products->product_name; ?> Details</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="row g-3" method="POST">
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Name</label>
                                                                                    <input type="text" required name="product_name" value="<?php echo $products->product_name; ?>" class="form-control-rounded form-control">
                                                                                    <input type="hidden" required name="product_id" value="<?php echo $products->product_id; ?>" class="form-control-rounded form-control">

                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Product Unit Price (Ksh)</label>
                                                                                    <input type="number" required name="product_price" value="<?php echo $products->product_price; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Product Available Quantity (Kgs)</label>
                                                                                    <input type="number" required name="product_quantity" value="<?php echo $products->product_quantity; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label for="inputAddress" class="form-label">Details</label>
                                                                                    <textarea type="text" required name="product_details" rows="5" class="form-control-rounded form-control"><?php echo $products->product_details; ?></textarea>
                                                                                </div>

                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                    <button type="submit" name="update" class="btn btn-primary">Update Product</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Modal -->

                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $products->product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETION</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete <?php echo $products->product_name; ?> Details ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete <?php echo $products->product_name; ?> Details. This action is irrevisble.</p>
                                                                            <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="products?delete=<?php echo $products->product_id; ?>&img_1=<?php echo $products->product_image_1; ?>&img_2=<?php echo $products->product_image_2; ?>&img_3=<?php echo $products->product_image_3; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Modal -->

                                                            <!-- Change Image -->
                                                            <div class="modal fade" id="images-<?php echo $products->product_id; ?>">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update <?php echo $products->product_name; ?> Images</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="row g-3" method="POST" enctype="multipart/form-data">
                                                                                <input type="hidden" required name="product_name" value="<?php echo $products->product_name; ?>" class="form-control-rounded form-control">
                                                                                <input type="hidden" required name="product_id" value="<?php echo $products->product_id; ?>" class="form-control-rounded form-control">
                                                                                <div class="col-md-12">
                                                                                    <label for="inputAddress" class="form-label">Product Image 1</label>
                                                                                    <input required accept=".webp, .png, .jpg, .jpeg" type="file" name="product_image_1" class="form-control form-control-rounded">
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label for="inputAddress" class="form-label">Product Image 2</label>
                                                                                    <input required accept=".webp, .png, .jpg, .jpeg" type="file" name="product_image_2" class="form-control form-control-rounded">
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label for="inputAddress" class="form-label">Product Image 3</label>
                                                                                    <input required accept=".webp, .png, .jpg, .jpeg" type="file" name="product_image_3" class="form-control form-control-rounded">
                                                                                </div>
                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                    <button type="submit" name="update_images" class="btn btn-primary">Upload Product Image</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Modal -->
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