const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const userName = urlParams.get('username');

let api = "http://localhost:8080/api-phone-system-mangement/ProductCatalog/update-product.php?id=" + userName;

const form = document.querySelector(".login form");

form.action = api;
