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
/* Update System Settings */
if (isset($_POST['update'])) {
    $sys_name = $_POST['sys_name'];
    $sys_tagline = $_POST['sys_tagline'];
    $sys_contacts = $_POST['sys_contacts'];
    $sys_email = $_POST['sys_email'];
    $sys_paybill_no = $_POST['sys_paybill_no'];
    $sys_about = $_POST['sys_about'];

    /* Persist This */
    $update = "UPDATE system_settings SET sys_name =?, sys_tagline =?, sys_contacts =?, sys_email =?, sys_paybill_no =?, sys_about =?";
    $prepare = $mysqli->prepare($update);
    $bind = $prepare->bind_param(
        'ssssss',
        $sys_name,
        $sys_tagline,
        $sys_contacts,
        $sys_email,
        $sys_paybill_no,
        $sys_about
    );
    $prepare->execute();
    if ($prepare) {
        $success = "System Details Updated";
    } else {
        $err = "Failed, Please Try Again Later";
    }
}

/* Update Mailer Settings */
if (isset($_POST['update_mailer'])) {
    $mailer_host = $_POST['mailer_settings'];
    $mailer_username = $_POST['mailer_username'];
    $mailer_from_email  = $_POST['mailer_from_email'];
    $mailer_password = $_POST['mailer_password'];

    /* Persit This */
    $update = "UPDATE mailer_setttings SET mailer_host =?, mailer_username =?, mailer_from_email =?, mailer_password =?";
    $prepare = $mysqli->prepare($update);
    $bind = $prepare->bind_param(
        'ssss',
        $mailer_host,
        $mailer_username,
        $mailer_from_email,
        $mailer_password
    );
    $prepare->execute();
    if ($prepare) {
        $success = "STMP Mailer Configurations Updated";
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
                                    <h1>System Configurations</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <?php
                                $ret = "SELECT * FROM  system_settings ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($sys = $res->fetch_object()) {
                                ?>
                                    <div class="col-12">
                                        <div class="card widget widget-connection-request">
                                            <div class="card-body">
                                                <form class="row g-3" method="POST">
                                                    <div class="col-md-6">
                                                        <label for="inputEmail4" class="form-label">System Name</label>
                                                        <input type="text" required name="sys_name" value="<?php echo $sys->sys_name; ?>" class="form-control-rounded form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="inputAddress" class="form-label">System Contacts</label>
                                                        <input type="text" required  name="sys_contacts" value="<?php echo $sys->sys_contacts; ?>" class="form-control-rounded form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEmail4" class="form-label">System Email</label>
                                                        <input type="text" required name="sys_email" value="<?php echo $sys->sys_email; ?>" class="form-control-rounded form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="inputAddress" class="form-label">System Paybill Number</label>
                                                        <input type="text" required  name="sys_paybill_no" value="<?php echo $sys->sys_paybill_no; ?>" class="form-control-rounded form-control">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress" class="form-label">System Tagline </label>
                                                        <textarea type="text" required name="sys_tagline" rows="2" class="form-control-rounded form-control"><?php echo $sys->sys_tagline; ?></textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress" class="form-label">System About </label>
                                                        <textarea type="text" required name="sys_about" rows="4" class="form-control-rounded form-control"><?php echo $sys->sys_about; ?></textarea>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" name="update" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
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