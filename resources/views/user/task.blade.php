@extends('user.layouts.index')
@section('user-title', 'User | Task')
@section('user-header')
<link rel="stylesheet" href="{{ asset('assets/admin/css/task.css') }}">
@endsection

@section('user-content')
<div class="create-user-container">
    <div class="sub-header">
        <div>
            <h1>Manage Task</h1>
            <p class="sub-text">Check Your daily Tasks and Schedule</p>
        </div>
    </div>

    {{--  <div class="task-full-card mb-4">
        <div class="task-full-card-body">
            <h3>Today s Task</h3>
            <p>Check your daily tasks and schedule</p>
            <button class="add-button" style="margin-top: 15px;">Add New &nbsp; <svg width="24" height="25" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.0032 17.0322H13.0032V13.0322H17.0032V11.0322H13.0032V7.03223H11.0032V11.0322H7.00317V13.0322H11.0032V17.0322ZM5.00317 21.0322C4.45317 21.0322 3.98234 20.8364 3.59067 20.4447C3.19901 20.0531 3.00317 19.5822 3.00317 19.0322V5.03223C3.00317 4.48223 3.19901 4.01139 3.59067 3.61973C3.98234 3.22806 4.45317 3.03223 5.00317 3.03223H19.0032C19.5532 3.03223 20.024 3.22806 20.4157 3.61973C20.8073 4.01139 21.0032 4.48223 21.0032 5.03223V19.0322C21.0032 19.5822 20.8073 20.0531 20.4157 20.4447C20.024 20.8364 19.5532 21.0322 19.0032 21.0322H5.00317ZM5.00317 19.0322H19.0032V5.03223H5.00317V19.0322Z"
                        fill="white" />
                </svg></button>
        </div>
        <div class="task-full-card-image">
            <img src="{{ asset('assets/common/images/task.png') }}" alt="Daily Task">
        </div>
    </div>  --}}

    <div class="header-container">
        <div class="task-info" style="margin-top: 10px;">
            <h1>All Task ({{ count($tasks['data']) }})</h1>
            <h1>Completed ({{ count($completedTasks) }})</h1>
        </div>
        <div class="filter-info" style="margin-bottom: 10px;">
            <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.31616 12.2731V10.2731H11.3162V12.2731H7.31616ZM3.31616 7.27307V5.27307H15.3162V7.27307H3.31616ZM0.316162 2.27307V0.273071H18.3162V2.27307H0.316162Z" fill="white"/>
                </svg>
            <label for="priority">Filter By Priority:</label>
        </div>
    </div>
    <div class="task-row">
        
    @if (!empty($tasks))
        @foreach ($tasks['data'] as $key =>$value)
            
        <div class="task-card">
            <div class="task-card-header">
                <h3>{{ $value['title'] }}</h3>
                <div class="task-options">
                    <span class="three-dots" onclick="toggleDropdown(event)">•••</span>
                    <div class="dropdown-menu task-actions-dropdown" style="display: none;">
                        <ul>
                            <li onclick="editTask({{ $value['id'] }})">Edit</li>
                            {{--  <li onclick="deleteTask({{ $value['id'] }})">Delete</li>  --}}
                        </ul>
                    </div>
                </div>
            </div>
            {!! $value['description'] !!}
            <p class="task-date"><svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.86501 9.92571V8.38725H11.5573V9.92571H3.86501ZM3.86501 13.0026V11.4642H9.24962V13.0026H3.86501ZM2.32655 16.0796C1.90347 16.0796 1.54129 15.9289 1.24001 15.6276C0.938727 15.3264 0.788086 14.9642 0.788086 14.5411V3.77187C0.788086 3.34879 0.938727 2.98661 1.24001 2.68533C1.54129 2.38405 1.90347 2.23341 2.32655 2.23341H3.09578V0.694946H4.63424V2.23341H10.7881V0.694946H12.3265V2.23341H13.0958C13.5189 2.23341 13.881 2.38405 14.1823 2.68533C14.4836 2.98661 14.6342 3.34879 14.6342 3.77187V14.5411C14.6342 14.9642 14.4836 15.3264 14.1823 15.6276C13.881 15.9289 13.5189 16.0796 13.0958 16.0796H2.32655ZM2.32655 14.5411H13.0958V6.84879H2.32655V14.5411Z" fill="#A3A3A3"/>
                </svg>
                {{$value['date']}}</p>
            <div class="hello">
                <div class="left-side">
                    <img src="{{ asset('/images/profiles/admin.webp') }}" alt="Profile Image" class="profile-image">
                    <span>Assign by Admin</span>
                </div>
                <div class="right-side">
                    <span style="">Priority:</span>
                    <span class="task-badge priority @if($value['priority'] == 'low') low @elseif($value['priority'] == 'medium') medium @elseif($value['priority'] == 'high') high @endif">
                        @if ($value['priority'] == 'low')
                        Low
                    @elseif ($value['priority'] == 'medium')
                        Medium
                    @elseif ($value['priority'] == 'high')
                        High
                    @endif
                    </span>
                </div>
            </div>

        </div>
        @endforeach
        
        @else
        
        @endif
    </div>
    
    @if (count($tasks['data']) > 0)
    <div class="pagination">
        @if ($tasks['current_page'] > 1)
            <a href="{{ $tasks['prev_page_url'] }}" class="prev-btn">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12L6 8L10 4" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        @endif
    
        @for ($i = 1; $i <= $tasks['last_page']; $i++)
            <a href="{{ $tasks['path'] }}?page={{ $i }}" class="{{ $i == $tasks['current_page'] ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor
    
        @if (isset($tasks['next_page_url']) && $tasks['next_page_url'] !== null)
            <a href="{{ $tasks['next_page_url'] }}" class="next-btn">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 4L10 8L6 12" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        @endif
    </div>
    @endif
    
</div>
    @endsection
    
    @section('user-footer')
    @include('user.modal.taskModal')
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } from 'ckeditor5';

        ClassicEditor
            .create( document.querySelector( '#details' ), {
                plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script>

    let editorInstance; 

    function toggleDropdown(event) {
        event.stopPropagation();
        
        const dropdownMenu = event.target.nextElementSibling;
        
        if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
            dropdownMenu.style.display = 'block'; 
        } else {
            dropdownMenu.style.display = 'none'; 
        }
    }

const addTaskModal = document.getElementById('addTaskModal');
const addButton = document.querySelector('.add-button'); 
const closeTaskModal = document.getElementById('closeTaskModal');
const cancelTaskButton = document.getElementById('cancelTaskButton');

addButton.addEventListener('click', function() {
    addTaskModal.style.display = 'block';
});

closeTaskModal.addEventListener('click', function() {
    addTaskModal.style.display = 'none';
});

cancelTaskButton.addEventListener('click', function() {
    addTaskModal.style.display = 'none';
});

window.onclick = function(event) {
    if (event.target === addTaskModal) {
        addTaskModal.style.display = 'none';
    }
};
document.addEventListener('DOMContentLoaded', () => {
    let editorInstance;

    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            editorInstance = editor; 
        })
        .catch(error => {
            console.error(error);
        });
        
        addTaskModal.addEventListener('shown.bs.modal', function() {
            if (!editorInstance) {
                ClassicEditor.create(document.querySelector('#editor'))
                    .then(editor => {
                        editorInstance = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });

        addTaskModal.addEventListener('hidden.bs.modal', function() {
            document.getElementById('addTaskForm').reset(); 
        });
    document.getElementById('addTaskForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        const taskDetails = editorInstance.getData();
        if (!taskDetails) {
            alert('Task details are required.');
            return; 
        }

        const taskData = {
            taskName: document.getElementById('taskName').value,
            assign: document.getElementById('assign').value,
            process: document.getElementById('process').value,
            details: taskDetails, 
            date: document.getElementById('date').value,
            priority: document.getElementById('priority').value,
        };

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let apiUrl = '/api/task/insert'; 
        let methodType = 'POST';

        const hid = document.getElementById('hid').value;
        if (hid) {
            apiUrl = `/api/task/update/${hid}`; 
            methodType = 'PUT';
        }

        fetch(apiUrl, {
            method: methodType,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(taskData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                addTaskModal.style.display = 'none';
                document.getElementById('addTaskForm').reset();
                editorInstance.setData(''); 
                document.getElementById('hid').value = ''; 
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

function editTask(taskId) {
    const userId = taskId;
    const token = localStorage.getItem("authToken");
    const accessToken = token ? token : null;

    if (!accessToken) {
        console.error("No access token found. Please log in.");
        return;
    }
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/api/task/edit/${userId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${accessToken}`,
            'X-CSRF-TOKEN': csrfToken
        },
    })
    .then(response => {
        console.log(response);
        return response.json();
    })
    .then(data => {
        console.log('Task data retrieved successfully:', data); 
        const taskActionDropdown = document.querySelector('.task-actions-dropdown');

        taskActionDropdown.style.display = 'none';
        document.getElementById('hid').value = data.id; 
        document.getElementById('taskName').value = data.title; 
        console.log(editorInstance);
        if (editorInstance) {

            editorInstance.setData(data.description);
            editorInstance.insertHtml(data.description);
                editorInstance.insertText(data.description);  

        }   
        document.getElementById('date').value = data.date; 

        const prioritySelect = document.getElementById('priority');
        prioritySelect.value = data.priority; 

        const assignSelect = document.getElementById('assign');
        assignSelect.value = data.assigned_to; 

        const processSelect = document.getElementById('process');
        processSelect.value = data.process;

        const addTaskModal = document.getElementById('addTaskModal'); 
        addTaskModal.style.display = 'block';
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}

function deleteTask(taskId) {
    const userId = taskId;
    const token = localStorage.getItem("authToken");
    const accessToken = token ? token : null;

    if (!accessToken) {
        console.error("No access token found. Please log in.");
        return;
    }
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (confirm("Are you sure you want to delete this task?")) {
        fetch(`/api/task/delete/${userId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${accessToken}`,
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.status == "success") {
                alert(data.message);
                location.reload();
            } else {
                alert("Failed to delete task");
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>
@endsection
