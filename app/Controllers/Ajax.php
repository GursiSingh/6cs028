<?php

namespace App\Controllers;

use App\Models\F1Model;

class Ajax extends BaseController
{
	public function searchF1Teams($slug)
	{	
		if($slug == null) return;
		$model = model(F1Model::class);
		
		$data = $model->getTeams($slug);

		print(json_encode($data));
	}
	
}