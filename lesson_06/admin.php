<?php
include './engine/session_start.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage reviews</title>
    <style>
        .select_review_wrapper {
            display: none;
        }

        .update_review_wrapper {
            display: none;
        }
    </style>
</head>

<?php

    include('./engine/functions.php');
    $products = extractFromMYSQL('localhost', 'root', 'mysql', 'php_basic', "SELECT id, name FROM products");

?>

<body>
    <form action="#">
        <div class="select_product_wraper">
            <h3>Choose a product</h3>
            <select name="product_name" id="product_select">
                <?php foreach ($products as $key => $value) : ?>
                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                <?php endforeach; ?>
            </select>
            <br>
        </div>

        <div class="select_review_wrapper">
            <h3>Choose a review</h3>
            <p id="no_reviews">There are no reviews</p>
            <select name="review_author_name" id="review_author_select"></select>
        </div>
    </form>

    <div class="update_review_wrapper">
        <h3>Update review</h3>
        <form action="./engine/update_review.php" method="get" id='update_review_form'>
            <input type="text" name="author_name">
            <br>
            <textarea name="text" cols="30" rows="10"></textarea>
            <br>
            <input type="submit">
            <input type="hidden" name="review_id">
        </form>
    </div>

    <script >
        
        const productSelect = document.getElementById('product_select');
        const reviewAuthorSelect = document.getElementById('review_author_select');
        const selectReviewWrapper = document.getElementsByClassName('select_review_wrapper')[0]; 
        const noReviewsParagraph = document.getElementById('no_reviews');
        const updateReviewWrapper = document.getElementsByClassName('update_review_wrapper')[0];
        const updateReviewForm = document.getElementById('update_review_form');
        
        productSelect.addEventListener('change' , (event) => {
            selectReviewWrapper.style.display = 'block';
            fetch(`./engine/fetch_review_names.php?product_id=${event.target.value}`)
                .then(response => response.json())
                .then(json => {
                    if (json.length === 0) {
                        reviewAuthorSelect.style.display = 'none';
                        noReviewsParagraph.style.display = 'block';
                    } else {
                        reviewAuthorSelect.style.display = 'block';
                        noReviewsParagraph.style.display = 'none';
                    }
                    
                    reviewAuthorSelect.innerHTML = '';
                    for (let index = 0; index < json.length; index++) {
                        const option = document.createElement('option');
                        option.value = json[index].id;
                        option.innerHTML = json[index].author_name;
                        reviewAuthorSelect.appendChild(option);
                    }
                });
        });

        reviewAuthorSelect.addEventListener('change', (event) => {
            updateReviewWrapper.style.display = 'block';
            fetch(`./engine/fetch_review.php?review_id=${event.target.value}`)
                .then(response => response.json())
                .then(json => {
                    const review = json[0];
                    updateReviewForm.children[0].value = review.author_name;
                    updateReviewForm.children[2].innerHTML = review.text;
                    updateReviewForm.children[5].value = review.id;
                });
        });
    
    </script>
</body>
</html>