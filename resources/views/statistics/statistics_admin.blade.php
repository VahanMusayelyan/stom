@extends('layout1')

@section('content')

<div class="container_div">
    
   @if (!empty($message_result))
    <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>	
            <h4><strong>{{ $message_result }}</strong></h4>
    </div>
   @endif 
   

    @if($employee_admin)
    <div class="header">Ввод данных Администраторов</div>
    <form action="/statistics-admin" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-div">

            <div class="datepicker datepicker1 datepicker-doctor drop_down">
                <div class="ui calendar" id="example8">
                    <div class="ui ui1 input left icon">
                        <i class="time icon"></i>
                        <input type="text" class="first_data data admin_data" value="<?= $data_first ?>" placeholder="Дата" class="" name='first_data' autocomplete="off">

                    </div>
                </div>
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

    <div class="table-div table-div-admin">
        <form action="/statistics-admin-add" method="post" enctype="multipart/form-data">
            <table class="table table-head table1 admin_stat">
                <thead>
                    <tr>
                        <th scope="col">Имя Фамилия</th>
                        <th scope="col">Количество принятых звонков от первичных пациентов<br>(пациенты)</th>
                        <th scope="col">Количество записавшихся на консультацию первичных пациентов<br>(пациенты)</th>
                        <th scope="col">Количество пришедших на консультацию первичных пациентов<br>(пациенты)</th>
                    </tr>
                </thead>
            </table>

            <table class="table table-value table1 admin_stat">
                @csrf
                <tbody>
                    @if(count($statistic_admin)<1 && count($employee_admin)>0)
                    @foreach($employee_admin as $key => $value) 
                   
                    <tr>
                        <td  scope="row" class="color_th">
                            {{$value->employee_name}} <input hidden="hidden" name="colum_number[]" value="{{$value->employee_id}}">
                        </td>
                        <td class="statistic first_patient">
                            <div class="value"><input name="first_patient[]" class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                        <td class="statistic recorded_patient">
                            <div class="value"><input name="recorded_patient[]" class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                        <td class="statistic final_patient">
                            <div class="value"><input name="final_patient[]" class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                    </tr>

                    @endforeach
                    <tr>
                        <td scope="row" class="color_th">Всего</td>
                        @for($i = 0; $i<3; $i++)
                        <td class="color_th"><div class="value"></div></td>

                        @endfor    
                    </tr>

                    @else

                    @foreach($employee_admin as $keyemp => $empoyeevalue)


                    @if(isset($statistic_admin[$empoyeevalue->id]))
                    
                    <tr>
                        <td scope="row" class="color_th">
                            {{$empoyeevalue->employee_name}} <input hidden="hidden" name="colum_number[]" value="{{$empoyeevalue->employee_id}}">
                        </td>
                        @if($statistic_admin[$empoyeevalue->id]->first_patient !== null)
                        <td class="statistic first_patient">
                            <div class="value">
                                <input name="first_patient[]" class="change_value change_value_doctor" value="{{number_format($statistic_admin[$empoyeevalue->id]->first_patient,0,","," ")}}" autocomplete="off">
                            </div>
                        </td>
                        @else
                        <td class="statistic first_patient">
                            <div class="value"><input name="first_patient[]" class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                        @endif

                        @if($statistic_admin[$empoyeevalue->id]->recorded_patient !== null)
                        <td class="statistic recorded_patient">
                            <div class="value">
                                <input name="recorded_patient[]" class="change_value change_value_doctor" value="{{number_format($statistic_admin[$empoyeevalue->id]->recorded_patient,0,","," ")}}">
                            </div></td>
                        @else
                        <td class="statistic recorded_patient">
                            <div class="value"><input name="recorded_patient[]" class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                        @endif

                        @if($statistic_admin[$empoyeevalue->id]->final_patient !== null)
                        <td class="statistic final_patient">
                            <div class="value">
                                <input name="final_patient[]" class="change_value change_value_doctor" value="{{number_format($statistic_admin[$empoyeevalue->id]->final_patient,0,","," ")}}">
                            </div>
                        </td>
                        @else
                        <td class="statistic final_patient">
                            <div class="value"><input name="final_patient[]" class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                        @endif


                    </tr>
                    @else
                    <tr>
                        <td scope="row" class="color_th">
                            {{$empoyeevalue->employee_name}}<input hidden="hidden" name="colum_number[]" value="{{$empoyeevalue->employee_id}}"></td>
                        <td class="statistic first_patient">
                            <div class="value"><input name="first_patient[]" class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                        <td class="statistic recorded_patient">
                            <div class="value"><input name="recorded_patient[]"  class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                        <td class="statistic final_patient">
                            <div class="value"><input name="final_patient[]"  class="change_value change_value_doctor" value="" autocomplete="off"></div>
                        </td>
                    </tr>

                    @endif


                    @endforeach
                    <tr>
                        <td scope="row" class="color_th">Всего</td>
                        @for($i = 0; $i<3; $i++)
                        <td class="color_th"><div class="value"></div></td>

                        @endfor    
                    </tr>

                    @endif

                </tbody>
            </table>
            <div class="add_cancel_buttons">
                <input value="" id="data_dirst_input" class="post_first_data" name="first_data" hidden>
                <button class="add_admin_stat" type="submit">Сохранить</button> 
                <button type="button" class="cancel_admin_stat" name="cancel-admin-stat">Отменить</button>
            </div>
        </form>

    </div>    
    @else
    <div class="no-personal"> <h3>В клинике {{session()->get('org_name')}} нет зарегистрированных администраторов, пожалуйста <a href="/employees/administrators">добавьте</a></h3></div>

    @endif
</div>


@endsection