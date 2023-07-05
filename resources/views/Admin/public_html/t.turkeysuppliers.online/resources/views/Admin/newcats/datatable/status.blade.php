<span class="font-weight-bold badge badge-pill badge-{{ $newcat->status == 1 ? 'success' : 'danger'  }}">
    {{ $newcat->status == 1 ? __('site.active') : __('site.unactive') }}<br>

</span>
{{-- <br><i class='fa fa-exchange'></i> --}}
{{-- {{__('site.change')}} --}}
{{-- <a href="{{route('newcat.change_status',encrypt($newcat->id))}}" title="للتحويل الى  {{ ($newcat->status == 1) ? trans('site.unactive') : trans('site.active') }} ">
    {{ $newcat->status == 1 ? __('site.unactive') : __('site.active') }}
</a> --}}
