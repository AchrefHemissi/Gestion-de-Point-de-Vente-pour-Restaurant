<?php
session_start();
require_once 'connexionBD.php';
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if the necessary POST variables are set
    if (isset($_POST['creditCardNumber']) && isset($_POST['securityCode'])) {
        
        // Retrieve credit card information from POST
        $creditCardNumber = $_POST['creditCardNumber'];
        $securityCode = $_POST['securityCode'];
        
        // Validate credit card information (you might want to implement more robust validation)
        if (!empty($creditCardNumber) && !empty($securityCode)) {

            try {
                // Create connection
                $conn = connexionBD::getInstance();

                // Prepare and execute query to check if the provided credit card information is correct
                $stmt = $conn->prepare("SELECT * FROM cartebancaire WHERE numero = ? AND code = ?");
                $stmt->execute([$creditCardNumber, $securityCode]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    // Credit card information is correct
                    // Proceed with placing the order

                    // Get total number of orders
                    $orderStmt = $conn->query("SELECT count(*) AS total FROM commande");
                    $totalligne = $orderStmt->fetch(PDO::FETCH_ASSOC)['total'];

                    $id_client = $_SESSION['user_id']; //test
                    $date_commande = date("Y-m-d");
                    $etat = "en cours";

                    // Insert into commande table
                    $orderSql = "INSERT INTO commande (id, id_client, date_commande, lieu, etat) VALUES (?, ?, ?,?,?)";
                    $orderStmt = $conn->prepare($orderSql);
                    $orderStmt->execute([$totalligne + 1, $id_client, $date_commande, $_SESSION['address'], $etat]);

                    // Insert into ordproduit table
                    $ordproductSql = "INSERT INTO ordproduit (id_commande, id_produit, quantite) VALUES (?, ?, ?)";
                    $ordproductStmt = $conn->prepare($ordproductSql); 

                    // update colonne vendu de la table produit

                    $updateProduitSql = "UPDATE produit SET vendu = vendu + ? WHERE id = ?";
                    $updateProduitStmt = $conn->prepare($updateProduitSql);

                    foreach ($_SESSION['cart'] as $id => $item) {
                        $ordproductStmt->execute([$totalligne + 1, $item['id'], $item['quantity']]);
                        $updateProduitStmt->execute([$item['quantity'], $item['id']]);
                    }
                    
                    // Update montant in cartebancaire table
                    $quer = "UPDATE cartebancaire SET montant=montant-? WHERE numero=?";
                    $stmtq = $conn->prepare($quer);
                    $stmtq->execute([$_SESSION['total'], $creditCardNumber]);

                    // Success message
                    echo "Payment successful.";
                } else {
                    // Credit card information is incorrect
                    $_SESSION['payment_message'] = "Invalid credit card information.";
                    header("Location: payment.php");
                    exit();
                }
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                $_SESSION['payment_message'] = $e->getMessage();
                header("Location: payment.php");
                exit();
            }

            // Close database connection
            $conn = null;
            
        } else {
            // Credit card information not provided
            $_SESSION['payment_message'] = "please provide valide info.";
            header("Location: payment.php");
            exit();
        }
        
    } else {
        // Required POST variables not set
        echo "Error: Required POST variables not set.";
        header("Location: home.php");
    }
    
} else {
    // Form not submitted using POST method
    echo "Error: Form not submitted using POST method.";
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap");
        body {
            font-family: "Montserrat", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        button {
            padding: 10px 20px;
            background-color:  #e1691e;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        p{
            font-size: 20px;
            font-family

        }
    </style>
    <title>Confirmation</title>
</head>
<body>
    <?php if (isset($orderSql)) { 
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
       // $_SESSION['cart']=array();
        //$_SESSION['total']=0;
        ?>
        <p>Order placed successfully.</p>
        <button onclick="location.href='home.php'">Return to Home</button>
    <?php } ?>
</body>
</html>
