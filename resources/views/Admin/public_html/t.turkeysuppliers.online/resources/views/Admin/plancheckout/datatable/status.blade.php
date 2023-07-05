<span class="font-weight-bold badge badge-pill badge-{{ $plancheckout->status == 1 ? 'success' : 'danger'  }}">
    {{ $plancheckout->status == 1 ? __('site.active') : __('site.unactive') }}<br>

</span>
<br><i class='fa fa-exchange'></i>
{{-- {{__('site.change')}} --}}
<a href="{{route('admin.plancheckouts.change_status',encrypt($plancheckout->id))}}" title="للتحويل الى  {{ ($plancheckout->status == 1) ? trans('site.unactive') : trans('site.active') }} ">
    {{ $plancheckout->status == 1 ? __('site.unactive') : __('site.active') }}
</a>
