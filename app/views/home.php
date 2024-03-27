<?php
require_once __DIR__ . '/./includes/header.php';
debug($viewData, 0);
debug($_SESSION, 0);
?>
<main>
    <a href="/Brief_Five_Composer/logout"><button type="button">Logout</button></a>
    <h1>home</h1>
    <form action="#" method="POST">
        <label for="mailLogin">Mail</label>
        <input type="mail" id="mailLogin" name="mailLogin" require autocomplete="email">

        <label for="passwordLogin">Password</label>
        <input type="password" id="passwordLogin" name="passwordLogin" require>

        <input type="hidden" value="<?= $csrfLogin ?>" name="csrfLogin">
        <button type='submit'>Send</button>
    </form>
</main>
<?php
require_once __DIR__ . '/./includes/footer.php';