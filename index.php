<?php
include_once "./dbConn.php";
$connect = mysqli_connect("$serverName", "$userName", "$password", "$database");

if(!$connect) {
    echo "Connection Error:" . mysqli_connect_errno();
}
//query for the items i want
$sql = "SELECT * FROM product_meta";
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
    <a class="btn btn-primary" href="/add-product.php" role="button">Add item</a>
    <h2>Items in shop</h2>
    <div class="row">
    <?php foreach($items as $item){  ?>

    <div class="card">
        <div class="container2">
            <h4><b><?php echo htmlspecialchars($item["sku"]); ?></b></h4>
            <p><?php echo htmlspecialchars($item["price"]); ?></p>
            <p><?php echo htmlspecialchars($item["weight"]); ?></p>
            <p><?php echo htmlspecialchars($item["dimensions"]); ?></p>
        </div>
    </div>

        <?php } ?> 

    </div>
</div>

<style>
 
.card{
    background-color: gray;
    width: 150px;
    
}

</style>

</body>
</html>