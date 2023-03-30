<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductPaginateResource;
use App\Http\Resources\ProductResource;
use App\Http\Services\Product\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infra\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductRepository $product_repository)
    {
        $this->productService = new ProductService(
            productRepositoryInterface: $product_repository
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = $this->productService->getAll();

            if($products) {
                return $this->sendPaginatedData(
                    message: 'Produtos encontrados',
                    total: $products['total'],
                    nextPage: $products['next_page_url'],
                    data: ProductPaginateResource::collection($products['data'])
                );
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProductCreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $product = $this->productService->create($data);
    
            return $this->sendDataWithMessage(
                message: 'Produto Criado com sucesso!',
                data: ProductResource::make($product)
            );
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductRequest $request)
    {
        try {
            $data = $request->validated();

            $product = $this->productService->getById($data['id']);

            return $this->sendDataWithMessage(
                message: 'Produtos encontrados',
                data: ProductResource::make($product)
            );
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductEditRequest $request, int $id)
    {
        try {
            $data = $request->validated();

            $product = $this->productService->editById(data: $data, id: $id);

            if($product == false) {
                return $this->sendMessage(
                    message: 'Produto não encontrado',
                    statusCode: Response::HTTP_OK
                );
            }

            return $this->sendDataWithMessage(
                message: 'Produtos editado',
                data: ProductResource::make($product)
            );
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $isDeleted = $this->productService->deleteById($id);

            if($isDeleted == false) {
                return $this->sendMessage(
                    message: 'Produto não encontrado',
                    statusCode: Response::HTTP_OK
                );
            }

            return $this->sendMessage(
                message: 'Produto deletado',
                statusCode: Response::HTTP_NO_CONTENT
            );
        } catch (Exception $e) {
            dd($e);
        }
    }
}
