@extends('layout')


@section('content')

<style>
    td{
        background-color: #FFF2CC;
    }
    .color_th{
        background-color: #E2EFDA;
    }
    
    .doctor_stat td{
       max-width: 400px; 
    }


</style>
<script>
    $('.nav-link').removeClass('active');
    $('#indicators').addClass('active');
</script>
<div style="width: 63%;height: auto;margin:25px auto">


    <h1>INDICATORS ADMIN</h1>

    <table class="table conversion_admin">
        <thead>
            <tr>
                <th scope="row" class="color_th">Statistic</th>
                <th scope="row" class="color_th">Conversion 1</th>
                <th scope="row" class="color_th">Conversion 2</th>
                <th scope="row" class="color_th">Conversion 3</th>
            </tr>
        </thead>
        <tbody>

        
            @foreach($indicator_admin as $key => $value)
            <tr>
                <td class="color_th">{{$value->employee_name}}</td>
                <td>{{round($value->recorded_patient / $value->first_patient*100)}} %</td>
                <td>{{round($value->final_patient / $value->recorded_patient*100)}} %</td>
                <td>{{round($value->final_patient / $value->first_patient*100)}} %</td>
            </tr>
            @endforeach

 
        </tbody>
    </table>
    
          <h1>INDICATORS DOCTORS</h1>
    <table class="table conversion_doctor">
        <thead>
            <tr>
                <th scope="row" class="color_th">Statistic</th>
                <th scope="row" class="color_th">Conversion 1</th>
                <th scope="row" class="color_th">Repetition rate</th>
                <th scope="row" class="color_th">Consultation Turnover</th>
                <th scope="row" class="color_th">Workload</th>
                <th scope="row" class="color_th">Avarage per hour</th>
                <th scope="row" class="color_th">Avarage of 1 visit</th>
                <th scope="row" class="color_th">Specialization</th>
            </tr>
        </thead>
        <tbody>

        
            @foreach($indicator_doctor as $key => $value)
            <tr>
                <td class="color_th">{{$value->employee_name}}</td>
                <td>{{round(number_format($value->first_therapy / $value->first_consulting*100,0,","," "))}} %</td>
                <td>{{round(number_format($value->total_therapy / $value->first_therapy*100,0,","," "))}} %</td>
                <td>{{round(number_format($value->turnover / $value->first_consulting,0,","," "))}} RUR</td>
                <td>{{round(number_format($value->spent_time / $value->schedule_time*100,0,","," "))}} %</td>
                <td>{{round(number_format($value->turnover / $value->spent_time,0,","," "))}} RUR</td>
                <td>{{round(number_format($value->turnover / $value->total_therapy,0,","," "))}} RUR</td>
                <td>{{$value->specialization}}</td>

            </tr>
            @endforeach

 
        </tbody>
    </table>
             
          
          <h1>INDICATORS SPECIALIZ</h1>
    <table class="table conversion_doctor">
        <thead>
            <tr>
                <th scope="row" class="color_th">Statistic</th>
                <th scope="row" class="color_th">Conversion 1</th>
                <th scope="row" class="color_th">Repetition rate</th>
                <th scope="row" class="color_th">Consultation Turnover</th>
                <th scope="row" class="color_th">Workload</th>
                <th scope="row" class="color_th">Avarage per hour</th>
                <th scope="row" class="color_th">Avarage of 1 visit</th>
                <th scope="row" class="color_th">Specialization</th>
            </tr>
        </thead>
        <tbody>

        
            @foreach($indicator_specializ as $key => $value)
            <tr>
                <td class="color_th">{{$value['specialization']}}</td>
                <td>{{number_format($value['sum(first_therapy)'] / $value['sum(first_consulting)']*100,0,","," ")}} %</td>
                <td>{{number_format($value['sum(total_therapy)'] / $value['sum(first_therapy)']*100,0,","," ")}} %</td>
                <td>{{number_format($value['sum(turnover)'] / $value['sum(first_consulting)'],0,","," ")}} RUR</td>
                <td>{{number_format($value['sum(spent_time)'] / $value['sum(schedule_time)']*100,0,","," ")}} %</td>
                <td>{{number_format($value['sum(turnover)'] / $value['sum(spent_time)'],0,","," ")}} RUR</td>
                <td>{{number_format($value['sum(turnover)'] / $value['sum(total_therapy)'],0,","," ")}} RUR</td>
                <td>{{$value['specialization']}}</td>

            </tr>
            @endforeach

 
        </tbody>
    </table>
    
  

</div>

@endsection