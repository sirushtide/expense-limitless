<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\GoalModel;
use App\SettingModel;
use App\Http\Controllers\TraitSettings;
use DB;
use Auth;
use App;

class ReportsController extends Controller
{
    use TraitSettings;
    public $globaldata;

    public function __construct() {
        $data = $this->getapplications();
        $lang = $data[0]->languages;
        App::setLocale($lang);
        $this->globaldata = $data;
        $this->middleware('auth');
    }

    // Show default views
    public function incomereports() {
        $data = $this->globaldata;
        if (Auth::user()->isrole('11')){
            return view('reports.income')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function expensereports() {
        $data = $this->globaldata;
        if (Auth::user()->isrole('12')){
            return view('reports.expense')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function incomevsexpensereports() {
        $data = $this->globaldata;
        if (Auth::user()->isrole('13')){
            return view('reports.incomevsexpense')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function accountreports() {
        $data = $this->globaldata;
        if (Auth::user()->isrole('16')){
            return view('reports.account')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function incomemonth(){
        $data = $this->globaldata;
        if (Auth::user()->isrole('14')){
            return view('reports.incomemonth')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function expensemonth(){
        $data = $this->globaldata;
        if (Auth::user()->isrole('15')){
            return view('reports.expensemonth')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function upcomingincomereports(){
        $data = $this->globaldata;
        if (Auth::user()->isrole('19')){
            return view('reports.upcomingincome')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function upcomingexpensereports(){
        $data = $this->globaldata;
        if (Auth::user()->isrole('20')){
            return view('reports.upcomingexpense')->with('data', $data);
        } else {
            return redirect('home')->with('data', $data);
        }
    }

    public function allreports(){
        $data = $this->globaldata;
        return view('reports.reports')->with('data', $data);
    }

    /**
     * Get data (income/expense) from database via DataTables.
     * Removes any forced year constraint, so it’s all-time unless the user uses a date filter.
     */
    public function gettransactions(Request $request){
        $type = $request->input('type');

        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->join('account', 'account.accountid', '=', 'transaction.accountid')
            ->select([
                'category.name as category',
                'category.categoryid as categoryid1',
                'subcategory.subcategoryid as subcategoryid2',
                'subcategory.name as subcategory',
                'transaction.*',
                'users.name as user',
                'account.name as account'
            ])
            ->where('transaction.type', $type);

        return Datatables::of($data)
            ->addColumn('amount', function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                return $setting->currency . number_format($single->amount, 2);
            })
            ->addColumn('transactiondate', function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                return date($setting->dateformat, strtotime($single->transactiondate));
            })
            ->filter(function ($query) use ($request) {
                if ($request->filled('names')) {
                    $query->where('transaction.name', 'like', "%{$request->get('names')}%");
                }
                if ($request->filled('category')) {
                    $query->where('category.categoryid', 'like', "%{$request->get('category')}%");
                }
                if ($request->filled('subcategory')) {
                    $query->where('subcategory.subcategoryid', 'like', "%{$request->get('subcategory')}%");
                }
                if ($request->filled('fromdate') && $request->filled('todate')) {
                    $query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
                }
            })
            ->make(true);
    }

    public function gettransactionsupcoming(Request $request){
        $type = $request->input('type');

        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select([
                'category.name as category',
                'category.categoryid as categoryid1',
                'subcategory.subcategoryid as subcategoryid2',
                'subcategory.name as subcategory',
                'transaction.*',
                'users.name as user'
            ])
            ->where('transaction.type', $type);

        return Datatables::of($data)
            ->addColumn('amount', function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                return $setting->currency . number_format($single->amount, 2);
            })
            ->addColumn('transactiondate', function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                return date($setting->dateformat, strtotime($single->transactiondate));
            })
            ->filter(function ($query) use ($request) {
                if ($request->filled('names')) {
                    $query->where('transaction.name', 'like', "%{$request->get('names')}%");
                }
                if ($request->filled('category')) {
                    $query->where('category.categoryid', 'like', "%{$request->get('category')}%");
                }
                if ($request->filled('subcategory')) {
                    $query->where('subcategory.subcategoryid', 'like', "%{$request->get('subcategory')}%");
                }
                if ($request->filled('fromdate') && $request->filled('todate')) {
                    $query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
                }
            })
            ->make(true);
    }

    /**
     * get data account transaction from database (all-time) 
     */
    public function getaccounttransaction(Request $request){
        $data = DB::table('transaction')
            ->select([
                'transaction.*',
                'category.name as category',
                'subcategory.name as subcategory',
                DB::raw("IFNULL(a.amount,'-') as income, IFNULL(b.amount,'-') as expense")
            ])
            ->leftJoin(DB::raw("(select transactionid, amount from transaction where type=1) as a"), function($join){
                $join->on("a.transactionid","=","transaction.transactionid");
            })
            ->leftJoin(DB::raw("(select transactionid, amount from transaction where type=2) as b"), function($join){
                $join->on("b.transactionid","=","transaction.transactionid");
            })
            ->leftJoin('subcategory','subcategory.subcategoryid','=','transaction.categoryid')
            ->leftJoin('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->leftJoin('account', 'account.accountid', '=', 'transaction.accountid');

        return Datatables::of($data)
            ->addColumn('income', function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                if($single->income == '-'){
                    return '-';
                } else {
                    return '<p class="text-green netincome"><b>'
                         . $setting->currency . number_format($single->income,2)
                         . '</b></p>';
                }
            })
            ->addColumn('expense', function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                if($single->expense == '-'){
                    return '-';
                } else {
                    return '<p class="text-red netincome"><b>'
                         . $setting->currency . number_format($single->expense,2)
                         . '</b></p>';
                }
            })
            ->addColumn('transactiondate', function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                return date($setting->dateformat, strtotime($single->transactiondate));
            })
            ->filter(function ($query) use ($request) {
                if ($request->filled('names')) {
                    $query->where('transaction.name', 'like', "%{$request->get('names')}%");
                }
                if ($request->filled('account')) {
                    $query->where('transaction.accountid', 'like', "%{$request->get('account')}%");
                }
                if ($request->filled('fromdate') && $request->filled('todate')) {
                    $query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
                }
            })
            ->rawColumns(['expense', 'income'])
            ->make(true);
    }

    /**
     * get remaining balance from database
     * Currently filters by YEAR(...) => remove to show all-time.
     */
    public function getbalance(){
        // If you want ALL-time balance, remove these year constraints:

        // Summation of all incomes (type=1)
        $yearincome = DB::table('transaction')
            ->select(DB::raw('SUM(amount) as totalyear'))
            ->where('type', 1)
            // ->whereYear('transactiondate', date('Y')) // remove if you want all-time
            ->get();

        // Summation of all expenses (type=2)
        $yearexpense = DB::table('transaction')
            ->select(DB::raw('SUM(amount) as totalyear'))
            ->where('type', 2)
            // ->whereYear('transactiondate', date('Y')) // remove if you want all-time
            ->get();

        // Summation of all incomes for current month (if you want to remove month filter, remove next line)
        $monthincome = DB::table('transaction')
            ->select(DB::raw('SUM(amount) as totalmonth'))
            ->where('type', 1)
            ->whereMonth('transactiondate', date('m')) // remove if you want truly all-time
            ->get();

        // Summation of all expenses for current month
        $monthexpense = DB::table('transaction')
            ->select(DB::raw('SUM(amount) as totalmonth'))
            ->where('type', 2)
            ->whereMonth('transactiondate', date('m')) // remove if you want truly all-time
            ->get();

        // yearbalance is the net for the entire year => remove if you want all-time
        $yearbalance = $yearincome[0]->totalyear - $yearexpense[0]->totalyear;

        // monthbalance is the net for the current month => remove if you want all-time
        $monthbalance = $monthincome[0]->totalmonth - $monthexpense[0]->totalmonth;

        $res['year']  = number_format($yearbalance, 2);
        $res['month'] = number_format($monthbalance, 2);

        return response($res);
    }

    /**
     * get monthly income reports
     */
    public function getincomemonthly(){
        // If you want to remove year constraints, remove "AND YEAR(transactiondate)=..."
        // For example, "year(transaction.transactiondate) =" . date('Y') => remove or comment out for all-time
        $data = DB::select("
            SELECT category.name AS category,
                   transaction.type AS type,
                   SUM( IF( MONTH(transactiondate) = 1, amount, 0) ) AS ijan,
                   COUNT( IF( MONTH(transactiondate) = 1, amount, NULL) ) AS trx_1,
                   SUM( IF( MONTH(transactiondate) = 2, amount, 0) ) AS ifeb,
                   COUNT( IF( MONTH(transactiondate) = 2, amount, NULL) ) AS trx_2,
                   SUM( IF( MONTH(transactiondate) = 3, amount, 0) ) AS imar,
                   COUNT( IF( MONTH(transactiondate) = 3, amount, NULL) ) AS trx_3,
                   SUM( IF( MONTH(transactiondate) = 4, amount, 0) ) AS iapr,
                   COUNT( IF( MONTH(transactiondate) = 4, amount, NULL) ) AS trx_4,
                   SUM( IF( MONTH(transactiondate) = 5, amount, 0) ) AS imay,
                   COUNT( IF( MONTH(transactiondate) = 5, amount, NULL) ) AS trx_5,
                   SUM( IF( MONTH(transactiondate) = 6, amount, 0) ) AS ijun,
                   COUNT( IF( MONTH(transactiondate) = 6, amount, NULL) ) AS trx_6,
                   SUM( IF( MONTH(transactiondate) = 7, amount, 0) ) AS ijul,
                   COUNT( IF( MONTH(transactiondate) = 7, amount, NULL) ) AS trx_7,
                   SUM( IF( MONTH(transactiondate) = 8, amount, 0) ) AS iags,
                   COUNT( IF( MONTH(transactiondate) = 8, amount, NULL) ) AS trx_8,
                   SUM( IF( MONTH(transactiondate) = 9, amount, 0) ) AS isep,
                   COUNT( IF( MONTH(transactiondate) = 9, amount, NULL) ) AS trx_9,
                   SUM( IF( MONTH(transactiondate) = 10, amount, 0) ) AS iokt,
                   COUNT( IF( MONTH(transactiondate) = 10, amount, NULL) ) AS trx_10,
                   SUM( IF( MONTH(transactiondate) = 11, amount, 0) ) AS inov,
                   COUNT( IF( MONTH(transactiondate) = 11, amount, NULL) ) AS trx_11,
                   SUM( IF( MONTH(transactiondate) = 12, amount, 0) ) AS idec,
                   COUNT( IF( MONTH(transactiondate) = 12, amount, NULL) ) AS trx_12,
                   COUNT(transactionid) AS jml_trx,
                   SUM(amount) AS total
            FROM transaction
                LEFT JOIN subcategory ON transaction.categoryid = subcategory.subcategoryid
                LEFT JOIN category ON category.categoryid = subcategory.categoryid
            WHERE transaction.type = 1
              /* AND YEAR(transaction.transactiondate) = ".date('Y')."  <-- remove or comment out for all-time */
            GROUP BY transaction.type, category.name
            ORDER BY SUM(amount) DESC, transaction.type
        ");

        return Datatables::of($data)
            ->addColumn('category', function($single){
                return '<p class="mb-0 netincome"><strong>'. $single->category .'</strong></p>';
            })
            ->addColumn('ijan',function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                return $setting->currency.number_format($single->ijan,2);
            })
            // Repeat for ifeb, imar, etc...
            ->addColumn('total',function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                if($single->total>0){
                    return '<p class=" mb-0 netincome text-green"><b>'.$setting->currency.number_format($single->total,2).'</b></p>';
                } else {
                    return '<p class=" mb-0 netincome text-red"><b>'.$setting->currency.number_format($single->total,2).'</b></p>';
                }
            })
            ->rawColumns(['category','total'])
            ->make(true);
    }

    /**
     * get monthly expense reports
     */
    public function getexpensemonthly(){
        // Same logic: remove "AND YEAR(transactiondate)=..."
        $data = DB::select("
            SELECT category.name AS category,
                   transaction.type AS type,
                   SUM( IF( MONTH(transactiondate) = 1, amount, 0) ) AS ijan,
                   ...
                   SUM(amount) AS total
            FROM transaction
                LEFT JOIN subcategory ON transaction.categoryid = subcategory.subcategoryid
                LEFT JOIN category ON category.categoryid = subcategory.categoryid
            WHERE transaction.type = 2
              /* AND YEAR(transaction.transactiondate) = ".date('Y')." <-- remove or comment out for all-time */
            GROUP BY transaction.type, category.name
            ORDER BY SUM(amount) DESC, transaction.type
        ");

        return Datatables::of($data)
            ->addColumn('category', function($single){
                return '<p class="mb-0 netincome"><strong>'. $single->category .'</strong></p>';
            })
            // ... addColumns for ijan, ifeb, etc. ...
            ->addColumn('total',function($single){
                $setting = DB::table('settings')->where('settingsid','1')->first();
                if($single->total>0){
                    // For expense, you might want to mark it red
                    return '<p class="mb-0 netincome text-red"><b>'.$setting->currency.number_format($single->total,2).'</b></p>';
                } else {
                    return '<p class="mb-0 netincome text-green"><b>'.$setting->currency.number_format($single->total,2).'</b></p>';
                }
            })
            ->rawColumns(['category','total'])
            ->make(true);
    }
}
