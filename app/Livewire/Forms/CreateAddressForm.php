<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Enums\TypeOfDocument;
use App\Models\Address;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules\Enum;

class CreateAddressForm extends Form
{
    public $type = '';
    public $description = '';
    public $ciudad = '';
    public $reference = '';
    public $receiver = 1;
    public $receiver_info = [];
    public $default = false;

    public function rules()
    {
        return [
            'type' => 'required|in:1,2',
            'description' => 'required|string',
            'ciudad' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_type' => [
                'required',
                new Enum(TypeOfDocument::class)
            ],
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',

        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => 'tipo de direccion',
            'description' => 'descripcion',
            'ciudad' => 'ciudad de Envio',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre',
            'receiver_info.last_name' => 'apellido',
            'receiver_info.document_type' => 'tipo de Documento',
            'receiver_info.document_number' => 'numero de Documento',
            'receiver_info.phone' => 'teléfono'
        ];
    }


    public function save()
    {
        $this->validate();
        if (auth()->user()->addresses->count() === 0) {
            $this->default = true;
        }
        Address::create([
            'user_id'=>auth()->id(),
            'type' => $this->type,
            'description' => $this->description,
            'ciudad' => $this->ciudad,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default
        ]);
        $this->reset();
        $this->receiver_info = [
            'name' => auth()->user()->name,
            'last_name' => auth()->user()->last_name,
            'document_type' => auth()->user()->document_type,
            'document_number' => auth()->user()->document_number,
            'phone' => auth()->user()->phone
        ];
    }
}
