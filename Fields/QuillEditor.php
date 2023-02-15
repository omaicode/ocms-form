<?php
namespace Modules\Form\Fields;

use Modules\Form\Fields\Traits\HasPlainInput;

class QuillEditor extends BaseField
{
    use HasPlainInput;
    
    protected $view = 'form::fields.quill-editor';
    protected static $css = [
        '/modules/form/css/monokai-sublime.css',
        '/modules/form/css/quill.snow.css',
    ];
    protected static $js = [
        '/modules/form/js/quill.min.js',
        '/modules/form/js/quill.html-editor.js',
    ];
    
    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $this->setScript($this->script());
        $this->defaultAttribute('id', $this->id)
            ->defaultAttribute('name', $this->elementName ?: $this->formatName($this->column))
            ->defaultAttribute('value', old($this->elementName ?: $this->column, $this->value()))
            ->defaultAttribute('placeholder', $this->getPlaceholder());

        return parent::render();
    }

    protected function script()
    {
        $placeholder = $this->placeholder;
        $id = $this->id;

        return <<<SCRIPT
        Quill.register("modules/htmlEditButton", htmlEditButton);
        var txtElem = document.getElementById('{$id}');
        var quill = new Quill('#editor-container', {
            modules: {
              syntax: true,
              toolbar: '#toolbar-container',
              htmlEditButton: {
                buttonHTML: '<i class="fas fa-code"></i>'
              }
            },
            placeholder: '{$placeholder}',
            theme: 'snow'
        });     

        quill.on('text-change', function(delta, oldDelta, source) {
            txtElem.value = quill.root.innerHTML;
        });
        SCRIPT;
    }
}