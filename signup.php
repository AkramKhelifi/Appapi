<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['designation'])) {
    $url = "http://localhost/Token_rest_api/signup.php"; 

    $userData = array(
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "age" => $_POST['age'],
        "designation" => $_POST['designation']
    );

    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($userData));
    curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($client);
    $responseData = json_decode($response, true);

    curl_close($client);

    if (isset($responseData["message"])) {
        echo $responseData["message"];
    } else {
        echo "Une erreur est survenue lors de l'inscription.";
    }
} else {
    echo "Les données du formulaire sont incomplètes.";
}
?>
