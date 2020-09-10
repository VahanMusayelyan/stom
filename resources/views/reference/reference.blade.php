@extends('layout1')

@section('content')

<div class="container_div">

    <div class="header">Реферанс</div>
    <div class="form-group reference-div">
        <form action="/reference-list" method="post" enctype="multipart/form-data">
            @csrf
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

            <button class="btn btn-primary search-btn">Показать</button>
        </form>
    </div>







</div>
</div>





@endsection