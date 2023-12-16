<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
class WelcomeController extends Controller
{
    /**
     * Controller function to list quotes
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $quoteManager = app('quote_manager');
        $page = ($request->page ?: 0) + 1;
        $quotes = $quoteManager->driver('kanye')->getQuotes($page);
        return view('welcome', compact('quotes', 'page'));
    }

    public function reset(Request $request)
    {
        Cache::flush();
        return redirect(route('quote-list'));
    }
}
