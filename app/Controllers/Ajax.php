<?php

	namespace App\Controllers;

	use App\Models\F1Model;
	use App\Models\FootballTeamModel;
    use App\Models\FootballPlayerModel;

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

		//Get competition standing based on the competition Id
		public function getCompetitionStandings($competitioinId){
			$model = model(FootballTeamModel::class);
			$data = $model->getStanding($competitioinId);

			print(json_encode($data));
		}

		//Get constructor standing
		public function getConstructorStandings(){
			$model = model(F1Model::class);
			$data = $model->getStanding();

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
		
	}
?>