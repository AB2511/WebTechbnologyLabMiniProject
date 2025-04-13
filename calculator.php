<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Price Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        input {
            padding: 10px;
            margin: 5px;
        }
        .calculator {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 0 auto;
        }
        .calculator input {
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Online Bookstore Price Calculator</h2>

<div class="calculator">
    <input type="number" id="bookPrice" placeholder="Enter Book Price" />
    <input type="number" id="quantity" placeholder="Enter Quantity" />
    <button onclick="calculateTotal()">Calculate Total Price</button>
    
    <h3 id="result"></h3>
</div>

<script>
function calculateTotal() {
    var price = document.getElementById("bookPrice").value;
    var quantity = document.getElementById("quantity").value;

    if (price && quantity) {
        var total = price * quantity;
        var tax = total * 0.10; // Assuming 10% tax
        var finalAmount = total + tax;
        document.getElementById("result").innerHTML = 
            "Total: $" + total + "<br>Tax (10%): $" + tax + "<br>Final Amount: $" + finalAmount;
    } else {
        alert("Please enter both price and quantity.");
    }
}
</script>

</body>
</html>
