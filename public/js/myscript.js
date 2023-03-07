

// inputF1El.addEventListener ("focus", displayF1Hints, false);
// inputF1El.addEventListener ("focusout", hideF1Hints, false);
//inputF1El.addEventListener ("keyup", getSearchDataF1(inputF1El.textContent), false);

//HOME
const footballTableStandingEl = document.getElementById("footballStandingTable");
const footballFixturesTable = document.getElementById("footballFixturesTable");

const constructorTableStandingEl = document.getElementById("constructorStandingTable");



if(footballTableStandingEl){
    footballTableStandingEl.addEventListener("load", updateFootball(135));
    footballTableStandingEl.addEventListener("load", setFootballStanding(135));
    footballFixturesTable.addEventListener("load", setFootballFixtures(135));
    constructorTableStandingEl.addEventListener("load", setF1Standing());
}

//Update the details of the competition
function updateFootball(competitionId){
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/update/competition/' + competitionId)
        .then()
        .catch(err => {
    });
}

//Display Element
function displayHints(el){

    el.classList.remove("invisible");
}

//Hide Element
function hideHints(el){


    el.classList.add("invisible");
}

//get football team data from the Databse  
function getSearchDataF1(inputEl){

    const f1TeamList = document.getElementById("f1TeamList");
    f1TeamList.innerHTML = "";

    if(inputEl.value.length >= 3){
        // Fetch data
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/f1/searchF1Teams/' + inputEl.value)
            
        // Convert response string to json object
        .then(response => response.json())
        .then(response => { 
            
            
            for(let i = 0; i < response.length; i++){
                // Copy one element of response to our HTML paragraph
                f1TeamList.innerHTML += 
                `
                <div class="dropList-item f1" value="`+response[i].id +`" name="`+ response[i].name +`">
                    <img src="`+response[i].logo +`"/>`+response[i].name +`
                </div>
                `;
            }
            var dropList = document.getElementsByClassName("dropList-item f1");
            for(let i = 0; i < dropList.length; i++) {
                dropList[i].onclick = function(){ setTeam(this, inputEl, f1TeamList, 0)};
            }
        })
        .catch(err => {
        
        // Display errors in console    
        console.log(err);
        });
        displayHints(f1TeamList);

    }else{
        f1TeamList.innerHTML = "";
        hideHints(f1TeamList);
    }
}

//Set Team name in the element
function setTeam(selectedEl, inputEl, listEl, type){
    name = selectedEl.attributes["name"].value;
    id = selectedEl.attributes["value"].value;
    inputEl.title = name;
    
    inputEl.value = id;
    hideHints(listEl);
}

//get football team data from the Databse  
function getSearchDataFootball(inputEl){
    
    const footballTeamList = document.getElementById("footballTeamList");
    footballTeamList.innerHTML = "";

    if(inputEl.value.length >= 3){
        // Fetch data
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/searchTeams/' + inputEl.value)
            
        // Convert response string to json object
        .then(response => response.json())
        .then(response => { 
            
            for(let i = 0; i < response.length; i++){
                // Copy one element of response to our HTML paragraph
                footballTeamList.innerHTML += 
                `
                <div class="dropList-item football" value="`+response[i].id +`" name="`+ response[i].name +`">
                    <img src="`+response[i].logo +`"/>`+response[i].name +`
                </div>
                `;
            }
            var dropList = document.getElementsByClassName("dropList-item football");
            for(let i = 0; i < dropList.length; i++) {
                dropList[i].onclick = function(){ setTeam(this, inputEl, footballTeamList ,1)};
            }
        })
        .catch(err => {
        
        // Display errors in console    
        console.log(err);
        });
        displayHints(footballTeamList);

    }else{
        footballTeamList.innerHTML = "";
        hideHints(footballTeamList);
    }

}



/*--- WELCOME PAGE ---*/

//get football standings data from the Databse  
function setFootballStanding(competitionId){

    footballTableStandingEl.innerHTML  = "";

    //Set Header
    const competitionNameHeaderEl = document.getElementById('competitionNameHeader');
    const competitionLogoHeaderEl = document.getElementById('competitionLogoHeader');
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId)
        .then(response => response.json())
        .then(response => { 
            competitionLogoHeaderEl.src = response[0].logo;
            competitionNameHeaderEl.innerText = response[0].name;
        });
    //Set Competition Dropdown
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition')
        .then(response => response.json())
        .then(response => { 
            const competitionListList = document.getElementById("competitionList");
            competitionListList.innerHTML = "";

            for(let i = 0; i < response.length; i++){
                
                //set current round
                if(response[i].id == competitionId){
                    competitionListList.innerHTML += `
                        <li><a class="dropdown-item active" name="`+response[i].id+`" id="selected">`+response[i].name+`</a></li>
                    `;

                }else{
                    competitionListList.innerHTML += `
                        <li><a class="dropdown-item competition" name="`+response[i].id+`">`+response[i].name+`</a></li>
                    `;
                }
                
            }

            var competitionItems = document.getElementsByClassName("dropdown-item competition");

            for(let i = 0; i < competitionItems.length; i++) {
                competitionItems[i].onclick = function(){ 
                    setFootballStanding(competitionItems[i].name);
                    setFootballFixtures(competitionItems[i].name);
                    updateFootball(competitionItems[i].name);
                };
            }

        });
    
    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/standing/' + competitionId)
            
    // Convert response string to json object
    .then(response => response.json())
    .then(response => { 
        
        for(let i = 0; i < response.length; i++){
            // Copy one element of response to our HTML paragraph
            footballTableStandingEl.innerHTML += 
            `
            <tr class="table-item football" id = "`+response[i].id+`">
                <th scope+"row">`+(i+1)+`</th>
                <td ><img class="table-logo" src="`+response[i].logo+`">`+ response[i].name+`</td>
                <td>`+response[i].points+`</td>
            </tr>
            `;
        }
        var tableItems = document.getElementsByClassName("table-item football");

        for(let i = 0; i < tableItems.length; i++) {
            tableItems[i].onclick = function(){ window.location.href = base_url + "/football/team/"+ tableItems[i].id;};
        }
    })
    .catch(err => {
    
    // Display errors in console    
    console.log(err);
    });
}

//get football competition fixtures
function setFootballFixtures(competitionId, round=null){
    footballFixturesTable.innerHTML = '';
    // Fetch data
    if(round == null)
    {
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId +'/round')
            // Convert response string to json object
            .then(response => response.json())
            .then(response => { 
                

                //Set Football Round in the header
                const roundHeaderEl = document.getElementById("footballRoundHeader");
                roundHeaderEl.innerText = response[0].round;

                //Get all rounds 
                fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId +'/round/name/all')
                    .then(response => response.json())
                    .then(response => { 
                        
                        const fixturesRoundsList = document.getElementById("roundList");
                        fixturesRoundsList.innerHTML = "";

                        for(let i = 0; i < response.length; i++){
                            
                            //set current round
                            if(response[i].current == "1"){
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item active" name="`+response[i].round+`" id="selected">`+response[i].round+`</a></li>
                                `;

                            }else{
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item round" name="`+response[i].round+`">`+response[i].round+`</a></li>
                                `;
                            }
                            
                        }

                        var roundItems = document.getElementsByClassName("dropdown-item round");

                        for(let i = 0; i < roundItems.length; i++) {
                            roundItems[i].onclick = function(){ setFootballFixtures(competitionId, roundItems[i].name)};
                        }

                    });

                for(let i = 0; i < response.length; i++){
                    
                    var goalHome;
                    var goalAway;

                    if(response[i].goal_home == null){
                        goalHome= "";
                    }else{
                        goalHome= response[i].goal_home;
                    }

                    if(response[i].goal_away == null){
                        goalAway= "";
                    }else{
                        goalAway= response[i].goal_away;
                    }
                    var timeFormat = {day: 'numeric', month: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit'};
                    
                    var date;

                    var matchTime = new Date(response[i].date).getTime();
                    //When the match should terminate + 2 hours
                    var fullTimeMatch = new Date(matchTime + (2**60*60*10000));
                    var currentTime = new Date().getTime();
                    if(response[i].status == "NS" || fullTimeMatch < currentTime){
                        date = new Date(response[i].date).toLocaleString([], timeFormat);
                    }else if(response[i].status == "FT" || currentTime > fullTimeMatch ){
                        date = "Full Time";
                    }else{
                        date = "In Progress";
                    }
                    footballFixturesTable.innerHTML += 
                    `
                        <tr class="table-item fixture">
                            <td><img class="table-logo" src="`+response[i].homeLogo+`">`+ response[i].homeName+`</td>
                            <td>`+ goalHome+` - `+ goalAway+`</td>
                            <td><img class="table-logo" src="`+response[i].awayLogo+`">`+ response[i].awayName+`</td>
                            <td>`+date+`</td>
                        </tr>
                    `;
                    
                }
            });
    }else
    {
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId +'/round/'+round)
            // Convert response string to json object
            .then(response => response.json())
            .then(response => { 
                
                //Set Football Round in the header
                const roundHeaderEl = document.getElementById("footballRoundHeader");
                roundHeaderEl.innerText = response[0].round;

                //Get all rounds 
                fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId +'/round/name/all')
                    .then(response => response.json())
                    .then(response => { 
                        
                        const fixturesRoundsList = document.getElementById("roundList");
                        fixturesRoundsList.innerHTML = "";

                        for(let i = 0; i < response.length; i++){
                            
                            //set current round
                            if(response[i].current == "1"){
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item round text-bg-secondary mb-3" name="`+response[i].round+`">`+response[i].round+`</a></li>
                                `;
                            }else if(response[i].round == round){
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item active" name="`+response[i].round+`" id="selected">`+response[i].round+`</a></li>
                                `;

                            }else
                            {
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item round" name="`+response[i].round+`">`+response[i].round+`</a></li>
                                `;
                            }
                            
                        }

                        var roundItems = document.getElementsByClassName("dropdown-item round");

                        for(let i = 0; i < roundItems.length; i++) {
                            roundItems[i].onclick = function(){ setFootballFixtures(competitionId, roundItems[i].name)};
                        }

                    });

                for(let i = 0; i < response.length; i++){
                    
                    var goalHome;
                    var goalAway;

                    if(response[i].goal_home == null){
                        goalHome= "";
                    }else{
                        goalHome= response[i].goal_home;
                    }

                    if(response[i].goal_away == null){
                        goalAway= "";
                    }else{
                        goalAway= response[i].goal_away;
                    }

                    var timeFormat = {day: 'numeric', month: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit'};
                    
                    var date;

                    var matchTime = new Date(response[i].date).getTime();
                    //When the match should terminate + 2 hours
                    var fullTimeMatch = new Date(matchTime + (2**60*60*10000));
                    var currentTime = new Date().getTime();
                    if(response[i].status == "NS" || fullTimeMatch < currentTime){
                        date = new Date(response[i].date).toLocaleString([], timeFormat);
                    }else if(response[i].status == "FT" || currentTime > fullTimeMatch ){
                        date = "Full Time";
                    }else{
                        date = "In Progress";
                    }

                    footballFixturesTable.innerHTML += 
                    `
                        <tr class="table-item fixture">
                            <td><img class="table-logo" src="`+response[i].homeLogo+`">`+ response[i].homeName+`</td>
                            <td>`+ goalHome+` - `+ goalAway+`</td>
                            <td><img class="table-logo" src="`+response[i].awayLogo+`">`+ response[i].awayName+`</td>
                            <td>`+ date+`</td>
                        </tr>
                    `;
                    
                }
            });

    }
    
}

//get f1 construct standings data from the Databse  
function setF1Standing(){

    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/f1/standing/constructor')
            
    // Convert response string to json object
    .then(response => response.json())
    .then(response => { 
        
        for(let i = 0; i < response.length; i++){
            // Copy one element of response to our HTML paragraph
            constructorTableStandingEl.innerHTML += 
            `
            <tr class="table-item f1" id="`+response[i].id+`">
                <th scope="row">`+(i+1)+`</th>
                <td><img class="table-logo" src="`+response[i].logo+`">`+ response[i].name+`</td>
                <td>`+response[i].points+`</td>
            </tr>
            `;
        }
        var tableItems = document.getElementsByClassName("table-item f1");

        for(let i = 0; i < tableItems.length; i++) {
            tableItems[i].onclick = function(){ console.log(i + " - " + tableItems[i].id)};
        }
    })
    .catch(err => {
    
    // Display errors in console    
    console.log(err);
    });
}

function setDriverStanding(){

}



/*--- TEAM PAGE ---*/
//FOOTBALL TEAM
const footballSquadEl = document.getElementById("footballSquad");
const playerHeaderEl = document.getElementById('playerHeader');
const infoHeaderEl = document.getElementById('infoHeader');
const matchesHeaderEl = document.getElementById('matchesHeader');


const playersSectionEl = document.getElementById('playersSection');
const infoSectionEl = document.getElementById('infoSection');
const matchesSectionEl = document.getElementById('matchesSection');


//If on team page
if(footballSquadEl){
    let teamId = footballSquadEl.getAttribute("name"); 
    let competitionId = footballSquadEl.getAttribute("title"); 
    footballSquadEl.addEventListener("load", getTeamSquad(teamId));
    footballSquadEl.addEventListener("load", getTeamMatches(teamId));
    footballSquadEl.addEventListener("load", getNextMatch(competitionId, teamId));

    playerHeaderEl.addEventListener("click", showPlayersSection);
    infoHeaderEl.addEventListener("click", showInfoSection);
    matchesHeaderEl.addEventListener("click", showMatchesSection);
}

//Get Players of a team from the database
function getTeamSquad(teamId){
    const playersEl = document.getElementById("players-container");
    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/team/' + teamId +'/players')
            
    // Convert response string to json object
    .then(response => response.json())
    .then(response => { 
        
        for(let i = 0; i < response.length; i++){
            // Copy one element of response to our HTML paragraph
            var number; 
            var position;
            var name;
            if(!response[i].number)
                number = "NA";
            else{
                number = "#"+ response[i].number;
            }

            switch(response[i].position) {
                case "Attacker":
                    position = "st";
                    break;
                case "Midfielder":
                    position = "m";
                    break;
                case "Defender":
                    position = "d";
                    break;
                default:
                    position = "gk";
                  
            }

            if(response[i].name.length >= 16){
                name = response[i].name.split(" ").reverse()[1] + " " +response[i].name.split(" ").reverse()[0];
                if(name.length >= 16){
                    name = response[i].name.split(" ").reverse()[0];
                }
            }else{
                name = response[i].name;
            }
                
            playersEl.innerHTML += 
            `
            <div class="badge" data-tilt data-tilt-glare="true" id="`+response[i].id+`">
                <img class="badge-logo" src="`+ response[i].image +`">
                <div class="badge-name">`+ name +`</div>
                
                <div class="badge-bottom d-flex">
                    <div class="badge-position `+ position +`"><p class="center">`+position.toUpperCase()+`</p></div>
                    <div class="badge-number"><p class="center">`+ number +`</p></div>
                </div>
            </div>
            `;
            
        }

        //Refresh Tilt.js Script
        var badges = document.querySelectorAll(".badge");
        VanillaTilt.init(badges);
        
    })
    .catch(err => {
    
    // Display errors in console    
        console.log(err);
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/load/player/' + teamId)
            .then(getTeamSquad(teamId))
            .catch(err => {
        });
    });
}

//Get All Team Matches
function getTeamMatches(teamId){
    const matchesEl = document.getElementById("teamMatchesTable");
    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/team/' + teamId +'/matches')
            
    // Convert response string to json object
    .then(response => response.json())
    .then(response => {

        for(let i = 0; i < response.length; i++){
                    
            var goalHome;
            var goalAway;

            if(response[i].goal_home == null){
                goalHome= "";
            }else{
                goalHome= response[i].goal_home;
            }

            if(response[i].goal_away == null){
                goalAway= "";
            }else{
                goalAway= response[i].goal_away;
            }

            matchesEl.innerHTML += 
            `
                <tr class="table-item fixture">
                    <td><img class="table-logo" src="`+response[i].homeLogo+`">`+ response[i].homeName+`</td>
                    <td>`+ goalHome+` - `+ goalAway+`</td>
                    <td><img class="table-logo" src="`+response[i].awayLogo+`">`+ response[i].awayName+`</td>
                    <td>`+ response[i].round+`</td>
                </tr>
            `;
            
        }

    });
}

//Get Next Match of the team
function getNextMatch(competitionId, teamId){

    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/team/' + teamId +'/next')
            // Convert response string to json object
            .then(response => response.json())
            .then(response => { 
                //Set Football Round in the header
                const homeEl = document.getElementById("matchHome");
                const resultEl = document.getElementById("matchResult");
                const awayEl = document.getElementById("matchAway");
                const competitionEl = document.getElementById("matchCompetition");
                var goalHome;
                var goalAway;

                if(response.goal_home == null){
                    goalHome= "";
                }else{
                    goalHome= response.goal_home;
                }

                if(response.goal_away == null){
                    goalAway= "";
                }else{
                    goalAway= response.goal_away;
                }

                homeEl.innerHTML = `
                    <img src="`+ response.homeLogo+`">`+response.homeCode+`
                `;

                awayEl.innerHTML = `
                    <img src="`+ response.awayLogo+`">`+response.awayCode+`
                `;

                resultEl.innerText =  goalHome + " - " + goalAway;
                
                fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId)
                    .then(response => response.json())
                    .then(response => { 
                        competitionEl.innerHTML = `
                            <img class="logo-competition" id="compFootballLogo" src="`+response[0].logo+`">
                        `;

                        competitionEl.title = response[0].name;
                    });
                countDownToNextMatch(response.date);

            });
}

function countDownToNextMatch(matchDateTime){

    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
    const countDown = new Date(matchDateTime).getTime(),
    x = setInterval(function() {    

      const now = new Date().getTime(),
            distance = countDown - now;
            document.getElementById("daysMatch").innerText = Math.floor(distance / (day)),
            document.getElementById("hoursMatch").innerText = Math.floor((distance % (day)) / (hour)),
            document.getElementById("minutesMatch").innerText = Math.floor((distance % (hour)) / (minute)),
            document.getElementById("secondsMatch").innerText = Math.floor((distance % (minute)) / second);

            if (distance < 0) {
                document.getElementById("counter").classList.add("d-none");
                clearInterval(x);
            }
        });
}

//Show Player Section
function showPlayersSection(){
    infoSectionEl.classList.add("d-none");
    matchesSectionEl.classList.add("d-none");
    playersSectionEl.classList.remove("d-none");
}

//show matches section
function showMatchesSection(){
    infoSectionEl.classList.add("d-none");
    matchesSectionEl.classList.remove("d-none");
    playersSectionEl.classList.add("d-none");
}

//show Info section
function showInfoSection(){
    infoSectionEl.classList.remove("d-none");
    matchesSectionEl.classList.add("d-none");
    playersSectionEl.classList.add("d-none");
}

//Focus on the selected item in the dropdown -- NOT WORKING  
$(document).on('show.bs.dropdown','#roundGroup', function () {
    setTimeout(() => {
        $('#selected').focus();
    }, 0);
});

//Coundown
//https://codepen.io/AllThingsSmitty/pen/JJavZN
