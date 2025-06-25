document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("feedback-form");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault(); 

        const name = form.querySelector('input[name="name"]').value.trim();
        const surname = form.querySelector('input[name="surname"]').value.trim();
        const email = form.querySelector('input[name="email"]').value.trim();
        const phone = form.querySelector('input[name="phone"]').value.trim();
        const message = form.querySelector('textarea[name="message"]').value.trim();

        if (!name || !surname || !email || !phone || !message) {
            alert("Пожалуйста, заполните все поля.");
            return;
        }

        // Проверка телефона
        const phonePattern = /^\+?[0-9\s\-()]{10,20}$/;
        if (!phonePattern.test(phone)) {
            alert("Введите корректный номер телефона, например +79001234567");
            return;
        }

        const formData = new FormData(form);

        fetch("sendmail.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === "success") {
                    alert("Сообщение успешно отправлено!");
                    form.reset();
                } else {
                    alert("Ошибка при отправке: " + data);
                }
            })
            .catch(() => {
                alert("Ошибка при отправке. Попробуйте позже.");
            });
    });
});
