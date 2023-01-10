<?php
include 'connect.php';
session_start();
if (isset($_SESSION['email'])) {

    if (isset($_POST['btnsave'])) {
        // create error array
        $error = array();
        $success = array();
        $showMess = false;

        $tensp = $_POST['tensp'];
        $gia = $_POST['gia'];
        $dm = $_POST['danhmuc'];

        // validate file image
        $target_dir = './img/';
        $image = $_FILES['image']['name'];
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($image) {
            // check file type
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $error['image'] = 'Ảnh không đúng định dạng: <b>jpg</b>, <b>jpeg</b>, <b>png</b>, <b>gif</b>';
            } else {
                // check exists
                if (file_exists($target_file)) {
                    $nameImage = time() . "." . $imageFileType;
                } else {
                    $nameImage = time() . "." . $imageFileType;
                }
            }
        }

        // save to db
        if (!$error) {
            $showMess = true;

            if ($image) {

                // insert record
                $insert = "INSERT INTO `product` (`id_product_category`,`id_account`,`name`,`image`,`price`) VALUES ('$dm','1','$tensp','$nameImage','$gia') ";
                mysqli_query($conn, $insert);
                // add image to folder
                $dirFile = $target_dir . $nameImage;
                move_uploaded_file($_FILES["image"]["tmp_name"], $dirFile);
                $success['success'] = 'Save thành công.';
                echo '<script>setTimeout("window.location=\'index.php\'",1000);</script>';
            } else {
                // $nameImage = 'admin.png';
                // // insert record
                // $insert = "INSERT INTO `product` (`id_product_category`,`id_account`,`name`,`image`,`price`) VALUES ('$dm','1','$tensp','$nameImage','$gia') ";
                // mysqli_query($conn, $insert);
                // $success['success'] = 'Save thành công.';
                // echo '<script>setTimeout("window.location=\'index.php\'",1000);</script>';
            }
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <style>
        body {
            margin-left: 300px;
        }

        h3 {
            margin-top: 20px;
            font-size: 30px;
            margin-left: 20px;
        }

        label {
            margin-left: 20px;
        }

        .conn {
            width: 800px;
            height: 100%;
            margin-top: 30px;
            display: block;
            overflow: auto;
        }

        button.btn {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        button.btn:hover {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .content {

            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        td {
            font-weight: bold;
        }
    </style>

    <body>

        <div class="conn form-control">
            <h3>PRODUCT</h3> <br>
            <?php
            // show error
            if (isset($error)) {
                if ($showMess == false) {
                    echo "<div class='alert alert-danger alert-dismissible'>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    echo "<h4><i class='icon fa fa-ban'></i> Lỗi!</h4>";
                    foreach ($error as $err) {
                        echo $err . "<br/>";
                    }
                    echo "</div>";
                }
            }
            ?>

            <?php
            // show success
            if (isset($success)) {
                if ($showMess == true) {
                    echo "<div class='alert alert-success alert-dismissible'>";
                    echo "<h4><i class='icon fa fa-check'></i> Thành công!</h4>";
                    foreach ($success as $suc) {
                        echo $suc . "<br/>";
                    }
                    echo "</div>";
                }
            }
            ?>
            <form action="" enctype="multipart/form-data" method="POST" id="form-2">
                <div class="form-inline">
                    <label for="">Name</label> &nbsp;
                    <input type="text" name="tensp" id="tensanpham" class="form-control" placeholder="Your name" style="margin-left: 35px; width: 340px;">
                    <span class="form-message"></span>
                </div>
                <br>
                <div class="form-inline">
                    <label for="">Price</label> &nbsp;
                    <input type="text" name="gia" class="form-control" id="giasanpham" placeholder="Your last name" style="margin-left: 43px; width: 340px;">
                    <span class="form-message"></span>
                </div>
                <br>
                <div class="form-inline">
                    <label for="">Image</label> &nbsp;
                    <input type="file" name="image" id="img" style="margin-left: 35px;">
                    <span class="form-message"></span>
                </div>
                <br>
                <div class="form-inline">
                    <label for="">Category</label> &nbsp;
                    <select name="danhmuc" class="form-control" style="margin-left: 18px; width: 335px;">
                        <?php
                        if ($conn) {
                            $dm = "SELECT * FROM product_category";
                            $r = mysqli_query($conn, $dm);
                            if (mysqli_num_rows($r) > 0) {
                                while ($r1 = mysqli_fetch_assoc($r)) {
                        ?>
                                    <option value="<?php echo $r1['id_product_category'] ?>"><?php echo $r1['name'] ?></option>
                        <?php
                                }
                            }
                        }
                        ?>

                    </select>
                </div> <br>
                <button type="submit" id="button" name="btnsave" class="btn btn-primary" style="margin-left: 18px;">
                    Save
                </button>
                <?php
                if (isset($_SESSION['tb'])) {
                    echo '</br> </br> <p style="color: red;"> Thêm thành công! </p>';
                    unset($_SESSION['tb']);
                }
                ?>
            </form>

            <br>

            <div class="content">
                <table class="table table-striped">
                    <tr>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td>IMAGE</td>
                        <td>PRODUCT</td>
                        <td>PRODUCT CATEGORY</td>
                        <td>PRICE</td>
                    </tr>
                    <?php
                    if ($conn) {
                        $sql = "SELECT id_product, product.name as tensp, product_category.name as tendm, image, price FROM product, product_category 
                                    WHERE product.id_product_category = product_category.id_product_category";
                        $res = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                                <tr>
                                    <td> <?php echo $row['id_product'] ?></td>
                                    <td> <img src="./img/<?= $row['image'] ?>" width="50px" height="50px"> </td>
                                    <td> <?php echo $row['tensp'] ?></td>
                                    <td> <?php echo $row['tendm'] ?></td>
                                    <td> <?php echo number_format($row['price']) . '$' ?></td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "Không có dữ liệu";
                        }
                    } else {
                        echo "Kết nối thất bại";
                    }
                    ?>
                </table>
            </div>
        </div>


    <?php
} else {
    header('location:login.php');
}
    ?>
    <script src="./main2.js"></script>
    <script>
        // Mong muốn của chúng ta
        Validator({
            form: '#form-2',
            formGroupSelector: '.form-inline',
            errorSelector: '.form-message',
            rules: [
                Validator.minLength('#tensanpham', 2),
                Validator.isRequired('#giasanpham'),
                Validator.CheckPrice('#giasanpham',1000),
                Validator.isRequired('#img'),
            ],
            // onSubmit: function (data) {
            //   // Call API
            //   console.log(data);
            // }
        });
    </script>
    </body>

    </html>