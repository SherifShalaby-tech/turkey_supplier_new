@php
    $config_langs = config('constants.langs');
@endphp



<table class="table hide collapse" id="translation_textarea_table" >

    <tbody>
    @foreach ($config_langs as $key => $lang)
        <tr>
            <td>
                <b>{{ $lang['full_name'] }}</b>
                <textarea @if(auth('company')->user()) maxlength="{{auth('company')->user()->plan->character_count}}"  @endif class="form-control tinymce" name="translations[{{ $attribute }}][{{ $key }}]"  placeholder="{{ $lang['full_name'] }}">
                 @if(!isset($data))
                      {{old('translations.'.$attribute.".".$key)}}
                 @else
                      {{$data->translation[$attribute][$key]??""}}
                 @endif
                </textarea>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
