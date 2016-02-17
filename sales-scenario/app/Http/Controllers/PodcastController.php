<?php 

namespace App\Http\Controllers;

use App\Expert;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Podcast;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class PodcastController extends CrudController{

    public function all($entity){
        parent::all($entity); 

		$this->filter = \DataFilter::source(Podcast::with('expert'));
		$this->filter->add('title', 'Title', 'text');
		$this->filter->add('expert.last_name', 'Last name', 'text');
		$this->filter->submit('search');
		$this->filter->reset('reset');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('title', 'Title');
		$this->grid->add('expert.full_name', 'Expert');


		$this->grid->add('created_at', 'Created');
		$this->addStylesToGrid();

        return $this->returnView();
    }
    
    public function  edit($entity){
        

		parent::edit($entity);

		Podcast::deleted(function($podCast) {
			header('Location: /panel/Podcast/all');
			die();
		});


        // Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
		$this->edit = \DataEdit::source(new Podcast);

		$this->edit->label('Edit Podcast');

		$this->edit->add('title', 'Title', 'text')->rule('required');

		$this->edit->add('expert','Expert','select')->options($this->getExpertsList());

		$this->edit->add('filename', 'Podcast (m4a, mp3)', 'file')->rule('audio')->move(storage_path().'/app/podcasts/temp');

        return $this->returnEditView();
    }

	private function getExpertsList()
	{
		$list = Expert::selectRaw('CONCAT(last_name, ", ", first_name) as ExpertFullName, id')
			->orderBy('last_name')->lists('ExpertFullName', 'id');

		$experts = array();

		foreach ($list as $id => $fullName) {
			$experts[$id] = $fullName;
		}

		return $experts;
	}
}
