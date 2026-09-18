<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
   Settings
<?= $this->endSection('title')?>
<?= $this->section('content')?>


<div class="settings-container container ">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header"><a href="profile" class="text-dark"><i class="fa fa-chevron-left"></i>Settings</a></div>
        <div class="sidebar-group">
            <div class="sidebar-item active" data-panel="personal">Personal details</div>
        </div>
        <div class="divider"></div>
        <div class="sidebar-group">
            <div class="sidebar-item" data-panel="phone">Add phone number</div>
            <div class="sidebar-item" data-panel="email">Change email</div>
        </div>
   
        <div class="divider"></div>
        <div class="sidebar-group">
            <div class="sidebar-item" data-panel="password">Change password</div>
            <div class="sidebar-item" data-panel="delete">Delete my account permanently</div>
            <div class="mx-3 " > <a class="text-dark " href="/">Log Out</a></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <!-- 1. Personal details -->
        <div class="panel active" id="personal">
            <div class="main-header">
                <h2>Personal details</h2>
                <span class="badge-saved">Saved</span>
            </div>
            <div class="profile-pic">
                <!-- <div><img class="avatar" src="images/campuskart_logo.png" alt=""></div> -->
                <!-- <div class="edit"><i class="fa fa-remove"></i></div> -->
            </div>
            <div class="form-container ">
                 <div class="form-group"><label>First Name*</label><input type="text" value="Jodi"></div>
                <div class="form-group"><label>Last Name*</label><input type="text" value="Mohammed"></div>
                <div class="form-group"> <label>location*</label><input type="text" placeholder="Select Location*"></div>
                <div class="form-group"><input type="date"></div>
                <div class="form-group"><label>Sex</label><input type="text" value="Do not specify"></div>
                <button class=" settings-btn">Save</button>
            </div>
           
        </div>

     
        <!-- 3. Phone -->
        <div class="panel" id="phone">
            <div class="main-header"><h2>Change Phone number</h2></div>
            <div class="form-group">
                <label>Phone*</label>
                <input type="tel" placeholder="+234 801 234 5678">
            </div>
            <button class="settings-btn">Send OTP</button>
        </div>

        <!-- 4. Email -->
        <div class="panel" id="email">
            <div class="main-header"><h2>Change email</h2></div>
            <div class="form-group">
                <label>Email*</label>
                <input type="email" placeholder="New email address">
            </div>
             <button class="settings-btn">Update Email</button>
        </div>
       
        <!-- Password -->
        <div class="panel" id="password">
            <div class="main-header"><h2>Change password</h2></div>
            <div class="form-group">
                <label>Current Password*</label>
                <input type="password" placeholder="Current password">
            </div>
            <div class="form-group">
                <label>New Password*</label>
                <input type="password" placeholder="New password">
            </div>
             <button class="settings-btn">Update Password</button>
        </div>

        <!--Delete -->
        <div class="panel " id="delete">
            <div class="main-header"><h2>Delete my account permanently</h2></div>
            <p>This action cannot be undone. All your data will be lost.</p>
             <button class="btn btn-danger">Delete Account</button>
        </div>

    
    </div>
</div>

<!-- JS SCRIPT FOR THIS PAGE  -->
<script src="<?= base_url('js/settings.js')?>"></script>

<?= $this->endSection('content')?>
