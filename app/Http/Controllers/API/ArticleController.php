<?php

namespace App\Http\Controllers\API;
/**
 * @OA\Info(title="FarmClub - API to manage stores & articles", version="1.0.0")
 * @OA\Server(url="http://localhost:8000")
 */


use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/articles",
     *     operationId="index",
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/articles",
     *     operationId="store",
     *     @OA\Parameter(
               name="newStore",
               in="path",
               description="Object containing the following properties: name, price, store_id, description, total_in_shelf, total_in_vault"
     *     ),
     *     @OA\Response(response="201", description="Created"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:articles|max:255',
            'price' => 'required',
            'store_id' => 'required',
            'description' => 'required',
            'total_in_shelf' => 'required',
            'total_in_vault' => 'required'
        ]);

        $article = Article::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'store_id' => $request['store_id'],
            'description' => $request['description'],
            'total_in_shelf' => $request['total_in_shelf'],
            'total_in_vault' => $request['total_in_vault']
        ]);

        return response()->json($article, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/articles/{articleId}",
     *     operationId="show",
     *     @OA\Parameter(
               name="articleId",
               in="path",
               description="Integer that identifies which article to display"
     * ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function show($id)
    {
        $article = Article::find($id);
        return response()->json($article, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/articles/{articleId}",
     *     operationId="update",
     *     @OA\Parameter(
                name="articleId",
                in="path",
                description="Integer that identifies which article to update"
     * ),
     *     @OA\Parameter(
                name="body",
                in="query",
                description="Object containing relevant fields to update: total_in_shelf (integer) or total_in_vault (integer)"
     * ),
     *     @OA\Response(response="201", description="Accepted"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->total_in_shelf = $request->get('total_in_shelf');
        $article->total_in_vault = $request->get('total_in_vault');
        $article->save();
        return response()->json($article, 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/articles/{articleId}",
     *     operationId="destroy",
     *     @OA\Parameter(
                name="articleId",
                in="path",
                description="Integer that identifies which article to delete"
     * ),
     *     @OA\Response(response="204", description="No Content"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function destroy($id)
    {
        $article = Article::where('id', $id)->first();
        $article->delete();
        return response()->json(null, 204);
    }
}
