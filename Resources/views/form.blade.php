<!-- form start -->
{!! $form->open() !!}
@csrf
<div class="row">
    <div class="col-12 col-xl-9 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __($form->title()) }}</h5>
                @if ($form->hasRows())
                    @foreach ($form->getRows() as $row)
                        {!! $row->render() !!}
                    @endforeach
                @else
                    @foreach ($layout->columns() as $column)
                        @foreach ($column->fields() as $field)
                            {!! $field->render() !!}
                        @endforeach
                    @endforeach
                @endif
                @if ($layout->customContent())
                    <div class="mt-3">
                        {!! $layout->customContent() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3 col-lg-4">
        <div class="card mb-3">
            <div class="card-header">
                <div class="fw-bold">@lang('core::messages.publish')</div>
            </div>
            <div class="card-body d-flex align-items-center">
                <button type="submit" name="after-save" value="0" class="btn btn-success text-white me-2" data-loading-text="none">
                    <span class="icon icon-xs me-1">
                        <i class="fas fa-save"></i>
                    </span>
                    <span>@lang('core::messages.save')</span>
                </button>
                <button type="submit" name="after-save" value="1" class="btn btn-info" data-loading-text="none">
                    <span class="icon icon-xs me-1">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span>@lang('core::messages.save_and_edit')</span>
                </button>
            </div>
        </div>
        {!! $tools !!}
    </div>
</div>

@foreach ($form->getHiddenFields() as $field)
    {!! $field->render() !!}
@endforeach

{!! $form->close() !!}
