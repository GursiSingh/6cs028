<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<div class="container w-50">
    <div class="card my-4">  

        <div class="card-header">
            <h5 class="card-title">Sign Up</h5>
        </div>

        <div class="card-body">

        <form class="row g-3" action="<?= base_url('/signUp')?>" method="post">
            <?= csrf_field() ?>
            <div class="col-12">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="inputUsername" name="username" value="<?= set_value('username')?>" required>
            </div>
            <div class="col-12">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" value="<?= set_value('email')?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" value="<?= set_value('password')?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputPasswordConfirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="inputPasswordConfirm" name="password1" value="<?= set_value('password1')?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputFootballClub" class="form-label">Favorite Football Club</label>
                <input type="text" class="form-control" id="inputFootballClub" name="football_team" value="<?= set_value('football_team')?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputF1Team" class="form-label">Favorite F1 Team</label>
                <input type="text" class="form-control" id="inputF1Team" name="f1_team" value="<?= set_value('f1_team')?>" required>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </form>
    </div>    
</div>