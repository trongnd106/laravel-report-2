<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class UserService 
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getAll(){
        return $this->userRepository->getAll();
    }

    public function getById($id){
        return $this->userRepository->find($id);
    }

    public function create(array $data){
        return $this->userRepository->create($data);
    }

    public function update(array $data, $id){
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = $this->userRepository->findOrFail($id);
        return $this->userRepository->update($id, $data);
    }

    public function get100Users(){
        return $this->userRepository->get100Users();
    }
}