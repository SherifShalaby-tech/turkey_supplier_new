<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('email.welcomesms') }}</title>
</head>

<body>

    <h1>{{ __('email.happysms') }}</h1>

    <h1>{{ __('email.hellosms') }}</h1>
    <h1>{{ $contact_supplier->message }}</h1>
    <h3>{!! $contact_supplier->subject!!}</h3>
    {{-- @if ($contact_supplier->file ) --}}
    {{-- <embed src="{{url('/Attachments/'.$contact_supplier->file)}}" style="width:900px; height:800px;" frameborder="0"> --}}
        {{-- <img src="{{url('/Attachments/'.$contact_supplier->file)}}" alt=""> --}}
    {{-- @endif --}}
    <br>
    <br>

    <div>
        {{ __('email.sitelink') }}: turkeysuppliers.online
    </div>

    <div>
        {{ __('email.sitephone') }} :+905441564510
    </div>

</body>

</html>
