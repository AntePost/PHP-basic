<?php
include './engine/session_start.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <style>
    
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    
    </style>
</head>
<body>
    <?php if($_SESSION['isAuth']) : ?>
        <h3>Cart</h3>
        <table id='table'></table>
    <?php else : ?>
        <h3>Log in to see cart</h3>
    <?php endif; ?>

    <script>
    
        const table = document.getElementById('table');
        const cart = JSON.parse(localStorage.getItem('cart'));

        const renderCart = () => {
            if (!table) {
                return;
            }
            
            const cart = JSON.parse(localStorage.getItem('cart'));

            table.innerHTML = "<tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total price</th><th>Delete button</th></tr>"

            for (let i = 0; i < cart.length; i++) {
                const newTR = document.createElement('tr');

                const newTDName = document.createElement('td');
                newTDName.innerHTML = cart[i].name;
                newTR.appendChild(newTDName);

                const newTDPrice = document.createElement('td');
                newTDPrice.innerHTML = cart[i].price;
                newTR.appendChild(newTDPrice);

                const newTDQuantity = document.createElement('td');
                newTDQuantity.innerHTML = cart[i].quantity;
                newTR.appendChild(newTDQuantity);

                const newTDTotalPrice = document.createElement('td');
                newTDTotalPrice.innerHTML = cart[i].quantity * cart[i].price;
                newTR.appendChild(newTDTotalPrice);

                const newDeleteButton = document.createElement('button');
                newDeleteButton.innerHTML = 'Delete item';
                newDeleteButton.classList.add('delete_item_button');
                newDeleteButton.setAttribute('data-product-id', cart[i].product_id);
                newTR.appendChild(newDeleteButton);

                table.appendChild(newTR);
            }
        };

        const addEventLisnerersToButtons = () => {
            if (!table) {
                return;
            }
            
            const deleteButtons = document.getElementsByClassName('delete_item_button');

            for (let i = 0; i < deleteButtons.length; i++) {
                deleteButtons[i].addEventListener('click', (event) => {
                    const data = {
                        product_id: deleteButtons[i].dataset.productId,
                    };

                    fetch('./engine/remove_from_cart_logic.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data),
                    })
                        .then(response => response.json())
                        .then(json => {                            
                            localStorage.setItem('cart', JSON.stringify(json));
                        })
                        .then(() => {
                            renderCart();
                            addEventLisnerersToButtons();
                        });
                });
            }
        };

        if (!cart || cart.length === 0) {
            fetch('./engine/get_cart.php')
                .then(response => response.json())
                .then(json => {                            
                    localStorage.setItem('cart', JSON.stringify(json));
                })
                .then(() => {
                    renderCart();
                    addEventLisnerersToButtons();
                });
        } else {
            renderCart();
            addEventLisnerersToButtons();
        }

    </script>
</body>
</html>