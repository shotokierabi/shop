function addToCart(id, name, price, img) {
    const product = { id, name, price, img };

    fetch('cart_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(product),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Товар добавлен в корзину');
            } else {
                alert('Ошибка при добавлении товара');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
        });
}
