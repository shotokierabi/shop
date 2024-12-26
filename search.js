function filterProducts() {
    const searchQuery = document.getElementById('search').value.toLowerCase(); // Получаем поисковый запрос
    const activeCategory = document.querySelector('.sidebar ul li a.active')?.getAttribute('data-category') || 'all'; // Текущая активная категория
    const showDiscount = document.getElementById('discount-filter').checked; // Фильтр по скидке

    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        const productName = card.querySelector('h2').textContent.toLowerCase(); // Название товара
        const productCategories = card.getAttribute('data-categories').split(','); // Категории товара (в формате id1,id2,...)
        const hasDiscount = parseInt(card.getAttribute('data-discount')) !== 0; // Проверка наличия скидки

        // Проверка условий фильтрации
        const matchesSearch = productName.includes(searchQuery);
        const matchesCategory = activeCategory === 'all' || productCategories.includes(activeCategory); // Сравнение категории
        const matchesDiscount = !showDiscount || hasDiscount;

        // Показать/скрыть товар в зависимости от условий
        if (matchesSearch && matchesCategory && matchesDiscount) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}



// Функция фильтрации по категории
function filterByCategory(category) {
    const categoryLinks = document.querySelectorAll('.sidebar ul li a'); // Все ссылки категорий

    // Убираем класс "active" у всех ссылок
    categoryLinks.forEach(link => {
        link.classList.remove('active');
    });

    // Добавляем класс "active" к выбранной категории
    const activeLink = document.querySelector(`[data-category="${category}"]`);
    if (activeLink) {
        activeLink.classList.add('active');
    }

    // Перезапускаем фильтрацию
    filterProducts();
}

