<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use \Serverfireteam\Panel\CrudController;


use Illuminate\Http\Request;

class UserController extends CrudController{

    public function all($entity)
	{
        parent::all($entity);

		$this->filter = \DataFilter::source(new User);
		$this->filter->add('username', 'Username', 'text');
		$this->filter->add('email', 'Email', 'text');
		$this->filter->submit('search');
		$this->filter->reset('reset');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('username', 'Username');
		$this->grid->add('email', 'Email');
		$this->grid->add('created_at', 'Created');
		$this->addStylesToGrid();
                 
        return $this->returnView();
    }
    
    public function edit($entity)
	{
		$id = $this->edit = \DataEdit::source(new User);
		$this->edit->label('Edit User');
		$this->edit->add('username', 'Username', 'text')->rule('required|unique:users,username,'.$id->model->id);
		$this->edit->add('email', 'Email', 'text')->rule('required|max:255|unique:users,email,'.$id->model->id );
		$this->edit->add('password', 'Password', 'password')->rule('confirmed|min:6');
		$this->edit->add('password_confirmation', 'Repeat Password', 'password')->rule('min:6');

        return $this->returnEditView();
    }    
}
