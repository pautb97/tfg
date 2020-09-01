<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <title>Inici</title>
    </head>

    <body class="text-center">
        <div class="jumbotron vertical-center">
            <div class="container">
                <form class="form-signin" action="{{URL::route('inserta')}}" method="POST">
                    @csrf
                    <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <h1 class="h3 mb-3 font-weight-normal">Insereixi l'article i la quantitat</h1>
                    <label for="inputRef" class="sr-only">Referència d'article</label>
                    <input type="number" id="inputRef" name="inputRef" class="form-control" placeholder="Referència d'article">
                    <label for="inputQuantitat" class="sr-only">Quantitat a produïr</label>
                    <input type="number" id="inputQuantitat" name="inputQuantitat" class="form-control" placeholder="Quantitat">
                    <div class="checkbox mb-3"></div>
                    <button  class="btn btn-lg btn-primary btn-block" type="submit">Començar </button>
                </form>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>


