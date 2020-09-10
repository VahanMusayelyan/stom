@extends('layout1')


@section('content')

<div class="form-div-add employee_div">
    <div class="container-admin">
        <div class="form-horizontal" id="myform4">

            <form action="{{route('employees.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group employee-div name_employee fisrt-div">
                    <label class="control-label col-sm-2" for="employee_name">Имя Фамилия</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control employee" id="employee_name" name="employee_name" autocomplete="off">
                    </div>
                </div>


                <div class="form-group employee-div second-div">
                    <label class="control-label col-sm-2" for="org">Организации</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-multiple selectpicker" id="org_add" name="org[]" multiple="multiple">
                            @foreach($organizations as $key => $org)
                            <option value="<?= $org->id ?>"><?= $org->org_name ?></option>
                            @endforeach
                        </select>
                    </div>
                </div>



                
                <div class="form-group employee-div">
                    
                        @if(session()->get('personal') != 1)
                        <label class="control-label col-sm-2 labelSpec" for="spec">Специализации</label>
                        <div class="col-sm-10">
                        <select class="js-example-basic-single" name="spec">
                            @foreach($specializations as $key => $spec)
                            @if($spec->id != 1)
                            <option value="<?= $spec->id ?>"><?= $spec->specialization ?></option>
                            @endif
                            @endforeach
                        </select>
                            </div>
                        @else
                        <input hidden="hidden" value="<?=$specializations[0]->id ?>" name="spec">
                        @endif
                    
                </div>


                <div class="butbut">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary search-btn add-employee-info">Создать</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
</div>

@endsection