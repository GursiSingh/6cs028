
<?php if(!empty($team)):?>

<div class="mb-5 team-container"  id="footballSquad" name="<?=$team['id']?>" title="<?= $competition['id']?>">

    <div class="d-flex align-items-center">
        <div class="logo-team">
            <img id="teamFootballLogo" src="<?=$team['logo']?>">
        </div>
        <div class="team-info">
            <div id="teamFootballName"><h1> <?=$team['name']?></h1></div>
            <div class="text-center" id="teamFootballPosition" title="<?=$team['points']?> points"><h2>#<?=$position?></h2></div>
        </div>
        <div class="comp-info mx-auto align-items-center">
            <div class="next-match text-center" id="counter">
                <h3> Next match in: </h3>
                <div class="counter" >
                    <ul>
                        <li><span id="daysMatch"></span>DAYS</li>
                        <li><span id="hoursMatch"></span>HRS</li>
                        <li><span id="minutesMatch"></span>MINS</li>
                        <li><span id="secondsMatch"></span>SECS</li>
                    </ul>
                </div>
                <div class="btn-group" role="group" aria-label="Default button group">
                    <button class="btn btn-outline-light" id="matchHome">
                        
                    </button>
                    <button class="btn btn-outline-light" id="matchResult"> - </button>
                    <button class="btn btn-outline-light" id="matchAway">
                    </button>
                    <button class="btn btn-light" id="matchCompetition">
                    </button>
                </div>
                
            </div>
        </div>

        <div class="venue-info">
            <?php if(!empty($venue)):?>
                <div id="venueFootballName"><?=$venue['name']?></div>
                <img class="logo-team" id="venueFootballLogo" src="<?=$venue['image']?>">
                <div id="venueFootballCapacity">Capacity: <?=$venue['capacity']?></div>
            <?php else: ?>
                <img class="logo-team" id="compFootballFlag" src="<?=$competition['flag']?>"> 
            <?php endif ?>
        </div>

    </div>
    
    <hr>
    
    <div class="btn-group w-100" role="group">

        <input type="radio" class="btn-check " name="btnradio" id="playerHeader" autocomplete="off" checked>
        <label class="btn btn-outline-light" for="playerHeader">Players</label>

        <input type="radio" class="btn-check" name="btnradio" id="infoHeader" autocomplete="off">
        <label class="btn btn-outline-light" for="infoHeader">Information</label>

        <input type="radio" class="btn-check" name="btnradio" id="matchesHeader" autocomplete="off">
        <label class="btn btn-outline-light" for="matchesHeader">Matches</label>

    </div>

    <div id="playersSection" >
        <div class="input-group mt-5">
            <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
            <select class="form-select hidden" id="inputGroupSelect01">
                <option selected>Choose Position...</option>
                <option value="1">Striker</option>
                <option value="2">Midfielder</option>
                <option value="3">Defender</option>
                <option value="4">Goalkeeper</option>
            </select>
            <button type="button" class="btn btn-outline-light">Search</button>
            <button type="button" class="btn btn-outline-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Search</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Name</a></li>
                <li><a class="dropdown-item" href="#">Number</a></li>
                <li><a class="dropdown-item" href="#">Position</a></li>
            </ul>
        </div>

        <div class="text-center" id="players-container">
            

        </div>
    </div>
    
    <div class="d-none" id="infoSection">

    </div>
    
    <div class="d-none" id="matchesSection">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Home</th>  
                    <th scope="col">Result</th>
                    <th scope="col">Away</th>
                    <th scope="col">Round</th>
                </tr>
            </thead>
            <tbody id="teamMatchesTable">
                
            </tbody>

        </table>
    </div>
</div>

<?php else: ?>

<?php endif ?>

<!-- Tilt.js https://micku7zu.github.io/vanilla-tilt.js/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js" integrity="sha512-RX/OFugt/bkgwRQg4B22KYE79dQhwaPp2IZaA/YyU3GMo/qY7GrXkiG6Dvvwnds6/DefCfwPTgCXnaC6nAgVYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>