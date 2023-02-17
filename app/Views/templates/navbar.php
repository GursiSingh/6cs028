<!--NAVIGATION-->
<nav class ="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
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
                        <div class="accordion accordion-flush bg-dark" id="accordionFlushFootball">
                            <div class="accordion-item">
                                <div class="accordion-header bg-dark" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Club
                                    </button>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushFootball">
                                        <div class="accordion-body">
                                            <a class="dropdown-item" href="#">My Club</a>
                                            <a class="dropdown-item" href="#">Club Standings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header bg-dark" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Nation
                                    </button>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushFootball">
                                        <div class="accordion-body">
                                            <a class="dropdown-item" href="#">My Nation</a>
                                            <a class="dropdown-item" href="#">Nation Standings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </ul>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"  data-bs-auto-close="outside" aria-expanded="false">
                            Formula 1
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <div class="accordion accordion-flush bg-dark" id="accordionFlushFormula">
                                <div class="accordion-item">
                                    <div class="accordion-header bg-dark" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            F1 Teams
                                        </button>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushFormula">
                                            <div class="accordion-body">
                                                <a class="dropdown-item" href="#">My Team</a>
                                                <a class="dropdown-item" href="#">Team Standings</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header bg-dark" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                            F1 Drivers
                                        </button>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushFormula">
                                            <div class="accordion-body">
                                                <a class="dropdown-item" href="#">Drivers</a>
                                                <a class="dropdown-item" href="#">Driver Standings</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">My Account</a></li>
                            <li><a class="dropdown-item" href="../HTML/fantasyIndex.html">My Fantasy</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout')?>">Log out</a></li>
                        </ul>
                    </li>
                </li>
            </ul>
        </div>  
    </div>
</nav>