    <a href="{{ route('admin.users.edit',$company->id) }}" class="btn btn-info btn-sm">   {{ trans('site.edit') }}</a>
    <button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $company->id }}">
        <i class="fa fa-trash"></i>
        {{ __('site.delete') }}
    </button>
    <form action="{{ route('admin.companies.destroy', $company->id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
        @csrf
        @method('delete')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="delete{{ $company->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('site.delete') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="hidden" value="{{ $company->id }}">
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

