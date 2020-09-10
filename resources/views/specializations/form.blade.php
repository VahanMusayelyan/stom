@extends('layout1')


@section('content')
<div class="container_div">
    <div class="container-admin">
        <div class="form-horizontal" id="myform6">
            <div class="table-div table-div-doctor specialization">


                <form action="{{route('specializations.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="specializations">Специализация:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control speiializ_add" id="specializations" name="specialization" autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group butbut add_specialization">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Создать</button>
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