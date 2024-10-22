document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const url = "/api/userslogin";
        const data = {
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        };

        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.setRequestHeader("Content-Type", "application/json");
        http.setRequestHeader("Accept", "application/json");
        http.send(JSON.stringify(data));

        http.onreadystatechange = function() {
            if (this.readyState == 4) {
                const res = JSON.parse(this.responseText);

                if (this.status === 200) {
                    window.location.href = "http://localhost:8000/panel";
                } else {
                    console.log(res.message);
                    alert(res.message || "Ocurrió un error.");
                }
            }
        };
    });
});