<?php
require_once __DIR__ . '/./includes/header.php';
if (empty($_SESSION['adminIsConnected']) || $_SESSION['adminIsConnected'] !== true) {
    header('Location:' . URL_HOMEPAGE);
    exit;
}
?>
<main>
    <div class="admin-container">
        <h1>Adminboard</h1>
        <div class="btnAdmin-container">
            <button type="button" id="btn-teams">Staff</button>
            <button type="button" id="btn-reservations">Reservations</button>
            <button type="button" id="btn-assign">Assign Staffs/Reservations</button>
        </div>
        <div class="teams-container" id="teams-container">
            <table border="1">
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </tr>
                <?php
                foreach ($allteams as $value) {
                    $firstnameTeam = $value->getFirstname();
                    $lastnameTeam = $value->getLastname();
                    echo "
                    <tr>
                        <td>$firstnameTeam</td>
                        <td>$lastnameTeam</td>
                    </tr>";
                } ?>
            </table>
        </div>
        <div class="reservations-container" id="reservations-container">
            <h2>Reservations With Staff Assigned</h2>
            <div class="reservation-with-teams-container">
                <?php
                foreach ($allReservationsWithTeams as $value) {
                    $date = $value['formated_date'];
                    $firstnameReservationsWithTeams = $value['user_firstname'];
                    $lastnameReservationsWithTeams = $value['user_lastname'];
                    $numberOfPersonsReservationsWithTeams = $value['number_of_persons'];
                    $babyChairWithTeams = $value['baby_chair'];
                    $firstnameStaff = $value['team_firstname'];
                    $lastnameStaff = $value['team_lastname'];
                    echo " <div class='cards-with-teams-container'>
                            <h4> Reserved on : $date</h4>
                            <p>$firstnameReservationsWithTeams $lastnameReservationsWithTeams</p>
                            <p>Numbers of persons : $numberOfPersonsReservationsWithTeams</p>
                            <p>Baby chair : $babyChairWithTeams</p>
                            <p>Seated in the section of : $firstnameStaff $lastnameStaff</p>
                        </div>";
                } ?>
            </div>
            <h2>Reservations Without Staff Assigned</h2>
            <div class="reservation-without-teams-container">
                <?php
                foreach ($allReservationsWithoutTeams as $value) {
                    $date = $value['formated_date'];
                    $firstnameReservationsWithoutTeams = $value['firstname'];
                    $lastnameReservationsWithoutTeams = $value['lastname'];
                    $numberOfPersonsReservationsWithoutTeams = $value['number_of_persons'];
                    $babyChair = $value['baby_chair'];
                    echo "<div class='cards-without-teams-container'>
                            <h4> Reserved on : $date</h4>
                            <p>$firstnameReservationsWithoutTeams $lastnameReservationsWithoutTeams</p>
                            <p>Numbers of persons : $numberOfPersonsReservationsWithoutTeams</p>
                            <p>Baby chair : $babyChair</p>
                        </div>
                ";
                } ?>
            </div>
        </div>
        <div class="assign-container" id="assign-container">
            <form action="#" method="post">
                <label for="select-teams">Select the staff : </label>
                <select name="select-teams" id="select-teams">
                    <?php
                    foreach ($allteams as $value) {
                        $firstnameTeam = $value->getFirstname();
                        $lastnameTeam = $value->getLastname();
                        $uuidTeams = $value->getUuid();

                        echo "<option value=$uuidTeams>$firstnameTeam $lastnameTeam</option> ";
                    } ?>
                </select>
                <label for="select-reservations">Select Reservation</label>
                <select name="select-reservations" id="select-reservations">
                    <?php
                    foreach ($allReservationsWithoutTeams as $value) {
                        $uuidReservation = $value['uuid'];
                        $lastnameUser = $value['lastname'];
                        $dateReservation = $value['formated_date'];
                        $seatReservation = $value['number_of_persons'];

                        echo "<option value=$uuidReservation>" . $dateReservation . " " . $lastnameUser . " " . $seatReservation . "P </option> ";
                    } ?>
                </select>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</main>
<?php
require_once __DIR__ . '/./includes/footer.php';