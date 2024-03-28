<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css" />
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
          <span class="links_name">Orders</span>
        </li>
        <li class="log_out" id="logOutButton">
          <a href="login/index.html">
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
            $con = mysqli_connect("sql206.infinityfree.com", "if0_36253541", "yXzYSFMPXEvr", "if0_36253541_glicious");
            if (!$con) {
              die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM commande";
            $result = mysqli_query($con, $sql);
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>". "Order ID : " . $row['id'] . " - " . "Client ID: ". $row['id_client'] . " - " . "Date: ". $row['date_commande'] . "</li>";
            }
            echo "</ul>";
            mysqli_close($con);
            ?>
          </div>
          <div class="top-sales box moving">
            <div class="title">Top Selling Products</div>
            <ul class="top-sales-details">
            <?php 
            $con = mysqli_connect("sql206.infinityfree.com", "if0_36253541", "yXzYSFMPXEvr", "if0_36253541_glicious");
            if (!$con) {
              die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM produit order by vendu desc limit 3 ";
            $result = mysqli_query($con, $sql);
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>". $row['name'] ." : ". $row['vendu']. " units". "</li>";
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
      <div
        class="customers-list moving"
        id="customersList"
        style="display: none"
      >
          <?php 
            $con = mysqli_connect("sql206.infinityfree.com", "if0_36253541", "yXzYSFMPXEvr", "if0_36253541_glicious");
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
            $con = mysqli_connect("sql206.infinityfree.com", "if0_36253541", "yXzYSFMPXEvr", "if0_36253541_glicious");
            if (!$con) {
              die("Connection failed: " . mysqli_connect_error());
            };
            $sql="SELECT c.id as cid, u.nom as lname, u.prenom as fname, o.id_produit as prod, o.quantite as quan FROM commande c
                  Join utilisateur u on u.id=c.id_client
                  Join ordproduit o on o.id_commande=c.id";
            $res=mysqli_query($con,$sql);
            while($row=mysqli_fetch_assoc($res))
            {
              echo "<li>"."Order Number: ".$row["cid"]." Customer: ".$row["fname"]." ".$row["lname"]." Product ID: ".$row["prod"]." Quantity bought: ".$row["quan"];
            }
            mysqli_close($con);
            ?>
    </div>
      


    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script src="admin.js"></script>
    <script src="chart.js"></script>
  </body>
</html>
