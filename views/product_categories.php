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
/* Add Product Category */
if (isset($_POST['add'])) {
    $category_id = $sys_gen_id;
    $category_code = $_POST['category_code'];
    $category_name = $_POST['category_name'];
    $category_details = $_POST['category_details'];

    /* Prevent Double Entry */
    $sql = "SELECT * FROM  product_categories  WHERE category_name = '$category_name'";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($category_name == $row['category_name']) {
            $err = 'Category Already Exists';
        }
    } else {
        $insert = "INSERT INTO product_categories (category_id, category_code, category_name, category_description) VALUES(?,?,?,?)";
        $prepare = $mysqli->prepare($insert);
        $rc = $prepare->bind_param('ssss', $category_id, $category_code, $category_name, $category_details);
        if ($prepare) {
            $success = "$category_name, Added";
        } else {
            $err = "Failed!, Please Try Again Later";
        }
    }
}
/* Update Product Category */
if (isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_details = $_POST['category_details'];

    /* Persist */
    $update = "UPDATE product_categories SET category_name =?, category_details =? WHERE category_id =?";
    $prepare = $mysqli->prepare($update);
    $rc = $prepare->bind_param('sss', $category_name, $category_details, $category_id);
    if ($prepare) {
        $success = "$category_name, Updated";
    } else {
        $err = "Failed! Please Try Again";
    }
}

/* Delete Product Category */
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
                                    <h1>Customers</h1>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                            <i class="fas fa-user-plus"></i> Register Customer
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
                                        <h4 class="modal-title">Register New Customer</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="POST">
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Full Name</label>
                                                <input type="text" required name="user_name" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPassword4" class="form-label">National ID Number</label>
                                                <input type="text" required name="user_idno" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-6">
                                                <label for="inputAddress" class="form-label">Customer Number</label>
                                                <input type="text" required readonly name="user_number" value="<?php echo $a . $b; ?>" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-6">
                                                <label for="inputAddress" class="form-label">Phone Number</label>
                                                <input type="text" required name="user_phone_no" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Email Address</label>
                                                <input type="email" required name="user_email" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-6">
                                                <label for="inputAddress" class="form-label">Password</label>
                                                <input type="password" required name="new_password" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-6">
                                                <label for="inputAddress" class="form-label">Confirm Password</label>
                                                <input type="password" required name="confirm_password" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="add" class="btn btn-primary">Add Customer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable1" class="display table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Number</th>
                                                    <th>ID Number</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Joined On</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                /* Load All Customers */
                                                $ret = "SELECT * FROM  users WHERE user_access_level = 'customer'  ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($customers = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $customers->user_name; ?></td>
                                                        <td><?php echo $customers->user_number; ?></td>
                                                        <td><?php echo $customers->user_idno; ?></td>
                                                        <td><?php echo $customers->user_email; ?></td>
                                                        <td><?php echo $customers->user_phone_no; ?></td>
                                                        <td><?php echo $customers->user_created_at; ?></td>
                                                        <td>
                                                            <a href="customer?view=<?php echo $customers->user_id; ?>" class="badge rounded-pill badge-success">
                                                                <i class="fas fa-user-tag"></i> View
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#edit-<?php echo $customers->user_id; ?>" class="badge rounded-pill badge-warning">
                                                                <i class="fas fa-user-edit"></i> Edit
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#password-<?php echo $customers->user_id; ?>" class="badge rounded-pill badge-primary">
                                                                <i class="fas fa-lock"></i> Edit Password
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#delete-<?php echo $customers->user_id; ?>" class="badge rounded-pill badge-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                            <!-- Update Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $customers->user_id; ?>">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update <?php echo $customers->user_name; ?> Details</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="row g-3" method="POST">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Full Name</label>
                                                                                    <input type="text" name="user_name" value="<?php echo $customers->user_name; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputPassword4" class="form-label">National ID Number</label>
                                                                                    <input type="text" name="user_idno" value="<?php echo $customers->user_idno; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label for="inputAddress" class="form-label">Phone Number</label>
                                                                                    <input type="text" name="user_phone_no" value="<?php echo $customers->user_phone_no; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label for="inputAddress2" class="form-label">Email Address</label>
                                                                                    <input type="email" name="user_email" value="<?php echo $customers->user_email; ?>" class="form-control-rounded form-control">
                                                                                    <input type="hidden" name="user_id" value="<?php echo $customers->user_id; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Modal -->

                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $customers->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETION</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete <?php echo $customers->user_name; ?> Details ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete <?php echo $customers->user_name; ?> Details. This action is irrevisble.</p>
                                                                            <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="customers?delete=<?php echo $customers->user_id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Modal -->

                                                            <!-- Change Password -->
                                                            <div class="modal fade" id="password-<?php echo $customers->user_id; ?>">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update <?php echo $customers->user_name; ?> Password</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="row g-3" method="POST">
                                                                                <div class="col-md-12">
                                                                                    <label for="inputEmail4" class="form-label">New Password</label>
                                                                                    <input type="password" name="new_password" class="form-control-rounded form-control">
                                                                                    <input type="hidden" value="<?php echo $customers->user_id; ?>" name="user_id" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label for="inputPassword4" class="form-label">Confirm Password</label>
                                                                                    <input type="password" name="confirm_password" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                    <button type="submit" name="change_password" class="btn btn-primary">Update</button>
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