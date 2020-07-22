@extends('layouts/edit-form', [
    'createText' => trans('Create Proyek') ,
    'updateText' => trans('admin/accessories/general.update'),
    'helpTitle' => trans('admin/accessories/general.about_accessories_title'),
    'helpText' => trans('admin/accessories/general.about_accessories_text'),
    'formAction' => ($item) ? route('accessories.update', ['accessory' => $item->id]) : route('accessories.store'),
])

{{-- Page content --}}
@section('inputFields')

@include ('partials.forms.edit.asset-select', ['translated_name' => trans('general.asset'), 'fieldname' => 'asset_id'])
@include ('partials.forms.edit.department-select', ['translated_name' => trans('general.department'), 'fieldname' => 'department_id'])
@include ('partials.forms.edit.name', ['translated_name' => trans('PIC')])
@include ('partials.forms.edit.name', ['translated_name' => trans('PIC Teknisi')])
@include ('partials.forms.edit.name', ['translated_name' => trans('Status')])
@include ('partials.forms.edit.name', ['translated_name' => trans('Catatan')])
@include ('partials.forms.edit.purchase_date')
@include ('partials.forms.edit.purchase_date')



<!-- @include ('partials.forms.edit.model_number')
@include ('partials.forms.edit.order_number')

@include ('partials.forms.edit.quantity')

@include ('partials.forms.edit.minimum_quantity') -->

<!-- Image -->
@if ($item->image)
    <div class="form-group {{ $errors->has('image_delete') ? 'has-error' : '' }}">
        <label class="col-md-3 control-label" for="image_delete">{{ trans('general.image_delete') }}</label>
        <div class="col-md-5">
            {{ Form::checkbox('image_delete') }}
            <img src="{{ url('/') }}/uploads/accessories/{{ $item->image }}" />
            {!! $errors->first('image_delete', '<span class="alert-msg">:message</span>') !!}
        </div>
    </div>
@endif

@include ('partials.forms.edit.image-upload')


@stop
