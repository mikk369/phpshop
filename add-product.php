<?php
//db connection

use LDAP\Result;

include_once "./dbConn.php";
$connect = mysqli_connect("$serverName", "$userName", "$password", "$database");

//variables to fill the form
    $sku = "";
    $name = "";
    $price = "";
    $size = "";
    $weight = "";
    $dimensions ="";

    $errorMessage ="";
    // check if data is transmitted using post method 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sku = $_POST["sku"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $size = $_POST["size"];
        $weight = $_POST["weight"];
        $dimensions = $_POST["dimensions"];

        //check if any fields are empty if so display error msg
        do{
            if(empty($sku)|| empty($name)||empty($price)) {
                $errorMessage = "Please fill all fields";
                break;
            }
            
            //add new item to db
            $sql = "INSERT INTO items (sku, name, price, size, weight, dimensions)" . "VALUES ('$sku', '$name', '$price', '$size', '$weight', '$dimensions')";
            //execute sql query
            $result = $connect->query($sql);

            // gives undefined const 
            // if(!result) {
            //     $errorMessage = "Invalid query: " . "$connect->error";
            //     break;
            // }
            
            //redirect after 
            header("location: /index.php");
            exit;
            
        }while(false);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css
">
    <title>webShop</title>
</head>
<body>
    <div class="container my-5" id="add-product">
        <form method="POST" id="product-form">
        <div class="nav-row mb-3">
            <h2>{{ title }}</h2>
                <div class="nav-buttons">
                    <button type="submit"  class="btn btn-primary">Save</button>
                    <a class="btn btn-outline-danger" href="/index.php" role="button">CANCEL</a>
                </div>
        </div>
        <hr>
        <!-- display error message  -->
        <?php 
        if(!empty($errorMessage)){
            echo"<strong>$errorMessage</strong>";
        }
        ?>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">sku</label>
                <div class="col-sm-6">
                    <!-- name parameter is submitted to db  -->
                    <input type="text" name="sku" id="sku" placeholder="SKU" value="<?php echo $sku; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price ($)</label>
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>">
                </div>
            </div>
            <textarea v-model="text"></textarea>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">size</label>
                <div class="col-sm-6">
                    <input type="text" name="size" id="size" placeholder="size" value="<?php echo $size; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">weight</label>
                <div class="col-sm-6">
                    <input type="text" name="weight" id="weight" placeholder="weight" value="<?php echo $weight; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">dimensions</label>
                <div class="col-sm-6">
                    <input type="text" name="dimensions" id="dimensions" placeholder="dimensions" value="<?php echo $dimensions; ?>">
                </div>
            </div>
        </form>
        <hr>
    </div>


    <style>
        .nav-row{
            display: flex;
            justify-content: space-between;
        }
    
    </style>
    <script type="module">
    import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

    createApp({
        data() {
        return {
            title: 'Add product',
            }
        },
    }).mount('#add-product')
    </script>


</body>
</html>