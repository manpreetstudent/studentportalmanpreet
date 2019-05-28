<?php
    include_once("includes/config.php");
    include_once("insertBook.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Library Management</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/parsley.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->

</head>

<body>
<div class="container-scroller">

    <?php
        include_once("header.php");
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <?php
            include_once("left_side.php");
        ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Book</h4>
                                <p class="card-description">
                                    Add Book in Library
                                </p>

                                <?php
                                    if(!empty($global_message)){
                                        echo $global_message;
                                    }
                                ?>

                                <form class="forms-sample" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
                                      name="form_add_book" id="form_add_book" enctype="multipart/form-data" data-parsley-validate novalidate>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Book Name</label>
                                        <input type="text" class="form-control" id="book_name" name="book_name" placeholder="Book Name"
                                               parsley-trigger="change" data-parsley-required="true" >
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Author Name</label>
                                        <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Author Name"
                                               parsley-trigger="change" data-parsley-required="true" >
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Publication Name</label>
                                        <input type="text" class="form-control" id="publication_name" name="publication_name" placeholder="Publication Name"
                                               parsley-trigger="change" data-parsley-required="true" >
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Number of Page</label>
                                        <input type="number" class="form-control" id="publication_name" name="number_of_page" value="1"
                                               placeholder="Number of Page" min="1" max="9999999" maxlength="8" parsley-trigger="change" data-parsley-required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">$</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Amount(dollar)" name="price" id="price"
                                                   parsley-trigger="change" data-parsley-required="true">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleSelectGender">Book Year</label>
                                        <select class="form-control" id="book_year" name="book_year">
                                            <?php
                                                $html = '';
                                                $current_year = date("Y");
                                                $current_year = (int)$current_year;
                                                for($i=1900; $i<=$current_year; $i++)
                                                {
                                                    $selected = "";
                                                    if($current_year == $i)
                                                    {
                                                        $selected = "selected";
                                                    }
                                                    $html .= "<option value=\"$i\" $selected>".$i."</option>";
                                                }
                                                echo $html;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>File upload</label>
                                        <input type="file" name="cover_image" id="cover_image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                        <small>Upload Only jpg/jpeg file</small>
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                                    <button type="button" class="btn btn-danger" id="btn_cancel">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->

            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                        Copyright &copy;  <?php echo date("Y"); ?> <a href="index.php" target="_blank">Library</a>. All rights reserved.
                    </span>
                    <!--<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><i class="mdi mdi-heart text-danger"></i></span>-->
                </div>
            </footer>
            <!-- partial -->

        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<?php
    include_once("footer.php");
?>
<script type="text/javascript">
    $(function ()
    {
        $('#form_add_book').parsley();

        $('#btn_cancel').click(function()
        {
           window.location.href = "book_add.php";
        });

        <?php
            if($insertID != 0)
            { ?>
        setTimeout(function()
        {
            window.location.href = "book_add.php";
        },3500);
        <?php } ?>
    })
</script>
</body>
</html>
