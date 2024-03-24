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
  }

  function showDashboard() {
    document.getElementById("customersList").style.display = "none";
    document.getElementById("salesBoxes").style.display = "flex";
  }

 