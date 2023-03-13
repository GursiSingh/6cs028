<!--NAVIGATION-->
<nav class ="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=base_url()?>">
            <img src="#"/>
            My Sports
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class=" navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"  data-bs-auto-close="outside" aria-expanded="false">
                        Football
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <div class="accordion-body">
                            <li><a class="dropdown-item" href="<?=base_url('/football/team/'.$user['football_team'])?>">My Club</a></li>
                            <li><a class="dropdown-item" href="<?=base_url('/football')?>">Football</a></li>
                        </div>
                    </ul>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"  data-bs-auto-close="outside" aria-expanded="false">
                            Formula 1
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                        <div class="accordion-body">
                            <li><a class="dropdown-item" href="<?=base_url('/f1/team/'.$user['f1_team'])?>">My Team</a></li>
                            <li><a class="dropdown-item" href="<?=base_url('/f1')?>">F1</a></li>
                        </div>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $username ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark">
                            <li><a class="dropdown-item" href="<?= base_url('/account')?>">My Account</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout')?>">Log out</a></li>
                        </ul>
                    </li>
                </li>
            </ul>
        </div>  
    </div>
</nav>