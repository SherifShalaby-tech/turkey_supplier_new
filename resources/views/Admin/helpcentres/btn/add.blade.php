<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ trans('site.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.helpcenters.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('helpcenters.title')}}</label>
                                <input type="text" id="projectinput2" class="form-control"  name="title" required="required"
                                       value="{{ old('title') }}" placeholder="{{trans('helpcenters.title')}}">
                            </div>
                            @error('title')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button style="height: 40px" class="btn btn-primary"
                                    type="button" data-toggle="collapse"
                                    data-target="#translation_table_helpCenter" aria-expanded="false"
                                    aria-controls="collapseExample">
                                {{ __('company.addtranslations') }}
                            </button>
                            @include('Admin.layouts.translation_inputs', [
                                'attribute' => 'title',
                                'translations' => [],
                                'type' => 'helpCenter',
                            ])
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput2">{{trans('helpcenters.description')}}</label>
                                <textarea class="form-control tinymce"  name="description"  >
                                    {{ old('description') }}
                                </textarea>
                            </div>
                            @error('description')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button style="height: 40px;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#translation_textarea_table" aria-expanded="false" aria-controls="collapseExample">
                                {{ __('company.addtranslations') }}
                            </button>
                            @include('Admin.layouts.translation_textarea', [
                                'attribute' => 'description',
                                'translations' => [],
                            ])
                        </div>
                    </div>
                    <div class=" form-group col-md-12">
                        <label for="projectinput2">{{ trans('aboutnew.image') }}</label>
                        <div class="">
                            <input type="file" id="" required="required"
                                class="form-control img" name="image"
                                 accept="image/*" />
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('images/Logo.jpg') }}" alt="" class="img-thumbnail img-preview" width="100px">
                        </div>
                        @error('image')
                            <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('site.save') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('site.cancel') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
