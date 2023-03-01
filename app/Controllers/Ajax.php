<?php

namespace App\Controllers;

use App\Models\F1Model;
use App\Models\FootballTeamModel;

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

	//Get constructor standing based on the competition Id
	public function getConstructorStandings(){
		$model = model(F1Model::class);
		$data = $model->getStanding();

		print(json_encode($data));
	}
	
}