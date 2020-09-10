@extends('layout1')

@section('content')

<div class="container_div">


    <div class="header">Реферанс Врачей</div>
    <div class="form-group specializ-div">

        <select class="form-control selectpicker" id="sel1" name="specialization">
            <option value="" disabled selected>Специализации</option>
            @foreach($specializations as $key => $value)
            <option value="<?= $value->id ?>"><?= $value->specialization ?></option>
            @endforeach
        </select>

    </div>


    <div class="search-div reference-admin">

        <input class="search" name="search" placeholder="Поиск">
        <button class="btn btn-primary search-btn">Найти</button>

    </div>



    <div class="table-div table-div-doctor reference_doctor">

        <table class="table table-head table1">
            <thead>
                <tr>
                    <th scope="row" class="color_th">SPECIALIZATION</th>
                    <th scope="row" class="color_th">Level</th>
                    <th scope="row" class="color_th">Conversion 1</th>
                    <th scope="row" class="color_th">Repetition rate</th>
                    <th scope="row" class="color_th">Consultation Turnover</th>
                    <th scope="row" class="color_th">Workload</th>
                    <th scope="row" class="color_th">Avarage per hour</th>
                    <th scope="row" class="color_th">Avarage of 1 visit</th>
                </tr>
            </thead>
        </table>

        <table class="table table-value table1 reference_doctor">
            @csrf
            <tbody>


                @foreach($reference_doctor as $key => $value)
                <tr data-number="{{$reference_doctor[0]->id}}" >
                    <td rowspan="2" class="color_th">{{$value->specialization}}</td>
                    <td class="color_th">Normal</td>
                    <td class="reference conversion_normal"><div class="value"><span>{{$reference_doctor[0]->conversion_normal}}</span><span class="property">%</span></div></td>
                    <td class="reference repetition_rate_normal"><div class="value"><span>{{$reference_doctor[0]->repetition_rate_normal}}</span><span class="property">%</span></div></td>
                    <td class="reference turnover_normal"><div class="value"><span>{{$reference_doctor[0]->turnover_normal}}</span><span class="property"> RUR</span></div></td>
                    <td class="reference workload_normal"><div class="value"><span>{{$reference_doctor[0]->workload_normal}}</span><span class="property">%</span></div></td>
                    <td class="reference avarage_hour_normal"><div class="value"><span>{{$reference_doctor[0]->avarage_hour_normal}}</span><span class="property"> RUR</span></div></td>
                    <td class="reference avarage_visit_normal"><div class="value"><span>{{$reference_doctor[0]->avarage_visit_normal}}</span><span class="property"> RUR</span></div></td>


                </tr>
                <tr data-number="{{$reference_doctor[0]->id}}" >
                    <td class="color_th">Good</td>
                    <td  class="reference conversion_good"><div class="value"><span>{{$reference_doctor[0]->conversion_good}}</span><span class="property">%</span></div></td>
                    <td class="reference repetition_rate_good"><div class="value"><span>{{$reference_doctor[0]->repetition_rate_good}}</span><span class="property">%</span></div></td>
                    <td class="reference turnover_good"><div class="value"><span>{{$reference_doctor[0]->turnover_good}}</span><span class="property"> RUR</span></div></td>
                    <td class="reference workload_good"><div class="value"><span>{{$reference_doctor[0]->workload_good}}</span><span class="property">%</span></div></td>
                    <td class="reference avarage_hour_good"><div class="value"><span>{{$reference_doctor[0]->avarage_hour_good}}</span><span class="property"> RUR</span></div></td>
                    <td class="reference avarage_visit_good"><div class="value"><span>{{$reference_doctor[0]->avarage_visit_good}}</span><span class="property"> RUR</span></div></td>


                </tr>

                @endforeach




            </tbody>
        </table>



    </div>
</div>


@endsection