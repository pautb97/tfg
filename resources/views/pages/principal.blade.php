<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Principal</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    {{-- Gràfiques OEE, Disponibilitat, Rendiment, Qualitat --}}
    {{-- GAUGE CHARTS --}}
    {{-- DISPONIBILITAT GAUGE CHART --}}
        <script type="text/javascript">
            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

            var disponibilitat = <?php echo $disponibilitat; ?>

            var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Disponibilitat', disponibilitat]
            ]);

            var options = {
            width:'auto', height:'auto',
            greenColor: '#1D8348', greenFrom: 60, greenTo: 100,
            yellowColor: '#F1C40F ', yellowFrom:40, yellowTo: 60,
            redColor: '#C70039', redFrom:0, redTo: 40,
            minorTicks: 5
            };

            var chart = new google.visualization.Gauge(document.getElementById('disponibilitat'));

            chart.draw(data, options);
            }
        </script>

        {{-- RENDIMENT GAUGE CHART --}}

        <script type="text/javascript">
            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

            var rendiment = <?php echo $rendiment; ?>

            var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['rendiment', rendiment]
            ]);

            var options = {
            width:'auto', height:'auto',
            greenColor: '#1D8348', greenFrom: 60, greenTo: 100,
            yellowColor: '#F1C40F ', yellowFrom:40, yellowTo: 60,
            redColor: '#C70039', redFrom:0, redTo: 40,
            minorTicks: 5
            };

            var chart = new google.visualization.Gauge(document.getElementById('rendiment'));

            chart.draw(data, options);
            }
        </script>

        {{-- QUALITAT GAUGE CHART --}}

        <script type="text/javascript">
            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

            var qualitat = <?php echo $qualitat; ?>

            var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['qualitat', qualitat]
            ]);

            var options = {
            width:'auto', height:'auto',
            greenColor: '#1D8348', greenFrom: 60, greenTo: 100,
            yellowColor: '#F1C40F ', yellowFrom:40, yellowTo: 60,
            redColor: '#C70039', redFrom:0, redTo: 40,
            minorTicks: 5
            };

            var chart = new google.visualization.Gauge(document.getElementById('qualitat'));

            chart.draw(data, options);
            }
        </script>

        {{-- OEE GAUGE CHART --}}

        <script type="text/javascript">
            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

            var disponibilitat = <?php echo $disponibilitat; ?>

            var rendiment = <?php echo $rendiment; ?>

            var qualitat = <?php echo $qualitat; ?>

            var oee = (disponibilitat/100)*(rendiment/100)*(qualitat/100)*100

            var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['oee', oee]
            ]);

            var options = {
            width:'auto', height:'auto',
            greenColor: '#1D8348', greenFrom: 60, greenTo: 100,
            yellowColor: '#F1C40F ', yellowFrom:40, yellowTo: 60,
            redColor: '#C70039', redFrom:0, redTo: 40,
            minorTicks: 5
            };

            var chart = new google.visualization.Gauge(document.getElementById('oee'));

            chart.draw(data, options);
            }
        </script>

        {{-- PIE CHART 1 --}}

        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var pie1 = <?php echo $temps; ?>

                var data = google.visualization.arrayToDataTable(pie1);

            var options = {
                title: 'My Daily Activities',
                is3D: true,
                chartArea:{left:0,top:10,width:'100%',height:'100%'},
                legend:{position: 'right', textStyle: {color: 'black', fontSize: 14}},
                colors: ['#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600','#003f5c', '#2f4b7c', '#665191', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
            }

        </script>

        {{-- PIE CHART 2 --}}

        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

            var pie2 = <?php echo $qualitats; ?>


            var data = google.visualization.arrayToDataTable(pie2);

            var options = {
                title: 'My Daily Activities',
                is3D: true,
                chartArea:{left:0,top:10,width:'100%',height:'100%'},
                colors: ['#ffa600', '#bc5090', '#003f5c', '#a05195', '#d45087', '#f95d6a', '#ff7c43', '#ffa600'],
                legend:{position: 'right', textStyle: {color: 'black', fontSize: 14}}
            };


            var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

            chart.draw(data, options);
            }
        </script>

        {{-- GRAFIC DE LÍNIES--}}

        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            var taulaIndexs = <?php echo $indexsTaula; ?>

            function drawChart() {

            var data = google.visualization.arrayToDataTable(taulaIndexs);

            var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'right' },
                colors: ['#003f5c', '#7a5195', '#ef5675', '#ffa600']
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
            }
        </script>
        <script src="/js/app.js"></script>
    </head>
    <body>
{{--BARRA DE NAVEGACIÓ--}}
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="navbar-collapse collapse order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href={{URL::route('historicIndex.index')}}>Històric OEE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{URL::route('historicOrdre.index')}}>Històric Ordres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{URL::route('historicConsum.index')}}>Històric Consums</a> {{--Actualitzar ruta--}}
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="navbar-brand" href="#">Potència actual:</a>
                    </li>
                    <li class="nav-item active">
                        <a class="navbar-brand" href="#">{{$consum}} W</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <div class="row d-flex justify-content-center">
                        <div id="oee" style="width: 170px; height: 170px;"></div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div id="disponibilitat" style="width: 170px; height: 170px;"></div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div id="rendiment" style="width: 170px; height: 170px;"></div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div id="qualitat" style="width: 170px; height: 170px;"></div>
                    </div>
            </div>

                <div class="col-10">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2">{{$descripcio}}</h2>
                        <div class="btn-toolbar mb-2 mb-md-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h2 style="text-align: center;">Temps disponible<h2>
                            <div id="piechart" style="width: 538px; height: 190px;"></div>
                        </div>
                        <div class="col-6">
                            <h2 style="text-align: center;">Qualitat<h2>
                            <div id="piechart2" style="width: 538px; height: 190px;"></div>
                            <form action="{{URL::route('defectuoses')}}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button for="inputQuantitatDefectuoses" class="btn btn-outline-secondary" type="submit">Desa</button>
                                </div>
                                <input type="number" id="inputQuantitatDefectuoses" name="inputQuantitatDefectuoses" class="form-control" placeholder="Quantitat d'unitats defectuoses" aria-describedby="basic-addon1" >
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h2 style="text-align: center;">Històric<h2>
                            <div id="curve_chart" style="width: 100%; height: auto;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if ($activaBoto == 0)
                                <form action="{{URL::route('repren')}}">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Comença</button>
                                </form>
                            @else
                                <form action="{{URL::route('pantallaAturades')}}">
                                    <button type="submit" class="btn btn-danger btn-lg btn-block">Atura</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{URL::route('repren')}}" id="modalForm">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Reprèn</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        {{-- Aquest script activa el modal amb el botó reprendre quan activaBoto = 2 --}}
        <script type="text/javascript">

            var activaBoto = <?php echo $activaBoto; ?>

            if(activaBoto == 2){
                $('#myModal').modal({backdrop: 'static', keyboard: false});
                $('#myModal').modal('show');
            };

        </script>
    </body>
</html>
