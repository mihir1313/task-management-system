<div id="addTaskModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeTaskModal">&times;</span>
        <h2>Add New Task</h2>
        <form id="addTaskForm">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="taskName" class="form-label">Task Name</label>
                    <input type="hidden" id="hid" name="hid" value="">
                    <input type="text" id="taskName" name="taskName" placeholder="Enter task name"
                        class="custom-input" required readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="details" class="form-label">Details</label>
                    <textarea id="editor" placeholder="Enter task details" readonly></textarea>
                </div>
            </div>

            <!-- Date and Priority on the same line -->
            <div class="form-row" style="display: flex; justify-content: space-between;">
                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" id="date" name="date" class="custom-input" style="height:36px;" readonly required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label for="priority" class="form-label">Priority</label>
                    <select id="priority" name="priority" class="custom-input" required disabled>
                        <option value="" disabled selected>Select priority</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
            </div>

            <!-- Assign To and Process on the next line -->
            <div class="form-row" style="display: flex; justify-content: space-between; margin-top: 10px;">
                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label for="assign" class="form-label">Assign To</label>
                    <select id="assign" name="assign" class="custom-input" required disabled>
                        <option value="{{ Auth::user()->id; }}" selected>{{ Auth::user()->name; }}</option>
                    </select>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label for="process" class="form-label">Process</label>
                    <select id="process" name="process" class="custom-input" required>
                        <option value="" disabled selected>Select process</option>
                        <option value="Inprogress">Inprogress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>

            <!-- Button group -->
            <div class="button-group" style="margin-top: 20px; gap: 5px;">
                <button type="button" class="cancel-button" id="cancelTaskButton">Cancel</button>
                <button type="submit" class="add-button" style="height: 41px;width:140px;">Add Task</button>
            </div>
        </form>
    </div>
</div>
