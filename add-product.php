<?php
//db connection
include_once "./dbConn.php";
class addProduct extends dbConn {

    
    
}

//variables to fill the form
    $sku = "";
    $name = "";
    $price = "0";
    $size = "0";
    $weight = "0";
    $height = "0";
    $width = "0";
    $length = "0";

    $errorMessage ="";

    // check if data is transmitted using post method 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sku = $_POST["sku"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $size = empty($_POST["size"]) ? "0" : $_POST["size"];
        $weight = empty($_POST["weight"]) ? "0" : $_POST["weight"];
        $height = empty($_POST["height"]) ? "0" : $_POST["height"];
        $width = empty($_POST["width"]) ? "0" : $_POST["width"];
        $length = empty($_POST["length"]) ? "0" : $_POST["length"];

        do{
            if(empty($sku)|| empty($name)||empty($price)) {
                $errorMessage = "Please fill all fields";
                break;
            }

            //add new item to db
            $sql = "INSERT INTO items (sku, name, price, size, weight, height, width, length)" . "VALUES ('$sku', '$name', '$price', '$size', '$weight', '$height', '$width', '$length')";
            //execute sql query
            $result = $connect->query($sql);

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
    <link rel="stylesheet" href="./addProduct.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css
">
    <title>webShop</title>
</head>
<body>
    <div class="container my-5" id="add-product">
        <form method="POST" id="product_form">
        <div class="nav-row mb-3">
            <h2>{{ title }}</h2>
                <div class="nav-buttons">
                    <button type="submit"  class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="/index.php" role="button">CANCEL</a>
                </div>
        </div>
        <hr>
        <?php
            if(!empty($errorMessage)){
                echo"<div class='errorMessage'>$errorMessage</div>";

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
                    <h4 class="typeHeading">Type Switcher</h4>
                </div>
                <select name="typeSwitcher" id="productType" v-model="itemType">
                    <option value="DVD" id="DVD" >DVD</option>
                    <option value="dimensions" id="Furniture">Furniture</option>
                    <option value="Book" id="Book">Books</option>
                    
                </select>
            </div>
            <form method="POST">
                    <div class="switcher-form">
                        <!-- //slice used to remove unnecessary iterations from the v-for -->
                        <div v-if="itemType === 'DVD'" class="row mb-1" v-html="item.size" v-for="item in switcherForm.slice(0,1)":key="item" >
                        </div>
                        <div v-if="itemType === 'dimensions'" class="row mb-1" v-html="item.dimensions" v-for="item in switcherForm.slice(1,2)":key="item">                            
                        </div>
                        <div v-if="itemType === 'Book'" class="row mb-1" v-html="item.weight" v-for="item in switcherForm.slice(2,3)":key="item" >
                        </div>
                        
                    </div>
            </form>
        </form>
        <hr>
        <div class="footer-wrap">
            <footer>Scandiweb Test assignment</footer>
        </div>
    </div>
    <style>
    
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script type="module">
    import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

    createApp({
        data() {
        return {
            title: 'Add product',
            itemType:null,
            switcherForm: [
                            {size:`
                            <label class="col-sm-6 col-form-label">Size (MB)</label>
                            <div class="col-sm-6">
                                <input id="size" type="text" name="size" placeholder="size" value="<?php echo $size; ?>"></input>
                            </div>
                                <h6>Please provide DVD size in MB.</h6>
                            `},
                            {dimensions:`
                            <label class="col-sm-6 col-form-label">Height (CM)</label>
                            <div class="col-sm-6">
                                <input type="text" name="height" placeholder="height" id="height" value="<?php echo $height; ?>"></input>
                            </div>
                            <label class="col-sm-6 col-form-label">Width(CM)</label>
                            <div class="col-sm-6">
                                <input type="text" name="width" placeholder="width" id="width" value="<?php echo $width; ?>"></input>
                            </div>
                            <label class="col-sm-6 col-form-label">Length(CM)</label>
                            <div class="col-sm-6">
                                <input type="text" name="length" placeholder="length" id="length" value="<?php echo $length; ?>"></input>
                            </div>
                                <h6>Please provide dimensions in HxWxL. format</h6>
                            `},
                            {weight:`
                             <label class="col-sm-6 col-form-label">Weight (KG)</label>
                            <div class="col-sm-6">
                                <input type="text" name="weight" placeholder="weight" id="weight" value="<?php echo $weight; ?>"></input>
                                </div>
                                <h6>Please provide Book weight in KG.</h6>
                            `},,
    
                        ] 
            }
        },
    }).mount('#add-product')
    </script>

</body>

</html>
