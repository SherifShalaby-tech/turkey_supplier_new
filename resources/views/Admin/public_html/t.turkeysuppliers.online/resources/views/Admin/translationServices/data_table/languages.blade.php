
@if($translationServices->language =='ar')
    <h4>{{__('translationServices.arabic')}}</h4>
@elseif($translationServices->language =='en')
    <h4>{{__('translationServices.english')}}</h4>
@elseif($translationServices->language =='fr')
    <h4>{{__('translationServices.french')}}</h4>
@elseif($translationServices->language =='tr')
    <h4>{{__('translationServices.turkey')}}</h4>
@else
   <h4>{{__('translationServices.arabic')}}</h4>
@endif
