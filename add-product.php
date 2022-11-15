<?php
//db connection
include_once "./dbConn.php";
$connect = mysqli_connect("$serverName", "$userName", "$password", "$database");

    $sku = "";
    $name = "";
    $price = "";
    $size = "";
    $weight = "";
    $dimensions ="";

    $errorMessage = "";
    $successMessage = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sku = $_POST["sku"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $size = $_POST["size"];
        $weight = $_POST["weight"];
        $dimensions = $_POST["dimensions"];

        do{
            if(empty($sku) || empty($name) || empty($price)) {
                $errorMessage ="Please fill fields";
                break;
            }
            //add new item to db
            $sql = "INSERT INTO items (sku, name, price, size, weight, dimensions)" . "VALUES ('$sku', '$name', '$price', '$size', '$weight', '$dimensions')";
            //execute sql query
            $result = $connect->query($sql);
            //if error
                if(!$result) {
                $errorMessage = "invalid query" . $connection->error;
                break;
            }


            $sku = "";
            $name = "";
            $price = "";
            $size = "";
            $weight = "";
            $dimensions ="";

            $successMessage = "items added";
            //redirect after 
            header("location: /index.php");
            exit;

        } while (false);
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
    <div class="container my-5">
        <h2>Add product</h2>
    <?php 
        if(!empty($errorMessage)) {
            echo "<strong>$errorMessage</strong>";}
    ?>
        <form method="POST" id="product-form">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">sku</label>
                <div class="col-sm-6">
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">size</label>
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" placeholder="size" value="<?php echo $size; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">weight</label>
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" placeholder="weight" value="<?php echo $weight; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">dimensions</label>
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" placeholder="dimensions" value="<?php echo $dimensions; ?>">
                </div>
            </div>
            <?php 
        if(!empty($successMessage)) {
            echo "<strong>$successMessage</strong>";}
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit"  class="btn btn-primary">Save</button>
                </div>
                
                <div class="col-sm-3 d-grid">
                    <button class="btn btn-outline-primary" href="/index.php" role="button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>