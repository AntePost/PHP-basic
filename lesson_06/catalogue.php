<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalogue</title>
    <style>
        .products_wrapper {
            width: 1000px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 0 auto;
        }

        img {
            width: 400px;
        }

        p, h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="products_wrapper">
        <?php

        include('./engine/functions.php');
        $products = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT * FROM products");

        foreach ($products as $key => $value) : ?>
            <div class="product_wrapper">
                <h3><?=$value['name']?></h3>
                <a href="./product.php?id=<?=$value['id']?>" target="_blank" rel="noopener noreferrer" class="gallery_image_link">
                    <img src="<?=$value['path_to_image']?>" alt="image number <?=$value['id']?>" class="gallery_image">
                </a>
                <p>Price <?=$value['price']?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>