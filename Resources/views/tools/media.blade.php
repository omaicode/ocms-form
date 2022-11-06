<div id="ocms-media-app" class="card card-avatar mb-3">
    <div class="card-body">
        <div class="card-title fw-bold">{{$label}}</div>
        <media 
            name="{{ $name }}" 
            placeholder="{{$placeholder}}" 
            label="{{$label}}"
            url="{{ $url }}"
            model-class="{{$model_class}}"
            model-collection="{{$name}}"
            value="{{ $value }}"
            preview="{{ $preview }}"
        />
        @include('form::help-block')
        @include('form::error')          
    </div>
</div>