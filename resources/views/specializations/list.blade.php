@extends('layout1')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#specializations').addClass('active');
</script>
 <div class="container_div">
    <div class="container-admin">
        <div class="form-horizontal" id="myform6">
            <div class="table-div table-div-doctor specialization">
                <a class="btn btn-warning spec_add" href="/specializations/create">Добавить </a>
                 <table class="table table-head table1">
                    <tr>
                        <th> Но </th>
                        <th> Специализации </th>
                        <th> Действия </th>

                    </tr>

                    <?php
                    
                   $j = 1;
                    foreach ($result as $key => $value) {
                     

                        echo "<tr>"
                        . "<td>" . $j . "</td>"
                        . "<td>" . $value->specialization . "</td>";

                        if($value->id > 1){
                            echo "<td><a  href='" . url('/specializations/' . $value->id) . "/edit'><img src='/images/edit.svg'></a>";
                       
                        ?>
                        <form action="{{route('specializations.destroy',$value->id)}}" method='POST' enctype='multipart/form-data'>
                            @csrf
                            @method('DELETE')
                            <?php
                            echo "<button type='submit' class=''><img src='/images/trash.svg'></button></form></td>";
                            
                        }else{
                            echo "<td></td>";
                        }
                          
                        
                        echo "</tr>";
                        $j++;
                          }
                        ?>


                </table>


            </div>
        </div>
    </div>
 </div>

@endsection