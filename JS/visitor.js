const loggingForm = document.getElementById("logging-form");
const libraryInput = document.getElementById("library-card-input");
const statusBox = document.getElementById("status-box");
const userName = document.getElementById("user-name");
const statusMessage = document.getElementById("status-message");
const errorMsg = document.getElementById("error-msg");

loggingForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const cardID = libraryInput.value.trim();
    const validFormat = /^\d{6}$/;

    // validation
    if (!validFormat.test(cardID)) {
        errorMsg.style.display = "block";
        errorMsg.textContent = "Please use format: 123456";
        statusBox.classList.add("hidden");
        return;
    }

    // reset error
    errorMsg.style.display = "none";

    // show loading state (before request)
    statusBox.classList.remove("hidden");
    statusMessage.textContent = "Logging your visit...";
    userName.textContent = cardID;

    fetch(loggingForm.action, {
        method: "POST",
        body: new FormData(loggingForm)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Server error: " + response.status);
        }
        return response.json();
    })
    .then(data => {

        if (data.success) {

            // show backend message (IN / OUT result)
            statusMessage.textContent = data.message;
            userName.textContent = cardID;

            // clear input
            libraryInput.value = "";

            // auto-hide after 3s
            setTimeout(() => {
                statusBox.classList.add("hidden");
            }, 3000);

        } else {

            errorMsg.textContent = data.message || "Invalid card";
            errorMsg.style.display = "block";
            statusBox.classList.add("hidden");
        }

    })
    .catch(err => {
        console.error(err);

        errorMsg.textContent = "Unable to log visit. Try again.";
        errorMsg.style.display = "block";
        statusBox.classList.add("hidden");
    });
});