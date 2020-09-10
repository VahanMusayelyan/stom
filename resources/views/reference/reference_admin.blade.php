@extends('layout1')

@section('content')

 <div class="container_div">
       
            <div class="header">Реферанс Администраторов</div>
            <div class="form-group reference-div">

                <select class="form-control selectpicker select-for-reference" id="sel1" name="city">
                    <option value="" disabled selected>Город</option>
                    @foreach($cities as $key => $value)
                    <option value="<?= $value->id ?>"><?= $value->city ?></option>
                    @endforeach
                </select>
                <select class="form-control selectpicker select-for-reference" id="sel11" name="class">
                    <option value="" disabled selected>Класс</option>
                    @foreach($classes as $key => $value)
                    <option value="<?= $value->id ?>"><?= $value->class_name ?></option>
                    @endforeach
                </select>
                <select class="form-control selectpicker select-for-reference" id="sel12" name="specialization">
                    <option value="" disabled selected>Специализации</option>
                    @foreach($specializations as $key => $value)
                    <option value="<?= $value->id ?>"><?= $value->specialization ?></option>
                    @endforeach
                </select>
                <button class="btn btn-primary search-btn">Показать</button>
            </div>
            


            <div class="table-div table-div-doctor reference_admin">

                <table class="table table-head table1">
                    <thead>
						<tr>
							<th scope="row" class="color_th">Administrator</th>
							<th scope="row" class="color_th">Conversion 1</th>
							<th scope="row" class="color_th">Conversion 2</th>
							<th scope="row" class="color_th">Conversion 3</th>
						</tr>
					</thead>
                </table>
                
                <table class="table table-value table1 reference_admin">
				@csrf
                    <tbody>
                  
							
							

            <tr data-number="{{$reference_admin[0]->id}}" >
                <td class="color_th">Normal</td>
                <td class="conversion conversion1_normal"><div class="value"><span>{{$reference_admin[0]->conversion1_normal}}</span><span class="property">%</span></td>
                <td class="conversion conversion2_normal"><div class="value"><span>{{$reference_admin[0]->conversion2_normal}}</span><span class="property">%</span></td>
                <td class="conversion conversion3_normal"><div class="value"><span>{{$reference_admin[0]->conversion3_normal}}</span><span class="property">%</span></td>


            </tr>
            <tr data-number="{{$reference_admin[0]->id}}" >
                <td class="color_th">Good</td>
                <td  class="conversion conversion1_good"><div class="value"><span>{{$reference_admin[0]->conversion1_good}}</span><span class="property">%</span></td>
                <td  class="conversion conversion2_good"><div class="value"><span>{{$reference_admin[0]->conversion2_good}}</span><span class="property">%</span></td>
                <td  class="conversion conversion3_good"><div class="value"><span>{{$reference_admin[0]->conversion3_good}}</span><span class="property">%</span></td>

            </tr>
						
				






  
                    </tbody>
                </table>
				

        
	</div>
	</div>





@endsection