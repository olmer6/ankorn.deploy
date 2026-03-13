BasketManager = {
    init: function() {
        this.bindEvents();
    },

    bindEvents: function() {
        var self = this;
        // Кнопки плюс
        document.querySelectorAll('.qty-plus').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var itemId = this.dataset.itemId;
                self.changeQuantity(itemId, 'plus');
            });
        });

        // Кнопки минус
        document.querySelectorAll('.qty-minus').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var itemId = this.dataset.itemId;
                self.changeQuantity(itemId, 'minus');
            });
        });

        // Поля ввода
        document.querySelectorAll('.qty-input').forEach(function(input) {
            input.addEventListener('change', function(e) {
                var itemId = this.dataset.itemId;
                var quantity = parseInt(this.value);
                if (quantity < 1) quantity = 1;
                this.value = quantity;
                self.updateQuantity(itemId, quantity);
            });
        });

        // Кнопки удаления
        document.querySelectorAll('.btn-remove').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var itemId = this.dataset.itemId;
                if (confirm('Удалить товар из корзины?')) {
                    self.removeItem(itemId);
                }
            });
        });
    },

    changeQuantity: function(itemId, action) {
        var input = document.querySelector('.qty-input[data-item-id="' + itemId + '"]');
        if (!input) return;

        var currentVal = parseInt(input.value) || 1;

        if (action === 'plus') {
            input.value = currentVal + 1;
        } else if (action === 'minus' && currentVal > 1) {
            input.value = currentVal - 1;
        } else {
            return;
        }

        this.updateQuantity(itemId, input.value);
    },

    updateQuantity: function(itemId, quantity) {
        var self = this;

        BX.ajax({
            url: '/personal/cart/ajax.php',
            method: 'POST',
            data: {
                sessid: BX.message('bitrix_sessid'),
                basketItemId: itemId,
                quantity: quantity,
                action: 'updateQuantity'
            },
            onsuccess: function(data) {
                try {
                    var response = JSON.parse(data);
                    console.log(response);
                    if (response.SUCCESS) {
                        self.updateBasketData(response.DATA);
                    } else {
                        alert('Ошибка обновления корзины');
                    }
                } catch(e) {
                    console.error(e);
                }
            },
            onfailure: function() {
                alert('Ошибка соединения');
            }
        });
    },

    removeItem: function(itemId) {
        var self = this;

        BX.ajax({
            url: '/personal/cart/ajax.php',
            method: 'POST',
            data: {
                sessid: BX.message('bitrix_sessid'),
                basketItemId: itemId,
                action: 'delete'
            },
            onsuccess: function(data) {
                try {
                    var response = JSON.parse(data);
                    if (response.SUCCESS) {
                        var item = document.getElementById('basket-item-' + itemId);
                        if (item) {
                            item.remove();
                        }
                        self.updateBasketData(response.DATA);
                    } else {
                        alert('Ошибка удаления товара');
                    }
                } catch(e) {
                    console.error(e);
                }
            }
        });
    },

    updateBasketData: function(data) {

        // Обновляем суммы товаров
        if (data.ITEMS) {
            for (var itemId in data.ITEMS) {
                console.log(itemId);
                var item = data.ITEMS[itemId];
                console.log(item);

                // Обновляем цену товара
                var priceElement = document.querySelector('.cart_v2-item-price[data-id="' + itemId + '"]');

                if (priceElement && item.PRICE_FORMATED) {
                    priceElement.textContent = item.PRICE_FORMATED;
                }

                // Обновляем общую сумму
                var totalElement = document.querySelector('.item-total-price[data-id="' + itemId + '"]');
                console.log(totalElement);
                console.log( item.SUM_FULL_PRICE_FORMATED);
                if (totalElement && item.SUM_FULL_PRICE_FORMATED) {
                    totalElement.textContent = item.SUM_FULL_PRICE_FORMATED;
                }

                // Обновляем количество в input
                var input = document.querySelector('.qty-input[data-item-id="' + itemId + '"]');
                if (input && item.QUANTITY) {
                    input.value = item.QUANTITY;
                }
            }
        }

        // Обновляем общую сумму корзины
        if (data.ALL_SUM_FORMATED) {
            var totalElements = document.querySelectorAll('[data-entity="basket-total-price"]');
            totalElements.forEach(function(el) {
                el.textContent = data.ALL_SUM_FORMATED;
            });
        }

        // Обновляем НДС
        if (data.ALL_VAT_SUM_FORMATED) {
            var vatElement = document.querySelector('[data-entity="basket-total-vat"]');
            if (vatElement) {
                vatElement.textContent = data.ALL_VAT_SUM_FORMATED;
            }
        }
    },
};

// Инициализация после загрузки страницы
BX.ready(function() {
    BasketManager.init();
});

$(document).ready(function(){

    $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
    $("input[type='tel']").mask('+7 (999) 999-99-99');

    $('#place_order').on('submit', function(e) {
        // Отменяем стандартную отправку формы
        e.preventDefault();
        // Собираем данные формы
        var formData = $(this).serialize();
        // Отправляем AJAX запрос
        $.post({
            url: $(this).attr('action'),
            data: formData,
            success: function(data) {
                var response = JSON.parse(data);
                console.log(response);
                console.log(response.ERROR);

                if(response.ERROR) {
                    var order_error = $("#place_order_error");
                    order_error.empty();
                    order_error.addClass('active');
                    if (response.ERROR.name)
                        order_error.append(response.ERROR.name);
                    if (response.ERROR.email)
                        order_error.append("</br>"+response.ERROR.email);
                    if (response.ERROR.phone)
                        order_error.append("</br>"+response.ERROR.phone);
                    return;
                } else {
                    ym(45467883,'reachGoal','card');
                    $("#place_order_error").empty();
                    $("#place_order_error").removeClass('active');
                  window.location = '/personal/cart/order-success/';
                }

                // Обработка успешного ответа
                //alert('Заказ успешно создан!');
            },
            error: function(xhr, status, error) {
                console.error('Ошибка:', error);
                // Обработка ошибки
                alert('Произошла ошибка при отправке');
            }
        });
    });
});