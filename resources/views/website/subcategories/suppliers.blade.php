@extends('layouts.website.master')
@section('title',trans('custom.suppliers'))
@section('content')
<style>
    .form__group {
    position: relative;
    padding: 15px 0 0;
    margin-top: 10px;
    margin-bottom: 40px;
    width: 100%;
    }

    .form__field {
    width: 100%;
    border: 0;
    border-bottom: 2px solid rgb(26, 26, 26);;
    outline: 0;
    font-size: 22px;
    color: rgba(26, 26, 26, 0.336);
    padding: 7px 0;
    background: transparent;
    transition: border-color 0.2s;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 0px;



    }
    .form__field::placeholder {
    color: transparent;
    }
    .form__field:placeholder-shown ~ .form__label {
    font-size: 22px;
    cursor: text;
    top: 20px;
    }

    .form__label {
    position: absolute;
    top: 0;
    display: block;
    transition: 0.2s;
    font-size: 22px;
    color: rgba(26, 26, 26, 0.336);
    }

    .form__field:focus {
    padding-bottom: 6px;
    font-weight: 700;
    border-width: 3px;
    border-image: linear-gradient(to right, #3797b1, #15667c);
    border-image-slice: 1;
    }
    .form__field:focus ~ .form__label {
    position: absolute;
    top: 0;
    display: block;
    transition: 0.2s;
    font-size: 22px;
    color: #3797b1;
    font-weight: 700;
    }

    /* reset input */
    .form__field:required, .form__field:invalid {
    box-shadow: none;
    }

    /* */
    aside {
    display: grid;
    grid-template-columns: 350px  1fr;
    gap: 1rem;
    min-height: 100vh;
    justify-content: space-between;
    flex-direction: column;
    justify-items: start;
    padding-left:100px;
    }

    aside li a {
        color: #333 !important;
    }
    aside h4{
        color: rgb(95, 121, 134);
    }
    #sidebar{
        width: 100%;
    }
 ul li {
    font-size:22px;
 }

 .card-title-name{
    width: 260px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
#main{
    width: 98%;
}
.breadcrumb{
    font-size: 22px;
}
.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.200em;
    vertical-align: 0.255em;
    top: auto !important;
    content: "";
    position: absolute;
    border-top: 0.3em solid;
    border-right: .3em solid transparent;
    border-bottom: 0;
    border-left: .3em solid transparent;
}

 @media (max-width: 1440px) {
    .isotope-grid .block2-pic img {
        height:308px !important;
    }
    .card-title-name{
        width: 300px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    aside {
        padding-left: 0px !important;
        grid-template-columns: 265px 1fr;
     }
}


@media (max-width: 1400px) {
    .isotope-grid .block2-pic img {
        height: 295px !important;
    }
    .card-title-name{
        width: 250px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
}

@media (max-width: 1024px) {
    .isotope-grid .block2 {
        padding: 5px !important;
    }
    .isotope-grid .block2-pic img {
        height: 202px !important;
    }
    .card-title-name{
        width: 200px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    aside {
        padding-left: 0px !important;
        grid-template-columns: 265px 1fr;
     }
}

 @media (max-width: 768px) {
     .isotope-grid .block2-pic img {
        height: 119px !important;
    }
    .card-title-name{
        width: 120px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    aside {
        padding-left: 0px !important;
        grid-template-columns: 265px 1fr;
     }
}

 @media (max-width: 425px) {
     .isotope-grid .block2-pic img {
        height: 198px !important;
    }
    .isotope-grid .isotope-item {
        padding: 0 !important;
    }
  aside {
    padding-left: 0px !important;
    grid-template-columns: 100% 1fr;
  }
    #mySidebar{
        position: absolute;
        background-color: #fff;
        z-index: 1000;
        top: 447px;
        width: 100%;
    }
    #filter{
        display: block !important;
    }
    .main-filter{
        display: none !important;
    }

    .card-title-name{
        width: 190px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
}

 @media (max-width: 375px) {
    .isotope-grid .block2-pic img {
        height: 173px !important;
    }
    aside {
    padding-left: 0px !important;
    grid-template-columns: 100% 1fr;
  }
    #mySidebar{
        position: absolute;
        background-color: #fff;
        z-index: 1000;
        top: 447px;
        width: 100%;
    }
    .card-title-name{
        width: 170px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    #filter{
        display: block !important;
    }
    .main-filter{
        display: none !important;
    }
}

 @media (max-width: 320px) {
  .isotope-grid .block2-pic img {
        height:146px !important
    }
    aside {
        padding-left: 0px !important;
        grid-template-columns: 100% 1fr ;
     }
    #mySidebar{
        position: absolute;
        background-color: #fff;
        z-index: 1000;
        top: 447px;
        width: 100%;
    }
    #filter{
        display: block !important;
    }
    .main-filter{
        display: none !important;
    }
    .card-title-name{
        width: 120px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

}


</style>

<aside>
    <div class=" d-md-flex align-items-stretch"  id="mySidebar" style="display: none;">

        <!-- Page Content  -->
        <nav id="sidebar">
                  <div class="p-4 pt-5">

                    <h4 class="main-filter">Filters <i class="fa-solid fa-filter"></i></h4>
            <div class="form__group field">
                <form action="{{route('getSellers')}}" method="GET">
                    <input type="input" class="form__field" placeholder="Name" name="name" id='name' required />
                    <label for="name" class="form__label">search</label>
                    <input type="submit" value="search">
                </form>
            </div>
                      @php
                          $categories = \App\Models\Category::get();
                      @endphp
              <ul class="list-unstyled components mb-5">

              <p style="color: #3797b1;font-size: 20px;">All Categories</p>
              @foreach($categories as $category)
                <li>
                  <a href="#pageSubmenu{{$category->id}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> {{$category->name}}</a>
                  <ul class="collapse list-unstyled" id="pageSubmenu{{$category->id}}">
                      @if($category->subCategories->count() > 0)
                          @foreach($category->subCategories as $sub)
                              <li><a href="{{route('getSuppliersBySubcategory',$sub->id)}}"><span class="fa fa-chevron-right mr-2"></span> {{$sub->name}}</a></li>
                          @endforeach
                      @endif
                  </ul>
                </li>
                @endforeach
              </ul>
            </div>
          </nav>
    </div>



    <section class="bg0 p-t-23 p-b-20" id="main">
        <div class="container">


           <h4 onclick="Filters()" id="filter"  style="display: none;">Filters <i class="fa-solid fa-filter"></i></h4>

                <div class="row isotope-grid">
                    @if($company_dist->count() > 0)
                    @foreach($company_dist as $item)
                        <div class="col-sm-6 col-md-4 col-lg-4 col-6 p-b-35 isotope-item women" style="margin-bottom: 30px;">
                            <div class="block2" style=" width: 100%;   padding:10px 20px; height: auto;   filter: drop-shadow(5px 5px 5px rgba(0,0,0,0.3)); ">
                                <div class="block2-pic hov-img0">
                                    <a href="{{ route('supplier.profile', $item->id) }}">
                                        @if($item->firstMedia)
                                            <img src="{{ asset('images/companies/'.$item->firstMedia->file_name) }}" class="img-fluid w-100"
                                                style="max-width: 100%;  height: 350px ;width: 100% !important;
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: 50% 50%;
                                            border-radius: 7px;" >
                                            @else
                                               <img src="{{ asset('images/no-image.png') }}" alt="{{ $item->name }}" class="img-fluid w-100"
                                               style="max-width: 100%;  height: 350px ;width: 100% !important;
                                               background-size: cover;
                                               background-repeat: no-repeat;
                                               background-position: 50% 50%;
                                               border-radius: 7px;">
                                            @endif
                                    </a>
                                </div>
                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{ route('supplier.profile', $item->id) }}" class="stext-106 cl3 hov-cl1 trans-04 js-name-b2 p-b-6 card-title-name">
                                            {{$item->name}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @else
                        <div class="add-address" style="margin-bottom: 135px">
                            <p class="text-danger alert alert-danger">There are no search results !</p>
                        </div>
                    @endif

            </div>

         </div>

    </section>









    </aside>

    <script>
        function Filters() {
          var x = document.getElementById('mySidebar');

          if (x.style.display === 'none') {
            x.style.display = 'block';


          } else {
            x.style.display = 'none';

          }
        }
    </script>
@stop
