const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const userName = urlParams.get('username');

function removeURLParameter(paramKey) {
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    params.delete(paramKey);
    window.history.replaceState({}, '', `${url.pathname}?${params.toString()}`);
}

if(urlParams.has('errorMessage')) {
    alert('Mật khẩu không chính xác !');
    removeURLParameter('errorMessage');

}

let api = "http://localhost:8080/FinalWeb/update-salesperson-first-password.php";

if(urlParams.has('id')) {
    api = `http://localhost:8080/FinalWeb/update-salesperson-first-password.php?id=${urlParams.get('id')}`;
}

const form = document.querySelector(".login form");

form.action = api;
