<?php

namespace App\Http\Controllers\V1;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Helpers\RequestHelper;
use App\Http\Controllers\Controller;

class LocationController extends Controller {

    use RequestHelper;

    public function search(Request $request) {
        return $this->response('Success', []);
    }

    public function store(Request $request) {

    }
}
