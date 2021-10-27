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
/* Add Farmer */
if (isset($_POST['add_farmer'])) {
    $user_id = $sys_gen_id;
    $user_number = $_POST['user_number'];
    $user_name = $_POST['user_name'];
    $user_idno = $_POST['user_idno'];
    $user_email = $_POST['user_email'];
    $user_phone_no = $_POST['user_phone_no'];
    $new_password = sha1(md5($_POST['new_password']));
    $confirm_password = sha1(md5($_POST['confirm_password']));
    $user_access_level = 'farmer';
    $user_created_at = date('d, M Y');
    /* Check If These MFS Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Check If Theres MF With These Details */
        $sql = "SELECT * FROM  users  WHERE user_idno = '$user_idno' || user_phone_no = '$user_phone_no' || user_email = '$user_email' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($user_idno == $row['user_idno'] || $user_phone_no == $row['user_phone_no'] || $user_email == $row['user_email']) {
                $err = 'A Farmer Account With That  National ID Number Or Phone Number Or Email  Already Exists';
            }
        } else {
            /* Persist This */
            $insert = "INSERT INTO users (user_id, user_number, user_name, user_access_level, user_idno, user_email, user_phone_no, user_password, user_created_at) 
            VALUES(?,?,?,?,?,?,?,?,?)";
            $prepare = $mysqli->prepare($insert);
            $rc = $prepare->bind_param('sssssssss', $user_id, $user_number, $user_name,  $user_access_level, $user_idno, $user_email, $user_phone_no, $confirm_password, $user_created_at);
            $prepare->execute();
            if ($prepare) {
                $success = "$user_name, Account Registered";
            } else {
                $err = "Failed!, Please Try Again Later";
            }
        }
    }
}

/* Update Farmer */
if (isset($_POST['update_farmer'])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_idno = $_POST['user_idno'];
    $user_email = $_POST['user_email'];
    $user_phone_no = $_POST['user_phone_no'];
    /* Check If These MFS Match */

    /* Persist This */
    $update = "UPDATE users SET user_name =?, user_idno =?, user_email =?, user_phone_no =? WHERE user_id =?";
    $prepare = $mysqli->prepare($update);
    $rc = $prepare->bind_param('sssss', $user_name, $user_idno, $user_email,  $user_phone_no, $user_id);
    $prepare->execute();
    if ($prepare) {
        $success = "$user_name, Account Updated";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Delete Farmer */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    /* Delete This MF */
    $del = "DELETE FROM users WHERE user_id = '$delete'";
    $prepare = $mysqli->prepare($del);

    if ($prepare) {
        $success -= "Deleted" && header('refresh:1; farmers');
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
                                    <h1>Farmers</h1>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                            <i class="fas fa-user-plus"></i> Register Farmer
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
                                        <h4 class="modal-title">Register New Farmer</h4>
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
                                                <label for="inputAddress" class="form-label">Farmer Number</label>
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
                                                <button type="submit" name="add_farmer" class="btn btn-primary">Add Farmer</button>
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
                                        <table id="datatable1" class="display" style="width:100%">
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
                                                /* Load All Farmers */
                                                $ret = "SELECT * FROM  users WHERE user_access_level = 'farmer'  ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($farmer = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $farmer->user_name; ?></td>
                                                        <td><?php echo $farmer->user_number; ?></td>
                                                        <td><?php echo $farmer->user_idno; ?></td>
                                                        <td><?php echo $farmer->user_email; ?></td>
                                                        <td><?php echo $farmer->user_phone_no; ?></td>
                                                        <td><?php echo $farmer->user_created_at; ?></td>
                                                        <td>
                                                            <a href="farmer?view=<?php echo $farmer->user_id; ?>" class="badge rounded-pill badge-success">
                                                                <i class="fas fa-user-tag"></i> View
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#edit-<?php echo $farmer->user_id; ?>" class="badge rounded-pill badge-warning">
                                                                <i class="fas fa-user-edit"></i> Edit
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#delete-<?php echo $farmer->user_id; ?>" class="badge rounded-pill badge-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                            <!-- Update Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $farmer->user_id; ?>">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update <?php echo $farmer->user_name; ?> Details</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="row g-3" method="POST">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Full Name</label>
                                                                                    <input type="text" name="user_name" value="<?php echo $farmer->user_name; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputPassword4" class="form-label">National ID Number</label>
                                                                                    <input type="text" name="user_idno" value="<?php echo $farmer->user_idno; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label for="inputAddress" class="form-label">Phone Number</label>
                                                                                    <input type="text" name="user_phone_no" value="<?php echo $farmer->user_phone_no; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label for="inputAddress2" class="form-label">Email Address</label>
                                                                                    <input type="email" name="user_email" value="<?php echo $farmer->user_email; ?>" class="form-control-rounded form-control">
                                                                                    <input type="hidden" name="user_id" value="<?php echo $farmer->user_id; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                    <button type="submit" name="update_farmer" class="btn btn-primary">Update</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Modal -->

                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $farmer->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETION</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete <?php echo $farmer->user_name; ?> Details ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete <?php echo $farmer->user_name; ?> Details. This action is irrevisble.</p>
                                                                            <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="farmers?delete=<?php echo $farmer->user_id; ?>" class="text-center btn btn-danger"> Delete </a>
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