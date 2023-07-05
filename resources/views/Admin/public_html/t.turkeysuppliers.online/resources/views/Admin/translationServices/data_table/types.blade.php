
@if($admin->type =='admin')
    <h4>{{__('site.admin')}}</h4>
@else
    <h4>{{__('site.employee')}}</h4>
@endif
