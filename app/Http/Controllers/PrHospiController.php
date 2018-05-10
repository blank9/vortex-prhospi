<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use DB;

class PrHospiController extends Controller
{
    private $workshops = array("No Workshop"=>0, "AppDev"=>350, "WebDev"=>350, "AI"=>500, "Cloud Computing"=>500, "Ethical Hacking"=>500, "Big Data and Hadoop"=>500);

    public function index() {
        if(Session::has('mgr_id')) {
            Session::put('nav_checkin', 'active');
            Session::put('nav_acco', 'inactive');
            Session::put('nav_checkout', 'inactive');
            Session::put('nav_amb', 'inactive');
            return View('prhmain', ['error'=> false]);
        }

    	return View('prhindex', ['error'=> false]);
    }

    public function login(Request $req) {
    	$vortex_id = $req->input('id');
    	$pwd = $req->input('pwd');

    	$exists = DB::table('managers')
    				->where('id', $vortex_id)
    				->where('pwd', $pwd)
    				->count();

    	if($exists == 0) {
    		return View('prhindex', ['error'=> true, 'error_msg'=>'Invalid ID']);
    	}

    	$mgr = DB::table('managers')
    				->where('id', $vortex_id)
    				->where('pwd', $pwd)
    				->first();

    	Session::put('mgr_id', $vortex_id);
    	Session::put('mgr_name', $mgr->name);
    	return redirect()->route('index');
    }

    public function logout() {
    	Session::forget('mgr_id');
    	Session::forget('mgr_name');

    	return View('prhindex', ['error'=> false]);
    }

//--------------For PR Checkin -----------------------------------    

    public function getDetails(Request $req) {
        $user_id = $req->input('id');

        $cols = ['id', 'email', 'username', 'fullname', 'sex', 'nationality', 'college', 'degree', 'year', 'branch', 'phone', 'ambassador'];

        $user_data = DB::table('registration')
                    ->select($cols)
                    ->where('id', $user_id)
                    ->first();

        Session::put('curr_user_id', $user_id);

        if($user_data) {
            return View('pr_user_data', ['data'=> $user_data,
                                            'workshops'=>$this->workshops,
                                            'error'=> false
                                        ]);
        }
        else {
            return View('prhmain', ['error'=> true,
                                        'error_msg'=> 'Participant Not Registered'
                                    ]);
        }

    }

    public function prForm(Request $req) {

        $user_data = DB::table('footfall')
                    ->where('id', Session::get('curr_user_id'))
                    ->first();

        if($user_data) {
            $workshop_name = $req->get('workshop_select');
            $workshop_fees = $this->workshops[$workshop_name];

            DB::table('footfall')
                ->where('id', Session::get('curr_user_id'))
                ->update(['workshop_name'=>$workshop_name,
                            'workshop_fees'=>$workshop_fees,
                            'pr_paid'=>false,
                            'total_amt'=>$user_data->total_amt+$workshop_fees
                        ]);

            return View('pr_fee_receipt', ['workshop_fees'=> $workshop_fees, 
                                            'caution_fees'=> 0,
                                            'acco_fees'=> 0,
                                            'reg_fees'=> 0,
                                            'total_amt'=> $workshop_fees,
                                            'paid_online'=> false,
                                            'workshop_name'=> $workshop_name
                                            ]);
        }

        else {

            if($req->has('nitt')) {
                $reg_fees = 0;
                $caution_fees = 0;
            }
            else {
                $reg_fees = 150;
                $caution_fees = 0;
            }

            $workshop_name = $req->get('workshop_select');

            $workshop_fees = $this->workshops[$workshop_name];

            //for ambassadors
            if($req->has('amb')) {
                $check = DB::table('registration')
                                ->where('id', $req->input('amb_id'))
                                ->where('ambassador', 1)
                                ->count();

                if($check == 0) {
                    return View('pr_user_data', ['error'=>true, 'error_msg'=>'Amabassador Not Found']);
                }

                $check = DB::table('ambassadors')
                                ->where('id', $req->input('amb_id'))
                                ->count();

                if($check == 0) {
                    $amb_name = DB::table('registration')
                                    ->select('fullname')
                                    ->where('id', $req->input('amb_id'))
                                    ->where('ambassador', 1)
                                    ->first();

                    DB::table('ambassadors')->insert(['id'=> $req->input('amb_id'),
                                            'fullname'=> $amb_name->fullname,
                                            'ref_count'=> 0,
                                            'refunded'=> false
                                            ]);
                }

                DB::table('ambassadors')
                            ->where('id', $req->input('amb_id'))
                            ->increment('ref_count');
            }

            if($req->has('paid_online')) {
                $paid_online = true;
                $workshop_fees = 0;
            }
            else {
                $paid_online = false;
            }

            $acco_fees = 0;

            $total_amt = $reg_fees+$workshop_fees+$caution_fees+$acco_fees;

            $check = DB::table('footfall')
                            ->where('id', Session::get('curr_user_id'))
                            ->count();

            if($check == 0) {
                $insert_data = ['id'=> Session::get('curr_user_id'),
                            'hostel_id'=> NULL,
                            'workshop_fees'=> $workshop_fees, 
                            'caution_fees'=> $caution_fees,
                            'acco_fees'=> $acco_fees,
                            'reg_fees'=> $reg_fees,
                            'total_amt'=> $total_amt,
                            'workshop_name'=> $workshop_name,
                            'paid_online'=> $paid_online,
                            'pr_paid'=> false,
                            'acco_paid'=> false,
                            'checkin'=> time(),
                            'checkout'=> NULL
                            ];

                DB::table('footfall')->insert($insert_data);
            }

            return View('pr_fee_receipt', ['workshop_fees'=> $workshop_fees, 
                                            'caution_fees'=> $caution_fees,
                                            'acco_fees'=> $acco_fees,
                                            'reg_fees'=> $reg_fees,
                                            'total_amt'=> $total_amt,
                                            'paid_online'=> $paid_online,
                                            'workshop_name'=> $workshop_name
                                            ]);
        }
    }

    public function checkin() {
        DB::table('footfall')
                ->where('id', Session::get('curr_user_id'))
                ->update(['pr_paid'=>true]);

        return View('success', ['msg'=>'Checked In', 'btn_msg'=>'Check In', 'route'=>'/prhospi']);
    }


//-----------------------For Accomodation----------------------------

    public function acco() {
        Session::put('nav_checkin', 'inactive');
        Session::put('nav_acco', 'active');
        Session::put('nav_checkout', 'inactive');
        Session::put('nav_amb', 'inactive');

        return View('acco', ['error'=>false, 'form_route_ext'=>'check_pr']);
    }

    public function checkPr(Request $req) {
        $check = DB::table('footfall')
                    ->where('id', $req->input('id'))
                    ->count();

        if($check == 0) {
            return View('acco', ['error'=>true,
                                    'error_msg'=>'Not Registered',
                                    'form_route_ext'=>'check_pr'
                                ]);
        }

        Session::put('curr_user_id', $req->input('id'));

        $sex = DB::table('registration')
                    ->select('sex')
                    ->where('id', Session::get('curr_user_id'))
                    ->first()
                    ->sex;
        
        $hostels = DB::table('hostels')
                        ->where('sex', $sex)
                        ->get();

        return View('hospi_acco', ['error'=>false,
                                    'user_id'=>$req->input('id'),
                                    'hostels'=>$hostels
                                    ]);
    }

    public function fixAcco(Request $req) {
        $acco_fees =  $req->input('night_count')*100;
        $caution_fees = 100;

        Session::put('curr_hostel_id', $req->input('hostel_id'));

        $data = DB::table('footfall')
                    ->where('id', Session::get('curr_user_id'))
                    ->first();

        $new_total_amt = $data->total_amt + $caution_fees + $acco_fees;

        DB::table('footfall')
                    ->where('id', Session::get('curr_user_id'))
                    ->update(['total_amt'=> $new_total_amt,
                                'caution_fees'=> $caution_fees,
                                'acco_fees'=> $acco_fees,
                                ]);

        return View('hospi_fee_receipt', ['caution_fees'=> $caution_fees,
                                            'acco_fees'=> $acco_fees,
                                            'total_amt'=> $caution_fees+$acco_fees
                                            ]);
    }

    public function confirmAcco(Request $req) {
        DB::table('footfall')
                ->where('id', Session::get('curr_user_id'))
                ->update(['acco_paid'=>true, 'hostel_id'=> Session::get('curr_hostel_id')]);

        DB::table('hostels')
                ->where('id', Session::get('curr_hostel_id'))
                ->decrement('available');

        return View('success', ['msg'=>'Accomodated',
                                'btn_msg'=>'Hostel Assignment',
                                'route'=>'/prhospi/acco'
                                ]);

    }

//-------------For Check Out --------------------------------    

    public function checkout() {
        Session::put('nav_checkin', 'inactive');
        Session::put('nav_acco', 'inactive');
        Session::put('nav_checkout', 'active');
        Session::put('nav_amb', 'inactive');

        return View('checkout', ['error'=>false]);
    }

    public function checkoutDetails(Request $req) {
        $id = $req->input('id');

        Session::put('curr_user_id', $id);

        $check = DB::table('footfall')
                    ->where('id', $id)
                    ->count();

        if($check == 0) {
            return View('checkout', ['error'=> true, 'error_msg'=> 'Participant Not Checked In']);
        }

        DB::table('footfall')
            ->where('id', $id)
            ->update(['checkout'=>time()]);

        $user_details = DB::table('footfall')
                            ->where('id', $id)
                            ->first();

        $checked_in = date('d-m-Y g:i a', $user_details->checkin);
        $checked_out = date('d-m-Y g:i a', $user_details->checkout);
        $actual_night_count = date('d', $user_details->checkout) - date('d', $user_details->checkin);

        return View('checkout_details', ['user_details'=> $user_details,
                                            'checkin'=> $checked_in,
                                            'checkout'=> $checked_out,
                                            'actual_night_count'=> $actual_night_count
                                        ]);
    }

    public function confirmCheckout() {
        $hostel_id = DB::table('footfall')
                        ->select('hostel_id')
                        ->where('id', Session::get('curr_user_id'))
                        ->first()
                        ->hostel_id;

        DB::table('hostels')
            ->where('id', $hostel_id)
            ->increment('available');

        return View('success', ['msg'=> 'Checked out',
                                'btn_msg'=> 'Checkout',
                                'route'=> '/prhospi/checkout'
                                ]);
    }

//-------------For Ambassador----------------------------------------

    public function ambassador() {
        Session::put('nav_checkin', 'inactive');
        Session::put('nav_acco', 'inactive');
        Session::put('nav_checkout', 'inactive');
        Session::put('nav_amb', 'active');

        return View('ambassador', ['error'=>false]);
    }

    public function ambDetails(Request $req) {

        $check = DB::table('ambassadors')
                        ->where('id', $req->input('id'))
                        ->count();

        if($check == 0) {
            return View('ambassador', ['error'=>true, 'error_msg'=> 'Ambassador Not Found']);
        }

        $amb_details = DB::table('ambassadors')
                            ->where('id', $req->input('id'))
                            ->first();

        Session::put('curr_user_id', $req->input('id'));

        $discount = 0;
        $ref_count = $amb_details->ref_count;

        if($ref_count >= 50) {
            $discount = 100;
        }
        elseif ($ref_count >= 30) {
            $discount = 50;
        }
        elseif ($ref_count >= 15) {
            $discount = 25;
        }

        //footfall details for the ambassador
        $ffd = DB::table('footfall')
                    ->where('id', $req->input('id'))
                    ->first();

        $wrkshp = DB::table('footfall')
                            ->select('workshop_name')
                            ->where('id', Session::get('curr_user_id'))
                            ->first();

        if($wrkshp->workshop_name == 'AppDev' || $wrkshp->workshop_name == 'WebDev') {
            $total_amt = $ffd->acco_fees + $ffd->workshop_fees + $ffd->reg_fees;    
        }
        else {
            $total_amt = $ffd->acco_fees + $ffd->reg_fees;   
        }

        

        $final_amt = floor($total_amt*(1 - ($discount/100)));

        return View('amb_details', ['data'=> $amb_details,
                                        'total_amt'=> $total_amt,
                                        'final_amt'=> $final_amt,
                                        'discount'=> $discount
                                    ]);
    }

    public function confirmRefund() {
        DB::table('ambassadors')
                ->where('id', Session::get('curr_user_id'))
                ->update(['refunded'=>true]);

        return View('success', ['msg'=> 'Refunded',
                                'btn_msg'=> 'Refund',
                                'route'=> '/prhospi/ambassador'
                                ]);
    }

//---------Stats-----------------------------

    public function syedSplStats() {
        $total_ff = DB::table('footfall')
                        ->where('pr_paid', 1)
                        ->count();

        $total_reg = DB::table('registration')
                        ->count();

        $curr_checked_in = DB::table('footfall')
                            ->where('acco_paid', true)
                            ->where('checkout', NULL)
                            ->count();

        $curr_checked_out = DB::table('footfall')
                            ->where('acco_paid', true)
                            ->whereNotNull('checkout')
                            ->count();

        $paid_online = DB::table('footfall')
                        ->where('paid_online', true)
                        ->count();

        $wrkshp = DB::table('footfall')
                        ->select('workshop_name', DB::raw('count(*) as total'))
                        ->groupBy('workshop_name')
                        ->orderBy('workshop_name')
                        ->get();

        $online_details = DB::table('footfall')
                        ->select('workshop_name', DB::raw('count(*) as online'))
                        ->groupBy('workshop_name')
                        ->where('paid_online', 1)
                        ->orderBy('workshop_name')
                        ->get();

        $offline_details = DB::table('footfall')
                        ->select('workshop_name', DB::raw('count(*) as offline'))
                        ->groupBy('workshop_name')
                        ->where('paid_online', 0)
                        ->orderBy('workshop_name')
                        ->get();    


        $hostel_capacities = DB::table('hostels')->get();

        $curr_footfall = DB::table('footfall')
                            ->count();

        $total_pr_money = $curr_checked_in*150;

        $total_acco_fees = DB::table('footfall')->sum('acco_fees');
        $total_caution_fees = DB::table('footfall')->sum('caution_fees');
        $total_hospi_money = $total_acco_fees + $total_caution_fees;

        $ff_details = DB::table('footfall')->get();

        return View('spstats', ['curr_checked_in'=> $curr_checked_in,
                                'curr_checked_out'=> $curr_checked_out,
                                'paid_online'=> $paid_online,
                                'w_total'=> $wrkshp,
                                'w_online'=> $online_details,
                                'w_offline'=> $offline_details,
                                'paid_online'=>  $paid_online,
                                'hostels'=> $hostel_capacities,
                                'total_ff'=> $curr_footfall,
                                'pr_money'=> $total_pr_money,
                                'hospi_money'=> $total_hospi_money,
                                'caution_fees'=> $total_caution_fees,
                                'ff_details'=>$ff_details,
                                'total_ff'=> $total_ff,
                                'total_reg'=>$total_reg
                                ]);

    }
}

    
