@if(session()->has('error'))
<div class="alert w-100 my-2 d-block px-2  alert-warning alert-dismissible ">
    <div class="d-flex align-items-center  gap-2    justify-content-between">
        <h6><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
    {{ session('error') }}
</div>
@endif
@if(session()->has('success'))
<div class="alert w-100 my-2 d-block px-0  alert-success  alert-pop">
    <div class="d-flex align-items-center  gap-2    justify-content-between">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
</div>
@endif
@if(count($errors->all()) > 0)
<div class="alert   my-2 d-block px-2  alert-warning alert-dismissible ">
    <div class="d-flex align-items-center  gap-2    justify-content-between">
        <h6><i class="icon fas fa-exclamation-triangle"></i> تحذير</h6>
        <ol>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ol>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
</div>
@endif
 