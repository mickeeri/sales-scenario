<?php

namespace App\Http\Controllers;

use App\Expert;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class ExpertController extends CrudController{

    public function all($entity){
        parent::all($entity);

        // Simple code of  filter and grid part

        $this->filter = \DataFilter::source(new Expert());
        $this->filter->add('first_name', 'First Name', 'text');
        $this->filter->add('last_name', 'Last Name', 'text');
        $this->filter->submit('search');
        $this->filter->reset('reset');
        $this->filter->build();

        $this->grid = \DataGrid::source($this->filter);
        $this->grid->add('first_name', 'First Name');
        $this->grid->add('last_name', 'Last Name');
        $this->grid->add('created_at', 'Created');
        $this->addStylesToGrid();

        $this->grid->paginate(20);

        return $this->returnView();
    }

    /**
     * @param string $entity
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function  edit($entity){

        $this->edit = \DataEdit::source(new Expert());

        $sorted_list = \App\Tag::lists("name", "id")->all();

        asort($sorted_list);

        //Drop down from users table.
        $this->edit->label('Edit Expert');
        $this->edit->add('first_name', 'First name', 'text')->rule('required');
        $this->edit->add('last_name', 'Last name', 'text')->rule('required');
        $this->edit->add('website', 'Website', 'text')->rule('url')->placeholder('http://');;
        $this->edit->add('info', 'Info', 'textarea')->rule('required');
        $this->edit->add('photo', 'Photo', 'image')->rule('image|required')->move('expert_photo')->preview(180,180);
        $this->edit->add('tags', 'Categories', 'checkboxgroup')->options($sorted_list);



        return $this->returnEditView();
    }
}
