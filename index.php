<?php
include_once "./dbConn.php";
class Products extends dbConn {

    public function getItems() {
        //query for the items i want
        $sql = "SELECT * FROM items";
        $stmt = $this->connect()->query($sql);
        $items = $stmt->fetchAll();

        foreach($items as $item) {
           echo '<div class="card">';
            echo '<label class="check-container">';
                echo "<input type='checkbox' name='no[]' value='".$item['id']."' class='delete-checkbox'> ";
            echo '</label>';
                echo '<div class="item-info">';
                    echo "<h4>";
                    echo "<b>";
                    echo "SKU: " .  $item["sku"];
                    echo "</b>";
                    echo "</h4>";
                    echo "name: " .  $item["name"] . "<br>";
                    echo "price: " .  $item["price"] . "<br>";
                    echo "size: " .  $item["size"] . "<br>";
                    echo "weight: " .  $item["weight"] . "<br>";
                    echo "height: " .  $item["height"] . "<br>";
                    echo "width: " .  $item["width"] . "<br>";
                    echo "length: " .  $item["length"] . "<br>";
                echo '</div>';
            echo '</div>';

        }
        if(isset($_POST["no"])){
            // take checkbox values , its array
            $no = $_POST['no']; 
             // changes array to string separated with commas;
            $no_to_comma_list = implode(',', $no);
            $query = $stmt("DELETE FROM items WHERE id IN (".$no_to_comma_list.")");
            $query->execute();
            //returns to index page to remove deleted items
            header("location:index.php");
            } 

    }    
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
    <title>Webshop</title>
</head>
<body>
    <div class="container my-5" id="index">
        <form>
            <div class="nav-row mb3">
                <h2>{{ title }}</h2>
                <div class="nav-buttons">
                    <a class="btn btn-primary" href="/add-product.php" role="button">ADD</a>
                    <input class="btn btn-danger" type="submit" name="delete_records[]" value="MASS DELETE">
                </div>
            </div>
        <hr>
    <div class="row">
        <!-- render product cards  -->
        <?php 
        $productObj = new Products();
        $productObj->getItems();
         ?>
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