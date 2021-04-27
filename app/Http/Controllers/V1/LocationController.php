<?php

namespace App\Http\Controllers\V1;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;

class LocationController extends Controller {

    use RequestHelper;

    public function index() {
        $locations = Location::orderBy('id')->get();
        return $this->response('Locations successfully retrieved', $locations);
    }

    public function search(Request $request) {
        return $this->response('Success', []);
    }

    public function store(Request $request) {
        try{
            $location = Location::create([
                'address' => $request->address,
                'street_name' => $request->main,
                'country' => $request->sec,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
            return $this->response('Location successfully saved', $location);
        } catch(\Exception $exception){
            return $this->response('An error occured', $exception->getMessage(), 422);
        }
    }

    public function show($id) {
        try{
            $location = Location::findOrFail($id);
            return $this->response('Location successfully deleted');
        } catch(\Exception $exception){
            return $this->response('An error occured', $exception->getMessage(), 422);
        }
    }
}
