<span class="font-weight-bold badge badge-pill badge-{{ $clerk->status == 1 ? 'success' : 'danger'  }}">
    {{ $clerk->status == 1 ? __('site.active') : __('site.unactive') }}<br>

</span>
<br><i class='fa fa-exchange'></i>
{{-- {{__('site.change')}} --}}
<a href="{{route('admin.change_status',encrypt($clerk->id))}}" title="للتحويل الى  {{ ($clerk->status == 1) ? trans('site.unactive') : trans('site.active') }} ">
    {{ $clerk->status == 1 ? __('site.unactive') : __('site.active') }}
</a>
