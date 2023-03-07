<span class="font-weight-bold badge badge-pill badge-{{ $company->status == 1 ? 'success' : 'danger'  }}">
    {{ $company->status == 1 ? __('site.active') : __('site.unactive') }}<br>

</span>
<br><i class='fa fa-exchange'></i>
{{-- {{__('site.change')}} --}}
<a href="{{route('admin.companies.change_status',encrypt($company->id))}}" title="للتحويل الى  {{ ($company->status == 1) ? trans('site.unactive') : trans('site.active') }} ">
    {{ $company->status == 1 ? __('site.unactive') : __('site.active') }}
</a>
