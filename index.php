<?php
    include_once("includes/config.php");

    $select_query = "SELECT * FROM `library_data` ORDER BY `id` DESC";
    $resultData = $my_db->select($select_query);
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
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custome.css">
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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Library</h4>
                                <p class="card-description">
                                    All Book Display
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="table_main_data">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Book Name</th>
                                                <th>Author Name</th>
                                                <th>Publication Name</th>
                                                <th>Total Page</th>
                                                <th>Price</th>
                                                <th>Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 0;
                                                $file_upload_url = "assets/upload/";
                                                if(isset($resultData) && !empty($resultData))
                                                {
                                                    foreach($resultData as $key => $value)
                                                    {
                                                        $no++;
                                                        $cover_image = "";
                                                        if(!empty($value['cover_image']))
                                                        {
                                                            $cover_image = $file_upload_url.$value['cover_image'];
                                                        }

                                                        $edit_url = "book_edit.php?id=".$value["id"];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><img src="<?php echo $cover_image; ?>"></td>
                                                        <td><?php echo $value['book_name']; ?></td>
                                                        <td><?php echo $value['author_name']; ?></td>
                                                        <td><?php echo $value['publication_name']; ?></td>
                                                        <td><?php echo $value['number_of_page']; ?></td>
                                                        <td><?php echo "$".$value['price']; ?></td>
                                                        <td><?php echo $value['book_year']; ?></td>
                                                        <td>
                                                            <a class="badge badge-success" href="<?php echo $edit_url; ?>">
                                                                <i class="mdi mdi-lead-pencil menu-icon"></i>
                                                            </a>

                                                            <a class="badge badge-danger" href="javascript:void(0);" onclick="deleteData('<?php echo $value['id']; ?>')">
                                                                <i class="mdi mdi-delete menu-icon"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php   }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
                        Copyright &copy; <?php echo date("Y"); ?> <a href="index.php" target="_blank">Library</a>. All rights reserved.
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
    new_deleteData = null;
    $(function ()
    {
        $('#table_main_data').DataTable({
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
            "ordering": false
        });

        function deleteData(id)
        {
            if (confirm("Delete This Book?"))
            {
                window.location.href = "deleteData.php?action=book-delete&id="+id;

            } else {
                window.location.reload();
            }
        }
        new_deleteData = deleteData;
    });

    function deleteData(id) {
        new_deleteData(id);
    }
</script>
</body>
</html>