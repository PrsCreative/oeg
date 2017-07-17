<?php

namespace App\Models;

use App\Models\Traits\Image;
use Illuminate\Database\Eloquent\Model;

class HighSchoolExchangeCountryDocument extends Model
{
    use Image;

    protected $table    = 'high_school_exchange_country_document';

    public $timestamps = false;

    protected $guarded  = [];

    protected $imagePath = 'uploads/country';

    public function setDocumentPathAttribute($value)
    {
        $this->storeImage('document_path', $value);
    }

}