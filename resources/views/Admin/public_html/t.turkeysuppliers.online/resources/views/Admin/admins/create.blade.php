@extends('Admin.layouts.master')
@section('title',__('admins.newadmin'))
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">{{ __('admins.newadmin') }}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form  class="form" action="{{ route('admin.admins.store') }}" method="post" >
                                        @csrf
                                        <div class="form-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('admins.name') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ __('admins.name') }}">
                                                    </div>
                                                    @error('name')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ __('admins.phone') }}</label>
                                                        <input type="text" id="projectinput2"

                                                        class="form-control" name="phone" value="{{ old('phone') }}" placeholder="{{ __('admins.phone') }}" />
                                                    </div>
                                                    @error('phone')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('admins.email') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('admins.email') }}">
                                                    </div>
                                                    @error('email')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ __('admins.password') }}</label>
                                                        <input type="password" id="projectinput2" class="form-control"  name="password"
                                                        value="{{ old('password') }}" placeholder="{{ __('admins.password') }}">
                                                    </div>
                                                    @error('password')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('admins.password_confirmation') }}<span class="text-danger">*</span></label>
                                                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
                                                        @error('password_confirmation')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ __('admins.status') }}</label>
                                                        <select name="status" class="form-control">
                                                            <option value="1" {{ old('status') == 1 ? 'selected' : null }}>{{ __('site.active') }}</option>
                                                            <option value="0" {{ old('status') == 0 ? 'selected' : null }}>{{ __('site.unactive') }}</option>
                                                        </select>
                                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    @error('status')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{__('site.type')}}</label>
                                                        <select name="type" class="form-control">
                                                            <option value="admin" {{ old('status') == 'admin' ? 'selected' : null }}>{{__('site.admin')}}</option>
                                                            <option value="employee" {{ old('status') == 'employee' ? 'selected' : null }}>{{__('site.employee')}}</option>
                                                        </select>
                                                    </div>
                                                    @error('type')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div> --}}
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">@lang('admins.permissions')</label>
                                                        <div class="inp-holder mb-1">
                                                            <label for="name">{{ __('admins.selectall') }}</label>
                                                            <input type="checkbox"  id="selectall" >
                                                        </div>
                                                        <div class="table-holder">
                                                            <div class="table-responsive">
                                                                <table class="table main-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>@lang('roles.model')</th>
                                                                            <th>{{ __('admins.selectall') }}</th>
                                                                            @foreach($permissionMaps as $key => $value)
                                                                              <th>@lang('site.' . $value)
                                                                               <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                                   <label class="m-0">
                                                                                       <input type="checkbox" value=""  onclick="SelectAll(this)"  class="side-roles" id="side-roles">
                                                                                   </label>
                                                                               </div>
                                                                              </th>
                                                                            @endforeach
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($models as $index=>$model)
                                                                            <tr>
                                                                                <td>@lang($model . '.' . $model)</td>
                                                                                <td>
                                                                                    <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                                        <label class="m-0">
                                                                                            <input type="checkbox" value=""  class="all-roles" id="all-roles">
                                                                                            <span class="label-text">{{ __('admins.all') }}</span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                @foreach ($permissionMaps as $key=>$permissionMap )
                                                                                    <td>
                                                                                        <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                                            <label class="m-0">
                                                                                                <input type="checkbox" value="{{ $permissionMap . '_' . $model }}"
                                                                                                name="permissions[]" class="role" id='role_{{ $key }}'>
                                                                                                <span class="label-text">
                                                                                                    @lang('site.' . $permissionMap) @lang($model . '.' . $model)
                                                                                                </span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                @endforeach
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @error('permissions')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('admins.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#selectall').click(function(event) {  //on click
            // console.log('hello');
            if(this.checked) { // check select status
                $('.role').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "role"
                });
            }else{
                $('.role').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "role"
                });
            }
            var chkArray = [];
            $("input[name='check[]']:checked").map(function() {
                chkArray.push(this.value);
            }).get();
            var selected;
            selected = chkArray.join(',') + ",";
            // if(selected.length > 1){
            //     alert('هل تريد تحديد الكل?');
            // } else { alert(' تحديد الكل'); }
        });
    });
</script>
<script>
        $(function () {
        $(document).on('change', '.all-roles', function () {
            $(this).parents('tr').find('input[type="checkbox"]').prop('checked', this.checked);
        });
        $(document).on('change', '.role', function () {
            if (!this.checked) {
                $(this).parents('tr').find('.all-roles').prop('checked', this.checked);
            }
            // else{
            //     $(this).parents('tr').find('.all-roles').prop('checked', this.checked);
            // }
        });

    });//end of document ready

</script>
<script>
   function SelectAll(obj) {
       var table = $(obj).closest('table');
       var th_s = table.find('th');
       var current_th = $(obj).closest('th');
       var columnIndex = th_s.index(current_th) + 1;
       table.find('td:nth-child(' + (columnIndex) + ') input').prop("checked", obj.checked);
   }
</script>
@endpush

