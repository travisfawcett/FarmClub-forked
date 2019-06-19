<?php

namespace App\Http\Controllers\API;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/stores",
     *     operationId="index",
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function index()
    {
        $stores = Store::all();
        return response()->json($stores, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/stores",
     *     operationId="store",
     *     @OA\Parameter(
                name="newArticle",
                in="path",
                description="Object containing the following properties: name, address"
     * ),
     *     @OA\Response(response="201", description="Created"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|unique:stores',
            'address' => 'required|string|unique:stores'
        ]);

        $store = Store::create([
            'name' => $request['name'],
            'address' => $request['address']
        ]);

        return response()->json($store, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/stores/{storeId}",
     *     operationId="show",
     *     @OA\Parameter(
                name="storeId",
                in="path",
                description="Integer that identifies which store to display"
     * ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function show($id)
    {
        $store = Store::find($id);
        return response()->json($store, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/stores/{storeId}",
     *     operationId="update",
     *     @OA\Parameter(
                name="storeId",
                in="path",
                description="Integer that identifies which store to update"
     * ),
     *     @OA\Parameter(
                name="body",
                in="query",
                description="Object containing relevant fields to update: name (string), address (string)"
     * ),
     *     @OA\Response(response="202", description="Accepted"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        $store->name = $request->get('name');
        $store->address = $request->get('address');
        $store->save();
        return response()->json($store, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/stores/{storeId}",
     *     operationId="destroy",
     *     @OA\Parameter(
                name="storeId",
                in="path",
                description="Integer that identifies which store to delete"
     * ),
     *     @OA\Response(response="204", description="No Content"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function destroy($id)
    {
        $store = Store::where('id', $id)->first();
        $store->delete();
        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/stores/{storeId}/articles",
     *     operationId="articles",
     *     @OA\Parameter(
                name="storeId",
                in="path",
                description="Integer that identifies which store's articles to display"
     * ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function articles($id)
    {
        $store = Store::find($id);
        $store_articles = $store['articles'];
        return response()->json($store_articles, 200);
    }
}
