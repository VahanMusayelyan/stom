@extends('layout1')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#user').addClass('active');
</script>
 <div class="container_div">
    <div class="container-admin">
        <div class="form-horizontal" id="myform6">
            <div class="table-div table-div-doctor reference_admin">
           
                 <table class="table table-head table1">
                     <thead>
                    <tr>
                        <th> Номер </th>
                        <th> Имя </th>
                        <th> Отчество </th>
                        <th> Фамилия </th>
                        <th> Эл. Адрес </th>
                        <th> Эл. Адрес потвержден</th>
                        <th> Логин </th>
                        <th> Тел. </th>
                        <th> Подтв /Отверг </th>
                        <th> Предв. просмотр </th>
                    </tr>
                     </thead>
            </table>
                
                <table class="table table-value table1 user">
				@csrf
                    <tbody>
                    <?php
                    if($result->links()){
                        $i = (($result->currentPage()-1)*10)+1;
                    }else{
                        $i = 1;
                    }
                    
                    foreach ($result as $key => $value) {
                        if($value->preview == 1){
                          $color = 'preview';  
                        }else{
                            $color = 'no-preview';  
                        }
                         
                        echo "<tr class=".$color.">"
                        . "<td>" . $i . "</td>"
                        . "<td><a href='users/" . $value->id . "'>" . $value->name . "</a></td>"
                        . "<td>" . $value->m_name . "</td>"
                        . "<td>" . $value->l_name . "</td>"
                        . "<td>" . $value->email . "</td><td>";

                        if ($value->email_verified_at == null) {
                            echo "NO";
                        } else {
                            echo $value->email_verified_at;
                        }
                        echo "</td><td>" . $value->login . "</td>"
                        . "<td>" . $value->phone . "</td>";
                        $i++;
                        ?>
                        <td>
                            <div class="input-group active_passiv">
                                <div class="input-group-prepend" >
                                    @csrf
                                    <div class="input-group-text status_user" id="aprove_user">
                                        @if($value->user_active == 1)    
                                        <input type="radio" value="1" data-id ="{{$value->id}}" checked="checked" name="status_{{$value->id}}">
                                        @else
                                        <input type="radio" value="1" data-id ="{{$value->id}}" name="status_{{$value->id}}">
                                        @endif
                                    </div>
                                    <div class="input-group-text status_user" id="deny_user">
                                        @if($value->user_active == 0) 
                                        <input type="radio" value="0" data-id ="{{$value->id}}" checked="checked" name="status_{{$value->id}}">
                                        @else
                                        <input type="radio" value="0" data-id ="{{$value->id}}" name="status_{{$value->id}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            
                            <img class="preview_user" src="/images/preview.svg" data-preview="{{$value->preview}}" data-id="{{$value->id}}">  
                        </td>
                </tr>
                        <?php
                    }
                    ?>
                </tbody>
                </table>


                @if(Auth::user()->role_id == 2 )
                <a class="btn btn-warning partnerAdd" href="/employees/create">ADD EMPLOYEES</a>
                @endif
                
                @if($result->links())
                {!! $result->links() !!}
                @endif
                
                
                
          
        </div>
    </div>
</div>
</div>

@endsection