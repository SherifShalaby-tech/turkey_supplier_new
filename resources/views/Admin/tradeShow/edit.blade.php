@extends('Admin.layouts.master')
@section('title',__('tradeshows.tradeshows'))
@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('website/css/intlTelInput.min.css') }}">
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
                                    <h4 class="card-title" id="basic-layout-form">{{trans('tradeshows.tradeshows')}}</h4>
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
                                        <form enctype="multipart/form-data"  class="form" action="{{ route('admin.tradeShows.update',$tradeShow->id) }}" method="post" >
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$tradeShow->id}}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12 mb-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">{{trans('tradShow.title')}}</label>
                                                                <input type="text" class="form-control" name="title" value="{{ $tradeShow->title }}" placeholder="{{trans('tradShow.title')}}">
                                                            </div>
                                                            @error('title')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#translation_table_product" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                {{ __('company.addtranslations') }}
                                                            </button>
                                                            @include('Admin.layouts.translation_inputs', [
                                                                'attribute' => 'title',
                                                                'translations' => [],
                                                                'type' => 'product',
                                                                'data' => $tradeShow
                                                            ])
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 mb-2">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">{{trans('tradShow.description')}}</label>
                                                                <input type="text" class="form-control tinymce" name="description" value="{{ $tradeShow->details }}" placeholder="{{trans('tradShow.description')}}">
                                                            </div>
                                                            @error('description')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button style="height: 40px;margin-top: 28px;" class="btn btn-primary"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#translation_textarea_table" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                {{ __('company.addtranslations') }}
                                                            </button>
                                                            @include('Admin.layouts.translation_textarea', [
                                                                'attribute' => 'description',
                                                                'translations' => [],
                                                                'data' => $tradeShow,
                                                            ])
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{trans('tradShow.video')}}</label>
                                                            <input type="file" multiple class="form-control" name="video" value="" placeholder="{{trans('tradShow.video')}}" />
                                                        </div>
                                                        @error('video')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">{{ trans('tradShow.linkurl') }}</label>
                                                            <input type="text" id="projectinput1" class="form-control"
                                                                name="linkurl" value="{{ old('linkurl',$tradeShow->linkurl) }}"
                                                                placeholder="{{ trans('tradShow.linkurl') }}">
                                                        </div>
                                                        @error('linkurl')
                                                            <p class="text-danger" style="font-size: 12px">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">{{ trans('tradShow.videourl') }}</label>
                                                            <input type="text" id="projectinput1" class="form-control"
                                                                name="videourl" value="{{ old('videourl',$tradeShow->videourl) }}"
                                                                placeholder="{{ trans('tradShow.videourl') }}">
                                                        </div>
                                                        @error('videourl')
                                                            <p class="text-danger" style="font-size: 12px">
                                                                {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 mb-2">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ trans('tradShow.image') }}</label>
                                                            <div class="file-loading">
                                                                <input type="file" id="tradShow-images" class="form-control file-input-overview" name="images[]" multiple />
                                                            </div>
                                                        </div>
                                                        @error('image')
                                                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
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
    <script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script> --}}
    <script>
        $(function(){
            $("#tradShow-images").fileinput({
                    // theme: "bs5",
                    maxFileCount: 15,
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: [
                        @if($tradeShow->media()->count() > 0)
                            @foreach($tradeShow->media as $media)
                                "{{ asset('images/tradeShows/' . $media->file_name) }}",
                            @endforeach
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if($tradeShow->media()->count() > 0)
                            @foreach($tradeShow->media as $media)
                                {
                                    caption: "{{ $media->file_name }}",
                                    size: '{{ $media->file_size }}',
                                    width: "120px",
                                    url: "{{ route('admin.tradeShows.remove_image', ['image_id' => $media->id, 'tradeShow_id' => $tradeShow->id, '_token' => csrf_token()]) }}",
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
