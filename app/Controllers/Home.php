<?php

    namespace App\Controllers;
    
	use App\Models\FootballCompetitionModel;
	use App\Models\FootballTeamModel;
    use App\Models\FootballFixtureModel;

    use App\Models\F1Model;
    use App\Models\F1DriverModel;
    use App\Models\F1EventModel;
    use App\Models\F1CircuitModel;

    class Home extends BaseController
    {
        public function index(){
            $session = session();

            //Football Model
			$teamModel = model(FootballTeamModel::class);
            

            //F1 Model
            $constructorModel = model(F1Model::class);
            $driverModel = model(F1DriverModel::class);
            $eventModel = model(F1EventModel::class);
            $circuitModel = model(F1CircuitModel::class);
            
            $header['title']='Home';
            $header['user']=$session->get('user');
            $data['constructor'] = $constructorModel->getStanding();

            if(empty($header['user'])){

                
                $drivers = $driverModel->getStanding();
                
                for($i= 0; $i < sizeOf($drivers); $i++){
                    
                    $teamId = $drivers[$i]['team'];
                    for($x= 0; $x < sizeOf($data['constructor']); $x++){
                        if($data['constructor'][$x]['id'] == $teamId){
                            $drivers[$i]['teamName'] = $data['constructor'][$x]['name'];
                            $drivers[$i]['teamLogo'] = $data['constructor'][$x]['logo'];
                        }
                    }
                }
                $data['drivers'] = $drivers;
                

                //Get next Event Circuit Id
                $circuitId  = $eventModel->getNextEventCircuitid()['circuitId'];

                $circuit = $circuitModel->getCircuit($circuitId);
                
                $data['circuit'] = $circuit;
                //Get all events in that circuit
                $event = $eventModel->getNextEventsByCircuit($circuitId);
                

                //Get list of all races in the Event
                $racesList = $eventModel->getAllRaces();
                

                //Get Event Number
                for($i= 0; $i < sizeOf($racesList); $i++){

                    if($racesList[$i]['circuitId'] == $circuitId){
                        $data['eventNumber'] = $i +1;
                    }
                }

                //Set Events Item
                $data['f1Events'] = $event;

                //if user is not logged in
                return view('templates/header', $header)
                    . view('templates/welcome', $data)
                    . view('templates/footer');
            }else{
                
                $user = $header['user'];
                $data['team'] = $teamModel->getTeam($user['football_team'])[0];
                $data['position'] = $teamModel->getTeamPosition($data['team']['league_competition'], $user['football_team']);
                $data['f1Team'] = $constructorModel->getTeam($user['f1_team'])[0];

                for($x= 0; $x < sizeOf($data['constructor']); $x++){
                    if($data['constructor'][$x]['id'] == $user['f1_team']){
                        $data['f1Position'] = $x + 1;
                    }
                }

                //if user is logged in
                return view('templates/header', $header)
                    . view('templates/myTeam', $data)
                    . view('templates/footer');
            }

            

            
        }
    }
?>
