<?php if(!empty($user)):?>
    <div class="container-fluid text-bg-dark mx-auto my-3" style="max-width: 1200px">
        <div class="row text-center row-cols-1 row-cols-md-4 g-4 pb-5">
            <div class="col-md-4 mx-auto" style="width: 20rem;">
                <div class="card border-light text-bg-dark my-card" >
                    <div class="card-header text-bg-light">

                        <div class="team-name" id="teamFootball" name="<?=$team['id']?>"><?=$team['name']?></div>
                    </div>
                    
                    <div class="card-body overflow-auto">
                        <div class="d-flex align-items-center">
                            <div id="teamLogo">
                                <img class="my-logo" src="<?=$team['logo']?>">
                            </div>
                            <div id="teamPosition"><h1>#<?=$position?></h1></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mx-auto" style="width: 20rem;">
                <div class="card border-light text-bg-dark my-card" >
                    <div class="card-header text-bg-light">
                        <div class="f1-name" id="teamF1" name="<?=$f1Team['id']?>"><?=$f1Team['name']?></div>
                    </div>
                    
                    <div class="card-body overflow-auto">
                        <div class="d-flex align-items-center">
                            <div id="teamLogo">
                                <img class="my-logo" id="f1ImgEl" src="<?=$f1Team['logo']?>">
                            </div>
                            <div id="teamPosition"><h1>#<?=$f1Position?></h1></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="calendar-container" id="calendar">
            <h2>Calendar</h2>
            <div class="month">      
                <ul>
                    <li class="prev" id="prevMonth">&#10094;</li>
                    <li class="next" id="nextMonth">&#10095;</li>
                    <li class="clickable">
                        <div id="month"></div><br>
                        <div style="font-size:18px" id="year" value="">2023</div>
                    </li>
                </ul>
            </div>

            <ul class="weekdays">
                <li>Mo</li>
                <li>Tu</li>
                <li>We</li>
                <li>Th</li>
                <li>Fr</li>
                <li>Sa</li>
                <li>Su</li>
            </ul>

            <ul class="days" id="days">  
                
            </ul>
        </div>
    </div>


<?php else:?>

    <h2> Log In to see your favorite teams.</h2>

<?php endif?>