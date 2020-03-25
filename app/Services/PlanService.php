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
                'message' =>  "Transação com sucesso",
                'data' => $result
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' =>  "Erro de execucao: ".$e->getMessageBag()
            ];
        }
    }

    public function update(){}
    public function delete(){}



}
