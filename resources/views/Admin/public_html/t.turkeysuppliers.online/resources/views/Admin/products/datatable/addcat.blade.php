{{-- add cat --}}
{{-- <form action="" class="my-1 my-xl-0" method="post" style="display: inline-block;" autocomplete="off">

    @csrf
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated flipInY text-left" id="addcat" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('site.delete') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
</form> --}}
<!-- Modal -->

{{-- طلب اضافه قسم رئيسى --}}
<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ trans('site.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.products.addcat') }}" method="post" autocomplete="off" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{ __('categories.name') }}</label>
                                <input type="text" id="projectinput2" class="form-control"  name="categoryname"
                                value="{{ old('categoryname') }}" placeholder="{{ __('categories.name') }}">
                            </div>
                            @error('categoryname')
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

{{-- طلب اضافه قسم فرعى --}}
<div class="modal fade" id="addsubcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ trans('site.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.products.addsubcat') }}" method="post" autocomplete="off" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{ __('categories.name') }}</label>
                                <select class="form-control select2" name="categoryname">
                                    <option value="" selected readonly disabled>--{{ __('newcat.select') }}--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}" >
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('categoryname')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput2">{{ __('sub_categories.name') }}</label>
                                <input type="text" id="projectinput2" class="form-control"  name="subcategoryname"
                                value="{{ old('subcategoryname') }}" placeholder="{{ __('sub_categories.name') }}">
                            </div>
                            @error('subcategoryname')
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
