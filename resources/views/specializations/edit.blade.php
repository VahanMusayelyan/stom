@extends('layout1')


@section('content')

 <div class="container_div">
    <div class="container-admin">
        <div class="form-horizontal" id="myform6">
            <div class="table-div table-div-doctor specialization">
                @foreach($result as $value)
                

                <form action="{{route('specializations.update',$value->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group"> 
                        <label class="control-label col-sm-2" for="specializations_edit">Специализация:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control speiializ_edit" value="<?= $value->specialization ?>" id="specializations_edit" placeholder="Enter specialization" name="specialization_edit" autocomplete="specializations_editoff">
                        </div>
                    </div>


                    <div class="form-group butbut update_spec">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Обновить</button>
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
</div>

@endsection