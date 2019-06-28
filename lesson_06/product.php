<?php
include './engine/session_start.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <style>
        .product_wrapper {
            width: 500px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .reviews_wrapper {
            width: 500px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .review_wrapper {
            text-align: center;
        }

        .add_review {
            width: 500px;
            height: 300px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<?php 
    include('./engine/functions.php');
    $id = htmlspecialchars($_GET["id"]);
    $product = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT * FROM products WHERE id = $id")[0];

    $reviews = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT * FROM reviews WHERE product_id = $id");
?>

<body>
    <div class="product_wrapper">
        <h3><?=$product['name']?></h3>
        <img src="<?=$product['path_to_image']?>" alt="image number <?=$product['id']?>">
        <p>Price: <?=$product['price']?></p>
        <p><?=$product['description']?></p>
        <?php if($_SESSION['isAuth']) : ?>
            <button id="add_to_cart_button" data-product_id="<?=$product['id']?>">Add to cart</button>
        <?php endif; ?>
    </div>
    
    <div class="reviews_wrapper">
        <h3>Reviews</h3>
        <?php if (empty($reviews)) : ?>
            <p>There are no reviews</p>
        <?php endif ?>
        
        <?php foreach ($reviews as $key => $value) : ?>
            <div class="review_wrapper">
                <h3><?=$value['author_name']?></h3>
                <p><?=$value['text']?></p>
                <form action="./engine/delete_review.php" method="get">
                    <input type="hidden" name="review_id" value="<?=$value['id']?>">
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <input type="submit" value="Delete">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    
    <h3>Add review</h3>
    <form action="./engine/add_review.php?product_id=<?=$product['id']?>" method="post" class="add_review">
        <label for="author_name">Your name</label>
        <input type="text" name="author_name" id="author_name">
        <p>Your comment</p>
        <textarea name="text" cols="30" rows="10"></textarea>
        <input type="submit">
    </form>

    <script>
    
    const addToCartButton = document.getElementById('add_to_cart_button');
    if (addToCartButton !== null) {
        addToCartButton.addEventListener('click', (event) => {
            const data = {
                product_id: +event.target.dataset.product_id,
            }           
            
            fetch('./engine/add_to_cart_logic.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
                .then(response => response.json())
                .then(json => {                  
                    localStorage.setItem('cart', JSON.stringify(json));
                });
        });
    }

    </script>
</body>
</html>