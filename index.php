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

	// // Shows all post values:
	// foreach($_POST as $key => $value)
	// {
	// echo 'Key = ' . $key . '&nbsp;';
	// echo 'Value= ' . $value . '<br />';
	// }
    if(isset($_POST["no"])){
    $no = $_POST['no']; // take checkbox values , its array;
    // echo "<pre>";
    // print_r($no);   // shows whats inside array
    // echo "</pre>";
    $no_to_comma_list = implode(',', $no); // changes array to string separated with commas;
    // echo $no_to_comma_list;
    // echo "DELETE FROM items WHERE id IN (".$no_to_comma_list.")";
    mysqli_query($connect,"DELETE FROM items WHERE id IN (".$no_to_comma_list.")");
    //returns to index page to remove deleted items
    header("location:index.php");
    }   
    
// ?>

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
    <div class="container my-5" id="index">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="nav-row mb3">
                <h2>{{ title }}</h2>
                <div class="nav-buttons">
                    <a class="btn btn-primary" href="/add-product.php" role="button">ADD</a>
                    <input class="btn btn-danger" type="submit" name="delete_records" value="MASS DELETE">
                </div>
            </div>
        <hr>
    <div class="row">
        <!-- loop over item array  -->
        <?php foreach($items as $item){  ?>

        <div class="card">
        <label class="check-container">
            <?php
                echo "<input type='checkbox' name='no[]' value='".$item['id']."' class='delete-checkbox'>";
            ?>
        </label>
        <!-- render items on main page  -->
        <div class="item-info">
            <h4><b><?php echo htmlspecialchars($item["sku"]); ?></b></h4>
            <p><?php echo "name: " . htmlspecialchars($item["name"]); ?></p>
            <p><?php echo "price: " . htmlspecialchars($item["price"]); ?></p>
            <p><?php echo "size: " . htmlspecialchars($item["size"]); ?></p>
            <p><?php echo "weight: " . htmlspecialchars($item["weight"]); ?></p>
            <p><?php echo "height: " . htmlspecialchars($item["height"]); ?></p>
            <p><?php echo "width: " . htmlspecialchars($item["width"]); ?></p>
            <p><?php echo "length: " . htmlspecialchars($item["length"]); ?></p>
        </div>
        </div>
        <?php } ?> 
    </div>
        </form>
    <hr>
    <div class="footer-wrap">
            <footer>Scandiweb Test assignment</footer>
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
    .nav-row{
        display: flex;
        justify-content: space-between;
    }
    .nav-buttons a{
        margin-right: 30px;
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
        display: flex;
        justify-content: center;
        gap: 30px;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 150px);
    }
    .card{
        display: flex;
        width: 300px;  
}

footer {
  justify-content: center;
  text-align: center;
}
</style>

<script type="module">
    import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

    createApp({
        data() {
        return {
            title: 'Product list',
            }
        },
    }).mount('#index')
    </script>

</body>
</html>