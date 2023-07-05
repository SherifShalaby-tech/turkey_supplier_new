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
                                        <form enctype="multipart/form-data" id="form_edit_tradShow" class="form" action="{{ route('admin.tradeShows.update',$tradeShow->id) }}" method="post" >
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
                                                            <div class="container mt-3">
                                                                <div class="row mx-0"
                                                                     style="border: 1px solid #ddd;padding: 30px 0px;">
                                                                    <div class="col-12">
                                                                        <div class="mt-3">
                                                                            <div class="row">
                                                                                <div class="col-10 offset-1">
                                                                                    <div class="variants">
                                                                                        <div class='file file--upload w-100'>
                                                                                            <label for='file-input-images'
                                                                                                   class="w-100">
                                                                                                <i class="fas fa-cloud-upload-alt"></i>Upload
                                                                                            </label>
                                                                                            <!-- <input  id="file-input" multiple type='file' /> -->
                                                                                            <input type="file"
                                                                                                   id="file-input-images"
                                                                                                   multiple>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-10 offset-1">
                                                                        <div class="preview-images-container">
                                                                            @if($tradeShow->media()->count() > 0)
                                                                                @foreach($tradeShow->media as $index=>$media)
                                                                                    <div id="preview{{ $index + 1 }}" class="preview">
                                                                                        <img
                                                                                            src="{{ asset('images/tradeShows/' . $media->file_name) }}"
                                                                                            id="img{{  $index + 1 }}" alt="">
                                                                                        <div class="action_div"></div>
                                                                                        <button type="button"
                                                                                                class="delete-btn"><i
                                                                                                style="font-size: 20px;"
                                                                                                id="deleteBtn{{ $index + 1 }}"
                                                                                                class="fas fa-trash"></i>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                                data-toggle="modal"
                                                                                                id="cropBtn{{ $index + 1 }}"
                                                                                                data-target="#imagesModal"
                                                                                                class="crop-btn"><i
                                                                                                style="font-size: 20px;"
                                                                                                class="fas fa-crop"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div id="cropped_images"></div>
                                            <div class="form-actions">
                                                <button id="edit-btn" class="btn btn-primary">
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
                <div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagesModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="croppie-modal" style="display:none">
                                    <div id="croppie-container"></div>
                                    <button data-dismiss="modal" id="croppie-cancel-btn" type="button"
                                            class="btn btn-secondary"><i
                                            class="fas fa-times"></i></button>
                                    <button id="croppie-submit-btn" type="button" class="btn btn-primary"><i
                                            class="fas fa-crop"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        $("#edit-btn").click(function (e){
            e.preventDefault();
            getImages()
            setTimeout(()=>{
                $("#form_edit_tradShow").submit();
            },500)
        });
        const fileInputImages = document.querySelector('#file-input-images');
        const previewImagesContainer = document.querySelector('.preview-images-container');
        const croppieModal = document.querySelector('#croppie-modal');
        const croppieContainer = document.querySelector('#croppie-container');
        const croppieCancelBtn = document.querySelector('#croppie-cancel-btn');
        const croppieSubmitBtn = document.querySelector('#croppie-submit-btn');
        fileInputImages.addEventListener('change', () => {
            let files = Array.from(fileInputImages.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);

                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            // if (window.confirm('Are you sure you want to delete this image?')) {
                            //     files.splice(file, 1)
                            //     preview.remove();
                            //     getImages()
                            // }
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getImages()
                                }
                            });
                        });

                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#imagesModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchImagesCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewImagesContainer.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                } else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }
            getImages()
        });
        function launchImagesCropTool(img) {
            // Set up Croppie options
            const croppieOptions = {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square' // or 'square'
                },
                boundary: {
                    width: 300,
                    height: 300,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            const croppie = new Croppie(croppieContainer, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieModal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieCancelBtn.addEventListener('click', () => {
                croppieModal.style.display = 'none';
                $('#imagesModal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieSubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                        width: 800,
                        height: 600
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieModal.style.display = 'none';
                    $('#imagesModal').modal('hide');
                    croppie.destroy();
                });
            });
        }

        // edit Case

        @if($tradeShow->media()->count() > 0)
        @foreach($tradeShow->media as $index=>$media)
        document.getElementById("cropBtn{{ $index + 1 }}").addEventListener('click', () => {
            console.log(("#imagesModal"))
            setTimeout(() => {
                launchImagesCropTool(document.getElementById("img{{ $index + 1 }}"));
            }, 500);
        });
        document.getElementById("deleteBtn{{ $index + 1 }}").addEventListener('click', () => {
            {{--if (window.confirm('Are you sure you want to delete this image?')) {--}}
            {{--    $("#preview{{ $index + 1 }}").remove();--}}
            {{--}--}}
            Swal.fire({
                title: '{{ __("site.Are you sure?") }}',
                text: "{{ __("site.You won't be able to delete!") }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        '{{ __("site.Your Image has been deleted.") }}',
                        'success'
                    )
                    $("#preview{{ $index +1 }}").remove();
                }
            });
        });
        @endforeach
        @endif
        function getImages() {
            $("#cropped_images").empty();
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-images-container');
                let images = [];
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "cropImages[]").val(container[0].children[i].children[0].src);
                    $("#cropped_images").append(newInput);
                }
                console.log(images)
                return images
            }, 300);
        }


    </script>

@endpush
