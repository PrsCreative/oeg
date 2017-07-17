<?php

namespace App\Http\Controllers\Backoffice\HSP;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolExchangePromotionCode;
use Illuminate\Http\Request;

class PromotionController extends Controller {

    protected $hspPromotion;

    public function __construct(HighSchoolExchangePromotionCode $hspPromotion)
    {
        $this->hspPromotion = $hspPromotion;
    }

    public function getPromotionList(Request $request)
    {
        // Query
        $query = $this->hspPromotion->select('*');

        // Check has search
        if ($request->has('search')) {

            $column = ['code', 'percent', 'type'];

            foreach ($column as $value) {
                $query->orWhere($value, 'LIKE', '%'.$request->get('search').'%');
            }
        }

        $data['promotionList'] = $query->paginate(10);

        return view('backoffice.pages.hsp.promotion.list', $data);
    }

    public function getCreatePromotion()
    {
        return view('backoffice.pages.hsp.promotion.create');
    }

    public function postCreatePromotion(Request $request)
    {
        // Validate
        $rules = [
            'code'          => 'required',
            'percent'       => 'required|integer|max:100',
            'amount'        => 'required|integer',
            'type'          => '',
            'start_date'    => 'required|date_format:d/m/Y',
            'end_date'      => 'required|date_format:d/m/Y',
        ];

        $this->validate($request, $rules);

        // Setting format data before insert
        $request['start_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('start_date'))));
        $request['end_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('end_date'))));

        $this->hspPromotion->create(array_only($request->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.promotion.get');
    }

    public function getEditPromotion($id)
    {
        $data['promotionDetail'] = $this->hspPromotion->findOrFail($id);

        // Change format date
        $data['promotionDetail']['start_date'] = date('d/m/Y', strtotime(str_replace('-', '/', $data['promotionDetail']['start_date'])));
        $data['promotionDetail']['end_date'] = date('d/m/Y', strtotime(str_replace('-', '/', $data['promotionDetail']['end_date'])));

        return view('backoffice.pages.hsp.promotion.edit', $data);
    }

    public function postEditPromotion($id, Request $request)
    {
        // Validate
        $rules = [
            'code'          => 'required',
            'percent'       => 'required|integer|max:100',
            'amount'        => 'required|integer',
            'type'          => '',
            'start_date'    => 'required|date_format:d/m/Y',
            'end_date'      => 'required|date_format:d/m/Y',
        ];

        $this->validate($request, $rules);

        // Setting format data before insert
        $request['start_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('start_date'))));
        $request['end_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('end_date'))));

        $promotion = $this->hspPromotion->findOrFail($id);

        $promotion->update(array_only($request->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.promotion.get');
    }

    public function getDeletePromotion($id)
    {
        $promotion = $this->hspPromotion->findOrFail($id);

        $promotion->delete();

        return redirect()->route('backoffice.hsp.promotion.get');
    }
}