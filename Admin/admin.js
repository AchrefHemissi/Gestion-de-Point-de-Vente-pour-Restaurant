let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
  function showCustomers() {
    document.getElementById("customersList").style.display = "block";
    document.getElementById("salesBoxes").style.display = "none";
    document.getElementById("ordersList").style.display="none";
    document.querySelector(".chartcontainer").style.display="none";
    document.getElementById("emailForm").style.display = "none";
  }

  function showDashboard() {
    document.getElementById("customersList").style.display = "none";
    document.getElementById("ordersList").style.display="none";
    document.getElementById("salesBoxes").style.display = "flex";
    document.querySelector(".chartcontainer").style.display="flex";
    document.getElementById("emailForm").style.display = "none";
  }
  function showOrders()
  {
    document.getElementById("customersList").style.display = "none";
    document.getElementById("ordersList").style.display="block";
    document.getElementById("salesBoxes").style.display = "none";
    document.querySelector(".chartcontainer").style.display="none";
    document.getElementById("emailForm").style.display = "none";
  }
  function showMessages()
  {
    document.getElementById("customersList").style.display = "none";
    document.getElementById("ordersList").style.display="none";
    document.getElementById("salesBoxes").style.display = "none";
    document.querySelector(".chartcontainer").style.display="none";
    document.getElementById("emailForm").style.display = "flex";
  }


  // Select all ban buttons
  document.querySelectorAll('.ban-button').forEach(button => {
    button.addEventListener('click', function() {
        var userId = this.getAttribute('data-id'); // Ensure that userId is being correctly retrieved

        var formData = new FormData();
        formData.append('id', userId);

        fetch('ban.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Toggle the button color based on the new status
            if (data == 1) {
                button.style.backgroundColor = "green";
                button.textContent = "Unban User";
            } else {
                button.style.backgroundColor = "";
                button.textContent = "Ban User";
            }
        });
    });
});

document.querySelectorAll('.done-button').forEach(button => {

button.addEventListener('click',function(){

  var orderDiv=this.parentElement.parentElement;
  var orderId = orderDiv.getAttribute('data-id');

        var formData = new FormData();
        formData.append('id', orderId);

        fetch('update_order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Handle the response from the server...
        });
  orderDiv.style.display='none';

})


})
  


