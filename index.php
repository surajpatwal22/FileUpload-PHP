<?php
// error_reporting(0);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>file upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_dbconnection.php' ?>


    <div class="container ">
        <div class="row">
            <div class="col-lg-4">
                <div class="card p-4">
                    <form action="#" method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload" require>
                        <input type="submit" value="Upload Image" name="submit">
                    </form>

                </div>
            </div>

        </div>

    </div>

    <?php
    // $$target_dir = "images/"; // folder name 
//    print_r( $_FILES["fileToUpload"]);  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["submit"])) {
            $target_name = $_FILES["fileToUpload"]["name"];
            $target_temp_location = $_FILES["fileToUpload"]["tmp_name"];

            $target_dir = "images/" . $target_name;
            // echo $target_dir;
    
            move_uploaded_file($target_temp_location, $target_dir);

            $sql = "INSERT INTO `userdata` ( `img_source`, `name`, `designation`) VALUES ('$target_dir', 'raghu', 'web dev');";
            $result = mysqli_query($conn, $sql);
            echo $result;

            //  while ($row = mysqli_fetch_assoc($result))
    //         echo '<div class="container pt-4">
    //     <div class="row">
    //         <div class="col-lg-4">
    //         <div class="card shadow-sm">
    //             <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="' . $target_dir . '" alt="" srcset="">
    //             <div class="card-body">
    //                 <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
    //                     content. This content is a little bit longer.</p>
    //                 <div class="d-flex justify-content-between align-items-center">
    //                     <div class="btn-group">
    //                         <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
    //                         <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
    //                     </div>
    //                     <small class="text-body-secondary">9 mins</small>
    //                 </div>
    //             </div>
    //         </div>
    //         </div>
    //     </div>
    // </div> ';
        }

    }


    ?>


    <div class="continer">
        <div class="row">
            <?php
            $sql = "SELECT * FROM `userdata` ORDER BY `sno` DESC";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {

                    echo '
            <div class="col-lg-4 my-2">
            <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="' . $row['img_source'] . '" alt="" srcset="">
                <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                        content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        <small class="text-body-secondary">9 mins</small>
                    </div>
                </div>
            </div>
            </div>
    ';
                }
            }

            ?>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>