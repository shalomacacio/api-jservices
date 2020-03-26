<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\PlanRepository;
use App\Validators\PlanValidator;

class PlanService
{
    private $repository;
    private $validator;

    public function __construct( PlanRepository $repository, PlanValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $result = $this->repository->create($data);

            return [
                'success' => true,
                'message' =>  "Sucesso",
                'data' => $result
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' =>  "Oops: ".$e->getMessageBag()
            ];
        }
    }

    public function update($data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $result = $this->repository->update($data, $id);

            return [
                'success' => true,
                'message' =>  "Sucesso",
                'data' => $result
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' =>  "Oops: ".$e
            ];
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->repository->delete($id);
            return [
                'success' => true,
                'message' =>  "Sucesso",
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' =>  "Oops: ".$e
            ];
        }
    }



}
