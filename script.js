// Показать модальное окно по id
function openModal(modalId) {
    document.getElementById('overlay').style.display = 'block';
    const modal = document.getElementById(modalId);
    if (modal) modal.style.display = 'block';
}

// Скрыть модальное окно по id
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.style.display = 'none';

    // Проверяем, не видны ли другие модалки, если нет — скрываем оверлей
    const authModalVisible = document.getElementById('authModal').style.display === 'block';
    const registerModalVisible = document.getElementById('registerModal').style.display === 'block';

    if (!authModalVisible && !registerModalVisible) {
        document.getElementById('overlay').style.display = 'none';
    }
}

// Открыть форму авторизации
function openAuthForm() {
    openModal('authModal');
}

// Закрыть форму авторизации
function closeAuthForm() {
    closeModal('authModal');
}

// Открыть форму регистрации
function openRegisterForm() {
    openModal('registerModal');
}

// Закрыть форму регистрации
function closeRegisterForm() {
    closeModal('registerModal');
}

// Переключение с регистрации на авторизацию
function switchToLogin() {
    closeRegisterForm();
    openAuthForm();
}

// Переключение с авторизации на регистрацию
function switchToRegister() {
    closeAuthForm();
    openRegisterForm();
}

// Закрытие при клике на оверлей, если клик не по модальному окну
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.addEventListener('click', (e) => {
            // Если клик по самому оверлею (фон)
            if (e.target === overlay) {
                closeAuthForm();
                closeRegisterForm();
            }
        });
    }

    // Автоматическое плавное скрытие сообщения по id messageBox
    const msgBox = document.getElementById('messageBox');
    if (msgBox) {
        setTimeout(() => {
            msgBox.style.transition = "opacity 0.5s ease";
            msgBox.style.opacity = 0;
            setTimeout(() => msgBox.remove(), 500);
        }, 5000);
    }

    // Функция для фильтрации ввода — разрешены только буквы (русские и латинские), пробел и дефис
    function validateNameInput(event) {
        const allowed = /[а-яёa-z\s-]/i;
        const char = String.fromCharCode(event.which || event.keyCode);
        if (!allowed.test(char)) {
            event.preventDefault();
        }
    }

    const firstnameInput = document.querySelector('input[name="firstname"]');
    const lastnameInput = document.querySelector('input[name="lastname"]');

    if (firstnameInput) {
        firstnameInput.addEventListener('keypress', validateNameInput);
    }
    if (lastnameInput) {
        lastnameInput.addEventListener('keypress', validateNameInput);
    }
});

// Яндекс.Карты
ymaps.ready(init);

function init() {
    const coords = [55.740254, 36.857580];

    const myMap = new ymaps.Map("map", {
        center: coords,
        zoom: 16
    });

    const myPlacemark = new ymaps.Placemark(coords, {
        balloonContent: 'Загрузка адреса...'
    });

    myMap.geoObjects.add(myPlacemark);

    ymaps.geocode(coords).then(res => {
        const firstGeoObject = res.geoObjects.get(0);
        const address = firstGeoObject.getAddressLine();

        myPlacemark.properties.set('balloonContent', address);
    }).catch(err => {
        console.warn('Геокодинг не сработал:', err);
    });
}
