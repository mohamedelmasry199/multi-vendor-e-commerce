

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('hello') }}</title>
</head>
<body>
    <h1>{{ __('hello') }}</h1>

    {{-- <a href="{{ route('change.language', ['locale' => 'en']) }}">English</a>
    <a href="{{ route('change.language', ['locale' => 'ar']) }}">العربية</a> --}}
    <a href="{{ url('lang/en') }}">English</a>
<a href="{{ url('lang/ar') }}">عربي</a>
</body>
</html>
