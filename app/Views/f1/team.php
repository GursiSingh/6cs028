<?php if(!empty($team)):?>

<div class="mb-5 team-container"  id="f1Squad" name="<?=$team['id']?>">

    <div class="d-flex align-items-center">
        <div class="logo-team">
            <img id="teamF1Logo" src="<?=$team['logo']?>">
        </div>
        <div class="team-info">
            <div id="teamF1Name"><h1> <?=$team['name']?></h1></div>
            <div class="text-center" id="teamF1Position" title="<?=$team['points']?> points"><h2>#<?=$f1Position?></h2></div>
        </div>
        <div class="comp-info mx-auto align-items-center">
            <div class="next-match text-center" id="f1Counter" value="<?=$nextEvent['date']?>">
                <h3> Next event in: </h3>
                <div class="counter">
                    <ul>
                        <li><span id="daysRace"></span>DAYS</li>
                        <li><span id="hoursRace"></span>HRS</li>
                        <li><span id="minutesRace"></span>MINS</li>
                        <li><span id="secondsRace"></span>SECS</li>
                    </ul>
                </div>
                <div class="btn-group" role="group" aria-label="Default button group">
                    <button class="btn btn-outline-light" id="eventCountry"><?= $circuit['country']?>
                        
                    </button>
                    <button class="btn btn-outline-light" id="eventType"><?= $nextEvent['type']?></button>
                    </button>
                </div>
                
            </div>
        </div>

    </div>
    
    <hr>
    
    <div class="container-fluid d-flex my-3 justify-content-center" id="driversSection" >
        <div class="card text-bg-dark border-light p-2 mx-3" style="width: 20rem;">
            <div class="card-header"><h3>Information</h3></div>
            <table class="table table-dark my-3 table-bordered table-striped" style="border-radius: 25px;">
                <tr>
                    <th scope="row">Base</th>
                    <td><?=$team['base']?></td>
                </tr>
                <tr>
                    <th scope="row">Entry</th>
                    <td><?=$team['first_entry']?></td>
                </tr>
                <tr>
                    <th scope="row">President</th>
                    <td><?=$team['president']?></td>
                </tr>
                <tr>
                    <th scope="row">Director</th>
                    <td><?=$team['director']?></td>
                </tr>
                <tr>
                    <th scope="row">World Championships</th>
                    <td><?=$team['world_championships']?></td>
                </tr>
                <tr>
                    <th scope="row">Chassis</th>
                    <td><?=$team['chassis']?></td>
                </tr>
            </table>
        </div>
        <div class="card text-bg-dark border-light p-2 mx-3" style="width: 20rem;">
            <div class="card-header"><h3>Drivers</h3></div>
            <div class="d-flex">
                <?php foreach($drivers as $driver):?>
                    <div class="badge mx-1" data-tilt data-tilt-glare="true" id="<?=$driver['id']?>">
                        <img class="badge-logo" src="<?=$driver['image']?>">
                        <div class="badge-name"><?=$driver['name']?></div>
                        <div class="badge-bottom d-flex">
                            <div class="badge-points" title="points"><p class="center"><?=$driver['points']?></p></div>
                            <div class="badge-number" title="number"><p class="center">#<?=$driver['number']?></p></div>
                        </div>
                    </div>
                
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="card text-bg-dark border-light" style="overflow-y: auto;">
        <div class="card-header"><h3>Races</h3></div>
        <div class="card-body mx-0 p-0">
            
            <div class="container-fluid mx-0 p-0">
                <table class="table table-dark table-striped table-hover mx-0 p-0">
                    <thead>
                        <tr>
                            <th scope="col">Country</th>  
                            <th scope="col">Driver</th>
                            <th scope="col">Position</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody id="teamRacesTable">
                        
                    </tbody>

                </table>
            
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<?php endif ?>

<!-- Tilt.js https://micku7zu.github.io/vanilla-tilt.js/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js" integrity="sha512-RX/OFugt/bkgwRQg4B22KYE79dQhwaPp2IZaA/YyU3GMo/qY7GrXkiG6Dvvwnds6/DefCfwPTgCXnaC6nAgVYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>