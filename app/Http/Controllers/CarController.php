<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function getAll()
    {
        return Car::with('driver')->paginate(10);
    }

    public function getUnusedCars()
    {
        return Car::doesntHave('driver')->paginate(10);
    }

    public function create(Request $request)
    {
        return Car::create(["name" => $request->name]);
    }

    public function createWithDriver(Request $request)
    {
        $car = Car::create(["name" => $request->name]);

        $driver = Driver::create(['name' => $request->driver_name]);

        return $car->driver()->save($driver);
    }

    public function update(Request $request)
    {
        $car = Car::find($request->id);
        $car->name = $request->name;
        $car->save();


        $car->driver()->save(Driver::find($request->driver_id));


    }

    public function destroy(int $carId)
    {
        return Car::destroy($carId);
    }
}
