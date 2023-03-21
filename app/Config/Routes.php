<?php

    namespace Config;
    use App\Controllers\Ajax;
    use App\Controllers\API;
    use App\Controllers\Football;
    use App\Controllers\F1;

    // Create a new instance of our RouteCollection class.
    $routes = Services::routes();

    /*
    * --------------------------------------------------------------------
    * Router Setup
    * --------------------------------------------------------------------
    */
    $routes->setDefaultNamespace('App\Controllers');
    $routes->setDefaultController('Home');
    $routes->setDefaultMethod('index');
    $routes->setTranslateURIDashes(false);
    $routes->set404Override();
    // The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
    // where controller filters or CSRF protection are bypassed.
    // If you don't want to define all routes, please use the Auto Routing (Improved).
    // Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
    // $routes->setAutoRoute(false);

    /*
    * --------------------------------------------------------------------
    * Route Definitions
    * --------------------------------------------------------------------
    */

    // We get a performance increase by specifying the default
    // route since we don't have to scan directories.
    $routes->get('/', 'Home::index');

    // API Calls - Football
    $routes->match(['get', 'post'], '/football/load/competition/(:segment)', [API::class, 'loadCompetition']);
    $routes->match(['get', 'post'], '/football/load/player/(:segment)', [API::class, 'loadTeamPlayers']);
    $routes->match(['get', 'post'], '/football/load/competition/(:segment)/fixtures', [API::class, 'loadFixtures']);
    $routes->match(['get', 'post'], '/football/load/competition/(:segment)/team/(:segment)/(:segment)', [API::class, 'loadTeam']);
    $routes->match(['get', 'post'], '/football/update/competition/(:segment)', [API::class, 'updateFootball']);
    
    // API Calls - F1
    $routes->match(['get', 'post'], '/f1/load/teams', [API::class, 'loadF1Teams']);
    $routes->match(['get', 'post'], '/f1/load/drivers', [API::class, 'loadF1Drivers']);
    $routes->match(['get', 'post'], '/f1/load/races', [API::class, 'loadF1Races']);
    $routes->match(['get', 'post'], '/f1/load/race/(:segment)/ranking', [API::class, 'loadF1RaceRanking']);
    $routes->match(['get', 'post'], '/f1/update', [API::class, 'updateF1']);
    

    //USER
    $routes->match(['get', 'post'],'/login', 'User::login');
    $routes->match(['get', 'post'], '/signUp', 'User::signUp');
    $routes->match(['get', 'post'], '/account', 'User::index');
    $routes->get('/logout', 'User::logout');

    //F1
    $routes->get('/f1', [F1::class,'index']);
    $routes->get('/f1/searchF1Teams/(:segment)', [Ajax::class,'searchF1Teams']);
    $routes->get('/f1/constructor/(:segment)/races', [Ajax::class,'getTeamRacesPosition']);
    $routes->get('/f1/team/(:segment)', [F1::class,'displayTeam']);
    $routes->get('/f1/races/ranking', [Ajax::class,'getLastRaceRanking']);
    $routes->get('/f1/race/(:segment)/ranking', [Ajax::class,'getRankingById']);
    
    $routes->get('/f1/event/month/(:segment)/year/(:segment)', [Ajax::class,'getMonthRaces']);
    $routes->get('/f1/events/', [Ajax::class,'getAllEvents']);
    $routes->get('/f1/events/circuit/(:segment)', [Ajax::class,'getF1Event']);
    

    //Football
    $routes->get('/football', [Football::class,'index']);
    $routes->get('/football/searchTeams/(:segment)', [Ajax::class,'searchFootballTeams']);
    $routes->get('/football/standing/(:segment)', [Ajax::class,'getCompetitionStandings']);
    $routes->get('/football/team/(:segment)', [Football::class,'displayTeam']);

    $routes->get('/football/team/(:segment)/players/filter/(:segment)', [Ajax::class,'getTeamSquad']);
    $routes->get('/football/team/(:segment)/players/position/(:segment)', [Ajax::class,'getSquadByPosition']);
    $routes->get('/football/team/(:segment)/players/(:segment)/filter/(:segment)', [Ajax::class,'searchPlayersInTeam']);

    $routes->get('/football/team/(:segment)/matches', [Ajax::class,'getAllTeamMatches']);
    $routes->get('/football/team/(:segment)/month/(:segment)/year/(:segment)', [Ajax::class,'getTeamMonthMatches']);
    $routes->get('/football/team/(:segment)/next', [Ajax::class,'getNextMatch']);
    $routes->get('/football/competition/(:segment)', [Ajax::class,'getCompetition']);
    $routes->get('/football/competition/country/(:segment)', [Ajax::class,'getCompetitionByCountry']);
    $routes->get('/football/competition', 'Ajax::getAllCompetitions');
    $routes->get('/football/competition/(:segment)/round', [Ajax::class,'getFootballRound']);
    $routes->get('/football/competition/(:segment)/round/(:segment)', [Ajax::class,'getFootballRound']);
    $routes->get('/football/competition/(:segment)/round/name/all', [Ajax::class,'getAllFootballRounds']);


    /*
    * --------------------------------------------------------------------
    * Additional Routing
    * --------------------------------------------------------------------
    *
    * There will often be times that you need additional routing and you
    * need it to be able to override any defaults in this file. Environment
    * based routes is one such time. require() additional route files here
    * to make that happen.
    *
    * You will have access to the $routes object within that file without
    * needing to reload it.
    */
    if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
        require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
    }
?>
