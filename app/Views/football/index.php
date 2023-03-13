<div class="container-fluid mx-auto" style="max-width: 1200px;">
    <!-- Playing Today -->
    <div class="card pb-3 border-light text-bg-dark my-5" style=" max-height: 30rem;">
        <div class="card-header d-flex">
            <h2 class="title-card" id="footballDateHeader">Todays Fixtures</h2>
        </div>
        <div class="card-body overflow-auto">
            <div class="table-responsive text-center">
                <table class="table table-dark table-striped table-hover">
                    
                    <tbody id="footballTodaysFixturesTable" >
                        <?php if(!empty($todayFixtures)):?>
                            <?php foreach($todayFixtures as $match):?>
                                <tr class="table-item todayFootball">
                                    <td><img class="table-logo" src="<?= $match['competitionLogo']?>" title="<?=$match['competitionName']?>"></td>
                                    <td style="text-align: right">
                                        <p class="full-text"><?= $match['homeName']?></p>
                                        <p class="abbr-text"><?= $match['homeCode']?></p>
                                        <img class="table-logo" src="<?= $match['homeLogo']?>" style=";margin-right:0px; margin-left: 5px;">
                                    </td>
                                    <?php if($match["status"]==="NS"):?>
                                        <td><?= $match['time']?></td>
                                    <?php else:?>
                                        <td><?= $match['goal_home']?> - <?= $match['goal_away']?></td>
                                    <?php endif?>
                                    <td style="text-align: left;">
                                        <img class="table-logo" src="<?= $match['awayLogo']?>">
                                        <p class="full-text"><?= $match['awayName']?></p>
                                        <p class="abbr-text"><?= $match['awayCode']?></p>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        <?php else:?>
                            <p>No Matches today</p>
                        <?php endif?>
                        
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-xlg-2 g-4 pb-5">
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
                            <tbody id="footballStandingTable" name="<?=$competitionId?>">
                                
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
                                    <th class="text-center" scope="col">Result</th>
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
    </div>
</div>