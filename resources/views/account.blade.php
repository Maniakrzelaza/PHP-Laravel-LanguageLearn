@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table align="center" class="">
                            <tr>
                                <th width="21%">Kategoria</th>
                                <th width="21%">Podkategoria</th>
                                <th width="21%">Nazwa zestawu</th>
                                <th width="21%">Sredni wynik</th>
                                <th width="21%">Ilość podejść</th>
                            </tr>
                            @foreach($results as $key=>$result)
                                <tr class="accRow">
                                    <td>{{$result->subcategory->category->name}}</td>
                                    <td>{{$result->subcategory->name}}</td>
                                    <td>{{$result->name}}</td>
                                    <td>{{$sums[$key]}}</td>
                                    <td>{{$count[$key]}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>


                    <?php
                    $dataPoints= array();
                    foreach($results as $key=>$result)
                        {
                            $dataPoints[$key]=array("label"=> $result->name, "y"=> $count[$key]);
                        }


                    ?>
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    tr:nth-child(odd) {
        background-color: #f2f2f2
    }
    .accRow{
        transition: background-color 0.5s ease;
    }
    .accRow:hover{
        background-color: #005cbf;
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
                text: "Ilość podejść do danego zestawu"
            },
            subtitles: [{
                text: ""
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>