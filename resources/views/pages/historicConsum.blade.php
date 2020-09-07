<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Històric de consums</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
        <script src="/js/app.js"></script>

        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            var consumsTaula = <?php echo $consumsTaula; ?>

            function drawChart() {

            var data = google.visualization.arrayToDataTable(consumsTaula);

            var options = {
                title: 'Històric de consums',
                curveType: 'function',
                legend: { position: 'right' },
                colors: ['#003f5c', '#7a5195', '#ef5675', '#ffa600']
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
            }
        </script>
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
        <div class="row">
            <div class="col">
                <div id="curve_chart" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
        <div class="row">
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

                            <form class="form-signin" action="{{URL::route('historicConsum.destroy',$item)}}" method="POST">
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
            </table>
        </div>

        <script type="text/javascript">

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



