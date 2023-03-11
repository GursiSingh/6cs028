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
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?=base_url('/football')?>" role="button">
                        Football
                    </a>
                    
                    <li class="nav-item ">
                        <a class="nav-link text-white" href="<?=base_url('/f1')?>" role="button" >
                            Formula 1
                        </a>
                    </li>
                    <li class="d-flex" >
                        <li class="nav-item">
                            <a class="btn btn-outline-success mx-2" href="<?= base_url('login')?>" >Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-success" href="<?= base_url('signUp')?>" >Sign Up</a>
                        </li>
                    </li>
                </li>
            </ul>
        </div>  
    </div>
</nav>