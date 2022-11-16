<?php
include_once "./dbConn.php";
$connect = mysqli_connect("$serverName", "$userName", "$password", "$database");
//check connection
if(!$connect) {
    echo "Connection Error:" . mysqli_connect_errno();
}
//query all from items table
$sql = "SELECT * FROM items";
//make query & get result
$result = mysqli_query($connect, $sql);
//if any errors with query display error msg
if(!$result) {
    die("Invalid query:" . $connect->error);
}
//fetch the resulting rows as an array
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <div class="nav-bar my-4">
        <div class="nav-logo">
            <h2>Product list</h2>
        </div>
        <div class="nav-buttons">
            <a class="btn btn-primary" href="/add-product.php" role="button">ADD</a>
            <a class="btn btn-danger" role="button">MASS DELETE</a>
        </div>
    </div>
    <div class="container my-4" id="index">
        <hr>
    <div class="row">
        <!-- loop over items array  -->
    <?php foreach($items as $item){  ?>

    <div class="card">
        <label class="check-container">
            <input type="checkbox" class="delete-checkbox" name="delete[]" value='<?= $id ?>'>
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
    <hr>
</div>
<footer>Scandiweb test assignment</footer>
<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    .nav-bar{
    display: flex;
    justify-content: space-between;
    margin: 0 120px 0 120px;
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
    justify-content: center;
    }
.card{
    display: flex;
    width: 300px;  
}
footer {
    text-align: center;
    padding-bottom: 9px;
}
</style>

<script type="module">
    import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

    createApp({
        data() {
        return {
            title: 'Add product'
        }
    },    
}).mount('#index')
</script>

</body>
</html>