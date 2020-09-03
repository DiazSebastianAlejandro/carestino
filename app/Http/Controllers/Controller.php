<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

        /**
    * @OA\Info(title="API Carestino", version="1.0" ,@OA\License(
    *          name="Apache 2.0",
    *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
    *      ))
    *
    * @OA\Server(url="http://127.0.0.1:8001/")
    *
    */
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
