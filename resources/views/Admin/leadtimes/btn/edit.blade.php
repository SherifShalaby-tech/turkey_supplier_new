<!-- Modal -->
<div class="modal fade" id="edit{{ $leadtime->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ trans('site.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.leadtimes.update', $leadtime->id) }}" method="post" autocomplete="off" >
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('leadtimes.qty')}}</label>
                                <input type="number" id="projectinput2" class="form-control"  name="qty"
                                value="{{ old('qty',$leadtime->qty) }}" placeholder="{{trans('leadtimes.qty')}}">
                            </div>
                            @error('qty')
                            <p class="text-danger" style="font-leadtime: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('leadtimes.price')}}</label>
                                <input type="number" id="projectinput2" class="form-control"  name="price"
                                value="{{ old('price',$leadtime->price) }}" placeholder="{{trans('leadtimes.price')}}">
                            </div>
                            @error('price')
                            <p class="text-danger" style="font-leadtime: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('leadtimes.days')}}</label>
                                <input type="number" id="projectinput2" class="form-control"  name="days"
                                value="{{ old('days',$leadtime->days) }}" placeholder="{{trans('leadtimes.days')}}">
                            </div>
                            @error('days')
                            <p class="text-danger" style="font-leadtime: 12px">{{ $message }}</p>
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


