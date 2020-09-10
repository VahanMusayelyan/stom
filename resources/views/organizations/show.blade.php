@extends('layout1')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#org').addClass('active');
</script>
<div class="form-div-add organization_div">
    <div class="container-admin">

        <div class="form-horizontal" id="details">
            <a href="{{url()->previous()}}"><img src="/images/back.svg"></a>
            <a class="btn btn-warning edit_organization" href="/organizations/{{session()->get('org_id')}}/edit">Редактировать</a>
            <table class="table table-head table1">
                <thead>
                    <tr>
                        <th> Свойство </th>
                        <th> Значение </th>
                    </tr>
                </thead>

                <?php
                foreach ($result as $key => $value) {

                    echo "<tr><td>Название организации</td><td><a href='/organizations/" . $value->id . "'>" . $value->org_name . "</a></td></tr>"
                    . "<tr><td>Тип организации</td><td>" . $value->organiz_type . "</a></td></tr>"
                    . "<tr><td>Клиент</td><td>" . $value->name . " " . $value->l_name . "</a></td></tr>"
                    . "<tr><td>Страна</td><td>" . $value->country . "</a></td></tr>"
                    . "<tr><td>Регион</td><td>" . $value->region . "</a></td></tr>"
                    . "<tr><td>Город</td><td>" . $value->city . "</a></td></tr>"
                    . "<tr><td>Класс</td><td>" . $value->class_name . "</a></td></tr>"
                    . "<tr><td>Если рассчитано-укажите долю каждой специальности в вале клиники(%)<td>" . $value->organization_data1 . "</a></td></tr>"
                    . "<tr><td>Опишите принцип начисления заработной платы врачей и администраторов.</td><td>" . $value->organization_data2 . "</a></td></tr>"
                    . "<tr><td>Опишите механизмы работы с базой клиники</td><td>" . $value->organization_data3 . "</a></td></tr>"
                    . "<tr><td>Есть ли в клинике скрипты для администраторов?</td><td>" . $value->organization_data4 . "</a></td></tr>"
                    . "<tr><td>Какие отчеты вы анализируете для принятия управленческих решений?</td><td>" . $value->organization_data5 . "</a></td></tr>"
                    . "<tr><td>Кто составляет эти отчЁты для вас?</td><td>" . $value->organization_data6 . "</a></td></tr>"
                    . "<tr><td>Кто в клинике ведёт и ведёт ли соцсети?</td><td>" . $value->organization_data7 . "</a></td></tr>"
                    . "<tr><td>Есть ли в аккаунты в соцсетях у врачей?</td><td>" . $value->organization_data8 . "</a></td></tr>"
                    . "<tr><td>Какие статистические показатели клиники вы высчитываете и анализируете</td><td>" . $value->organization_data9 . "</a></td></tr>"
                    . "<tr><td>Дополнительный (запасной)</td><td>" . $value->organization_data10 . "</a></td></tr>";
                }

                
                if (isset($employees['doctor'])) {
                    echo "<tr><td>Врачи</td><td>";
                    $i = 1;
                    foreach ($employees['doctor'] as $keyemp => $empl) {


                        if ($i == count($employees['doctor'])) {
                            echo $empl[0];
                        } else {
                            echo $empl[0] . " , ";
                        }
                        $i++;
                        
                    }
                    echo "</td></tr>";
                }


                if (isset($employees['admin'])) {

                    echo "<tr><td>Администраторы</td><td>";
                    $j = 1;
                    foreach ($employees['admin'] as $keyemp => $empl) {

                        if ($j == count($employees['admin'])) {
                            echo $empl[0];
                        } else {
                            echo $empl[0] . " , ";
                        }
                        $j++;
                    }


                    echo "</td></tr>";
                }
                ?>

            </table>


        </div>
    </div>
</div>



@endsection