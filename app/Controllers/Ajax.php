<?php

	namespace App\Controllers;

	use App\Models\FootballCompetitionModel;
	use App\Models\FootballTeamModel;
    use App\Models\FootballPlayerModel;
    use App\Models\FootballFixtureModel;
	
	use App\Models\F1Model;
    use App\Models\F1EventModel;
    use App\Models\F1CircuitModel;
    use App\Models\F1RankingModel;
    use App\Models\F1DriverModel;

	class Ajax extends BaseController
	{
		//Get all F1 teams based on the name entered by the user
		public function searchF1Teams($name = null){
			$model = model(F1Model::class);
			$data = $model->getTeams($name);

			print(json_encode($data));
		}

		//Get all football teams based on the name entered by the user
		public function searchFootballTeams($name = null){
			$model = model(FootballTeamModel::class);
			$data = $model->getTeams($name);

			print(json_encode($data));
		}


		//get competition by id
		public function getCompetition($competitioinId){
			$model = model(FootballCompetitionModel::class);
			$data = $model->getCompetition($competitioinId);

			print(json_encode($data));
		}

		//Get competition by Country
		public function getCompetitionByCountry($country){
			$model = model(FootballCompetitionModel::class);
			$data = $model->getCompetitionIdByCountry($country);

			print(json_encode($data));
		}

		//get all competitions
		public function getAllCompetitions(){
			$model = model(FootballCompetitionModel::class);
			$data = $model->getAllCompetitions();

			print(json_encode($data));
		}

		//Get competition standing based on the competition Id
		public function getCompetitionStandings($competitioinId){
			$model = model(FootballTeamModel::class);
			$data = $model->getStanding($competitioinId);

			print(json_encode($data));
		}

		//get competition round
		public function	getFootballRound($competitionId, $round = null){
			
			$fixtureModel = model(FootballFixtureModel::class);
			$teamModel = model(FootballTeamModel::class);
			$venueModel = model(FootballVenueModel::class);

			if($round == null){
				//get current round
				$data = $fixtureModel->getCurrentRound($competitionId);
			}else{
				//get the round asked by the user
				$data = $fixtureModel->getRound($competitionId, $round);
			}

			for($i = 0; $i < sizeOf($data); $i++){
					
				$data[$i]['homeName'] = $teamModel->getTeam($data[$i]['home'])[0]['name'];
				$data[$i]['homeCode'] = $teamModel->getTeam($data[$i]['home'])[0]['code'];
				$data[$i]['homeLogo'] = $teamModel->getTeam($data[$i]['home'])[0]['logo'];
				$data[$i]['awayName'] = $teamModel->getTeam($data[$i]['away'])[0]['name'];
				$data[$i]['awayLogo'] = $teamModel->getTeam($data[$i]['away'])[0]['logo'];
				$data[$i]['awayCode'] = $teamModel->getTeam($data[$i]['away'])[0]['code'];
				$data[$i]['venueLogo'] = $venueModel->getVenue($data[$i]['venueId'])[0]['image'];
				$data[$i]['venueName'] = $venueModel->getVenue($data[$i]['venueId'])[0]['name'];
			}
			print(json_encode($data));
		}
		
		//get all rounds of a competition
		public function getAllFootballRounds($competitionId){
			$fixtureModel = model(FootballFixtureModel::class);
			$data = $fixtureModel->getAllRounds($competitionId);
			print(json_encode($data));
		}

		//Get players based on the teams Id
		public function getTeamSquad($teamId, $filter=null){
			$playerModel = model(FootballPlayerModel::class);
			if($filter == "name"){
				$order= "name ASC";
			}else if($filter == "number"){
				$order= "number ASC";
			}else{
				$order = "(CASE position
				WHEN 'Goalkeeper' THEN 0
				WHEN 'Defender' THEN 1
				WHEN 'Midfielder' THEN 2
				WHEN 'Attacker' THEN 3 END)
				";
			}
			$data = $playerModel->getSquad($teamId, $order);

			if($data == null){
				get(base_url('/football/player/load/'.$teamId));
				$data = $playerModel->getSquad($teamId, $order);
			}

			print(json_encode($data));
		}

		//Search Player in a Team
		public function searchPlayersInTeam($teamId, $playerName, $filter=null){

			if($filter == "name"){

				$order= "name ASC";

			}else if($filter == "number"){

				$order= "number ASC";

			}else{
				$order = "(CASE position
				WHEN 'Goalkeeper' THEN 0
				WHEN 'Defender' THEN 1
				WHEN 'Midfielder' THEN 2
				WHEN 'Attacker' THEN 3 END)
				";
			}
			
			$playerModel = model(FootballPlayerModel::class);
			$data = $playerModel->searchPlayersInTeam($teamId, $playerName, $order);


			print(json_encode($data));


		}

		public function getSquadByPosition($teamId, $position){
			$playerModel = model(FootballPlayerModel::class);
			$data = $playerModel->getSquadByPosition($teamId, $position);
			print(json_encode($data));
			
		}

		//Get all Matches of a Team
		public function getAllTeamMatches($teamId){
			$fixtureModel = model(FootballFixtureModel::class);
			$teamModel = model(FootballTeamModel::class);
			$competitionModel = model(FootballCompetitionModel::class);
			

			$data = $fixtureModel->getAllTeamMatches($teamId);

			for($i = 0; $i < sizeOf($data); $i++){
				$homeTeam= $teamModel->getTeam($data[$i]['home'])[0];
				$awayTeam= $teamModel->getTeam($data[$i]['away'])[0];
				$comp = $competitionModel->getCompetition($data[$i]['competitionId'])[0];

				$data[$i]['homeName'] = $homeTeam['name'];
				$data[$i]['homeCode'] = $homeTeam['code'];
				$data[$i]['homeLogo'] = $homeTeam['logo'];
				$data[$i]['awayName'] = $awayTeam['name'];
				$data[$i]['awayLogo'] = $awayTeam['logo'];
				$data[$i]['awayCode'] = $awayTeam['code'];
				$data[$i]['compName'] = $comp['name'];
				$data[$i]['compLogo'] = $comp['logo'];
			}

			print(json_encode($data));
		}
		
		//Get matches in a month of a team
		public function getTeamMonthMatches($teamId, $month, $year){
			$fixtureModel = model(FootballFixtureModel::class);
			$teamModel = model(FootballTeamModel::class);

			$data = $fixtureModel->getTeamMonthMatches($teamId, $month, $year);
			for($i = 0; $i < sizeOf($data); $i++){
					
				$data[$i]['homeName'] = $teamModel->getTeam($data[$i]['home'])[0]['name'];
				$data[$i]['homeCode'] = $teamModel->getTeam($data[$i]['home'])[0]['code'];
				$data[$i]['homeLogo'] = $teamModel->getTeam($data[$i]['home'])[0]['logo'];
				$data[$i]['awayName'] = $teamModel->getTeam($data[$i]['away'])[0]['name'];
				$data[$i]['awayLogo'] = $teamModel->getTeam($data[$i]['away'])[0]['logo'];
				$data[$i]['awayCode'] = $teamModel->getTeam($data[$i]['away'])[0]['code'];
			}
			

			print(json_encode($data));
		}
		//Get Next Matche of a Team
		public function getNextMatch($teamId){
			$fixtureModel = model(FootballFixtureModel::class);
			$teamModel = model(FootballTeamModel::class);

			$data = $fixtureModel->getNextMatch($teamId);
			$data['homeName'] = $teamModel->getTeam($data['home'])[0]['name'];
			$data['homeCode'] = $teamModel->getTeam($data['home'])[0]['code'];
			$data['homeLogo'] = $teamModel->getTeam($data['home'])[0]['logo'];
			$data['awayName'] = $teamModel->getTeam($data['away'])[0]['name'];
			$data['awayLogo'] = $teamModel->getTeam($data['away'])[0]['logo'];
			$data['awayCode'] = $teamModel->getTeam($data['away'])[0]['code'];
			

			print(json_encode($data));
		}

		//get all f1 races - therefore all event circuitIds
		public function getAllEvents(){
			
			$eventModel = model(F1EventModel::class);
			$data['races'] = $eventModel->getAllRaces();
			$data['currentCircuitId'] = $eventModel->getNextEventCircuitid()['circuitId'];
			
            $circuitModel = model(F1CircuitModel::class);
			
			for($i = 0; $i < sizeOf($data['races']);$i++){
				$circuit = $circuitModel->getCircuit($data['races'][$i]['circuitId']);
				$data['races'][$i]['circuit'] = $circuit;
				$eventCountry[$i]['id'] = $circuit['id'];
				$eventCountry[$i]['number'] = $i +1;
				$eventCountry[$i]['country'] = $circuit['country'];
			}
			$data['eventList'] = $eventCountry;
			
			print(json_encode($data));
		}

		//Get F1 Event
		public function getF1Event($circuitId){
			$eventModel = model(F1EventModel::class);
            $circuitModel = model(F1CircuitModel::class);
			$circuit = $circuitModel->getCircuit($circuitId);
			$racesList = $eventModel->getAllRaces();
			$event = $eventModel->getEventsByCircuit($circuitId);

			//Get Event Number
			for($i= 0; $i < sizeOf($racesList); $i++){

				if($racesList[$i]['circuitId'] == $circuitId){
					$data['eventNumber'] = $i +1;
					
				}
			}
			$data['f1Events'] = $event;
			$data['circuit'] = $circuit;
			print(json_encode($data));
		}
		
		//Get F1 Events In a Month
		public function getMonthRaces($month, $year){
			$eventModel = model(F1EventModel::class);
			$data = $eventModel->getMonthRaces($month, $year);

			print(json_encode($data));
		}

		//Get Team Races Position 
		public function getTeamRacesPosition($teamId){
			$constructorModel = model(F1Model::class);
			$eventModel = model(F1EventModel::class);
			$circuitModel = model(F1CircuitModel::class);
			$rankingModel = model(F1RankingModel::class);
			$driverModel = model(F1DriverModel::class);
			$races = $eventModel->getAllRaces();

			for($i = 0; $i < sizeOf($races); $i++){
				if($races[$i]['status'] =="Completed"){
					$races[$i]['driverPositions'] = $rankingModel->getTeamPositions($teamId, $races[$i]['id']); 
					$races[$i]['driverPositions'][0]["driver_logo"] = $driverModel->getDriver($races[$i]['driverPositions'][0]["driver_id"])['image']; 
					$races[$i]['driverPositions'][1]["driver_logo"] = $driverModel->getDriver($races[$i]['driverPositions'][1]["driver_id"])['image'];
				}

				$races[$i]['circuit'] = $circuitModel->getCircuit($races[$i]['circuitId']);
				$races[$i]['team'] = $constructorModel->getTeam($teamId)[0];
			}
			print(json_encode($races));
		}

		//Get all races Rankings
		public function getRacesRanking(){
			
            $constructorModel = model(F1Model::class);
            $driverModel = model(F1DriverModel::class);
			$eventModel = model(F1EventModel::class);
			$circuitModel = model(F1CircuitModel::class);
            $raceRankingModel = model(F1RankingModel::class);

			$drivers = $driverModel->getStanding();
			$constructors = $constructorModel->getStanding();
			$completedRaces = $eventModel->getCompletedRaces();

			for($i= 0; $i < sizeOf($drivers); $i++){
                
                $teamId = $drivers[$i]['team'];
                for($x= 0; $x < sizeOf($constructors); $x++){
                    if($constructors[$x]['id'] == $teamId){
                        $drivers[$i]['teamName'] = $constructors[$x]['name'];
                        $drivers[$i]['teamLogo'] = $constructors[$x]['logo'];
                    }
                }
            }

			//Get Races Standings
            for($i= 0; $i < sizeOf($completedRaces); $i++){
                $id = $completedRaces[$i]['id'];
                $data['raceStanding'][$i] = $raceRankingModel->getRaceRanking($id);
				
				
                for($x = 0; $x < (sizeOf($data['raceStanding'][$i])); $x++){
					$driverId = $data['raceStanding'][$i][$x]['driver_id'];
                    for($y= 0; $y < sizeOf($drivers); $y++){
						if($drivers[$y]['id'] == $driverId){
							$data['raceStanding'][$i][$x]['driverName'] = $drivers[$y]['name'];
                            $data['raceStanding'][$i][$x]['driverLogo'] = $drivers[$y]['image'];
                            $data['raceStanding'][$i][$x]['driverAbbr'] = $drivers[$y]['abbr'];
                            $data['raceStanding'][$i][$x]['teamName'] = $drivers[$y]['teamName'];
                            $data['raceStanding'][$i][$x]['teamLogo'] = $drivers[$y]['teamLogo'];
						}
                    }
                }
				$data['raceStanding'][$i]['circuitCountry'] = $circuitModel->getCircuit($completedRaces[$i]['circuitId'])['country'];
            }
			
			$data['lastRaceId'] = end($data['raceStanding'])[0]['race_id'];
			
			print(json_encode($data));
		}
	}
?>