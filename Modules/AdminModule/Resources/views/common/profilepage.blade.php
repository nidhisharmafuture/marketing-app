@extends('adminmodule::layouts.app')

@section('content')
<style>
    .form-field { margin-bottom: 20px; }
    .custom_uplaod_photo { display: flex; align-items: center; gap: 20px; }
    .upload_photo img { border-radius: 50%; width: 120px; height: 120px; object-fit: cover; border: 2px solid #ddd; }
    .photo_action { display: flex; flex-direction: column; gap: 10px; }
    .photo_action input[type="file"] { display: block; }
    .remove_photo { background-color: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; }
    .admin-theme-btn { background-color: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; }
    .clear_btn { background-color: #95a5a6; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; }
    h3 { margin-top: 30px; margin-bottom: 20px; }
    label em { color: red; }
    .text-danger { color: red; font-size: 13px; }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="right-content-wrapper">
    <div class="card_block">
        <h3>General Settings</h3>
        <div class="card_block_body">
            <div class="row">
                <input id="adminId" value="{{ $admin->id }}" type="hidden">
                <input id="imageref" value="0" type="hidden">

                <div class="col-md-12 form-field">
                    <div class="custom_uplaod_photo">
                        <div class="upload_photo">
                            @if ($admin->image)
                                <img src="{{ asset('admin/' . $admin->image) }}" id="output" alt="Admin Image" />
                            @else
                                <img src="{{ url('public/superadmin/img/profile_img.png') }}" id="output" />
                            @endif
                        </div>
                        <div class="photo_action">
                            <input id="fileInput" type="file" name="fileInput" onchange="loadFile(event)" />
                            <button type="button" class="remove_photo" onclick="removeImage()">Remove Image</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 form-field">
                    <label>Name:<em>*</em></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}">
                    <span id="nameError" class="text-danger"></span>
                </div>

                <div class="col-md-6 form-field">
                    <label>Email:<em>*</em></label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}">
                    <span id="emailError" class="text-danger"></span>
                </div>

                <div class="col-md-6 form-field">
                    <label>Mobile No:<em>*</em></label>
                    <input type="text" name="phone" id="phone" class="form-control"
                           value="{{ $admin->phone }}" maxlength="10"
                           oninput="checkMobile(this.value)"
                           onkeypress="return /[0-9]/i.test(event.key)">
                    <span id="phoneError" class="text-danger"></span>
                </div>

                <div class="col-md-6 form-field">
                    <label class="m-blank">&nbsp;</label><br>
                    <button type="submit" id="updateprofilebtn" class="admin-theme-btn">Update Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Section -->
    <div class="card_block">
        <h3>Change Password</h3>
        <div class="card_block_body">
            <div class="row">
                <div class="col-md-6 form-field">
                    <label>Current Password<em>*</em></label>
                    <input type="password" name="currentpassword" id="currentpassword" class="form-control">
                    <span id="currentpasswordError" class="text-danger"></span>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6 form-field">
                    <label>New Password<em>*</em></label>
                    <input type="password" name="newpassword" id="newpassword" class="form-control">
                    <span id="newpasswordError" class="text-danger"></span>
                </div>
                <div class="col-md-6 form-field">
                    <label>Confirm New Password<em>*</em></label>
                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                    <span id="confirmpasswordError" class="text-danger"></span>
                </div>
                <div class="col-md-12 form-field text-end">
                    <span id="notmtachError" class="text-danger"></span>
                    <button type="submit" class="admin-theme-btn" id="passwordchange">Update Password</button>
                    <button type="button" class="clear_btn ms-4" onclick="clearPasswordFields()">Clear</button>
                </div>
            </div>
        </div>
    </div>

   
</div>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };
</script>


<script>

    
    // Profile Image Preview
    function loadFile(event) {
        const output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        document.getElementById('imageref').value = "1";
    }

    function removeImage() {
        const output = document.getElementById('output');
        output.src = "{{ url('public/superadmin/img/profile_img.png') }}";
        document.getElementById('fileInput').value = '';
        document.getElementById('imageref').value = "0";
    }

    // Phone validation
    function checkMobile(value) {
        const error = document.getElementById('phoneError');
        if (!/^\d{10}$/.test(value)) {
            error.innerText = "Enter a valid 10-digit mobile number.";
        } else {
            error.innerText = "";
        }
    }

    // Clear password fields
   
</script>

<script>
    // 🔁 Update Profile Info
  const userRole = {{ auth()->user()->role }}; 

     function clearPasswordFields() {
        document.getElementById('currentpassword').value = "";
        document.getElementById('newpassword').value = "";
        document.getElementById('confirmpassword').value = "";
        document.getElementById('currentpasswordError').innerText = "";
        document.getElementById('newpasswordError').innerText = "";
        document.getElementById('confirmpasswordError').innerText = "";
        document.getElementById('notmtachError').innerText = "";
    }
   document.getElementById('updateprofilebtn').addEventListener('click', function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('adminId', document.getElementById('adminId').value);
    formData.append('name', document.getElementById('name').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('phone', document.getElementById('phone').value);

    const fileInput = document.getElementById('fileInput');
    if (fileInput.files.length > 0) {
        formData.append('image', fileInput.files[0]);
    }
       // Determine route prefix
    const baseRoute = userRole === 1 ? 'admin' : 'designer';

    fetch(`/${baseRoute}/update-profile`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            toastr.success('Profile updated successfully!');
            setTimeout(() => location.reload(), 1500); // Slight delay before refresh
        } else {
            toastr.error(data.message || 'Update failed!');
        }
    })
    .catch(err => {
        console.error('Error:', err);
        toastr.error('An error occurred!');
    });
});
    // 🔒 Change Password
 document.getElementById('passwordchange').addEventListener('click', function (e) {
    e.preventDefault();

    // Clear old messages
    document.getElementById('currentpasswordError').innerText = '';
    document.getElementById('newpasswordError').innerText = '';
    document.getElementById('confirmpasswordError').innerText = '';
    document.getElementById('notmtachError').innerText = '';

    const payload = {
        currentpassword: document.getElementById('currentpassword').value,
        newpassword: document.getElementById('newpassword').value,
        confirmpassword: document.getElementById('confirmpassword').value,
    };

    // Check if passwords match before sending the request
    if (payload.newpassword !== payload.confirmpassword) {
        document.getElementById('notmtachError').innerText = 'New password and confirmation password do not match.';
        return;
    }
    const baseRoute = userRole === 2 ? 'designer' : 'admin';

    // Send the request to the server
    fetch(`/${baseRoute}/update-profile`, {
  
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',  // Ensure the server knows we are sending JSON
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
        },
        body: JSON.stringify(payload) // Send the payload as JSON
    })
    .then(res => {
        // Log the response status to check if it's 200 or not
        console.log('Response status:', res.status);

        // Check if the response is OK (status 200-299)
        if (!res.ok) {
            // If the status code is not OK, throw an error with the status
            throw new Error(`Server responded with status ${res.status}`);
        }

        // Try to parse the JSON response
        return res.json();
    })
    .then(data => {
        if (data.success) {
            // If the update is successful, show a success message
            toastr.success('Password updated successfully!');
            clearPasswordFields();
            setTimeout(() => location.reload(), 1500);
        } else if (data.errors) {
            // If the server returns validation errors, display them on the page
            if (data.errors.currentpassword) {
                document.getElementById('currentpasswordError').innerText = data.errors.currentpassword[0];
            }
            if (data.errors.newpassword) {
                document.getElementById('newpasswordError').innerText = data.errors.newpassword[0];
            }
            if (data.errors.confirmpassword) {
                document.getElementById('confirmpasswordError').innerText = data.errors.confirmpassword[0];
            }

            toastr.error('Please correct the errors and try again.');
        } else {
            // If there's any other response message, show it as an error
            toastr.error(data.message || 'Password update failed.');
        }
    })
    .catch(err => {
        // Log the error and show a more detailed error message
        console.error('Error:', err);
        toastr.error('Something went wrong: ' + err.message);
    });
});



</script>

@endsection
