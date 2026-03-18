<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function handle404()
{
    return $this->renderErrorPage('Error.404', '404 Error', 404);
}

}
