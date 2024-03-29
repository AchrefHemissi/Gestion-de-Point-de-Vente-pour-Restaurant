<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login/index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css" />
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="logo.png" class="icone" />
</head>

<body>
  <div class="sidebar">
    <div class="logo-details"></div>
    <ul class="nav-links">
      <li>
        <a href="#" onclick="showDashboard()">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="showCustomers()">
          <i class="bx bx-box"></i>
          <span class="links_name">Customers</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="showOrders()">
        <i class="bx bx-list-check"></i>
          <span class="links_name">Orders</span>
        </a>
      </li>
      <li class="log_out" id="logOutButton">
        <a href="logout.php">
          <i class="bx bx-log-out"></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class="bx bx-menu sidebarBtn"></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="profile-details">
        <img src="admin.jpg" alt="" />
        <span class="admin_name">Admin</span>
        <i class="bx bx-chevron-down"></i>
      </div>
    </nav>
    <div class="home-content">
      <div class="sales-boxes" id="salesBoxes">
        <div class="recent-sales box moving">
          <div class="title">Recent Orders</div>
          <?php
          $serveur = 'localhost';
          $utilisateur = 'root';
          $motdepasse = '';
          $base_de_donnees = 'if0_36253541_glicious';
          $con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
          if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
          }
          $sql = "SELECT * FROM commande";
          $result = mysqli_query($con, $sql);
          echo "<ul>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . "Order ID : " . $row['id'] . " - " . "Client ID: " . $row['id_client'] . " - " . "Date: " . $row['date_commande'] . "</li>";
          }
          echo "</ul>";
          mysqli_close($con);
          ?>
        </div>
        <div class="top-sales box moving">
          <div class="title">Top Selling Products</div>
          <ul class="top-sales-details">
            <?php
            $serveur = 'localhost';
            $utilisateur = 'root';
            $motdepasse = '';
            $base_de_donnees = 'if0_36253541_glicious';
            $con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
            if (!$con) {
              die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM produit order by vendu desc limit 3 ";
            $result = mysqli_query($con, $sql);
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<li>" . $row['name'] . " : " . $row['vendu'] . " units" . "</li>";
            }
            echo "</ul>";
            mysqli_close($con);
            ?>
          </ul>
        </div>
      </div>
      <div class="chartcontainer center moving">
        <div class="chart">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
    <div class="customers-list moving" id="customersList" style="display: none">
      <?php
      $serveur = 'localhost';
      $utilisateur = 'root';
      $motdepasse = '';
      $base_de_donnees = 'if0_36253541_glicious';
      $con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
      if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
      };
      $sql = "SELECT * FROM utilisateur";
      $result = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="customer">';
        echo '<div class="customer-info">';
        echo '<span class="info-label">First Name:</span>';
        echo '<span class="info-value"> ' . $row['prenom'] . ' </span>';
        echo '<span class="info-label">Last Name:</span>';
        echo '<span class="info-value"> ' . $row['nom'] . ' </span>';
        echo '</div>';
        echo '<button class="ban-button" onclick="ban(this)">Ban</button>';
        echo '</div>';
      }
      mysqli_close($con);
      ?>
    </div>
    <div class="orders-list" id="ordersList" style="display: none">
    <?php
$serveur = 'localhost';
$utilisateur = 'root';
$motdepasse = '';
$base_de_donnees = 'if0_36253541_glicious';
$con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
};
$sql = "SELECT c.id as cid, u.nom as lname, u.prenom as fname, p.name as prod, o.quantite as quan FROM commande c
            Join utilisateur u on u.id=c.id_client
            Join ordproduit o on o.id_commande=c.id
            Join produit p on p.id=o.id_produit 
            order by c.id asc";
$res = mysqli_query($con, $sql);

$orders = [];
while ($row = mysqli_fetch_assoc($res)) {
  $orders[$row["cid"]][] = $row;
}

foreach ($orders as $orderId => $products) {
  echo "<div class='order'>";
  echo "<h2>Order Number: " . $orderId . "</h2>";
  foreach ($products as $product) {
    echo "<li>Customer: " . $product["fname"] . " " . $product["lname"] . " Product: " . $product["prod"] . " Quantity bought: " . $product["quan"] . "</li>";
  }
  echo "</div>";
}

mysqli_close($con);
?>
    </div>



  </section>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
  <script src="admin.js"></script>
  
  <script>
    const ctx = document.getElementById('myChart');
    let chart;
    function updateChart(){
    fetch('fetchChart.php')
    .then(response => response.json())
    .then(data => {
      if(chart){
      chart.data.datasets[0].data = data;
      chart.update();
    }
  
  else{

  chart = new Chart(ctx, {
    type : 'bar',
    data: {
    labels : ["Pizza","Spaghetti","Tiramisu","Cheese Cake","Hamburger","Chawarma","Fried Chicken","Fries","Orange Juice","Detox"],
    datasets: [{
        label: 'Chart',
        data: data,
        backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)',
      'rgba(255, 99, 132, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(255, 159, 64, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)',
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 159, 64)'

    ],
    borderWidth: 0.7,
    barThickness:50
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  }
);
  }})
};
  updateChart();
  setInterval(updateChart,2000);
  </script>
</body>

</html>