@extends('Admin.layouts.master')
@section('title',__('sub_categories.editcategory'))
@section('css')
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
                                    <h4 class="card-title" id="basic-layout-form">{{ __('sub_categories.editcategory') }}</h4>
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
                                        <form  class="form" action="{{ route('admin.subcategories.update','test') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$subcategory->id}}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{ __('sub_categories.name') }}</label>
                                                            <input type="text" id="projectinput1" class="form-control" name="name" value="{{ old('name',$subcategory->name) }}" placeholder="Name">
                                                        </div>
                                                        @error('name')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <button style="height: 40px;margin-top: 28px;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#translation_table_subcategory" aria-expanded="false" aria-controls="collapseExample">
                                                        {{ __('categories.addtranslations') }}
                                                    </button>
                                                    @include('Admin.layouts.translation_inputs', [

                                                        'attribute' => 'name',

                                                        'translations' => [],
                                                        'type' => 'subcategory',
                                                        'data' => $subcategory,
                                                    ])
                                                </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('categories.category') }}</label>
                                                            <select class="form-control select2" name="category_id">
                                                                <option value="">{{ __('sub_categories.choose') }}</option>
                                                                {{-- @isset($categories) --}}
                                                                    @foreach($categories as $category)
                                                                        <option {{ old('category_id',$subcategory->category_id) == $category->id ? 'selected' : null}} value="{{$category->id}}">{{$category->name}}</option>
                                                                    @endforeach
                                                                {{-- @endisset --}}
                                                            </select>
                                                        </div>
                                                        @error('category_id')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">{{ __('categories.image') }}</label>
                                                            <input type="file" id="projectinput2"  class="form-control img" name="image" accept="image/*" />
                                                        </div>
                                                        @error('image')
                                                        <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($category->image)
                                                            <img src="{{ asset('images/sub_categories/' . $subcategory->image) }}"
                                                                 alt="" class="img-thumbnail img-preview"  style="width: 100px;">
                                                        @else
                                                            <img src="{{ asset('images/logo.png') }}" alt=""
                                                                 class="img-thumbnail img-preview" width="100px">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
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
