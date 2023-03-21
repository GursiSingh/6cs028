<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<div class="container mt-3 w-50">
    <div class="card text-bg-dark">

        <div class="card-header">
            <h5 class="card-title">Log In</h5>
        </div>

        <div class="card-body ">
            <?php if($error != null):?>
                <div class="error text-danger">
                    ERROR: <?=$error?>
                </div>
            
            <?php endif ?>
            <form class="row g-3 needs-validation" action="<?= base_url('/login')?>" method="post">
                <?= csrf_field() ?>
                <div class="input-group has-validation pb-2 text-bg-dark">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="loginUsername" placeholder="Username" name="username" value="<?= set_value('username')?>" required>
                        <label class="text-dark" for="loginUsername">Username</label>
                    </div>
                    <div class="invalid-feedback">
                        Invalid username.
                    </div>
                </div>
                <div class="input-group has-validation pb-2">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="password" value="<?= set_value('password')?>"required>
                        <label class="text-dark" for="loginPassword">Password</label>
                    </div>
                    <div class="invalid-feedback">
                        Invalid password.
                    </div>
                </div>
                
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="showPassword">
                        <label class="form-check-label" for="showPassword">
                            Show Password
                        </label>
                    </div>
                </div>
                <a class="d-flex link-primary justify-content-end" href="<?= base_url('signUp')?>">or Create a new account here</a>
                <div class="d-grid mx-auto">
                    <button class="btn btn-primary" type="submit">Log In</button>
                </div>
            </form>
    </div>
</div>