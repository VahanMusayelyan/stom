@extends('layout1')


@section('content')
<div class="form-div-add employee_div">
    <div class="container-admin">
        <div class="form-horizontal" id="myform4">
                  
            @foreach($result as $value)
       
                <form action="{{route('employees.update',$value['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                <div class="form-group employee-div name_employee fisrt-div">
                    <label class="control-label col-sm-2" for="employee_name">Имя Фамилия</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control employee" value="<?= $value->employee_name ?>" id="employee_name" name="employee_name" autocomplete="off">
                    </div>
                </div>


                <div class="form-group employee-div second-div">
                    <label class="control-label col-sm-2" for="org">Организации</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-multiple selectpicker" id="org_add" name="org[]" multiple="multiple">
                             <?php
                                foreach ($organizations as $keys => $org) {

                                    if (isset($array_org[$org->id])) {
                                        echo "<option value=" . $org->id . " selected='selected'>" . $org->org_name . "</option>";
                                    } else {
                                        echo "<option value=" . $org->id . ">" . $org->org_name . "</option>";
                                    }
                                }
                                ?>
                        </select>
                    </div>
                </div>




                <div class="form-group employee-div">
                    <label class="control-label col-sm-2 labelSpec" for="spec">Специализации</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single" name="spec">
                            @foreach($specializations as $key => $spec)
                                @if($value->specializ_id == $spec->id)
                                <option value="<?= $spec->id ?>" selected="selected"><?= $spec->specialization ?></option>
                                @else
                                <option value="<?= $spec->id ?>"><?= $spec->specialization ?></option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>


                <div class="butbut">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary search-btn add-employee-info">Обновить</button>
                    </div>
                </div>
                </form>
          
            @endforeach
            
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


@endsection