<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller {

    /**
     * Display the front page.
     *
     * GET /
     *
     * @return View
     */
    public function index()
    {
      return View::make("pages/index");
    }

    /**
     * Display the specified static view.
     *
     * GET /{path}
     *
     * @return View
     */
    public function show($id)
    {
        return $this->matchStaticView();
    }

    /**
     * Returns the matching static view for the request (if the file
     * exists), otherwise returns the 404 response.
     *
     * TODO: Review the security of matchStaticView() function. Does
     * the Laravel framework already filter the "Request::path()" or
     * "View::make()" methods, or do we need to filter out possible
     * directory traversal attacks from the "requestPath" variable?
     *
     * @param  array $parameters Optional parameters for the View
     * @param  string $view Render the content with the specific view template
     * @return View
     */
    private function matchStaticView($parameters = array(), $view = null)
    {
        $basePath = rtrim(base_path(), "/");
        $requestPath = rtrim(mb_strtolower(Request::path()), "/");
        $fullStaticViewPath = "{$basePath}/resources/views/pages/{$requestPath}";
        $staticViewFilename = "pages/{$requestPath}";

        if (is_dir($fullStaticViewPath)) {
            $staticViewFilename .= "/index";
        }

        if (View::exists($staticViewFilename)) {
            return View::make($staticViewFilename, $parameters);
        }

        if (isset($view) && View::exists($view)) {
            return View::make($view, $parameters);
        }

        # Otherwise return the 404 response
        return App::abort(404);
    }
}
