<?php

namespace App\Http\Livewire\Band;

use App\Models\Band;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{

    public $search;
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $band_name, $location,$rate,$genre,
            $talent_fee,$total_transaction,$founder,$description,
            $image, $search_band = null, $bandLocation= 'all',
            $Rock, $Pop, $Reggae, $Acoustic, $Classical,
            $sortRate = 0, $old_image, $new_image, $selectedId;
            public $sortBy = 'asc';

    public function addBand(){
        $this->validate([
            'band_name'             =>['required', 'string' ,'max:255'],
            'location'              =>['required', 'string' ,'max:255'],
            'rate'                  =>['required', 'string' ,'max:255'],
            'genre'                 =>['required', 'string' ,'max:255'],
            'talent_fee'             =>['required', 'string' ,'max:255'],
            'total_transaction'     =>['required', 'string' ,'max:255'],
            'founder'               =>['required', 'string' ,'max:255'],
            'description'           =>['required', 'string' ,'max:255'],
            'image'                 =>['required', 'image'],

        ]);

        $fileUrl = $this->image->store('public/profileImgs');

        Band::create([
            'band_name'             =>$this->band_name,
            'location'              =>$this->location,
            'rate'                  =>$this->rate,
            'genre'                 =>$this->genre,
            'talent_fee'             =>$this->talent_fee,
            'total_transaction'     =>$this->total_transaction,
            'founder'               =>$this->founder,
            'description'           =>$this->description,
            'image'                 =>$fileUrl,

        ]);
        return redirect('/')->with('message','Band Added Successfully!');
    }


    public function loadBands(){
        $query = Band::orderBy('band_name', $this->sortBy)->search($this->search);

        if($this->search_band != null){
            $query->where('band_name', $this->search_band);
        }

        if($this->bandLocation != 'all'){
            $query->where('location', $this->bandLocation);
        }

        if($this->Rock != null){
            $query->where('genre', $this->Rock);
        }

        if($this->Rock == "Rock" || $this->Pop =='Pop' || $this->Reggae == 'Reggae' || $this->Acoustic == 'Acoustic' ||$this->Classical == 'Classical'){
            $query->where('genre', $this->Rock)
            ->orWhere('genre', $this->Pop)
            ->orWhere('genre', $this->Reggae)
            ->orWhere('genre', $this->Acoustic)
            ->orWhere('genre', $this->Classical);

        }

        if($this->Pop != null){
            $query->where('genre', $this->Pop);
        }
        if($this->Reggae != null){
            $query->where('genre', $this->Reggae);
        }
        if($this->Acoustic != null){
            $query->where('genre', $this->Acoustic);
        }
        if($this->Classical != null){
            $query->where('genre', $this->Classical);
        }
        if ($this->sortRate) {
             $query->where('rate', '>=', $this->sortRate);
        }

        if ($this->sortBy == 'asc') {
            $query->orderBy('rate', 'asc');

         }
         elseif ($this->sortBy == 'desc') {
            $query->orderBy('rate', 'desc');
         }

        $bands = $query->paginate(4);
        return compact('bands');

    }

    public function editConfirmation($id){
        $band = Band::findOrFail($id);
        $this->band_id                  = $id;
        $this->editBand_name            = $band->band_name;
        $this->editLocation             = $band->location;
        $this->editRate                 = $band->rate;
        $this->editGenre_id             = $band->genre;
        $this->editTalent_fee           = $band->talent_fee;
        $this->editTotal_transaction    = $band->total_transaction;
        $this->editFounder              = $band->founder;
        $this->editDescription          = $band->description;
        $this->old_image                =$band->image;
        $this->editImage                =$band->image;

    }


    public $band_id;
    public function update()
    {
        $this->validate([
            'editBand_name'             =>['required', 'string' ,'max:255'],
            'editLocation'              =>['required', 'string' ,'max:255'],
            'editRate'                  =>['required', 'string' ,'max:255'],
            'editGenre_id'              =>['required', 'string' ,'max:255'],
            'editTalent_fee'            =>['required', 'string' ,'max:255'],
            'editTotal_transaction'     =>['required', 'string' ,'max:255'],
            'editFounder'               =>['required', 'string' ,'max:255'],
            'editDescription'           =>['required', 'string' ,'max:255'],
            'editImage'                 =>['required', 'image'],
        ]);

        $band = Band::find($this->band_id);
        $file = '';
        $destination = public_path('storage\\' .$band->image);
        if($this->editImage != null){

            $file = $this->editImage->store('profileImgs', 'public');

        }else{
            $file = $this->old_image;
        }


        $band->update([
            'band_name'         =>$this->editBand_name,
            'location'          =>$this->editLocation,
            'rate'              =>$this->editRate,
            'genre'             =>$this->editGenre_id,
            'talent_fee'        =>$this->editTalent_fee,
            'total_transaction' =>$this->editTotal_transaction,
            'founder'           =>$this->editFounder,
            'description'       =>$this->editDescription,
            'image'             =>$file,

        ]);

        return redirect('/')->with('message', 'Updated Successfully');
    }

    public $band_delete_id;
    public function deleteConfirmation($id)
    {
        $this->band_delete_id = $id;
    }

    public function deleteBandData(){
        $band = Band::where('id', $this->band_delete_id)->first();
        $band->delete();

        return redirect('/')
        ->with('message', 'Deleted Successfully');

        $this->band_delete_id = '';
    }


    public function resetFilter(){

        $this->bandSearch = '';

        $this->gRck = null;
        $this->Pop = null;
        $this->Reggae = null;
        $this->Acoustic = null;
        $this->Classical = null;

        $this->bandLocation = 'all';

        $this->sortRate = 0;
        $this->sortBy = 'asc';

    }

    public $band_show_id;
    public function view($id){

        $this->band_show_id = $id;

        $band = Band::where('id', $this->band_show_id);
    }

    public function render()
    {
        $images = Band::orderBy('id', 'DESC')->get();
        return view('livewire.band.index',['images'=>$images], $this->loadBands());
    }
}
