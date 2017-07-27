<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ApiController extends Controller
{
     protected $statusCode = 200;

     protected $fractal;

     public function  __construct()
     {
        $this->fractal = new Manager();

        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
     }

     public function respondWithItem($item, $callback)
     {
         $resource = new Item($item, $callback);

         $rootScope = $this->fractal->createData($resource)->toArray();

         return $this->respondWithArray($rootScope);
     }

     public function respondWithCollection($collection, $callback)
     {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource)->toArray();

        return $this->respondWithArray($rootScope);
     }

    /**
     * Respond the data.
     *
     * @param array $array
     * @param array $headers
     * @return mixed
     */
    public function respondWithArray(array $array, array $headers = [])
    {
        return response()->json($array, $this->statusCode, $headers);
    }

    public function noContent()
    {
        return response()->json(null, 204);
    }
}
