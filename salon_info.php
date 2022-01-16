<?php
if (isset($_GET['id'])) {
    require_once 'config.php';
    require_once 'connection.php';
    require_once 'salons_functions.php';


    $data = get('salon_data', $_GET['id']);
    if (isset($_GET['registration_data'])) {
        $arrayData = json_decode($_GET['registration_data'], true);
    }
}
ob_start();
?>

<section>
    <div>
        <article class="salonData">
            <header><?php echo $data['title'] ?></header>
            <div> <?php echo $data['address'] ?></div>
            <div> <?php echo $data['email'] ?></div>
            <div> <?php echo $data['open_hours'] ?></div>
            <div> <?php echo $data['animals'] ?></div>
        </article>
        <img id="salon-img" src=<?= $data['img_url'] ?>></img>
    </div>

    <article>
        <form id="salonForm" action=" salons_functions.php?action=newRegistration" method="POST">
            <fielsdet>
                <div><label>Vardas:</label>
                    <input type="text" name="first_name" value='<?php echo $arrayData['first_name'] ?? ''; ?>'>
                </div>

                <div><label>Pavardė:</label>
                    <input type="text" name="last_name" value='<?php echo $arrayData['last_name'] ?? ''; ?>'>
                </div>

                <div><label>Gyvūno/-ų vardas/-ai:</label>
                    <input type="text" name="animal_name" value='<?php echo $arrayData['animal_name'] ?? ''; ?>'>
                </div>

                <div><label>Elektroninio pašto adresas:</label>
                    <input type="text" name="email" value='<?php echo $arrayData['email'] ?? ''; ?>'>
                </div>

                <div><label>Data:</label>
                    <input type="date" name="date" value='<?php echo $arrayData['date'] ?? ''; ?>'>
                </div>

                <div><label>Laikas:</label>
                    <input type="time" name="time" value='<?php echo $arrayData['time'] ?? ''; ?>'>
                </div>

                <div><label>Paslauga:</label>
                    <select name="services" id="service">
                        <option value="haircut"> Kirpimas</option>
                        <option value="hairdress"> Sušukavimas </option>
                        <option value="nail_cut"> Nagų kirpimas </option>
                        <option value="ear_cleaning"> Ausų išvalymas </option>
                        <option value="eye_cleaning"> Akių valymas </option>
                        <option value="day_care"> Dienos priežiūra </option>
                </div>

                <input type="submit" class="button_submit" value="Patvirtinti">

                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            </fielsdet>
            <?php $arrayData = [];

            if (isset($_GET['message']) && isset($_GET['status'])) {

                echo "<div class='erorMessage'>{$_REQUEST['message']}</div>";
            }
            ?>


        </form>
    </article>
</section>


<?php
$mainClass = "salonPage";
$content = ob_get_contents();
ob_end_clean();
require_once('salon_app.php');
?>