<?php
/*
 * Created on Sat Oct 30 2021
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

/* Add Blog Post */
if (isset($_POST['publish'])) {
    $blog_id = $sys_gen_id;
    $blog_blog_category_id = $_GET['view'];
    $blog_details = $_POST['blog_details'];
    $blog_published_by = $_SESSION['user_id'];

    /* Persist */
    $sql = "INSERT INTO  blogs(blog_id, blog_blog_category_id, blog_details, blog_published_by) VALUES(?,?,?,?)";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ssss',
        $blog_id,
        $blog_blog_category_id,
        $blog_details,
        $blog_published_by
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Blog Post Published";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Update Blog Post */
if (isset($_POST['update'])) {
    $blog_id = $_POST['blog_id'];
    $blog_details = $_POST['blog_details'];

    /* Persist */
    $sql = "UPDATE blogs SET blog_details = ? WHERE blog_id =?";
    $prepare = $mysqli->prepare($sql);
    $bind = $prepare->bind_param(
        'ss',
        $blog_details,
        $blog_id
    );
    $prepare->execute();
    if ($prepare) {
        $success  = "Blog Post Updated";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Delete Blog Post */
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $view = $_GET['view']; /* Blog Category ID */
    /* Persist */
    $sql = "DELETE FROM blogs WHERE blog_id = ?";
    $prepare  = $mysqli->prepare($sql);
    $bind = $prepare->bind_param('s', $delete);
    $prepare->execute();
    if ($prepare) {
        $success = "Deleted" && header('refresh:1; blogging_engine_blog_posts?view=' . $view);
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}

/* Update Blog Images And Vide Urls */
/* Update Product Images */
if (isset($_POST['update_media'])) {
    $blog_id = $_POST['blog_id'];
    $blog_video_url_1 = $_POST['blog_video_url_1'];

    /* Process Posted Images */
    $img_1 = explode(".", $_FILES['blog_image_1']["name"]);
    /* Give New File Names */
    $new_img_1 = $sys_img_code_alpha . '.' . end($img_1);
    /* Move Uploaded Images */
    move_uploaded_file($_FILES["blog_image_1"]["tmp_name"], "../public/backend_assets/images/blogs/" . $new_img_1);

    /* Persist Changes */
    $update = "UPDATE blogs SET blog_image_1 =?, blog_video_url_1 =? WHERE blog_id = ?";
    $prepare = $mysqli->prepare($update);
    $bind = $prepare->bind_param(
        'sss',
        $new_img_1,
        $blog_video_url_1,
        $blog_id
    );
    $prepare->execute();
    if ($prepare) {
        $success = "Blog Post Media Uploaded";
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
            <?php require_once('../partials/header.php');
            $view = $_GET['view'];
            $ret = "SELECT * FROM  blog_categories WHERE blog_category_id = '$view'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($category = $res->fetch_object()) {
            ?>
                <div class="app-content">
                    <div class="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="page-description">
                                        <h1>Published Blog Posts Under : <?php echo $category->blog_category_name; ?></h1>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                                                <i class="fas fa-plus"></i> Publish Post
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
                                            <h4 class="modal-title">Publish Blog Post</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST">
                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label">Blog Details</label>
                                                    <textarea type="text" rows="10" required name="blog_details" class="form-control-rounded form-control summernote"></textarea>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" name="publish" class="btn btn-primary">Publish Blog</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Moodal -->
                            <div class="row">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="datatable1" class="display table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Post Details</th>
                                                        <th>Date Posted</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $ret = "SELECT * FROM  blogs b 
                                                    INNER JOIN  users u ON u.user_id = b.blog_published_by
                                                    WHERE blog_blog_category_id = '$view'";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($blogs = $res->fetch_object()) {

                                                    ?>
                                                        <tr>
                                                            <td><?php echo substr($blogs->blog_details, 0, 150); ?> ...</td>
                                                            <td><?php echo  date('d M Y g:ia', strtotime($blogs->blog_date_published)); ?></td>

                                                            <td>
                                                                <a data-bs-toggle="modal" href="#read-<?php echo $blogs->blog_id; ?>" class="badge rounded-pill badge-success">
                                                                    <i class="fas fa-eye"></i> Full Read
                                                                </a>
                                                                <a data-bs-toggle="modal" href="#edit-<?php echo $blogs->blog_id; ?>" class="badge rounded-pill badge-warning">
                                                                    <i class="fas fa-edit"></i> Edit Content
                                                                </a>
                                                                <a data-bs-toggle="modal" href="#media-<?php echo $blogs->blog_id; ?>" class="badge rounded-pill badge-primary">
                                                                    <i class="fas fa-image"></i> Edit Post Media
                                                                </a>

                                                                <a data-bs-toggle="modal" href="#delete-<?php echo $blogs->blog_id; ?>" class="badge rounded-pill badge-danger">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </a>
                                                                <!-- Update Modal -->
                                                                <div class="modal fade" id="edit-<?php echo $blogs->blog_id; ?>">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Update Blog</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form class="row g-3" method="POST">
                                                                                    <div class="col-md-12">
                                                                                        <label for="inputEmail4" class="form-label">Blog Details</label>
                                                                                        <textarea type="text" rows="10" required name="blog_details" class="form-control-rounded form-control summernote"><?php echo $blogs->blog_details; ?></textarea>
                                                                                        <!-- Hide This -->
                                                                                        <input type="hidden" value="<?php echo $blogs->blog_id; ?>" required name="blog_id" class="form-control-rounded form-control">
                                                                                    </div>
                                                                                    <div class="col-12 d-flex justify-content-end">
                                                                                        <button type="submit" name="update" class="btn btn-primary">Update Blog</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Modal -->

                                                                <!-- Delete Modal -->
                                                                <div class="modal fade" id="delete-<?php echo $blogs->blog_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETION</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-center text-danger">
                                                                                <h4>Delete Blog Post Details ?</h4>
                                                                                <br>
                                                                                <p>Heads Up, You are about to delete this published blog post details. This action is irrevisble.</p>
                                                                                <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No</button>
                                                                                <a href="blogging_engine_blog_posts?delete=<?php echo $blogs->blog_id; ?>&view=<?php echo $view; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Modal -->

                                                                <!-- Blog Edit Images -->
                                                                <div class="modal fade" id="media-<?php echo $blogs->blog_id; ?>">
                                                                    <div class="modal-dialog  modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Update Blog Post Media</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form class="row g-3" method="POST" enctype="multipart/form-data">
                                                                                    <input type="hidden" required name="blog_id" value="<?php echo $blogs->blog_id; ?>" class="form-control-rounded form-control">
                                                                                    <div class="col-md-12">
                                                                                        <label for="inputAddress" class="form-label">Blog Post Image</label>
                                                                                        <input required accept=".webp, .png, .jpg, .jpeg" type="file" name="blog_image_1" class="form-control form-control-rounded">
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <label for="inputAddress" class="form-label">Blog Post Video Clip Url</label>
                                                                                        <input type="text" name="blog_video_url_1" value="<?php echo $blogs->blog_video_url_1; ?>" class="form-control form-control-rounded">
                                                                                    </div>
                                                                                    <div class="col-12 d-flex justify-content-end">
                                                                                        <button type="submit" name="update_media" class="btn btn-primary">Upload Media</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Blog Edit Images End Modal -->

                                                                <!-- Full Read Blog Post -->
                                                                <div class="modal fade" id="read-<?php echo $blogs->blog_id; ?>">
                                                                    <div class="modal-dialog  modal-xl">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Blog Post Details</h4>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php
                                                                                if ($blogs->blog_image_1 == '') {
                                                                                } else {
                                                                                ?>
                                                                                    <img class="img-fluid" src="../public/backend_assets/images/blogs/<?php echo $blogs->blog_image_1; ?>">
                                                                                    <hr>
                                                                                <?php }
                                                                                echo $blogs->blog_details; ?>
                                                                                <br>
                                                                                <?php
                                                                                if ($blogs->blog_video_url_1 == '') {
                                                                                } else {
                                                                                ?>
                                                                                    <div class="d-flex justify-content-center text-primary">
                                                                                        <a class="btn btn-success" target="_blank" href="<?php echo $blogs->blog_video_url_1; ?>">
                                                                                            <i class="fas fa-video"></i> Watch Video Clip
                                                                                        </a>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                <hr>
                                                                                <div class="d-flex justify-content-end text-primary">
                                                                                    <p>Published On : <?php echo date('M, d Y g:ia', strtotime($blogs->blog_date_published)); ?><br>
                                                                                        Published By : <?php echo $blogs->user_name; ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- End Modal -->
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
            <?php } ?>
        </div>
    </div>
    <!-- Javascripts -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>