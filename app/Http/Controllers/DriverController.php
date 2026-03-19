<?php
namespace App\Http\Controllers;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
         $user = auth()->user();
     
if (auth()->user()->hasRole('super-admin')){
            $drivers = Driver::with('user')->paginate(10);
            return view('driver.index', compact('drivers'));
}elseif (auth()->user()->hasRole('admin')){
            $drivers = Driver::with('user')->paginate(10);
            return view('driver.index', compact('drivers'));
}elseif (auth()->user()->hasRole('mitra')) {
        $drivers = Driver::with('user')->where('mitra_id', $user->id)->paginate(10);
        return view('driver.index', compact('drivers'));
        } else if (auth()->user()->hasRole('driver')) {
            $drivers = Driver::with('user')->where('user_id', $user->id)->paginate(10);
            return view('driver.index', compact('drivers'));
        }
    
    }
    public function create()
    {
        $users = User::role('driver')->get();
        return view('driver.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

$data = $request->validate([
    'nama'    => 'required|string|max:255',
    'user_id' => 'required|exists:users,id',
    'no_hp'   => 'required',
    'alamat'  => 'required',
    'no_sim'  => 'required',
    'status'  => 'required',
]);

$data['mitra_id'] = $user->id;

Driver::create($data);

        return redirect()->route('driver.index')->with('success', 'Driver berhasil ditambahkan');
    }

    public function edit(Driver $driver)
    {
        $users = User::all();
        return view('driver.edit', compact('driver', 'users'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'nama' => 'required',
            'user_id' => 'required|exists:users,id',
            'no_hp' => 'required',
            'alamat' => 'required',
            'no_sim' => 'required',
            'status' => 'required',
        ]);

        $driver->update($request->all());

        return redirect()->route('driver.index')->with('success', 'Driver berhasil diupdate');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return back()->with('success', 'Driver berhasil dihapus');
    }
}
