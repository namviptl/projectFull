<?php

namespace App\Http\Controllers;

use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Discount;
use DB;
use Log;

class DiscountController extends Controller
{
    //
    use DeleteModelTrait;

    private $discount;

    public function __construct(Discount $discount){
		$this->discount = $discount;
	}

	public function index()
    {
        $discounts = $this->discount->latest()->paginate(10);

    	return view('admin.discount.index', compact('discounts'));
    }

    public function create()
    {
    	return view('admin.discount.add');
    }

    public function store(Request $request)
    {

        try{
            DB::beginTransaction();

            $this->discount->create([
                'code' => $request->code,
                'discount' => $request->discount,
                'start_day' => $request->start_day,
                'end_day' => $request->end_day,
                
            ]);

            DB::commit();
            return redirect()->route('discount.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('Message: '. $exception->getMessage() . 'line : '. $exception->getLine());
        }
    }
}
