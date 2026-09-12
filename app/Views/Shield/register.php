<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="form-container">
    <form action="<?= url_to('register') ?>" method="post" class="form-wizard">
         <?= csrf_field() ?>
        <h1>Registration</h1>

        <!-- Submission Success Message -->
        <div class="completed" hidden>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

            <h3>Registration Successful!</h3>
            <p>Your account has been created successfully.</p>
        </div>

        <div class="progress-container">
            <div class="progress"></div>
           

            <ol>
                <li class="current">Personal Info</li>
                <li class="">School info</li>
                <li>Account Info</li>
                <li>About</li>
            </ol>
             <div id="validationError">
            </div>
        </div>
        <div class="steps-container">
            <div class="step">
                <h3>Personal Information</h3>
                <div class="input-control">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name"  placeholder="First name" required>
                    <div id="firstNameError" class=" mb-3 bold "></div>
                </div>
                 <div class="input-control">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Last name"required>
                    <div id="lastNameError" class=" mb-3 bold "></div>

                </div>
                 <div class="input-control">
                    <label for="email">Email:</label>
                    <input type="email" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                    <div id="emailError" class=" mb-3 bold "></div>

                </div>
            </div>

            <div class="step">
                <h3>School Information</h3>
                <div class="input-control">
                    <label for="state">State:</label>
                    <select name="state_id" id="state" required>
                        <option value="">Select your state  </option>
                        <?php foreach($states as $state):?>
                            <option value="<?= $state['id'] ?>"> <?= esc($state['name'])?></option>
                        <?php endforeach?>
                    </select>
                    <div id="stateError" class=" mb-3 bold "></div>

                </div>
                <div class="input-control">
                    <label for="university">University:</label>
                    <select name="university_id" id="university" required>
                        <!-- HANDLED BY AJAX  -->
                    </select>
                    <div id="universityError" class=" mb-3 bold "></div>

                </div>
            </div>
            <div class="step">
                <h3>Account Information</h3>
                <div class="input-control">
                    <label for="username">Username:</label>
                    <input type="text"   class="username" id="floatingUsernameInput"   name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                    <div id="usernameError" class=" mb-3 bold "></div>
                </div>
                <div class="input-control">
                    <label for="password">Password:</label>
                    <input type="password" id="floatingPasswordInput"  name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                    <div id="passwordError" class=" mb-3 bold "></div>

                </div>
                <div class="input-control">
                    <label for="Confirm-password">Confirm Password:</label>
                    <input type="password"  id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                    <div id="ConfirmPasswordError" class=" mb-3 bold "></div>

                </div>

            </div>
            <div class="step">
                <h3>Profile</h3>
                <div class="input-control">
                    <label for="bio">Bio:</label>
                    <textarea id="bio" name="bio" placeholder="Optional.............."></textarea>
                </div>
                <div class="input-control">
                    <label for="avatar">avatar:</label>
                    <input type="file" name="avatar"  class="avatar" id="avatar">
                    <div id="avatarError" class=" mb-3 bold "></div>

                </div>
             </div>

        </div>
        <!-- controls -->
         <div class="controls">
           
            <button class="prev-btn">Prev</button>
            <button class="next-btn">Next</button>
            <button type="submit" class="submit-btn" >Submit</button>

         </div>
        
        <p class="text-center login"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>

    </form>

</div>

<?= $this->endSection() ?>
