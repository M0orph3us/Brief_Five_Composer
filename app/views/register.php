<?php
require_once __DIR__ . '/./includes/header.php';
?>
<main>
    <h1>register</h1>
    <a href="/Brief_Five_Composer/logout"><button type="button">Logout</button></a>
    <form action="#" method="POST">
        <label for="firstnameRegister">firstname</label>
        <input type="text" id="firstnameRegister" name="firstnameRegister" require minlength="3" maxlength="20"
            autocomplete="given-name">

        <label for="lastnameRegister">lastname</label>
        <input type="text" id="lastnameRegister" name="lastnameRegister" require minlength="1" maxlength="20"
            autocomplete="family-name">

        <label for="mailRegister">mail</label>
        <input type="mail" id="mailRegister" name="mailRegister" require minlength="5" maxlength="100"
            autocomplete="email">

        <label for="firstPasswordRegister">password</label>
        <input type="password" id="firstPasswordRegister" name="firstPasswordRegister" require minlength="5"
            maxlength="20" autocomplete="new-password">

        <label for="secondPasswordRegister">Confirm your password</label>
        <input type="password" id="secondPasswordRegister" name="secondPasswordRegister" require minlength="5"
            maxlength="20" autocomplete="new-password">

        <input type="hidden" value="<?= $csrfRegister ?>" name="csrfRegister">
        <button type="submit">Send</button>
    </form>
</main>
<?php
require_once __DIR__ . '/./includes/footer.php';