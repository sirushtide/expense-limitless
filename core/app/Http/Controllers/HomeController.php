<?php

namespace App\Http\Controllers;

use App\TransactionModel;
use App\SettingModel;
use App\UserModel;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\TraitSettings;
use App;
use DB;
use Auth;

class HomeController extends Controller
{
    use TraitSettings;
    public $globaldata;

    public function __construct()
    {
        // Load global application settings
        $data = $this->getapplications();
        $lang = $data[0]->languages;
        App::setLocale($lang);
        $this->middleware('auth');
        $this->globaldata = $data;
    }

    /**
     * Show the application dashboard (all-time balance).
     */
    public function index()
    {
        // Pull in global data for your Blade
        $data = $this->globaldata;

        // ----------------------------------------------
        // If you want an ALL-TIME net balance (no month filter), do:
        // ----------------------------------------------
        $allTime = DB::table('transaction')
            ->selectRaw("
                SUM(CASE WHEN type=1 THEN amount ELSE 0 END) AS total_income,
                SUM(CASE WHEN type=2 THEN amount ELSE 0 END) AS total_expense
            ")
            // No month or year filtering => all transactions
            ->first();

        $netBalance = 0;
        if ($allTime) {
            $netBalance = ($allTime->total_income ?? 0)
                        - ($allTime->total_expense ?? 0);
        }
        $data['netBalance'] = $netBalance;

        return view('dashboard.index')->with('data', $data);
    }

    /**
     * Show income vs expense by month (across ALL years).
     * i.e., each "January" sum is from all January transactions in all years.
     */
    public function incomevsexpense()
    {
        // --- INCOME (type=1) ---
        // Summation for January across ALL years
        $ijan = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 1)
            ->sum('amount');
        $ifeb = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 2)
            ->sum('amount');
        $imar = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 3)
            ->sum('amount');
        $iapr = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 4)
            ->sum('amount');
        $imay = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 5)
            ->sum('amount');
        $ijun = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 6)
            ->sum('amount');
        $ijul = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 7)
            ->sum('amount');
        $iags = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 8)
            ->sum('amount');
        $isep = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 9)
            ->sum('amount');
        $iokt = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 10)
            ->sum('amount');
        $inov = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 11)
            ->sum('amount');
        $ides = DB::table('transaction')
            ->where('type', 1)
            ->whereMonth('transactiondate', 12)
            ->sum('amount');

        // --- UPCOMING INCOME (type=3) ---
        $uijan = DB::table('transaction')
            ->where('type', 3)
            ->whereMonth('transactiondate', 1)
            ->sum('amount');
        $uifeb = DB::table('transaction')
            ->where('type', 3)
            ->whereMonth('transactiondate', 2)
            ->sum('amount');
        // ... Repeat for each month
        $uimar = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 3)->sum('amount');
        $uiapr = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 4)->sum('amount');
        $uimay = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 5)->sum('amount');
        $uijun = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 6)->sum('amount');
        $uijul = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 7)->sum('amount');
        $uiags = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 8)->sum('amount');
        $uisep = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 9)->sum('amount');
        $uiokt = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 10)->sum('amount');
        $uinov = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 11)->sum('amount');
        $uides = DB::table('transaction')->where('type', 3)->whereMonth('transactiondate', 12)->sum('amount');

        // --- EXPENSE (type=2) ---
        $ejan = DB::table('transaction')
            ->where('type', 2)
            ->whereMonth('transactiondate', 1)
            ->sum('amount');
        $efeb = DB::table('transaction')
            ->where('type', 2)
            ->whereMonth('transactiondate', 2)
            ->sum('amount');
        // ... Repeat for each month
        $emar = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 3)->sum('amount');
        $eapr = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 4)->sum('amount');
        $emay = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 5)->sum('amount');
        $ejun = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 6)->sum('amount');
        $ejul = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 7)->sum('amount');
        $eags = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 8)->sum('amount');
        $esep = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 9)->sum('amount');
        $eokt = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 10)->sum('amount');
        $enov = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 11)->sum('amount');
        $edes = DB::table('transaction')->where('type', 2)->whereMonth('transactiondate', 12)->sum('amount');

        // --- UPCOMING EXPENSE (type=4) ---
        $iejan = DB::table('transaction')
            ->where('type', 4)
            ->whereMonth('transactiondate', 1)
            ->sum('amount');
        $iefeb = DB::table('transaction')
            ->where('type', 4)
            ->whereMonth('transactiondate', 2)
            ->sum('amount');
        // ... Repeat for each month
        $iemar = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 3)->sum('amount');
        $ieapr = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 4)->sum('amount');
        $iemay = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 5)->sum('amount');
        $iejun = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 6)->sum('amount');
        $iejul = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 7)->sum('amount');
        $ieags = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 8)->sum('amount');
        $iesep = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 9)->sum('amount');
        $ieokt = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 10)->sum('amount');
        $ienov = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 11)->sum('amount');
        $iedes = DB::table('transaction')->where('type', 4)->whereMonth('transactiondate', 12)->sum('amount');

        // Build a response array
        $res['ijan'] = $ijan;
        $res['ifeb'] = $ifeb;
        $res['imar'] = $imar;
        $res['iapr'] = $iapr;
        $res['imay'] = $imay;
        $res['ijun'] = $ijun;
        $res['ijul'] = $ijul;
        $res['iags'] = $iags;
        $res['isep'] = $isep;
        $res['iokt'] = $iokt;
        $res['inov'] = $inov;
        $res['ides'] = $ides;

        $res['uijan'] = $uijan;
        $res['uifeb'] = $uifeb;
        $res['uimar'] = $uimar;
        $res['uiapr'] = $uiapr;
        $res['uimay'] = $uimay;
        $res['uijun'] = $uijun;
        $res['uijul'] = $uijul;
        $res['uiags'] = $uiags;
        $res['uisep'] = $uisep;
        $res['uiokt'] = $uiokt;
        $res['uinov'] = $uinov;
        $res['uides'] = $uides;

        $res['ejan'] = $ejan;
        $res['efeb'] = $efeb;
        $res['emar'] = $emar;
        $res['eapr'] = $eapr;
        $res['emay'] = $emay;
        $res['ejun'] = $ejun;
        $res['ejul'] = $ejul;
        $res['eags'] = $eags;
        $res['esep'] = $esep;
        $res['eokt'] = $eokt;
        $res['enov'] = $enov;
        $res['edes'] = $edes;

        $res['iejan'] = $iejan;
        $res['iefeb'] = $iefeb;
        $res['iemar'] = $iemar;
        $res['ieapr'] = $ieapr;
        $res['iemay'] = $iemay;
        $res['iejun'] = $iejun;
        $res['iejul'] = $iejul;
        $res['ieags'] = $ieags;
        $res['iesep'] = $iesep;
        $res['ieokt'] = $ieokt;
        $res['ienov'] = $ienov;
        $res['iedes'] = $iedes;

        return response($res);
    }

    /**
     * Show expense by category (ALL months, ALL years).
     */
    public function expensebycategory()
    {
        // Summation of ALL transactions (type=2) across all months/years
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '2')
            ->where('transaction.type', '2')
            // No ->whereMonth or ->whereYear => truly all-time
            ->groupBy('category.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    /**
     * Show upcoming expense by category (ALL time).
     */
    public function upcomingexpensebycategory()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '2')
            ->where('transaction.type', '4')
            ->groupBy('category.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    /**
     * Show expense by category yearly (ALL time).
     */
    public function expensebycategoryyearly()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '2')
            ->where('transaction.type', '2')
            ->groupBy('category.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    public function upcomingexpensebycategoryyearly()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '2')
            ->where('transaction.type', '4')
            ->groupBy('category.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    /**
     * Show income by category (ALL time).
     */
    public function incomebycategory()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '1')
            ->where('transaction.type', '1')
            ->groupBy('category.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    public function incomebycategoryyearly()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '1')
            ->where('transaction.type', '1')
            ->groupBy('category.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    public function upcomingincomebycategoryyearly()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '1')
            ->where('transaction.type', '3')
            ->groupBy('category.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    /**
     * Show total balance (ALL time).
     */
    public function totalbalance()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->select(DB::raw('SUM(amount) as amount, category.name as category, category.color as color'))
            ->where('category.type', '2')
            // No month or year => all time
            ->groupBy('transaction.categoryid')
            ->groupBy('category.name')
            ->groupBy('category.color')
            ->get();

        return response($data);
    }

    /**
     * Show account balance (ALL time).
     */
    public function accountbalance()
    {
        // No year or month constraints => sums everything
        $data = DB::select("
            SELECT
                p.name,
                COALESCE(a.amount, 0) AS income,
                COALESCE(b.amount, 0) AS expense,
                COALESCE(
                    p.balance + (COALESCE(a.amount, 0) - COALESCE(b.amount, 0))
                ,0) AS balance
            FROM account AS p
            LEFT JOIN (
                SELECT accountid, SUM(amount) AS amount
                FROM transaction
                WHERE type=1
                GROUP BY accountid
            ) AS a ON a.accountid = p.accountid
            LEFT JOIN (
                SELECT accountid, SUM(amount) AS amount
                FROM transaction
                WHERE type=2
                GROUP BY accountid
            ) AS b ON b.accountid = p.accountid
            GROUP BY p.accountid
        ");

        return response($data);
    }

    /**
     * Show budget list (ALL time).
     */
    public function budgetlist()
    {
        // If you also want to remove the month filter on 'fromdate', remove the whereMonth() line
        $data = DB::table('budget')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'budget.categoryid')
            ->join('category', 'subcategory.categoryid', '=', 'category.categoryid')
            ->groupBy('budget.categoryid')
            ->get();

        return response($data);
    }

    /**
     * Show the 10 latest incomes (ALL time).
     */
    public function latestincome()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->join('account', 'account.accountid', '=', 'transaction.accountid')
            ->select(
                'category.name as category',
                'subcategory.name as subcategory',
                'transaction.*',
                'users.name as user',
                'account.name as account'
            )
            ->where('transaction.type', '1')
            ->limit(10)
            ->orderBy('transactiondate', 'desc')
            ->get();

        $res['success'] = 'success';
        $res['data']    = $data;
        return response($res);
    }

    /**
     * Show the 10 latest expenses (ALL time).
     */
    public function latestexpense()
    {
        $data = DB::table('transaction')
            ->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
            ->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
            ->join('users', 'users.userid', '=', 'transaction.userid')
            ->join('account', 'account.accountid', '=', 'transaction.accountid')
            ->select(
                'category.name as category',
                'subcategory.name as subcategory',
                'transaction.*',
                'users.name as user',
                'account.name as account'
            )
            ->where('transaction.type', '2')
            ->limit(10)
            ->orderBy('transactiondate', 'desc')
            ->get();

        $res['success'] = 'success';
        $res['data']    = $data;
        return response($res);
    }
}
