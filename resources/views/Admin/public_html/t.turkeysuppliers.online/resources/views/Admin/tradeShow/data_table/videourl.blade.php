
{{-- {{__('site.change')}} --}}
<a href="{{ $tradeShow->videourl }}"  target="_blank">
    {{  __('tradShow.videourl') }}
    <iframe class="ml-4" width="350" height="150" src="{{ $tradeShow->videourl }}"
        frameborder="0" allow="autoplay; encrypted-media;" allowfullscreen>
    </iframe>
</a>
