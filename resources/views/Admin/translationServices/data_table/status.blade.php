<span class="font-weight-bold badge badge-pill badge-{{ $admin->status == 1 ? 'success' : 'danger'  }}">
    {{ $admin->status == 1 ? __('site.active') : __('site.unactive') }}<br>

</span>
<br><i class='fa fa-exchange'></i>
{{-- {{__('site.change')}} --}}
<a href="{{route('admin.change_status',encrypt($admin->id))}}" title="للتحويل الى  {{ ($admin->status == 1) ? trans('site.unactive') : trans('site.active') }} ">
    {{ $admin->status == 1 ? __('site.unactive') : __('site.active') }}
</a>
