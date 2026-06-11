<?php
session_start();

include '../connnect.php';

$sql = "SELECT * FROM library_visitors";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Cards</title>
    <link rel="stylesheet" href="../CSS/cards-list.css">
</head>
<body>

    <div class="container">
        <a href="../ADMIN/admin-dashboard.php" class="back-btn">x</a>
        <h1>Library Cards</h1>
        <button class="add-btn" onclick="openModal()">+ Add User</button>
        <div class="table-wrap">
            <table border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Library Card</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="cardTableBody">
                </tbody>

            </table>
        </div>    
    </div>

    <!-- Alerts -->
     <?php
        $popupMessage = "";
        $popupType = "";

        if(isset($_SESSION['success'])){
            $popupMessage = $_SESSION['success'];
            $popupType = "success";
            unset($_SESSION['success']);
        }
        if(isset($_SESSION['error'])){
            $popupMessage = $_SESSION['error'];
            $popupType = "error";
            unset($_SESSION['error']);
        }
    ?>

    <?php if(!empty($popupMessage)): ?>
        <div id="alertPopup" class="popup-overlay">
            <div class="popup-box <?php echo $popupType; ?>">
                <button class="popup-close" onclick="closePopup()">&times;</button>
                <h3><?php echo $popupType == 'success' ? 'Success' : 'Error'; ?></h3>
                <p><?php echo $popupMessage; ?></p>
                <button class="popup-ok" onclick="closePopup()">OK</button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modals: Delete and Add -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete this card?</p>
            <button class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
            <button class="delete-btn" onclick="confirmDeleteAction()">Delete</button>
        </div>
    </div>

    <div id="addCardModal" class="modal">
        <div class="modal-content">
                <button class="close-btn" onclick="closeModal()">&times;</button>
                <h3>Add New Card</h3>
            <form action="card-add.php" method="POST">
                <label for="card">Card Number</label>
                <input type="text" id="card" name="card" placeholder="e.g., 202320" required><br><br>
                <div>
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="addd-btn">Add Card</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function closePopup() {
            document.getElementById('alertPopup').style.display = 'none';
        }

        // add
        function openModal() {
            document.getElementById('addCardModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addCardModal').style.display = 'none';
        }

        // delete
        let cardToDelete = null;
        function confirmDelete(cardId){
            cardToDelete = cardId;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal(){
            cardToDelete = null;
            document.getElementById('deleteModal').style.display = 'none';
        }

        function confirmDeleteAction(){
            if (cardToDelete) {
                window.location.href = `card-delete.php?id=${cardToDelete}`;
            }
        }
    </script>
    <script>

        function loadCards() {

            fetch("card-data.php")
            .then(response => response.text())
            .then(data => {

                document.getElementById("cardTableBody").innerHTML = data;

            })
            .catch(error => console.error(error));

        }

        // refresh every 2 seconds
        setInterval(loadCards, 2000);

        </script>
</body>
</html>