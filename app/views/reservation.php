<?php
require_once __DIR__ . '/./includes/header.php';
?>
<main>
    <div class="reservation-container">
        <h1>Reservation</h1>
        <form action="#" method="post">
            <label for="number-of-person">Number of persons : </label>
            <input type='number' name="number-of-person" id="number-of-person">

            <label for="chair-baby">Baby chair : </label>
            <select name="chair-baby" id="chair-baby">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>

            <label for="reserved-on">Reserve on : </label>
            <input type='date' name="reserved-on" id="reserved-on">

            <input type="hidden" name="csrfReservation" value="<?= $csrfReservation ?>">
            <button type="submit">Send</button>
        </form>
    </div>

</main>
<?php
require_once __DIR__ . '/./includes/footer.php';