<!-- Modal -->
<div class="modal fade" id="edit{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ trans('site.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.ads.update', $ad->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('ads.title')}}</label>
                                <input type="text" id="projectinput2" class="form-control"  name="title"
                                value="{{ old('title',$ad->title) }}" placeholder="title">
                            </div>
                            @error('title')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('ads.image')}}</label>
                                <input type="file" id="projectinput2" class="form-control img"  name="image" accept="image/*"
                                value="{{ old('image') }}" >
                            </div>
                            @error('image')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            @if($ad->image)
                                <img src="{{ asset('images/ads/' . $ad->image)}}"
                                alt="{{ $ad->title }}" class="img-thumbnail img-preview" width="200px">
                            @else
                             <img src="{{ asset('dashboard/app-assets/images/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('ads.name_entity')}}</label>
                                <input type="text" class="form-control"  name="name_entity"
                                       value="{{$ad->name_entity}}" placeholder="{{trans('ads.name_entity')}}">
                            </div>
                            @error('name_entity')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('ads.start_date')}}</label>
                                <input type="date" class="form-control"  name="start_date"
                                       value="{{$ad->start_date}}" placeholder="{{trans('ads.start_date')}}">
                            </div>
                            @error('start_date')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('ads.end_date')}}</label>
                                <input type="date" class="form-control"  name="end_date"
                                       value="{{$ad->end_date}}" placeholder="{{trans('ads.end_date')}}">
                            </div>
                            @error('end_date')
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


