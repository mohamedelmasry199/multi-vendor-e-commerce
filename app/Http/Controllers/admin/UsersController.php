<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Traits\Images;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use Images;

    public function __construct()
    {
        $this->middleware('check_permission:show_users')->only([ 'show', 'index','filter', 'exportCSV', 'search','getCities','liveSearch']);
        $this->middleware('check_permission:add_users')->only(['create', 'store','getCities','liveSearch']);
        $this->middleware('check_permission:update_users')->only(['edit', 'update','getCities','liveSearch']);
        $this->middleware('check_permission:delete_users')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        $countries = Country::all();
        return view('admin.users.index', compact('users', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('admin.users.form', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->except(['password', 'image']);
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAvatarImage($request->file('image'));
        }

        $user = User::create($data);
        $user->country()->associate($request->country);
        $user->city()->associate($request->city);
        $user->save();

        return response()->json(['status_code' => 200, 'message' => __('User created successfully')]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.form', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $countries = Country::all();
        $cities = City::where('country_id', $user->country_id)->get();
        return view('admin.users.form', compact('user', 'countries', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $user=User::findOrFail($id);
        $data = $request->except(['password', 'image']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAvatarImage($request->file('image'));
        }

        $user->country()->associate($request->country);
        $user->city()->associate($request->city);
        $user->update($data);

        return response()->json(['status_code' => 200, 'message' => __('User updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['status_code' => 200, 'message' => 'User deleted successfully']);
    }

    public function getCities($countryId)
    {
        $cities = City::where('country_id', $countryId)->pluck('name_ar', 'id');
        return response()->json($cities);
    }

    public function search(Request $request)
    {
        $users = User::with(['city', 'city.country']);

        if ($request->keyword != '') {
            $users = $users->where(function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhereHas('city', function($q) use ($request) {
                        $q->where('name_ar', 'LIKE', '%' . $request->keyword . '%');
                    })
                    ->orWhereHas('city.country', function($q) use ($request) {
                        $q->where('name_ar', 'LIKE', '%' . $request->keyword . '%');
                    });
            });
        }
        $users = $users->paginate(20);

        return response()->json([
            'users' => $users,
            'links' => (string) $users->links('admin.partials.paginate')
        ]);
    }
    public function exportCSV()
{
    $filename = 'users-data.csv';

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
            'name', 'email', 'phone', 'country', 'city', 'address'
        ]);

        User::chunk(25, function ($users) use ($handle) {
            foreach ($users as $user) {
                $data = [
                    isset($user->name) ? $user->name : '',
                    isset($user->email) ? $user->email : '',
                    isset($user->phone) ? $user->phone : '',
                    isset($user->country->name_ar) ? $user->country->name_ar : '',
                    isset($user->city->name_ar) ? $user->city->name_ar : '',
                    isset($user->address) ? $user->address : '',
                ];
                fputcsv($handle, $data);
            }
        });

        fclose($handle);
    }, 200, $headers);
}
public function active(Request $request)
{
    $id = $request->id;

    $Currency = User::findOrFail($id);

    $value = $request->value;

    $Currency->status = $value;

    $Currency->save();

    if($value == 1) {
        $message = __('Enable Activation Successfully');
    } else {
        $message = __('Disable Activation Successfully');
    }

    $arr = array('status' => 'success', 'message' => $message, 'data' => [], 'status_code' => 200);
    return response()->json($arr);
}
public function filter(Request $request)
    {
        $countries = Country::all();
        $status = $request->input('status');
        $countryId = $request->input('country');
        $cityId = $request->input('city');
        $users = User::query()
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($countryId, function ($query, $countryId) {
                return $query->where('country_id', $countryId);
            })
            ->when($cityId, function ($query, $cityId) {
                return $query->where('city_id', $cityId);
            })
            ->paginate(20);

        return view('admin.users.index', compact('users', 'countries'));
    }
    public function liveSearch(Request $request)
    {
        $query = $request->get('query');
        $users = User::where('name', 'LIKE', "%{$query}%")->get(['id', 'name']);
        return response()->json($users);
    }
}
