<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel</title>
        <<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
        <script src="/js/app.js"></script>

    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="navbar-collapse collapse order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{URL::route('principal')}}"><b>Pantalla Principal</b></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <table class="table" id="table_id">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Ordre</th>
                    <th>Created at</th>
                    <th>Index de disponibilitat</th>
                    <th>Index de rendiment</th>
                    <th>Index de qualitat</th>
                    <th>Index OEE</th>
                    <th>Unitats defectuoses</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($historic as $item)
                    <tr class="item{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->ID_ordre}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->index_disponibilitat}}</td>
                        <td>{{$item->index_rendiment}}</td>
                        <td>{{$item->index_qualitat}}</td>
                        <td>{{$item->index_oee}}</td>
                        <td>{{$item->unitats_defectuoses}}</td>
                        <td>
                            <form class="form-signin" action="{{URL::route('historicIndex.destroy',$item)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="delete btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
            });
        </script>
    </body>
</html>



