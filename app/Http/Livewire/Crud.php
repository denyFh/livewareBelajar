<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Artist;

class Crud extends Component
{
    public $artists, $name, $age, $industry, $company, $artist_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->artists = Artist::all();
        return view('livewire.crud');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {
        $this->name = '';
        $this->age = '';
        $this->industry = '';
        $this->company = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'age' => 'required',
            'industry' => 'required',
            'company' => 'required',
        ]);

        Artist::updateOrCreate(['id' => $this->artist_id], [
            'name' => $this->name,
            'age' => $this->age,
            'industry' => $this->industry,
            'company' => $this->company,
        ]);

        session()->flash('message', $this->artist_id ? 'Artist info updated.' : 'Artist registered.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        $this->artist_id = $id;
        $this->name = $artist->name;
        $this->age = $artist->age;
        $this->industry = $artist->industry;
        $this->company = $artist->company;

        $this->openModal();
    }

    public function delete($id)
    {
        Artist::find($id)->delete();
        session()->flash('message', 'Artist Has Been Removed.');
    }
}
