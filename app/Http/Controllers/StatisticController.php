<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Organization;
use App\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;
use App\StatisticDoctor;
use App\StatisticAdmin;

class StatisticController extends AppController {

    public function index(Request $request) {
        $specialization = DB::table('specializ_types')->select()->get()->toArray();
        $specializ_id = 0;
        $search = "";
        $messege = "";
        $message_result = "";
        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];

        if ($request->first_data) {
            $data_first = $request->first_data;
            $month_year1 = explode(' ', $data_first);
            $key1 = array_search($month_year1[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
        } else {

            $data_first = date('Y-m-01');
        }

        if ($request->specialization) {
            $specializ_id = $request->specialization;

            if ($request->search) {
                $search = $request->search;
                $statistic_doctors = DB::table('statistic_doctors')->select()
                                ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->where('employees.employee_active', 1)
                                ->where('statistic_doctors.organization_id', $organization_id)
                                ->where('statistic_doctors.specializ_id', $specializ_id)
                                ->where('statistic_doctors.date', $data_first)
                                ->where('employees.employee_name', 'LIKE', "%$search%")
                                ->get()->toArray();

                $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', $specializ_id)->where('employees.employee_active', 1)->where('employees.employee_name', 'LIKE', "%$search%")
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                                ->get()->toArray();

                if (empty($employee_doctor)) {
                    $messege = "Результат не найден";
                    $statistic_doctors = DB::table('statistic_doctors')->select()
                                    ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                    ->where('employees.employee_active', 1)
                                    ->where('statistic_doctors.organization_id', $organization_id)
                                    ->where('statistic_doctors.specializ_id', $specializ_id)
                                    ->where('statistic_doctors.date', $data_first)
                                    ->get()->toArray();

                    $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', $specializ_id)->where('employees.employee_active', 1)
                                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                    ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                                    ->get()->toArray();
                }
            } else {

                $statistic_doctors = DB::table('statistic_doctors')->select()
                                ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->where('employees.employee_active', 1)
                                ->where('statistic_doctors.organization_id', $organization_id)
                                ->where('statistic_doctors.specializ_id', $specializ_id)
                                ->where('statistic_doctors.date', $data_first)
                                ->get()->toArray();

                $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', $specializ_id)->where('employees.employee_active', 1)
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                                ->get()->toArray();
            }
        } else {
            if ($request->search) {
                $search = $request->search;
                $statistic_doctors = DB::table('statistic_doctors')->select()
                                ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->where('employees.employee_active', 1)
                                ->where('statistic_doctors.organization_id', $organization_id)
                                ->where('statistic_doctors.specializ_id', '<>', 1)
                                ->where('statistic_doctors.date', $data_first)
                                ->where('employees.employee_name', 'LIKE', "%$search%")
                                ->get()->toArray();

                $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', '<>', 1)->where('employees.employee_active', 1)->where('employees.employee_name', 'LIKE', "%$search%")
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                                ->get()->toArray();


                if (empty($employee_doctor)) {
                    $messege = "Результат не найден";
                    $statistic_doctors = DB::table('statistic_doctors')->select()
                                    ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                    ->where('employees.employee_active', 1)
                                    ->where('statistic_doctors.organization_id', $organization_id)
                                    ->where('statistic_doctors.specializ_id', '<>', 1)
                                    ->where('statistic_doctors.date', $data_first)
                                    ->get()->toArray();

                    $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', '<>', 1)->where('employees.employee_active', 1)
                                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                    ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                                    ->get()->toArray();
                }
            } else {
                $statistic_doctors = DB::table('statistic_doctors')->select()
                                ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->where('employees.employee_active', 1)
                                ->where('statistic_doctors.organization_id', $organization_id)
                                ->where('statistic_doctors.specializ_id', '<>', 1)
                                ->where('statistic_doctors.date', $data_first)
                                ->get()->toArray();

                $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', '<>', 1)->where('employees.employee_active', 1)
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                                ->get()->toArray();
            }
        }

        $statistic_doc = [];
        if (isset($statistic_doctors)) {
            foreach ($statistic_doctors as $key => $value) {
                $statistic_doc[$value->employee_id] = $value;
            }
        }

        return view('statistics.statistics_doctor', [
            'statistic_doc' => $statistic_doc,
            'employee_doctor' => $employee_doctor,
            'specialization' => $specialization,
            'data_first' => $data_first,
            'messege' => $messege,
            'search' => $search,
            'specializ_id' => $specializ_id
        ]);
    }

    public function admin(Request $request) {
        $search = "";
        $messege = "";
        $message_result = "";
        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];

        if ($request->first_data) {
            $data_first = $request->first_data;
            $month_year1 = explode(' ', $data_first);
            $key1 = array_search($month_year1[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
        } else {

            $data_first = date('Y-m-01');
        }

        if ($request->search) {
            $search = $request->search;
            $statistic_admins = DB::table('statistic_admins')->select()
                            ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_admins.organization_id', $organization_id)
                            ->where('statistic_admins.specializ_id', 1)
                            ->where('statistic_admins.date', $data_first)
                            ->where('employees.employee_name', 'LIKE', "%$search%")
                            ->get()->toArray();

            $employee_admin = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', 1)->where('employees.employee_active', 1)->where('employees.employee_name', 'LIKE', "%$search%")
                            ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                            ->get()->toArray();

            if (empty($employee_admin)) {
                $messege = "Результат не найден";
                $statistic_admins = DB::table('statistic_admins')->select()
                                ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                                ->where('employees.employee_active', 1)
                                ->where('statistic_admins.organization_id', $organization_id)
                                ->where('statistic_admins.specializ_id', 1)
                                ->where('statistic_admins.date', $data_first)
                                ->get()->toArray();

                $employee_admin = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', 1)->where('employees.employee_active', 1)
                                ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                                ->get()->toArray();
            }
        } else {
            $statistic_admins = DB::table('statistic_admins')->select()
                            ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_admins.organization_id', $organization_id)
                            ->where('statistic_admins.specializ_id', 1)
                            ->where('statistic_admins.date', $data_first)
                            ->get()->toArray();

            $employee_admin = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', 1)->where('employees.employee_active', 1)
                            ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                            ->get()->toArray();
        }

        $statistic_admin = [];
        if (isset($statistic_admins)) {
            foreach ($statistic_admins as $key => $value) {
                $statistic_admin[$value->employee_id] = $value;
            }
        }

        return view('statistics.statistics_admin', ['statistic_admin' => $statistic_admin,
            'employee_admin' => $employee_admin,
            'search' => $search,
            'messege' => $messege,
            'message_result' => $message_result,
            'data_first' => $data_first
        ]);
    }

    public function specialization(Request $request) {

        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];

        if ($request->first_data) {
            $data_first = $request->first_data;
            $month_year1 = explode(' ', $data_first);
            $key1 = array_search($month_year1[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
        } else {

            $data_first = date('Y-m-01');
        }

        $statistic_specializ = StatisticDoctor::select('specializ_types.specialization')->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                        ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                        ->where('employees.employee_active', 1)
                        ->where('statistic_doctors.organization_id', $organization_id)
                        ->where('statistic_doctors.specializ_id', '<>', 1)
                        ->where('statistic_doctors.date', $data_first)
                        ->groupBy('statistic_doctors.specializ_id')
                        ->selectRaw('sum(first_consulting)')
                        ->selectRaw('sum(first_therapy)')
                        ->selectRaw('sum(total_therapy)')
                        ->selectRaw('sum(schedule_time)')
                        ->selectRaw('sum(spent_time)')
                        ->selectRaw('sum(turnover)')
                        ->selectRaw('sum(clients)')
                        ->get()->toArray();

        return view('statistics.statistics_specialization', ['statistic_specializ' => $statistic_specializ, 'data_first' => $data_first]);
    }

    public function adminstatadd(Request $request) {
        $search = "";
        $messege = "";
        $message_result = "";
        $org = session()->get('org_id');
        $data_first = $request->first_data;
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];

        if (empty($data_first)) {
            $data_first = date('Y-m-01');
        } else {
            $data_first = $request->first_data;
            $month_year1 = explode(' ', $data_first);
            $key1 = array_search($month_year1[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
        }

        $colum_number = $request->colum_number;
        $first_patient = str_replace(' ', '', $request->first_patient);
        $recorded_patient = str_replace(' ', '', $request->recorded_patient);
        $final_patient = str_replace(' ', '', $request->final_patient);

        foreach ($colum_number as $key => $value) {

            $result = StatisticAdmin::where('employee_id', $value)->where('organization_id', $org)->where('date', "=", $data_first)->get()->toArray();

            if (count($result) > 0) {

                StatisticAdmin::where('employee_id', $value)->where('organization_id', $org)->where('date', "=", $data_first)->update([
                    "first_patient" => $first_patient[$key],
                    "recorded_patient" => $recorded_patient[$key],
                    "final_patient" => $final_patient[$key]
                ]);
            } else {
                if ($first_patient[$key] == '') {
                    $first_patient[$key] = null;
                }

                if ($recorded_patient[$key] == '') {
                    $recorded_patient[$key] = null;
                }
                if ($final_patient[$key] == '') {
                    $final_patient[$key] = null;
                }
                StatisticAdmin::insert([
                    'organization_id' => $org,
                    'employee_id' => $value,
                    'specializ_id' => '1',
                    'date' => $data_first,
                    "first_patient" => $first_patient[$key],
                    "recorded_patient" => $recorded_patient[$key],
                    "final_patient" => $final_patient[$key]
                ]);
            }
        }

        $statistic_admins = DB::table('statistic_admins')->select()
                        ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                        ->where('employees.employee_active', 1)
                        ->where('statistic_admins.organization_id', $org)
                        ->where('statistic_admins.specializ_id', 1)
                        ->where('statistic_admins.date', $data_first)
                        ->get()->toArray();

        $employee_admin = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', 1)->where('employees.employee_active', 1)
                        ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $org)
                        ->get()->toArray();

        $statistic_admin = [];
        if (isset($statistic_admins)) {
            foreach ($statistic_admins as $key => $value) {
                $statistic_admin[$value->employee_id] = $value;
            }
        }

        $message_result = 'Данные сохранились успешно';
        return view('statistics.statistics_admin', ['statistic_admin' => $statistic_admin,
            'employee_admin' => $employee_admin,
            'search' => $search,
            'messege' => $messege,
            'message_result' => $message_result,
            'data_first' => $data_first
        ]);
    }

    public function doctorstatadd(Request $request) {
        $specializ_id = 0;
        $search = "";
        $messege = "";
        $message_result = "";
        $org = session()->get('org_id');
        $data_first = $request->first_data;
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];
        $spec_id = $request->specializ;
        $specializ_id = $request->specialization;
        $specialization = DB::table('specializ_types')->select()->get()->toArray();

        if (empty($data_first)) {
            $data_first = date('Y-m-01');
        } else {
            $data_first = $request->first_data;
            $month_year1 = explode(' ', $data_first);
            $key1 = array_search($month_year1[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
        }

        if ($request->colum_number) {
            $colum_number = $request->colum_number;
            $first_consulting = str_replace(' ', '', $request->first_consulting);
            $first_therapy = str_replace(' ', '', $request->first_therapy);
            $total_therapy = str_replace(' ', '', $request->total_therapy);
            $schedule_time = str_replace(' ', '', $request->schedule_time);
            $spent_time = str_replace(' ', '', $request->spent_time);
            $turnover = str_replace(' ', '', $request->turnover);
            $clients = str_replace(' ', '', $request->clients);

            foreach ($colum_number as $key => $value) {

                $result = StatisticDoctor::where('employee_id', $value)->where('organization_id', $org)->where('date', $data_first)->get()->toArray();

                if (count($result) > 0) {

                    $result = StatisticDoctor::where('employee_id', $value)->where('organization_id', $org)->where('date', $data_first)->update([
                        "first_consulting" => $first_consulting[$key],
                        "first_therapy" => $first_therapy[$key],
                        "total_therapy" => $total_therapy[$key],
                        "schedule_time" => $schedule_time[$key],
                        "spent_time" => $spent_time[$key],
                        "turnover" => $turnover[$key],
                        "clients" => $clients[$key]
                    ]);
                } else {
                    if ($first_consulting[$key] == '') {
                        $first_consulting[$key] = null;
                    }

                    if ($first_therapy[$key] == '') {
                        $first_therapy[$key] = null;
                    }
                    if ($total_therapy[$key] == '') {
                        $total_therapy[$key] = null;
                    }
                    if ($schedule_time[$key] == '') {
                        $schedule_time[$key] = null;
                    }
                    if ($spent_time[$key] == '') {
                        $spent_time[$key] = null;
                    }
                    if ($turnover[$key] == '') {
                        $turnover[$key] = null;
                    }
                    if ($clients[$key] == '') {
                        $clients[$key] = null;
                    }
                    $result = StatisticDoctor::insert([
                                'organization_id' => $org,
                                'employee_id' => $value,
                                'specializ_id' => $spec_id[$key],
                                'date' => $data_first,
                                "first_consulting" => $first_consulting[$key],
                                "first_therapy" => $first_therapy[$key],
                                "total_therapy" => $total_therapy[$key],
                                "schedule_time" => $schedule_time[$key],
                                "spent_time" => $spent_time[$key],
                                "turnover" => $turnover[$key],
                                "clients" => $clients[$key]
                    ]);
                }
            }
        }

        if ($specializ_id > 0) {
            $statistic_doctors = DB::table('statistic_doctors')->select()
                            ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_doctors.organization_id', $org)
                            ->where('statistic_doctors.specializ_id', $specializ_id)
                            ->where('statistic_doctors.date', $data_first)
                            ->get()->toArray();

            $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', $specializ_id)->where('employees.employee_active', 1)
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $org)
                            ->get()->toArray();
        } else {
            $statistic_doctors = DB::table('statistic_doctors')->select()
                            ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_doctors.organization_id', $org)
                            ->where('statistic_doctors.specializ_id', '<>', 1)
                            ->where('statistic_doctors.date', $data_first)
                            ->get()->toArray();

            $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', '<>', 1)->where('employees.employee_active', 1)
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $org)
                            ->get()->toArray();
        }

        $statistic_doc = [];
        if (isset($statistic_doctors)) {
            foreach ($statistic_doctors as $key => $value) {
                $statistic_doc[$value->employee_id] = $value;
            }
        }

        $message_result = 'Данные сохранились успешно';

        return view('statistics.statistics_doctor', [
            'statistic_doc' => $statistic_doc,
            'employee_doctor' => $employee_doctor,
            'specialization' => $specialization,
            'specializ_id' => $specializ_id,
            'data_first' => $data_first,
            'messege' => $messege,
            'message_result' => $message_result,
            'search' => $search
        ]);
    }

}
