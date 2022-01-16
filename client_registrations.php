<?php ob_start(); ?>
<form id="login-form" action="client_registrations.php" method="GET">
    <label>Elektroninio pašto adresas:</label>
    <input type="email" name="email" value='<?php echo $_GET['email'] ?? ''; ?>'>
    <input type="submit" name="" value="Patvirtinti" class="button_submit">
</form>

<?php
$emailForm = ob_get_contents();
ob_end_clean();
?>



<?php


require_once "./connection.php";
require_once "salons_functions.php";

if (isset($_GET['email'])) {
    $clRegistrations = getClientRegistrations($_GET['email']);
    $content = getClientRegistrationHtml($clRegistrations);
} else {
    $content = $emailForm;
}
function getClientRegistrationHtml($clRegistrations)
{
    $registrationHtml = '';
    foreach ($clRegistrations as $clRegistration) {

        ob_start(); ?>
        <section class=" registration-wrap">
            <article class="registration">
                <header><?= $clRegistration['first_name'] ?></header>
                <div><?= $clRegistration['last_name'] ?></div>
                <div><?= $clRegistration['animal_name'] ?></div>
                <div><?= $clRegistration['email'] ?></div>
                <div><?= $clRegistration['date'] ?></div>
                <div><?= $clRegistration['time'] ?></div>
                <div><?= translateLT($clRegistration['service']) ?></div>
            </article>
            <aside>
                <button class="updateTime">Koreguoti</button>
                <span class="form-anchor" data-email="<?= $clRegistration['email'] ?>" data-id="<?= $clRegistration['id'] ?>" data-date="<?= $clRegistration['date'] ?>" data-time="<?= $clRegistration['time'] ?>"></span>


                <form class="delete-form" action="salons_functions.php?action=deleteRegistration" method="POST">
                    <label>Atšaukti registraciją?</label>
                    <input type="submit" name="" value="Atšaukti">
                    <input type="hidden" name="id" value=<?= $clRegistration['id'] ?>>
                    <input type="hidden" name="email" value=<?= $clRegistration['email'] ?>>
                </form>
            </aside>
        </section>
<?php
        $singleHtml = ob_get_contents();
        ob_end_clean();

        $registrationHtml .= $singleHtml;
    };
    return $registrationHtml;
};

ob_start(); ?>
<?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<span class='message'>$message</span>";
};
?>
<script>
    const buttons = document.querySelectorAll('.updateTime');
    console.log(buttons);
    buttons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            const formAnchor = button.parentElement.querySelector('.form-anchor');
            const form = formAnchor.querySelector('.update-form');
            if (!form) {
                addFormWithTemplateWay('salons_functions.php?action=updateRegistration', formAnchor);
                form = document.querySelector('update-form');
            }
        });
    });


    function addFormWithTemplateWay(action, formAnchor) {
        let formHtml = `<form class="update-form" action="${action}" method="POST">
                    <input type='date' name='date' value="${formAnchor.dataset.date}">
                    <input type='time' name='time' value="${formAnchor.dataset.time}">
                    <button type="submit">Patvirtinti</button>
                    <input type="hidden" name="id" value="${formAnchor.dataset.id}">
                    <input type="hidden" name="email" value="${formAnchor.dataset.email}">
                </form>`;

        formAnchor.insertAdjacentHTML('afterbegin', formHtml);
    }
</script>

<?php
$scriptHtml = ob_get_contents();
ob_end_clean();

$content .= $scriptHtml;
require_once('salon_app.php');
?>