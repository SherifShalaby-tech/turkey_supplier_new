<style>
    html {
	--scrollbarBG: #acdee5;
	--thumbBG: #2789A4;
  }
  .sidebar::-webkit-scrollbar {
	width: 16px;
  }
  .sidebar{
	scrollbar-width: thin;
	scrollbar-color: var(--thumbBG) var(--scrollbarBG);
  }
  .sidebar::-webkit-scrollbar-track {
	background: var(--scrollbarBG);
  }
  .sidebar::-webkit-scrollbar-thumb {
	background-color: var(--thumbBG) ;
	border-radius: 6px;
	border: 3px solid var(--scrollbarBG);
  }
    .sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 10000;
    top: 0;
    left: 0;
    background-color: #2789A4;
    overflow-x: hidden;
    padding-top: 60px;
    transition: 0.5s;
}
.sidebar-ar{
    right: 0;
}
.sidebar1 {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 10000;
    top: 0;
    left: 0;
    background-color: #2789A4;
    overflow-x: hidden;
    padding-top: 60px;
    transition: 0.5s;
}
.sidebar1-ar{
    right: 0;
}

.sidebar a {
    padding: 8px 8px 8px 20px;
    text-decoration: none;
    font-size: 1rem;
    color: #fff;
    display: block;
    transition: 0.3s;
}
.sidebar1 a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 1rem;
    color: #fff;
    display: block;
    transition: 0.3s;
}
.sidebar a:hover {
    color: #f1f1f1;
}
.sidebar1 a:hover {
    color: #f1f1f1;
}


.sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 26px;
    margin-left: 50px;
}
.sidebar1 .closebtn1 {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 26px;
    margin-left: 50px;
}

.openbtn {
  
    cursor: pointer;
    background-color: #2789A4;
    color: #fff !important;
    padding: 10px 15px;
    border: none;
}
.openbtn1 {
    font-size: 1rem;
    cursor: pointer;
    background-color: #2789A4;
    color: white;
    padding: 10px 15px;
    border: none;
}

#main {
    transition: margin-left 0.5s;
    padding: 20px;
}

</style>

<nav class="limiter-menu-desktop container-fluid">
    @php
        if(app()->getLocale() == 'ar'){
    $cats = App\Models\Category::orderBy('namear')->get(['id', 'name', 'translation']);
    }elseif(app()->getLocale() == 'en'){
        $cats = App\Models\Category::orderBy('nameen')->get(['id', 'name', 'translation']);
    }elseif(app()->getLocale() == 'tr'){
        $cats = App\Models\Category::orderBy('nametr')->get(['id', 'name', 'translation']);
    }else{
        $cats = App\Models\Category::orderBy('name')->get(['id', 'name', 'translation']);
    }
    @endphp

    <!-- Menu desktop -->
    <div class="menu-desktop"  id="main">
        <ul class="main-menu">

            <li style="border-right: #fff 3px solid;">
                <a class="openbtn" onclick="openSidebar()"> <i class="fas fa-align-left"></i>  {{trans('custom.categories')}} </a>
            </li>
            
            <li>
                <a href="{{route('website.index')}}">{{trans('custom.home')}}</a>
            </li>

            <li>
                <a href="{{route('mediation')}}">{{trans('custom.mediation')}}</a>
            </li>

            <li>
                <a href="{{route('translationServices')}}">{{trans('custom.translation_services')}}</a>
            </li>

            <li>
                <a href="{{route('tradeShow')}}">{{trans('tradeshows.tradeshows')}}</a>
            </li>

            <li>
                <a href="{{route('shipping')}}">{{trans('custom.shipping')}}</a>
            </li>

            <li>
                <a href="{{route('membership')}}">{{trans('site.sub')}}</a>
            </li>
            @check_guard
            <li>
                <a href="{{route('webLogin')}}">{{trans('custom.login')}}</a>
            </li>

            <li>
                <a href="{{route('webRegister')}}">{{trans('custom.register')}}</a>
            </li>
            @endcheck_guard
            <li>
                <a href="{{route('about_us')}}">{{trans('custom.about_us')}}</a>
            </li>
        </ul>
    </div>	

    <!-- Icon header -->
</nav>



<div id="mySidebar" class="sidebar @if (app()->getLocale() == 'ar') sidebar-ar @endif">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">  <i class="fas fa-arrow-left"></i></a>
    @if($cats->count() > 0)
    @foreach($cats as $category)
        <div class="flex-sb">
            <a href="{{route('category.products',$category->id)}}"  >{{$category->name}} </a>
            <span class="p-lr-15 cursor-p cl0"  onclick="openSidebarSub({{$category->id}})" class="openbtn1"> <i class="fa-solid fa-caret-right"></i> </span>
        </div>    

        <div id="mySidebarSub{{$category->id}}" class="sidebar1 @if (app()->getLocale() == 'ar') sidebar1-ar @endif">
            <a href="javascript:void(0)" class="closebtn1" onclick="closeSidebarSub({{$category->id}})">  <i class="fas fa-arrow-left"></i> </a>
            @if($category->subCategories->count() > 0)
            @foreach($category->subCategories as $sub)
                <a class="scroll-link1" href="{{route('subcategory.products',$sub->id)}}"> <i class="fa-solid fa-minus"></i> {{$sub->name}}</a>
            @endforeach
            @endif
        </div>
    @endforeach
    @endif
</div>

<script>
const openSidebar = () => {
    document.getElementById("mySidebar").style.width = "300px";
    document.getElementById("main").style.marginLeft = "300px";
};

const closeSidebar = () => {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
};

const openSidebarSub = (category_id) => {
    document.getElementById("mySidebarSub"+category_id).style.width = "300px";
    document.getElementById("main1").style.marginLeft = "300px";
};

const closeSidebarSub = (category_id) => {
    document.getElementById("mySidebarSub"+category_id).style.width = "0";
    document.getElementById("main1").style.marginLeft = "0";
};
</script>