<div class="modal" id="show{{ $contactSupplier->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="email-app-details">
        <!-- email detail view header -->
        <div class="email-detail-header">
            <div class="email-header-left d-flex align-items-center mb-1">
                <span class="go-back mr-50">
                    <i class="ft-chevron-left font-medium-4 align-middle"></i>
                </span>
                <h5 class="email-detail-title font-weight-normal mb-0">
                    {{ __('contactSuppliers.messagefrom') }}
                    <span class="badge badge-light-danger badge-pill ml-1">{{ $contactSupplier->user?->name ?? $contactSupplier->visitor?->name}}</span>
                    <span class="badge badge-light-danger badge-pill ml-1">{{ $contactSupplier->user?->name ? __('company.buyerman'):__('company.visitor')}}</span>

                </h5>
            </div>
            {{-- <div class="email-header-right mb-1 ml-2 pl-1">
                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <button class="btn btn-icon action-icon">
                            <i class="ft-trash-2"></i>
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn btn-icon action-icon">
                            <i class="ft-mail"></i>
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn btn-icon dropdown-toggle action-icon" id="open-mail-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ft-folder mr-0"></i>

                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="open-mail-menu">
                                <a class="dropdown-item" href="#"><i class="ft-edit"></i> Draft</a>
                                <a class="dropdown-item" href="#"><i class="ft-info"></i> Spam</a>
                                <a class="dropdown-item" href="#"><i class="ft-trash-2"></i> Trash</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn btn-icon dropdown-toggle action-icon" id="open-mail-tag" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ft-tag mr-0"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="open-mail-tag">
                                <a href="#" class="dropdown-item align-items-center">
                                    <span class="bullet bullet-success bullet-sm"></span>
                                    Product
                                </a>
                                <a href="#" class="dropdown-item align-items-center">
                                    <span class="bullet bullet-primary bullet-sm"></span>
                                    Work
                                </a>
                                <a href="#" class="dropdown-item align-items-center">
                                    <span class="bullet bullet-warning bullet-sm"></span>
                                    Misc
                                </a>
                                <a href="#" class="dropdown-item align-items-center">
                                    <span class="bullet bullet-danger bullet-sm"></span>
                                    Family
                                </a>
                                <a href="#" class="dropdown-item align-items-center">
                                    <span class="bullet bullet-info bullet-sm"></span>
                                    Design
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <span class="no-of-list d-none d-sm-block ml-1">1-10 of 653</span>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn btn-icon email-pagination-prev action-icon">
                            <i class='ft-chevron-left'></i>
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn btn-icon email-pagination-next action-icon">
                            <i class='ft-chevron-right'></i>
                        </button>
                    </li>
                </ul>
            </div> --}}
        </div>
        <!-- email detail view header end-->
        <div class="email-scroll-area">
            <!-- email details  -->
            <div class="row">
                <div class="col-12">
                    <div class="collapsible email-detail-head">
                        {{-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx--}}
                        <div class="card collapse-header open" role="tablist">
                            <div id="headingCollapse5" class="card-header d-flex justify-content-between align-items-center"
                            data-toggle="collapse" role="tab" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                <div class="collapse-title media">
                                    {{-- <div class="pr-1">
                                        <div class="avatar mr-75">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-18.png" alt="avtar img holder" width="30" height="30">
                                        </div>
                                    </div> --}}
                                    <div class="media-body mt-25">
                                        <span class="text-primary">{{ $contactSupplier->user?->name ?? $contactSupplier->visitor?->name }}</span>
                                        <span class="d-sm-inline d-none"> &lt;{{ $contactSupplier->user?->email ?? $contactSupplier->visitor?->email }}&gt;</span>
                                        <strong class="text-muted d-block">{{ __('contactSuppliers.to') }} {{ $contactSupplier->supplier?->name ?? $contactSupplier->visitor?->name}}</strong>
                                        <span>
                                           <strong class="text-muted d-block">  {{ __('contactSuppliers.productname') }} : {{ $contactSupplier->product?->name }}</strong>
                                           <p class="text-bold-500">{{ __('contactSuppliers.greeting') }}!</p>
                                           <p class="text-bold-500">{!! $contactSupplier->subject !!}</p>
                                           <p>{!! $contactSupplier->message !!}</p>
                                           <p class="mb-0">{{ __('contactSuppliers.sincerely') }},</p>
                                           <p class="text-bold-500">{{ $contactSupplier->supplier?->name ?? $contactSupplier->visitor?->name}} {{ __('contactSuppliers.company') }}</p>
                                           <div class="btn btn-primary">click to Attachment </div>
                                           {{-- @if ($contactSupplier->file )
                                           <embed src="{{url('/Attachments/'.$contactSupplier->file)}}" style="width:900px; height:800px;" frameborder="0">
                                           @endif --}}
                                            {{-- @if($contactSupplier->product->firstMedia)
                                            <img src="{{ asset('images/products/'.$contactSupplier->product->firstMedia->file_name) }}" alt="">
                                            @endif --}}
                                        </span>
                                    </div>
                                </div>
                                <div class="information d-sm-flex d-none align-items-center">
                                    <small class="text-muted mr-50">{{ $contactSupplier->created_at() }}</small>
                                    <span class="favorite">
                                        <i class="ft-star mr-25"></i>
                                    </span>
                                    {{-- <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class='ft-more-vertical mr-0'></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="fisrt-open-submenu">
                                            <a href="#" class="dropdown-item mail-reply">
                                                <i class='ft-share-2'></i>
                                                Reply
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class='ft-corner-up-right'></i>
                                                Forward
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class='ft-info'></i>
                                                Report Spam
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="collapse" >
                                <div class="card-content">
                                    {{-- <div class="card-body py-1">
                                        <p class="text-bold-500">{{ __('contactSuppliers.greeting') }}!</p>
                                        <p class="text-bold-500">{!! $contactSupplier->subject !!}</p>
                                        <p>
                                            {!! $contactSupplier->message !!}
                                        </p>

                                        <p class="mb-0">{{ __('contactSuppliers.sincerely') }},</p>
                                        <p class="text-bold-500">{{ $contactSupplier->supplier?->name ?? $contactSupplier->visitor?->name}} {{ __('contactSuppliers.company') }}</p>
                                    </div> --}}
                                    <div class="card-footer pt-0 border-top">
                                        <label class="sidebar-label">{{ __('contactSuppliers.attachment') }}</label>
                                        {{-- <form action="" enctype="multipart/form-data"> --}}
                                            <ul class="list-unstyled mb-0">
                                                <li class="cursor-pointer pb-25">
                                                    @if ($contactSupplier->file )
                                                    <embed src="{{url('/Attachments/'.$contactSupplier->file)}}" style="width:900px; height:500px;" frameborder="0">
                                                        {{-- @if( in_array($contactSupplier->file->extension(), ['png','jpg','jpeg','gif']) ) --}}
                                                        {{-- @if( $contactSupplier->file->contains(9)) --}}
                                                        {{-- <img src="{{ asset('Attachments/'.$contactSupplier->file) }}" height="100" widtht="100" > --}}
                                                        {{-- @endif --}}
                                                        {{-- @if( in_array($contactSupplier->file->extension(), ['pdf']) ) --}}
                                                        {{-- <a class="btn btn-success" href="{{url('/Attachments/'.$contactSupplier->file)}}"> Download Attachment </a> --}}
                                                            {{-- <embed src="{{url('/Attachments/'.$contactSupplier->file)}}" type="application/pdf"
                                                                frameBorder="0"
                                                                scrolling="auto"
                                                                height="500" width="1000"> --}}
                                                        {{-- @endif --}}
                                                    @endif
                                                    {{-- <small class="text-muted ml-1 attchement-text">uikit-design.psd</small> --}}
                                                </li>
                                                {{-- <li class="cursor-pointer">
                                                    <img src="../../../app-assets/images/icons/sketch.png" height="30" alt="sketch.png">
                                                    <small class="text-muted ml-1 attchement-text">uikit-design.sketch</small>
                                                </li> --}}
                                            </ul>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx --}}
                    </div>
                </div>
            </div>
            <!-- email details  end-->
            <div class="row px-2 mb-4">
                <!-- quill editor for reply message -->
                <div class="col-12 px-0">
                    <div class="card shadow-none border rounded">
                        <div class="card-body quill-wrapper">
                            <span>{{ __('contactSuppliers.replay') }} {{ $contactSupplier->user?->name ?? $contactSupplier->visitor?->name}} </span>
                            <div class="snow-container" id="detail-view-quill">
                                {{-- <div class="detail-view-editor"></div> --}}
                                <div class="d-flex justify-content-end">
                                    {{-- <div class="detail-quill-toolbar">
                                        <span class="ql-formats mr-50">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                        </span>
                                    </div> --}}
                                    <form action="{{ route('admin.contactSuppliers.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(auth('company')->user())
                                        <input type="hidden" name="supplier_id" value="{{Auth::guard('company')->user()->id}}">
                                        @endif
                                        @if(auth('clerk')->user())
                                        <input type="hidden" name="supplier_id" value="{{Auth::guard('clerk')->user()->company_id}}">
                                        @endif
                                        {{-- <input type="hidden" name="user_id" value="{{$contactSupplier->user?->id ?? $contactSupplier->visitor?->id}}"> --}}
                                        @if($contactSupplier->user_id <> null)
                                        <input type="hidden" name="user_id" value="{{$contactSupplier->user?->id }}">
                                        @elseif($contactSupplier->visitor_id <> null)
                                        <input type="hidden" name="visitor_id" value="{{$contactSupplier->visitor?->id}}">
                                        @endif
                                        <input type="hidden" name="product_id" value="{{$contactSupplier->product?->id}}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <input type="text" name="subject" id="" class="form-control" placeholder="{{trans('custom.subject')}}">
                                                @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea required="required" name="message"
                                                        placeholder="Type Somthing" class="form-control " >

                                                    </textarea>
                                                    @error('message')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{trans('custom.file')}}</label>
                                                    <p class="text-danger">* {{ __('contactSuppliers.attachtype') }} pdf, jpeg ,.jpg , png </p>
                                                    <input type="file" class="form-control" name="file" style="width: 50%">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-warning" value="{{trans('custom.send')}}">
                                            </div>
                                            {{-- <button class="btn btn-primary send-btn" type="submit">
                                                <i class='ft-play mr-25'></i>
                                                <span class="d-none d-sm-inline"> Send</span>
                                            </button> --}}
                                        </div>
                                        {{-- <input type="submit" class="btn btn-warning" value="{{trans('custom.send')}}"> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
