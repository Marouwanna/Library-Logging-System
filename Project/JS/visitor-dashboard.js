const logs = JSON.parse(localStorage.getItem("libraryLogs")) || [];

const visitors = logs.filter(log => log.type === "Visitor");

const latest = visitors[visitors.length - 1];

const id = latest ? latest.name : "Unknown";

document.getElementById("welcome-text").innerHTML =
    "Welcome to the library!<br>Visitor " + id;