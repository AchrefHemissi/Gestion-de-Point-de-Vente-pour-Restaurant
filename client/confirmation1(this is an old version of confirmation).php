<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if the necessary POST variables are set
    if (isset($_POST['creditCardNumber']) && isset($_POST['securityCode'])) {
        
        // Retrieve credit card information from POST
        $creditCardNumber = $_POST['creditCardNumber'];
        $securityCode = $_POST['securityCode'];
        
        // Validate credit card information (you might want to implement more robust validation)
        if (!empty($creditCardNumber) && !empty($securityCode)) {
            
            // Database connection parameters
            $servername = "localhost";
            $username = 'root';
            $password = '';
            $dbname = "if0_36253541_glicious";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute query to check if the provided credit card information is correct
            $sql = "SELECT * FROM cartebancaire WHERE numero = ? AND code = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute( [$creditCardNumber, $securityCode]);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $quer="update cartebancaire set montant=montant-".$_SESSION['total']." where numero=".$creditCardNumber;
                $stmtq = $conn->prepare($quer);
                $stmtq->execute();
                // Credit card information is correct
                // Proceed with placing the order
                // For example, you can insert the order into the database or perform any other necessary actions
                // You should adjust this query according to your database schema
                $sql = "SELECT count(*) AS total
                        FROM commande";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                 // Fetch total from t  he result set
                    $row = $result->fetch_assoc();
                    $totalligne = $row["total"];
                } else {
                    $totalligne = 0;
                }

                $id_client=2; //test
                $date_commande=date("Y-m-d");
                
                $etat="en cours";

                $orderSql = "INSERT INTO commande (id, id_client, date_commande, lieu, etat) VALUES (?, ?, ?,?,?)";
                $orderStmt = $conn->prepare($orderSql);
                $orderStmt->execute([$totalligne+1, $id_client, $date_commande, 'null', $etat]);
                
                $ordproductSql = "INSERT INTO ordproduit (id_commande, id_produit, quantite) VALUES (?, ?, ?)";
                $ordproductStmt = $conn->prepare($ordproductSql); 
                foreach ($_SESSION['cart'] as $id => $item) {
                    $ordproductStmt->execute([$totalligne+1, $item['id'], $item['quantity']]);
                }
                
                echo "Payment successful.";

                /*if ($orderStmt->execute()) {
                    // Order placed successfully
                    echo "Payment successful.";
                    // You can redirect the user to a thank you page or display a success message
                } else {
                    // Error in placing order
                    echo "Error: " . $orderSql . "<br>" . $conn->error;
                }
*/ // hedha juste verification ama tw nkar7ou ba3d
                $orderStmt->close();
            } else {
                // Credit card information is incorrect
                $_SESSION['payment_message'] = "Invalid credit card information.";
                header("Location: payment.php");
                exit();
            }

            // Close statement and database connection
            $stmt->close();
            $conn->close();
            
        } else {
            // Credit card information not provided
            echo "Please provide valid credit card information.";
        }
        
    } else {
        // Required POST variables not set
        echo "Error: Required POST variables not set.";
    }
    
} else {
    // Form not submitted using POST method
    echo "Error: Form not submitted using POST method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    <?php if (isset($orderSql)) { 
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
        ?>
        <p>Order placed successfully.</p>
        <button onclick="location.href='home.html'">Return to Home</button>
    <?php } ?>
</body>
</html>
