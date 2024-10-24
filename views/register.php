<?php include view_path('partials/header.php'); ?>

<h1>Регистрация</h1>
<form id="reg-form" action="/register" method="POST">
    <div>
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login">
        <small class="error"></small>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password">
        <small class="error"></small>
    </div>
    <div>
        <button type="submit">Зарегистрироваться</button>
        <small id="global-error"></small>
    </div>
    <article id="success-notification" style="display: none;"></article>
</form>

<?php include view_path('partials/footer.php'); ?>
