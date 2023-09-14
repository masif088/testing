<?php

namespace App\Livewire\Document;

use App\Models\DocumentManagement;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    public $title;
    public $content;
    public $signingPhoto;
    public $signing;
    public $dataId;
    public $action;

    public function mount(){
        if ($this->dataId!=null){
            $data=DocumentManagement::find($this->dataId);
            $this->title=$data->title;
            $this->content=$data->content;
            $this->signing=$data->signing;
        }
    }


    public function create()
    {
        $this->validate();
        $filename = 'singing/'.Str::slug(auth()->id() . '-' . date('Hms')) . '.'
            . $this->signingPhoto->getClientOriginalExtension();
        $this->signingPhoto->storeAs('public/'.$filename);
        DocumentManagement::create([
            'title' => $this->title,
            'content' => $this->content,
            'singing' => $filename,
            'user_id' => auth()->id()
        ]);
    }

    public function update()
    {
		$this->validate();
        if ($this->signingPhoto!=null){
            $filename = 'singing/'.Str::slug(auth()->id() . '-' . date('Hms')) . '.'
                . $this->signingPhoto->getClientOriginalExtension();
            $this->signingPhoto->storeAs('public/'.$filename);
            $this->signing=$filename;
        }
        DocumentManagement::find($this->dataId)->update([
            'title' => $this->title,
            'content' => $this->content,
            'singing' => $this->signing,
            'user_id' => auth()->id()
        ]);
    }
    public function getRules()
    {
        return[
            'title' => 'required|string|max:255',
            'content' => 'required',
            'signing' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.document.form');
    }
}
