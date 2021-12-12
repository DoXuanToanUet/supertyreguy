<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Currency;
use App\Models\Item;
use App\Models\ScrapItemHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopyScrapingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:scraping_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy data from scraped database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $getWheelData       = null;
            $getTyreData        = null;
            $getWheelLastDataId = null;
            $getTyreLastDataId  = null;

            if ($scrapHistory = ScrapItemHistory::orderBy('id', 'DESC')->first()) {

                $getWheelData = DB::connection(env('SCRAP_DB_CONNECTION'))
                    ->table('dtm')
                    ->where('id', '>', $scrapHistory->last_wheel_item_id)
                    ->get();

                $getTyreData = DB::connection(env('SCRAP_DB_CONNECTION'))
                    ->table('tyreorder')
                    ->where('id', '>', $scrapHistory->last_tyre_item_id)
                    ->get();

            } else {
                $getWheelData = DB::connection(env('SCRAP_DB_CONNECTION'))
                    ->table('dtm')
                    ->get();

                $getTyreData = DB::connection(env('SCRAP_DB_CONNECTION'))
                    ->table('tyreorder')
                    ->get();
            }

            if ($getWheelData->count() > 0) {

                foreach ($getWheelData as $key => $wheel) {

                    $isBrand = Brand::where('name', $wheel->brand)->first();
                    if (!$isBrand) {
                        $isBrand = Brand::create([
                            'name'   => $wheel->brand,
                            'slug'   => $wheel->brand,
                            'status' => 0,
                        ]);
                    }

                    $status              = 0;
                    $specificationNames  = ['code', 'url', 'colour', 'size', 'width', 'stud', 'stud2', 'offset', 'centreBore', 'image2', 'image3', 'image4', 'image5'];
                    $specificationValues = [$wheel->code, $wheel->url, $wheel->colour, $wheel->size, $wheel->width, $wheel->stud, $wheel->stud2, $wheel->offset, $wheel->centreBore, $wheel->image2, $wheel->image3, $wheel->image4, $wheel->image5];

                    if (intval($wheel->stock) >= 3) {
                        $status = 1;
                    }

                    if (empty($wheel->small_image) || empty($wheel->image1)) {
                        $status = 0;
                    }

                    $isWheelCreate = Item::create([
                        'category_id'               => 29,
                        'brand_id'                  => $isBrand->id,
                        'name'                      => $wheel->title,
                        'slug'                      => preg_replace("/[^A-Za-z0-9*]/i", '-', $wheel->title),
                        'sku'                       => $wheel->code,
                        'source'                    => $wheel->source,
                        'sort_details'              => $wheel->description,
                        'details'                   => $wheel->long_desc ?? $wheel->description,
                        'photo'                     => "scrapers/" . $wheel->image1,
                        'thumbnail'                 => "scrapers/" . $wheel->small_image,
                        'stock'                     => $wheel->stock,
                        'is_specification'          => 1,
                        'specification_name'        => json_encode($specificationNames),
                        'specification_description' => json_encode($specificationValues),
                        'status'                    => $status,
                    ]);

                    $getWheelLastDataId = $wheel->id;
                }
            } else {
                $getWheelLastDataId = $scrapHistory->last_wheel_item_id;
            }

            if ($getTyreData->count() > 0) {

                $curr = Currency::where('is_default', 1)->first();

                foreach ($getTyreData as $key => $tyre) {
                    if($tyre->width!=null && $tyre->profile!=null &&  $tyre->rim!=null){
                        $status                  = 0;
                        $tyreSpecificationNames  = ['url', 'small_name', 'large_name', 'width', 'profile', 'rim', 'category1', 'category2', 'status'];
                        $tyreSpecificationValues = [$tyre->url, $tyre->small_name, $tyre->large_name, $tyre->width, $tyre->profile, $tyre->rim, $tyre->category1, $tyre->category2, $tyre->status];

                        if (intval($tyre->stock) >= 3) {
                            $status = 1;
                        }

                        if (empty($tyre->small_name) || empty($tyre->large_name)) {
                            $status = 0;
                        }

                        $tyre_price=is_numeric($tyre->price) ? ($tyre->price / $curr->value) : 0;

                        $isTyreCreate = Item::create([
                            'category_id'               => 28,
                            'photo'                     => "scrapers/tyreorder/" . $tyre->large_name,
                            'thumbnail'                 => "scrapers/tyreorder/" . $tyre->small_name,
                            'name'                      => $tyre->name,
                            'slug'                      => preg_replace("/[^A-Za-z0-9*]/i", '-', $tyre->name),
                            'previous_price'            => is_numeric($tyre->price) ? ($tyre_price) : 0,
                            'discount_price'            => is_numeric($tyre->price) ? ($tyre_price+($tyre_price*.35)) : 0,
                            'marketing_price'           => is_numeric($tyre->price) ? ($tyre_price+($tyre_price*.35)+($tyre_price*.15)) : 0,
                            'stock'                     => $tyre->stock,
                            'sort_details'              => $tyre->description,
                            'details'                   => $tyre->description,
                            'is_specification'          => 1,
                            'specification_name'        => json_encode($tyreSpecificationNames),
                            'specification_description' => json_encode($tyreSpecificationValues),
                            'status'                    => $status,
                        ]);
                    }
                    
                    $getTyreLastDataId = $tyre->id;
                }
            } else {
                $getTyreLastDataId = $scrapHistory->last_tyre_item_id;
            }

            if (!empty($getWheelLastDataId) && !empty($getTyreLastDataId)) {
                ScrapItemHistory::create([
                    'date'               => now(),
                    'last_wheel_item_id' => $getWheelLastDataId,
                    'last_tyre_item_id'  => $getTyreLastDataId,
                ]);
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }

        DB::commit();
        return true;
    }
}
