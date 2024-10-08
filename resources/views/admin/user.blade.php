@extends('admin.layouts.index')
@section('admin-title', 'Admin | User')

@section('admin-header')
<link rel="stylesheet" href="{{ asset('assets/admin/css/user.css') }}">
@endsection

@section('admin-content')
    <div class="create-user-container">
        <div class="sub-header">
            <div>
                <h1>Create User</h1>
                <p class="sub-text">Create user</p>
            </div>
            <button class="add-button">Add New &nbsp; <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2175_784" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="25"
                        height="25">
                        <rect x="0.00317383" y="0.0322266" width="24" height="24" fill="#D9D9D9" />
                    </mask>
                    <g mask="url(#mask0_2175_784)">
                        <path
                            d="M11.0032 17.0322H13.0032V13.0322H17.0032V11.0322H13.0032V7.03223H11.0032V11.0322H7.00317V13.0322H11.0032V17.0322ZM5.00317 21.0322C4.45317 21.0322 3.98234 20.8364 3.59067 20.4447C3.19901 20.0531 3.00317 19.5822 3.00317 19.0322V5.03223C3.00317 4.48223 3.19901 4.01139 3.59067 3.61973C3.98234 3.22806 4.45317 3.03223 5.00317 3.03223H19.0032C19.5532 3.03223 20.024 3.22806 20.4157 3.61973C20.8073 4.01139 21.0032 4.48223 21.0032 5.03223V19.0322C21.0032 19.5822 20.8073 20.0531 20.4157 20.4447C20.024 20.8364 19.5532 21.0322 19.0032 21.0322H5.00317ZM5.00317 19.0322H19.0032V5.03223H5.00317V19.0322Z"
                            fill="white" />
                    </g>
                </svg>
            </button>
        </div>

        <div class="table-section">
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($users) && $users > 0)
                        <div id="parentContainer">
                            @foreach ($users['data'] as $key => $value)
                                <div class="userRecord">
                                    <tr>

                                        <td data-label="Sr No.">{{ isset($value['id']) ? $value['id'] : '' }}</td>
                                        <td data-label="Name">{{ isset($value['name']) ? $value['name'] : '' }}</td>
                                        <td data-label="Designation">
                                            {{ isset($value['designation']) ? $value['designation'] : '' }}</td>
                                        <td data-label="Email">{{ isset($value['email']) ? $value['email'] : '' }}</td>
                                        <td data-label="Action">
                                            <a href="javascript:void(0)" class="editButton" id="editButton"
                                                data-id="{{ $value['id'] }}"><svg width="32" height="32"
                                                    viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.576782" y="0.308472" width="31.0493" height="31.0493"
                                                        rx="4" fill="#F2F5F7" />
                                                    <path
                                                        d="M9.27615 18.4104L8.35847 22.3709C8.32682 22.5157 8.3279 22.6657 8.36165 22.81C8.3954 22.9543 8.46096 23.0893 8.55354 23.205C8.64612 23.3207 8.76338 23.4143 8.89676 23.4789C9.03013 23.5435 9.17626 23.5775 9.32445 23.5784C9.39351 23.5854 9.46309 23.5854 9.53214 23.5784L13.5168 22.6607L21.1674 15.0391L16.8977 10.7792L9.27615 18.4104Z"
                                                        fill="#00A2D9" />
                                                    <path
                                                        d="M23.5721 11.2236L20.7225 8.37393C20.5351 8.18753 20.2816 8.08289 20.0173 8.08289C19.753 8.08289 19.4995 8.18753 19.3121 8.37393L17.7279 9.95813L21.9927 14.2229L23.5769 12.6387C23.6696 12.5455 23.7431 12.435 23.793 12.3134C23.8429 12.1918 23.8684 12.0616 23.868 11.9301C23.8675 11.7987 23.8412 11.6686 23.7904 11.5474C23.7396 11.4262 23.6654 11.3161 23.5721 11.2236Z"
                                                        fill="#00A2D9" />
                                                </svg>
                                            </a> 
                                            <a href="javascript:void(0)" class="deleteButton" id="deleteButton"
                                                data-id="{{ $value['id'] }}"><svg width="32" height="32"
                                                    viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.0626221" y="0.308472" width="31.0493" height="31.0493"
                                                        rx="4" fill="#F2F5F7" />
                                                    <path
                                                        d="M10.6567 24.7085C10.1143 24.7085 9.65002 24.5154 9.26377 24.1291C8.87752 23.7429 8.6844 23.2786 8.6844 22.7362V9.91612H7.69824V7.9438H12.629V6.95764H18.546V7.9438H23.4768V9.91612H22.4906V22.7362C22.4906 23.2786 22.2975 23.7429 21.9113 24.1291C21.525 24.5154 21.0607 24.7085 20.5183 24.7085H10.6567ZM20.5183 9.91612H10.6567V22.7362H20.5183V9.91612ZM12.629 20.7639H14.6014V11.8884H12.629V20.7639ZM16.5737 20.7639H18.546V11.8884H16.5737V20.7639Z"
                                                        fill="#FB4D24" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No users available.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if (count($users['data']) > 0)
            
        <div class="pagination">
            @if ($users['current_page'] > 1)
                <a href="{{ request()->url() }}?page={{ $users['current_page'] - 1 }}" class="prev-btn">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            @endif
        
            @for ($i = 1; $i <= $users['last_page']; $i++)
                <a href="{{ request()->url() }}?page={{ $i }}" class="{{ $i == $users['current_page'] ? 'active' : '' }}">
                    {{ $i }}
                </a>
            @endfor
        
            @if ($users['current_page'] < $users['last_page'])
                <a href="{{ request()->url() }}?page={{ $users['current_page'] + 1 }}" class="next-btn">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            @endif
        </div>
        @endif
        
    </div>
@endsection

@section('admin-footer')
    @include('admin.modal.userModal')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const ckeditors = document.querySelectorAll('.ckeditor');

            ckeditors.forEach(editor => {
                ClassicEditor
                    .create(editor)
                    .catch(error => {
                        console.error(error);
                    });
            });
            const modal = document.getElementById("addUserModal");
            const btn = document.querySelector(".add-button");
            const span = document.getElementById("closeModal");
            const cancel = document.getElementById("cancelButton");

            // Open the modal when the button is clicked
            btn.onclick = function() {
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }
            cancel.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            document.getElementById("addUserForm").onsubmit = async function(event) {
                const hid = document.getElementById('hid').value;
                event.preventDefault();

                const formData = new FormData(this);

                const formObject = {};
                formData.forEach((value, key) => formObject[key] = value);

                console.log(formObject);

                const token = localStorage.getItem("authToken");
                const accessToken = token ? token : null;

                if (!accessToken) {
                    console.error("No access token found. Please log in.");
                    return;
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {

                    let apiUrl = '/api/user/insert';
                    let methodType = 'POST';

                    if (hid) {
                        apiUrl = `/api/user/update/${hid}`;
                        methodType = 'PUT';
                    }

                    const response = await fetch(apiUrl, {
                        method: methodType, // Ensure method is set to POST
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${accessToken}`, // Include the token from localStorage
                            'X-CSRF-TOKEN': csrfToken // Add CSRF token to the request
                        },
                        body: JSON.stringify(formObject) // Send dynamic form data as JSON
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const result = await response.json(); // Assuming the response is in JSON format
                    console.log(result); // Handle the response as needed
                    alert(result.message);
                    location.reload();

                    modal.style.display = "none";
                    this.reset();

                } catch (error) {
                    console.error('There was a problem with the fetch operation:', error);
                }
            };

            const editButtons = document.getElementsByClassName('editButton');
            for (let i = 0; i < editButtons.length; i++) {
                editButtons[i].addEventListener('click', function(event) {
                    // Get the user ID from the data-id attribute
                    const userId = this.getAttribute('data-id');
                    const token = localStorage.getItem("authToken");
                    const accessToken = token ? token : null;

                    if (!accessToken) {
                        console.error("No access token found. Please log in.");
                        return;
                    }
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    // Prepare the API call
                    fetch(`/api/user/edit/${userId}`, {
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
                            console.log('User data retrieved successfully:',
                                data); // Log the actual data

                            // Fill the input fields with the data
                            document.getElementById('hid').value = data
                            .id; // Assuming 'hid' is an input for user ID
                            document.getElementById('name').value = data.name;
                            document.getElementById('designation').value = data.designation;
                            document.getElementById('email').value = data.email;
                            document.getElementById('password').value = data
                                .password; // Ensure password is handled securely

                            // Show the modal
                            modal.style.display = "block";
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                });
            }

            const deleteButtons = document.getElementsByClassName('deleteButton');
            for (let i = 0; i < deleteButtons.length; i++) {
                console.log("len", deleteButtons.length)
                deleteButtons[i].addEventListener('click', function(event) {
                    // Get the user ID from the data-id attribute
                    const userId = this.getAttribute('data-id');

                    // Confirmation dialog before deletion
                    const confirmation = confirm(`Are you sure you want to delete user with ID ${userId}?`);
                    if (!confirmation) {
                        return; // Exit if the user cancels the deletion
                    }

                    const token = localStorage.getItem("authToken");
                    const accessToken = token ? token : null;

                    if (!accessToken) {
                        console.error("No access token found. Please log in.");
                        return;
                    }
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Prepare the API call for deletion
                    fetch(`/api/user/delete/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${accessToken}`,
                                'X-CSRF-TOKEN': csrfToken
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json(); // Parse the response as JSON
                        })
                        .then(data => {
                            console.log(data); // Log the response data to the console
                            alert(data.message); // Assuming the server returns a 'message' field
                            location.reload(); // Reload the page
                            // Or, remove the user element from the DOM, e.g.:
                            // this.closest('.user-item').remove(); // Assuming each user has a container with class 'user-item'
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                });
            }

        });
    </script>
@endsection
