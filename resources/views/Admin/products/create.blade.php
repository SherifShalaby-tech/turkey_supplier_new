@extends('Admin.layouts.master')
@section('title', trans('product.new_product'))
@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/themes/bs5/theme.css') }}"> --}}
<style>
    .kv-file-upload{
        display: none;
    }

</style>
@endsection
@section('content')
@include('Admin.products.datatable.addcat')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="form-control-repeater">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="file-repeater">{{ trans('product.new_product') }}</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                        <form class="form row" action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('product.name') }}</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name') }}" required
                                                            placeholder="{{ trans('product.name') }}">
                                                    </div>
                                                    @error('name')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">

                                                    <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#translation_table_product" aria-expanded="false"
                                                    aria-controls="collapseExample">
                                                    {{ __('company.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_inputs', [
                                                        'attribute' => 'name',
                                                        'translations' => [],
                                                        'type' => 'product',
                                                    ])
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('product.description') }}</label>
                                                        <textarea @if(auth('company')->user()) maxlength="{{auth('company')->user()->plan->character_count}}"  @endif class="form-control tinymce" name="description" placeholder="{{ trans('product.description') }}">
                                                            {!! old('description',trans('product.description')) !!}

                                                        </textarea>
                                                    </div>
                                                    @error('description')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#translation_textarea_table" aria-expanded="false"
                                                    aria-controls="collapseExample">
                                                    {{ __('company.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_textarea', [
                                                        'attribute' => 'description',
                                                        'translations' => [],
                                                    ])


                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('product.certificates') }}</label>
                                                    <div class="file-loading">
                                                        <input type="file" id="product-images-ser" class="@error('certificates') is-invalid @enderror form-control file-input-overview" name="certificates[]" multiple />
                                                    </div>
                                                </div>
                                                @error('certificates')
                                                <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('product.image') }}</label>
                                                    <div class="file-loading">
                                                        <input type="file" id="product-images" required
                                                        class="@error('images') is-invalid @enderror form-control file-input-overview "
                                                        name="images[]" multiple accept="image"/>
                                                    </div>
                                                </div>
                                                @error('images')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }} </p>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group col-md-12 mb-2"> --}}
                                                <div class="col-md-4">
                                                    <div class="form-group" >
                                                        <label for="projectinput2">{{ trans('product.category') }}</label>
                                                        @if (Auth::guard('company')->user())
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text btn btn-primary" id="basicat"
                                                                     data-toggle="modal" data-target="#addcat">
                                                                    <i class="la la-plus"></i>
                                                                </span>
                                                            </div>
                                                        @endif
                                                        <select class="form-control select2" name="category_id" required>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':null }}>
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('category_id')<p class="text-danger" style="font-size: 12px">{{ $message }}</p>@enderror
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ trans('product.sub_category') }}</label>
                                                        @if (Auth::guard('company')->user())
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text btn btn-primary" id="basicsubcat"
                                                                     data-toggle="modal" data-target="#addsubcat">
                                                                    <i class="la la-plus"></i>
                                                                </span>
                                                            </div>
                                                        @endif
                                                        <select class="form-control select2" name="sub_category_id" required>


                                                        </select>
                                                    </div>
                                                    @error('sub_category_id')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('product.video_description') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="video_description"
                                                            value="{{ old('video_description') }}"
                                                            placeholder="{{ trans('product.video_description') }}">
                                                    </div>
                                                    @error('video_description')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <label for="projectinput2">{{ trans('products.company') }}</label>
                                                        <select class="form-control select2" name="company_id" required>
                                                            <option selected disabled readonly>{{ trans('product.choose') }}</option>
                                                            @if(Auth::guard('admin')->user())
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}" {{ old('company_id')==$company->id?'selected':null }}>
                                                                        {{ $company->name }}</option>
                                                                @endforeach
                                                            @endif
                                                            @if(Auth::guard('company')->user())
                                                                <option value="{{ App\Models\Company::whereId(Auth::guard('company')->user()->id)->first()->id }}" selected >
                                                                    {{ App\Models\Company::whereId(Auth::guard('company')->user()->id)->first()->name }}
                                                                </option>
                                                            @endif
                                                            @if(Auth::guard('clerk')->user())
                                                                <option value="{{ App\Models\Company::whereId(Auth::guard('clerk')->user()->company_id)->first()->id }}" selected >
                                                                    {{ App\Models\Company::whereId(Auth::guard('clerk')->user()->company_id)->first()->name }}
                                                                </option>
                                                            @endif
                                                        </select>

                                                    </div>
                                                    @error('company_id')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            {{-- </div> --}}
                                            {{-- <div class="form-group col-md-12 mb-2"> --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('products.price') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="price" value="{{ old('price') }}"
                                                            placeholder="{{ trans('products.price') }}" required>
                                                    </div>
                                                    @error('price')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('product.Packaging') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="Packaging" value="{{ old('Packaging') }}"
                                                            placeholder="{{ trans('product.Packaging') }}">
                                                    </div>
                                                    @error('Packaging')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('product.Supply_Ability') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="Supply_Ability" value="{{ old('Supply_Ability') }}"
                                                            placeholder="{{ trans('product.Supply_Ability') }}">
                                                    </div>
                                                    @error('Supply_Ability')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('product.Place_Origin') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="Place_Origin" value="{{ old('Place_Origin') }}"
                                                            placeholder="{{ trans('product.Place_Origin') }}">
                                                    </div>
                                                    @error('Place_Origin')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('product.weight') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="weight" value="{{ old('weight') }}"
                                                            placeholder="{{ trans('product.weight') }}">
                                                    </div>
                                                    @error('weight')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label
                                                        for="projectinput1">{{ trans('product.tags') }}</label>
                                                    <textarea class="form-control" name="tags">{{old('tags')}}</textarea>
                                                </div>
                                            {{-- </div> --}}
                                            <div class="form-group col-12 mb-2 file-repeater">
                                                <div data-repeater-list="class_list">
                                                    <div data-repeater-item>
                                                        <div class="row mb-1">
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('product.color') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                 name="colorName" value="{{ old('colorName') }}"
                                                                 placeholder="{{ trans('product.color') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('product.colorcode') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                 name="colorCode" value="{{ old('colorCode') }}"
                                                                 placeholder="{{ trans('product.colorcode') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('product.size') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                name="sizeName" value="{{ old('sizeName') }}"
                                                                    id="" placeholder="{{ trans('product.size') }}">
                                                            </div>
                                                            {{-- <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('products.qty') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                name="qty" value="{{ old('qty') }}"
                                                                    id="" placeholder="{{ trans('products.qty') }}">
                                                            </div> --}}
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('products.leadtime_price') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                name="leadtime_price" value="{{ old('leadtime_price') }}"
                                                                    id="" placeholder="{{ trans('products.leadtime_price') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="">{{ trans('products.leadtime_qty') }}</label>
                                                                <br>
                                                                <input type="text" class="form-control"
                                                                name="leadtime_qty" value="{{ old('leadtime_qty') }}"
                                                                    id="" placeholder="{{ trans('products.leadtime_qty') }}">
                                                            </div>
                                                            <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                <label for="" class="d-block w-100">{{ trans('products.leadtime_days') }}</label>
                                                                <div class="d-flex align-items-center justify-content-center">
                                                                    <input type="text" class="form-control" name="days" value="{{ old('days') }}" id=""
                                                                           placeholder="{{ trans('products.leadtime_days') }}">
                                                                    <button type="button" data-repeater-delete class="btn btn-icon ml-2 btn-danger ">
                                                                        <i class="ft-x"></i>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" data-repeater-create class="btn btn-primary">
                                                    <i class="ft-plus"></i>{{ __('products.add') }}
                                                </button>
                                            </div>
                                            <div class=" w-100 d-flex align-items-center justify-content-center">
                                                <button type="submit" class="btn btn-success px-4">
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
                {{-- ///////////////////////////// --}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('select[name="category_id"]').on('change', function() {
            var CategoryId = $(this).val();
            if (CategoryId) {
                console.log(CategoryId);
                $.ajax({
                    url: "{{ URL::to('dashboard/category') }}/" + CategoryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="sub_category_id"]').empty();
                        for (let i =0;i<= data.length;i++){
                            $('select[name="sub_category_id"]').append('<option value="' +
                                data[i].id + '">' + data[i].name + '</option>');
                        }
                        // $.each(data, function(key, value) {
                        //         $('select[name="sub_category_id"]').append('<option value="' +
                        //             key + '">' + value + '</option>');
                        //     });
                        // $.each(data, function(key, value) {
                        //     $('select[name="sub_category_id"]').append('<option value="' +
                        //         data.id + '">' + data.name + '</option>');
                        // });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    </script>

{{-- <script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script> --}}
{{-- <script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script> --}}
<script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
{{-- <script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script> --}}
<script>
    $("#product-images").fileinput({
      // theme: "bs5",
            // maxFileCount: 15,
            // allowedFileTypes: ['image'],
            // showCancel: true,
            // showUpload: false,
            // showRemove: false,
            // overwriteInitial: false,
            // initialPreviewAsData: true,
            // maxFileSize: 10000,
            // removeFromPreviewOnError: true,
            // browseOnZoneClick:true,
            // showBrowse:false,
            // initialPreviewAsData: true,
            // initialPreviewDownloadUrl: 'https://picsum.photos/id/{key}/1920/1080'
            // theme: "bs5",
            // uploadUrl: "/file-upload-batch/2",
    uploadUrl: "{{ route('admin.products.upload_image', ['_token' => csrf_token()]) }}",
    allowedFileExtensions: ['jpg', 'png', 'gif','jpeg','svg'],
    overwriteInitial: false,
    initialPreviewAsData: true,
    maxFileSize: 10000,
    removeFromPreviewOnError: true,
    showUpload: false,
       // maxFileCount: 15,
            // allowedFileTypes: ['image'],
            // showCancel: true,
            // showRemove: true,
    initialPreview: [

    ],
    initialPreviewConfig: [

    ],
});
    $("#product-images-ser").fileinput({
        // theme: "bs5",
        maxFileCount: 15,
        allowedFileTypes: ['image'],
        showCancel: true,
        showRemove: false,
        showUpload: false,
        overwriteInitial: false
    });
</script>
@endpush
