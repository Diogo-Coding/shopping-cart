<?php include('includes/conection.php'); ?>
<?php
    session_start();
    if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price'])){
        $new = ['id'=> $_GET['id'],
                'name'=> $_GET['name'],
                'price'=> $_GET['price']
            ];
        $_SESSION['cart'][] = $new;
    }

    if (isset($_SESSION['cart'])) {
        $numProducts_cart = count($_SESSION['cart']);
    } else {
        $numProducts_cart = 0;
    }

    $sql = "SELECT * FROM products";
    if(isset($_GET['order'])){
        $order = $_GET['order'];
        if($order == 'id' || $order == 'name' || $order == 'price' || $order == 'amount'){
            setcookie('order', $_GET['order']);
        } else {
            unset($order);
        }
    }

    if(empty($order) && isset($_COOKIE['order'])){
        $order = $_COOKIE['order'];
        if(!($order == 'id' || $order == 'name' || $order == 'price' || $order == 'amount')){
            unset($order);
            setcookie('order', '', time());
        }
    }
    
    if(isset($order)){
        $sql .= " ORDER by " . $order;
    }
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Productos</h1>
    <p><a href="cart.php">Carrito (<?=$numProducts_cart?>)</a></p>
    <table>
        <thead>
            <tr>
                <th><a href="/index.php?order=id">ID</a></th>
                <th><a href="/index.php?order=name">Name</a></th>
                <th><a href="/index.php?order=price">Price</a></th>
                <th><a href="/index.php?order=amount">Amount</a></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($row = $result->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['price']?></td>
                            <td><?=$row['amount']?></td>
                            <td><a href="/index.php?id=<?=$row['id']?>&name=<?=$row['name']?>&price<?=$row['price']?>">Añadir a carrito</a></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>