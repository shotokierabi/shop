// Функция для получения параметров из URL
function getURLParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Функция для отображения данных о товаре
function displayProductDetails(productId) {
    // Пример данных о товарах (в реальном проекте вы могли бы получать эти данные с сервера)
    const products = [
        {
            id: 1,
            name: "Хлеб",
            description: "Описание хлеба. Очень вкусный и свежий хлеб.",
            price: "500 руб.",
            discount: "Скидка 20%",
            image: "img/bread.jpg"
        }
    ];

    // Находим товар по id
    const product = products.find(item => item.id === parseInt(productId));

    if (product) {
        // Заполняем элементы на странице
        document.getElementById('product-image').src = product.image;
        document.getElementById('product-name').textContent = product.name;
        document.getElementById('product-description').textContent = product.description;
        document.getElementById('product-price').textContent = product.price;
        document.getElementById('product-discount').textContent = product.discount;
    } else {
        // Если товар не найден, выводим ошибку
        document.querySelector('.product-detail').innerHTML = "<p>Товар не найден.</p>";
    }
}

// Извлекаем ID товара из URL
const productId = getURLParameter('id');

// Отображаем данные о товаре
if (productId) {
    displayProductDetails(productId);
} else {
    document.querySelector('.product-detail').innerHTML = "<p>Товар не найден.</p>";
}


