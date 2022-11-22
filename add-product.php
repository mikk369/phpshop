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

    // check if data is transmitted using post method 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sku = $_POST["sku"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $size = $_POST["size"];
        $weight = $_POST["weight"];
        $dimensions = $_POST["dimensions"];

            //add new item to db
            $sql = "INSERT INTO items (sku, name, price, size, weight, dimensions)" . "VALUES ('$sku', '$name', '$price', '$size', '$weight', '$dimensions')";
            //execute sql query
            $result = $connect->query($sql);

            //redirect after 
            header("location: /index.php");
            exit;
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
                <select name="typeSwitcher" id="typeSwitcher" v-model="itemType">
                    <option value="DVD" id="DVD" >DVD</option>
                    <option value="dimensions" id="Furniture">Furniture</option>
                    <option value="weight" id="Book">Books</option>
                    
                </select>
            </div>
            <form method="POST">
                    <div class="switcher-form">
                        <!-- //slice used to remove unnecessary iterations from the v-for -->
                        <div v-if="itemType === 'DVD'" class="row mb-1" v-html="item.size" v-for="item in switcherForm.slice(0,1)":key="item" >
                        </div>
                        <div v-if="itemType === 'dimensions'" class="row mb-1"v-html="item.dimensions" v-for="item in switcherForm.slice(1,2)":key="item">                            
                        </div>
                        <div v-if="itemType === 'weight'" class="row mb-1" v-html="item.weight" v-for="item in switcherForm.slice(2,3)":key="item" >
                        </div>
                        
                    </div>
            </form>
        </form>
        <hr>
    </div>
    <style>
        .typeHeading{
            margin-right: 9px;
        }
       .typeswitcher{
        display: flex;
        align-items: center;
        margin-bottom: 20px;
       }
       
       .dropdown{
        padding: 6px;
       }
      
       .switcher-form{
        width: 40%;
        padding: 9px;
        position: relative;
        flex-flow: row wrap;
       }
       
       
       @media (max-width: 993px) {
        .switcher-form  input {
            width: 100%;
            margin-top: 0;
            }
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
            itemType:null,
            switcherForm: [
                            {size:`
                            <label class="col-sm-4 col-form-label">Size (MB)</label>
                            <div class="col-sm-6">
                                <input id="size" type="text" name="size" placeholder="size" value="<?php echo $size; ?>"></input>
                                <h6>Please provide DVD size in MB.</h6>
                            </div>
                            `},
                            {dimensions:`
                            <label class="col-sm-4 col-form-label">Dimensions</label>
                            <div class="col-sm-6">
                                <input type="text" name="dimensions" placeholder="dimensions" value="<?php echo $dimensions; ?>"></input>
                                <h6>Please provide dimensions in HxWxL. format</h6>
                            </div>
                            `},
                            {weight:`
                             <label class="col-sm-4 col-form-label">Weight (KG)</label>
                            <div class="col-sm-6">
                                <input type="text" name="weight" placeholder="weight" value="<?php echo $weight; ?>"></input>
                                <h6>Please provide Book weight in KG.</h6>
                            </div>
                            `},
    
                        ] 
            }
        },
    }).mount('#add-product')
    </script>

</body>

</html>
