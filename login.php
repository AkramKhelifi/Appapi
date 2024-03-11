<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email']) && !empty($_POST['password'])) {
    $url = "http://localhost/Token_rest_api/login.php";

    $userData = array(
        "email" => $_POST['email'],
        "password" => $_POST['password']
    );

    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($userData));
    curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($client);
    $responseData = json_decode($response, true);

    curl_close($client);

    if (isset($responseData["token"])) {
        echo "Connexion réussie. Token: " . $responseData["token"];
    } else {
        echo "Erreur de connexion : " . $responseData["message"];
    }
} else {
    echo "Les données du formulaire sont incomplètes.";
}
?>
