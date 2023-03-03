
<?php if(!empty($team)):?>

<div class="mx-auto  mb-5 team-container" id="footballSquad" name="<?=$team['id']?>">

    <div class="d-flex align-items-center">
        <div class="logo-team">
            <img id="teamFootballLogo" src="<?=$team['logo']?>">
        </div>
        <div class="team-info">
            <div id="teamFootballName"><h1> <?=$team['name']?></h1></div>
            <div class="text-center" id="teamFootballPosition" title="<?=$team['points']?> points"><h2>#<?=$position?></h2></div>
        </div>
        <div class="comp-info mx-auto align-items-center">
            <div class="next-match text-center">
                <h3> Next match in: </h3>
                <div class="counter">
                    <ul>
                        <li><span id="days">31</span>DAYS</li>
                        <li><span id="hours">24</span>HRS</li>
                        <li><span id="minutes">59</span>MINS</li>
                        <li><span id="seconds">59</span>SECS</li>
                    </ul>
                </div>
                <div class="btn-group" role="group" aria-label="Default button group">
                    <button class="btn btn-outline-light" id="matchHome">
                        <img src="<?=$team['logo']?>">JUV
                    </button>
                    <button class="btn btn-outline-light" > - </button>
                    <button class="btn btn-outline-light" id="matchAway">
                        <img src="<?=$team['logo']?>">MIL
                    </button>
                    <button class="btn btn-light" id="matchCompetition" title="<?=$competition['name']?>">
                        <img class="logo-competition" id="compFootballLogo" src="<?=$competition['logo']?>">
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
    <h3>Players</h3>
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

<?php else: ?>

<?php endif ?>

<!-- Tilt.js https://micku7zu.github.io/vanilla-tilt.js/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js" integrity="sha512-RX/OFugt/bkgwRQg4B22KYE79dQhwaPp2IZaA/YyU3GMo/qY7GrXkiG6Dvvwnds6/DefCfwPTgCXnaC6nAgVYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>