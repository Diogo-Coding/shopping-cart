<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Carrito</h1>
    <a href="index.php">Volver atras</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT";
                if(isset($_SESSION['cart'])){
                    //printf("<h2>El carrito tiene %s</h2>", implode(',', $_SESSION['cart']));
                    foreach($_SESSION['cart'] as $product){
                            ?>
                                <tr>
                                    <td><?=$product['id']?></td>
                                    <td><?=$product['name']?></td>
                                    <td><?=$product['price']?></td>
                                    <td></td>
                                </tr>
                            <?php
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>