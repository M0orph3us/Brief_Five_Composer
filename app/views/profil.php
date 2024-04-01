<?php
require_once __DIR__ . '/./includes/header.php';
if (empty($_SESSION['userIsConnected']) || $_SESSION['userIsConnected'] !== true) {
    header('Location:' . URL_HOMEPAGE);
    exit;
}
// debug($_SESSION);
?>
<main>
    <div class="profil-container">
        <h1>Profil</h1>
        <div class="btn-profil-container">
            <button id="btn-my-reservations">My Reservations</button>
            <button id="btn-edit-profil">My Profil</button>
        </div>
        <div class="my-reservation-container" id="my-reservation-container">
            <h2>My Reservations</h2>
            <div class="cards-my-reservations-container">
                <?php if (!empty($getReservationByUser)) {
                    foreach ($getReservationByUser as $value) {
                        $reservedOn = $value->getReserved_on();
                        $numberOfPersons = $value->getNumber_of_persons();
                        $babyChair = $value->getBaby_chair();

                        echo "<div class='cards-my-reservations'>
                                <h3>Reserved on : $reservedOn</h3>
                                <p>Number of persons : $numberOfPersons</p>
                                <p>Baby chair : $babyChair</p>
                            </div>";
                    }
                } ?>
            </div>
        </div>
        <div class="my-profil-container" id="my-profil-container">
            <h2>My Profil</h2>
            <div class="my-profil-card">
                <?php if (!empty($userProfil)) {
                    $firstname = $userProfil->getFirstname();
                    $lastname = $userProfil->getLastname();
                    $mail = $userProfil->getMail();
                    echo "
                        <p>Firstname : $firstname </p>
                        <p>Lastname : $lastname </p>
                        <p>Mail : $mail </p>
                        ";
                } ?>
            </div>
            <div class="edit-my-profil">
                <form action="<?= URL_UPDATEPROFIL ?>" method="POST">
                    <label for="firstnameUpdate">Firstname : </label>
                    <input type="text" name="firstnameUpdate" id="firstnameUpdate" placeholder="<?= $firstname ?>">

                    <label for="lastnameUpdate">Lastname : </label>
                    <input type="text" name="lastnameUpdate" id="lastnameUpdate" placeholder="<?= $lastname ?>">

                    <label for="mailUpdate">Mail : </label>
                    <input type='email' name="mailUpdate" id="mailUpdate" placeholder="<?= $mail ?>">

                    <label for="passwordUpdate">Password : </label>
                    <input type="password" name="passwordUpdate" id="passwordUpdate">

                    <label for="confirmPasswordUpdate">Confirm password : </label>
                    <input type="password" name="confirmPasswordUpdate" id="confirmPasswordUpdate">

                    <input type="hidden" name="csrfUpdate" value="<?= $csrfUpdate ?>">
                    <button type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
require_once __DIR__ . '/./includes/footer.php';