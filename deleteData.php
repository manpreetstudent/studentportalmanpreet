<?php
    include_once("includes/config.php");

    if(isset($_GET['action']) && ($_GET['action'] == "book-delete") && isset($_GET['id']))
    {
        $resultData = array();
        $select_query = "SELECT * FROM `library_data` WHERE `id` = ".$_GET['id']." LIMIT 1 ";
        $resultData = $my_db->select($select_query);

        if(!empty($resultData))
        {
            $resultData = $resultData[0];

            $file_upload_url = "assets/upload/";
            $old_cover_image = $resultData['cover_image'];
            $remove_oldFile = $file_upload_url . $old_cover_image;
            unlink($remove_oldFile);

            $resultData = array();
            $select_query = "DELETE FROM `library_data` WHERE `id` = ".$_GET['id'];
            $resultData = $my_db->select($select_query);

            echo '<script type="text/javascript">window.location="index.php"</script>';
            exit;

        }else{
            echo '<script type="text/javascript">window.location="index.php"</script>';
            exit;
        }
    }else{
        echo '<script type="text/javascript">window.location="index.php"</script>';
        exit;
    }
?>