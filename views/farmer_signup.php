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
/* Handle User Login  */
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');

if (isset($_POST['sign_up'])) {
    $user_id = $sys_gen_id;
    $user_access_level = 'farmer';
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone_no = $_POST['user_phone_no'];
    $user_password = sha1(md5($_POST['user_password']));
    $confirm_user_password = sha1(md5($_POST['confirm_user_password']));
    /* Check If These Shits Match */
    if ($user_password != $confirm_user_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Post This User Details, But Before That Check If This MF exists */
        $sql = "SELECT * FROM  users  WHERE user_phone_no ='$user_phone_no' || user_email = '$user_email' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($user_phone_no == $row['user_phone_no'] || $user_email == $row['user_email']) {
                $err = 'Account With That Phone Number Or Email  Already Exists';
            }
        } else {
            /* Now Persist This MF Details */
            $query = 'INSERT INTO users(user_id, user_name, user_email, user_phone_no, user_password) VALUES(?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssss', $user_id, $user_name, $user_email, $user_phone_no, $user_password);
            $stmt->execute();
            if ($stmt) {
                $success = 'Welcome ' . $user_name . ',Your Account  Has Been Created, Proceed To Login ';
            } else {
                $err = 'Please Try Again Or Try Later';
            }
        }
    }
}
require_once('../partials/head.php');

/* Pop System Settings Here */
$ret = "SELECT * FROM  system_settings  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>

    <body>
        <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
            <div class="app-auth-background">
            </div>
            <div class="app-auth-container">
                <div class="logo">
                    <a href=""><?php echo $sys->sys_name; ?></a>
                </div>
                <p class="auth-description">Please enter your credentials to create a farmeraccount.<br>Already have a farmer account? <a href="login">Sign In</a></p>
                <form method="post">
                    <div class="auth-credentials m-b-xxl">
                        <label for="signInEmail" class="form-label">Full Name</label>
                        <input type="text" name="user_name" class="form-control m-b-md" name="user_email" required>

                        <label for="signInEmail" class="form-label">Email Address</label>
                        <input type="text" name="user_email" class="form-control m-b-md" name="user_email" required>

                        <label for="signInEmail" class="form-label">Phone Number</label>
                        <input type="email" name="user_phone_no" class="form-control m-b-md" name="user_email" required>

                        <label for="signInPassword" class="form-label">Password</label>
                        <input type="password" name="user_password" class="form-control" name="user_password">

                        <label for="signInPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="user_password" class="form-control" name="user_password">
                    </div>
                    <div class="auth-submit">
                        <input type="submit" name="sign_up" value="Sign Up" class="btn btn-primary" />
                        <a href="forgot_password" class="auth-forgot-password float-end">Forgot password?</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Javascripts -->
        <?php require_once('../partials/scripts.php'); ?>
    </body>
<?php } ?>

</html>