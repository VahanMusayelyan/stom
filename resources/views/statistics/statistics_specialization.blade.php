@extends('layout1')

@section('content')

<div class="container_div">


    <div class="header">Ввод данных Администраторов</div>
    <div class="form-div">
            <form action="/statistics-specialization" method="post" enctype="multipart/form-data">
                @csrf
    <div class="datepicker datepicker1 datepicker-doctor drop_down">
        <div class="ui calendar" id="example7">
            <div class="ui ui1 input left icon">
                <i class="time icon"></i>
                <input type="text" class="first_data" value="<?=$data_first?>" placeholder="Дата" class="data" name='first_data' autocomplete="off">

            </div>
        </div>
    </div>
    <button class="btn btn-primary search-btn">Показать</button>
            </form>
    </div>


    <div class="search-div">

        <input class="search" name="search" placeholder="Поиск">
        <button class="btn btn-primary search-btn">Найти</button>

    </div>

    <div class="table-div">

        <table class="table table-head table1 doctor_stat">
            <thead>
                <tr>
                    <th scope="col">Специализация</th>
                    <th scope="col">Количество первичных консультаций</th>
                    <th scope="col">Количество первичных лечений</th>
                    <th scope="col">Общее количество лечений</th>
                    <th scope="col">Количество рабочих часов на приеме (по графику)</th>
                    <th scope="col">Количество часов, занятых приемом пациентов</th>
                    <th scope="col">Выручка</th>
                    <th scope="col">Количество пациентов в базе</th>
                </tr>
            </thead>
        </table>

        <table class="table table-value table1 spec_stat">
            <tbody>

                @foreach($statistic_specializ as $keyspec => $specialization)

                <tr>
                    <td scope="row" class="color_th">{{$specialization['specialization']}}</td>
                    <td data-col="first_consulting" class="statistic_spec first_consulting_spec"><div class="value">{{number_format($specialization['sum(first_consulting)'],0,","," ")}}</div></td>
                    <td data-col="first_therapy" class="statistic_spec first_therapy_spec"><div class="value">{{number_format($specialization['sum(first_therapy)'],0,","," ")}}</div></td>
                    <td data-col="total_therapy" class="statistic_spec total_therapy_spec"><div class="value">{{number_format($specialization['sum(total_therapy)'],0,","," ")}}</div></td>
                    <td data-col="schedule_time" class="statistic_spec schedule_time_spec"><div class="value">{{number_format($specialization['sum(schedule_time)'],0,","," ")}}</div></td>
                    <td data-col="spent_time" class="statistic_spec spent_time_spec"><div class="value">{{number_format($specialization['sum(spent_time)'],0,","," ")}}</div></td>
                    <td data-col="turnover" class="statistic_spec turnover_spec"><div class="value">{{number_format($specialization['sum(turnover)'],0,","," ")}}</div></td>
                    <td data-col="clients" class="statistic_spec clients_spec"><div class="value">{{number_format($specialization['sum(clients)'],0,","," ")}}</div></td>
                </tr>

                @endforeach
                <tr>
                    <th scope="row" class="color_th">Всего</th>
                    @for($k = 0; $k<7; $k++)
                    <td class="statistic_spec color_th"><div class="value"></div></td>

                    @endfor 

                </tr>

            </tbody>
        </table>
    </div>
</div>


@endsection