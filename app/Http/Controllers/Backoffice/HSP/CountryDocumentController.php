<?php

namespace App\Http\Controllers\Backoffice\HSP;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolExchangeCountryDocument;
use App\Http\Requests;

class CountryDocumentController extends Controller {

    public function getCountryDocumentList()
    {
        // Query
        $query = HighSchoolExchangeCountryDocument::query();

        // Check has search
        if (request()->has('search')) {

            $column = ['country', 'document_path'];

            foreach ($column as $value) {
                $query->orWhere($value, 'LIKE', '%'.request()->get('search').'%');
            }
        }

        $data['page'] = empty(request()->get('page')) ? 1 : request()->get('page');
        $data['limit'] = empty(request()->get('limit')) ? 10 : request()->get('limit');
        $data['countryDocumentList'] = $query->orderBy('id')->paginate($data['limit']);

        return view('backoffice.pages.hsp.country-document.list', $data);
    }

    public function getEditCountryDocument($id)
    {
        $data['countryDocument'] = HighSchoolExchangeCountryDocument::findOrFail($id);

//        dd($data);
        return view('backoffice.pages.hsp.country-document.edit', $data);
    }

    public function postEditCountryDocument($id)
    {
        // Validation
        $rules = [
            'country'           => '',
            'document_path'     => 'mimes:pdf'
        ];

        $this->validate(request(), $rules);

        $countryDocument = HighSchoolExchangeCountryDocument::findOrFail($id);

        $countryDocument->update(array_only(request()->all(), array_keys($rules)));

//        dd($countryDocument);

        return redirect()->route('backoffice.hsp.country-document.location.list.get');
    }
}