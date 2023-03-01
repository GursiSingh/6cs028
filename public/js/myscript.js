

// inputF1El.addEventListener ("focus", displayF1Hints, false);
// inputF1El.addEventListener ("focusout", hideF1Hints, false);
//inputF1El.addEventListener ("keyup", getSearchDataF1(inputF1El.textContent), false);
console.log("My SCRIPT");

const footballTableStandingEl = document.getElementById("footballStandingTable");
const constructorTableStandingEl = document.getElementById("constructorStandingTable");

if(footballTableStandingEl){
    footballTableStandingEl.addEventListener("load", setFootballStanding(135));
    constructorTableStandingEl.addEventListener("load", setF1Standing());
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
            
            console.log(response);
            console.log(response.length);
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
    console.log("Clicked: " + id);
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
            
            console.log(response);
            console.log(response.length);
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

//get football standings data from the Databse  
function setFootballStanding(competitionId){

    // Fetch data
    fetch('https://mi-linux.wlv.ac.uk/~2042387/6cs028/ci-mySports/public/football/standing/' + competitionId)
            
    // Convert response string to json object
    .then(response => response.json())
    .then(response => { 
        
        for(let i = 0; i < response.length; i++){
            // Copy one element of response to our HTML paragraph
            footballTableStandingEl.innerHTML += 
            `
            <tr class="table-item football" id="`+response[i].id+`">
                <th scope+"row">`+(i+1)+`</th>
                <td><img src="`+response[i].logo+`" style="width: 20px; height: 20px;">`+ response[i].name+`</td>
                <td>`+response[i].points+`</td>
            </tr>
            `;
        }
        var tableItems = document.getElementsByClassName("table-item football");
        console.log(tableItems[0].id);

        for(let i = 0; i < tableItems.length; i++) {
            tableItems[i].onclick = function(){ console.log(i + " - " + tableItems[i].id)};
        }
    })
    .catch(err => {
    
    // Display errors in console    
    console.log(err);
    });
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
                <th scope+"row">`+(i+1)+`</th>
                <td><img src="`+response[i].logo+`" style="width: 30px; height: 30px; object-fit: contain;">`+ response[i].name+`</td>
                <td>`+response[i].points+`</td>
            </tr>
            `;
        }
        var tableItems = document.getElementsByClassName("table-item f1");
        console.log(tableItems[0].id);

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
