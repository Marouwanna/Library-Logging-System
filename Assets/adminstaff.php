<?php
session_start();

include '../connnect.php';

$sql = "SELECT * FROM staff";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
    <link rel="stylesheet" href="../CSS/staff-list.css">
</head>
<body>

    <div class="container">
        <a href="../ADMIN/admin-dashboard.php" class="back-btn">x</a>
        <h1>Admin List</h1>
        <button class="add-btn" onclick="openModal()">+ Add User</button>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="adminTableBody">
            </tbody>

        </table>
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

    <!-- Modals: Edit, Delete and Add -->

    <div id="editAdminModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeEditModal()">&times;</button>
            <h3>Edit User</h3>
            <form action="admin-edit.php" method="POST">
                <input type="hidden" id="edit_admin_id" name="admin_id">
                        
                <label for="edit_username">Username</label>
                <input type="text" id="edit_username" name="username" placeholder="Admin2"><br><br>

                <label for="edit_password">Password</label>
                <input type="password" name="password" id="edit_password"><br>
                <input class="check-box" type="checkbox" id="showPass" onclick="togglePasswordCheckbox()"> Show Password
                <br><br>
                <div>
                    <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="addd-btn">Update Admin</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeDeleteModal()">&times;</button>
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete this admin?</p>
            <button class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
            <button class="delete-btn" onclick="confirmDeleteAction()">Delete</button>
        </div>
    </div>

    <div id="addAdminModal" class="modal">
        <div class="modal-content">
                <button class="close-btn" onclick="closeModal()">&times;</button>
                <h3>Add New Admin</h3>
            <form action="admin-add.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="e.g., Admin1" required><br><br>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required><br><br>
                <div>
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="addd-btn">Add Admin</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../JS/admin-staff.js"></script>

    <script>
    function loadAdmins() {
        fetch("admin-data.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("adminTableBody").innerHTML = data;
        });
    }

    setInterval(loadAdmins, 2000);
    </script>

    

</body>
</html>