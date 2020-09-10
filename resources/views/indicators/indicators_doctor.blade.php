@extends('layout1')


@section('content')
<div class="container_div">
    <div class="header">Статистика Врачей</div>
    <div class="interval-text">Выберите интервал</div>
    <form action="/indicators-doctor" method="post" enctype="multipart/form-data">
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
        <table class="table conversion_doctor table-head table1">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Показатель</th>
                    <th scope="row" class="color_th">Конверсия</th>
                    <th scope="row" class="color_th">Показатель повторности</th>
                    <th scope="row" class="color_th">Выручка на консультацию</th>
                    <th scope="row" class="color_th">Загруженность 1</th>
                    <th scope="row" class="color_th">Средняя стоимость часа работы</th>
                    <th scope="row" class="color_th">Средняя стоимость 1 посещения</th>
                    <th scope="row" class="color_th">Специальность</th>
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 doctor_indicator">
            <tbody>


                @foreach($indicator_doctor as $key => $value)

                <tr>
                    <td class="color_th">{{$value['employee_name']}}</td>

                    @if(is_null($value['sum(first_therapy)']) || is_null($value['sum(first_consulting)']))
                    <td><div class="value default">  </div></td>
                    @elseif($value['sum(first_therapy)'] == 0 || $value['sum(first_consulting)'] == 0 )
                    <td><div class="value red">  0 %</div></td>
                    @else
                    <?php
                    $number = round(number_format($value['sum(first_therapy)'] / $value['sum(first_consulting)'] * 100, 0, ",", " "));

                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['conversion_good'] && $reference_array[$id]['conversion_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['conversion_good'] && $number >= $reference_array[$id]['conversion_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion_normal']) {
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
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon doctor_droptown_formule"></div>
                            <div class="formule doctor_formule"><p>final_patient :{{round($value['sum(first_therapy)'])}}</p><p>recorded_patient :{{round($value['sum(first_consulting)'])}}</p></div>
                        </div>
                    </td>
                    @endif


                    @if(is_null($value['sum(total_therapy)']) || is_null($value['sum(first_therapy)']))
                    <td><div class="value default">   </div></td>
                    @elseif($value['sum(total_therapy)'] == 0 || $value['sum(first_therapy)'] == 0 )
                    <td><div class="value red">  0 </div></td>
                    @else
                    <?php
                    $number = number_format($value['sum(total_therapy)'] / $value['sum(first_therapy)'], 2, ',', ' ');
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];

                        if ($reference_array[$id]['repetition_rate_good'] > $reference_array[$id]['repetition_rate_normal']) {
                            if ($number >= $reference_array[$id]['repetition_rate_good'] && $reference_array[$id]['repetition_rate_good'] != null) {

                                $color = 'green';
                            } elseif ($number < $reference_array[$id]['repetition_rate_good'] && $number >= $reference_array[$id]['repetition_rate_normal']) {

                                $color = 'orange';
                            } elseif ($number >= 0 && $number < $reference_array[$id]['repetition_rate_normal']) {

                                $color = 'red';
                            } else {
                                $color = 'default';
                            }
                        } else {
                            if ($number >= $reference_array[$id]['repetition_rate_normal'] && $reference_array[$id]['repetition_rate_normal'] != null) {
                                $color = 'red';
                            } elseif ($number < $reference_array[$id]['repetition_rate_normal'] && $number >= $reference_array[$id]['repetition_rate_good']) {

                                $color = 'orange';
                            } elseif ($number >= 0 && $number < $reference_array[$id]['repetition_rate_good']) {

                                $color = 'green';
                            } else {
                                $color = 'default';
                            }
                        }
                    } else {
                        $color = 'default';
                    }
                    ?>
                    <td><div class="formule_div">
                            <div class="value {{$color}}">  {{$number}}</div><div class="drop_down_icon doctor_droptown_formule"></div>
                            <div class="formule doctor_formule"><p>final_patient :{{round($value['sum(total_therapy)'])}}</p><p>recorded_patient :{{round($value['sum(first_therapy)'])}}</p></div>
                        </div></td>
                    @endif

                    @if(is_null($value['sum(turnover)']) || is_null($value['sum(first_consulting)']))
                    <td><div class="value default">  </div></td>
                    @elseif($value['sum(turnover)'] == 0 || $value['sum(first_consulting)'] == 0 )
                    <td><div class="value red">  0 RUR</div></td>
                    @else
                    <?php
                    $number = round($value['sum(turnover)'] / $value['sum(first_consulting)']);
                    $number = number_format($number, 0, ",", " ");
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['turnover_good'] && $reference_array[$id]['turnover_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['turnover_good'] && $number >= $reference_array[$id]['turnover_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['turnover_normal']) {
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
                            <div class="value {{$color}}">  {{$number}} RUR</div><div class="drop_down_icon doctor_droptown_formule"></div>
                            <div class="formule doctor_formule"><p>final_patient :{{round($value['sum(turnover)'])}}</p><p>recorded_patient :{{round($value['sum(first_consulting)'])}}</p></div>
                        </div>
                    </td>
                    @endif


                    @if(is_null($value['sum(spent_time)']) || is_null($value['sum(schedule_time)']))
                    <td><div class="value default"> </div></td>
                    @elseif($value['sum(spent_time)'] == 0 || $value['sum(schedule_time)'] == 0 )
                    <td><div class="value red">  0 %</div></td>

                    @else
                    <?php
                    $number = round(number_format($value['sum(spent_time)'] / $value['sum(schedule_time)'] * 100, 0, ",", " "));
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['workload_good'] && $reference_array[$id]['workload_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['workload_good'] && $number >= $reference_array[$id]['workload_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['workload_normal']) {
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
                            <div class="value {{$color}}">  {{$number}} %</div><div class="drop_down_icon doctor_droptown_formule"></div>
                            <div class="formule doctor_formule"><p>final_patient :{{round($value['sum(spent_time)'])}}</p><p>recorded_patient :{{round($value['sum(schedule_time)'])}}</p></div>
                        </div>
                    </td>
                    @endif

                    @if(is_null($value['sum(turnover)']) || is_null($value['sum(spent_time)']))
                    <td><div class="value default">  </div></td>
                    @elseif($value['sum(turnover)'] == 0 || $value['sum(spent_time)'] == 0 )
                    <td><div class="value red">  0 RUR</div></td>
                    @else
                    <?php
                    $number = round($value['sum(turnover)'] / $value['sum(spent_time)']);
                    $number = number_format($number, 0, ",", " ");

                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['avarage_hour_good'] && $reference_array[$id]['avarage_hour_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['avarage_hour_good'] && $number >= $reference_array[$id]['avarage_hour_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['avarage_hour_normal']) {
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
                            <div class="value {{$color}}">  {{$number}} RUR</div><div class="drop_down_icon doctor_droptown_formule"></div>
                            <div class="formule doctor_formule"><p>final_patient :{{round($value['sum(turnover)'])}}</p><p>recorded_patient :{{round($value['sum(spent_time)'])}}</p></div>
                        </div>
                    </td>
                    @endif

                    @if(is_null($value['sum(turnover)']) || is_null($value['sum(total_therapy)']))
                    <td><div class="value default">  </div></td>
                    @elseif($value['sum(turnover)'] == 0 || $value['sum(total_therapy)'] == 0 )
                    <td><div class="value red">  0 RUR</div></td>
                    @else
                    <?php
                    $number = round($value['sum(turnover)'] / $value['sum(total_therapy)']);
                    $number = number_format($number, 0, ",", " ");
                    if (isset($reference_array[$value['specializ_id']])) {
                        $id = $value['specializ_id'];
                        if ($number >= $reference_array[$id]['avarage_visit_good'] && $reference_array[$id]['avarage_visit_good'] != null) {
                            $color = 'green';
                        } elseif ($number < $reference_array[$id]['avarage_visit_good'] && $number >= $reference_array[$id]['avarage_visit_normal']) {
                            $color = 'orange';
                        } elseif ($number >= 0 && $number < $reference_array[$id]['avarage_visit_normal']) {
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
                            <div class="value {{$color}}">  {{$number}} RUR</div><div class="drop_down_icon doctor_droptown_formule"></div>
                            <div class="formule doctor_formule"><p>final_patient :{{round($value['sum(turnover)'])}}</p><p>recorded_patient :{{round($value['sum(total_therapy)'])}}</p></div>
                        </div>
                    </td>
                    @endif


                    <td>{{$value['specialization']}}</td>
                </tr>
                @endforeach



            </tbody>
        </table>

        @if(count($month_stat)>0)

        <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Конверсия</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>
                <?php
                foreach ($month_stat as $key => $value_admin) {

                    $i = 1;
                    ?>
                    <tr>
                        <?php
                        foreach ($value_admin as $keym => $value) {

                            if ($i == 1) {
                                echo '<td class="color_th">' . $value['employee_name'] . '</td>';
                            }

                            if (!isset($value['first_therapy']) || !isset($value['first_consulting'])) {
                                echo '<td><div class="value default">  </div></td>';
                               
                            } else {

                                if ($value['first_therapy'] == 0 || $value['first_consulting'] == 0) {
                                    echo '<td><div class="value red"> 0% </div></td>';
 
                                } else {
                                    $number = round($value['first_therapy'] / $value['first_consulting'] * 100);
                                    if (isset($reference_array[$value['specializ_id']])) {
                                        $id = $value['specializ_id'];
                                        if ($number >= $reference_array[$id]['conversion_good'] && $reference_array[$id]['conversion_good'] != null) {
                                            $color = 'green';
                                        } elseif ($number < $reference_array[$id]['conversion_good'] && $number >= $reference_array[$id]['conversion_normal']) {
                                            $color = 'orange';
                                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion_normal']) {
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
                                            <div class="formule"><p>recorded_patient :{{round($value['first_therapy'])}}</p><p>first_patient :{{round($value['first_consulting'])}}</p></div>
                                        </div>
                                    </td>
                                    <?php
                                }
                            }

                            $i++;
                        }
                        echo '</tr>';
                    }
                    ?>
            </tbody>
        </table>
        
        <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Показатель повторности</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>
                <?php
                foreach ($month_stat as $key => $value_admin) {

                    $i = 1;
                    ?>
                    <tr>
                        <?php
                        foreach ($value_admin as $keym => $value) {

                            if ($i == 1) {
                                echo '<td class="color_th">' . $value['employee_name'] . '</td>';
                            }

                            if (!isset($value['total_therapy']) || !isset($value['first_therapy'])) {
                                echo '<td><div class="value default">  </div></td>';
                               
                            } else {

                                if ($value['total_therapy'] == 0 || $value['first_therapy'] == 0) {
                                    echo '<td><div class="value red"> 0 </div></td>';
 
                                } else {
                                    $number = round($value['total_therapy'] / $value['first_therapy'] * 100);
                                    if (isset($reference_array[$value['specializ_id']])) {
                                        $id = $value['specializ_id'];
                                        if ($number >= $reference_array[$id]['conversion_good'] && $reference_array[$id]['conversion_good'] != null) {
                                            $color = 'green';
                                        } elseif ($number < $reference_array[$id]['conversion_good'] && $number >= $reference_array[$id]['conversion_normal']) {
                                            $color = 'orange';
                                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion_normal']) {
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
                                            <div class="value {{$color}}">  {{$number}}</div><div class="drop_down_icon"></div>
                                            <div class="formule"><p>recorded_patient :{{round($value['total_therapy'])}}</p><p>first_patient :{{round($value['first_therapy'])}}</p></div>
                                        </div>
                                    </td>
                                    <?php
                                }
                            }

                            $i++;
                        }
                        echo '</tr>';
                    }
                    ?>
            </tbody>
        </table>
        
         <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Выручка на консультацию</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>
                    <?php
                foreach ($month_stat as $key => $value_admin) {

                    $i = 1;
                    ?>
                    <tr>
                        <?php
                        foreach ($value_admin as $keym => $value) {

                            if ($i == 1) {
                                echo '<td class="color_th">' . $value['employee_name'] . '</td>';
                            }

                            if (!isset($value['turnover']) || !isset($value['first_consulting'])) {
                                echo '<td><div class="value default">  </div></td>';
                               
                            } else {

                                if ($value['turnover'] == 0 || $value['first_consulting'] == 0) {
                                    echo '<td><div class="value red"> 0 RUR</div></td>';
 
                                } else {
                                    
                                    $number = round($value['turnover'] / $value['first_consulting']);
                                    $number = number_format($number, 0, ",", " ");
                                    if (isset($reference_array[$value['specializ_id']])) {
                                        $id = $value['specializ_id'];
                                        if ($number >= $reference_array[$id]['conversion_good'] && $reference_array[$id]['conversion_good'] != null) {
                                            $color = 'green';
                                        } elseif ($number < $reference_array[$id]['conversion_good'] && $number >= $reference_array[$id]['conversion_normal']) {
                                            $color = 'orange';
                                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion_normal']) {
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
                                            <div class="value {{$color}}">  {{$number}} RUR</div><div class="drop_down_icon"></div>
                                            <div class="formule"><p>recorded_patient :{{round($value['turnover'])}}</p><p>first_patient :{{round($value['first_consulting'])}}</p></div>
                                        </div>
                                    </td>
                                    <?php
                                }
                            }

                            $i++;
                        }
                        echo '</tr>';
                    }
                    ?>
            </tbody>
        </table>
        
        
        
        <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Загруженность 1</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>          
                    <?php
                foreach ($month_stat as $key => $value_admin) {
                    $i = 1;
                    ?>
                    <tr>
                        <?php
                        foreach ($value_admin as $keym => $value) {
                            if ($i == 1) {
                                echo '<td class="color_th">' . $value['employee_name'] . '</td>';
                            }
                            if (!isset($value['spent_time']) || !isset($value['schedule_time'])) {
                                echo '<td><div class="value default">  </div></td>';
                               
                            } else {

                                if ($value['spent_time'] == 0 || $value['schedule_time'] == 0) {
                                    echo '<td><div class="value red"> 0 %</div></td>';
                                } else {
                                    $number = round($value['spent_time'] / $value['schedule_time']);
                                    $number = number_format($number, 0, ",", " ");
                                    if (isset($reference_array[$value['specializ_id']])) {
                                        $id = $value['specializ_id'];
                                        if ($number >= $reference_array[$id]['conversion_good'] && $reference_array[$id]['conversion_good'] != null) {
                                            $color = 'green';
                                        } elseif ($number < $reference_array[$id]['conversion_good'] && $number >= $reference_array[$id]['conversion_normal']) {
                                            $color = 'orange';
                                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion_normal']) {
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
                                            <div class="formule"><p>recorded_patient :{{round($value['spent_time'])}}</p><p>first_patient :{{round($value['schedule_time'])}}</p></div>
                                        </div>
                                    </td>
                                    <?php
                                }
                            }

                            $i++;
                        }
                        echo '</tr>';
                    }
                    ?>
            </tbody>
        </table>
        
        <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Средняя стоимость часа работы</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>
                <?php
                foreach ($month_stat as $key => $value_admin) {
                    $i = 1;
                    ?>
                    <tr>
                        <?php
                        foreach ($value_admin as $keym => $value) {

                            if ($i == 1) {
                                echo '<td class="color_th">' . $value['employee_name'] . '</td>';
                            }

                            if (!isset($value['turnover']) || !isset($value['spent_time'])) {
                                echo '<td><div class="value default">  </div></td>';
                               
                            } else {

                                if ($value['turnover'] == 0 || $value['spent_time'] == 0) {
                                    echo '<td><div class="value red"> 0 RUR</div></td>';
 
                                } else {
                                    $number = round($value['turnover'] / $value['spent_time']);
                                    $number = number_format($number, 0, ",", " ");
                                    if (isset($reference_array[$value['specializ_id']])) {
                                        $id = $value['specializ_id'];
                                        if ($number >= $reference_array[$id]['conversion_good'] && $reference_array[$id]['conversion_good'] != null) {
                                            $color = 'green';
                                        } elseif ($number < $reference_array[$id]['conversion_good'] && $number >= $reference_array[$id]['conversion_normal']) {
                                            $color = 'orange';
                                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion_normal']) {
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
                                            <div class="value {{$color}}">  {{$number}} RUR</div><div class="drop_down_icon"></div>
                                            <div class="formule"><p>recorded_patient :{{round($value['turnover'])}}</p><p>first_patient :{{round($value['spent_time'])}}</p></div>
                                        </div>
                                    </td>
                                    <?php
                                }
                            }

                            $i++;
                        }
                        echo '</tr>';
                    }
                    ?>
                 
            </tbody>
        </table>
       
        <table class="table conversion_admin table-head table1 doctor_stat monthly_stat">
            <thead>
                <tr>
                    <th scope="row" class="color_th">Средняя стоимость 1 посещения</th>
                    @foreach($months as $key => $value)
                    <th scope="row" class="color_th">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
        <table class="table table-value table1 admin_indicator admin_indicator_monthly">
            <tbody>
                 <?php
                foreach ($month_stat as $key => $value_admin) {
                    $i = 1;
                    ?>
                    <tr>
                        <?php
                        foreach ($value_admin as $keym => $value) {

                            if ($i == 1) {
                                echo '<td class="color_th">' . $value['employee_name'] . '</td>';
                            }

                            if (!isset($value['turnover']) || !isset($value['total_therapy'])) {
                                echo '<td><div class="value default">  </div></td>';
                               
                            } else {

                                if ($value['turnover'] == 0 || $value['total_therapy'] == 0) {
                                    echo '<td><div class="value red"> 0 RUR</div></td>';
                                } else {
                                    $number = round($value['turnover'] / $value['total_therapy']);
                                    $number = number_format($number, 0, ",", " ");
                                    if (isset($reference_array[$value['specializ_id']])) {
                                        $id = $value['specializ_id'];
                                        if ($number >= $reference_array[$id]['conversion_good'] && $reference_array[$id]['conversion_good'] != null) {
                                            $color = 'green';
                                        } elseif ($number < $reference_array[$id]['conversion_good'] && $number >= $reference_array[$id]['conversion_normal']) {
                                            $color = 'orange';
                                        } elseif ($number >= 0 && $number < $reference_array[$id]['conversion_normal']) {
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
                                            <div class="value {{$color}}">  {{$number}} RUR</div><div class="drop_down_icon"></div>
                                            <div class="formule"><p>recorded_patient :{{round($value['turnover'])}}</p><p>first_patient :{{round($value['total_therapy'])}}</p></div>
                                        </div>
                                    </td>
                                    <?php
                                }
                            }

                            $i++;
                        }
                        echo '</tr>';
                    }
                    ?>
                 
            </tbody>
        </table>
        
        @endif

    </div>
</div>

@endsection