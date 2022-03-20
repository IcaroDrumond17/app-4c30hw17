<?php

namespace App\Http\Controllers;

use App\Models\Products;

class HomeController extends Controller
{
    /**
     * @var object (get the model instance)
     */
    private $products;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->products = Products::query();
    }

    /**
     * @return
     * returns to view all product data and their movements using the relationship between the tables.
     */
    public function index()
    {
        $data = $this->products->with([
            'movements',
        ])->orderBy('id')->get()->toArray();

        return view('home', ['data' => $data]);
    }
}
