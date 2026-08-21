<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    private array $foods = [
        ['id' => 1, 'name' => 'Bun Bo', 'price' => 45000],
        ['id' => 2, 'name' => 'Banh Loc', 'price' => 25000],
        ['id' => 3, 'name' => 'Com Hen', 'price' => 20000],
    ];

    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Lay danh sach mon an thanh cong',
            'data' => $this->foods,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $food = collect($this->foods)->firstWhere('id', $id);

        if (!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Khong tim thay mon an',
                'errors' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lay chi tiet mon an thanh cong',
            'data' => $food,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $foodKey = array_search($id, array_column($this->foods, 'id'));

        if ($foodKey === false) {
            return response()->json([
                'success' => false,
                'message' => 'Khong tim thay mon an',
                'errors' => null,
            ], 404);
        }

        $this->foods[$foodKey]['name'] = $request->input('name', $this->foods[$foodKey]['name']);
        $this->foods[$foodKey]['price'] = $request->input('price', $this->foods[$foodKey]['price']);

        return response()->json([
            'success' => true,
            'message' => 'Cap nhat mon an thanh cong',
            'data' => $this->foods[$foodKey],
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $foodKey = array_search($id, array_column($this->foods, 'id'));

        if ($foodKey === false) {
            return response()->json([
                'success' => false,
                'message' => 'Khong tim thay mon an',
                'errors' => null,
            ], 404);
        }

        unset($this->foods[$foodKey]);

        return response()->json([
            'success' => true,
            'message' => 'Xoa mon an thanh cong',
            'data' => null,
        ]);
    }
}
