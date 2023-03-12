<div class="container-fluid mx-auto" style="max-width: 1200px;">
    <div class="row row-cols-sm-1 row-cols-md-2 g-4 pb-5">
        <!-- Constructor Standing -->
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style="height: 30rem;">
                <div class="card-header container">
                    <div class="btn-group w-100" role="group">
                        <h4> Constructor Standings </h4>
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

                                    <tr class="table-item f1 clickable" id="<?=$f1Team['id']?>">
                                        <th scope="row"><?=$counter?></th>
                                        <td class="left"><img class="table-logo" src="<?=$f1Team['logo']?>"><?=$f1Team['name']?></td>
                                        <td><?=$f1Team['points']?></td>
                                    </tr>
                                    <?php $counter++;?>
                                <?php endforeach ?> 
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Driver Standing -->
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style="height: 30rem;">
                <div class="card-header container">
                    <div class="btn-group w-100" role="group">
                        <h4> Driver Standings </h4>
                    </div>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive " id="constructor-section">
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

                                    <tr class="table-item clickable " id="<?=$f1Driver['id']?>" >
                                        <th scope="row"><?=$counter?></th>
                                        <td class="d-flex left">
                                            <img class="table-logo" src="<?=$f1Driver['image']?>">
                                            <div class="full-text"><?=$f1Driver['name']?></div>
                                            <div class="abbr-text"><?=$f1Driver['abbr']?></div>
                                        </td>
                                        <td>
                                            <div class="full-text"><?=$f1Driver['teamName']?></div>
                                            <div class="abbr-text">
                                                <img class="table-logo" src="<?=$f1Driver['teamLogo']?>" title="<?=$f1Driver['teamName']?>" alt="<?=$f1Driver['teamName']?>"/>
                                            </div>
                                        </td>
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
    </div>
    <!-- Race Standings -->
    <div class="card pb-3 border-light text-bg-dark w-100" style="height: 30rem;">
        <div class="card-header d-flex">
            <h1 class="title-card">Race Standing</h1>
            <div class="btn-group" id="raceGroup">
                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Races
                </button>
                <ul class="dropdown-menu overflow-auto" style="max-height:25rem;"id="racesList">
                </ul>
            </div>
        </div>
        <div class="card-body overflow-auto ">
        
            <div class="table-responsive" id="race-section">
                <table class="table table-dark table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>  
                            <th scope="col">Team</th>
                            <th class="full-table text-center" scope="col">Pits</th>
                            <th class="full-table text-center" scope="col">Time</th>  
                            <th class="full-table text-center" scope="col">Grid</th>
                        </tr>
                    </thead>
                    <h4 id="f1RaceHeader"><?= $circuitCountry?></h4>
                    <tbody id="raceTable">
                        <?php for($i = 0; $i < (sizeOf($lastRace)); $i++):?>
                            <tr class="table-item align-center" id="<?= $lastRace[$i]['id']?>">
                                <td class="left"><?=$lastRace[$i]['position']?></td>
                                <td>
                                    <img class="table-logo" src="<?=$lastRace[$i]['driverLogo']?>">
                                    <div class="full-text"><?=$lastRace[$i]['driverName']?></div>
                                    <div class="abbr-text"><?=$lastRace[$i]['driverAbbr']?></div>
                                </td>
                                <td>
                                    <div class="full-text"><?=$lastRace[$i]['teamName']?></div>
                                    <div class="abbr-text">
                                        <img class="table-logo" src="<?=$lastRace[$i]['teamLogo']?>" title="<?=$lastRace[$i]['teamName']?>" alt="<?=$lastRace[$i]['teamName']?>"/>
                                    </div>
                                </td>
                                <td class="full-table text-center"><?=$lastRace[$i]['grid']?></td>
                                <td class="full-table text-center"><?=$lastRace[$i]['pits']?></td>
                                <td class="full-table text-center"><?=$lastRace[$i]['time']?></td>
                            </tr>

                        <?php endfor ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- Events -->
    <div class="card pb-3 border-light text-bg-dark w-100" style="height: 30rem;">
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
        <div class="card-body overflow-auto">
        
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

                            <tr class="table-item align-center" id="<?= $event['id']?>">
                                <td class="left"><?=$event['type']?></td>
                                <td><?= $circuit['name']?></td>
                                <td> 
                                    <p class="full-text"><?=$event['date']?></p>
                                    <p class="abbr-text" style="font-size: 0.7rem"><?=$event['date']?></p>
                                </td>
                            </tr>
                        <?php endforeach ?> 
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>