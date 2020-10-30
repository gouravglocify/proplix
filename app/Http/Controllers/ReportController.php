<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;
use App\Http\Resources\Report as ReportResource;
use App\Http\Resources\ReportCollection;
use PDF;
use PhpOffice\PhpWord\TemplateProcessor;
use Auth;
use App\UserDefaultValue;
use Excel;
use App\Exports\UsersReportExport;
use App\UserCalculation;
use App\UserSubscription;
class ReportController extends Controller
{	

	public function dashboard(Request $request){
		$userDetails = Auth::user();
		$reports = Report::where('user_id', $userDetails->id)->get();
		$getDefaultValues = UserDefaultValue::where('user_id',$userDetails->id)->first();
        $getUserSubscription = UserSubscription::where([
                                    ['user_id','=',$userDetails->id],
                                    ['status','=','active'],        
                               ])->orderBy('id','DESC')->first();
        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
		return view('reports.dashboard', compact('reports','getDefaultValues','userDetails','getUserSubscription','getCaluationshit'));
	}
	public function calculator(Request $request){
		$reports = Report::all();
		$userDetails = Auth::user();
		$getDefaultValues = UserDefaultValue::where('user_id',$userDetails->id)->first();
        $getUserSubscription = UserSubscription::where([
                                    ['user_id','=',$userDetails->id],
                                    ['status','=','active'],        
                               ])->orderBy('id','DESC')->first();
        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
		return view('reports.calculator', compact('reports', 'userDetails','getDefaultValues','getCaluationshit','getUserSubscription'));
	}
	public function allReports(Request $request){
		$userDetails = Auth::user();
		$reports = Report::where('user_id', $userDetails->id)->orderBy('id', 'DESC')->get();
        $getUserSubscription = UserSubscription::where([
                                    ['user_id','=',$userDetails->id],
                                    ['status','=','active'],        
                               ])->orderBy('id','DESC')->first();
        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
		return view('reports.allReport', compact('reports','userDetails','getUserSubscription','getCaluationshit'));
	}

    public function addUserDefaultValues(Request $request){
    	$userDetails = Auth::user();
    	$data = [
    				'user_id'=>$userDetails->id,
					'average_shipping_cost'=>is_null($request->average_shipping_cost)?null:$request->average_shipping_cost,
					'average_rto_charge'=>is_null($request->average_rto_charge)?null:$request->average_rto_charge,
                    'weight_segment'=>is_null($request->weight_segment)?null:$request->weight_segment,
					'packaging_cost'=>is_null($request->packaging_cost)?null:$request->packaging_cost,
				];

    	$getOldDefaultvalues = UserDefaultValue::where('user_id',$userDetails->id)->first();
    	if(is_null($getOldDefaultvalues)){
    		UserDefaultValue::create($data);
    	}
    	else{
    		UserDefaultValue::where('id',$getOldDefaultvalues->id)->update($data);
    	}
    	return redirect(url("dashboard"));
    }

    public function addReport(Request $request){
    	$userDetails = Auth::user();
    	$data = $request->input('data');
    	$data['user_id'] = $userDetails->id;
    	$data['title'] = $request->input('title');
    	$insertReport = Report::create($data);
    	if(is_null($insertReport)){
    		return ['success'=>false,'message'=>'Something went wrong.'];
    	}
    	else{
    		return ['success'=>true,'message'=>'Report saved successfully.'];
    	}

    }

    public function viewReport(Request $request,$id){
    	$userDetails = Auth::user();
    	$getReportDetails = Report::where([
    							['user_id','=',$userDetails->id],
    							['id','=',base64_decode($id)]
    						])->first();
    	if(is_null($getReportDetails)){
    		return redirect(url('allReports'));
    	}
        $getUserSubscription = UserSubscription::where([
                                    ['user_id','=',$userDetails->id],
                                    ['status','=','active'],        
                               ])->orderBy('id','DESC')->first();
        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
        $getDefaultValues = UserDefaultValue::where('user_id',$userDetails->id)->first();
    	return view('reports.viewReport',compact('userDetails','getReportDetails','getDefaultValues','getCaluationshit','getUserSubscription'));
    }

    public function editReport(Request $request){
    	$userDetails = Auth::user();
    	$getReportDetails = Report::where([
    							['user_id','=',$userDetails->id],
    							['id','=',base64_decode($request->input('id'))]
    						])->first();
    	if(is_null($getReportDetails)){
    		return ['success'=>false,'message'=>'Unauthorized Access ! '];
    	}
    	$data = $request->input('data');
    	$data['title'] = $request->input('title');
    	$update = Report::where('id',$getReportDetails->id)->update($data);
    	if($update===1){
    		return ['success'=>true,'message'=>'Report updated successfully.'];
    	}
    	else{
    		return ['success'=>false,'message'=>'Something went wrong.'];
    	}
    }

    public function downloadMultipleReports(Request $request){
        $reports = array();
        $userDetails = Auth::user();
        if(is_null($request->input('ids'))){
            return redirect(url('allReports'));
        }

        foreach(explode(",",$request->input('ids')) as $ids){
            $report = Report::where([
                                ['user_id','=',$userDetails->id],
                                ['id','=',base64_decode($ids)]
                            ])->first();
            if(!is_null($report)){
                    $reports[] = $report;
                }
        }

        //PDF   
        if($request->input('type')=='pdf'){
            $pdf = PDF::loadView('exports.reportsExcel', compact('reports'))->setPaper('a4', 'landscape');
            return $pdf->download(base64_encode($userDetails->id).'_reports.pdf');
        }      
        //EXCEL
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new UsersReportExport($reports), base64_encode($userDetails->id).'_reports.xlsx');
    }

    public function deleteReport(Request $request,$id){
    	$userDetails = Auth::user();
    	$getReportDetails = Report::where([
    							['user_id','=',$userDetails->id],
    							['id','=',base64_decode($id)]
    						])->first();
    	if(is_null($getReportDetails)){
    		return redirect(url('allReports'));
    	}
		
		Report::where('id',$getReportDetails->id)->delete();
		return redirect(url('allReports'));

    }


    public function downloadReport(Request $request, $type, $id){
        if($type!='pdf' && $type!='excel'){
            return redirect(url('allReports'));
        }
        $reports = array();
        $userDetails = Auth::user();
        $report = Report::where([
                                ['user_id','=',$userDetails->id],
                                ['id','=',base64_decode($id)]
                            ])->first();
        if(is_null($report)){
            return redirect(url('allReports'));
        }
        $reports[] = $report;
        if($type=='pdf'){
            $pdf = PDF::loadView('exports.reportsExcel', compact('reports'))->setPaper('a4', 'landscape');
             return $pdf->download(base64_encode($userDetails->id).'_'.$report->title . '.pdf');
        }
        //EXCEL
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new UsersReportExport($reports), base64_encode($userDetails->id).'_'.$report->title.'.xlsx');
    }

    public function addCalculation(Request $request){
        $userDetails = Auth::user();
        $checkCalculation = UserCalculation::where('user_id',$userDetails->id)->get();
        if(count($checkCalculation)<=20){
            UserCalculation::create(['user_id'=>$userDetails->id]);
            $checkCalculation = UserCalculation::where('user_id',$userDetails->id)->get();
        }
        return count($checkCalculation);
    }

    public function calculations(Request $request){
        $data = $request->input('datas');
        $response = array();

        //CALCULATE SALE VALUE
        $response['saleValue'] = 0;
        if($data['sellingPrice']>0 && !empty($data['orders'])){
            $saleValue = $data['sellingPrice'] * $data['orders'];
            $response['saleValue'] = $saleValue;
        }

        //CALCULATE DISPATCHED ORDER VALUE
        $response['dispatchOrderValue'] = 0;
        if(isset($data['cancel']) && !empty($data['orders'])){
            $dispatchOrderValue =  $data['sellingPrice'] * ($data['orders'] - ($data['orders'] * ($data['cancel']/100) ));
            $response['dispatchOrderValue'] = $dispatchOrderValue;
        }

        //CALCULATE AD COST      
        $response['adCost'] = 0;  
        if($data['roas']>0){
            $adCost = $saleValue/$data['roas'];          
            $response['adCost'] = $adCost;       
        }

        //CALCULATE CPP COST
        $response['cppValue'] = 0;
        if($data['orders']>0){
            $cppValue = ($response['adCost']/$data['orders']);         
            $response['cppValue'] = $cppValue;             
        }

        //CALCULATE DELIVERY COST
        $response['delivered'] = 0;
        if($data['delivery']>0){
            $delivered = ($data['delivery'] * ($data['orders'] - ($data['orders'] * ($data['cancel']/100) )))/100;     
            $response['delivered'] = $delivered;             
        }

        //CALCULATE PRODUCT COST
        $response['productCostValue'] = 0;
        if($data['productCost']>0){
            $productCostValue = ($data['productCost']*$response['delivered']);         
            $response['productCostValue'] = $productCostValue;             
        }

        //CALCULATE REMITTANCE COST
        $response['remittance'] = 0;
        if($response['dispatchOrderValue']>0){
            $remittance = ($response['dispatchOrderValue']*$data['delivery'])/100;         
            $response['remittance'] = $remittance;             
        }

        //CALCULATE GST COST
        $response['gst'] = 0;
        if($response['remittance']>0){
            $gst = ($data['gstPercent']*$response['remittance'])/100;         
            $response['gst'] = $gst;             
        }

        //CALCULATE PACKAGING COST
        $response['packaging'] = 0;
        if($data['orders']>0){
            $packaging = $data['packagingCost'] * ($data['orders'] - ($data['orders'] * ($data['cancel']/100)));        
            $response['packaging'] = $packaging;             
        }

        //CALCULATE SHIPPING COST
        $response['shipping'] = 0;
        if($data['orders']>0){
            if($data['weightSegment']<=500){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])));
            }
            elseif($data['weightSegment']>500 && $data['weightSegment']<=1000){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*2;
            }   
            elseif($data['weightSegment']>1000 && $data['weightSegment']<=1500){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*3;
            }  
            elseif($data['weightSegment']>1500 && $data['weightSegment']<=2000){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*4;
            } 
            elseif($data['weightSegment']>2000 && $data['weightSegment']<=2500){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*5;
            }
            elseif($data['weightSegment']>2500 && $data['weightSegment']<=3000){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*6;
            }
            elseif($data['weightSegment']>3000 && $data['weightSegment']<=3500){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*7;
            }
            elseif($data['weightSegment']>3500 && $data['weightSegment']<=4000){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*8;
            }
            elseif($data['weightSegment']>4000 && $data['weightSegment']<=4500){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*9;
            }
            elseif($data['weightSegment']>4500 && $data['weightSegment']<=5000){
                $shipping = (($response['delivered'] * $data['avgShippingCost'])+($data['avgRtoCharge']*(($data['orders'] - ($data['orders'] * ($data['cancel']/100))) - $response['delivered'])))*10;
            }
            $response['shipping'] = $shipping;             
        }

        //CALCULATE TOTAL EXPENSE
        $response['totalExpenses'] = 0;
        if($data['orders']>0){
            $totalExpenses = $response['adCost']+$response['productCostValue']+$response['gst']+$response['packaging']+$response['shipping'];         
            $response['totalExpenses'] = $totalExpenses;             
        }

        //CALCULATE TOTAL PROFIT
        $response['totalProfit'] = 0;
        if($response['totalExpenses']>0){
            $totalProfit = $response['remittance']-$response['totalExpenses'];         
            $response['totalProfit'] = $totalProfit;             
        }

        //CALCULATE PROFIT PER DELIVERY
        $response['profitPerDelivery'] = 0;
        if($response['delivered']>0){
            $profitPerDelivery = $response['totalProfit']/$response['delivered'];         
            $response['profitPerDelivery'] = $profitPerDelivery;             
        }

        //CALCULATE PROFIT PER ORDER
        $response['profitPerOrder'] = 0;
        if($data['orders']>0){
            $profitPerOrder = $response['totalProfit']/$data['orders'];         
            $response['profitPerOrder'] = $profitPerOrder;             
        }

        return $response;
    }
}
