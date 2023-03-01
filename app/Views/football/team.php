
<?php if(!empty($team)):?>

<div class="container-fluid mx-auto" style="max-width: 800px">

    <div class="d-flex top">
        <img class="logo-team" id="teamFootballLogo" src="<?=$team['logo']?>">
        <div id="teamFootballName"><?=$team['name']?></div>
        <div id="teamFootballPosition" title="<?=$team['points']?> points">#<?=$position?></div>
        
        <div id="compFootballName"><?=$competition['name']?></div>
        <img class="logo-team" id="compFootballLogo" src="<?=$competition['logo']?>">

        <?php if(!empty($venue)):?>
            <div id="venueFootballName"><?=$venue['name']?></div>
            <img class="logo-team" id="venueFootballLogo" src="<?=$venue['image']?>">
            <div id="venueFootballCapacity"><?=$venue['capacity']?></div>
        <?php else: ?>
            <img class="logo-team" id="compFootballFlag" src="<?=$competition['flag']?>"> 
        <?php endif ?>

    </div>
    
    <div class="input-group mt-5">
        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
        <select class="form-select hidden" id="inputGroupSelect01">
            <option selected>Choose Position...</option>
            <option value="1">Striker</option>
            <option value="2">Midfielder</option>
            <option value="3">Defender</option>
            <option value="4">Goalkeeper</option>
        </select>
        <button type="button" class="btn btn-outline-secondary">Search</button>
        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="visually-hidden">Search</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Name</a></li>
            <li><a class="dropdown-item" href="#">Number</a></li>
            <li><a class="dropdown-item" href="#">Position</a></li>
        </ul>
    </div>

    <div id="players">
        
        <div class="badge" data-tilt data-tilt-glare="true">
            <img class="badge-logo" src="https://media.api-sports.io/football/players/276.png">
            <div class="badge-name">Neymar</div>
            
            <div class="badge-bottom d-flex">
                <div class="badge-position st"><p class="center">ST</p></div>
                <div class="badge-number"><p class="center">11</p></div>
            </div>
        </div>

        <div class="badge" data-tilt data-tilt-glare="true">
            <img class="badge-logo" src="https://media.api-sports.io/football/players/276.png">
            <div class="badge-name">Neymar</div>
            
            <div class="badge-bottom d-flex">
                <div class="badge-position st"><p class="center">ST</p></div>
                <div class="badge-number"><p class="center">11</p></div>
            </div>
        </div>

        <div class="badge" data-tilt data-tilt-glare="true">
            <img class="badge-logo" src="https://media.api-sports.io/football/players/276.png">
            <div class="badge-name">Neymar</div>
            
            <div class="badge-bottom d-flex">
                <div class="badge-position st"><p class="center">ST</p></div>
                <div class="badge-number"><p class="center">11</p></div>
            </div>
        </div>

        <div class="badge" data-tilt data-tilt-glare="true">
            <img class="badge-logo" src="https://media.api-sports.io/football/players/276.png">
            <div class="badge-name">Neymar</div>
            
            <div class="badge-bottom d-flex">
                <div class="badge-position st"><p class="center">ST</p></div>
                <div class="badge-number"><p class="center">11</p></div>
            </div>
        </div>

    </div>
    

</div>

<?php else: ?>

<?php endif ?>

<!-- Tilt.js https://gijsroge.github.io/tilt.js/?utm_source=cdnjs&utm_medium=cdnjs_link&utm_campaign=cdnjs_library -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js" integrity="sha512-u1L7Dp3BKUP3gijgSRoMTNxmDl/5o+XOHupwwa7jsI1rMzHrllSLKsGOfqjYl8vrEG+8ghnRPNA/SCltmJCZpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>