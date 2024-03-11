<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["token"])) {
        $token = $_POST["token"];

        $headers = array();
        $headers[] = "x-auth-token: $token";

        $url = "http://localhost/Token_rest_api/getAllProducts.php";

        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($client);

        if(curl_errno($client)){
            echo 'Erreur curl : ' . curl_error($client);
        }

        curl_close($client);

        if (!$response) {
            echo "Erreur : Aucune réponse de l'API.";
        } else {
            $results = json_decode($response);

            if (is_array($results) || is_object($results)) {
                echo "<h2>Résultats de l'API :</h2>";
                echo "<table>";
                foreach($results as $result) {
                    echo "<tr><td>product_id:</td><td>$result->product_id</td></tr>";
                    echo "<tr><td>product_name:</td><td>$result->product_name</td></tr>";
                    echo "<tr><td>product_description:</td><td>$result->product_description</td></tr>";
                    echo "<tr><td>dossier:</td><td>$result->dossier</td></tr>";
                    echo "<tr><td>category_id:</td><td>$result->category_id</td></tr>";
                    echo "<tr><td>in_stock:</td><td>$result->in_stock</td></tr>";
                    echo "<tr><td>price:</td><td>$result->price</td></tr>";
                    echo "<tr><td>brand:</td><td>$result->brand</td></tr>";
                    echo "<tr><td>nbr_image:</td><td>$result->nbr_image</td></tr>";
                    echo "<tr><td>date_added:</td><td>$result->date_added</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Erreur : La réponse de l'API n'est pas dans un format valide.";
            }
        }
    } else {
        echo "Erreur : Token non fourni.";
    }
}
?>
