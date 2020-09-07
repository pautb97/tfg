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
                            <button type="button" class="edit btn btn-primary" data-toggle="modal" data-target="#editModal">Editar </button>
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

        {{-- Modal per a editar --}}
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Editar línia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{URL::route('ordres.update',$item)}}" method="POST" id="modalForm">
                        {{ method_field('POST') }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="unitats_produir">Unitats a produir</label>
                                <input type="text" name="unitats_produir" id="unitats_produir" class="form-control" placeholder="Editar unitats a produir">
                            </div>
                            <div class="form-group">
                                <label for="unitats_produides">Unitats produides</label>
                                <input type="text" name="unitats_produides" id="unitats_produides" class="form-control" placeholder="Editar unitats produides">
                            </div>
                            <div class="form-group">
                                <label for="unitats_defectuoses">Unitats defectuoses</label>
                                <input type="text" name="unitats_defectuoses" id="unitats_defectuoses" class="form-control" placeholder="Editar unitats defectuoses">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveModalButton" data-dismiss="modal">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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



