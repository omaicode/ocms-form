<?php
namespace Modules\Form\Tools;

use Modules\Form\Builder;
use Modules\Form\Fields\BaseField;
use Modules\Form\Fields\Select as SelectParent;

class Select extends SelectParent
{    
    protected $view = 'form::tools.select';

    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $this->id = uniqid($this->id.'_');

        if($this->form) {
            $this->value = $this->form->model()[$this->column];
        }        

        return parent::render();
    }

    public function setBuilder(Builder $builder)
    {
        $this->form = $builder->getForm();

        return $this;
    }
}