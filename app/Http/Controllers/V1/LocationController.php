<?php

namespace App\Http\Controllers\V1;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Helpers\RequestHelper;
use App\Helpers\LocationHelper;
use App\Http\Controllers\Controller;

/**
 * Class LocationController
 * @package App\Http\Controllers\V1
 */
class LocationController extends Controller {

    use RequestHelper, LocationHelper;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $locations = Location::orderBy('address', 'asc')->get();
        return $this->response('Locations successfully retrieved', $locations);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request) {

        $locations = Location::where('title', 'LIKE', '%{$request->keywords}%')->get();

        if(!$locations){
            $locations = $this->autocomplete($request->keywords, $request->lng, $request->lat);
        }

        return $this->response('Success', $locations);
    }

    public function store(Request $request) {
        try{
            $location = Location::updateOrCreate(['address' => $request->address], $request->only(['address', 'main', 'sec', 'lat', 'lng']));
            return $this->response('Location successfully saved', $location);
        } catch(\Exception $exception){
            return $this->response('An error occurred', $exception->getMessage(), 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLocation(Request $request) {
        try{
            $data = $this->getGeometry($request->address);
            $location = Location::updateOrCreate([
                    'address' => $data->address,
                ],
                $request->only(['address', 'main', 'sec', 'lat', 'lng'])
            );
            return $this->response('Location successfully saved', $location);
        } catch(\Exception $exception){
            return $this->response('An error occurred', $exception->getMessage(), 422);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        try{
            $location = Location::findOrFail($id);
            return $this->response('Location successfully retrieved', $location);
        } catch(\Exception $exception){
            return $this->response('An error occurred', $exception->getMessage(), 422);
        }
    }
}
