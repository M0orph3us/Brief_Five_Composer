<?php
require_once __DIR__ . '/./includes/header.php';
?>
<main>
    <div class="login-container">
        <h1>login</h1>
        <form action="#" method="POST">
            <label for="mailLogin">Mail</label>
            <input type="mail" id="mailLogin" name="mailLogin" require autocomplete="email">

            <label for="passwordLogin">Password</label>
            <input type="password" id="passwordLogin" name="passwordLogin" require>

            <input type="hidden" value="<?= $csrfLogin ?>" name="csrfLogin">
            <button type='submit'>Send</button>
        </form>


    </div>

</main>
<?php
require_once __DIR__ . '/./includes/footer.php';