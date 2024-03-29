<?php
require_once __DIR__ . '/./includes/header.php';
?>
<main>
    <div class="opening-days-container">
        <h1>Opening Days</h1>
        <div class="opening-days">
            <?php if (!empty($viewData)) {
                foreach ($viewData as $getAllOpeningModel) {
                    for ($k = 0; $k < count($getAllOpeningModel); $k++) {
                        $day = $getAllOpeningModel[$k]->getOpening_day();
                        $morningOpening = $getAllOpeningModel[$k]->getMorning_opening_hour();
                        $morningClosing = $getAllOpeningModel[$k]->getMorning_closing_hour();
                        $eveningOpening = $getAllOpeningModel[$k]->getEvening_opening_hour();
                        $eveningClosing = $getAllOpeningModel[$k]->getEvening_closing_hour();

                        echo "<h3> $day </h3>";
                        echo "<p> Morning : $morningOpening - $morningClosing <p> ";
                        echo "<p> Evening : $eveningOpening - $eveningClosing <p> ";
                    }
                }
            } ?>
        </div>
    </div>
</main>
<?php
require_once __DIR__ . '/./includes/footer.php';