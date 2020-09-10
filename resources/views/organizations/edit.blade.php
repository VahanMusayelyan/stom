@extends('layout1')


@section('content')
<script>
    $('.nav-link').removeClass('active');
    $('#org').addClass('active');
</script>

<div class="form-div-add organization_div">
    <div class="container-admin">
        <div class="form-horizontal">
           
                <form action="{{route('organizations.update',$result['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
 
                    <div class="form-group organization-div name_organiz">
                    <label class="control-label col-sm-2" for="name_organiz">Название организации</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control org" id="name_organiz" value="{{$result->org_name}}" name="name_organiz" autocomplete="off">
                    </div>
                </div>


                <div class="form-group organization-div type_organiz">
                    <label class="control-label col-sm-2 labelCategory" for="category">Тип организации</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single org selectpicker" name="ownership">
                             @foreach($ownership as $key => $value)
                                @if($result->ownership_type_id == $value->id)
                                <option value="<?= $value->id ?>" selected="selected"><?= $value->organiz_type ?></option>
                                @else
                                <option value="<?= $value->id ?>" ><?= $value->organiz_type ?></option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group organization-div country_name">
                    <label class="control-label col-sm-2 labelCountry" for="country">Страна</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single org selectpicker" name="country">
                             @foreach($countries as $key => $country)
                                @if($result->country_id == $country->id)
                                <option value="<?= $country->id ?>" selected="selected"><?= $country->country ?></option>
                                @else
                                <option value="<?= $country->id ?>" ><?= $value->country ?></option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group organization-div region_name">
                    <label class="control-label col-sm-2 labelRegion" for="region">Oбласть</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single org selectpicker" name="region">
                           @foreach($regions as $key => $region)
                                @if($result->region_id == $region->id)
                                <option value="<?= $region->id ?>" selected="selected"><?= $region->region ?></option>
                                @else
                                <option value="<?= $region->id ?>" ><?= $value->region ?></option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group organization-div city_name">
                    <label class="control-label col-sm-2 labelCity" for="city">Город</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single org selectpicker" name="city">
                                @foreach($cities as $key => $city)
                                @if($result->city_id == $city->id)
                                <option value="<?= $city->id ?>" selected="selected"><?= $city->city ?></option>
                                @else
                                <option value="<?= $city->id ?>" ><?= $city->city ?></option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group organization-div class_name">
                    <label class="control-label col-sm-2 labelCity" for="city">Класс</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single org selectpicker" name="class">
                             @foreach($classes as $key => $class)
                                @if($result->org_class_id == $class->id)
                                <option value="<?= $class->id ?>" selected="selected"><?= $class->class_name ?></option>
                                @else
                                <option value="<?= $class->id ?>" ><?= $class->class_name ?></option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text1">Если рассчитано-укажите долю каждой специальности в вале клиники(%)</label>
                    <textarea name="organization_data1" class="form-control textarea-organization" id="text1" rows="3"><?= $result->organization_data1 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text2">Опишите принцип начисления заработной платы врачей и администраторов.</label>
                    <textarea name="organization_data2" class="form-control textarea-organization" id="text2" rows="3"><?= $result->organization_data2 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text3">Опишите механизмы работы с базой клиники</label>
                    <textarea name="organization_data3" class="form-control textarea-organization" id="text3" rows="3"><?= $result->organization_data3 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text4">Есть ли в клинике скрипты для администраторов?</label>
                    <textarea name="organization_data4" class="form-control textarea-organization" id="text4" rows="3"><?= $result->organization_data4 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text5">Какие отчеты вы анализируете для принятия управленческих решений?</label>
                    <textarea name="organization_data5" class="form-control textarea-organization" id="text5" rows="3"><?= $result->organization_data5 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text6">Кто составляет эти отчЁты для вас?</label>
                    <textarea name="organization_data6" class="form-control textarea-organization" id="text6" rows="3"><?= $result->organization_data6 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text7">Кто в клинике ведёт и ведёт ли соцсети?</label>
                    <textarea name="organization_data7" class="form-control textarea-organization" id="text7" rows="3"><?= $result->organization_data7 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text8">Есть ли в аккаунты в соцсетях у врачей?</label>
                    <textarea name="organization_data8" class="form-control textarea-organization" id="text8" rows="3"><?= $result->organization_data8 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text9">Какие статистические показатели клиники вы высчитываете и анализируете</label>
                    <textarea name="organization_data9" class="form-control textarea-organization" id="text9" rows="3"><?= $result->organization_data9 ?></textarea>
                </div>
                <div class="form-group organization-div">
                    <label class="text" for="text10">Дополнительный (запасной)</label>
                    <textarea name="organization_data10" class="form-control textarea-organization" id="text10" rows="3"><?= $result->organization_data10 ?></textarea>
                </div>



                <div class="form-group organization-div butbut">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary search-btn add-organization-info">Обновить</button>
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


@endsection