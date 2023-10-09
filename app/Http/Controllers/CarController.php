<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\ModelCar;
use App\Models\CoordinateCar;
use Illuminate\Http\Request;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index(){
        $car = Car::find(1);
        $car_mg = CoordinateCar::all();
        dd($car);
    }

    public function create(){
        $carsArr = [
            [
                'vin' => '123456789',
                'model' => 'optima',
                'type' => 'sedan',
                'brand' => 'kia',
            ],
        ];

        foreach($carsArr as $item){
            Car::create($item);
        }
        dd('create done');
    }

    public function create_mg(){
            CoordinateCar::create([
                'vin' => 'XXX12345',
                'latitude' => '11.111',
                'longitude' => '22.222', 
            ]);
        $corCar = CoordinateCar::all();
        dd($corCar);
    }

    public function update(){
        $car = Car::find(4);

        $car->update([
            'vin' => 'XXX12345',
        ]);
        dd('update done');
    }

    public function delete(){
        
    }

    //все машины
    public function getCarsInfo(Request $request)
    {
        if (!$request->bearerToken()) {
            return response()->json(['message' => 'Требуется аутентификация'], 401);
        }

        
        $mysqlCars = DB::table('cars')
            ->select('vin', 'model', 'type', 'brand')
            ->get();

        
        $mongoCars = [];

        foreach ($mysqlCars as $car) {
            $vinValue = $car->vin;

            
            $mongoData = CoordinateCar::where('vin', $vinValue)
                ->select('vin', 'latitude', 'longitude')
                ->first();

           
            $modelValue = $car->model;
            $model = ModelCar::where('id', $modelValue)->first();
            $modelName = $model ? $model->name : null;

            
            $brandValue = $car->brand;
            $brand = Brand::where('id', $brandValue)->first();
            $brandName = $brand ? $brand->name : null;

           
            if ($mongoData) {
                $mongoCars[] = [
                    'vin' => $vinValue,
                    'latitude' => $mongoData->latitude,
                    'longitude' => $mongoData->longitude,
                ];
            }

           
            $car->model = $modelName;
            $car->brand = $brandName;
        }

        
        $combinedData = [
            'mysql' => $mysqlCars,
            'mongodb' => $mongoCars,
        ];

        return response()->json(['cars' => $combinedData]);
    }

    //конкретная машина
    public function getCarInfo(Request $request){
    if (!$request->bearerToken()) {
            return response()->json(['message' => 'Требуется аутентификация'], 401);
        }

        $id = $request->input('id');

        
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['message' => 'Данные не найдены в MySQL'], 404);
        }

       
        $modelValue = $car->model;
        $model = ModelCar::where('id', $modelValue)->first();
        $modelName = $model ? $model->name : null;

        
        $brandValue = $car->brand;
        $brand = Brand::where('id', $brandValue)->first();
        $brandName = $brand ? $brand->name : null;

        
        $vinValue = $car->vin;
        $mongoData = CoordinateCar::where('vin', $vinValue)
            ->select('vin', 'latitude', 'longitude')
            ->first();

       
        $combinedData = [
            'mysql' => [
                'id' => $car->id,
                'vin' => $car->vin,
                'model' => $modelName, 
                'type' => $car->type,
                'brand' => $brandName, 
            ],
            'mongodb' => $mongoData,
        ];

        return response()->json(['car' => $combinedData]);
    }

}
