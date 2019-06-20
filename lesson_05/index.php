<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .images_container {
            margin: 0 auto;
            width: 650px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            border: 1px solid black;
        }
        .gallery_image {
            width: 200px;
        }

        .gallery_image_link:nth-child(1n + 4) {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="images_container">
        <?php
        include('./engine/functions.php');
        $images = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT * FROM images");
        usort($images, 'comparisonByPopularityDesc');

        foreach ($images as $key => $value) : ?>
            <a href="/lesson_05/show_img.php?id=<?=$value['id']?>" target="_blank" rel="noopener noreferrer" class="gallery_image_link">
                <img src="<?=$value['address']?>" alt="image number <?=$value['id']?>" class="gallery_image">
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>
