@extends('Admin.layouts.master')
@section('title',trans('product.edit_product'))
@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
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
                                    <h4 class="card-title" id="basic-layout-form">{{trans('product.edit_product')}}</h4>
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
                                        <form  class="form row" action="{{ route('admin.products.update','test') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('product.name') }}</label>
                                                        <input type="text" class="form-control" name="name" required
                                                            value="{{ old('name',$product->name) }}"
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
                                                        'data' => $product
                                                    ])
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">

                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('product.description') }}</label>
                                                        <textarea  class="form-control tinymce" name="description" >
                                                            {!! old('description',$product->description) !!}
                                                        </textarea>
                                                    </div>
                                                    @error('description')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
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
                                                        'data' => $product,
                                                    ])
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="projectinput2">{{ trans('product.image') }}</label>
                                                    <div class="file-loading">
                                                        <input type="file" id="product-images" class="form-control file-input-overview @error('images') is-invalid @enderror" name="images[]" multiple />
                                                    </div>
                                                    @error('images')
                                                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="form-group col-md-12 mb-2"> --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ trans('product.category') }}</label>
                                                        <select class="form-control select2" name="category_id" required>
                                                            <option>{{ trans('product.category') }}</option>
                                                            @foreach ($categories as $category)
                                                            <option {{old('category_id',$category->id) == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('category_id')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput2">{{ trans('product.sub_category') }}</label>

                                                        <select class="form-control select2" name="sub_category_id" required>
                                                            <option value="{{$product->subcategory->id ?? null}}">{{$product->subcategory->name ?? null }}</option>
                                                        </select>
                                                    </div>
                                                    @error('sub_category_id')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('product.video_description') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="video_description"
                                                            value="{{ old('video_description',$product->video_description) }}"
                                                            placeholder="{{ trans('product.video_description') }}">
                                                    </div>
                                                    @error('video_description')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{ trans('products.company') }}</label>

                                                        <select class="form-control select2" name="company_id">
                                                            <option selected disabled readonly>{{ trans('product.choose') }}</option>
                                                            @if(Auth::guard('admin')->user())
                                                                @foreach ($companies as $company)
                                                                <option {{old('company_id',$product->company_id )== $company->id ? 'selected' : null}} value="{{$company->id}}">{{$company->name}}</option>
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
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            {{-- </div> --}}
                                            {{-- <div class="form-group col-md-12 mb-2"> --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('products.price') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control" name="price" value="{{ old('price',$product->price) }}"
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
                                                            name="Packaging" value="{{ old('Packaging',$product->Packaging) }}"
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
                                                            name="Supply_Ability" value="{{ old('Supply_Ability',$product->Supply_Ability) }}"
                                                            placeholder="{{ trans('product.Supply_Ability') }}">
                                                    </div>
                                                    @error('Packaging')
                                                        <p class="text-danger" style="font-size: 12px">
                                                            {{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="projectinput1">{{ trans('product.Place_Origin') }}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            name="Place_Origin" value="{{ old('Place_Origin',$product->Place_Origin) }}"
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
                                                            name="weight" value="{{ old('weight',$product->weight) }}"
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
                                                    <textarea class="form-control" name="tags">{{$product->product_tags->tags ?? ''}}</textarea>
                                                </div>
                                            {{-- </div> --}}
                                            {{-- <div class="form-group col-12 mb-2 file-repeater">
                                                <div data-repeater-list="class_list">
                                                    <div data-repeater-item>
                                                        <div class="row mb-1">
                                                            @foreach($product->colors as $color)
                                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                    <label for="">{{ trans('product.color') }}</label>
                                                                    <br>
                                                                    <input type="text" class="form-control"
                                                                    name="colorName" value="{{ old('colorName',$color->colorName) }}"
                                                                    placeholder="{{ trans('product.color') }}">
                                                                </div>
                                                            @endforeach
                                                            @foreach($product->sizes as $size)
                                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                    <label for="">{{ trans('product.size') }}</label>
                                                                    <br>
                                                                    <input type="text" class="form-control"
                                                                    name="sizeName" value="{{ old('sizeName',$size->sizeName) }}"
                                                                        id="" placeholder="{{ trans('product.size') }}">
                                                                </div>
                                                            @endforeach
                                                            @foreach($product->leadtimes as $leadtime)
                                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                    <label for="">{{ trans('products.leadtime_price') }}</label>
                                                                    <br>
                                                                    <input type="text" class="form-control"
                                                                    name="leadtime_price" value="{{ old('leadtime_price',$leadtime->price) }}"
                                                                    id="" placeholder="{{ trans('products.leadtime_price') }}">
                                                                </div>
                                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                    <label for="">{{ trans('products.leadtime_qty') }}</label>
                                                                    <br>
                                                                    <input type="text" class="form-control"
                                                                    name="leadtime_qty" value="{{ old('leadtime_qty',$leadtime->qty) }}"
                                                                    id="" placeholder="{{ trans('products.leadtime_qty') }}">
                                                                </div>
                                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                    <label for="" class="d-block w-100">{{ trans('products.leadtime_days') }}</label>
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <input type="text" class="form-control" name="days" value="{{ old('days',$leadtime->days) }}" id=""
                                                                        placeholder="{{ trans('products.leadtime_days') }}">
                                                                        <button type="button" data-repeater-delete class="btn btn-icon ml-2 btn-danger ">
                                                                            <i class="ft-x"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" data-repeater-create class="btn btn-primary">
                                                    <i class="ft-plus"></i>{{ __('products.add') }}
                                                </button>
                                            </div> --}}
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
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('select[name="category_id"]').on('change', function() {
            var CategoryId = $(this).val();
            if (CategoryId) {
                $.ajax({
                    url: "{{ URL::to('dashboard/category') }}/" + CategoryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="sub_category_id"]').empty();

                        // console.log(typeof data);
                        for (let i =0;i<= data.length;i++){
                            $('select[name="sub_category_id"]').append('<option value="' +
                                data[i].id + '">' + data[i].name + '</option>');
                        }
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
    <script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script> --}}
    <script>
        $(function(){
            $("#product-images").fileinput({
                    // theme: "bs5",
                    maxFileCount: 15,
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: [
                        @if($product->media()->count() > 0)
                            @foreach($product->media as $media)
                                "{{ asset('images/products/' . $media->file_name) }}",
                            @endforeach
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if($product->media()->count() > 0)
                            @foreach($product->media as $media)
                                {
                                    caption: "{{ $media->file_name }}",
                                    size: '{{ $media->file_size }}',
                                    width: "120px",
                                    url: "{{ route('admin.products.remove_image', ['image_id' => $media->id, 'product_id' => $product->id, '_token' => csrf_token()]) }}",
                                    key: {{ $media->id }}
                                },
                            @endforeach
                        @endif
                    ]
                }).on('filesorted', function (event, params) {
                    console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
                });
        });
    </script>
@endpush
