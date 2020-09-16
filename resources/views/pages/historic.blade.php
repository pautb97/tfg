<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Historic ordres</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
        <script src="/js/app.js"></script>

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
                    <th>ID article</th>
                    <th>Created at</th>
                    <th>Unitats produir</th>
                    <th>Unitats produides</th>
                    <th>Frequencia produccio</th>
                    <th>Unitats defectuoses</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($historic as $item)
                    <tr class="item{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->ID_article}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->unitats_produir}}</td>
                        <td>{{$item->unitats_produides}}</td>
                        <td>{{$item->frequencia_produccio}}</td>
                        <td>{{$item->unitats_defectuoses}}</td>
                        <td>

                                <form class="form-signin" action="{{URL::route('ordres.destroy',$item)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="delete btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </div>
        </table>

        <script>
            $(document).ready( function () {
                var table = $('#table_id').DataTable();

                table.on('click','.edit',function(){
                    $tr = $(this).closest('tr');
                    if ($($tr).hasClass('child')){
                        $tr = $tr.prev('.parent');
                    }

                var data = table.row($tr).data();

                $('#unitats_produir').val(data[5]);
                $('#unitats_produides').val(data[6]);
                $('#unitats_defectuoses').val(data[8]);


                });
            });

        </script>
    </body>
</html>



