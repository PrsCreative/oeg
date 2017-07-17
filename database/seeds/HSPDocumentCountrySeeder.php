<?php

use Illuminate\Database\Seeder;
use App\Models\HighSchoolExchangeCountryDocument;

class HSPDocumentCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HighSchoolExchangeCountryDocument::truncate();
        DB::table('high_school_exchange_country_document')->insert(
            [
                [
                    'country'	            => 'usa',
                    'document_path'         => '',
                ],
                [
                    'country'	            => 'french',
                    'document_path'         => '',
                ],
                [
                    'country'	            => 'italian',
                    'document_path'         => '',
                ],
                [
                    'country'	            => 'german',
                    'document_path'         => '',
                ],
                [
                    'country'	            => 'chinese',
                    'document_path'         => '',
                ],
                [
                    'country'	            => 'scan',
                    'document_path'         => '',
                ],
            ]
        );
    }
}
