
@if($translationServices->image)
    <img src="{{asset('images/translationservice/'.$translationServices->image)}}" style="width: 100px; height: 100px;"
    alt="{{ $translationServices->name }}" >
@else
    <img src="{{ asset('images/Logo.jpg') }}" style="width: 100px;" alt="{{ $translationServices->name }} ">
@endif



