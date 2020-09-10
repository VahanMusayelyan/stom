<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stom</title>

        <!-- Styles -->
        <link href="{{'/css/bootstrap/bootstrap.min.css'}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.0/css/all.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{'/css/style.css'}}" rel="stylesheet">
        <link href="{{'/css/simple-sidebar.css'}}" rel="stylesheet">
        <link href="{{'/css/reference.css'}}" rel="stylesheet">
        <link href="{{'/css/login-register.css'}}" rel="stylesheet">
        <link href="{{'/css/intlTelInput.css'}}" rel="stylesheet">
        <link href="{{'/css/font-awesome.min.css'}}" rel="stylesheet">
        <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />

        <!-- Scripts -->
        <script src="{{'/js/jquery.min.js'}}"></script>
        <script src="{{'/js/bootstrap/bootstrap.js'}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script src="{{'/js/main.js'}}"></script>
        <script src="{{'/js/statistic.js'}}"></script>
        <script src="{{'/js/reference.js'}}"></script>
        <script src="{{'/js/semantic.min.js'}}"></script>
        <script src="{{'/js/intlTelInput.js'}}"></script>
        <script src="{{'/js/indicator.js'}}"></script>
        <script src="{{'/js/js.js'}}"></script>


    </head>
    <body>
        <?php
        if (Auth::user()->user_active == 0 && Auth::user()->role_id == 2) {
            $class = "no-active-org";
        } else {
            if (session()->has('org_name')) {
                $class = "active-org";
            } else {
                $class = "no-active-org";
            }
        }
        ?>
        @if(Auth::user()->role_id == 2)
        <div class="navbar">
            @csrf
            <div class="clinics_link">
                <button class="add add_clinic"><a href="/organizations/create"><img src="/images/circle_add.svg">Добавить Клинику</a></button>
                <br>
                <button class="dropdown" data-name="{{Auth::user()->id}}" data-value="0" data-org="<? if (session()->has('org_id')) echo session()->get('org_id'); ?>">
                    @if(Request::path() == 'organizations')
                    <a class="organiz_link active_menu" href="/organizations">Клиники</a>
                    @else
                    <a class="organiz_link" href="/organizations">Клиники</a>
                    @endif
                    <img class='dropdown_list clinic_dropdown' src="/images/down.svg">
                </button>
            </div>
            <div class="admins_link">
                <button class="add add_admin"><a href="/employees/administrators"><img src="/images/circle_add.svg">Добавить Администратора</a></button>
                <br>
                <button class="btn_menu" data-name="{{Auth::user()->id}}" data-value="1"  data-org="<? if (session()->has('org_id')) echo session()->get('org_id'); ?>">
                    @if(Request::path() == 'employees/admin')
                    <a class="admin_link active_menu" href="/employees/admin">Администраторы</a>
                    @else
                    <a class="admin_link" href="/employees/admin">Администраторы</a>
                    @endif
                </button>
            </div>
            <div class="doctors_link">
                <button class="add add_doctor"><a href="/employees/doctors"><img src="/images/circle_add.svg">Добавить Врача</a></button>                 
                <br>
                <button class="btn_menu" data-name="{{Auth::user()->id}}" data-value="2"  data-org="<? if (session()->has('org_id')) echo session()->get('org_id'); ?>">
                    @if(Request::path() == 'employees/doctor')
                    <a class="doctor_link active_menu" href="/employees/doctor">Врачи</a>
                    @else 
                    <a class="doctor_link" href="/employees/doctor">Врачи</a>
                    @endif 
                </button>
            </div> 
            <div class="info">
                <span class="name_user">
                    {{Auth::user()->name}}
                </span>
                <div class="profile">
                    <img src="/images/user.svg">
                </div>
            </div>
        </div>


        @else

        <div class="navbar">
            <div class="link_a user_link">
                <a href="/users" class="link_users" data-value="0">Клиенты</a>                
            </div>
            <div class="link_a doctor_link">
                <a href="/reference" class="link_reference_doctor">Референсы</a>
            </div>
            <div class="link_a spec_link">
                <a href="/specializations" class="link_reference_doctor">Специализации</a>
            </div>

            <div class="info">
                <span class="name_user">
                    {{Auth::user()->name}}
                </span>
                <div class="profile">
                    <img src="/images/user.svg">
                </div>
            </div>


        </div>
        @endif


        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            @if(session()->has('org_name'))
            <div class="sidebar-heading"><a class="clinic_link_details" href="/organizations/{{session()->get('org_id')}}">{{session()->get('org_name')}}</a></div>
            @else
            <div class="sidebar-heading {{$class}}">Выберите клинику</div>
            @endif

            <div class="list-group list-group-flush {{$class}}">
                <div class="header-div border-active-bottom"><p class="catalog"><img class="feather-edit" src="/images/Icon-feather-edit.svg">Ввод данных</p></div>
                @if(Request::path() == 'statistics-doctor' || Request::path() == 'statistics-doctor-add')
                <a href="/statistics-doctor" class="doctor active">Врачи</a>
                @else
                <a href="/statistics-doctor" class="doctor">Врачи</a>
                @endif
                @if(Request::path() == 'statistics-admin' || Request::path() == 'statistics-admin-add')
                <a href="/statistics-admin" class="admin active">Администраторы</a>
                @else
                <a href="/statistics-admin" class="admin">Администраторы</a>
                @endif

            </div>
            <hr class="catalog-hr">

            <div class="list-group list-group-flush  {{$class}}">
                <div class="header-div"><p class="statistic"><img class="feather-statistic" src="/images/marketing.svg">Статистика</p></div>
                @if(Request::path() == 'indicators-doctor')
                <a href="/indicators-doctor" class="doctor active">Врачи</a>
                @else
                <a href="/indicators-doctor" class="doctor">Врачи</a>
                @endif
                @if(Request::path() == 'indicators-admin')
                <a href="/indicators-admin" class="admin active">Администраторы</a>
                @else
                <a href="/indicators-admin" class="admin">Администраторы</a>
                @endif
                @if(Request::path() == 'indicators-specialization')
                <a href="/indicators-specialization" class="spec active">Специализации</a>
                @else
                <a href="/indicators-specialization" class="admin ">Специализации</a>
                @endif

            </div>

            <div class="list-group list-group-flush sett-log-div">
           <a href="#" class="settings"><!--<img class="feather-settings" src="/images/ajustes.svg">--></a>
                <a href="/logout" class="logout"><img class="feather-logout" src="/images/flecha.svg">Выйти</a>

            </div>
        </div>







        @include('messages')
        @yield('content')



    </body>
</html>
