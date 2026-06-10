function closePopup() {
    document.getElementById('alertPopup').style.display = 'none';
}

// add
function openModal() {
    document.getElementById('addAdminModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('addAdminModal').style.display = 'none';
}

// delete
let adminToDelete = null;
function confirmDelete(admin_id){
    adminToDelete = admin_id;
    document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal(){
    adminToDelete = null;
    document.getElementById('deleteModal').style.display = 'none';
}

function confirmDeleteAction(){
    if (adminToDelete) {
        window.location.href = `admin-delete.php?id=${adminToDelete}`;
    }
}

// edit
function openEditModal(admin_id, username) {
    admin_id = parseInt(admin_id);

    if (isNaN(admin_id)) {
        alert("Invalid admin ID");
        return;
    }

    document.getElementById('edit_admin_id').value = admin_id;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_password').value = "";
    document.getElementById('editAdminModal').style.display = 'block';
}

function closeEditModal(){
    document.getElementById('editAdminModal').style.display = 'none';
}