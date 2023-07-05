@extends('Admin.layouts.master')
@section('title',trans('product.show_product'))
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
                                    <h4 class="card-title" id="basic-layout-form">{{trans('product.show_product')}} {{ $product->name }}</h4>
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.name') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->name }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.category') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->category->name ??"" }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.sub_category') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->subcategory->name ??"" }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            @if(Auth::guard('admin')->user())
                                                <div class="form-group">
                                                    <a href="{{ route('admin.companies.showdata',$product->company->id ??"") }}">
                                                        <label for="projectinput1" style="color: black;">{{ trans('product.company') }}
                                                            <span style="color: red;font-weight:bold;">({{ __('product.goto') }})</span>
                                                        </label>
                                                        <input type="text" class="form-control" name="name" disabled
                                                            value="{{ $product->company->name ??"" }}" >
                                                    </a>
                                                </div>
                                            @endif
                                            @if(Auth::guard('company')->user())
                                                <label for="projectinput1" style="color: black;">{{ trans('product.company') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->company->name ??"" }}" >
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.video_description') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->video_description }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.price') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ number_format($product->price, 2) }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.Packaging') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->Packaging }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.Supply_Ability') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->Supply_Ability }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.Place_Origin') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->Place_Origin }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.weight') }}</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    value="{{ $product->weight }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.color') }}</label>
                                                @foreach ( $product->colors as $color)
                                                <input type="text" class="form-control"disabled
                                                    value="{{ $color->colorName }}" >
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.size') }}</label>
                                                @foreach ( $product->sizes as $size)
                                                    <input type="text" class="form-control"disabled
                                                    value="{{ $size->sizeName }}" >
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ trans('products.leadtime_price') }}</th>
                                                            <th>{{ trans('products.leadtime_qty') }}</th>
                                                            <th>{{ trans('products.leadtime_days') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ( $product->leadtimes as $leadtime)
                                                        <tr>
                                                            <td>{{ number_format($leadtime->price, 2) }}</td>
                                                            <td>{{ $leadtime->qty }}</td>
                                                            <td>{{ $leadtime->days }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">{{ trans('product.description') }}</label>
                                                {{-- <input  class="form-control " name="description" disabled value=""> --}}
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="form-group">
                                            <label for="projectinput2">{{ trans('product.image') }}</label>
                                            <div class="file-loading">
                                                <input type="file" id="product-images" class="form-control file-input-overview" name="images[]" multiple disabled/>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="hover-effects" class="card">
                    <div class="card-content collapse show">
                        <div class="card-body pb-0">
                            <div class="card-text">
                                <p>{{ __('product.image') }}</p>
                            </div>
                        </div>
                        <div class="card-body my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                            <div class="grid-hover row">
                                @forelse ( $product->media as $media)
                                    <div class="col-lg-3 col-12">
                                        <figure class="effect-lily">
                                            <img src="{{ asset('images/products/' . $media->file_name) }}" alt="img12" />
                                            <figcaption>
                                                <div>
                                                    {{-- <h2 style="color:black;"><span >{{ $company->name }}</span></h2> --}}
                                                    {{-- <p style="color:black;">{!!  $company->description  !!}</p> --}}
                                                </div>
                                                {{-- <a href="{{ route('admin.products.showdata',$product->id) }}">View more</a> --}}
                                            </figcaption>
                                        </figure>
                                    </div>
                                @empty
                                    <div class="alert alert-danger">{{trans('product.images_not_found')}}</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>
                <section id="hover-effects" class="card">
                    <div class="card-content collapse show">
                        <div class="card-body pb-0">
                            <div class="card-text">
                                <p>{{ __('product.certificates') }}</p>
                            </div>
                        </div>
                        <div class="card-body my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                            <div class="grid-hover row">
                                @forelse ( $product->certificates as $media)
                                    <div class="col-lg-3 col-12">
                                        <figure class="effect-lily">
                                            <img src="{{ asset('images/products/certificates/' . $media->image) }}" alt="img12" />
                                            <figcaption>
                                                <div>
                                                    {{-- <h2 style="color:black;"><span >{{ $company->name }}</span></h2> --}}
                                                    {{-- <p style="color:black;">{!!  $company->description  !!}</p> --}}
                                                </div>
                                                {{-- <a href="{{ route('admin.products.showdata',$product->id) }}">View more</a> --}}
                                            </figcaption>
                                        </figure>
                                    </div>
                                @empty
                                    <div class="alert alert-danger">{{trans('product.certificates_not_found')}}</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

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
                        console.log(typeof data);
                        for (let i =1;i<= data.length;i++){
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
                                    // url: "{{ route('admin.products.remove_image', ['image_id' => $media->id, 'product_id' => $product->id, '_token' => csrf_token()]) }}",
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
