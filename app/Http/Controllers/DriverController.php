<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function getAll()
    {
        return Driver::with('car')->paginate(10);
    }

    public function getFreeDrivers()
    {
        return Driver::doesntHave('car')->paginate(10);
    }



    public function getById(int $driverId)
    {
        return Driver::find($driverId);
    }

    public function create(Request $request)
    {
        return Driver::create(["name" => $request->name]);
    }

    public function update(Request $request)
    {
        $driver = Driver::find($request->id);

        if ($request->name) {
            $driver = $request->name;
            $driver->save();
        }

        if ($request->car_id) {
            $car = Car::find($request->car_id);
            $driver->car()->save($car);
        }

        return $driver;

    }

    public function destroy(int $driverId)
    {
        return Driver::destroy($driverId);
    }
}
