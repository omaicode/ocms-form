<?php
namespace Modules\Form\Fields;

class Slug extends BaseField
{    
    protected $view   = 'form::fields.slug';
    protected $column = [];
    
    protected $slug_name = 'slug';

    protected static $css = [
        '/modules/form/css/bootstrap-editable.css',
    ];

    protected static $js = [
        '/modules/form/js/jquery.min.js',
        '/modules/form/js/bootstrap-editable.js',
        '/modules/form/js/slugify.js'
    ];

    /**
     * Field constructor.
     *
     * @param       $column
     * @param array $arguments
     */
    public function __construct($column = '', $arguments = [])
    {
        $this->column['name'] = $column;
        $this->column['slug'] = $arguments[0];

        array_shift($arguments);
        $this->label = $this->formatLabel($arguments);
        $this->id = $this->formatId($this->column);
    }

    protected function script()
    {
        return <<<SCRIPT
        $(function() {
            var slugManualChanged = false;

            $('input[name="{$this->id['name']}"]').on('input', function(e) {
                if(slugManualChanged) return;
                
                const val = slugify(e.target.value, '-')
                $('#{$this->id['slug']}').text(val.toLowerCase())
                $('input[name="{$this->id['slug']}"]').val(val.toLowerCase())
            })
            
            $('#{$this->id['slug']}').editable({
                type: 'text',
                mode: 'inline',
                emptytext: 'no-slug'
            })

            $('#{$this->id['slug']}').on('save', function(e, params) {
                slugManualChanged = true

                const val = slugify(params.newValue, '-')
                $('input[name="{$this->id['slug']}"]').val(val)
            })

            $('#{$this->id['slug']}').on('hidden', function(e, reason) {
                $('#{$this->id['slug']}').text($('input[name="{$this->id['slug']}"]').val())
            })
        })
        SCRIPT;
    }

    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $this->setScript($this->script());

        return parent::render();
    }

    /**
     * {@inheritdoc}
     */
    public function prepare($value)
    {
        if ($value === '') {
            $value = null;
        }

        return $value;
    }    
}