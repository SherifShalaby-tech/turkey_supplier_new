@extends('layouts.website.master')
@section('title',auth('company')->user()->name)
@section('content')

<style>


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

     .fa-clone,
    .fa-comment {
        transform: rotateY(180deg);
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
</style>

<div class="container">

    <div class="profile">

        <div class="profile-image">
            @if($buyer->firstMedia)
                <img src="{{ asset('images/companies/'.$buyer->firstMedia->file_name) }}" alt="{{ $buyer->name }}" class="img-fluid w-100" >
            @else
                <img src="{{ asset('images/no-image.png') }}" alt="{{ $buyer->name }}" class="img-fluid w-100" >
            @endif
        </div>

        <div class="profile-user-settings">

            <h3 class="profile-user-name"> {{trans('custom.name')}} : {{$buyer->name}}</h3>

              <a href="{{route('buyer.edit.profile',$buyer->id)}}" class="btn profile-edit-btn">{{trans('custom.edit_profile')}}</a>
{{--             <button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>--}}

        </div>

        <div class="profile-stats">

            <ul>
                <li><i class="fas fa-phone"></i> {{trans('custom.phone')}} : {{$buyer->phone}}</li>
                <li><i class="fas fa-envelope"></i> {{trans('custom.email')}} : {{$buyer->email}}</li>

            </ul>

        </div>

        <div class="profile-bio">
            <p><span class="profile-real-name">{{trans('custom.bio')}} :  {{$buyer->description}} </span> </p>
        </div>

    </div>


</div>




@stop