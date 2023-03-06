<?php

	namespace App\Controllers;

	use App\Models\F1Model;
	use App\Models\FootballCompetitionModel;
	use App\Models\FootballTeamModel;
    use App\Models\FootballPlayerModel;
    use App\Models\FootballFixtureModel;

	class Ajax extends BaseController
	{
		//Get all F1 teams based on the name entered by the user
		public function searchF1Teams($name = null)
		{
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
		public function getTeamSquad($teamId){
			$playerModel = model(FootballPlayerModel::class);
			$order = "(CASE position
            WHEN 'Goalkeeper' THEN 0
            WHEN 'Defender' THEN 1
            WHEN 'Midfielder' THEN 2
            WHEN 'Attacker' THEN 3 END)
            ";
			$data = $playerModel->getSquad($teamId, $order);

			if($data == null){
				get(base_url('/football/player/load/'.$teamId));
				$data = $playerModel->getSquad($teamId, $order);
			}

			print(json_encode($data));
		}

		//Get all Matches of a Team
		public function getTeamMatches($teamId){
			$fixtureModel = model(FootballFixtureModel::class);
			$teamModel = model(FootballTeamModel::class);

			$data = $fixtureModel->getTeamMatches($teamId);

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
		
		//Get all Matches of a Team
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

		//Get constructor standing
		public function getConstructorStandings(){
			$model = model(F1Model::class);
			$data = $model->getStanding();

			print(json_encode($data));
		}
		
	}
?>