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
                        <th> Имя </th>
                        <th> Вид </th>
                        <th> Клиент </th>
                        <th> Страна </th>
                        <th> Регион </th>
                        <th> Город </th>
                        <th> Класс </th>
                        @if(Auth::user()->role_id == 2)
                        <th> Обн./Удал. </th>
                        @elseif(Auth::user()->role_id == 1)
                        <th> Потв. /Отвер. </th>
                        @endif
                    </tr>
					</thead>
					</table>

                    <?php
                    
                    if($result->links()){
                        $i = (($result->currentPage()-1)*10)+1;
                    }else{
                        $i = 1;
                    }?>
                    
                    <table class="table table-value table1 user">
					<tbody>
						@csrf
                    <? 
					foreach ($result as $key => $value) {
                        ?>


                        <tr>
                            <td>{{ $i }}</td>
                            <td><a href='/organizations/{{$value->id }}'>{{ $value->org_name }}</a></td>
                            <td>{{$value->organiz_type}}</td>
                            <td>{{ $value->name}} {{$value->l_name }}</td>
                            <td>{{ $value->country }}</td>
                            <td>{{ $value->region }}</td>
                            <td>{{ $value->city }}</td>
                            <td>{{ $value->class_name }}</td>

                            <?php if (Auth::user()->role_id == 2) { ?>

                                <td><a href='/organizations/{{$value->id}}/edit'><img src='/images/edit.svg'></a>
                                            
                                                <a type='submit' href='/organizations/{{$value->id}}/destroy' onclick='javascript:confirmationDelete($(this));return false;' class='del_organization'><img src='/images/trash.svg'></a></td></tr>
                                    <?php
                                    $i++;
                                } else if (Auth::user()->role_id == 1) {
                                    ?>
                            <td>
                                <div class="input-group active_passiv">
                                    <div class="input-group-prepend" >
                                        @csrf
                                        <div class="input-group-text status" id="aprove">
                                            @if($value->org_active == 1)    
                                            <input type="radio" value="1" data-id ="{{$value->id}}" checked="checked" name="status_{{$i}}">
                                            @else
                                            <input type="radio" value="1" data-id ="{{$value->id}}" name="status_{{$i}}">
                                            @endif
                                        </div>
                                        <div class="input-group-text status" id="deny">
                                            @if($value->org_active == 0) 
                                            <input type="radio" value="0" data-id ="{{$value->id}}" checked="checked" name="status_{{$i}}">
                                            @else
                                            <input type="radio" value="0" data-id ="{{$value->id}}" name="status_{{$i}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td></tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
</tbody>
                </table>
               
                @if($result->links())
                {!! $result->render() !!}
                @endif
            </fieldset>
        </div>
    </div>
</div>

@endsection