<div class="container-fluid text-center vh-100 text-bg-dark" >
    <div class="position-relative m-auto" style="height:100%">
        <main class="position-absolute top-50 start-50 translate-middle">
            <h1 class="fs-1 fw-bolder">Welcome!</h1>
            <p class="lead">Welcome on this website, where you can follow your favorite football and f1 teams.</p>    
        </main>
        
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4 pb-5">
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style=" height: 30rem;">
                <div class="card-header d-flex">
                    <img class="header-logo" id="competitionLogoHeader"/>
                    <h1 class="header-title" id="competitionNameHeader"></h1>
                    <div class="btn-group" id="competitionGroup">
                        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Competitions
                        </button>
                        <ul class="dropdown-menu overflow-auto" style="max-height: 25rem;"id="competitionList">
                        </ul>
                    </div>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive" >
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Points</th>
                                </tr>
                            </thead>
                            <tbody id="footballStandingTable">
                                
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style=" height: 30rem;">
                <div class="card-header d-flex">
                    <h1 class="title-card" id="footballRoundHeader"></h1>
                    <div class="btn-group" id="roundGroup">
                        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Rounds
                        </button>
                        <ul class="dropdown-menu overflow-auto" style="height:25rem;"id="roundList">
                        </ul>
                    </div>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Home</th>  
                                    <th scope="col">Result</th>
                                    <th scope="col">Away</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody id="footballFixturesTable">
                                
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style="height: 30rem;">
                <div class="card-header container">
                    <ul class="nav nav-tabs nav-fill card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3 active text-white" aria-current="true" href="#">F1 Constructors Standings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3 text-muted" href="#">F1 Driver Standings</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>  
                                    <th scope="col">Name</th>
                                    <th scope="col">Points</th>
                                </tr>
                            </thead>
                            <tbody id="constructorStandingTable">
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark">
                <div class="card-header" container>
                    <h5 class="card-title">Card title</h5>
                </div>
                <div class="card-body">
                    
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
    </div>
</div>


