@extends('layout1')


@section('content')
<div class="container_div">
   
    @if(count($result))
    <div class="container-admin">
        <div class="form-horizontal" id="myform6">
            <div class="table-div table-div-doctor reference_admin">

                <table class="table table-head table1">
                    <thead>
                        <tr>
                            <th> Номер </th>
                            <th> Имя Фамилия </th>
                            <th> Специализация </th>
                            <th> Клиники </th>
                            <th> Обн. /Удал. </th>
                        </tr>
                    </thead>
                </table>

                <table class="table table-value table1 user">
                    <?php
                    
                    $j = 1;
                    foreach ($result as $key => $value) {
                        $i = 1;
                        

                        echo "<tr>"
                        . "<td>" . $j . "</td>"
                        . "<td>" . $value->employee_name . "</td>"
                        . "<td>" . $value->specialization . "</td><td>";

                        foreach ($value->org as $key => $organization) {
                           
                            $count = count($value->org);
                            
                            if ($i == $count) {
                                echo "<a href='/organizations/" . $key . "'>" . $organization . "</a>";
                            } else {
                                echo "<a href='/organizations/" . $key . "'>" . $organization . "</a>" . ', ';
                            }
                            $i++;
                        }

                        echo "</td>";
                        if (Auth::user()->role_id == 2) {?>
                            <td><a  href="/employees/{{$value->id}}/edit"><img src='/images/edit.svg'></a>                            
                               <a href="/employees/{{$value->id}}/destroy" type='submit' onclick='javascript:confirmationDeleteEmployee($(this));return false;' class='del_employee'><img src='/images/trash.svg'></a></td>
                            </tr>
                             <?php
                             $j++;
                        }
                        }
                        ?>
                        </tbody>
                </table>

                

            </div>
        </div>
    </div>
    @else
    @if($specializ == 'doctor')
    <div class="no-personal"> <h3>В клинике {{session()->get('org_name')}} нет зарегистрированных врачей, пожалуйста <a href="/employees/doctors">добавьте</a></h3></div>
    @else  
    <div class="no-personal"> <h3>В клинике {{session()->get('org_name')}} нет зарегистрированных администраторов, пожалуйста <a href="/employees/administrators">добавьте</a></h3></div>
    @endif

    @endif
</div>

@endsection