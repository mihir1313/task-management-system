<div id="addUserModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Add New User</h2>
        <form id="addUserForm">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="hidden" id="hid" name="hid">
                    <input type="text" id="name" name="name" placeholder="Enter name" class="custom-input">
                </div>
                <div class="form-group">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" id="designation" name="designation" placeholder="Enter designation" class="custom-input">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter email" class="custom-input">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" class="custom-input">
                </div>
            </div>
            <div class="button-group">
                <button type="button" class="cancel-button" id="cancelButton">Cancel</button>
                <button type="submit" class="add-button" style="height: 40px;width:140px;">Add User</button>
            </div>
        </form>
    </div>
</div>
