<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;

class Dropzone extends Component
{
    public $name;
    public $multiple = false;


    /**
     * Salva arquivo enviado via evento JS → Livewire
     */
    #[On('salvarArquivo')]
    public function store($fileData)
    {
        $name = $fileData['name'];
        $content = $fileData['content'];

        // Extrai apenas o base64 puro (remove cabeçalho data:)
        $data = preg_replace('/^data:.*base64,/', '', $content);
        $data = base64_decode($data);

        // Salva no storage/app/uploads
        $path = "uploads/{$name}";
        Storage::put($path, $data);

        // Retorna caminho salvo (pode ser usado no frontend)
        return $path;
    }

    /**
     * Remove arquivo salvo no storage
     */
    #[On('removerArquivo')]
    public function remove($fileName)
    {
        $path = "uploads/{$fileName}";
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public function render()
    {
        return view('livewire.forms.dropzone');
    }
}
