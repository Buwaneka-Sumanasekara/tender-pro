<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Exception;

use App\Http\Traits\CommonTrait;

use App\Models\TmTenderCategory;
use App\Models\TmTender;

class TenderController extends Controller
{
    use CommonTrait;
    
    /*
     * Tender create function
     */

     public function createTender(Request $request){
        try {
            $userSession = $request->session()->get(config("global.session_user_obj"));
            $user_id=$userSession->id;


            $validator=Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|after_or_equal:today',
                'end_date' => 'required|after_or_equal:today',
                'tender_status_id' => 'required|exists:tm_tender_status',
                'deposit' => 'required|digits',
                'estimate_cost' => 'required|digits',
                'location' => 'sometimes',
                'tender_category_id' => 'required|exists:tm_tender_category',
               ],[
                'title.required' => ':attribute is required.',
                'description.required' => ':attribute  is required.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'deposit.required' => 'Deposite amount is required.',
                'estimate_cost.required' => 'Estimate cost amount is required.',
                'location.sometimes' => 'Location cannot be empty',
                'tender_category_id.required' => 'Category is required.',
                'tender_status_id.exists'=>'should be valid status',
                'tm_tender_category.exists'=>'category not avilable'
               ]);
               if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
               }


               DB::beginTransaction();

               $maxId=TmTender::max("id");
               $tenderId=$this->common_generate_next_tender_no($maxId);

               $tender = TmTender::create([
                   'id'=>$tenderId,
                   'title' => $request->get('title'),
                   'description' => $request->get('description'),
                   'start_date'=>$request->get('start_date'),
                   'end_date'=>$request->get('end_date'),
                   'tm_tender_status_id'=>$request->get('tender_status'),
                   'cr_by'=>$user_id,
                   'deposit'=>$request->get('deposit'),
                   'estimate_cost'=>$request->get('estimate_cost'),
                   'location'=>$request->get('location'),
                   'tm_tender_category_id'=>$request->get('category_id'),
               ]);

               DB::commit();


        } catch (\Exception $th) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
     }



     /*
     * Tender Update function (Only drafts)
     */

    public function updateTender(Request $request){
        try {
            $userSession = $request->session()->get(config("global.session_user_obj"));
            $user_id=$userSession->id;


            $validator=Validator::make($request->all(), [
                'id'=>'required|exists:tm_tender',
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|after_or_equal:today',
                'end_date' => 'required|after_or_equal:today',
                'tender_status_id' => 'required|exists:tm_tender_status',
                'deposit' => 'required|digits',
                'estimate_cost' => 'required|digits',
                'location' => 'sometimes',
                'tender_category_id' => 'required|exists:tm_tender_category',
               ],[
                'title.required' => ':attribute is required.',
                'description.required' => ':attribute  is required.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'deposit.required' => 'Deposite amount is required.',
                'estimate_cost.required' => 'Estimate cost amount is required.',
                'location.sometimes' => 'Location cannot be empty',
                'tender_category_id.required' => 'Category is required.',
                'tender_status_id.exists'=>'should be valid status',
                'tm_tender_category.exists'=>'category not avilable'
               ]);
               if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
               }


               DB::beginTransaction();

               $tender = TmTender::find($request->get("id"));

               if($tender->tm_tender_status_id!==config("global.tender_draft")){
                    throw new Exception("Only draft tenders can update");
               }


               $tender->title=$request->get('title');
               $tender->description=$request->get('description');
               $tender->start_date=$request->get('start_date');
               $tender->end_date=$request->get('end_date');
               $tender->tm_tender_status_id=$request->get('tender_status');
               $tender->deposit=$request->get('deposit');
               $tender->estimate_cost=$request->get('estimate_cost');
               $tender->location=$request->get('location');
               $tender->tm_tender_category_id=$request->get('category_id');

               $tender->save();

               DB::commit();


        } catch (\Exception $th) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
     }
}
