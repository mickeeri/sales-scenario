<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class ExpertController extends CrudController{

    public function all($entity){
        parent::all($entity);

        // Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

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

    public function  edit($entity){

        parent::edit($entity);

        $this->edit = \DataEdit::source(new User());
        $this->edit->label('Edit User');
        $this->edit->add('username', 'Username', 'text')->rule('required');
        $this->edit->add('email', 'Email', 'text')->rule('required|email|max:255');
        $this->edit->add('password', 'Password', 'password')->rule('confirmed|min:6');
        $this->edit->add('password_confirmation', 'Repeat Password', 'password')->rule('min:6');

        /** The expert part */

        $this->edit->add('experts.first_name', 'First name', 'text')->rule('required');
        $this->edit->add('experts.last_name', 'Last name', 'text')->rule('required');
        $this->edit->add('experts.website', 'Website', 'text');
        $this->edit->add('experts.info', 'Info', 'text');

        return $this->returnEditView();
    }
}
