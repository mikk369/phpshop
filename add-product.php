<?php
//db connection
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
                    <a class="btn btn-danger" href="/index.php" role="button">CANCEL</a>
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
                <label class="col-sm-1 col-form-label">sku</label>
                <div class="col-sm-6">
                    <!-- name parameter is submitted to db  -->
                    <input type="text" name="sku" id="sku" placeholder="SKU" value="<?php echo $sku; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label">Price ($)</label>
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>">
                </div>
            </div>
            <div class="typeswitcher">
                <div>
                    <h4>Type Switcher</h4>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="productType" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Type Switcher
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">DVD</a>
                        <a class="dropdown-item" href="#">Books</a>
                        <a class="dropdown-item" href="#">Furniture</a>
                    </div>
                </div>
            </div>
            <textarea v-model="text" placeholder="description depending on the chosen item category //temporarybox//"></textarea>
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
       .typeswitcher{
        display: flex;
        align-items: center;
        margin-bottom: 20px;
       }
       
       .dropdown{
        padding: 6px;
       }

        .nav-row{
            display: flex;
            justify-content: space-between;
        }
        .nav-buttons button {
            margin-right: 30px;
        }
        .dropdown{  
            width: 300px;
        }
        textarea{
            width: 400px;
            height: 200px;
        }
    
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

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