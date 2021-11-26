<?php
/*
 * Created on Fri Oct 29 2021
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
require_once('../config/codeGen.php');
require_once('../config/checklogin.php');
checklogin();
/* Add Card */
if (isset($_POST['add_card'])) {
    $card_id = $sys_gen_id;
    $card_user_id = $_SESSION['user_id'];
    $card_number = $_POST['card_number'];
    $card_vendor = $_POST['card_vendor'];
    $card_month = $_POST['card_month'];
    $card_year = $_POST['card_year'];
    $card_cvv = $_POST['card_cvv'];
    $date_card_added = $_POST['date_card_added'];

    /* Persist */
    $sql = "INSERT INTO user_cards (card_id, card_user_id, card_vendor, card_number, card_month, card_year, card_cvv, date_card_added) 
    VALUES(?,?,?,?,?,?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssssssss',
        $card_id,
        $card_user_id,
        $card_vendor,
        $card_number,
        $card_month,
        $card_year,
        $card_cvv,
        $date_card_added
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Credit Card Added";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Update Card */
if (isset($_POST['update_card'])) {
    $card_id = $_POST['card_id'];
    $card_number = $_POST['card_number'];
    $card_vendor = $_POST['card_vendor'];
    $card_month = $_POST['card_month'];
    $card_year = $_POST['card_year'];
    $card_cvv = $_POST['card_cvv'];

    /* Persist */
    $sql = "UPDATE user_cards SET card_number =?, card_vendor =?, card_month =?, card_year =?, card_cvv =? WHERE card_id =?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssssss',
        $card_number,
        $card_vendor,
        $card_month,
        $card_year,
        $card_cvv,
        $card_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Card Updated";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Delete Card */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    /* Persist */
    $sql = "DELETE FROM user_cards WHERE card_id = ?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param('s', $delete);
    $prepare->execute();
    if ($prepare) {
        $success = "Card Deleted" && header('refresh:1 my_cards');
    } else {
        $err = "Failed!, Please Try Again Later";
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
                                    <h1>My Cards</h1>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                            <i class="fas fa-plus"></i> Register New Card
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
                                        <h4 class="modal-title">Register New Debit Or Credit Card</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="POST">
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Card Number</label>
                                                <input type="text" required name="card_number" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Card Vendor</label>
                                                <select class="js-states form-control" tabindex="-1" style="width: 100%" name="card_vendor">
                                                    <option>Visa</option>
                                                    <option>Mastercard</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail4" class="form-label">Exp Month</label>
                                                <input type="text" required name="card_month" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail4" class="form-label">Exp Year</label>
                                                <input type="text" required name="card_year" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail4" class="form-label">Card CVV</label>
                                                <input type="text" required name="card_cvv" class="form-control-rounded form-control">
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="add_card" class="btn btn-primary">Add Card</button>
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
                                                    <th>Card Number</th>
                                                    <th>Card CVV</th>
                                                    <th>Exp Month</th>
                                                    <th>Card Vendor</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $user_id = $_SESSION['user_id'];
                                                $ret = "SELECT * FROM user_cards uc INNER JOIN users u ON
                                                uc.card_user_id = u.user_id";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($cards = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo substr($cards->card_number, 0, 5); ?>XXXXXX
                                                        </td>
                                                        <td>
                                                            <?php echo $cards->card_cvv; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $cards->card_month; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $cards->card_vendor; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d M Y g:ia', strtotime($cards->date_card_added)); ?>
                                                        </td>
                                                        <td>
                                                            <a data-bs-toggle="modal" href="#edit-<?php echo $cards->card_id; ?>" class="badge rounded-pill badge-warning">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a data-bs-toggle="modal" href="#delete-<?php echo $cards->card_id; ?>" class="badge rounded-pill badge-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                            <!-- Update Modal -->
                                                            <div class="modal fade" id="edit-<?php echo $cards->card_id; ?>">
                                                                <div class="modal-dialog  modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update <?php echo $cards->card_number; ?> Details</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="row g-3" method="POST">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Card Number</label>
                                                                                    <input type="hidden" required name="card_id" value="<?php echo $cards->card_id; ?>" class="form-control-rounded form-control">
                                                                                    <input type="text" required name="card_number" value="<?php echo $cards->card_number; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Card Vendor</label>
                                                                                    <select class="js-states form-control" tabindex="-1" style="width: 100%" name="card_vendor">
                                                                                        <option><?php echo $cards->card_vendor; ?></option>
                                                                                        <option>Visa</option>
                                                                                        <option>Mastercard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Exp Month</label>
                                                                                    <input type="text" required name="card_month" value="<?php echo $cards->card_month; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Exp Year</label>
                                                                                    <input type="text" required name="card_year" value="<?php echo $cards->card_year; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Card CVV</label>
                                                                                    <input type="text" required name="card_cvv" value="<?php echo $cards->card_cvv; ?>" class="form-control-rounded form-control">
                                                                                </div>
                                                                                <div class="col-12 d-flex justify-content-end">
                                                                                    <button type="submit" name="update_card" class="btn btn-primary">Update Card</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Modal -->

                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-<?php echo $cards->card_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETION</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center text-danger">
                                                                            <h4>Delete Card ?</h4>
                                                                            <br>
                                                                            <p>Heads Up, You are about to delete details. This action is irrevisble.</p>
                                                                            <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                                                                            <a href="my_cards?delete=<?php echo $cards->card_id; ?>" class="text-center btn btn-danger"> Delete </a>
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