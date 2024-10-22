
const movieList=$('.movie-list');
const originalList = movieList.html();
// search functionality
$('#search').on('keyup',function(){
    $value=$(this).val();
    if($value.length > 2){
        $.ajax({
            type:'get',
            url:'search',
            data:{'search':$value},
            success:function(response){
                movieList.empty();
                if(response.length>0){
                    response.forEach(movie => {
                        const template=`
                            <div class="movie-card">
                                <img class="movie-card-img" src="${movie['image_url']}" alt="${movie['title'] } poster">
                                <div class="movie-card-content">
                                    <h2 class="movie-card-title text-white">${movie['title']}</h2>
                                    <p class="movie-card-genre">Genre:  ${movie['genre'] }</p>
                                    <p class="movie-card-rating">Rating: ${movie['rating'] }</p>
                                    <p class="movie-card-cast">Cast: ${ movie['cast'] }</p>
                                    <p class="movie-card-duration">Duration: ${movie['duration'] } mins</p>
                                    <p class="movie-card-showtime">Showtime: ${movie.showtime}</p>
                                    <p class="movie-card-price">Price:&#8377 ${ movie['price'] }</p>
                                    <a href="{{ route('user.dashboard', $movie['id']) }}" class="movie-card-button mt-auto">Book Now</a>
                                </div>
                            </div>
                        `;
                        $(movieList).append(template);
                    });
                }else {
                    movieList.append('<p class="text-black">No movies found.</p>');
                }
            }

        });
    }else{
        movieList.empty();
        movieList.append(originalList);
    }
});
$('#search').on('blur', function(event) {
    const value = $(this).val();
    if (value.length === 0) {
        movieList.empty();
        movieList.append(originalList);
    }
});


// for user
