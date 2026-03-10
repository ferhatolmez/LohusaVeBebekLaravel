<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLohusaFormRequest;
use App\Http\Resources\LohusaFormResource;
use App\Models\LohusaForm;
use App\Repositories\LohusaFormRepository;
use App\Services\LohusaFormService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LohusaApiController extends Controller
{
    public function __construct(
        private readonly LohusaFormRepository $repository,
        private readonly LohusaFormService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', LohusaForm::class);

        return LohusaFormResource::collection(
            $this->repository->apiPaginate($request->only(['q', 'dogum_yeri', 'bebek_beslenmesi', 'postpartum_hafta_min', 'created_from', 'created_to']))
        );
    }

    public function store(StoreLohusaFormRequest $request): JsonResponse
    {
        $this->authorize('create', LohusaForm::class);

        $form = $this->service->store($request->validated(), $request->user()->id);

        return LohusaFormResource::make($form)->response()->setStatusCode(201);
    }

    public function show(LohusaForm $lohusa): LohusaFormResource
    {
        $this->authorize('view', $lohusa);

        return LohusaFormResource::make($lohusa);
    }

    public function update(StoreLohusaFormRequest $request, LohusaForm $lohusa): LohusaFormResource
    {
        $this->authorize('update', $lohusa);

        return LohusaFormResource::make($this->service->update($lohusa, $request->validated(), $request->user()->id));
    }

    public function destroy(LohusaForm $lohusa): JsonResponse
    {
        $this->authorize('delete', $lohusa);
        $this->service->destroy($lohusa);

        return response()->json([], 204);
    }
}
