<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Riwaq – Order</title>
<link rel="stylesheet" href="style.css" />
</head>

<body>

<header>
  <h1>
    <img src="Riwaq.jpg" alt="Riwaq Logo" height="36">
    Riwaq
  </h1>
  <nav>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="menu.html">Menu</a></li>
      <li><a href="order.php">Order</a></li>
      <li><a href="contact.html">Contact</a></li>
    </ul>
  </nav>
</header>

<main style="padding:20px;">
  <h2 id="welcome">Welcome, <?php echo $username; ?>!</h2>

  <form id="orderForm" onsubmit="return false;">
    <label for="name">Your Name:</label><br />
    <input type="text" id="name"
           value="<?php echo $username; ?>"
           readonly /><br /><br />

    <label for="product">Select Product:</label><br />
    <select id="product" required>
      <option value="">--Select--</option>
    </select><br /><br />

    <label for="qty">Quantity:</label><br />
    <input type="number" id="qty" min="1" value="1" /><br /><br />

    <button type="button" id="addOrderBtn">Add Order</button>
    <button type="button" id="submitBtn">Submit All Orders</button>
  </form>

  <h3 style="margin-top:25px;">🧾 Your Orders:</h3>
  <ul id="orderList" style="font-size:17px;"></ul>

  <div id="totalBox" style="margin-top:10px; font-size:18px;">
    <b>Total: </b><span id="totalAmount">SAR 0.00</span>
  </div>

  <div id="summary" style="margin-top:20px; font-size:18px; color:#5c3d2e;"></div>
</main>

<script>
const PRODUCTS = [
  { name: "Latte", price: 14 },
  { name: "Cappuccino", price: 15 },
  { name: "Espresso", price: 10 },
  { name: "Americano", price: 12 },
  { name: "Mocha", price: 16 },
  { name: "Macchiato", price: 15 },
  { name: "Spanish Latte", price: 18 },
  { name: "Iced Coffee", price: 12 },
  { name: "Hot Chocolate", price: 14 },
  { name: "Matcha Latte", price: 19 }
];

function populateSelect() {
  const select = document.getElementById("product");
  PRODUCTS.forEach(item => {
    const opt = document.createElement("option");
    opt.value = item.name;
    opt.textContent = item.name;
    select.appendChild(opt);
  });
}

let orders = [];
let total = 0;
const fmt = v => "SAR " + Number(v).toFixed(2);

function updateTotalBox() {
  document.getElementById("totalAmount").textContent = fmt(total);
}

document.getElementById("addOrderBtn").addEventListener("click", function(){
  const name = document.getElementById("name").value.trim();
  const productName = document.getElementById("product").value;
  const qty = parseInt(document.getElementById("qty").value, 10) || 0;

  if (name === "" || productName === "" || qty <= 0) {
    alert("Please enter your name, choose a product, and set quantity ≥ 1.");
    return;
  }

  const found = PRODUCTS.find(p => p.name === productName);
  const unit = found ? found.price : 0;
  const lineTotal = unit * qty;

  orders.push({ product: productName, quantity: qty });

  const li = document.createElement("li");
  li.textContent = qty + " × " + productName;
  document.getElementById("orderList").appendChild(li);

  total += lineTotal;
  updateTotalBox();

  document.getElementById("product").value = "";
  document.getElementById("qty").value = 1;
});

document.getElementById("submitBtn").addEventListener("click", function(){
  if (orders.length === 0) {
    alert("You didn’t add any orders yet!");
    return;
  }

  const name = document.getElementById("name").value.trim();
  let summaryText = "Thanks, <b>" + name + "</b>!<br>Your orders:<br>";

  orders.forEach((o, i) => {
    summaryText += (i + 1) + ". " + o.quantity + " × " + o.product + "<br>";
  });

  summaryText += "<br><b>Total: " + fmt(total) + "</b>";
  document.getElementById("summary").innerHTML = summaryText;

  alert("Your order list has been submitted successfully!");
});

document.addEventListener("DOMContentLoaded", populateSelect);
</script>

</body>
</html>
