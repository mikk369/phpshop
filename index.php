<?php
include_once "./dbConn.php";
$connect = mysqli_connect("$serverName", "$userName", "$password", "$database");

if(!$connect) {
    echo "Connection Error:" . mysqli_connect_errno();
}
//query for the items i want
$sql = "SELECT * FROM items";
//make query & get result
$result = mysqli_query($connect, $sql);
//fetch th resulting rows as an array
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// print_r($items);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css
">
    <title>Webshop</title>
</head>
<body>
<div class="container my-5">
    <a class="btn btn-primary" href="/add-product.php" role="button">ADD</a>
    <a class="btn btn-primary" href="/add-product.php" role="button">MASS DELETE</a>
    <h2>Product list</h2>
    <div class="row">
        <!-- loop over item array  -->
    <?php foreach($items as $item){  ?>

    <div class="card">
        <label class="check-container">
            <input type="checkbox" class="delete-checkbox">
        </label>
        <!-- render items on main page  -->
        <div class="item-info">
            <h4><b><?php echo htmlspecialchars($item["sku"]); ?></b></h4>
            <p><?php echo "name: " . htmlspecialchars($item["name"]); ?></p>
            <p><?php echo "price: " . htmlspecialchars($item["price"]); ?></p>
            <p><?php echo "size: " . htmlspecialchars($item["size"]); ?></p>
            <p><?php echo "weight: " . htmlspecialchars($item["weight"]); ?></p>
            <p><?php echo "dimensions: " . htmlspecialchars($item["dimensions"]); ?></p>
        </div>
    </div>

        <?php } ?> 

    </div>
</div>

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    p{
        margin-bottom: 0;
    }
    .check-container{
        position: relative;
    }
    .checkmark{
        position: absolute;
        top: 50%;
        left: 50%;
    }
    .item-info{
        text-align: center;
        justify-content: center;
        padding-bottom: 40px;
    }
    .row{
        gap: 30px;
    grid-template-columns: repeat(2, 1fr);
  grid-template-rows: repeat(2, 150px);
    }
.card{
    display: flex;
    background-color: gray;
    width: 300px;  
}
</style>
</body>
</html>