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
            <div class="sidebar-item active" data-panel="personal">Personal Information</div>
        </div>
        <div class="divider"></div>
        <div class="sidebar-group">
            <div class="sidebar-item" data-panel="phone">Account Information</div>
            <div class="sidebar-item" data-panel="email">School Information</div>
        </div>
   
        <div class="divider"></div>
        <div class="sidebar-group">
            <div class="sidebar-item" data-panel="password">Change Password</div>
            <div class="sidebar-item" data-panel="delete">Delete my account permanently</div>
            <div class="logout-btn" > <a href="<?=base_url('logout')?>">LogOut</a></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <!-- 1. Personal Information -->
        <div class="panel active" id="personal">
            <div class="main-header">
                <h2>Personal Information</h2>
                <span class="badge-saved">Saved</span>
            </div>
            <div class="text-center  w-100" style="color:#FF8C00;">
                    <p>Saved Data**</p>
            </div>
            <form action="<?= route_to('update-profile-details') ?>" method="POST" enctype="multipart/form-data" id="UserData">
                <?= csrf_field()?>
                <div class="profile-photo">
                    <!-- Profile Avatar  -->
                    <a
                        href="javascript:;"
                        onclick="event.preventDefault();document.getElementById('user_profile_file').click();"
                        class="edit-avatar"> <i class="fa fa-pencil"> </i>
                    </a>
                    <input type="file" name="avatar" id="user_profile_file" class="d-none" style="opacity: 0;">
                    <img  src="<?= base_url($user->avatar)?>" class="avatar-photo ci-avatar-photo"  id="avatarPhoto"alt="">
                </div>
                <div class="form-container ">  
                    
                    <div class="form-group"><label>First Name*</label>
                        <input type="text" name="first_name" value="<?= esc($user->first_name)?>">
                    </div>
                    <span class="settings-error text-danger" id="first_name_error"></span>


                    <div class="form-group"><label>Last Name*</label>
                        <input type="text" name="last_name" value="<?= esc($user->last_name)?>">
                    </div>
                    <span class="settings-error text-danger" id="last_name_error"></span>

                    <div class="form-group"><label>Bio*</label>
                        <textarea name="bio" id="" ><?= esc($user->bio)?></textarea>
                    </div>
                    <span class="settings-error text-danger" id="bio_error"></span>

                    <button type="submit" class=" settings-btn">Save</button>
                </div>
            </form>
            </div>

     
        <!-- Account Information -->
        <div class="panel" id="phone">
            <form action="<?= route_to('update-account-information') ?>" method="POST"  id="AccountInformationForm">
                    <?= csrf_field()?>
                <div class="main-header"><h2>Account Information</h2></div>
                <div class="form-group">
                    <label>Username*</label>
                    <input type="text" name="username" value="<?= esc($user->username)?>">
                </div>
                <span class="settings-error text-danger" id="username_error"></span>
                
                <div class="form-group">
                    <label>Email*</label>
                    <input type="text" name="email" value="<?= esc($user->email)?>">
                </div>
                <span class="settings-error text-danger" id="email_error"></span>

                <div class="form-group">
                    <label>Phone*</label>
                    <input type="tel" name="phone" value="<?= esc($user->phone)?>">
                </div>
                <span class="settings-error text-danger" id="phone_error"></span>


                <button type='submit' class="settings-btn">Update</button>
            </form>
        </div>

        <!-- School Information -->
        <div class="panel" id="email">
            <form action="<?= route_to('update-school-information') ?>" method="POST" id="SchoolInformationForm">
                <?= csrf_field()?>
                <div class="main-header"><h2>School Information</h2></div>
                <div class="form-group">
                    <label>State*</label>
                    <select name="state_id" id="state_id">
                        <option value="">Select your State</option>
                        <?php foreach($states as $state):?>
                            <option value="<?= $state['id'] ?>" <?= $user->state_id == $state['id'] ? 'selected' : ''?>> 
                                <?= esc($state['name'])?>
                            </option>
                        <?php endforeach?>
                    </select>
                </div>
                <span class="settings-error text-danger" id="state_id_error"></span>

                <div class="form-group">
                    <label>University*</label>
                    <select name="university_id" id="university_id">
                        <option value="">Select your University</option>
                        <?php foreach($universities as $university):?>
                            <option value="<?= $university['id'] ?>" data-state="<?= $university['state_id']?>" <?= $user->university_id == $university['id'] ? 'selected' : ''?>> 
                                <?= esc($university['name'])?>
                            </option>
                        <?php endforeach?>
                    </select>
                </div>
                <span class="settings-error text-danger" id="university_id_error"></span>

             <button type="submit" class="settings-btn">Update</button>
            </form>
        </div>
       
        <!-- Password -->
        <div class="panel" id="password">
            <div class="main-header"><h2>Change password</h2></div>
            <form action="<?= route_to('change-password') ?>" method="POST" id="changePassword" autocomplete="off">
                <?= csrf_field()?>
                <div class="form-group">
                    <label>Current Password*</label>
                    <input type="password" name="current_password" placeholder="Current password">
                </div>
                <span class="settings-error text-danger" id="current_password_error"></span>

                <div class="form-group">
                    <label>New Password*</label>
                    <input type="password"  name="new_password" placeholder="New password">
                </div>
                <span class="settings-error text-danger" id="new_password_error"></span>

                <div class="form-group">
                    <label>Confirm Password*</label>
                    <input type="password"  name="confirm_password" placeholder="Confirm password">
                </div>
                <span class="settings-error text-danger" id="confirm_password_error"></span>

                <button type="submit" class="settings-btn">Update Password</button>
            </form>
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
