const loggingForm = document.getElementById("logging-form");
const libraryInput = document.getElementById("library-card-input");
const statusBox = document.getElementById("status-box");
const userName = document.getElementById("user-name");
const errorMsg = document.getElementById("error-msg");

loggingForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const cardID = libraryInput.value.trim();

    //REQUIRED FORMAT: LIB-123456
    const validFormat = /^LIB-\d{6}$/;

    //INVALID INPUT
    if (!validFormat.test(cardID)) {
        errorMsg.style.display = "block";
        statusBox.classList.add("hidden");
        return;
    }

    //VALID INPUT
    errorMsg.style.display = "none";
    statusBox.classList.remove("hidden");

    userName.textContent = cardID;

   
    let logs = JSON.parse(localStorage.getItem("libraryLogs")) || [];

    //CREATE NEW
    const newLog = {
        type: "Visitor",
        name: cardID,
        time: new Date().toLocaleString()
    };

    //ADD SA LOGS
    logs.push(newLog);

    //SAVE BACK TO LOCAL STORAGE(LOCAL LANG waley pa database)
    localStorage.setItem("libraryLogs", JSON.stringify(logs));

    //CLEAR INPUT
    libraryInput.value = "";

    
    setTimeout(() => {
        //REDIRECT TO DASHBOARD
        window.location.href = "../VISITOR/visitor-dashboard.html";
    }, 800);
});