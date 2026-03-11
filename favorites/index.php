<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Избранные товары");
CJSCore::Init(array('ajax', 'ui.notification'));
?>
<div class="page-container">
    <div class="favorites-page">
        <h1 id="catalog-h1">Отложенные товары товары</h1>
        <div id="favorites-container">
            <!-- Товары будут подгружены через JavaScript -->
            <div class="favorites-loading">Загрузка...</div>
        </div>
        
        <div class="favorites-summary" style="display:none;">
            <div class="summary-row">
                <span>Общая стоимость:</span>
                <span id="total-price">0 ₽</span>
            </div>
            <button id="add-all-to-cart" class="btn btn-primary">
                Добавить все в корзину
            </button>
        </div>
        
        <div id="favorites-empty" style="display:none;">
            <p>В избранном пока нет товаров</p>
            <a href="/catalog/" class="btn">Перейти в каталог</a>
        </div>
    </div>
</div>


<script>
// Загружаем избранное при открытии страницы
document.addEventListener('DOMContentLoaded', function() {
    loadFavorites();
    
    // Обновляем при изменении в localStorage (с других вкладок)
    window.addEventListener('storage', function(e) {
        if (e.key === 'favorites') {
            loadFavorites();
        }
    });
});

// Загрузка и отображение избранного
function loadFavorites() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const container = document.getElementById('favorites-container');
    const emptyBlock = document.getElementById('favorites-empty');
    const summaryBlock = document.querySelector('.favorites-summary');
    
    if (favorites.length === 0) {
        container.innerHTML = '';
        emptyBlock.style.display = 'block';
        summaryBlock.style.display = 'none';
        return;
    }
    
    emptyBlock.style.display = 'none';
    summaryBlock.style.display = 'block';
    
    let html = '';
    let totalPrice = 0;
    
    favorites.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        totalPrice += itemTotal;
        console.log(item);
      html += `
              <div class="favorite_v2-item">
            <div class="favorite_v2-item-image"><a href="${item.detailUrl || '/catalog/'}"><img src="${item.image}" alt="${item.name}"></a></div>
            <div class="favorite_v2-item-title">
                <h3><a href="${item.detailUrl || '/catalog/'}">${item.name}</a></h3>
                <span>${item.available}</span>
            </div>
            <div class="favorite_v2-item-cart">
                <div class="btn-cart" onclick="addToCartAjax(${item.id}, ${item.quantity})">в корзину</div>
            </div>
            <div class="favorite_v2-item-price-wrap">
                <div class="favorite_v2-item-price">${formatPrice(item.price)} ₽</div>
                <div class="favorite_v2-item-price-per">цена за 1 шт</div>
            </div>
            <div class="favorite_v2-item-quantity">
                <div class="quantity-controls">
                    <button class="qty-minus" onclick="changeQuantity(${index}, -1)">-</button>
                    <input type="text" value="${item.quantity}" min="1" class="qty-input" onchange="updateQuantity(${index}, this.value)">
                    <button class="qty-plus" onclick="changeQuantity(${index}, 1)">+</button>
                </div>
            </div>
            <div class="item-total">
                Сумма: <span>${formatPrice(itemTotal)} ₽</span>
                <div class="btn-remove" onclick="removeFromFavorites(${index})"></div>
            </div>
        </div>
      `;
    });
    
    container.innerHTML = html;
    document.getElementById('total-price').textContent = formatPrice(totalPrice) + ' ₽';
}



// Функции управления количеством
function changeQuantity(index, delta) {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    if (favorites[index]) {
        favorites[index].quantity = Math.max(1, favorites[index].quantity + delta);
        localStorage.setItem('favorites', JSON.stringify(favorites));
        loadFavorites();
    }
}

function updateQuantity(index, value) {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    if (favorites[index]) {
        favorites[index].quantity = Math.max(1, parseInt(value) || 1);
        localStorage.setItem('favorites', JSON.stringify(favorites));
        loadFavorites();
    }
}

// Удаление из избранного
function removeFromFavorites(index) {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    favorites.splice(index, 1);
    localStorage.setItem('favorites', JSON.stringify(favorites));
    loadFavorites();
    updateFavoritesCounter(); // Обновляем счетчик в шапке
}

// Добавление в корзину
function addToCart(productId, quantity) {
    // Используйте ваш существующий код добавления в корзину
    // Например:
    BX.ajax({
        url: '/bitrix/components/bitrix/sale.basket.basket/ajax.php',
        method: 'POST',
        data: {
            sessid: BX.bitrix_sessid(),
            action: 'add',
            id: productId,
            qty: quantity
        },
        onsuccess: function() {
            alert('Товар добавлен в корзину');
        }
    });
}

function addToBasket(productId, quantity) {
    
    // // Показываем индикатор загрузки
    // button.disabled = true;
    // button.innerHTML = 'Добавляем...';
    
    // AJAX запрос
    BX.ajax({
        url: '/bitrix/components/bitrix/sale.basket.basket/ajax.php',
        data: {
            action: 'add',
            id: productId,
            quantity: quantity,
            sessid: BX.bitrix_sessid()
        },
        method: 'POST',
        dataType: 'json',
        onsuccess: function(response) {
            if (response.STATUS === 'OK') {
                // Обновляем счетчик корзины в шапке
                if (typeof BX.Sale.BasketComponent !== 'undefined') {
                    BX.Sale.BasketComponent.refreshCart();
                }
                
                // Уведомление
                BX.UI.Notification.Center.notify({
                    content: 'Товар добавлен в корзину',
                    autoHideDelay: 3000
                });
                

            }

        }
    });
}

// Добавить все в корзину
document.getElementById('add-all-to-cart').addEventListener('click', function() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    
    favorites.forEach(item => {
        addToCartAjax(item.id, item.quantity);
    });
    
    alert('Все товары добавлены в корзину');
});

// Форматирование цены
function formatPrice(price) {
    return parseFloat(price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& ');
}

// Обновление счетчика в шапке (если на той же странице)
function updateFavoritesCounter() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const counter = document.querySelector('.favorites-counter');
    if (counter) {
        counter.textContent = favorites.length;
        counter.style.display = favorites.length ? 'inline-block' : 'none';
    }
}


// Функция добавления в корзину через AJAX
function addToCartAjax(productId, quantity = 1) {
    // Показываем индикатор загрузки
    const button = event?.target;
    if (button) {
        const originalText = button.innerHTML;
        button.innerHTML = '⏳ Добавляем...';
        button.disabled = true;
        
        // Восстановим кнопку через 3 секунды на всякий случай
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        }, 3000);
    }
    
    // AJAX запрос к нашему файлу
    fetch('/add_to_cart_ajax.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            sessid: BX.bitrix_sessid(), // CSRF-токен
            id: productId,
            qty: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        // Обработка ответа
        if (data.success) {
            // Успешно добавлено
            if (button) {
                button.innerHTML = '✓ Добавлено';
                setTimeout(() => {
                    button.innerHTML = 'В корзину';
                    button.disabled = false;
                }, 1000);
            }
            
            // Показываем уведомление
            showCartNotification(data.message);
            
            // Обновляем счетчик корзины
            updateCartCounter();
            
        } else {
            // Ошибка
            if (button) {
                button.innerHTML = '✗ Ошибка';
                setTimeout(() => {
                    button.innerHTML = 'В корзину';
                    button.disabled = false;
                }, 2000);
            }
            alert(data.message || 'Ошибка добавления');
        }
    })
    .catch(error => {
        console.error('Ошибка запроса:', error);
        if (button) {
            button.innerHTML = '✗ Ошибка сети';
            setTimeout(() => {
                button.innerHTML = 'В корзину';
                button.disabled = false;
            }, 2000);
        }
        alert('Ошибка соединения с сервером');
    });
}

// Функция обновления счетчика корзины
function updateCartCounter() {
    // Если есть стандартный компонент корзины
    if (typeof BX.Sale !== 'undefined' && typeof BX.Sale.BasketComponent !== 'undefined') {
        BX.Sale.BasketComponent.refreshCart();
    }
    
    // Или обновляем вручную
    const cartCounters = document.querySelectorAll('.cart-counter, .basket-count');
    if (cartCounters.length > 0) {
        // Просто увеличиваем на 1
        cartCounters.forEach(counter => {
            const current = parseInt(counter.textContent) || 0;
            counter.textContent = current + 1;
        });
    }
}

// Показ уведомления
function showCartNotification(message) {
    // Создаем уведомление
    const notification = document.createElement('div');
    notification.className = 'cart-notification';
    notification.innerHTML = `
        <div class="cart-notification-content">
            <span class="cart-notification-icon">✓</span>
            <span class="cart-notification-text">${message}</span>
            <a href="/personal/cart/" class="cart-notification-link">Перейти в корзину</a>
        </div>
    `;
    
    // Добавляем на страницу
    document.body.appendChild(notification);
    
    // Показываем
    setTimeout(() => notification.classList.add('show'), 10);
    
    // Убираем через 3 секунды
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Стили для уведомления
const style = document.createElement('style');
style.textContent = `
.cart-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #4CAF50;
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 9999;
    transform: translateX(150%);
    transition: transform 0.3s ease-out;
}

.cart-notification.show {
    transform: translateX(0);
}

.cart-notification-content {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cart-notification-icon {
    font-size: 20px;
    font-weight: bold;
}

.cart-notification-link {
    margin-left: 15px;
    color: white;
    text-decoration: underline;
    font-size: 14px;
}

.cart-notification-link:hover {
    opacity: 0.8;
}
`;
document.head.appendChild(style);

</script>

<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>