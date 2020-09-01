<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    <th>Created at</th>
                    <th>Intensitat fase R</th>
                    <th>Intensitat fase S</S></th>
                    <th>Intensitat fase T</th>
                    <th>Potència</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($historic as $item)
                    <tr class="item{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->intensitat_R}}</td>
                        <td>{{$item->intensitat_S}}</td>
                        <td>{{$item->intensitat_T}}</td>
                        <td>{{$item->potencia}}</td>
                        <td>
                            <form>
                                <button href="#" class="btn btn-info edit" data-toggle="modal" data-target="#editModal">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button>
                            </form>
                            <form class="form-signin" action="{{URL::route('historicConsum.destroy',$item)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="delete btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
{{-- Modal per a editar --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{URL::route('historicConsum.update',$item)}}" method="POST" id="modalForm">
                {{ csrf_token() }}
                {{ method_field('PUT') }}
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


