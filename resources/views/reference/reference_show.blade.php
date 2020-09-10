@extends('layout1')

@section('content')

<div class="container_div">

    <div class="header">Реферанс</div>
    <div class="form-group reference-div">
        <form action="/reference-list" method="post" enctype="multipart/form-data">
            @csrf
            <select class="form-control selectpicker select-for-reference" id="sel1" name="city">
                <option value="" disabled selected>Город</option>
                @foreach($cities as $key => $value)
                @if($value->id == $city)
                <option value="<?= $value->id ?>" selected="selected"><?= $value->city ?></option>
                @else
                <option value="<?= $value->id ?>"><?= $value->city ?></option>
                @endif
                @endforeach
            </select>
            <select class="form-control selectpicker select-for-reference" id="sel11" name="class">
                <option value="" disabled selected>Класс</option>
                @foreach($classes as $key => $value)
                @if($value->id == $class)
                <option value="<?= $value->id ?>" selected="selected"><?= $value->class_name ?></option>
                @else
                <option value="<?= $value->id ?>"><?= $value->class_name ?></option>
                @endif
                @endforeach
            </select>

            <button class="btn btn-primary search-btn">Показать</button>
        </form>
    </div>


    <div class="table-div table-div-doctor reference_doctor">

        <table class="table table-head table1">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Доктора</th>
                    <th scope="row" class="color_th">Уровень</th>
                    <th scope="row" class="color_th">Конверсия</th>
                    <th scope="row" class="color_th">Показатель повторности</th>
                    <th scope="row" class="color_th">Выручка на консультацию</th>
                    <th scope="row" class="color_th">Загруженность 1</th>
                    <th scope="row" class="color_th">Средняя стоимость часа работы</th>
                    <th scope="row" class="color_th">Средняя стоимость 1 посещения</th>
                </tr>
            </thead>
        </table>

        <table class="table table-value table1 reference_doctor">
            @csrf
            <tbody>

                @foreach($specializations as $key => $value)
                <?php
                if (isset($value['reference_id'])) {
                    $value['reference_id'] = "number_" . $value['reference_id'];
                }
                ?>
                @if($value['id'] != 1)
                @if(count($value)>5)

                <tr class="parent_{{$key}}"  data-number="{{$value['reference_id']}}" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}" >
                    <td rowspan="2" class="color_th">{{$value['specialization']}}</td>
                    <td class="color_th">Среднее</td>
                    <td class="reference conversion_normal"><div class="value"><input class="change_value change_value_doctor" value="{{$value['conversion_normal']}}"><span class="property">%</span></div></td>
                    <td class="reference repetition_rate_normal"><div class="value"><input class="change_value change_value_doctor" value="{{$value['repetition_rate_normal']}}"><span class="property"></span></div></td>
                    <td class="reference turnover_normal"><div class="value"><input class="change_value change_value_doctor" value="{{number_format($value['turnover_normal'], 0, ',', ' ')}}"><span class="property"> RUR</span></div></td>
                    <td class="reference workload_normal"><div class="value"><input class="change_value change_value_doctor" value="{{$value['workload_normal']}}"><span class="property">%</span></div></td>
                    <td class="reference avarage_hour_normal"><div class="value"><input class="change_value change_value_doctor" value="{{number_format($value['avarage_hour_normal'], 0, ',', ' ')}}"><span class="property"> RUR</span></div></td>
                    <td class="reference avarage_visit_normal"><div class="value"><input class="change_value change_value_doctor" value="{{number_format($value['avarage_visit_normal'], 0, ',', ' ')}}"><span class="property"> RUR</span></div></td>
                </tr>
                <tr class="parent_{{$key}}" data-number="{{$value['reference_id']}}" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}">
                    <td class="color_th">Хорошо</td>
                    <td  class="reference conversion_good"><div class="value"><input class="change_value change_value_doctor" value="{{$value['conversion_good']}}"><span class="property">%</span></div></td>
                    <td class="reference repetition_rate_good"><div class="value"><input class="change_value change_value_doctor" value="{{$value['repetition_rate_good']}}"><span class="property"></span></div></td>
                    <td class="reference turnover_good"><div class="value"><input class="change_value change_value_doctor" value="{{number_format($value['turnover_good'], 0, ',', ' ')}}"><span class="property"> RUR</span></div></td>
                    <td class="reference workload_good"><div class="value"><input class="change_value change_value_doctor" value="{{$value['workload_good']}}"><span class="property">%</span></div></td>
                    <td class="reference avarage_hour_good"><div class="value"><input class="change_value change_value_doctor" value="{{number_format($value['avarage_hour_good'], 0, ',', ' ')}}"><span class="property"> RUR</span></div></td>
                    <td class="reference avarage_visit_good"><div class="value"><input class="change_value change_value_doctor" value="{{number_format($value['avarage_visit_good'], 0, ',', ' ')}}"><span class="property"> RUR</span></div></td>
                </tr>
                @else

                <tr class="parent_{{$key}}" data-number="" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}">
                    <td rowspan="2" class="color_th">{{$value['specialization']}}</td>
                    <td class="color_th">Normal</td>
                    <td class="reference conversion_normal"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property">%</span></div></td>
                    <td class="reference repetition_rate_normal"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"></span></div></td>
                    <td class="reference turnover_normal"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"> RUR</span></div></td>
                    <td class="reference workload_normal"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property">%</span></div></td>
                    <td class="reference avarage_hour_normal"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"> RUR</span></div></td>
                    <td class="reference avarage_visit_normal"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"> RUR</span></div></td>
                </tr>
                <tr class="parent_{{$key}}" data-number="" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}">
                    <td class="color_th">Good</td>
                    <td  class="reference conversion_good"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property">%</span></div></td>
                    <td class="reference repetition_rate_good"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"></span></div></td>
                    <td class="reference turnover_good"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"> RUR</span></div></td>
                    <td class="reference workload_good"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property">%</span></div></td>
                    <td class="reference avarage_hour_good"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"> RUR</span></div></td>
                    <td class="reference avarage_visit_good"><div class="value"><input class="change_value change_value_doctor" value=""><span class="property"> RUR</span></div></td>
                </tr>

                @endif
                @endif

                @endforeach

            </tbody>
        </table>
    </div>


    <div class="table-div table-div-doctor reference_admin">

        <table class="table table-head table1">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Администраторы</th>
                    <th scope="row" class="color_th">Средняя стоимость 1 посещения</th>
                    <th scope="row" class="color_th">Конверсия 2</th>
                    <th scope="row" class="color_th">Конверсия 3 (основная)</th>
                </tr>
            </thead>
        </table>

        <table class="table table-value table1 reference_admin">
            @csrf
            <tbody>
                @foreach($specializations as $key => $value)
                @if($value['id'] == 1)
                @if(isset($value['conversion1_normal']))
                <tr class="parent_{{$key}}"  data-number="{{$value['reference_id']}}" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}">
                    <td class="color_th">Normal</td>
                    <td class="conversion conversion1_normal"><div class="value"><input class="change_value change_value_admin" value="{{$value['conversion1_normal']}}"><span class="property">%</span></div></td>
                    <td class="conversion conversion2_normal"><div class="value"><input class="change_value change_value_admin" value="{{$value['conversion2_normal']}}"><span class="property">%</span></div></td>
                    <td class="conversion conversion3_normal"><div class="value"><input class="change_value change_value_admin" value="{{$value['conversion3_normal']}}"><span class="property">%</span></div></td>
                </tr>
                <tr class="parent_{{$key}}"  data-number="{{$value['reference_id']}}" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}">
                    <td class="color_th">Good</td>
                    <td  class="conversion conversion1_good"><div class="value"><input class="change_value change_value_admin" value="{{$value['conversion1_good']}}"><span class="property">%</span></div></td>
                    <td  class="conversion conversion2_good"><div class="value"><input class="change_value change_value_admin" value="{{$value['conversion2_good']}}"><span class="property">%</span></div></td>
                    <td  class="conversion conversion3_good"><div class="value"><input class="change_value change_value_admin" value="{{$value['conversion3_good']}}"><span class="property">%</span></div></td>

                </tr>
                @else

                <tr class="parent_{{$key}}" data-number="" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}">
                    <td class="color_th">Normal</td>
                    <td class="conversion conversion1_normal"><div class="value"><input class="change_value change_value_admin" value=""><span class="property">%</span></div></td>
                    <td class="conversion conversion2_normal"><div class="value"><input class="change_value change_value_admin" value=""><span class="property">%</span></div></td>
                    <td class="conversion conversion3_normal"><div class="value"><input class="change_value change_value_admin" value=""><span class="property">%</span></div></td>
                </tr>
                <tr class="parent_{{$key}}" data-number="" data-class="{{$class}}" data-city ="{{$city}}" data-specializ ="{{$value['id']}}">
                    <td class="color_th">Good</td>
                    <td  class="conversion conversion1_good"><div class="value"><input class="change_value change_value_admin" value=""><span class="property">%</span></div></td>
                    <td  class="conversion conversion2_good"><div class="value"><input class="change_value change_value_admin" value=""><span class="property">%</span></div></td>
                    <td  class="conversion conversion3_good"><div class="value"><input class="change_value change_value_admin" value=""><span class="property">%</span></div></td>
                </tr>

                @endif
                @endif
                @endforeach
            </tbody>
        </table>
    </div>









</div>






@endsection