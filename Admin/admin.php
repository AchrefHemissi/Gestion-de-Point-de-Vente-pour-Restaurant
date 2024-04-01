<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login/index.php");
  exit;
}
require_once 'connexionAdminDB.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css?v=1.4" />
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
      <li>
        <a href="#" onclick="showMessages()">
          <i class="bx bx-message"></i>
          <span class="links_name">Messages</span>
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
        <img src="logo.png" alt="" />
        <span class="admin_name">Admin</span>
        <i class="bx bx-chevron-down"></i>
      </div>
    </nav>
    <div class="home-content">
      <div class="sales-boxes" id="salesBoxes">

        <div class="top-sales box moving">
          <div class="title"><b>Top Selling Products</b></div>
          <ul class="top-sales-details" id="product-list">
          </ul>

        </div>
        <div class="totalCustomers moving">
          <div style="text-align:center;font-size:22px"><b>Total Customers</b></div>
          <div class="sales-details">

          </div>


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
      $con = Database::getInstance();
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
        if ($row['etat'] == 1) {
          echo '<button class="ban-button" style="background-color:green" data-id="' . $row['id'] . '">Unban User</button>';
        } else {
          echo '<button class="ban-button" data-id="' . $row['id'] . '">Ban User</button>';
        }
        echo '</div>';
      }
      mysqli_close($con);
      ?>
    </div>
    <div class="orders-list moving" id="ordersList" style="display: none">

    </div>

    </div>
    <div class="email-form" style=display:none id="emailForm">
      <form action="sendEmail.php" method="post">
        <label for="recipient">Recipient:</label><br>
        <input type="email" id="recipient" name="recipient" required><br>
        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subject" required><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br>
        <input type="submit" value="Send Email">
      </form>
    </div>



  </section>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
  <script src="admin.js?v=1.4"></script>

  <script>
    const ctx = document.getElementById('myChart');
    let chart;

    function updateChart() {
      fetch('fetchChart.php')
        .then(response => response.json())
        .then(data => {
          if (chart) {
            chart.data.datasets[0].data = data;
            chart.update();
          } else {

            chart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["Pizza", "Spaghetti", "Tiramisu", "Cheese Cake", "Hamburger", "Chawarma", "Fried Chicken", "Fries", "Orange Juice", "Detox"],
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
                  barThickness: 50
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          }
        })
    };
    updateChart();
    setInterval(updateChart, 2000);
  </script>


  <script>
    async function fetchOrders() {
      const response = await fetch('get_order.php');
      const orders = await response.json();

      // Clear the current orders
      document.querySelector('.orders-list').innerHTML = '';

      // Loop over the orders and display them
      for (let orderId in orders) {
        let firstOrderItem = orders[orderId][0];
        let customerName = firstOrderItem.fname + ' ' + firstOrderItem.lname;
        let cdate = firstOrderItem.cdate;
        let num = firstOrderItem.unum_tel;
        let lieu = firstOrderItem.clieu;

        let orderHTML = `
                <div class="order" style="display:block" data-id="${orderId}">
                    <div class="order-info">
                        <span class="info-label">Order ID:&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value">${orderId}&nbsp;&nbsp;&nbsp;</span><br>
                        <span class="info-label">Customer :&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value">${customerName}&nbsp;&nbsp;&nbsp;</span><br>
                        <span class="info-label">Customer number :&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value">${num}&nbsp;&nbsp;&nbsp;</span><br>
                        <span class="info-label">location :&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value">${lieu}&nbsp;&nbsp;&nbsp;</span><br>
                        <span class="info-label">Date :&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value">${cdate}&nbsp;&nbsp;&nbsp;</span><br>

                    </div>
            `;

        orders[orderId].forEach(orderItem => {
          let productName = orderItem.prod;
          let quantity = orderItem.quan;
          orderHTML += `
                    <div class="order-item">
                        <span class="info-label">Product :&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value">${productName}&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-label">Quantity :&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value">${quantity}&nbsp;&nbsp;&nbsp;</span>
                    </div>
                `;
        });

        orderHTML += `<button class="done-button">Pending</button></div>`;
        document.querySelector('.orders-list').insertAdjacentHTML('beforeend', orderHTML);
      }
      document.querySelectorAll('.done-button').forEach(button => {
        button.addEventListener('click', function() {
          var orderDiv = this.parentElement;
          var orderId = orderDiv.getAttribute('data-id');

          var formData = new FormData();
          formData.append('id', orderId);

          fetch('update_order.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(data => {

            });

          orderDiv.style.display = 'none';
        });
      });

    }

    // Fetch orders every 5 seconds
    fetchOrders();
    setInterval(fetchOrders, 5000);
  </script>

  <script>
    async function calcCustomers() {
      const response = await fetch('calculate_customers.php');
      const data = await response.text();
      console.log(data);
      document.querySelector('.sales-details').innerHTML = `<p style="font-size: 40px;">${data}</p>`;
    }
    calcCustomers();
    setInterval(calcCustomers, 5000);
  </script>


  <script>
    function fetchProducts() {
      fetch('top_selling.php')
        .then(response => response.json())
        .then(data => {
          const productList = document.getElementById('product-list');
          productList.innerHTML = '';
          data.forEach(product => {
            const listItem = document.createElement('li');
            listItem.innerHTML = `<b>${product.name} </b>${product.vendu} unit`;
            productList.appendChild(listItem);
          });
        });
    }

    // Fetch products every 5 seconds
    fetchProducts();
    setInterval(fetchProducts, 5000);
  </script>


</body>

</html>