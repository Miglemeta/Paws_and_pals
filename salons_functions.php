<?php
require_once 'connection.php';


const SUCCESS = 1;
const FAIL = 0;

function handleRegistration()
{
    $message = '';
    $arrayData = json_encode($_POST);
    foreach ($_POST as $key => $value) {
        if (!$value) {
            $translation = translateLT($key);
            $message .= "Užpildykite trūkstamą lauką $translation <br>";
            $status = FAIL;
        }
    }
    if (!$message) {
        $registration = [
            'salon_id' => $_POST['id'],

            'first_name' => $_POST['first_name'],

            'last_name' => $_POST['last_name'],

            'animal_name' => $_POST['animal_name'],

            'email' => $_POST['email'],

            'date' => $_POST['date'],

            'time' => $_POST['time'],

            'service' => $_POST['services'],


        ];
        create('registrations', $registration);
        $message = "Registracija sėkminga!";
        $status = SUCCESS;
        return header("Location: client_registrations.php?email={$_POST['email']}&message=$message");
    }
    return header("Location: salon_info.php?message=$message&status=$status&registration_data=$arrayData&id={$_POST['id']}");
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'newRegistration') {
        handleRegistration();
    }

    if ($_GET['action'] == 'updateRegistration') {
        updateRegistration($_POST['date'], $_POST['time'], $_POST['id']);
        return header("Location: client_registrations.php?email={$_POST['email']}");
    }
    if ($_GET['action'] == 'deleteRegistration') {
        deleteRegistration($_POST['id']);
        return header("Location: client_registrations.php?email={$_POST['email']}");
    }
};

function translateLt($key)

{
    $translate =
        [
            'fist_name' => 'Vardas',

            'last_name' => 'Pavardė',

            'animal_name' => 'Gyvūno/-ų vardas/-ai',

            'email' => 'Elektoninio pašto adresas',

            'date' => 'Data',

            'time' => 'Laikas',

            'service' => 'Paslauga',

            'haircut' => 'Kirpimas',

            'hairdress' => 'Sušukavimas',

            'nail_cut' => 'Nagų kitpimas',

            'ear_cleaning' => 'Ausų išvalymas',

            'eye_cleaning' => 'Akių valymas',

            'day_care' => 'Dienos priežiūra',


        ];
    if (isset($translate[$key])) {
        return $translate[$key];
    }
    return $key;
};

function deleteRegistration($id)
{
    delete('registrations', $id);
}
