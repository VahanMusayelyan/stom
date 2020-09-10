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
use App\DoctorReference;
use App\AdminReference;
use App\StatisticDoctor;
use App\StatisticAdmin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;

class IndicatorController extends AppController {

    public function index(Request $request) {
        $month_stat = [];
        $month_stats = [];
        $months = [];
        $search = "";
        $messege = "";
        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];
        $organization = Organization::where('id', $organization_id)->get()->toArray();
        $city_id = $organization[0]['city_id'];
        $class_id = $organization[0]['org_class_id'];
        $reference = DoctorReference::where('city_id', $city_id)->where('class_id', $class_id)->get()->toArray();
        $reference_array = [];

        foreach ($reference as $key => $value) {
            $reference_array[$value['specializ_id']] = $value;
        }

        if ($request->first_data && $request->second_data) {

            $date1 = $request->first_data;
            $date2 = $request->second_data;
            $month_year1 = explode(' ', $date1);
            $month_year2 = explode(' ', $date2);
            $key1 = array_search($month_year1[0], $array);
            $key2 = array_search($month_year2[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
            $data_second = date('Y-m-d', strtotime($month_year2[1] . "-" . $key2 . "-1"));

            if ($data_first > $data_second) {
                return back()->with('error', 'Пожалуйста выберите правильные даты');
            }

            $months_result = StatisticDoctor::select('*', 'statistic_doctors.id')
                            ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_doctors.organization_id', $organization_id)
                            ->where('statistic_doctors.specializ_id', '<>', 1)
                            ->whereBetween('statistic_doctors.date', [$data_first, $data_second])
                            ->orderBy('statistic_doctors.date')
                            ->get()->toArray();



            $k = 0;
            foreach ($months_result as $key => $value) {
                $month_array = explode("-", $value['date']);
                $month = intval($month_array[1]);

                $months[$array[$month]] = $array[$month];
                $month_stats[$value['employee_id']][$month] = $value;

                $k++;
            }



            if (isset($month_stats)) {
                $max_array = max($month_stats);
                foreach ($max_array as $month => $value) {

                    foreach ($month_stats as $employee_id => $values) {

                        if (!isset($values[$month])) {

                            foreach ($month_stats[$employee_id] as $k => $v) {

                                $month_stat[$employee_id][$month]['employee_name'] = $v['employee_name'];
                            }
                        } else {
                            $month_stat[$employee_id][$month] = $values[$month];
                        }
                    }
                }
            }
        } else {
            $data_first = date('Y-m-01');
            $data_second = date('Y-m-01');
        }


        if ($request->search) {
            $search = $request->search;
            $indicator_doctor = StatisticDoctor::select()
                            ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_doctors.organization_id', $organization_id)
                            ->where('statistic_doctors.specializ_id', '<>', 1)
                            ->where('employees.employee_name', 'LIKE', "%$search%")
                            ->whereBetween('statistic_doctors.date', [$data_first, $data_second])
                            ->groupBy('statistic_doctors.employee_id')
                            ->selectRaw('sum(first_consulting)')
                            ->selectRaw('sum(first_therapy)')
                            ->selectRaw('sum(total_therapy)')
                            ->selectRaw('sum(schedule_time)')
                            ->selectRaw('sum(spent_time)')
                            ->selectRaw('sum(turnover)')
                            ->selectRaw('sum(clients)')
                            ->get()->toArray();


            if (empty($indicator_doctor)) {
                $messege = "Результат не найден";
                $indicator_doctor = StatisticDoctor::select()
                                ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                                ->where('employees.employee_active', 1)
                                ->where('statistic_doctors.organization_id', $organization_id)
                                ->where('statistic_doctors.specializ_id', '<>', 1)
                                ->whereBetween('statistic_doctors.date', [$data_first, $data_second])
                                ->groupBy('statistic_doctors.employee_id')
                                ->selectRaw('sum(first_consulting)')
                                ->selectRaw('sum(first_therapy)')
                                ->selectRaw('sum(total_therapy)')
                                ->selectRaw('sum(schedule_time)')
                                ->selectRaw('sum(spent_time)')
                                ->selectRaw('sum(turnover)')
                                ->selectRaw('sum(clients)')
                                ->get()->toArray();
            }
        } else {
            $indicator_doctor = StatisticDoctor::select()
                            ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_doctors.organization_id', $organization_id)
                            ->where('statistic_doctors.specializ_id', '<>', 1)
                            ->whereBetween('statistic_doctors.date', [$data_first, $data_second])
                            ->groupBy('statistic_doctors.employee_id')
                            ->selectRaw('sum(first_consulting)')
                            ->selectRaw('sum(first_therapy)')
                            ->selectRaw('sum(total_therapy)')
                            ->selectRaw('sum(schedule_time)')
                            ->selectRaw('sum(spent_time)')
                            ->selectRaw('sum(turnover)')
                            ->selectRaw('sum(clients)')
                            ->get()->toArray();
        }



        return view('indicators.indicators_doctor', [
            'indicator_doctor' => $indicator_doctor,
            'data_first' => $data_first,
            'data_second' => $data_second,
            'search' => $search,
            'messege' => $messege,
            'month_stat' => $month_stat,
            'months' => $months,
            'data_second' => $data_second,
            'reference_array' => $reference_array
        ]);
    }

    public function admin(Request $request) {
        $month_stat = [];
        $months = [];
        $search = "";
        $messege = "";
        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];
        $organization = Organization::where('id', $organization_id)->get()->toArray();
        $city_id = $organization[0]['city_id'];
        $class_id = $organization[0]['org_class_id'];

        $reference = AdminReference::where('city_id', $city_id)->where('class_id', $class_id)->get()->toArray();

        $reference_array = [];

        foreach ($reference as $key => $value) {
            $reference_array[$value['specializ_id']] = $value;
        }

        if ($request->first_data && $request->second_data) {
            $date1 = $request->first_data;
            $date2 = $request->second_data;
            $month_year1 = explode(' ', $date1);
            $month_year2 = explode(' ', $date2);
            $key1 = array_search($month_year1[0], $array);
            $key2 = array_search($month_year2[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
            $data_second = date('Y-m-d', strtotime($month_year2[1] . "-" . $key2 . "-1"));

            if ($data_first > $data_second) {
                return back()->with('error', 'Повалуйста выберите правильные даты');
            }

            $months_result = StatisticAdmin::select()
                            ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_admins.organization_id', $organization_id)
                            ->where('statistic_admins.specializ_id', 1)
                            ->whereBetween('statistic_admins.date', [$data_first, $data_second])
                            ->orderBy('statistic_admins.date')
                            ->get()->toArray();

            foreach ($months_result as $key => $value) {
                $month_array = explode("-", $value['date']);
                $month = intval($month_array[1]);
                $months[$array[$month]] = $array[$month];
                $month_stat[$value['id']][$key] = $value;
            }
        } else {
            $data_first = date('Y-m-01');
            $data_second = date('Y-m-01');
        }

        if ($request->search) {
            $search = $request->search;
            $indicator_admin = StatisticAdmin::select()
                            ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_admins.organization_id', $organization_id)
                            ->where('statistic_admins.specializ_id', 1)
                            ->where('employees.employee_name', 'LIKE', "%$search%")
                            ->whereBetween('statistic_admins.date', [$data_first, $data_second])
                            ->groupBy('statistic_admins.employee_id')
                            ->selectRaw('sum(first_patient)')
                            ->selectRaw('sum(recorded_patient)')
                            ->selectRaw('sum(final_patient)')
                            ->get()->toArray();

            if (empty($indicator_admin)) {
                $messege = "Результат не найден";
                $indicator_admin = StatisticAdmin::select()
                                ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                                ->where('employees.employee_active', 1)
                                ->where('statistic_admins.organization_id', $organization_id)
                                ->where('statistic_admins.specializ_id', 1)
                                ->whereBetween('statistic_admins.date', [$data_first, $data_second])
                                ->groupBy('statistic_admins.employee_id')
                                ->selectRaw('sum(first_patient)')
                                ->selectRaw('sum(recorded_patient)')
                                ->selectRaw('sum(final_patient)')
                                ->get()->toArray();
            }
        } else {

            $indicator_admin = StatisticAdmin::select()
                            ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_admins.organization_id', $organization_id)
                            ->where('statistic_admins.specializ_id', 1)
                            ->whereBetween('statistic_admins.date', [$data_first, $data_second])
                            ->groupBy('statistic_admins.employee_id')
                            ->selectRaw('sum(first_patient)')
                            ->selectRaw('sum(recorded_patient)')
                            ->selectRaw('sum(final_patient)')
                            ->get()->toArray();
        }

        return view('indicators.indicators_admin', [
            'indicator_admin' => $indicator_admin,
            'data_first' => $data_first,
            'data_second' => $data_second,
            'search' => $search,
            'messege' => $messege,
            'month_stat' => $month_stat,
            'months' => $months,
            'reference_array' => $reference_array]);
    }

    public function specialization(Request $request) {
        $month_stat = [];
        $final = [];
        $months = [];
        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];
        $organization = Organization::where('id', $organization_id)->get()->toArray();
        $city_id = $organization[0]['city_id'];
        $class_id = $organization[0]['org_class_id'];

        $reference = DoctorReference::where('city_id', $city_id)->where('class_id', $class_id)->get()->toArray();

        $reference_array = [];

        foreach ($reference as $key => $value) {
            $reference_array[$value['specializ_id']] = $value;
        }
        if ($request->first_data && $request->second_data) {
            $date1 = $request->first_data;
            $date2 = $request->second_data;
            $month_year1 = explode(' ', $date1);
            $month_year2 = explode(' ', $date2);
            $key1 = array_search($month_year1[0], $array);
            $key2 = array_search($month_year2[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
            $data_second = date('Y-m-d', strtotime($month_year2[1] . "-" . $key2 . "-1"));

            if ($data_first > $data_second) {
                return back()->with('error', 'Повалуйста выберите правильные даты');
            }

            $months_result = StatisticDoctor::select('*', 'specializ_types.specialization', 'specializ_types.id')->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                            ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                            ->where('employees.employee_active', 1)
                            ->where('statistic_doctors.organization_id', $organization_id)
                            ->where('statistic_doctors.specializ_id', '<>', 1)
                            ->whereBetween('statistic_doctors.date', [$data_first, $data_second])
                            ->orderBy('statistic_doctors.date')
                            ->get()->toArray();


            foreach ($months_result as $key => $value) {
                $month_array = explode("-", $value['date']);
                $month = intval($month_array[1]);
                $months[$month] = $array[$month];
                $month_stat[$month][$value['specialization']][$value['employee_id']] = $value;
            }

            foreach ($month_stat as $month => $specialization) {

                foreach ($specialization as $spec_id => $employee) {

                    $first_consulting = 0;
                    $first_therapy = 0;
                    $total_therapy = 0;
                    $schedule_time = 0;
                    $spent_time = 0;
                    $turnover = 0;
                    $clients = 0;
                    foreach ($employee as $employee_id => $value) {


                        if ($value['first_consulting'] != null) {
                            $first_consulting += $value['first_consulting'];
                        }
                        if ($value['first_therapy'] != null) {
                            $first_therapy += $value['first_therapy'];
                        }
                        if ($value['total_therapy'] != null) {
                            $total_therapy += $value['total_therapy'];
                        }
                        if ($value['schedule_time'] != null) {
                            $schedule_time += $value['schedule_time'];
                        }
                        if ($value['spent_time'] != null) {
                            $spent_time += $value['spent_time'];
                        }
                        if ($value['turnover'] != null) {
                            $turnover += $value['turnover'];
                        }
                        if ($value['clients'] != null) {
                            $clients += $value['clients'];
                        }
                        $final[$spec_id][$month]['specializ_id'] = $value['specializ_id'];
                    }
                    $final[$spec_id][$month]['first_consulting'] = $first_consulting;
                    $final[$spec_id][$month]['first_therapy'] = $first_therapy;
                    $final[$spec_id][$month]['total_therapy'] = $total_therapy;
                    $final[$spec_id][$month]['schedule_time'] = $schedule_time;
                    $final[$spec_id][$month]['spent_time'] = $spent_time;
                    $final[$spec_id][$month]['turnover'] = $turnover;
                    $final[$spec_id][$month]['clients'] = $clients;
                }
            }

            if (isset($final)) {
                $max_array = max($final);
                foreach ($max_array as $month => $value) {

                    foreach ($final as $spec_id => $values) {

                        if (!isset($values[$month])) {

                            foreach ($final[$spec_id] as $k => $v) {

                                $final[$spec_id][$month]['first_consulting'] = "";
                                $final[$spec_id][$month]['first_therapy'] = "";
                                $final[$spec_id][$month]['total_therapy'] = "";
                                $final[$spec_id][$month]['schedule_time'] = "";
                                $final[$spec_id][$month]['spent_time'] = "";
                                $final[$spec_id][$month]['turnover'] = "";
                                $final[$spec_id][$month]['clients'] = "";
                            }
                        } else {
                            $final[$spec_id][$month] = $values[$month];
                        }
                        
                      
                    }
                }
            }
            
        } else {

            $data_first = date('Y-m-01');
            $data_second = date('Y-m-01');
        }

        $indicator_specializ = StatisticDoctor::select('specializ_types.specialization', 'specializ_types.id')->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                        ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                        ->where('employees.employee_active', 1)
                        ->where('statistic_doctors.organization_id', $organization_id)
                        ->where('statistic_doctors.specializ_id', '<>', 1)
                        ->whereBetween('statistic_doctors.date', [$data_first, $data_second])
                        ->groupBy('statistic_doctors.specializ_id')
                        ->selectRaw('sum(first_consulting)')
                        ->selectRaw('sum(first_therapy)')
                        ->selectRaw('sum(total_therapy)')
                        ->selectRaw('sum(schedule_time)')
                        ->selectRaw('sum(spent_time)')
                        ->selectRaw('sum(turnover)')
                        ->selectRaw('sum(clients)')
                        ->get()->toArray();


        return view('indicators.indicators_specialization', ['indicator_specializ' => $indicator_specializ, 'final' => $final, 'months' => $months, 'data_first' => $data_first, 'data_second' => $data_second, 'reference_array' => $reference_array]);
    }

}
