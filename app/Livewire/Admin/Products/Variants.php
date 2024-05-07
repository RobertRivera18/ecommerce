<?php

namespace App\Livewire\Admin\Products;

use App\Models\Option;
use App\Models\Feature;
use App\Models\Variant;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Variants extends Component
{
    public $product;
    public $openModal = false;
    public $options;
    public $variants = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'desciption' => ''
            ],
        ]
    ];

    public function mount()
    {
        $this->options = Option::all();
    }
    //Propiedad Computada
    #[Computed()]
    public function features()
    {
        return Feature::where('option_id', $this->variants['option_id'])->get();
    }
    public function addFeature()
    {
        $this->variants['features'][] = [
            'id' => '',
            'value' => '',
            'description' => ''
        ];
    }

    public function removefeature($index)
    {
        unset($this->variants['features'][$index]);
        $this->variants['features'] = array_values($this->variants['features']);
    }



    public function deleteFeature($option_id, $feature_id)
    {
        $this->product->options()->updateExistingPivot($option_id, [
            'features' => array_filter($this->product->options->find($option_id)->pivot->features, function ($feature) use ($feature_id) {
                return  $feature['id'] != $feature_id;
            })
        ]);
        $this->product = $this->product->refresh();
        $this->generarVariantes();
    }

    public function deleteOption($option_id)
    {
        $this->product->options()->detach($option_id);
        $this->product = $this->product->refresh();
        $this->generarVariantes();
    }

    public function updatedVariantOptionId($value)
    {
        $this->variants['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ]
        ];
    }

    public function feature_change($index)
    {
        $feature = Feature::find($this->variants['features'][$index]['id']);
        if ($feature) {
            $this->variants['features'][$index]['value'] = $feature->value;
            $this->variants['features'][$index]['description'] = $feature->description;
        }
    }

    public function save()
    {
        $this->validate([
            'variants.option_id' => 'required',
            'variants.features.*.id' => 'required',
            'variants.features.*.value' => 'required',
            'variants.features.*.description' => 'required'
        ]);
        $this->product->options()->attach($this->variants['option_id'], [
            'features' => json_encode($this->variants['features'])
        ]);
        $this->product = $this->product->refresh();
        $this->generarVariantes();

        $this->reset(['variants', 'openModal']);
    }


    public function generarVariantes()
    {
        $features = $this->product->options->pluck('pivot.features');
        $combinaciones = $this->generarCombinaciones($features);
        $this->product->variants()->delete();
        foreach ($combinaciones as $combinacion) {
            $variant = Variant::create([
                'product_id' => $this->product->id
            ]);
            $variant->features()->attach($combinacion);
        }
        $this->dispatch('variant-generate');
    }

    public function generarCombinaciones($arrays, $indice = 0, $combinacion = [])
    {
        if ($indice == count($arrays)) {
            return [$combinacion];
        }
        $resultado = [];
        foreach ($arrays[$indice] as $item) {
            $combinacionTemporal = $combinacion;
            $combinacionTemporal[] = $item['id'];
            $resultado[] = array_merge($resultado, $this->generarCombinaciones($arrays, $indice + 1, $combinacionTemporal));
        }
        return $resultado;
    }


    public function render()
    {
        return view('livewire.admin.products.variants');
    }
}
