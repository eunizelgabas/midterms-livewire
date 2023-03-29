<div class="row">
    <div class="col-sm-5 col-md-4">
        <div class="card-left card rounded-lg">
            <div class="card-body">
                <input type="text" name="" id="" placeholder="Search Name" class="form-control m-2 mb-4" wire:model.lazy='search_band'>

                <div class="checkbox d-block m-2">
                    <label for="genre">Genre:</label> <br>
                        <input type="checkbox" name="" id="" wire:model='Rock' value="Rock"> &nbsp; Rock <br>
                        <input type="checkbox" name="" id="" wire:model='Pop' value="Pop"> &nbsp; Pop <br>
                        <input type="checkbox" name="" id="" wire:model='Reggae' value="Reggae"> &nbsp; Reggae <br>
                        <input type="checkbox" name="" id="" wire:model='Acoustic' value="Acoustic"> &nbsp; Acoustic <br>
                        <input type="checkbox" name="" id="" wire:model='Classical' value="Classical" class="mb-4"> &nbsp; Classical <br>

                </div>

                <label for="location">Location</label> <br>
                <select name="" id="" class="form-select mb-4" style="transform: translateX(7px);" wire:model='bandLocation'>
                    <option value="all">Select Location</option>
                    @foreach ($bands as $band)
                        <option value="{{ $band->location }}">{{ $band->location }}</option>
                    @endforeach

                </select>

                <div class="rate d-inline-block mt-2" style="transform: translateX(6px);">
                    <label for="">Rate:</label><br>
                    <input style="width: 350px;" type="range" id="sortRangeInput" name="sortRangeInput" min="0" max="500"
                    oninput="showSortValue(this.value)" wire:model='sortRate'> <br>
                    ₱ <output class="mb-4" id="sortRangeInput" for="sortRangeInput">{{ number_format(floatval($sortRate), 2) }}</output>
               </div>
               <br>
               <label for="sort">Sort:</label>
                    <select name="" id="" class="form-select" style="transform: translateX(6px);" wire:model='sortBy'>
                        <option value='all'>Sort By</option>
                        <option value="asc">Lowest to Highest Fee</option>
                        <option value="desc">Highest to Lowest Fee</option>
                    </select>
                    <button class="btn btn-primary float-end mt-5" wire:click='resetFilter'>Reset Filter</button>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-md-8" >
        <h3>Find the Gig you love!</h3>
    <button type="button" class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#createModal" >
        <i class="fa-solid fa-pen"></i>
    </button>
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header " style="background-color:cornflowerblue; color:black">
                    <h1 class="modal-title fs-5 " id="staticBackdropLabel">Create New Band</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" wire:submit.prevent='addBand()'>
                        <div class="elements">
                            <label for="band_name">Name:</label><br>
                            <input type="text" name="" id="band_name" class="form-control  @error('band_name') is-invalid @enderror" wire:model='band_name'>
                            @error('band_name')
                            <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="elements">
                            <label for="loc">Location:</label><br>
                            <input type="text" name="" id="loc" class="form-control  @error('location') is-invalid @enderror" wire:model='location'>
                            @error('location')
                            <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="elements">
                            <label for="rate">Rate:</label><br>
                            <input type="number" name="" id="rate" class="form-control  @error('rate') is-invalid @enderror" wire:model='rate'>
                            @error('rate')
                            <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="elements">
                            <label for="genre">Genre:</label><br>
                            <select name="" id="" wire:model.defer="genre" class="form-select  @error('genre') is-invalid @enderror">
                                <option value="">Select Genre</option>
                                <option value="Rock">Rock</option>
                                <option value="Pop">Pop</option>
                                <option value="Reggae">Reggae</option>
                                <option value="Acoustic">Acoustic</option>
                                <option value="Classical">Classical</option>
                            </select>

                            @error('genre')
                            <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                            <div class="elements">
                                <label for="talent_fee">Talent Fee:</label><br>
                                <input type="number" name="" id="loc" class="form-control  @error('talent_fee') is-invalid @enderror" wire:model='talent_fee'>
                                @error('talent_fee')
                                <p class="text-danger text-sm">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="elements">
                                <label for="total_transaction">Total Transaction:</label><br>
                                <input type="number" name="" id="loc" class="form-control  @error('total_transaction') is-invalid @enderror" wire:model='total_transaction'>
                                @error('total_transaction')
                                <p class="text-danger text-sm">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="elements">
                                <label for="founder">Founder:</label><br>
                                <input type="text" name="" id="loc" class="form-control  @error('founder') is-invalid @enderror" wire:model='founder'>
                                @error('founder')
                                <p class="text-danger text-sm">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="elements">
                                <label for="description">Description:</label><br>
                                <textarea  name="description" id="description" class="form-control  @error('description') is-invalid @enderror" wire:model='description'></textarea>
                                @error('description')
                                <p class="text-danger text-sm">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="elements">
                                <label for="image">Image:</label>
                                @if($image)
                                <img src="{{$image->temporaryUrl()}}" class="img d-block mt-2" style="width:100px" alt="">
                                @endif
                                <div class="mt-2">
                                    <input type="file" name="image" class="form-control" wire:model="image">
                                </div>
                                @error('image')
                                <p class="text-danger text-sm">{{$message}}</p>
                                @enderror
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary " id="save_btn" >Create</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        @foreach ($bands as $band)
        <div class="col-sm-5 mb-2 ">

            <div class="card mb-3" style="width: 20rem;">
                <img src="{{Storage::url($band->image)}}" class="card-img-top" alt="image" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">{{$band->band_name}}</h5>
                    <p class="card-text">Location: {{$band->location}}</p>
                    <p class="card-text">Genre: {{$band->genre}}</p>
                    <p class="card-text">Rate: {{$band->rate}}</p>
                    <p class="card-text"><small class="text-muted">Created: {{$band->created_at->format('g:i A')}}</small></p>
                    <button type="button" class="btn btn-info btn-sm m-2 " data-bs-toggle="modal" data-bs-target="#updateModal" wire:click='editConfirmation({{$band->id}})'>
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <!-- Update Band Modal -->
                    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #FFB562">
                                <h1 class="modal-title fs-5" id="updateModalLabel">Edit Band Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="elements">
                                    <label for="band_name">Name:</label><br>
                                    <input type="text" name="" id="band_name" class="form-control  @error('band_name') is-invalid @enderror" wire:model='editBand_name'>
                                    @error('band_name')
                                    <p class="text-danger text-sm">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="elements">
                                    <label for="loc">Location:</label><br>
                                    <input type="text" name="" id="loc" class="form-control  @error('location') is-invalid @enderror" wire:model='editLocation'>
                                    @error('location')
                                    <p class="text-danger text-sm">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="elements">
                                    <label for="rate">Rate:</label><br>
                                    <input type="number" name="" id="rate" class="form-control  @error('rate') is-invalid @enderror" wire:model='editRate'>
                                    @error('rate')
                                    <p class="text-danger text-sm">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="elements">
                                    <label for="genre">Genre:</label><br>
                                    <select name="" id="" wire:model.defer="editGenre_id" class="form-select  @error('genre') is-invalid @enderror">
                                        <option value="">Select Genre</option>
                                        <option value="Rock">Rock</option>
                                        <option value="Pop">Pop</option>
                                        <option value="Reggae">Reggae</option>
                                        <option value="Acoustic">Acoustic</option>
                                        <option value="Classical">Classical</option>
                                    </select>

                                    @error('genre')
                                    <p class="text-danger text-sm">{{$message}}</p>
                                    @enderror
                                </div>
                                    <div class="elements">
                                        <label for="talent_fee">Talent Fee:</label><br>
                                        <input type="number" name="" id="loc" class="form-control  @error('talent_fee') is-invalid @enderror" wire:model='editTalent_fee'>
                                        @error('talent_fee')
                                        <p class="text-danger text-sm">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="elements">
                                        <label for="total_transaction">Total Transaction:</label><br>
                                        <input type="number" name="" id="loc" class="form-control  @error('total_transaction') is-invalid @enderror" wire:model='editTotal_transaction'>
                                        @error('total_transaction')
                                        <p class="text-danger text-sm">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="elements">
                                        <label for="founder">Founder:</label><br>
                                        <input type="text" name="" id="loc" class="form-control  @error('founder') is-invalid @enderror" wire:model='editFounder'>
                                        @error('founder')
                                        <p class="text-danger text-sm">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="elements">
                                        <label for="description">Description:</label><br>
                                        <textarea  name="description" id="description" class="form-control  @error('description') is-invalid @enderror" wire:model='editDescription'></textarea>
                                        @error('description')
                                        <p class="text-danger text-sm">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="elements">
                                        <label for="image">Image:</label>
                                        <div class="mt-2">
                                            <input type="file" name="image" class="form-control" wire:model="editImage">
                                            {{-- @if ($image)
                                            <img src="{{$image->temporaryUrl}}" class="img d-block mt-2" style="width:100px" alt="">
                                           @else
                                           <img src="{{asset('profileImgs')}}/{{$old_image}}" class="img d-block mt-2" style="width:100px" alt="">
                                           @endif --}}
                                            <input type="hidden" wire:model="old_image">
                                        </div>
                                        @error('image')
                                        <p class="text-danger text-sm">{{$message}}</p>
                                        @enderror
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-warning" wire:click.prevent ="update()" >Update Band</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm m-2 " data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click='deleteConfirmation({{$band->id}})'>
                    <i class="fa-solid fa-trash"></i>
                </button>
                <!-- Delete Investor Modal -->
                <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Band</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Are you sure you want to delete this band?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" wire:click ="deleteBandData()" >Delete Post</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-warning btn-sm m-2 " data-bs-toggle="modal" data-bs-target="#moreModal" wire:click="view({{$band->id}})">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <!-- More Detail Band Modal -->
                <div wire:ignore.self class="modal fade" id="moreModal" tabindex="-1" aria-labelledby="moreModalLabel" aria-hidden="true" data-backdrop="false" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                @foreach ($bands as $bandImg)
                                <div class="card" style="border:none">
                                    @if ($bandImg->id == $band_show_id)
                                    <img src="{{Storage::url($bandImg->image)}}" class="card-img-top mx-auto mt-2" alt="image" style="border-radius:50%;width:100px; height:100px;">
                                    <div class="card-body">
                                        <h6 class="card-title text-center">@founder | {{$bandImg->founder}}  </h6>
                                        <hr>
                                        <p class="card-text">{{$bandImg->description}}</p>
                                        <div class="img mx-auto">
                                            <button class="btn btn-primary" style="border-radius: 80px; margin-left:40%" >
                                                Book now
                                            </button>
                                        </div>
                                        <div class="row mt-2 text-center">
                                            <div class="col-md-6 ">
                                            <p class="card-text ">{{$bandImg->talent_fee}}</p>
                                            <p class="card-text"><small class="text-muted">Talent fee</small></p>
                                            </div>
                                            <div class="col-md-6" >
                                                <p class="card-text">{{$bandImg->total_transaction}}</p>
                                                <p class="card-text"><small class="text-muted">Total Transactions</small></p>
                                            </div>
                                        </div>


                                    </div>
                                    @endif

                                </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>

        </div>
        @endforeach
    </div>

    @if($bands->isEmpty())
    <div class="text-dark text-center" style="font-size: 30px; font-weight:700">
        Nothing to show
    </div>
  @endif
  {{$bands->links()}}
    </div>


</div>

<style>

    .modal-backdrop {
        display: none;
    }

    h3{
        font-family: cursive;
        text-align: center;
        color: cornflowerblue;

    }

    *{
        font-family: 'Poppins',sans-serif;
    }
    .card-left{
        background-color: #713d35;
        width: 400px;
        padding: 3px;
        opacity: 90%;
        color: white;
    }



</style>
