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
                    <div class="btn-group w-100" role="group">

                        <input type="radio" class="btn-check p-4" name="btnradio" id="constructorHeader" autocomplete="off" checked>
                        <label class="btn btn-outline-light" for="constructorHeader"><h3>F1 Constructors Standings</h3></label>

                        <input type="radio" class="btn-check p-4" name="btnradio" id="driverHeader" autocomplete="off">
                        <label class="btn btn-outline-light" for="driverHeader"><h3>F1 Driver Standings</h3></label>

                    </div>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive " id="constructor-section">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>  
                                    <th scope="col">Name</th>
                                    <th scope="col">Points</th>
                                </tr>
                            </thead>
                            <tbody id="constructorStandingTable">

                                <?php $counter = 1;?>
                                <?php foreach ($constructor as $f1Team):?>

                                    <tr class="table-item f1" id="<?=$f1Team['id']?>">
                                        <th scope="row"><?=$counter?></th>
                                        <td><img class="table-logo" src="<?=$f1Team['logo']?>"><?=$f1Team['name']?></td>
                                        <td><?=$f1Team['points']?></td>
                                    </tr>
                                    <?php $counter++;?>
                                <?php endforeach ?> 
                            </tbody>

                        </table>
                    </div>

                    <div class="table-responsive d-none" id="drivers-section">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>  
                                    <th scope="col">Driver</th>
                                    <th scope="col">Team</th>
                                    <th scope="col">Points</th>
                                </tr>
                            </thead>
                            <tbody id="driverStandingTable">

                                <?php $counter = 1;?>
                                <?php foreach ($drivers as $f1Driver):?>

                                    <tr class="table-item f1 " id="<?=$f1Driver['id']?>">
                                        <th scope="row"><?=$counter?></th>
                                        <td class="d-flex">
                                            <img class="table-logo" src="<?=$f1Driver['image']?>">
                                            <div class="full-name"><?=$f1Driver['name']?></div>
                                            <div class="abbr-name d-none"><?=$f1Driver['abbr']?></div>
                                        </td>
                                        <td><?=$f1Driver['teamName']?></td>
                                        <td><?=$f1Driver['points']?></td>
                                    </tr>
                                    <?php $counter++;?>
                                <?php endforeach ?> 
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style="height: 30rem;">
                <div class="card-header d-flex">
                    <h1 class="title-card" id="f1EventHeader">Event <?= $eventNumber?>: <?= $circuit['country']?></h1>
                    <div class="btn-group" id="eventGroup">
                        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </button>
                        <ul class="dropdown-menu overflow-auto" style="height:25rem;"id="eventList">
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                
                    <div class="table-responsive " id="circuit-section">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>  
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody id="eventTable">

                                <?php foreach ($f1Events as $event):?>

                                    <tr class="table-item f1 align-center" id="<?= $event['id']?>">
                                        <th><?=$event['type']?></th>
                                        <td><?= $circuit['name']?></td>
                                        <td><?=$event['date']?></td>
                                    </tr>
                                    <?php $counter++;?>
                                <?php endforeach ?> 
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


