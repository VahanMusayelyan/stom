@extends('layout1')

@section('content')

<div class="container_div">
    @if(!empty($message_result))
    <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>	
            <h4><strong>{{ $message_result }}</strong></h4>
    </div>
    @endif

    @if($employee_doctor)

    <div class="header">Ввод данных Врачей</div>
    <form action="/statistics-doctor" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-div">
            <div class="datepicker datepicker1 datepicker-doctor drop_down">
                <div class="ui calendar" id="example7">
                    <div class="ui ui1 input left icon">
                        <i class="time icon"></i>
                        <input type="text" class="first_data" value="<?= $data_first ?>" placeholder="Дата" class="data" name='first_data' autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group specializ-div">

                <select class="form-control selectpicker" id="sel1" name="specialization">
                    <option value="" selected> Все специализации</option>
                    @foreach($specialization as $key => $value)
                    @if($value->id !=1)
                    @if($specializ_id == $value->id)
                    <option value="<?= $value->id ?>" selected="selected"><?= $value->specialization ?></option>
                    @else
                    <option value="<?= $value->id ?>"><?= $value->specialization ?></option>
                    @endif
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="search-div">

            <input class="search" name="search" value="{{$search}}" placeholder="Поиск" autocomplete="off">
            <button class="btn btn-primary search-btn">Найти</button>
            @if($messege)
            <div class="result_search"><h5>{{$messege}}</h5></div>
            @endif
        </div>
    </form>
    <div class="table-div">
        <form action="/statistics-doctor-add" method="post" enctype="multipart/form-data">
            <table class="table table-head table1 doctor_stat">
                <thead>
                    <tr>
                        <th scope="col">Имя Фамилия</th>
                        <th scope="col">Количество первичных консультаций <br>(пациенты)</th>
                        <th scope="col">Количество первичных лечений <br>(пациенты)</th>
                        <th scope="col">Общее количество лечений <br>(пациенты)</th>
                        <th scope="col">Количество рабочих часов на приеме <br>(по графику, часы)</th>
                        <th scope="col">Количество часов, занятых приемом пациентов <br>(часы)</th>
                        <th scope="col">Выручка <br>(РУБ)</th>
                        <th scope="col">Количество пациентов в базе <br>(пациенты)</th>
                        <th scope="col">Специализация</th>
                    </tr>
                </thead>
            </table>


            <table class="table table-value table1 doctor_stat">
                @csrf
                <tbody>

                    @if(count($statistic_doc)<1 && count($employee_doctor)>0)


                    @foreach($employee_doctor as $key => $value) 
                        
                    <tr>

                        <td>{{$value->employee_name}}<input hidden="hidden" name="colum_number[]" value="{{$value->employee_id}}"><input hidden="hidden" name="specializ[]" value="{{$value->specializ_id}}"></td>
                        <td class="statistic_doc first_consulting"><div class="value"><input name="first_consulting[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc first_therapy"><div class="value"><input name="first_therapy[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc total_therapy"><div class="value"><input name="total_therapy[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc schedule_time"><div class="value"><input name="schedule_time[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc spent_time"><div class="value"><input name="spent_time[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc turnover"><div class="value"><input name="turnover[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc clients"><div class="value"><input name="clients[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="specializ">{{$value->specialization}}</td>
                    </tr>

                    @endforeach
                    <tr>
                        <td scope="row" class="color_th">Всего</td>
                        @for($k = 0; $k<7; $k++)
                        <td class="color_th"><div class="value"></div></td>

                        @endfor 
                        <td class="color_th">--------------------</td>
                    </tr>

                    @else


                    @foreach($employee_doctor as $keyemp => $empoyeevalue)
                        

                    @if(isset($statistic_doc[$empoyeevalue->id]))

                    <tr>

                        <td>{{$empoyeevalue->employee_name}}<input hidden="hidden" name="colum_number[]" value="{{$empoyeevalue->employee_id}}"><input hidden="hidden" name="specializ[]" value="{{$empoyeevalue->specializ_id}}"></td>

                        @if($statistic_doc[$empoyeevalue->id]->first_consulting !== null)
                        <td class="statistic_doc first_consulting">
                            <div class="value">
                                <input name="first_consulting[]" class="change_value change_value_doctor" value="{{number_format($statistic_doc[$empoyeevalue->id]->first_consulting,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic_doc first_consulting"><div class="value"><input name="first_consulting[]" class="change_value change_value_doctor" value=""></div></td>
                        @endif

                        @if($statistic_doc[$empoyeevalue->id]->first_therapy !== null)
                        <td class="statistic_doc first_therapy">
                            <div class="value">
                                <input name="first_therapy[]" class="change_value change_value_doctor" value="{{number_format($statistic_doc[$empoyeevalue->id]->first_therapy,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic_doc first_therapy"><div class="value"><input name="first_therapy[]" class="change_value change_value_doctor" value=""></div></td>
                        @endif

                        @if($statistic_doc[$empoyeevalue->id]->total_therapy !== null)
                        <td class="statistic_doc total_therapy">
                            <div class="value">
                                <input name="total_therapy[]" class="change_value change_value_doctor" value="{{number_format($statistic_doc[$empoyeevalue->id]->total_therapy,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic_doc total_therapy"><div class="value"><input name="total_therapy[]" class="change_value change_value_doctor" value=""></div></td>
                        @endif

                        @if($statistic_doc[$empoyeevalue->id]->schedule_time !== null)
                        <td class="statistic_doc schedule_time">
                            <div class="value">
                                <input name="schedule_time[]" class="change_value change_value_doctor" value="{{number_format($statistic_doc[$empoyeevalue->id]->schedule_time,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic_doc schedule_time"><div class="value"><input name="schedule_time[]" class="change_value change_value_doctor" value=""></div></td>
                        @endif

                        @if($statistic_doc[$empoyeevalue->id]->spent_time !== null)
                        <td class="statistic_doc spent_time">
                            <div class="value">
                                <input name="spent_time[]" class="change_value change_value_doctor" value="{{number_format($statistic_doc[$empoyeevalue->id]->spent_time,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic_doc spent_time"><div class="value"><input name="spent_time[]" class="change_value change_value_doctor" value=""></div></td>
                        @endif

                        @if($statistic_doc[$empoyeevalue->id]->turnover !== null)
                        <td class="statistic_doc turnover">
                            <div class="value">
                                <input name="turnover[]" class="change_value change_value_doctor" value="{{number_format($statistic_doc[$empoyeevalue->id]->turnover,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic_doc turnover"><div class="value"><input name="turnover[]" class="change_value change_value_doctor" value=""></div></td>
                        @endif

                        @if($statistic_doc[$empoyeevalue->id]->clients !== null)
                        <td class="statistic_doc clients">
                            <div class="value">
                                <input name="clients[]" class="change_value change_value_doctor" value="{{number_format($statistic_doc[$empoyeevalue->id]->clients,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic_doc clients"><div class="value"><input name="clients[]" class="change_value change_value_doctor" value=""></div></td>
                        @endif
                        <td class="specializ">{{$statistic_doc[$empoyeevalue->id]->specialization}}</td>
                    </tr>
                    @else

                    <tr>

                        <td scope="row" class="color_th">{{$empoyeevalue->employee_name}} <input hidden="hidden" name="colum_number[]" value="{{$empoyeevalue->employee_id}}"><input hidden="hidden" name="specializ[]" value="{{$empoyeevalue->specializ_id}}"></td>
                        <td class="statistic_doc first_consulting"><div class="value"><input name="first_consulting[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc first_therapy"><div class="value"><input name="first_therapy[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc total_therapy"><div class="value"><input name="total_therapy[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc schedule_time"><div class="value"><input name="schedule_time[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc spent_time"><div class="value"><input name="spent_time[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc turnover"><div class="value"><input name="turnover[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="statistic_doc clients"><div class="value"><input name="clients[]" class="change_value change_value_doctor" value="" autocomplete="off"></div></td>
                        <td class="specializ">{{$empoyeevalue->specialization}}</td>
                    </tr>

                    @endif


                    @endforeach
                    <tr class="total">
                        <td scope="row" class="color_th">Всего</td>
                        @for($j = 0; $j<7; $j++)
                        <td class="color_th"><div class="value"></div></td>
                        @endfor 
                        <td class="color_th">-----------------</td>
                    </tr>

                    @endif
                </tbody>
            </table>

            
            <div class="add_cancel_buttons">
                <input value="" id="data_dirst_input_doc" class="post_first_data" name="first_data" hidden>
                <input value="" id="specializ" class="post_specializ" name="specialization" hidden>
                <button class="add_admin_stat" type="submit">Сохранить</button> 
                <button type="button" class="cancel_admin_stat" name="cancel-admin-stat">Отменить</button>
            </div>
        </form>

    </div>

    @else
    <div class="no-personal"> <h3>В клинике {{session()->get('org_name')}} нет зарегистрированных врачей, пожалуйста <a href="/employees/doctors">добавьте</a></h3></div>
    @endif


</div>



@endsection