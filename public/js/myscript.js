

// inputF1El.addEventListener ("focus", displayF1Hints, false);
// inputF1El.addEventListener ("focusout", hideF1Hints, false);
//inputF1El.addEventListener ("keyup", getSearchDataF1(inputF1El.textContent), false);

/*++++ HOME ++++*/

//Football
const footballTableStandingEl = document.getElementById("footballStandingTable");
const footballFixturesTable = document.getElementById("footballFixturesTable");
const f1TableEl = document.getElementById("constructorStandingTable");

//F1
const constructorHeaderEl = document.getElementById('constructorHeader');
const driverHeaderEl = document.getElementById('driverHeader');
const constructorSectionEl = document.getElementById('constructor-section');
const driversSectionEl = document.getElementById('drivers-section');


if (footballTableStandingEl) {
    footballTableStandingEl.addEventListener("load", updateFootball(135));
    footballTableStandingEl.addEventListener("load", setFootballStanding(135));
    footballTableStandingEl.addEventListener("load", setConstructorLinks());
    footballTableStandingEl.addEventListener("load", setFootballFixtures(135));

}

if(constructorHeaderEl){
    constructorHeaderEl.addEventListener("click", showConstructorsSection);
    driverHeaderEl.addEventListener("click", showDriversSection);
}

//Update the details of the competition
function updateFootball(competitionId) {
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/update/competition/' + competitionId)
        .then()
        .catch(err => {
        });
}

//Display Element
function displayHints(el) {

    el.classList.remove("invisible");
}

//Hide Element
function hideHints(el) {


    el.classList.add("invisible");
}

//get football team data from the Databse  
function getSearchDataF1(inputEl) {

    const f1TeamList = document.getElementById("f1TeamList");
    f1TeamList.innerHTML = "";

    if (inputEl.value.length >= 3) {
        // Fetch data
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/f1/searchF1Teams/' + inputEl.value)

            // Convert response string to json object
            .then(response => response.json())
            .then(response => {


                for (let i = 0; i < response.length; i++) {
                    // Copy one element of response to our HTML paragraph
                    f1TeamList.innerHTML +=
                        `
                <div class="dropList-item f1" value="`+ response[i].id + `" name="` + response[i].name + `">
                    <img src="`+ response[i].logo + `"/>` + response[i].name + `
                </div>
                `;
                }
                var dropList = document.getElementsByClassName("dropList-item f1");
                for (let i = 0; i < dropList.length; i++) {
                    dropList[i].onclick = function () { setTeam(this, inputEl, f1TeamList, 0) };
                }
            })
            .catch(err => {

                // Display errors in console    
                console.log(err);
            });
        displayHints(f1TeamList);

    } else {
        f1TeamList.innerHTML = "";
        hideHints(f1TeamList);
    }
}

//Set Team name in the element
function setTeam(selectedEl, inputEl, listEl, type) {
    name = selectedEl.attributes["name"].value;
    id = selectedEl.attributes["value"].value;
    inputEl.title = name;

    inputEl.value = id;
    hideHints(listEl);
}

//get football team data from the Databse  
function getSearchDataFootball(inputEl) {

    const footballTeamList = document.getElementById("footballTeamList");
    footballTeamList.innerHTML = "";

    if (inputEl.value.length >= 3) {
        // Fetch data
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/searchTeams/' + inputEl.value)

            // Convert response string to json object
            .then(response => response.json())
            .then(response => {

                for (let i = 0; i < response.length; i++) {
                    // Copy one element of response to our HTML paragraph
                    footballTeamList.innerHTML +=
                        `
                <div class="dropList-item football" value="`+ response[i].id + `" name="` + response[i].name + `">
                    <img src="`+ response[i].logo + `"/>` + response[i].name + `
                </div>
                `;
                }
                var dropList = document.getElementsByClassName("dropList-item football");
                for (let i = 0; i < dropList.length; i++) {
                    dropList[i].onclick = function () { setTeam(this, inputEl, footballTeamList, 1) };
                }
            })
            .catch(err => {

                // Display errors in console    
                console.log(err);
            });
        displayHints(footballTeamList);

    } else {
        footballTeamList.innerHTML = "";
        hideHints(footballTeamList);
    }

}



/*--- WELCOME PAGE ---*/

//get football standings data from the Databse  
function setFootballStanding(competitionId) {

    footballTableStandingEl.innerHTML = "";

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

            for (let i = 0; i < response.length; i++) {

                //set current round
                if (response[i].id == competitionId) {
                    competitionListList.innerHTML += `
                        <li><a class="dropdown-item active" name="`+ response[i].id + `" id="selected">` + response[i].name + `</a></li>
                    `;

                } else {
                    competitionListList.innerHTML += `
                        <li><a class="dropdown-item competition" name="`+ response[i].id + `">` + response[i].name + `</a></li>
                    `;
                }

            }

            var competitionItems = document.getElementsByClassName("dropdown-item competition");

            for (let i = 0; i < competitionItems.length; i++) {
                competitionItems[i].onclick = function () {
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

            for (let i = 0; i < response.length; i++) {
                // Copy one element of response to our HTML paragraph
                footballTableStandingEl.innerHTML +=
                    `
            <tr class="table-item football clickable" id = "`+ response[i].id + `">
                <th scope+"row">`+ (i + 1) + `</th>
                <td class="left"><img class="table-logo" src="`+ response[i].logo + `">` + response[i].name + `</td>
                <td>`+ response[i].points + `</td>
            </tr>
            `;
            }
            var tableItems = document.getElementsByClassName("table-item football");

            for (let i = 0; i < tableItems.length; i++) {
                tableItems[i].onclick = function () { window.location.href = base_url + "/football/team/" + tableItems[i].id; };
            }
        })
        .catch(err => {

            // Display errors in console    
            console.log(err);
        });
}

//get football competition fixtures
function setFootballFixtures(competitionId, round = null) {
    footballFixturesTable.innerHTML = '';
    // Fetch data get current round
    if (round == null) {
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId + '/round')
            // Convert response string to json object
            .then(response => response.json())
            .then(response => {


                //Set Football Round in the header
                const roundHeaderEl = document.getElementById("footballRoundHeader");
                roundHeaderEl.innerText = response[0].round;

                //Get all rounds 
                fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId + '/round/name/all')
                    .then(response => response.json())
                    .then(response => {

                        const fixturesRoundsList = document.getElementById("roundList");
                        fixturesRoundsList.innerHTML = "";

                        for (let i = 0; i < response.length; i++) {

                            //set current round
                            if (response[i].current == "1") {
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item active" name="`+ response[i].round + `" id="selected">` + response[i].round + `</a></li>
                                `;

                            } else {
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item round" name="`+ response[i].round + `">` + response[i].round + `</a></li>
                                `;
                            }

                        }

                        var roundItems = document.getElementsByClassName("dropdown-item round");

                        for (let i = 0; i < roundItems.length; i++) {
                            roundItems[i].onclick = function () { setFootballFixtures(competitionId, roundItems[i].name) };
                        }

                    });

                for (let i = 0; i < response.length; i++) {

                    var goalHome;
                    var goalAway;

                    if (response[i].goal_home == null) {
                        goalHome = "";
                    } else {
                        goalHome = response[i].goal_home;
                    }

                    if (response[i].goal_away == null) {
                        goalAway = "";
                    } else {
                        goalAway = response[i].goal_away;
                    }
                    var timeFormat = { day: 'numeric', month: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false };

                    var date;

                    var matchTime = new Date(response[i].date).getTime();
                    //When the match should terminate + 2 hours
                    var fullTimeMatch = new Date(matchTime + (2 ** 60 * 60 * 10000));
                    var currentTime = new Date().getTime();
                    if (response[i].status == "NS" || fullTimeMatch < currentTime) {
                        var timeFormat = { day: 'numeric', month: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false };
                        date = new Date(response[i].date).toLocaleString("en-GB", timeFormat);

                        var abbrTimeFormat = { day: 'numeric', month: 'numeric', year: 'numeric'};
                        abbrDate = new Date(response[i].date).toLocaleString("en-GB", abbrTimeFormat);
                    } else if (response[i].status == "FT" || currentTime > fullTimeMatch) {
                        date = "Full Time";
                        abbrDate = "FT"
                    } else {
                        date = "In Progress";
                        abbrDate = "LIVE";
                    }
                    footballFixturesTable.innerHTML +=
                        `
                        <tr class="table-item fixture">
                            <td style="text-align: right">
                                <p class="full-text">` + response[i].homeName + `</p>
                                <p class="abbr-text" style="font-size: 0.8rem">` + response[i].homeCode + `</p>
                                <img class="table-logo" src="`+ response[i].homeLogo + `" style=";margin-right:0px; margin-left: 2px;">
                            </td>
                            <td class="text-center">`+ goalHome + ` - ` + goalAway + `</td>
                            <td style="text-align: left">
                                <img class="table-logo" src="`+ response[i].awayLogo + `" style=";margin-left:0px; margin-right: 2px;">
                                <p class="full-text">` + response[i].awayName + `</p>
                                <p class="abbr-text" style="font-size: 0.8rem">` + response[i].awayCode + `</p>
                            </td>
                            <td>
                                <p class="full-text">` + date + `</p>
                                <p class="abbr-text" style="font-size: 0.7rem">` + abbrDate + `</p>
                            </td>
                        </tr>
                    `;

                }
            });
    } else {
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId + '/round/' + round)
            // Convert response string to json object
            .then(response => response.json())
            .then(response => {

                //Set Football Round in the header
                const roundHeaderEl = document.getElementById("footballRoundHeader");
                roundHeaderEl.innerText = response[0].round;

                //Get all rounds 
                fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId + '/round/name/all')
                    .then(response => response.json())
                    .then(response => {

                        const fixturesRoundsList = document.getElementById("roundList");
                        fixturesRoundsList.innerHTML = "";

                        for (let i = 0; i < response.length; i++) {

                            //set current round
                            if (response[i].current == "1") {
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item round text-bg-secondary mb-3" name="`+ response[i].round + `">` + response[i].round + `</a></li>
                                `;
                            } else if (response[i].round == round) {
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item active" name="`+ response[i].round + `" id="selected">` + response[i].round + `</a></li>
                                `;

                            } else {
                                fixturesRoundsList.innerHTML += `
                                    <li><a class="dropdown-item round" name="`+ response[i].round + `">` + response[i].round + `</a></li>
                                `;
                            }

                        }

                        var roundItems = document.getElementsByClassName("dropdown-item round");

                        for (let i = 0; i < roundItems.length; i++) {
                            roundItems[i].onclick = function () { setFootballFixtures(competitionId, roundItems[i].name) };
                        }

                    });

                for (let i = 0; i < response.length; i++) {

                    var goalHome;
                    var goalAway;

                    if (response[i].goal_home == null) {
                        goalHome = "";
                    } else {
                        goalHome = response[i].goal_home;
                    }

                    if (response[i].goal_away == null) {
                        goalAway = "";
                    } else {
                        goalAway = response[i].goal_away;
                    }

                    var timeFormat = { day: 'numeric', month: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false };

                    var date;

                    var matchTime = new Date(response[i].date).getTime();
                    //When the match should terminate + 2 hours
                    var fullTimeMatch = new Date(matchTime + (2 ** 60 * 60 * 10000));
                    var currentTime = new Date().getTime();
                    if (response[i].status == "NS" || fullTimeMatch < currentTime) {
                        var timeFormat = { day: 'numeric', month: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false };
                        date = new Date(response[i].date).toLocaleString("en-GB", timeFormat);

                        var abbrTimeFormat = { day: 'numeric', month: 'numeric', year: 'numeric'};
                        abbrDate = new Date(response[i].date).toLocaleString("en-GB", abbrTimeFormat);
                    }else if(response[i].status == "TBD"){
                        var timeFormat = { day: 'numeric', month: 'numeric', year: 'numeric'};
                        date = new Date(response[i].date).toLocaleString("en-GB", timeFormat);
                        abbrDate = date;
                    } else if (response[i].status == "FT" || currentTime > fullTimeMatch) {
                        date = "Full Time";
                        abbrDate = "FT"
                    } else {
                        date = "In Progress";
                        abbrDate = "LIVE";
                    }
                    footballFixturesTable.innerHTML +=
                        `
                        <tr class="table-item fixture">
                            <td style="text-align: right">
                                <p class="full-text">` + response[i].homeName + `</p>
                                <p class="abbr-text" style="font-size: 0.8rem">` + response[i].homeCode + `</p>
                                <img class="table-logo" src="`+ response[i].homeLogo + `" style=";margin-right:0px; margin-left: 2px;">
                            </td>
                            <td class="text-center">`+ goalHome + ` - ` + goalAway + `</td>
                            <td style="text-align: left">
                                <img class="table-logo" src="`+ response[i].awayLogo + `" style=";margin-left:0px; margin-right: 2px;">
                                <p class="full-text">` + response[i].awayName + `</p>
                                <p class="abbr-text" style="font-size: 0.8rem">` + response[i].awayCode + `</p>
                            </td>
                            <td>
                                <p class="full-text">` + date + `</p>
                                <p class="abbr-text" style="font-size: 0.7rem">` + abbrDate + `</p>
                            </td>
                        </tr>
                    `;

                }
            });

    }

}

//Show Constructor Standing Section
function showConstructorsSection() {
    constructorSectionEl.classList.remove("d-none");
    driversSectionEl.classList.add("d-none");
}

//Show Driver Standing Section
function showDriversSection() {
    constructorSectionEl.classList.add("d-none");
    driversSectionEl.classList.remove("d-none");
}

function setConstructorLinks() {

    var tableItems = document.getElementsByClassName("table-item f1 clickable");

    for (let i = 0; i < tableItems.length; i++) {
        tableItems[i].onclick = function () { window.location.href = base_url + "/f1/team/" + tableItems[i].id; };
    }
}


/*--- MY TEAM ---*/
//Calendar
calendarEl = document.getElementById("calendar");
prevMonthEl = document.getElementById("prevMonth");
nextMonthEl = document.getElementById("nextMonth");

if (calendarEl) {
    var month = new Date().getMonth() + 1;
    var year = new Date().getFullYear();
    calendarEl.addEventListener("load", createCalendar(month, year));
    nextMonthEl.onclick = function () { nextMonth(month) };
    prevMonthEl.onclick = function () { previousMonth(month) };
}

//build calendar of selected month
function createCalendar(month, year) {
    const teamId = document.getElementById("teamFootball").getAttribute("name");
    const f1TeamId = document.getElementById("teamF1").getAttribute("name");


    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1;
    var currentYear = currentDate.getFullYear();
    var currentDay = 0;

    if (currentMonth == month && currentYear == year) {
        currentDay = currentDate.getDate();
    }

    var numberOfDays = getNumberOfDays(month, year);
    const yearEl = document.getElementById("year");
    const monthEl = document.getElementById("month");
    const daysEl = document.getElementById("days");

    const f1ImgEl = document.getElementById("f1ImgEl");

    date = new Date(month + "/1/" + year);
    const monthName = date.toLocaleString('default', { month: 'long' });
    //Clear days
    daysEl.innerHTML = " ";

    //set month and date
    monthEl.innerText = monthName;
    monthEl.value = month;
    yearEl.innerText = year;
    yearEl.value = year;

    //check what weekday is the first of the month
    firstWeekDay = date.getDay();

    //Add invisible elments
    for (let i = 1; i < firstWeekDay; i++) {
        daysEl.innerHTML += `
            <li class="invisible">0</li>
        `;
    }

    var footballMatches;
    //fetch football team matches of the month
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/team/' + teamId + '/month/' + month + '/year/' + year)
        // Convert response string to json object
        .then(response => response.json())
        .then(response => {

            fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/f1/event/month/' + month + '/year/' + year)
                // Convert response string to json object
                .then(response => response.json())
                .then(f1Response => {


                    for (let i = 0; i < numberOfDays; i++) {

                        temp_day = i + 1;
                        daysEl.innerHTML += `
                    <li id="day`+ temp_day + `">` + temp_day + `</li>`;

                        for (let x = 0; x < response.length; x++) {

                            day = response[x].date.split(" ")[0].split("-")[2];
                            var teamLogo;

                            if (day == temp_day) {
                                dayEl = document.getElementById("day" + temp_day);
                                if (response[x].away == teamId) {
                                    teamLogo = response[x].homeLogo;

                                } else if (response[x].home == teamId) {
                                    teamLogo = response[x].awayLogo;
                                }
                                if (currentDay == (i + 1)) {
                                    daysEl.classList.add("active");
                                }

                                dayEl.innerHTML += `
                                <ul class="text-center">
                                    <div class="football-event" id="event`+ temp_day + `">
                                        <div class="logoTeam">
                                            <img src="`+ teamLogo + `" style="max-width: 55px; height: 35px;">
                                        </div>
                                    </div>

                                </ul>
                            `;
                            }
                        }

                        for (let y = 0; y < f1Response.length; y++) {

                            day = f1Response[y].date.split(" ")[0].split("-")[2];

                            if (day == temp_day) {
                                eventEl = document.getElementById("event" + temp_day);
                                var eventTime = new Date(f1Response[y].date).toLocaleString('default', { hour: '2-digit', minute: '2-digit', hour12: false });
                                console.log("Time: " + eventTime);

                                if (f1Response[y].type === "3rd Qualifying" || f1Response[y].type === "2nd Qualifying") {

                                } else {

                                    if (eventEl) {
                                        eventEl.innerHTML += `
                                        <div class="logoTeam" title="`+ f1Response[y].type + ` \n` + eventTime + `">
                                            <img src="`+ f1ImgEl.getAttribute("src") + `" style="max-width: 55px; height: 35px;">
                                        </div>
                                    `;
                                    } else {

                                        dayEl = document.getElementById("day" + temp_day);
                                        dayEl.innerHTML += `
                                        <ul class="text-center">
                                            <div class="football-event" id="event`+ temp_day + `">
                                                <div class="logoTeam" title="`+ f1Response[y].type + ` \n` + eventTime + `"> 
                                                    <img src="`+ f1ImgEl.getAttribute("src") + `" style="max-width: 55px; height: 35px;">
                                                </div>
                                            </div>
        
                                        </ul>
                                    `;
                                    }

                                }

                            }
                        }


                    }
                });
        });

}

function nextMonth() {

    const yearEl = document.getElementById("year");
    const monthEl = document.getElementById("month");
    console.log(yearEl.value);
    if (monthEl.value < 12) {
        createCalendar(monthEl.value + 1, yearEl.value);
    } else {
        createCalendar(1, yearEl.value + 1);
    }
}

function previousMonth() {
    const yearEl = document.getElementById("year");
    const monthEl = document.getElementById("month");

    if (monthEl.value > 1) {
        createCalendar(monthEl.value - 1, yearEl.value);
    } else {
        createCalendar(12, yearEl.value - 1);
    }
}

//get days in a month https://natclark.com/tutorials/javascript-days-in-month/
function getNumberOfDays(month, year) {
    return new Date(year, month, 0).getDate();
}

//check if the 1st of the month is monday
function isMonday(month, year) {

}



/*--- FOOTBALL TEAM PAGE ---*/
//FOOTBALL TEAM
const footballSquadEl = document.getElementById("footballSquad");
const playerHeaderEl = document.getElementById('playerHeader');
const infoHeaderEl = document.getElementById('infoHeader');
const matchesHeaderEl = document.getElementById('matchesHeader');


const playersSectionEl = document.getElementById('playersSection');
const infoSectionEl = document.getElementById('infoSection');
const matchesSectionEl = document.getElementById('matchesSection');


//If on team page
if (footballSquadEl) {
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
function getTeamSquad(teamId) {
    const playersEl = document.getElementById("players-container");
    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/team/' + teamId + '/players')

        // Convert response string to json object
        .then(response => response.json())
        .then(response => {

            for (let i = 0; i < response.length; i++) {
                // Copy one element of response to our HTML paragraph
                var number;
                var position;
                var name;
                if (!response[i].number)
                    number = "NA";
                else {
                    number = "#" + response[i].number;
                }

                switch (response[i].position) {
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

                if (response[i].name.length >= 16) {
                    name = response[i].name.split(" ").reverse()[1] + " " + response[i].name.split(" ").reverse()[0];
                    if (name.length >= 16) {
                        name = response[i].name.split(" ").reverse()[0];
                    }
                } else {
                    name = response[i].name;
                }

                playersEl.innerHTML +=
                    `
            <div class="badge" data-tilt data-tilt-glare="true" id="`+ response[i].id + `">
                <img class="badge-logo" src="`+ response[i].image + `">
                <div class="badge-name">`+ name + `</div>
                
                <div class="badge-bottom d-flex">
                    <div class="badge-position `+ position + `"><p class="center">` + position.toUpperCase() + `</p></div>
                    <div class="badge-number"><p class="center">`+ number + `</p></div>
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
function getTeamMatches(teamId) {
    const matchesEl = document.getElementById("teamMatchesTable");
    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/team/' + teamId + '/matches')

        // Convert response string to json object
        .then(response => response.json())
        .then(response => {

            for (let i = 0; i < response.length; i++) {

                var goalHome;
                var goalAway;

                if (response[i].goal_home == null) {
                    goalHome = "";
                } else {
                    goalHome = response[i].goal_home;
                }

                if (response[i].goal_away == null) {
                    goalAway = "";
                } else {
                    goalAway = response[i].goal_away;
                }

                matchesEl.innerHTML +=
                    `
                <tr class="table-item fixture">
                    <td><img class="table-logo" src="`+ response[i].homeLogo + `">` + response[i].homeName + `</td>
                    <td>`+ goalHome + ` - ` + goalAway + `</td>
                    <td><img class="table-logo" src="`+ response[i].awayLogo + `">` + response[i].awayName + `</td>
                    <td>`+ response[i].round + `</td>
                </tr>
            `;

            }

        });
}

//Get Next Match of the team
function getNextMatch(competitionId, teamId) {

    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/team/' + teamId + '/next')
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

            if (response.goal_home == null) {
                goalHome = "";
            } else {
                goalHome = response.goal_home;
            }

            if (response.goal_away == null) {
                goalAway = "";
            } else {
                goalAway = response.goal_away;
            }

            homeEl.innerHTML = `
                    <img src="`+ response.homeLogo + `">` + response.homeCode + `
                `;

            awayEl.innerHTML = `
                    <img src="`+ response.awayLogo + `">` + response.awayCode + `
                `;

            resultEl.innerText = goalHome + " - " + goalAway;

            fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/competition/' + competitionId)
                .then(response => response.json())
                .then(response => {
                    competitionEl.innerHTML = `
                            <img class="logo-competition" id="compFootballLogo" src="`+ response[0].logo + `">
                        `;

                    competitionEl.title = response[0].name;
                });
            countDownToNextMatch(response.date);

        });
}

function countDownToNextMatch(matchDateTime) {

    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
    const countDown = new Date(matchDateTime).getTime(),
        x = setInterval(function () {

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
function showPlayersSection() {
    infoSectionEl.classList.add("d-none");
    matchesSectionEl.classList.add("d-none");
    playersSectionEl.classList.remove("d-none");
}

//show matches section
function showMatchesSection() {
    infoSectionEl.classList.add("d-none");
    matchesSectionEl.classList.remove("d-none");
    playersSectionEl.classList.add("d-none");
}

//show Info section
function showInfoSection() {
    infoSectionEl.classList.remove("d-none");
    matchesSectionEl.classList.add("d-none");
    playersSectionEl.classList.add("d-none");
}

//Focus on the selected item in the dropdown -- NOT WORKING  
$(document).on('show.bs.dropdown', '#roundGroup', function () {
    setTimeout(() => {
        $('#selected').focus();
    }, 0);
});


/*--- F1 TEAM PAGE ---*/
var counterEl = document.getElementById("f1Counter");
var f1SquadEl = document.getElementById("f1Squad");

//on page load
if (counterEl) {
    counterEl.addEventListener("load", nextRaceCountdown());
    f1SquadEl.addEventListener("load", teamRaces(f1SquadEl.getAttribute("name")));

}


//Set/Get next race
function nextRaceCountdown() {

    console.log("F1Counter");
    var raceDateTime = document.getElementById("f1Counter").getAttribute("value");

    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
    const countDown = new Date(raceDateTime).getTime(),
        x = setInterval(function () {

            const now = new Date().getTime(),
                distance = countDown - now;
            document.getElementById("daysRace").innerText = Math.floor(distance / (day)),
                document.getElementById("hoursRace").innerText = Math.floor((distance % (day)) / (hour)),
                document.getElementById("minutesRace").innerText = Math.floor((distance % (hour)) / (minute)),
                document.getElementById("secondsRace").innerText = Math.floor((distance % (minute)) / second);

            if (distance < 0) {
                document.getElementById("f1Counter").classList.add("d-none");
                clearInterval(x);
            }
        });
}


//Get All Team Races
function teamRaces(teamId) {
    const racesEl = document.getElementById("teamRacesTable");
    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/f1/constructor/' + teamId + '/races')

        // Convert response string to json object
        .then(response => response.json())
        .then(response => {
            console.log(response[0].driverPositions[0].driver_logo);
            for (let i = 0; i < response.length; i++) {

                var goalHome;
                var goalAway;

                if (response[i].status === "Completed") {
                    racesEl.innerHTML +=
                        `
                    <tr class="table-item race">
                        <td>`+ response[i].circuit.country + `</td>
                        <td><img class="table-logo" src="`+ response[i].driverPositions[0].driver_logo + `"></td>
                        <td>`+ response[i].driverPositions[0].position + `</td>
                        <td>Completed</td>
                    </tr>
                `;

                    racesEl.innerHTML +=
                        `
                    <tr class="table-item race">
                        <td>`+ response[i].circuit.country + `</td>
                        <td><img class="table-logo" src="`+ response[i].driverPositions[1].driver_logo + `"></td>
                        <td>`+ response[i].driverPositions[1].position + `</td>
                        <td>Completed</td>
                    </tr>
                `;


                } else {
                    racesEl.innerHTML +=
                        `
                    <tr class="table-item race">
                        <td>`+ response[i].circuit.country + `</td>
                        <td><img class="table-logo" src="`+ response[i].team.logo + `"></td>
                        <td>NA</td>
                        <td>`+ response[i].date + `</td>
                    </tr>
                `;
                }
            }

        });

}
//Coundown
//https://codepen.io/AllThingsSmitty/pen/JJavZN