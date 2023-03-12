<?php

    namespace App\Controllers;

    use App\Models\F1Model;
    use App\Models\F1DriverModel;
    use App\Models\F1EventModel;
    use App\Models\F1CircuitModel;
    use App\Models\F1RankingModel;

    class F1 extends BaseController{

        public function index(){
            $session = session();
            $header['title']='F1 Home';
            $header['user']=$session->get('user');

            //F1 Model
            $constructorModel = model(F1Model::class);
            $driverModel = model(F1DriverModel::class);
            $eventModel = model(F1EventModel::class);
            $circuitModel = model(F1CircuitModel::class);
            $raceRankingModel = model(F1RankingModel::class);

            $drivers = $driverModel->getStanding();
            $data['constructor'] = $constructorModel->getStanding();
            $completedRaces = $eventModel->getCompletedRaces();

            for($i= 0; $i < sizeOf($drivers); $i++){
                
                $teamId = $drivers[$i]['team'];
                for($x= 0; $x < sizeOf($data['constructor']); $x++){
                    if($data['constructor'][$x]['id'] == $teamId){
                        $drivers[$i]['teamName'] = $data['constructor'][$x]['name'];
                        $drivers[$i]['teamLogo'] = $data['constructor'][$x]['logo'];
                    }
                }
            }
            //Driver Data
            $data['drivers'] = $drivers;

            //Get Races Standings
            for($i= 0; $i < sizeOf($completedRaces); $i++){
                $id = $completedRaces[$i]['id'];
                $data['raceStanding'][$id] = $raceRankingModel->getRaceRanking($id);
                for($x = 0; $x < (sizeOf($data['raceStanding'][$id])); $x++){
                    $driverId = $data['raceStanding'][$id][$x]['driver_id'];
                    for($y= 0; $y < sizeOf($drivers); $y++){
                        if($drivers[$y]['id'] == $driverId){
                            $data['raceStanding'][$id][$x]['driverName'] = $drivers[$y]['name'];
                            $data['raceStanding'][$id][$x]['driverLogo'] = $drivers[$y]['image'];
                            $data['raceStanding'][$id][$x]['driverAbbr'] = $drivers[$y]['abbr'];
                            $data['raceStanding'][$id][$x]['teamName'] = $drivers[$y]['teamName'];
                            $data['raceStanding'][$id][$x]['teamLogo'] = $drivers[$y]['teamLogo'];
                        }
                    }
                }
                $data['circuitCountry'] = $circuitModel->getCircuit($completedRaces[$i]['circuitId'])['country'];
            }   
            
            //get Last race
            $data['lastRace'] = end($data['raceStanding']);

            //Get next Event Circuit Id
            $circuitId  = $eventModel->getNextEventCircuitid()['circuitId'];

            //Get Circuit
            $circuit = $circuitModel->getCircuit($circuitId);
            
            $data['circuit'] = $circuit;
            //Get all events in that circuit
            $event = $eventModel->getEventsByCircuit($circuitId);


            for($i= 0; $i < sizeOf($event); $i++){
                $eventDate = new \DateTime($event[$i]['date']);
                $eventDate = $eventDate->format("d/m/Y, H:i");
                $event[$i]['date'] = $eventDate;
            }
            

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

            return view('templates/header', $header)
                . view('f1/index', $data)
                . view('templates/footer');
        }

        public function displayTeam($id){

            $session = session();
        
            $header['title']='Team';
            $header['user']=$session->get('user');

            $constructorModel = model(F1Model::class);
            $driverModel = model(F1DriverModel::class);
            $eventModel = model(F1EventModel::class);
            $rankingModel = model(F1RankingModel::class);
            $circuitModel = model(F1CircuitModel::class);

            $data['team'] = $constructorModel->getTeam($id)[0];
            $data['drivers'] = $driverModel->getTeamDrivers($id);

            $teamStanding = $constructorModel->getStanding();

            for($x= 0; $x < sizeOf($teamStanding); $x++){
                if($teamStanding[$x]['id'] == $id){
                    $data['f1Position'] = $x + 1;
                }
            }

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
            $data['nextEvent'] = $event[0];


            return view('templates/header', $header)
                . view('f1/team', $data)
                . view('templates/footer');
        }

    }
?>