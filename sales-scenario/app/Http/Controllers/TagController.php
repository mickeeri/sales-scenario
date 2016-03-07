<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class TagController extends CrudController{

    public function all($entity)
    {
        parent::all($entity);

        $this->filter = \DataFilter::source(new Tag);
        $this->filter->add('name', 'Name', 'text');
        $this->filter->submit('search');
        $this->filter->reset('reset');
        $this->filter->build();

        $this->grid = \DataGrid::source($this->filter);
        $this->grid->add('name', 'Tag name');
        $this->grid->add('created_at', 'Created');
        $this->addStylesToGrid();

        return $this->returnView();
    }

    public function  edit($entity)
    {
        $this->edit = \DataEdit::source(new Tag);
        $this->edit->label('Edit Tag');
        $this->edit->add('name', 'Tag name', 'text')->rule('required');

        return $this->returnEditView();
    }

}
