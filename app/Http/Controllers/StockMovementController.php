<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    /**
     * @var object (get the model instance)
     */
    private $stockMovement;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->stockMovement = StockMovement::query();
    }

    /**
     * - Returns all registered movements
     * - Filters
     * @param  \Illuminate\Http\Request  $request
     * @param string $request->search (display all items that are those given)
     * @param string $request->field (select which field you want to sort)
     * @param string $request->order (ascending or descending order)
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request->field) && !empty($request->field)) {

            if (isset($request->order) && !empty($request->order) && $request->order == 'desc') {
                $this->stockMovement->orderBy('id', 'desc');
            } else {
                $this->stockMovement->orderBy($request->field);
            }

        } else {
            $this->stockMovement->orderBy('id');
        }

        if (isset($request->search) && !empty($request->search)) {

            $this->stockMovement
                ->orWhere('id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('product_id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('movements', 'LIKE', '%' . $request->search . '%')
                ->distinct();
        }

        $data = $this->stockMovement->get()->toArray();

        return response()->json([
            'message' => count($data) > 0 ? $data : 'There is currently no history of registered movements.',
            'success' => 1,
        ], 200);
    }

    /**
     * Search for specific movement
     * @param $id (movement id)
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {

        if (!empty($id) && is_numeric($id)) {

            $data = $this->stockMovement->find($id)->toArray();

            return response()->json([
                'message' => $data ? $data : 'Movement ID:' . $id . ' not found or does not exist.',
                'success' => 1,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid id.',
                'success' => 0,
            ], 400);
        }

    }

    /**
     * Delete a movement
     * @param $id (movement id)
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {

        if (!empty($id) && is_numeric($id)) {

            $result = $this->stockMovement->where('id', $id)->delete();

            if ($result) {
                return response()->json([
                    'message' => 'Movement ID: ' . $id . ' successfully removed.',
                    'success' => 1,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed to remove the movement ID: ' . $id . '.',
                    'success' => 0,
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Invalid id.',
            'success' => 0,
        ], 400);
    }
}
