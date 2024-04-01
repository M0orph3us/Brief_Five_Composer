<?php
require_once __DIR__ . '/./includes/header.php';
?>
<main>
    <div class="opening-days-container">
        <h1>Opening Days</h1>
        <div class="opening-days">
            <?php if (!empty($getOpeningDay)) {
                foreach ($getOpeningDay as $key => $value) {
                    $day = $getOpeningDay[$key]->getOpening_day();
                    $morningOpening = $getOpeningDay[$key]->getMorning_opening_hour();
                    $morningClosing = $getOpeningDay[$key]->getMorning_closing_hour();
                    $eveningOpening = $getOpeningDay[$key]->getEvening_opening_hour();
                    $eveningClosing = $getOpeningDay[$key]->getEvening_closing_hour();

                    echo "<h3> $day </h3>";
                    echo "<p> Morning : $morningOpening - $morningClosing <p> ";
                    echo "<p> Evening : $eveningOpening - $eveningClosing <p> ";
                }
            } ?>
        </div>
    </div>
</main>
<?php
require_once __DIR__ . '/./includes/footer.php';