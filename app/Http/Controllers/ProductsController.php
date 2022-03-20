<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * @var object (get the model instance)
     */
    private $products;
    private $stockMovement;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->products = Products::query();
        $this->stockMovement = StockMovement::query();
    }

    /**
     * - Returns all registered products
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
                $this->products->orderBy('id', 'desc');
            } else {
                $this->products->orderBy($request->field);
            }

        } else {
            $this->products->orderBy('id');
        }

        if (isset($request->search) && !empty($request->search)) {

            $this->products
                ->orWhere('id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nome', 'LIKE', '%' . $request->search . '%')
                ->orWhere('SKU', 'LIKE', '%' . strtoupper($request->search) . '%')
                ->orWhere('quantidade', 'LIKE', '%' . $request->search . '%')
                ->distinct();
        }

        $data = $this->products->get()->toArray();

        return response()->json([
            'message' => count($data) > 0 ? $data : 'There are currently no registered products.',
            'success' => 1,
        ], 200);
    }

    /**
     * Search for specific product
     * @param $id (product id)
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {

        if (!empty($id) && is_numeric($id)) {

            $data = $this->products->find($id)->toArray();

            return response()->json([
                'message' => $data ? $data : 'Product ID:' . $id . ' not found or does not exist.',
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
     * Inserts new products
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->all())) {

            $result = $this->products->create([
                'nome' => $request->input("nome"),
                'SKU' => strtoupper($request->input("SKU")),
                'quantidade' => $request->input("quantidade"),
            ]);

            if ($result->id > 0) {
                return response()->json([
                    'message' => 'Product ID: ' . $result->id . ' successfully entered.',
                    'success' => 1,
                ], 201);
            }

        }

        return response()->json([
            'message' => 'Failed to insert product.',
            'success' => 0,
        ], 400);
    }

    /**
     * Update product data
     * @param $id (product id)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {

        if (!empty($id) && is_numeric($id)) {

            if (!empty($request->all())) {
                $result = $this->products->where('id', $id)
                    ->update($request->all());

                if ($result) {
                    return response()->json([
                        'message' => 'Product ID: ' . $id . ' successfully updated.',
                        'success' => 1,
                    ], 201);
                } else {
                    return response()->json([
                        'message' => 'Failed to update the product ID: ' . $id . '.',
                        'success' => 0,
                    ], 200);
                }

            }

            return response()->json([
                'message' => 'Failed to update the product, empty data.',
                'success' => 0,
            ], 400);

        }

        return response()->json([
            'message' => 'Failed to update product. ID null or does not exist.',
            'success' => 0,
        ], 400);
    }

    /**
     * Delete a product
     * @param $id (product id)
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {

        if (!empty($id) && is_numeric($id)) {

            $result = $this->products->where('id', $id)->delete();

            if ($result) {
                return response()->json([
                    'message' => 'Product ID: ' . $id . ' successfully removed.',
                    'success' => 1,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed to remove the product ID: ' . $id . '.',
                    'success' => 0,
                ], 200);
            }

        }

        return response()->json([
            'message' => 'Invalid id.',
            'success' => 0,
        ], 400);
    }

    /**
     * Add stock to product
     * @var $sku (product SKU)
     * @var $quantidade (product ) ------------------------------ atualizar aki
     * @return \Illuminate\Http\Response
     */
    public function increaseStock($sku = null, $quantidade = 0)
    {
        if (!empty($sku)) {
            $sku = strtoupper($sku);

            if (is_numeric($quantidade) && $quantidade > 0) {
                $result = $this->products->where('SKU', $sku)->increment('quantidade', $quantidade);

                if ($result) {
                    $m_result = $this->updateMovement([
                        [
                            'message' => 'Success in incrementing ' . $quantidade . ' unit(s) of the product SKU: ' . $sku . '.',
                            'updated' => date('Y/m/d \a\t H:i:s'),
                        ],
                    ], $sku);

                    return response()->json([
                        'message' => 'Success in incrementing ' . $quantidade . ' unit(s) of the product SKU: ' . $sku . '.',
                        'movements' => $m_result ? 'History successfully updated.' : 'Failed to update history.',
                        'success' => 1,
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Failed to increment ' . $quantidade . ' unit(s) of the product SKU: ' . $sku . '.',
                        'success' => 0,
                    ], 200);
                }

            }

            return response()->json([
                'message' => 'Failed to update stock for the product SKU: ' . $sku . '. Null quantity or does not exist',
                'success' => 0,
            ], 400);
        }

        return response()->json([
            'message' => 'Failed to update stock for the product SKU: ' . $sku . '. SKU null or does not exist.',
            'success' => 0,
        ], 400);
    }

    /**
     * Withdraw product stock
     * @var $sku (product SKU)
     * @var $quantidade (product ) ------------------------------ atualizar aki
     * @return \Illuminate\Http\Response
     */
    public function decreaseStock($sku = null, $quantidade = 0)
    {
        if (!empty($sku)) {
            $sku = strtoupper($sku);

            if (is_numeric($quantidade) && $quantidade > 0) {

                $result = $this->products->where('SKU', $sku)->decrement('quantidade', $quantidade);

                if ($result) {

                    $m_result = $this->updateMovement([
                        [
                            'message' => 'Success in decrementing ' . $quantidade . ' unit(s) of the product SKU: ' . $sku . '.',
                            'updated' => date('Y/m/d \a\t H:i:s'),
                        ],
                    ], $sku);

                    return response()->json([
                        'message' => 'Success in decrementing ' . $quantidade . ' unit(s) of the product SKU: ' . $sku . '.',
                        'movements' => $m_result ? 'History successfully updated.' : 'Failed to update history.',
                        'success' => 1,
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Failed to decrement ' . $quantidade . ' unit(s) of the product SKU: ' . $sku . '.',
                        'success' => 0,
                    ], 200);
                }

            }

            return response()->json([
                'message' => 'Failed to update stock for the product SKU: ' . $sku . '. Null quantity or does not exist',
                'success' => 0,
            ], 400);
        }

        return response()->json([
            'message' => 'Failed to update stock for the product SKU: ' . $sku . '. SKU null or does not exist.',
            'success' => 0,
        ], 400);
    }

    /**
     * Creates and updates the history of product movements
     * @var $data (Array with the data of messages, date and time of insertion or update of the product)
     * @var $sku (product SKU)
     * @return 1 OR 0
     */
    private function updateMovement($data = [], $sku = null)
    {

        if (count($data) > 0 && !empty($sku)) {

            $id = $this->products->where('SKU', $sku)->select('id')->first()->id;

            if ($id) {

                $result = $this->stockMovement->where('product_id', $id)->select('id', 'movements')->first();

                if (isset($result->id) && !empty($result->id)) {
                    return $this->stockMovement->where('id', $result->id)->update(['movements' => array_merge($result->movements, $data)]);
                } else {
                    return $this->stockMovement->create(['product_id' => $id, 'movements' => $data]);
                }

            }
        }

        return 0;
    }
}
