@extends('layouts.app')
@section('content')
<div class="content">
    <div class="p-3">
        <div class="row">
            <div class="col-md-8 border-right">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="title mb-2 mt-0">
                            {{ trans('lang.income') }}
                        </h5>
                        <div class="d-flex align-items-stretch">
                            <div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
                                <p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
                            </div>
                            <div class="background-grey p-3 rounded flex-fill">
                                <!-- Show total income (across ALL years) -->
                                <p class="transactiontitle">
                                  <span class="currency"></span>
                                  <span class="incomethismonth"></span>
                                </p>
                                <!-- We removed the “This Month (January)” line -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="title mb-2 mt-0">
                            {{ trans('lang.expense') }}
                        </h5>
                        <div class="d-flex align-items-stretch">
                            <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                                <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                            </div>
                            <div class="background-grey p-3 rounded flex-fill">
                                <!-- Show total expense (across ALL years) -->
                                <p class="transactiontitle">
                                  <span class="currency"></span>
                                  <span class="expensemonth"></span>
                                </p>
                                <!-- We removed the “This Month (January)” line -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INCOME VS EXPENSE chart heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="title mb-2">
                            {{ trans('lang.income_vs_expense') }}
                        </h5>
                        <canvas id="incomevsexpense" height="100"></canvas>
                    </div>
                </div>

                <!-- INCOME/EXPENSE by Category headings -->
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="title mb-2">
                            {{ trans('lang.income_by_category') }}
                        </h5>
                        <canvas id="incomebycategory" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h5 class="title mb-2">
                            {{ trans('lang.expense_by_category') }}
                        </h5>
                        <canvas id="expensebycategory" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rounded background-green color-white p-4">
                            <p>{{ trans('lang.balance') }}</p>
                            <!-- The total net balance across ALL years -->
                            <p class="transactiontitle">
                              <span class="currency"></span>
                              <span class="totalbalance"></span>
                            </p>
                            <!-- Removed “This Month (January)” line -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="title mt-3 mb-2">
                            {{ trans('lang.account_balance') }}
                        </h5>
                        <canvas id="accountbalance" height="100"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rounded background-grey p-4">
                            <h5 class="title mt-0">{{ trans('lang.new') }}</h5>
                            <ul class="quick-menu">
                                @if(Auth::check())
                                    <li class="{{ Request::is('transaction') ? 'active' : '' }}">
                                        <a href="{{ URL::to('transaction') }}">
                                            {{ trans('lang.transactions') }}
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::check())
                                    <li class="{{ Request::is('reports/income') ? 'active' : '' }}">
                                        <a href="{{ URL::to('reports/income') }}">
                                            {{ trans('lang.income_reports') }}
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::check())
                                    <li class="{{ Request::is('reports/expense') ? 'active' : '' }}">
                                        <a href="{{ URL::to('reports/expense') }}">
                                            {{ trans('lang.expense_reports') }}
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::check())
                                    <li class="{{ Request::is('reports/account') ? 'active' : '' }}">
                                        <a href="{{ URL::to('reports/account') }}">
                                            {{ trans('lang.account_transaction_report') }}
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions row -->
        <div class="row">
            <div class="col-md-8 border-right">
                <div class="d-flex justify-content-between">
                    <h5 class="title mt-0">{{ trans('lang.transactions') }}</h5>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="income-tab-dashboard" data-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="true">
                                {{ trans('lang.income') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="expense-tab-dashboard" data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="false">
                                {{ trans('lang.expense') }}
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="tab-content" id="myTabContent">
                    <!-- Income tab -->
                    <div class="tab-pane fade show active" id="income" role="tabpanel" aria-labelledby="income-tab-dashboard">
                        <div class="latestincome pt-3">
                            <table cellpadding="5" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><p class="mb-0">{{ trans('lang.name') }}</p></th>
                                        <th><p class="mb-0">{{ trans('lang.date') }}</p></th>
                                        <th><p class="mb-0">{{ trans('lang.account') }}</p></th>
                                        <th><p class="mb-0 text-center">{{ trans('lang.amount') }}</p></th>
                                    </tr>
                                </thead>
                                <tbody id="latestincomedata"></tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Expense tab -->
                    <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab-dashboard">
                        <div class="latestexpense pt-3">
                            <table cellpadding="5" cellspacing="0" border="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><p class="mb-0">{{ trans('lang.name') }}</p></th>
                                        <th><p class="mb-0">{{ trans('lang.date') }}</p></th>
                                        <th><p class="mb-0">{{ trans('lang.account') }}</p></th>
                                        <th><p class="mb-0 text-center">{{ trans('lang.amount') }}</p></th>
                                    </tr>
                                </thead>
                                <tbody id="latestexpensedata"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>	  

<script>
$(document).ready(function() {
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
    
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    var currency = "₹"; // or from your global settings

    // 1) Account Balance: calls /home/accountbalance
    $.ajax({
        type: "GET",
        url: "{{ url('home/accountbalance') }}",
        dataType: "json",
        success: function (data) {
            var label = [];
            var amount = [];
            for(var i in data) {
                label.push(data[i].name);
                amount.push(data[i].balance);
            }
            var caccountbalance = document.getElementById("accountbalance");
            new Chart(caccountbalance, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: "{{ trans('lang.account') }}",
                        data: amount,
                        backgroundColor: '#1DC873',
                        borderColor: '#1DC873',
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: { position: 'bottom' },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return currency + numberWithCommas(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        }
    });

    // 2) Expense by Category: /home/expensebycategory
    $.ajax({
        type: "GET",
        url: "{{ url('home/expensebycategory') }}",
        dataType: "json",
        success: function (data) {
            var label = [], amount = [], color = [];
            for(var i in data) {
                label.push(data[i].category);
                amount.push(data[i].amount);
                color.push(data[i].color);
            }
            var cexpensecategory = document.getElementById("expensebycategory");
            new Chart(cexpensecategory, {
                type: 'doughnut',
                data: {
                    labels: label,
                    datasets: [{
                        data: amount,
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: { position: 'bottom' },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return currency + numberWithCommas(data.datasets[0].data[tooltipItem.index]);
                            }
                        }
                    }
                }
            });
        }
    });

    // 3) Income by Category: /home/incomebycategory
    $.ajax({
        type: "GET",
        url: "{{ url('home/incomebycategory') }}",
        dataType: "json",
        success: function (data) {
            var label = [], amount = [], color = [];
            for(var i in data) {
                label.push(data[i].category);
                amount.push(data[i].amount);
                color.push(data[i].color);
            }
            var cincomebycategory = document.getElementById("incomebycategory");
            new Chart(cincomebycategory, {
                type: 'doughnut',
                data: {
                    labels: label,
                    datasets: [{
                        data: amount,
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: { position: 'bottom' },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return currency + numberWithCommas(data.datasets[0].data[tooltipItem.index]);
                            }
                        }
                    }
                }
            });
        }
    });

    // 4) Income vs Expense: /home/incomevsexpense
    $.ajax({
        type: "GET",
        url: "{{ url('home/incomevsexpense') }}",
        dataType: "json",
        success: function (data) {
            var cincomevsexpense = document.getElementById("incomevsexpense");
            new Chart(cincomevsexpense, {
                type: 'line',
                data: {
                    labels: [
                        "{{ trans('lang.jan') }}","{{ trans('lang.feb') }}",
                        "{{ trans('lang.mar') }}","{{ trans('lang.apr') }}",
                        "{{ trans('lang.may') }}","{{ trans('lang.jun') }}",
                        "{{ trans('lang.jul') }}","{{ trans('lang.aug') }}",
                        "{{ trans('lang.sep') }}","{{ trans('lang.oct') }}",
                        "{{ trans('lang.nov') }}","{{ trans('lang.dec') }}"
                    ],
                    datasets: [
                        {
                            label: "{{ trans('lang.income') }}",
                            data: [
                                data.ijan, data.ifeb, data.imar, data.iapr,
                                data.imay, data.ijun, data.ijul, data.iags,
                                data.isep, data.iokt, data.inov, data.ides
                            ],
                            backgroundColor: '#41d5e2',
                            borderColor: '#41d5e2',
                            borderWidth: 1,
                            fill: false
                        },
                        {
                            label: "{{ trans('lang.expense') }}",
                            data: [
                                data.ejan, data.efeb, data.emar, data.eapr,
                                data.emay, data.ejun, data.ejul, data.eags,
                                data.esep, data.eokt, data.enov, data.edes
                            ],
                            backgroundColor: '#FF5668',
                            borderColor: '#FF5668',
                            borderWidth: 1,
                            fill: false
                        }
                    ]
                },
                options: {
                    legend: { position: 'bottom' },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(tooltipItem) {
                                return currency + numberWithCommas(tooltipItem.yLabel);
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                callback: function(value) {
                                    if(parseInt(value) >= 1000){
                                        return currency + numberWithCommas(value);
                                    } 
                                    return currency + value;
                                }
                            }
                        }]
                    }
                }
            });
        }
    });

    // 5) Latest Incomes: /home/latestincome
    $.ajax({
        type: "GET",
        url: "{{ url('home/latestincome') }}",
        dataType: "JSON",
        success: function(html) {
            var objs = html.data;
            $.each(objs, function(index, record) {
                $("#latestincomedata").append(
                    '<tr>'+
                        '<td><b>'+ record.name +'</b></td>'+
                        '<td>'+ moment(record.transactiondate).format('YYYY-MM-DD') +'</td>'+
                        '<td>'+ record.account +'</td>'+
                        '<td align="center"><b>'+ currency + numberWithCommas(parseFloat(record.amount).toFixed(2))+'</b></td>'+
                    '</tr>'
                );
            });
        }
    });

    // 6) Latest Expenses: /home/latestexpense
    $.ajax({
        type: "GET",
        url: "{{ url('home/latestexpense') }}",
        dataType: "JSON",
        success: function(html) {
            var objs = html.data;
            $.each(objs, function(index, record) {
                $("#latestexpensedata").append(
                    '<tr>'+
                        '<td><b>'+ record.name +'</b></td>'+
                        '<td>'+ moment(record.transactiondate).format('YYYY-MM-DD') +'</td>'+
                        '<td>'+ record.account +'</td>'+
                        '<td align="center"><b>'+ currency + numberWithCommas(parseFloat(record.amount).toFixed(2))+'</b></td>'+
                    '</tr>'
                );
            });
        }
    });

    // 7) Income total: /income/gettotal
    //    If this endpoint only calculates the current month, you must fix the controller.
    $.ajax({
        type: "GET",
        url: "{{ url('income/gettotal') }}",
        dataType: "json",
        success: function(data) {
            // data.month might be summing all-time if you updated the controller.
            $(".incomethismonth").html(data.month);
        }
    });

    // 8) Expense total: /expense/gettotal
    $.ajax({
        type: "GET",
        url: "{{ url('expense/gettotal') }}",
        dataType: "json",
        success: function(data) {
            $(".expensemonth").html(data.month);
        }
    });

    // 9) Net Balance: /reports/getbalance
    $.ajax({
        type: "GET",
        url: "{{ url('reports/getbalance') }}",
        dataType: "json",
        success: function(data) {
            // data.month might be an all-time sum if you updated the controller
            $(".totalbalance").html(data.month);
        }
    });
});
</script>
@endsection
