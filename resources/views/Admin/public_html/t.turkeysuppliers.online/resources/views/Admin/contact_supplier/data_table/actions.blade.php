    {{-- {{ $contactSupplier->id }} --}}
    {{-- @if (auth()->user()->hasPermission('update_contactSuppliers'))
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
            data-target="#edit{{ $contactSupplier->id }}">
        {{ trans('site.edit') }}
    </button>
    @endif
    @include('Admin.contactSuppliers.btn.edit') --}}
    {{-- <a href="{{ route('admin.contactSuppliers.showdata',$contactSupplier->id) }}" class="btn btn-success btn-sm">   {{ trans('site.show') }}</a> --}}
    {{-- @if (auth()->user()->hasPermission('delete_contactSuppliers')) --}}
    {{-- <button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $contactSupplier->id }}">
        <i class="fa fa-trash"></i>
        {{ __('site.delete') }}
    </button> --}}
    {{-- @endif --}}
    <form action="{{ route('admin.contactSuppliers.destroy', $contactSupplier->id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
        @csrf
        @method('delete')

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="delete{{ $contactSupplier->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('site.delete') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="hidden" value="{{ $contactSupplier->id }}">
                            </div>
                            <div class="modal-body">
                                <h5>{{ __('site.warning') }}</h5>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('site.close') }}</button>
                                <button type="submit" class="btn btn-outline-primary"> {{ __('site.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <form action="{{ route('admin.contactSuppliers.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
        @csrf
        @method('delete')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="bulkdeleteall" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('contactSuppliers.bulkdelete') }}</h4>
                                <input type="hidden" id="delete_all" name="delete_select_id" value="">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>{{ __('contactSuppliers.warning') }}</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('contactSuppliers.close') }}</button>
                                <button type="submit" class="btn btn-outline-primary"> {{ __('contactSuppliers.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

