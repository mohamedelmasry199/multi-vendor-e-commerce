<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CurrencyRequest;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check_permission:show_currencies')->only([ 'show', 'index','filter', 'exportCSV', 'search','main']);
        $this->middleware('check_permission:add_currencies')->only(['create', 'store']);
        $this->middleware('check_permission:update_currencies')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_currencies')->only(['destroy']);
    }
    public function index()
    {
        $currencies=Currency::paginate(20);
        return view('admin.currencies.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.currencies.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyRequest $request)
    {
        Currency::create($request->validated());
        return response()->json(['status_code' => 200, 'message' => __('Currency created successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currency=Currency::findOrFail($id);
        return view('admin.currencies.form',compact('currency'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $currency=Currency::findOrFail($id);
        return view('admin.currencies.form',compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyRequest $request, string $id)
    {
        $currency=Currency::findOrFail($id);
        $data = $request->except('flag');

        if ($request->hasFile('flag')) {
            $folder = 'flags';
            $this->deleteOldImage($currency->flag, $folder);
            $data['flag'] = $this->uploadAvatarImage($request->file('flag'), $folder);
        }
        $currency->update($data);
        return response()->json(['status_code' => 200, 'message' => __('Currency updated successfully')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currency=Currency::findOrFail($id);
        $currency->delete();
        return response()->json(['status_code' => 200, 'message' => __('Currency deleted successfully')]);
    }
    public function exportCSV()
    {
        $filename = 'currencies-data.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add BOM to fix UTF-8 in Excel
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'name_en', 'name_ar', 'dollar_rate' ,'Main'
            ]);

            Currency::chunk(25, function ($currencies) use ($handle) {
                foreach ($currencies as $currency) {
                    $data = [
                        isset($currency->name_en) ? $currency->name_en : '-',
                        isset($currency->name_ar) ? $currency->name_ar : '-',
                        isset($currency->dollar_rate) ? $currency->dollar_rate : '-',
                        isset($currency->is_main) ? $currency->is_main : '-',
                    ];
                    fputcsv($handle, $data);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    public function search(Request $request)
    {
        $currencies = Currency::query();

        if ($request->keyword != '') {
            $currencies = $currencies->where(function($query) use ($request) {
                $query->where('name_ar', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('name_en', 'LIKE', '%' . $request->keyword . '%');
        });
        }
        $currencies = $currencies->paginate(20);
        return response()->json([
            'currencies' => $currencies,
            'links' => (string) $currencies->links('admin.partials.paginate')
        ]);
    }
    public function main(Request $request)
{
    $id = $request->id;

    $Currency = Currency::findOrFail($id);

    $value = $request->value;

    $Currency->is_main = $value;

    $Currency->save();

    if($value == 1) {
        $message = __('Enable Main Successfully');
    } else {
        $message = __('Not Main Successfully');
    }

    $arr = array('status' => 'success', 'message' => $message, 'data' => [], 'status_code' => 200);
    return response()->json($arr);
}
public function filter(Request $request)
{
    $rules = [
        'rate_filter' => 'nullable|in:equal,greater,less',
        'rate_value' => 'nullable|numeric|min:0',
        'main_only' => 'nullable|in:on',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $query = Currency::query();

    if ($request->has('main_only')) {
        $query->where('is_main',1);
    }

    if ($request->filled('rate_value')) {
        $rateFilter = $request->input('rate_filter');
        $rateValue = $request->input('rate_value');
        if ($rateFilter && $rateValue !== null) {
            $rateValue = (float) $rateValue;

            switch ($rateFilter) {
                case 'equal':
                    $query->where('dollar_rate', '=', $rateValue);
                    break;
                case 'greater':
                    $query->where('dollar_rate', '>=', $rateValue);
                    break;
                case 'less':
                    $query->where('dollar_rate', '<=', $rateValue);
                    break;
            }
        }
    }

    $currencies = $query->paginate(20);

    return view('admin.currencies.index', compact('currencies'));
}
}
