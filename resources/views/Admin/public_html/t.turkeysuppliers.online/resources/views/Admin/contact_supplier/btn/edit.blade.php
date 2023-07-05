<!-- Modal -->
<div class="modal fade" id="edit{{ $color->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ trans('site.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.colors.update', $color->id) }}" method="post" autocomplete="off" >
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('colors.colorName')}}</label>
                                <input type="text" id="projectinput2" class="form-control"  name="colorName"
                                value="{{ old('colorName',$color->colorName) }}" placeholder="colorName">
                            </div>
                            @error('colorName')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('colors.colorCode')}}</label>
                                <input type="number" id="projectinput2" class="form-control"  name="colorCode"
                                value="{{ old('colorCode',$color->colorCode) }}" placeholder="colorCode">
                            </div>
                            @error('colorCode')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('site.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('site.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


