<?php

    namespace App\Controllers;
    use App\Models\F1Model;
    use App\Models\F1DriverModel;
    use App\Models\F1EventModel;
    use App\Models\F1CircuitModel;

    class Home extends BaseController
    {
        public function index(){
            $session = session();
            
            $header['title']='Home';
            $header['user']=$session->get('user');

            $constructorModel = model(F1Model::class);
            $data['constructor'] = $constructorModel->getStanding();
            
            $driverModel = model(F1DriverModel::class);
            $drivers = $driverModel->getStanding();
            
            for($i= 0; $i < sizeOf($drivers); $i++){
                
                $teamId = $drivers[$i]['team'];
                for($x= 0; $x < sizeOf($data['constructor']); $x++){
                    if($data['constructor'][$x]['id'] == $teamId){
                        $drivers[$i]['teamName'] = $data['constructor'][$x]['name'];
                    }
                }
            }
            $data['drivers'] = $drivers;
            
            $eventModel = model(F1EventModel::class);
            $circuitModel = model(F1CircuitModel::class);

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

            //if user if not logged in
            return view('templates/header', $header)
                . view('templates/welcome', $data)
                . view('templates/footer');

            
        }
        
    }
?>
