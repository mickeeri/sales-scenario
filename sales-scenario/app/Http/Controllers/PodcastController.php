<?php 

namespace App\Http\Controllers;

use App\Expert;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Podcast;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class PodcastController extends CrudController{

    public function all($entity)
	{
        parent::all($entity); 

		$this->filter = \DataFilter::source(Podcast::with('expert'));
        $this->filter->add('title', 'Title', 'text');
		$this->filter->add('expert.first_name', 'First name', 'text');
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
    
    public function  edit($entity)
	{
		parent::edit($entity);

		$this->edit = \DataEdit::source(new Podcast);

		$this->loadEventHandlers();

		$this->edit->label('Edit Podcast');
		$this->edit->add('title', 'Title', 'text')->rule('required');
		$this->edit->add('expert','Expert','select')->options($this->getExpertsList());
		$this->edit->add('filename', 'Podcast (m4a, mp3)', 'file')->rule('audio|max:500000')->move(public_path().'/audio/podcasts/temp');

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

	private function loadEventHandlers()
	{
		Podcast::deleting(function($podcast) {
			// before delete
			if (!empty($podcast->filename) && file_exists(Podcast::podcastLocation().$podcast->filename)) {
				unlink(Podcast::podcastLocation().$podcast->filename);
			}
		});

		Podcast::deleted(function($podcast) {
			header('Location: /panel/Podcast/all');
			die();
		});

		\Validator::extend('audio', function($attribute, $value, $parameters)
		{
			$allowed = array('audio/mpeg');
			$mime = new \App\Libraries\MimeReader($value->getRealPath());

			// Make sure file type has extension .m4a and not mp4.
			if ($mime->get_type() == 'video/mp4' && preg_match('/^.*\.(m4a)$/', $value->getClientOriginalName())) {
				return true;
			}

			return in_array($mime->get_type(), $allowed);
		});
	}
}
