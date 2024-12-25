document.addEventListener("DOMContentLoaded", function () {
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        const discount = parseFloat(card.getAttribute('data-discount')); // Скидка
        const originalPrice = parseFloat(card.getAttribute('data-price')); // Оригинальная цена
        const priceElement = card.querySelector('.price'); // Элемент для новой цены
        const oldPriceElement = card.querySelector('.old-price'); // Элемент для старой цены
        const discountElement = card.querySelector('.discount'); // Элемент для отображения скидки

        // Если есть скидка
        if (discount > 0) {
            const discountedPrice = originalPrice * (1 - discount / 100); // Вычисляем цену со скидкой

            // Отображаем старую цену
            oldPriceElement.textContent = `₽ ${originalPrice.toFixed(2)}`;
            oldPriceElement.style.display = 'block'; // Показываем старую цену

            // Отображаем новую цену
            priceElement.textContent = `₽ ${discountedPrice.toFixed(2)}`;

            // Отображаем скидку в правом верхнем углу
            discountElement.textContent = `- ${discount}%`;
            discountElement.style.display = 'block'; // Показываем скидку
        } else {
            // Если скидки нет, показываем только обычную цену
            priceElement.textContent = `${originalPrice.toFixed(2)} ₽`;
            oldPriceElement.style.display = 'none'; // Скрываем старую цену
            discountElement.style.display = 'none'; // Скрываем скидку
        }
    });
});
