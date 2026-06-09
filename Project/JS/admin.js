const adminForm = document.getElementById("admin-form");

adminForm.addEventListener("submit", function(event){

    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const message = document.getElementById("admin-message");

    const adminUsername = "admin";
    const adminPassword = "12345";

    if(username === adminUsername && password === adminPassword){

        // Get old logs
        let logs = JSON.parse(localStorage.getItem("libraryLogs")) || [];

        // Add admin log
        const newLog = {
            type: "Admin",
            name: username,
            time: new Date().toLocaleString()
        };

        logs.push(newLog);

        localStorage.setItem("libraryLogs", JSON.stringify(logs));

        message.textContent = "Login Successful!";
        message.style.color = "green";

        setTimeout(() => {
          window.location.href = "admin-dashboard.html";
        }, 1000);

    } else {

        message.textContent = "Invalid Username or Password";
        message.style.color = "red";

    }

});