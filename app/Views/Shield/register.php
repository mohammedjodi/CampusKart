<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 col-lg-7">
                <img src="<?=base_url('vendors/images/login-page-img.png')?>" alt=""/>
            </div>
            <div class="col-md-8 col-lg-5">

            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
                    <h2 class="text-center text-primary">Register </h2>
                </div>
                <?php if (session('error') !== null) : ?>
                    <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                                <?= esc($error) ?>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?= esc(session('errors')) ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>
                

                <form action="<?= url_to('register') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <!-- Custom fields added start -->
                     <!-- First Name -->
                     <div class="input-group custom">
                        <input type="text" class="form-control form-control-lg" name="first_name" id="" placeholder="First name" value="<?= old("first_name")?>">
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="icon-copy fa fa-user-circle-o" aria-hidden="true"></i></span>
                        </div>
                     </div>
                     <!-- Last  Name -->
                     <div class="input-group custom">
                        
                        <input type="text" name="last_name" id="" class="form-control form-control-lg" placeholder="Last name" value="<?= old("last_name")?>">
                        <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy fa fa-user-circle-o" aria-hidden="true"></i></span>
                        </div>
                     </div>
                      <!-- University -->
                     <div class="input-group custom">
                    
                        <select name="university" id="" class="form-control form-control-lg" >
                            <option value="">Select University </option>
                            <option value="University of Lagos">University of Lagos</option>
                            <option value="Ahmed Bello university">Ahmed Bello university</option>
                            <option value="Bayero University">Bayero University</option>
                        </select>
                     </div>
                     <!-- Avatar  -->
                      <div class="input-group custom">
                        <input type="file" name="avatar" class="form-control form-control-lg" id="">
                        <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy fa fa-file" aria-hidden="true"></i></span>
                            </div>
                      </div>
                    <!-- Custom fields added end  -->
                    <!-- Email -->
                    <div class="input-group custom">
                        <input type="email" class="form-control form-control-lg" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                        <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy fa fa-envelope-o" aria-hidden="true"></i></span>
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="input-group custom">
                        <input type="text" class="form-control form-control-lg" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="icon-copy fa fa-user-o" aria-hidden="true"></i></i></span>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group custom">
                        <input type="password" class="form-control form-control-lg" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                        </div>
                    </div>

                    <!-- Password (Again) -->
                    <div class="input-group custom">
                        <input type="password" class="form-control form-control-lg" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                        <div class="input-group-append custom">
                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group mb-0">
                                <button type="submit" class="btn btn-primary btn-lg btn-block"><?= lang('Auth.register') ?></button>
                            </div>

                        <p class="font-16 weight-600 pt-10 pb-10 text-center" ><?= lang('Auth.haveAccount') ?> <a data-color="#0306cd" href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>
                        </div>
                </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
