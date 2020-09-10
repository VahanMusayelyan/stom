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
    $('#statistic').addClass('active');
</script>
<div style="width: 63%;height: auto;margin:25px auto">


    <h1>STATISTIC ADMIN</h1>
    <table class="table admin_stat">
        <thead>
            <tr>
                <th scope="row" class="color_th">Statistic</th>
                <th scope="row" class="color_th">Enter Patient</th>
                <th scope="row" class="color_th">Approve Patient</th>
                <th scope="row" class="color_th">Final Patient</th>

            </tr>
        </thead>
        <tbody>

    @if(count($statistic_admin)<1 && count($employee_admin)>0)


            @foreach($employee_admin as $key => $value) 

            <tr data-org="{{$value->organization_id}}" data-id="{{$value->employee_id}}">
                @csrf
                <td scope="row" class="color_th">{{$value->employee_name}}</td>
                <td data-col="first_patient" class="statistic first_patient">0</td>
                <td data-col="recorded_patient" class="statistic recorded_patient">0</td>
                <td data-col="final_patient" class="statistic final_patient">0</td>
            </tr>

            @endforeach
            <tr>
                <td scope="row" class="color_th">Total</th>
                    @for($i = 0; $i<3; $i++)
                <td class="color_th">0</td>

                @endfor    
            </tr>

    @else

            @foreach($employee_admin as $keyemp => $empoyeevalue)


            @if(isset($statistic_admin[$empoyeevalue->id]))

            <tr data-org="{{$statistic_admin[$empoyeevalue->id]->organization_id}}" data-id="{{$statistic_admin[$empoyeevalue->id]->employee_id}}">
                @csrf

                <td scope="row" class="color_th">{{$empoyeevalue->employee_name}}</td>
                <td data-col="first_patient" class="statistic first_patient">{{number_format($statistic_admin[$empoyeevalue->id]->first_patient,0,","," ")}}</td>
                <td data-col="recorded_patient" class="statistic recorded_patient">{{number_format($statistic_admin[$empoyeevalue->id]->recorded_patient,0,","," ")}}</td>
                <td data-col="final_patient" class="statistic final_patient">{{number_format($statistic_admin[$empoyeevalue->id]->final_patient,0,","," ")}}</td>
            </tr>
            @else
            <tr data-org="{{$empoyeevalue->organization_id}}" data-id="{{$empoyeevalue->id}}">
                @csrf

                <td scope="row" class="color_th">{{$empoyeevalue->employee_name}}</td>
                <td data-col="first_patient" class="statistic first_patient">0</td>
                <td data-col="recorded_patient" class="statistic recorded_patient">0</td>
                <td data-col="final_patient" class="statistic final_patient">0</td>
            </tr>

            @endif


            @endforeach
            <tr>
                <th scope="row" class="color_th">Total</th>
                @for($i = 0; $i<3; $i++)
                <td class="color_th">0</td>

                @endfor    
            </tr>

    @endif
      </tbody>
    </table>



    
    
    
    <h1>STATISTIC DOCTORS</h1>
    
    
    <table class="table doctor_stat">
        <thead>
            <tr>
                <th scope="row" class="color_th">Statistic</th>
                <th scope="row" class="color_th">First Consulting</th>
                <th scope="row" class="color_th">First Therapy</th>
                <th scope="row" class="color_th">Total Therapy</th>
                <th scope="row" class="color_th">Schedule time</th>
                <th scope="row" class="color_th">Spent Time</th>
                <th scope="row" class="color_th">Turnover</th>
                <th scope="row" class="color_th">Clients</th>
                 <th scope="row" class="color_th">Specialization</th>
            </tr>
        </thead>
        <tbody>

    @if(count($statistic_doc)<1 && count($employee_doctor)>0)


            @foreach($employee_doctor as $key => $value) 

            <tr data-spec="{{$value->specializ_id}}" data-org="{{$value->organization_id}}" data-id="{{$value->employee_id}}">
                @csrf
                <td scope="row" class="color_th">{{$value->employee_name}}</td>
                <td data-col="first_consulting" class="statistic_doc first_consulting">0</td>
                <td data-col="first_therapy" class="statistic_doc first_therapy">0</td>
                <td data-col="total_therapy" class="statistic_doc total_therapy">0</td>
                <td data-col="schedule_time" class="statistic_doc schedule_time">0</td>
                <td data-col="spent_time" class="statistic_doc spent_time">0</td>
                <td data-col="turnover" class="statistic_doc turnover">0</td>
                <td data-col="clients" class="statistic_doc clients">0</td>
                <td data-col="clients" class="specializ">{{$value->specialization}}</td>
            </tr>

            @endforeach
            <tr>
                <th scope="row" class="color_th">Total</th>
                @for($k = 0; $k<7; $k++)
                <td class="color_th">0</td>

                @endfor 
                <td class="color_th">---</td>
            </tr>

    @else


            @foreach($employee_doctor as $keyemp => $empoyeevalue)


            @if(isset($statistic_doc[$empoyeevalue->id]))

            <tr data-spec="{{$empoyeevalue->specializ_id}}" data-org="{{$statistic_doc[$empoyeevalue->id]->organization_id}}" data-id="{{$statistic_doc[$empoyeevalue->id]->employee_id}}">
                @csrf

                <td scope="row" class="color_th">{{$empoyeevalue->employee_name}}</td>
                <td data-col="first_consulting" class="statistic_doc first_consulting">{{number_format($statistic_doc[$empoyeevalue->id]->first_consulting,0,","," ")}}</td>
                <td data-col="first_therapy" class="statistic_doc first_therapy">{{number_format($statistic_doc[$empoyeevalue->id]->first_therapy,0,","," ")}}</td>
                <td data-col="total_therapy" class="statistic_doc total_therapy">{{number_format($statistic_doc[$empoyeevalue->id]->total_therapy,0,","," ")}}</td>
                <td data-col="schedule_time" class="statistic_doc schedule_time">{{number_format($statistic_doc[$empoyeevalue->id]->schedule_time,0,","," ")}}</td>
                <td data-col="spent_time" class="statistic_doc spent_time">{{number_format($statistic_doc[$empoyeevalue->id]->spent_time,0,","," ")}}</td>
                <td data-col="turnover" class="statistic_doc turnover">{{number_format($statistic_doc[$empoyeevalue->id]->turnover,0,","," ")}}</td>
                <td data-col="clients" class="statistic_doc clients">{{number_format($statistic_doc[$empoyeevalue->id]->clients,0,","," ")}}</td>
                <td data-col="clients" class="specializ">{{$statistic_doc[$empoyeevalue->id]->specialization}}</td>
            </tr>
            @else
            <tr data-spec="{{$value->specializ_id}}" data-org="{{$empoyeevalue->organization_id}}" data-id="{{$empoyeevalue->id}}">
                @csrf
                <td scope="row" class="color_th">{{$value->employee_name}}</td>
                <td data-col="first_consulting" class="statistic_doc first_consulting">0</td>
                <td data-col="first_therapy" class="statistic_doc first_therapy">0</td>
                <td data-col="total_therapy" class="statistic_doc total_therapy">0</td>
                <td data-col="schedule_time" class="statistic_doc schedule_time">0</td>
                <td data-col="spent_time" class="statistic_doc spent_time">0</td>
                <td data-col="turnover" class="statistic_doc turnover">0</td>
                <td data-col="clients" class="statistic_doc clients">0</td>
                <td data-col="clients" class="specializ">{{$value->specialization}}</td>
            </tr>

            @endif


            @endforeach
            <tr>
                <th scope="row" class="color_th">Total</th>
                @for($j = 0; $j<7; $j++)
                <td class="color_th">0</td>
                @endfor 
                <td class="color_th">---</td>
            </tr>


        </tbody>
    </table>

    @endif

    
    
    
    
    

    <h1>STATISTIC SPECIALIZ</h1>

    
    <table class="table statistic_spec">
        <thead>
            <tr>
                <th scope="row" class="color_th">Statistic</th>
                <th scope="row" class="color_th">First Consulting</th>
                <th scope="row" class="color_th">First Therapy</th>
                <th scope="row" class="color_th">Total Therapy</th>
                <th scope="row" class="color_th">Schedule time</th>
                <th scope="row" class="color_th">Spent Time</th>
                <th scope="row" class="color_th">Turnover</th>
                <th scope="row" class="color_th">Clients</th>
            </tr>
        </thead>
        <tbody>

            @foreach($statistic_specializ as $keyspec => $specialization)


            <tr>
                <td scope="row" class="color_th">{{$specialization['specialization']}}</td>
                <td data-col="first_consulting" class="statistic_spec first_consulting_spec">{{number_format($specialization['sum(first_consulting)'],0,","," ")}}</td>
                <td data-col="first_therapy" class="statistic_spec first_therapy_spec">{{number_format($specialization['sum(first_therapy)'],0,","," ")}}</td>
                <td data-col="total_therapy" class="statistic_spec total_therapy_spec">{{number_format($specialization['sum(total_therapy)'],0,","," ")}}</td>
                <td data-col="schedule_time" class="statistic_spec schedule_time_spec">{{number_format($specialization['sum(schedule_time)'],0,","," ")}}</td>
                <td data-col="spent_time" class="statistic_spec spent_time_spec">{{number_format($specialization['sum(spent_time)'],0,","," ")}}</td>
                <td data-col="turnover" class="statistic_spec turnover_spec">{{number_format($specialization['sum(turnover)'],0,","," ")}}</td>
                <td data-col="clients" class="statistic_spec clients_spec">{{number_format($specialization['sum(clients)'],0,","," ")}}</td>
              
            </tr>

            @endforeach
            <tr>
                <th scope="row" class="color_th">Total</th>
                @for($j = 0; $j<7; $j++)
                <td class="color_th">0</td>
                @endfor 
               
            </tr>


        </tbody>
    </table>


</div>

@endsection