function filterProducts() {
    const searchQuery = document.getElementById('search').value.toLowerCase(); // Получаем поисковый запрос
    const category = document.querySelector('.sidebar ul li a.active')?.getAttribute('data-category') || 'all'; // Получаем активную категорию
    const showDiscount = document.getElementById('discount-filter').checked; // Проверяем, включен ли фильтр для товаров со скидкой

    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        const productName = card.querySelector('h2').textContent.toLowerCase();
        const productCategory = card.getAttribute('data-category');
        const hasDiscount = parseInt(card.getAttribute('data-discount')) !== 0; // Проверяем, есть ли скидка на товар

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
    const categoryLinks = document.querySelectorAll('.sidebar ul li a');
    categoryLinks.forEach(link => {
        link.classList.remove('active');
    });

    const activeLink = document.querySelector(`[data-category="${category}"]`);
    if (activeLink) {
        activeLink.classList.add('active');
    }

    filterProducts();
}