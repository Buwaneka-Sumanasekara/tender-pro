<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;
use App\Models\TmTender;
use App\Models\TmTenderCategory;
use App\Models\TmTenderStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TenderController extends Controller
{
    use CommonTrait;

    public function account_show_create_tender(Request $request)
    {
        $tenderCategories = TmTenderCategory::where('active', 1)->get();
        $tenderStatus = TmTenderStatus::where('id', '<>', 0)->get();
        return view('account.tenders_create.index', compact('tenderCategories', 'tenderStatus'));
    }

    /*
     * Tender create function
     */

    public function createTender(Request $request)
    {
        try {
            $userSession = $request->session()->get(config("global.session_user_obj"));
            $user_id = $userSession->id;

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|after_or_equal:today',
                'end_date' => 'required|after_or_equal:today',
                'tender_status' => 'required|exists:tm_tender_status,id',
                'deposit' => 'required|numeric',
                'estimate_cost' => 'required|numeric',
                'location' => 'sometimes',
                'category_id' => 'required|exists:tm_tender_category,id',
            ], [
                'title.required' => ':attribute is required.',
                'description.required' => ':attribute  is required.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'deposit.required' => 'Deposite amount is required.',
                'estimate_cost.required' => 'Estimate cost amount is required.',
                'location.sometimes' => 'Location cannot be empty',
                'category_id.required' => 'Category is required.',
                'tender_status.exists' => 'should be valid status',
                'category_id.exists' => 'category not avilable',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $maxId = TmTender::max("id");
            $tenderId = $this->common_generate_next_tender_no($maxId);

            $start_date = Carbon::parse($request->get('start_date'));
            $end_date = Carbon::parse($request->get('end_date'));

            $tender = TmTender::create([
                'id' => $tenderId,
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'start_date' => $start_date->format('Y-m-d 00:00:00'),
                'end_date' => $end_date->format('Y-m-d 23:59:59'),
                'tm_tender_status_id' => $request->get('tender_status'),
                'crby' => $user_id,
                'deposit' => $request->get('deposit'),
                'estimate_cost' => $request->get('estimate_cost'),
                'location' => $request->get('location'),
                'tm_tender_category_id' => $request->get('category_id'),
            ]);

            DB::commit();

            session()->flash('message', "successfully saved");
            session()->flash('flash_message_type', config("global.flash_success"));
            return redirect()->back();

        } catch (\Exception $th) {
            DB::rollBack();
            session()->flash('message', $th->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

    /*
     * Tender Update function (Only drafts)
     */

    public function updateTender(Request $request)
    {
        try {
            $userSession = $request->session()->get(config("global.session_user_obj"));
            $user_id = $userSession->id;

            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:tm_tender',
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|after_or_equal:today',
                'end_date' => 'required|after_or_equal:today',
                'tender_status_id' => 'required|exists:tm_tender_status,id',
                'deposit' => 'required|numeric',
                'estimate_cost' => 'required|numeric',
                'location' => 'sometimes',
                'tender_category_id' => 'required|exists:tm_tender_category,id',
            ], [
                'title.required' => ':attribute is required.',
                'description.required' => ':attribute  is required.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'deposit.required' => 'Deposite amount is required.',
                'estimate_cost.required' => 'Estimate cost amount is required.',
                'location.sometimes' => 'Location cannot be empty',
                'tender_category_id.required' => 'Category is required.',
                'tender_status_id.exists' => 'should be valid status',
                'tm_tender_category.exists' => 'category not avilable',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $tender = TmTender::find($request->get("id"));

            if ($tender->tm_tender_status_id !== config("global.tender_draft")) {
                throw new Exception("Only draft tenders can update");
            }

            $start_date = Carbon::parse($request->get('start_date'));
            $end_date = Carbon::parse($request->get('end_date'));

            $tender->title = $request->get('title');
            $tender->description = $request->get('description');
            $tender->start_date = $start_date->format('Y-m-d 00:00:00');
            $tender->end_date = $end_date->format('Y-m-d 23:59:59');
            $tender->tm_tender_status_id = $request->get('tender_status');
            $tender->deposit = $request->get('deposit');
            $tender->estimate_cost = $request->get('estimate_cost');
            $tender->location = $request->get('location');
            $tender->tm_tender_category_id = $request->get('category_id');

            $tender->save();

            DB::commit();

            session()->flash('message', "successfully updated");
            session()->flash('flash_message_type', config("global.flash_success"));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }
}
