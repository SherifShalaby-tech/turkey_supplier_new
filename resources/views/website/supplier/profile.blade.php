@extends('layouts.website.master')
@section('title',trans('custom.supplier_profile'))
@section('css')
    <style>

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }


        .btn {
            display: inline-block;
            font: inherit;
            background: none;
            border: none;
            color: inherit;
            padding: 0;
            cursor: pointer;
        }

        .btn:focus {
            outline: 0.5rem auto #4d90fe;
        }

        .visually-hidden {
            position: absolute !important;
            height: 1px;
            width: 1px;
            overflow: hidden;
            clip: rect(1px, 1px, 1px, 1px);
        }

        /* Profile Section */

        .profile {
            padding: 5rem 0;
        }

        .profile::after {
            content: "";
            display: block;
            clear: both;
        }

        .profile-image {
            float: left;
            width: calc(33.333% - 1rem);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 3rem;
        }

        .profile-image img {
            border-radius: 50%;
            height: 140px;
            width: 140px !important;
            border: #184ea7 1px solid;
        }

        .profile-user-settings,
        .profile-stats,
        .profile-bio {
            float: left;
            width: calc(66.666% - 2rem);
        }

        .profile-user-settings {
            margin-top: 1.1rem;
        }

        .profile-user-name {
            display: inline-block;
            /*font-size: 3.2rem;*/
            font-weight: 300;
            color: #333;
        }

        .profile-edit-btn {
            /*font-size: 1.4rem;*/
            line-height: 1.8;
            border: 0.1rem solid #dbdbdb;
            border-radius: 0.3rem;
            padding: 0 2.4rem;
            margin-left: 2rem;
        }

        .profile-settings-btn {
            /*font-size: 2rem;*/
            margin-left: 1rem;
        }

        .profile-stats {
            margin-top: 2.3rem;
        }

        .profile-stats li {
            display: inline-block;
            /*font-size: 1.6rem;*/
            line-height: 1.5;
            margin-right: 4rem;
            cursor: pointer;
        }

        .profile-stats li:last-of-type {
            margin-right: 0;
        }

        .profile-bio {
            /*font-size: 1.6rem;*/
            font-weight: 400;
            line-height: 1.5;
            margin-top: 2.3rem;
        }

        .profile-real-name,
        .profile-stat-count,
        .profile-edit-btn {
            font-weight: 600;
        }

        /* Gallery Section */
        h2 {

            display: block;
            /*font-size: 3em;*/
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }


        .gallery {

            display: flex;
            flex-wrap: wrap;
            margin: -1rem -1rem;
            padding-bottom: 3rem;
        }

        .gallery-item {
            position: relative;
            flex: 1 0 22rem;
            margin: 1rem;
            color: #fff;
            cursor: pointer;
        }

        .gallery-item:hover .gallery-item-info,
        .gallery-item:focus .gallery-item-info {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .gallery-item-info {
            display: none;
        }

        .gallery-item-info li {
            display: inline-block;
            /*font-size: 1.7rem;*/
            font-weight: 600;
        }

        .gallery-item-likes {
            margin-right: 2.2rem;
        }

        .gallery-item-type {
            position: absolute;
            top: 1rem;
            right: 1rem;
            /*font-size: 2.5rem;*/
            text-shadow: 0.2rem 0.2rem 0.2rem rgba(0, 0, 0, 0.1);
        }

        .fa-clone,
        .fa-comment {
            transform: rotateY(180deg);
        }

        .gallery-image {
            width: 100%;
            height: 80%;
            object-fit: cover;
            border-radius: 10px;
        }

        .gallery .gallery-item h3 {
            color: #333;
            padding: 5px 0 ;
            display: block;
            /*font-size: 1.7em;*/
            font-weight: bold;

        }
        .gallery .gallery-item p {
            color: #333;
            padding: 5px 0 ;
            display: block;
            /*font-size: 1.2em;*/
            font-weight: bold;

        }
        /* Media Query */

        @media screen and (max-width: 40rem) {
            .profile {
                display: flex;
                flex-wrap: wrap;
                padding: 4rem 0;
            }

            .profile::after {
                display: none;
            }

            .profile-image,
            .profile-user-settings,
            .profile-bio,
            .profile-stats {
                float: none;
                width: auto;
            }

            .profile-image img {
                width: 7.7rem;
            }

            .profile-user-settings {
                flex-basis: calc(100% - 10.7rem);
                display: flex;
                flex-wrap: wrap;
                margin-top: 1rem;
            }

            .profile-user-name {
                /*font-size: 2.2rem;*/
            }

            .profile-edit-btn {
                order: 1;
                padding: 0;
                text-align: center;
                margin-top: 1rem;
            }

            .profile-edit-btn {
                margin-left: 0;
            }

            .profile-bio {
                /*font-size: 1.4rem;*/
                margin-top: 1.5rem;
            }

            .profile-edit-btn,
            .profile-bio,
            .profile-stats {
                flex-basis: 100%;
            }

            .profile-stats {
                order: 1;
                margin-top: 1.5rem;
            }

            .profile-stats ul {
                display: flex;
                text-align: center;
                padding: 1.2rem 0;
                border-top: 0.1rem solid #dadada;
                border-bottom: 0.1rem solid #dadada;
            }

            .profile-stats li {
                /*font-size: 1.4rem;*/
                flex: 1;
                margin: 0;
            }

            .profile-stat-count {
                display: block;
            }
        }

        .card-title-name{
        width: 272px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0 !important;
     
    }




        @supports (display: grid) {
            .profile {
                display: grid;
                grid-template-columns: 1fr 2fr;
                grid-template-rows: repeat(3, auto);
                grid-column-gap: 3rem;
                align-items: center;
            }

            .profile-image {
                grid-row: 1 / -1;
            }

            .gallery {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(22rem, 1fr));
                grid-gap: 2rem;
            }

            .profile-image,
            .profile-user-settings,
            .profile-stats,
            .profile-bio,
            .gallery-item,
            .gallery {
                width: auto;
                margin: 0;
            }

            @media (max-width: 40rem) {
                .profile {
                    grid-template-columns: auto 1fr;
                    grid-row-gap: 1.5rem;
                }

                .profile-image {
                    grid-row: 1 / 2;
                }

                .profile-user-settings {
                    display: grid;
                    grid-template-columns: auto 1fr;
                    grid-gap: 1rem;
                }

                .profile-edit-btn,
                .profile-stats,
                .profile-bio {
                    grid-column: 1 / -1;
                }

                .profile-user-settings,
                .profile-edit-btn,
                .profile-settings-btn,
                .profile-bio,
                .profile-stats {
                    margin: 0;
                }
            }
        }

        .profile p,li{
            font-size: 22px;
            letter-spacing: 1px;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-image">
                @if($supplier->firstMedia)
                    <img src="{{ asset('images/companies/'.$supplier->firstMedia->file_name) }}" alt="{{ $supplier->name }}" class="img-fluid w-100" >
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="{{ $supplier->name }}" class="img-fluid w-100" >
                @endif
            </div>

            <div class="profile-user-settings">
                <h1 class="profile-user-name">{{$supplier->username}}</h1>
            </div>

            <div class="profile-stats">
                <ul>
                    <li><i class="fas fa-phone"></i> {{$supplier->phone}} </li>
                    <li><i class="fas fa-envelope"></i> {{$supplier->email}}</li>
                </ul>
            </div>

            <div class="profile-bio">
                <p><span class="profile-real-name">supplier description </span> {!! $supplier->description ?? 'No Description' !!}</p>
            </div>

        </div>
        <!-- End of profile section -->

    </div>
    <!-- End of container -->
    <section class="bg0 p-t-23 p-b-140 p-5">
        <div class="container-fluid">
            <div class="row isotope-grid">
                @isset($supplier->products)
                    @foreach($supplier->products as $product)
                       <div class="col-sm-12 col-md-3 col-lg-3 p-b-35 isotope-item women" style="margin-bottom: 30px;">
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <a href="{{ route('product.details',$product->slug) }}">
                                        @if($product->firstMedia)
                                            <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                style="max-width: 100%;  height: 300px !important;width: 100% !important;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: 50% 50%;
                                                border-radius: 7px;" >
                                        @else
                                             <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $product->name }}" class="img-fluid w-100"
                                                style="max-width: 100%;  height: 300px !important;width: 100% !important;
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: 50% 50%;
                                                    border-radius: 7px;">
                                        @endif
                                    </a>
                                 </div>
                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="#" class="stext-106 cl3 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            <p class="card-title card-title-name ">{{trans('custom.name')}} : {{$product->name}}</p>
                                            <p class="card-title">{{trans('custom.price')}} : ${{$product->price}}</p>
                                            <p class="card-text card-title-name">{{trans('custom.details')}} :{!! $product->description !!}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </section>

@stop
