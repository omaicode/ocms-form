<?php
namespace Modules\Form\Controllers;

use Illuminate\Routing\Controller;
use Modules\Form\Form;

class FormBuilderController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return $this->title;
    }

    /**
     * Form
     * 
     * @return null 
     */
    protected function form()
    {
        return null;
    }    

    /**
     * Index view
     * 
     * @return mixed
     */
    protected function index()
    {
        
    }

    /**
     * Create view
     * 
     * @return mixed
     */
    protected function create()
    {
        return $this->form();
    }

    /**
     * Edit view
     * @param mixed $id 
     * @return Form 
     */
    protected function edit($id)
    {
        return $this->form()->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        return $this->form()->update($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        return $this->form()->store();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }    
}