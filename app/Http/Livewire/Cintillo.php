<?php

namespace App\Http\Livewire;

use App\Models\Cintillo AS Cintillos;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Cintillo extends Component
{
    use WithFileUploads;

    public $cintillo, $cintillo_borrar, $borrar, $cintillo_activar, $activar;

    protected $rules = [
        'cintillo' => 'required|image|mimes:jpeg,jpg|max:2048',
    ];

    public function up()
    {
        $this->validate();

        $nombre = $this->cintillo->store('images', 'public');

        Cintillos::create([
            'nombre' => $nombre,
        ]);

        $this->dispatchBrowserEvent('crear');

        $this->reset('cintillo');
    }

    public function modalActivar($id)
    {
        $this->activar = $id;
        $this->cintillo_activar = Cintillos::find($id)->title;
    }

    public function activar()
    {
        Cintillos::where('activo', 2)->update(['activo' => '1']);

        $cintillo = Cintillos::find($this->activar);

        $cintillo->update(['activo' => '2']);

        $this->dispatchBrowserEvent('editar');
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->cintillo_borrar = Cintillos::find($id)->nombre;
    }

    public function borrar()
    {
        $cintillo = Cintillos::find($this->borrar);

        if ($cintillo->activo == 2)
        {
            $this->dispatchBrowserEvent('borrar_activo');
        }

        else
        {
            Storage::disk('public')->delete($this->cintillo_borrar);

            $cintillo->delete();
        
            $this->dispatchBrowserEvent('borrar');
        }
    }

    public function render()
    {
        $cintillos = Cintillos::all();

        return view('livewire.cintillo', compact('cintillos'));
    }
}
