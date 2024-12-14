let checkout = () => {
  // Get Total Amount
  let totalAmountElement = document.getElementById("totalAmount");
  let totalAmountText = totalAmountElement.textContent;
  let amount = totalAmountText.replace("Total Bill : UGX ", "").trim();

  // Prepare an array to hold order details for each item in the cart
  let orderDetails = [];

  // Gather information for each item in the cart
  let images = document.querySelectorAll(".img");
  let names = document.querySelectorAll(".name");
  let unitPrices = document.querySelectorAll(".unit-price");
  let quantities = document.querySelectorAll(".quantity");
  let itemTotalPrices = document.querySelectorAll(".item-total-price");

  // Loop through items and collect data
  images.forEach((img, index) => {
    let item = {
      imgSrc: img.src,
      name: names[index].textContent.trim(),
      unitPrice: unitPrices[index].textContent.replace("UGX ", "").trim(),
      quantity: quantities[index].textContent.trim(),
      itemTotalPrice: itemTotalPrices[index].textContent.replace("UGX ", "").trim(),
    };
    orderDetails.push(item);
  });

  // Prepare the data to be sent in the request
  let data = {
    totalAmount: amount,
    items: orderDetails,
  };

  // Send data to PHP
  fetch("order.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data), // Convert data to JSON string
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Order placed successfully!");
        clearCart(); // Clear cart after successful order
      } else {
        alert("Failed to place order.");
      }
    })
    .catch((error) => console.error("Error:", error));
};
