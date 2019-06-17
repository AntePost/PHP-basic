<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .image_container {
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);           
        }
        .modal_content {
            margin: 5% auto;
            width: 50%;
        }

        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="image_container">
        <?php
        $filesArr = getArrOfFiles('img');
        $filesArrLength = count($filesArr);
        for ($i=0; $i < $filesArrLength; $i++) : ?>
            <a href="#" target="_blank" rel="noopener noreferrer" class="gallery_image_link">
                <img src="./img/<?=$filesArr[$i]?>" alt="image number <?=$i?>" class="gallery_image">
            </a>
        <?php endfor; ?>
    </div>
    <div class="modal">
        <div class="modal_content">
            <img src="./img/1.jpg" alt="modal image">
            <span class="close">&times;</span>
        </div>
    </div>

    <script>
        const modal = document.getElementsByClassName("modal")[0];
        const galleryImageLinkArr = document.getElementsByClassName("gallery_image_link");
        const closeButton = document.getElementsByClassName("close")[0];

        for (let i = 0; i < galleryImageLinkArr.length; i++) {
            galleryImageLinkArr[i].addEventListener('click', openModal);
        }

        function openModal(event) {
            event.preventDefault();
            modal.style.display = "block";

            const imageNumber = event.target.src.match(/(?<=img\/).+(?=.jpg)/)[0];
            const pathToImage = `./img/${imageNumber}.jpg`;
            modal.children[0].children[0].src = pathToImage;
        }

        closeButton.addEventListener('click', closeModal);

        function closeModal(event) {
            modal.style.display = "none";
        }

    </script>
</body>
</html>

<?php

function getArrOfFiles($path) {
    return $filesArr = array_values(array_diff(scandir("./$path/"), ['.', '..']));
}