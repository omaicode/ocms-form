<?php
namespace Modules\Form\Tools;

use Closure;
use Exception;
use Modules\Form\Builder;
use Modules\Form\Fields\BaseField;
use Modules\Media\Entities\Media as ModelsMedia;

class Media extends BaseField
{    
    protected $view = 'form::tools.media';
    protected $preview;
    protected $accept  = 'image/jpg,image/jpeg,image/png,image/gif';
    protected $url;
    protected $model_class;
    
    protected static $css = [
        '/modules/media/css/media.css'
    ];

    protected static $js = [
        '/modules/media/js/media.js'
    ];

    public function __construct($column, $args = [])
    {
        if(!isset($args[1])) {
            throw new Exception("Media tool must have model class.");
        }

        if(!is_string($args[1])) {
            throw new Exception("Media tool must be a string.");
        }

        $this->model_class = $args[1];
        parent::__construct($column, $args);
    }
    
    /**
     * @param string $attribute
     * @param string $value
     *
     * @return $this
     */
    protected function defaultAttribute($attribute, $value)
    {
        if (!array_key_exists($attribute, $this->attributes)) {
            $this->attribute($attribute, $value);
        }

        return $this;
    }    

    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $preview = null;
        $this->id = uniqid($this->id.'_');

        $this
        ->defaultAttribute('name', $this->elementName ?: $this->formatName($this->column))
        ->defaultAttribute('accept', $this->accept);

        if($this->form) {
            $this->value = $this->form->model()[$this->column];
            $preview = $this->form->model()->getMediaUrl($this->column);
        }

        if(!$this->url) {
            $this->url = url('/'.config('core.admin_prefix', 'admin').'/media/api');
        }

        $this->addVariables([
            'preview' => $preview,
            'url'     => $this->url,
            'model_class' => $this->model_class
        ]);

        return parent::render();
    }

    /**
     * Set preview url
     * 
     * @param string|Closure $url 
     * @return $this 
     */
    public function preview($url)
    {
        $this->preview = $url;

        return $this;
    }

    /**
     * Set accept files mimes
     * 
     * @param mixed $url 
     * @return $this 
     */
    public function accept(string $mimes)
    {
        $this->accept = $mimes;

        return $this;
    }   

    public function url(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function modelClass(string $model_class)
    {
        $this->model_class = $model_class;

        return $this;
    }

    public function setBuilder(Builder $builder)
    {
        $this->form = $builder->getForm();

        return $this;
    }
}