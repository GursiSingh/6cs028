<?php

    namespace App\Controllers;

    use App\Models\F1Model;
    use App\Models\F1DriverModel;
    use App\Models\F1EventModel;
    use App\Models\F1CircuitModel;
    use App\Models\F1RankingModel;

    class F1 extends BaseController{

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