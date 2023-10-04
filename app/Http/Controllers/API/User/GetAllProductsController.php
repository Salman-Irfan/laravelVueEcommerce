<?php

namespace App\Http\Controllers\API\User;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetAllProductsController extends Controller
{
    // get all products
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Product::query()
            ->where('title', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return ProductListResource::collection($query);
    }
}
