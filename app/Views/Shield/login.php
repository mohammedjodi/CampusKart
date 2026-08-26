<!-- //$this->extend(config('Auth')->views['layout'])   -->
 <?= $this->extend('layouts/auth')?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="<?=base_url('vendors/images/login-page-img.png')?>" alt=""/>
            </div>
            <div class="col-md-6 col-lg-5">

            <div class="login-box bg-white box-shadow border-radius-10">
                <div class="login-title">
                    <h2 class="text-center text-primary">Login </h2>
                </div>
            <pre>
                <!-- <?php //var_dump(session()->getFlashdata()) ?> -->
            </pre>
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

            <?php if (session('message') !== null) : ?>
                <div class="alert alert-success" role="alert"><?= esc(session('message')) ?></div>
            <?php endif ?>                             
            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="input-group custom">

                    <input type="email" class="form-control form-control-lg" id="floatingEmailInput" name="email"   inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                    <!-- <label for="floatingEmailInput"> //lang('Auth.email') </label> -->
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                    </div>
                </div>
                <!-- Password -->
                <div class="input-group custom">
                    <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                    <!-- <label for="floatingPasswordInput">lang('Auth.password') </label> -->
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                    </div>
                </div>

                <!-- Remember me -->
                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                    <div class="row pb-30">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class='custom-control-input'  id="customCheck1" <?php if (old('remember')): ?> checked<?php endif ?>>

                                <label class="custom-control-label" for="customCheck1"><?= lang('Auth.rememberMe') ?></label>
                                
                            </div>
                        </div>
                        <div class="col-6">
                        <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                            <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
                        <?php endif ?>

                    
                        </div>
                    </div>
            
                <?php endif; ?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?= lang('Auth.login') ?></button>
                        </div>
                        <?php if (setting('Auth.allowRegistration')) : ?>
                        <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                OR
                        </div>
                        <div class="input-group mb-0">
                            <a href="<?= url_to('register')  ?>"  class="btn btn-outline-primary btn-lg btn-block"><?= lang('Auth.register') ?></a>
                        </div>
                    </div>
                </div>
                    
                <?php endif ?>

                

            </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
