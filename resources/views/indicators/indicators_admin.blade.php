@extends('layout1')


@section('content')
<div class="container_div">

    <div class="header">Статистика Администраторов</div>
    <div class="interval-text">Выберите интервал</div>
    <form action="/indicators-admin" method="post" enctype="multipart/form-data">
        <div class="form-div">
            @csrf
            <div class="datepicker datepicker1 drop_down">
                <div class="ui calendar" id="example7">
                    <div class="ui ui1 input left icon">
                        <i class="time icon"></i>
                        <input type="text" class="first_data" value="<?= $data_first ?>" placeholder="Дата" class="data" name='first_data' autocomplete="off">

                    </div>
                </div>
            </div>
            <div class='line'></div>
            <div class="datepicker datepicker2 drop_down second_data">
                <div class="ui calendar" id="example8">
                    <div class="ui input left icon">
                        <i class="time icon"></i>
                        <input type="text" class="second_data" value="<?= $data_second ?>" placeholder="Дата" class="data" name='second_data' autocomplete="off">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary search-btn">Показать статистику</button>
        </div>

        <div class="search-div reference-admin">

            <input class="search" name="search" placeholder="Поиск" value="{{$search}}" autocomplete="off">
            <button class="btn btn-primary search-btn">Найти</button>
            @if($messege)
            <div class="result_search"><h5>{{$messege}}</h5></div>
            @endif
        </div>
    </form>

    <div class="table-div">
        <table class="table conversion_admin table-head table1 doctor_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Показатель</th>
                    <th scope="row" class="color_th">Конверсия в запись</th>
                    <th scope="row" class="color_th">Конверсия посещений из записи</th>
                    <th scope="row" class="color_th">Конверсия посещений из обращений</th>
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator">
            <tbody>


                @foreach($indicator_admin as $key => $value)

                <tr>
                    <td class="color_th">{{$value['employee_name']}}</td>
                   
                    @if (is_null($value['sum(recorded_patient)']) || is_null($value['sum(first_patient)'])) 
                         <td><div class="value default">  </div></td>   
                    @else
                            
                    @if($value['sum(recorded_patient)'] == 0 || $value['sum(first_patient)'] == 0 )
                    <td><div class="value red">  0 %</div></td>
                    @else
                    <?php
                    $number = round($value['sum(recorded_patient)'] / $value['sum(first_patient)'] * 100);
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['conversion1_good'] && $reference_array[$id]['conversion1_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['conversion1_good'] && $number >= $reference_array[$id]['conversion1_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion1_normal']) {
                            $color = 'red';
                        } else {
                            $color = 'default';
                        }
                    } else {
                        $color = 'default';
                    }
                    ?>
                    <td>
                        <div class="formule_div">
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon"></div>
                            <div class="formule"><p>recorded_patient :{{round($value['sum(recorded_patient)'])}}</p><p>first_patient :{{round($value['sum(first_patient)'])}}</p></div>
                        </div>
                    </td>

                    @endif
                    @endif
                    
                    
                    @if (is_null($value['sum(final_patient)']) || is_null($value['sum(recorded_patient)'])) 
                         <td><div class="value default">  </div></td>   
                    @else
                    
                    @if($value['sum(final_patient)'] == 0 || $value['sum(recorded_patient)'] == 0 )
                    <td><div class="value red">  0 %</div></td>
                    @else
                    <?php
                    $number = round($value['sum(final_patient)'] / $value['sum(recorded_patient)'] * 100);
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['conversion2_good'] && $reference_array[$id]['conversion2_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['conversion2_good'] && $number >= $reference_array[$id]['conversion2_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion2_normal']) {
                            $color = 'red';
                        } else {
                            $color = 'default';
                        }
                    } else {

                        $color = 'default';
                    }
                    ?>
                    <td>
                        <div class="formule_div">
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon"></div>
                            <div class="formule"><p>final_patient :{{round($value['sum(final_patient)'])}}</p><p>recorded_patient :{{round($value['sum(recorded_patient)'])}}</p></div>
                        </div>
                    </td>
                    @endif
                    @endif
                    
                    @if (is_null($value['sum(final_patient)']) || is_null($value['sum(first_patient)'])) 
                         <td><div class="value default">  </div></td>   
                    @else
                    @if($value['sum(final_patient)'] == 0 || $value['sum(first_patient)'] == 0 )
                    <td><div class="value red">  0 %</div></td>
                    @else
                    <?php
                    $number = round($value['sum(final_patient)'] / $value['sum(first_patient)'] * 100);
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['conversion3_good'] && $reference_array[$id]['conversion3_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['conversion3_good'] && $number >= $reference_array[$id]['conversion3_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion3_normal']) {
                            $color = 'red';
                        } else {
                            $color = 'default';
                        }
                    } else {

                        $color = 'default';
                    }
                    ?>
                    <td>
                        <div class="formule_div">
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon"></div>
                            <div class="formule"><p>final_patient :{{round($value['sum(final_patient)'])}}</p><p>first_patient :{{round($value['sum(first_patient)'])}}</p></div>
                        </div>
                    </td>
                    @endif       
                    @endif       

                </tr>

                @endforeach


            </tbody>
        </table>

        
        
        @if(count($month_stat)>0)
        
         <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Конверсия в запись</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>

                @foreach($month_stat as $key => $value_admin)
                <?php $i = 1; ?>
                <tr>
                @foreach($value_admin as $keym => $value)

                    @if($i == 1)
                    <td class="color_th">{{$value['employee_name']}}</td>
                    @endif

                    @if (is_null($value['recorded_patient']) || is_null($value['first_patient'])) 
                         <td><div class="value default">  </div></td>   
                    @else
                    @if($value['recorded_patient'] == 0 || $value['first_patient'] == 0 )
                    <td><div class="value red">  0 %</div></td>
                    @else
                    <?php
                    $number = round($value['recorded_patient'] / $value['first_patient'] * 100);
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['conversion1_good'] && $reference_array[$id]['conversion1_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['conversion1_good'] && $number >= $reference_array[$id]['conversion1_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion1_normal']) {
                            $color = 'red';
                        } else {
                            $color = 'default';
                        }
                    } else {

                        $color = 'default';
                    }
                    ?>
                    <td>
                        <div class="formule_div">
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon"></div>
                            <div class="formule"><p>recorded_patient :{{round($value['recorded_patient'])}}</p><p>first_patient :{{round($value['first_patient'])}}</p></div>
                        </div>
                    </td>
                    @endif    
                    @endif    
                 <?php
                    $i++;
                 ?>
                @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        
        
         <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Конверсия посещений из обращений</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>

                @foreach($month_stat as $key => $value_admin)
                <?php $i = 1; ?>
                <tr>
                @foreach($value_admin as $keym => $value)

                    @if($i == 1)
                    <td class="color_th">{{$value['employee_name']}}</td>
                    @endif
                    
                    @if (is_null($value['final_patient']) || is_null($value['recorded_patient'])) 
                         <td><div class="value default">  </div></td>   
                    @else
                    @if($value['final_patient'] == 0 || $value['recorded_patient'] == 0 )
                    <td><div class="value red">  0 %</div></td>
                    @else
                    <?php
                    $number = round($value['final_patient'] / $value['recorded_patient'] * 100);
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['conversion2_good'] && $reference_array[$id]['conversion2_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['conversion2_good'] && $number >= $reference_array[$id]['conversion2_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion2_normal']) {
                            $color = 'red';
                        } else {
                            $color = 'default';
                        }
                    } else {

                        $color = 'default';
                    }
                    ?>
                    <td>
                        <div class="formule_div">
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon"></div>
                            <div class="formule"><p>final_patient :{{round($value['final_patient'])}}</p><p>recorded_patient :{{round($value['recorded_patient'])}}</p></div>
                        </div>
                    </td>
                    @endif   
                    @endif   
                 <?php
                    $i++;
                 ?>
                @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        
         <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Конверсия посещений из записи</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>

                @foreach($month_stat as $key => $value_admin)
                <?php $i = 1; ?>
                <tr>
                @foreach($value_admin as $keym => $value)

                    @if($i == 1)
                    <td class="color_th">{{$value['employee_name']}}</td>
                    @endif
                    
                    @if (is_null($value['final_patient']) || is_null($value['first_patient'])) 
                         <td><div class="value default">  </div></td>   
                    @else
                    @if($value['final_patient'] == 0 || $value['first_patient'] == 0 )
                    <td><div class="value red">  0 %</div></td>
                    @else
                    <?php
                    $number = round($value['final_patient'] / $value['first_patient'] * 100);
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['conversion2_good'] && $reference_array[$id]['conversion2_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['conversion2_good'] && $number >= $reference_array[$id]['conversion2_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion2_normal']) {
                            $color = 'red';
                        } else {
                            $color = 'default';
                        }
                    } else {

                        $color = 'default';
                    }
                    ?>
                    <td>
                        <div class="formule_div">
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon"></div>
                            <div class="formule"><p>final_patient :{{round($value['final_patient'])}}</p><p>recorded_patient :{{round($value['first_patient'])}}</p></div>
                        </div>
                    </td>
                    @endif   
                    @endif   
                 <?php
                    $i++;
                 ?>
                @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

        @endif
        
    </div>
</div>


@endsection