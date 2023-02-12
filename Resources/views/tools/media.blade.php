<div id="ocms-media-app" class="card card-avatar mb-3">
    <div class="card-body" v-cloak>
        <div class="card-title fw-bold">{{$label}}</div>
        <media-form-button 
            name="{{ $name }}" 
            placeholder="{{$placeholder}}" 
            label="{{$label}}"
            url="{{ $url }}"
            save-path="{{$model_class}}"
            value="{{ $value }}"
            preview="{{ $preview }}"
        />
        @include('form::help-block')
        @include('form::error')          
    </div>
    <modal-container/>
</div>