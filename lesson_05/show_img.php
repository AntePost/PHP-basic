<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .image_container {
            width: 500px;
            margin: 0 auto;
        }

        h1, p {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php 
        include('./engine/functions.php');
        $id = htmlspecialchars($_GET["id"]);
        updateMYSQL('localhost', 'root', 'mysql', 'php_basic', "UPDATE images SET popularity = popularity + 1 WHERE id = $id");
        $image = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT * FROM images WHERE id = $id");
    ?>
    <div class="image_container">
        <h1>Image № <?=$image[0]['id']?></h1>
        <img src="<?=$image[0]['address']?>" alt="image number <?=$image[0]['id']?>">
        <p>Popularity: <?=$image[0]['popularity']?> clicks</p>
    </div>
</body>
</html>