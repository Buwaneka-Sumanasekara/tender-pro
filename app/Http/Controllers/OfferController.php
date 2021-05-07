<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OmOffer;
use App\Models\TmTender;

class OfferController extends Controller
{
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
                return view('account.offer_view.index',compact('Offer'));
            }else{
               return redirect()->back();
            }    
        }else{
            return abort(404);
        }
    }



}
