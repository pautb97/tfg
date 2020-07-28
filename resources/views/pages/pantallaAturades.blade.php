<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <title>Inici</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body class="text-center">
        <div class="btn-group-vertical">
            <form class="form-signin" action="{{URL::route('acabaAturades')}}">
                    @foreach ($llistaAturades as $llistaAturada)
                        <button type="submit" class="btn btn-secondary btn-lg btn-block" name="botoAturades" value="{{$llistaAturada->causa}}">{{ $llistaAturada->causa }}</button>
                    @endforeach
                    @foreach ($llistaAturadesTotals as $llistaAturadaTotal)
                        <button type="submit" class="btn btn-danger btn-lg btn-block" name="botoAturades" value="{{$llistaAturadaTotal->causa}}">{{ $llistaAturadaTotal->causa }}</button>
                    @endforeach
            </form>
        </div>
    </body>
</html>


