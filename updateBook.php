<?php
    include_once("includes/config.php");

    $today = date("Y-m-d H:i:s");
    $insertID = 0;

    $book_name =  $author_name = $publication_name = '';
    $number_of_page =  $price = $book_year = '';

    $ip_address = getIpAddress();
    if(isset($_POST) && !empty($_POST) && isset($_POST['id']) && !empty($_POST['id']))
    {
        $insertID = $_POST['id'];

        $book_name =  $_POST['book_name'];
        $author_name = $_POST['author_name'];
        $publication_name = $_POST['publication_name'];
        $number_of_page =  $_POST['number_of_page'];
        $price = $_POST['price'];
        $book_year = $_POST['book_year'];

        $update_query = "";
        $update_query .= " UPDATE `library_data` SET ";
        $update_query .= " `book_name` = '".$book_name."', ";
        $update_query .= " `author_name` = '".$author_name."', ";
        $update_query .= " `publication_name` = '".$publication_name."', ";
        $update_query .= " `number_of_page` = '".$number_of_page."', ";
        $update_query .= " `price` = '".$price."', ";
        $update_query .= " `book_year` = '".$book_year."', ";
        $update_query .= " `ip_address` = '".$ip_address."', ";

        $extension_ar = array('jpg', 'jpeg', 'JPG', 'JPEG');
        $file_upload_url = "assets/upload/";

        $cover_image = '';
        $response['error'] = true;
        if (isset($_FILES['cover_image']['name']))
        {
            $newFileName = '';
            $upload_file_name = basename($_FILES['cover_image']['name']);
            $temp = explode(".", $upload_file_name);
            $upload_file_name = $temp[0].round(microtime(true));
            $uimg = $upload_file_name;
            $extension = end($temp);

            if(in_array($extension,$extension_ar))
            {
                $newFileName =  $upload_file_name. '.' . $extension;

                $target_path = $file_upload_url . basename($newFileName);

                $response['file_name'] = basename($newFileName);

                try {
                    // Throws exception incase file is not being moved
                    if (!move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_path))
                    {
                        // make error flag true
                        $response['error'] = true;

                        $global_message = "";
                        $global_message .= "<div class=\"alert alert-danger\">";
                        $global_message .= "<strong>Error!</strong> Could not move the file!";
                        $global_message .= "</div>";

                    }else{
                        // File successfully uploaded
                        $response['error'] = false;
                        $response['file_path'] = $file_upload_url . basename($newFileName);


                        $filename_small = $file_upload_url.basename($newFileName);

                        $src = imagecreatefromjpeg($response['file_path']);

                        list($width,$height) = getimagesize($response['file_path']);

                        $small_width = 500;
                        $small_height=($height/$width)*$small_width;

                        $small_tmp = imagecreatetruecolor($small_width,$small_height);

                        //small Images
                        imagecopyresampled($small_tmp,$src,0,0,0,0,$small_width,$small_height, $width,$height);

                        $small_status =  imagejpeg($small_tmp,$filename_small,100);

                        imagedestroy($small_tmp);

                        $cover_image = $newFileName;

                        $update_query .= " `cover_image` = '".$cover_image."', ";

                        /*Old File Remove*/
                        $old_cover_image = $_POST['old_cover_image'];
                        $remove_oldFile = $file_upload_url . $old_cover_image;
                        unlink($remove_oldFile);
                    }

                } catch (Exception $e) {
                    // Exception occurred. Make error flag true
                    $response['error'] = true;

                    $global_message = "";
                    $global_message .= "<div class=\"alert alert-danger\">";
                    $global_message .= "<strong>Error!</strong> Catch Will be Generate!";
                    $global_message .= "</div>";
                }
            }else{
                $response['error'] = true;

                $global_message = "";
                $global_message .= "<div class=\"alert alert-danger\">";
                $global_message .= "<strong>Error!</strong> Upload only ".implode(", ",$extension_ar);
                $global_message .= "</div>";
            }
        } else {
            // File parameter is missing
            $response['error'] = true;

            $global_message = "";
            $global_message .= "<div class=\"alert alert-danger\">";
            $global_message .= "<strong>Error!</strong> Not received any file!";
            $global_message .= "</div>";
        }

        if(true)
        {
            $update_query .= " `updated_at` = '".$today."' ";
            $update_query .= "  WHERE `id` = '".$insertID."' ";
            $my_db->edit($update_query);

            $global_message = "";
            $global_message .= "<div class=\"alert alert-success\">";
            $global_message .= "<strong>Success!</strong> Book Updated in library #".$insertID;
            $global_message .= "</div>";
        }
    }
?>


