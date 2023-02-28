
const inputF1El = document.getElementById('inputF1Team');
// inputF1El.addEventListener ("focus", displayF1Hints, false);
// inputF1El.addEventListener ("focusout", hideF1Hints, false);
//inputF1El.addEventListener ("keyup", getSearchDataF1(inputF1El.textContent), false);
console.log("My SCRIPT");

function displayF1Hints(){

    const f1TeamList = document.getElementById('f1TeamList');

    f1TeamList.classList.remove("invisible");
}

function hideF1Hints(){

    const f1TeamList = document.getElementById('f1TeamList');

    f1TeamList.classList.add("invisible");
}


function getSearchDataF1(slug){

    document.getElementById("f1TeamList").innerHTML = "";

    if(slug.value.length >= 3){
        // Fetch data
        fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/f1/searchF1Teams/' + slug.value)
            
        // Convert response string to json object
        .then(response => response.json())
        .then(response => { 
            
            console.log(response);
            console.log(response.length);
            for(let i = 0; i < response.length; i++){
                // Copy one element of response to our HTML paragraph
                document.getElementById("f1TeamList").innerHTML += 
                `
                <div class="dropList-item" value="`+response[i].id +`" name="`+ response[i].name +`">
                    <img src="`+response[i].logo +`"/>`+response[i].name +`
                </div>
                `;
            }
            var dropList = document.getElementsByClassName("dropList-item");
            for(var i = 0; i < dropList.length; i++) {
                dropList[i].onclick = function(){ setTeamF1(this)};
            }
        })
        .catch(err => {
        
        // Display errors in console    
        console.log(err);
        });
        displayF1Hints();

    }else{
        document.getElementById("f1TeamList").innerHTML = "";
        hideF1Hints();
    }
}


function setTeamF1(el){
    name = el.attributes["name"].value;
    id = el.attributes["value"].value;
    console.log("Clicked: " + name);
    inputF1El.value = name;
    hideF1Hints();
}


//document.onload(loadCompetition(135));

function loadCompetition(id){
    var myHeaders = new Headers();
    myHeaders.append("x-rapidapi-key", "c6e2eba6888143bbe4a8e8ae1160a59a");
    myHeaders.append("x-rapidapi-host", "v3.football.api-sports.io");

    var requestOptions = {
    method: 'GET',
    headers: myHeaders,
    redirect: 'follow'
    };

    fetch("https://v3.football.api-sports.io/standings?league="+id+"&season=2022", requestOptions)
    .then(response => response.json())
    .then(result => {
        
        console.log(result)

        competition = result["response"][0].league;
        standings = competition.standings;


        //store competition into phpMyAdmin
        //id, name, country, logo, flag


        //store team
        //i->team.id -> points
        for(let i = 0; i < standings.length;i++){
            //loadTeam(standings[i].team.id,standings[i].points, id);
        }

        console.log(competition);
        console.log(standings);
    
    
    })
    .catch(error => console.log('error', error));
}


function loadTeam(id, points, competitionId){

    //IF team not in ci_teams

    var myHeaders = new Headers();
    myHeaders.append("x-rapidapi-key", "c6e2eba6888143bbe4a8e8ae1160a59a");
    myHeaders.append("x-rapidapi-host", "v3.football.api-sports.io");

    var requestOptions = {
    method: 'GET',
    headers: myHeaders,
    redirect: 'follow'
    };

    fetch("https://v3.football.api-sports.io/teams?id="+id, requestOptions)
    .then(response => response.json())
    .then(result => {
        
        console.log(result)

        team = result["response"][0].team;
        venue = result["response"][0].team;

        venueId = venue.id;

        //store venue
        //id, name, address, city, capacity, image


        //store team
        //id, name, code, league_competition, logo, founded, points, venue
            
    
    })
    .catch(error => console.log('error', error));
}
