<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Traits\CommonTrait;
use App\Models\OmOffer;
use App\Models\TmTender;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    use CommonTrait;

    public function show_offer_create(Request $request,$tenderId){


        $userSession = $request->session()->get(config("global.session_user_obj"));
        $user_id = $userSession->id;

        $FoundOffer=OmOffer::where("vm_vendor_id",$user_id)->where("tm_tender_id",$tenderId);
        
        if($FoundOffer!==null && $FoundOffer->exists()){
            //if offer already exists for current user show it with status
            return redirect()->action([OfferController::class, 'show_offer'],["id"=>$FoundOffer->id]);
        }else{
            $Tender=TmTender::find($tenderId);
            return view('account.offer_create.index',compact('Tender'));     
        }
    }

    public function show_offer(Request $request,$id){
        
        $Offer = OmOffer::find($id);
        if($Offer!==null && $Offer->exists()){
            $userSession = $request->session()->get(config("global.session_user_obj"));
            $user_id = $userSession->id;
            
            if($Offer->vm_vendor_id===$user_id || $userSession->um_user_role_id===config("global.user_role_admin")){//admin can view individual offers
                $Tender=TmTender::find($Offer->tm_tender_id);
                return view('account.offer_view.index',compact('Offer','Tender'));
            }else{
               return redirect()->back();
            }    
        }else{
            return abort(404);
        }
    }


    public function createOffer(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'bid_amount' => 'required|numeric',
                'period_years'=>'required|digits_between:0,20',
                'period_months'=>'required|digits_between:0,12',
                'tender_id'=>'required|exists:tm_tender,id',
                'note'=>'sometimes'
            ], [
                'bid_amount.required' => 'Bid amount is required.',
                'tender_id.required' => 'Tender Id is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();


        $userSession = $request->session()->get(config("global.session_user_obj"));
        $user_id = $userSession->id;

            $maxId = OmOffer::max("id");
            $offerId = $this->common_generate_next_offer_no($maxId);

            $years=$request->get("period_years");
            $months=$request->get("period_months");

            $period=($years>0?($years==1?"1 Year ":$years." Years "):"")."".($months>0?($months===1?"1 Month ":$months." Months "):"");

            $offer = OmOffer::create([
                'id' => $offerId,
                'bid_amount' => $request->get('bid_amount'),
                'period' => $period,
                'om_offer_status_id' => config("global.offer_status_pending"),
                'vm_vendor_id' => $user_id,
                'tm_tender_id'=>$request->get('tender_id'),
                'note'=>$request->get('note')
            ]);


            DB::commit();

            session()->flash('message', "successfully submited your Bid");
            session()->flash('flash_message_type', config("global.flash_success"));
            return redirect()->action([TenderController::class, 'account_show_tenders'],["tenderId"=>$request->get("tender_id")]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }


    public function updateOffer(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'bid_amount' => 'required|numeric',
                'period'=>'required',
                'tender_id'=>'required|exists:tm_tender,id',
                'note'=>'sometimes'
            ], [
                'bid_amount.required' => 'Bid amount is required.',
                'period.required' => 'Period should be defined',
                'tender_id.required' => 'Tender Id is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();


        $userSession = $request->session()->get(config("global.session_user_obj"));
        $user_id = $userSession->id;

            $maxId = OmOffer::max("id");
            $offerId = $this->common_generate_next_offer_no($maxId);

            $offer = OmOffer::create([
                'id' => $offerId,
                'bid_amount' => $request->get('bid_amount'),
                'period' => $request->get('period'),
                'om_offer_status_id' => config("global.offer_status_pending"),
                'vm_vendor_id' => $user_id,
                'tm_tender_id'=>$request->get('tender_id'),
                'note'=>$request->get('note')
            ]);


            DB::commit();

            session()->flash('message', "successfully submited your Bid");
            session()->flash('flash_message_type', config("global.flash_success"));
            return redirect()->action([TenderController::class, 'account_show_tenders'],["tenderId"=>$request->get("tender_id")]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

}
