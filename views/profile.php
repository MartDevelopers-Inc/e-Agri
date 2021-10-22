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
checklogin();
/* Update User Profile */
if (isset($_POST['Update_Profile'])) {

    $user_id = $_SESSION['user_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone_no = $_POST['user_phone_no'];
    $user_idno = $_POST['user_idno'];

    $query = 'UPDATE users SET user_name =?, user_email =?, user_phone_no =?, user_idno =?  WHERE user_id = ?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssss',
        $user_name,
        $user_email,
        $user_phone_no,
        $user_idno,
        $user_id
    );

    $stmt->execute();
    if ($stmt) {
        $success = 'Account Updated';
    } else {
        $err = 'Please Try Again Or Try Later';
    }
}
/* Update User Password */
if (isset($_POST['Update_Password'])) {

    $user_id = $_SESSION['user_id'];
    $new_password = sha1(md5($_POST['new_password']));
    $confirm_password = sha1(md5($_POST['confirm_password']));

    /* Check If They Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Do Not Match";
    } else {

        $query = 'UPDATE users SET  user_password =? WHERE user_id =?  ';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $confirm_password, $user_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Password Updated";
        } else {
            $err = 'Please Try Again Or Try Later';
        }
    }
}
require_once('../partials/head.php'); ?>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <!-- Side Navigation Bar -->
        <?php require_once('../partials/sidebar.php'); ?>
        <!-- End Navigation -->
        <div class="app-container">
            <!-- Top Navigation Bar -->
            <?php require_once('../partials/header.php');
            /* Load User Profile */
            $user_id = $_SESSION['user_id'];
            $ret = "SELECT *  FROM users WHERE user_id = '$user_id'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($user = $res->fetch_object()) {
            ?>
                <!-- End Top Navigation -->
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="page-description page-description-tabbed">
                                        <h1>Profile Settings</h1>

                                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="hoaccountme" aria-selected="true">Account</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Security</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                                            <div class="card">
                                                <form method="POST">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="row m-t-lg">
                                                                <div class="col-md-6">
                                                                    <label for="settingsInputFirstName" class="form-label">Full Name</label>
                                                                    <input type="text" required name="user_name" value="<?php echo $user->user_name; ?>" class="form-control" id="settingsInputFirstName">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="settingsInputFirstName" class="form-label">National ID Number</label>
                                                                    <input type="text" required name="user_idno" value="<?php echo $user->user_idno; ?>" class="form-control" id="settingsInputFirstName">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="settingsInputEmail" class="form-label">Email address</label>
                                                                    <input type="email" required name="user_email" value="<?php echo $user->user_email; ?>" class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="settingsPhoneNumber" class="form-label">Phone Number</label>
                                                                    <input type="text" required name="user_phone_no" value="<?php echo $user->user_phone_no; ?>" class="form-control" id="settingsPhoneNumber" placeholder="(xxx) xxx-xxxx">
                                                                </div>
                                                            </div>
                                                            <div class="row m-t-lg">
                                                                <div class="col ">
                                                                    <input type="submit" name="Update_Profile" value="Update" class="text-right btn btn-primary m-t-sm" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row m-t-xxl">
                                                        <div class="col-md-12">
                                                            <label for="settingsNewPassword" class="form-label">New Password</label>
                                                            <input type="password" name="new_password" class="form-control" aria-describedby="settingsNewPassword">
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-xxl">
                                                        <div class="col-md-12">
                                                            <label for="settingsConfirmPassword" class="form-label">Confirm Password</label>
                                                            <input type="password" name="confirm_password" class="form-control" aria-describedby="settingsConfirmPassword">
                                                        </div>
                                                    </div>

                                                    <div class="row m-t-lg">
                                                        <div class="col">
                                                            <input type="submit" name="Update_Password" value="Update" class="text-right btn btn-primary m-t-sm" />
                                                        </div>
                                                    </div>
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
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>