<?php

namespace App\Http\Controllers\Backoffice\HSP;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolExchangeYear;

class YearController extends Controller {

    public function getYearList()
    {
        $data['yearList'] = HighSchoolExchangeYear::paginate(10);

        return view('backoffice.pages.hsp.year.list', $data);
    }

    public function getCreateYear()
    {
        return view('backoffice.pages.hsp.year.create');
    }

    public function postCreateYear()
    {
        $rules = [
            'year'      => 'required|unique:high_school_exchange_year,year',
            'status'    => 'in:close,open'
        ];

        $this->validate(request(), $rules);

        HighSchoolExchangeYear::create(array_only(request()->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.year.get');
    }

    public function getEditYear($id)
    {
        $data['yearDetail'] = HighSchoolExchangeYear::findOrFail($id);

        return view('backoffice.pages.hsp.year.edit', $data);
    }

    public function postEditYear($id)
    {
        $query = HighSchoolExchangeYear::findOrFail($id);

        $rules = [
            'year'      => 'required|unique:high_school_exchange_year,year,'.$id,
            'status'    => 'in:close,open'
        ];

        $this->validate(request(), $rules);

        $query->update(array_only(request()->all(), array_keys($rules)));

        return redirect()->route('backoffice.hsp.year.get');
    }

    public function getDeleteYear($id)
    {
        $query = HighSchoolExchangeYear::findOrFail($id);

        $query->delete();

        return redirect()->route('backoffice.hsp.year.get');
    }
}