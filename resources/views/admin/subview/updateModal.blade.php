<div class="modal fade" id="editMovieModal" tabindex="-1" aria-labelledby="editMovieModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMovieModalLabel">Edit Movie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMovieForm" method="PUT" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="movieId">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Titles <span class="text-red">*</span></label>
                        <input type="text" name="title" id="editTitle" class="form-control" value="{{old('title')}}">
                        @error('title')
                        <span class="text-danger" id="editTitleError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editGenre" class="form-label">Genre <span class="text-red">*</span></label>
                        <input type="text" name="genre" id="editGenre" class="form-control" value="{{old('genre')}}">
                        @error('genre')
                        <span class="text-danger" id="editGenreError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editRating" class="form-label">Rating <span class="text-red">*</span></label>
                        <input type="number" name="rating" id="editRating" class="form-control" step="0.1" min="0" max="10" value="{{old('rating')}}">
                        @error('rating')
                        <span class="text-danger" id="editRatingError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editDuration" class="form-label">Duration <span class="text-red">*</span></label>
                        <input type="number" name="duration" id="editDuration" class="form-control" value="{{old('duration')}}">
                        @error('duration')
                        <span class="text-danger" id="editDurationError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editCast" class="form-label">Cast <span class="text-red">*</span></label>
                        <input type="text" name="cast" id="editCast" class="form-control" value="{{old('cast')}}">
                        @error('cast')
                        <span class="text-danger" id="editCastError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editShowtime" class="form-label">Showtime <span class="text-red">*</span></label>
                        <input type="datetime-local" name="showtime" id="editShowtime" class="form-control" value="{{old('showtime')}}">
                        @error('showtime')
                        <span class="text-danger" id="editShowtimeError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Price <span class="text-red">*</span></label>
                        <input type="number" name="price" id="editPrice" class="form-control" value="{{old('price')}}" step="0.1">
                        @error('price')
                        <span class="text-danger" id="editPriceError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="editTheatre_id" class="form-label">Theatre_id <span class="text-red">*</span></label>
                        <input type="number" name="theatre_id" id="editTheatre_id" class="form-control" value="{{old('theatre_id')}}" min="0">
                        @error('theatre_id')
                        <span class="text-danger" id="editTheatre_idError">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="currentImage" class="form-label d-block">Current Image </label>
                        <img id="currentImage" src="" alt="Current Movie Poster" class="img-fluid mb-2 " style="max-width: 200px; display: none; margin-left:50%; transform:translate(-50%,0);"/>

                        <label for="editImageUpload" class="form-label d-block">Upload New Image (Optional)</label>
                        <input type="file" name="image" id="editImageUpload" class="form-control">
                        @error('image')
                        <span class="text-danger" id="editImageError">{{$message}}</span>
                        @enderror
                    </div>


                    <button type="button" class="btn btn-primary update" data-csrf="{{csrf_token()}}">Update Movie</button>
                </form>
            </div>
        </div>
    </div>
</div>
