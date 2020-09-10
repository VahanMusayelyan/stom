@extends('layout1')


@section('content')
<div class="container_div">
    <div class="container-admin">
        <div class="form-horizontal" id="myform6">
            <div class="table-div table-div-doctor reference_admin">

                <table class="table table-head table1">
                    <thead>
                        <tr>
                            <th> Но. </th>
                            <th> Называние клиники </th>
                            <th> Вид </th>
                            <th> Страна </th>
                            <th> Регион </th>
                            <th> Город </th>
                            <th> Класс </th>

                        </tr>
                    </thead>
                </table>

                <?php
                $i = 1;
                ?>

                <table class="table table-value table1 user organization_list">
                    <tbody>
                        @csrf
                        <?
                        foreach ($result as $key => $value) {
                            ?>


                            <tr>
                                <td>{{ $i }}</td>
                                <td><a href='/organizations/{{$value->id }}'>{{ $value->org_name }}</a></td>
                                <td>{{$value->organiz_type}}</td>

                                <td>{{ $value->country }}</td>
                                <td>{{ $value->region }}</td>
                                <td>{{ $value->city }}</td>
                                <td>{{ $value->class_name }}</td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>


                </fieldset>
            </div>
        </div>
    </div>

    @endsection