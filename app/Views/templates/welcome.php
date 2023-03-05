
<script>

    // // Creating a cookie after the document is ready
    // $(document).ready(function () {
    //     createCookie("gfg", "GeeksforGeeks", "10");
    // });
    // var myHeaders = new Headers();
    // myHeaders.append("x-rapidapi-key", "c6e2eba6888143bbe4a8e8ae1160a59a");
    // myHeaders.append("x-rapidapi-host", "v1.formula-1.api-sports.io");

    // var requestOptions = {
    // method: 'GET',
    // headers: myHeaders,
    // redirect: 'follow'
    // };

    // fetch("https://v1.formula-1.api-sports.io/rankings/teams?season=2022", requestOptions)
    //     .then(response => response.json())
    //     .then(response =>setTeams(response['response']))
    //     .catch(error => console.log('error', error));



    
    // function setTeams(response){

    //     for(let i = 0; i < response.length; i++){

    //     }
    //     document.cookies = response;
    // }
    // var i = 22;

    // var settings = {
    //     "url": "https://v1.formula-1.api-sports.io/rankings/teams?season=2022",
    //     "method": "GET",
    //     "timeout": 0,
    //     "headers": {
    //         "x-rapidapi-key": "c6e2eba6888143bbe4a8e8ae1160a59a",
    //         "x-rapidapi-host": "v1.formula-1.api-sports.io"
    //     },
    // };
    
    // $.ajax(settings).done(function (response) {
    //     $.ajax({
    //             type: "POST",
    //             data: {"data":response["response"]},
    //             url: "?= base_url('/load') ?>",
    //             success: function(data)
    //             {
    //               alert(data);

    //             }
    //         });
    // });

</script>

<div class="container-fluid text-center vh-100 text-bg-dark" >
    <div class="position-relative m-auto" style="height:100%">
        <main class="position-absolute top-50 start-50 translate-middle">
            <h1 class="fs-1 fw-bolder">Welcome!</h1>
            <p class="lead">Welcome on this website, where you can follow your favorite football and f1 teams.</p>    
        </main>
        
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4 pb-5">
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style=" height: 30rem;">
                <div class="card-header d-flex">
                    <div class="">
                        <div class="container-fluid">
                            <a class="navbar-brand">Competition Name Standing</a>
                            <form class="d-flex " role="search">
                                <input class="form-control me-2" type="search" placeholder="Search Competition" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
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
                            <tbody id="footballStandingTable">
                                
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style=" height: 30rem;">
                <div class="card-header d-flex">
                    <div class="title-card" id="footballRound">Round: 25</div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" id="fixturesRounds">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Home</th>  
                                    <th scope="col">Result</th>
                                    <th scope="col">Away</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody id="footballFixturesTable">
                                <tr class="table-item fixture">
                                    <td><img class="table-logo" src="`+response[i].logo+`">`+ response[i].name+`</td>
                                    <td> - </td>
                                    <td><img class="table-logo" src="`+response[i].logo+`">`+ response[i].name+`</td>
                                    <td>05/03/2023 18:30</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark" style="height: 30rem;">
                <div class="card-header container">
                    <ul class="nav nav-tabs nav-fill card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3 active text-white" aria-current="true" href="#">F1 Constructors Standings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3 text-muted" href="#">F1 Driver Standings</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>  
                                    <th scope="col">Name</th>
                                    <th scope="col">Points</th>
                                </tr>
                            </thead>
                            <tbody id="constructorStandingTable">
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card pb-3 border-light text-bg-dark">
                <div class="card-header" container>
                    <h5 class="card-title">Card title</h5>
                </div>
                <div class="card-body">
                    
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
    </div>
</div>


