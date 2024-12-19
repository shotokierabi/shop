function filterProducts() {
    const searchQuery = document.getElementById('search').value.toLowerCase(); // Получаем поисковый запрос
    const category = document.querySelector('.sidebar ul li a.active')?.getAttribute('data-category') || 'all'; // Получаем активную категорию
    const showDiscount = document.getElementById('discount-filter').checked; // Проверяем, включен ли фильтр для товаров со скидкой

    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        const productName = card.querySelector('h2').textContent.toLowerCase();
        const productCategory = card.getAttribute('data-category');
        const hasDiscount = card.getAttribute('data-discount') === 'true'; // Проверяем, есть ли скидка на товар

        // Проверяем, соответствует ли товар поисковому запросу, категории и фильтру по скидке
        const matchesSearch = productName.includes(searchQuery);
        const matchesCategory = category === 'all' || productCategory === category;
        const matchesDiscount = !showDiscount || hasDiscount; // Если чекбокс активирован, показываем товары со скидкой

        // Показываем товар, если он соответствует всем условиям
        if (matchesSearch && matchesCategory && matchesDiscount) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Функция фильтрации по категории
function filterByCategory(category) {
    // Убираем активный класс с всех категорий
    const categoryLinks = document.querySelectorAll('.sidebar ul li a');
    categoryLinks.forEach(link => {
        link.classList.remove('active');
    });

    // Добавляем активный класс выбранной категории
    const activeCategoryLink = document.getElementById('category-' + category);
    if (activeCategoryLink) {
        activeCategoryLink.classList.add('active');
    }

    // Применяем фильтрацию по категории и поисковому запросу
    filterProducts();
}



function updateRatings() {
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        const rating = parseFloat(card.getAttribute('data-rating')); // Получаем рейтинг из атрибута
        const stars = card.querySelectorAll('.star');

        // Обновляем звезды в зависимости от рейтинга
        for (let i = 0; i < stars.length; i++) {
            if (i < rating) {
                stars[i].classList.remove('empty');
            } else {
                stars[i].classList.add('empty');
            }
        }
    });
}