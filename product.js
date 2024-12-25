document.addEventListener("DOMContentLoaded", function () {
    const productCards = document.querySelectorAll('.details');

    productCards.forEach(card => {
        const discount = parseFloat(card.getAttribute('data-discount')); // Скидка
        const discountElement = card.querySelector('.discount'); // Скидка

        // Если есть скидка
        if (discount > 0) {
            // Отображаем скидку в правом верхнем углу
            discountElement.textContent = `- ${discount}%`;
            discountElement.style.display = 'block'; // Показываем скидку
        } else {
            // Если скидки нет, показываем только обычную цену

        }
    });
});
