    {{-- {{ $color->id }} --}}
    @if (auth()->user()->hasPermission('update_colors'))
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
            data-target="#edit{{ $color->id }}">
        {{ trans('site.edit') }}
    </button>
    @endif
    @include('Admin.colors.btn.edit')

    @if (auth()->user()->hasPermission('delete_colors'))
    <button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $color->id }}">
        <i class="fa fa-trash"></i>
        {{ __('site.delete') }}
    </button>
    @endif
    <form action="{{ route('admin.colors.destroy', $color->id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">
        @csrf
        @method('delete')

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="delete{{ $color->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('site.delete') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <input type="hidden" value="{{ $color->id }}">
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

