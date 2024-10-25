// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

$(document).ready(function() {

    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
    }, 5000);


    $('.alert-dismissible .close').on('click', function() {
        $(this).closest('.alert').fadeOut('slow');
    });

    $(document).on('click','.del-movie',function(){
        const id = $(this).data('id');
        const csrf_token = $(this).data('csrf');
        const url=`/admin/movies/${id}`;
        $row=$(this).closest('tr');
        if(confirm(`Are you sure you want to delete record?`)){
            $.ajax({
                method: "DELETE",
                url: url,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function (response) {
                    $row.remove();
                    alert('Record deleted successfully!')
                    if(response.status==='success'){
                        $("#response").html(
                            `<div class='alert alert-danger alert-dismissible'>
                                ${response.message}
                             <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>
                            `
                        )
                    }else {

                        alert('Failed to delete record!');
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while deleting the record.');
                }
            });
        }
    });
    $(document).on('click','.ed-movie',function(){
        const id = $(this).data('id');
        const csrf_token=$(this).data('csrf');
        const url = `/admin/movies/${id}/edit`;
        $.ajax({
            method:'GET',
            url:url,
            dataType:'JSON',
            headers:{
                'X-CSRF-TOKEN':csrf_token
            },
            success:function(response){
                // console.log(response.movie);
                const movie=response.movie;
                $('#movieId').val(movie.id);
                $('#editTitle').val(movie.title);
                $('#editGenre').val(movie.genre);
                $('#editRating').val(movie.rating);
                $('#editDuration').val(movie.duration);
                $('#editCast').val(movie.cast);
                $('#editShowtime').val(movie.showtime);
                $('#editPrice').val(movie.price);
                $('#editTheatre_id').val(movie.theatre_id);
                $('#currentImage').attr('src', '/' + movie.image_url).show();
                $('.text-danger').text('');
            }
        });
    });
    $(document).on('click','.update',function(e){
        const csrf_token=$(this).data('csrf');
        const id = $('#movieId').val();
        const url=`/admin/upload/${id}`;
        const imageInput = $('#editImageUpload')[0];
        const image = imageInput.files[0];

        const formData = new FormData();
        formData.append('id', id);
        formData.append('title', $('#editTitle').val());
        formData.append('genre', $('#editGenre').val());
        formData.append('rating', $('#editRating').val());
        formData.append('duration', $('#editDuration').val());
        formData.append('cast', $('#editCast').val());
        formData.append('showtime', $('#editShowtime').val());
        formData.append('price', $('#editPrice').val());
        formData.append('theatre_id', $('#editTheatre_id').val());
        formData.append('currImg', $('#currentImage').attr('src'));
        if (image) {
            formData.append('image', image);
            formData.append('image_url','');
        }

        // const data = {
        //     id: id,
        //     title: $('#editTitle').val(),
        //     genre: $('#editGenre').val(),
        //     rating: $('#editRating').val(),
        //     duration: $('#editDuration').val(),
        //     cast: $('#editCast').val(),
        //     showtime: $('#editShowtime').val(),
        //     price: $('#editPrice').val(),
        //     theatre_id: $('#editTheatre_id').val(),
        //     image: image,
        //     image_url:''
        // };
        $.ajax({
            method:'POST',
            url:url,
            headers:{
                'X-CSRF-TOKEN':csrf_token
            },
            data:formData,
            contentType:false,
            processData:false,
            success:function(response){
                if (response.status === 'success') {
                    $('#response').html(`<div class='alert alert-success alert-dismissible'>
                    ${response.message}
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>
                    `);
                    const editMovieModal = document.getElementById('editMovieModal');
                    const modalInstance = new bootstrap.Modal(editMovieModal);
                    modalInstance.hide();

                    const tableRow=$(`tr td:nth-child(1):contains(${id})`).parent('tr');
                    tableRow.find(`td:nth-child(2)`).text(response.data.title);
                    tableRow.find(`td:nth-child(3)`).text(response.data.genre);
                    tableRow.find(`td:nth-child(4)`).text(response.data.rating);
                    tableRow.find(`td:nth-child(5)`).text(response.data.duration+'mins');
                    tableRow.find(`td:nth-child(6)`).text(response.data.cast);
                    tableRow.find(`td:nth-child(7)`).text(response.data.theatre_id);
                    tableRow.find(`td:nth-child(8)`).text(response.data.showtime);
                    tableRow.find(`td:nth-child(9)`).text(response.data.price);
                    tableRow.find(`td:nth-child(10) img`).attr('src','/'+response.data.image_url);

                } else {
                    $('#response').html(`<div class='alert alert-danger alert-dismissible'>
                    ${response.message}
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>
                    `);
                }
            }
        });
    });

    $('#editMovieForm').validate({
        onkeyup:function(element){
            $(element).valid();
        },
        rules:{
            title: {
                required: true,
                minlength: 2
            },
            genre: {
                required: true,
                minlength: 2
            },
            rating: {
                required: true,
                number: true,
                min: 0,
                max: 10
            },
            duration: {
                required: true,
                number: true,
                min: 0
            },
            cast: {
                required: true,
                minlength: 2
            },
            showtime: {
                required: true
            },
            price: {
                required: true,
                number: true,
                min: 0
            },
            theatre_id: {
                required: true,
                number: true,
                min: 0
            },
            image: {
                required: true,
                accept: "image/*"
            }
        }
    });

    $("#myForm").validate({
        onkeyup:function(element){
            $(element).valid();
        },
        rules: {
            title: {
                required: true,
                minlength: 2
            },
            genre: {
                required: true,
                minlength: 2
            },
            rating: {
                required: true,
                number: true,
                min: 0,
                max: 10
            },
            duration: {
                required: true,
                number: true,
                min: 0
            },
            cast: {
                required: true,
                minlength: 2
            },
            showtime: {
                required: true
            },
            price: {
                required: true,
                number: true,
                min: 0
            },
            theatre_id: {
                required: true,
                number: true,
                min: 0
            },
            image: {
                required: true,
                accept: "image/*"
            }
        },
        messages: {
            title: {
                required: "Please enter a title",
                minlength: "Title must be at least 2 characters"
            },
            genre: {
                required: "Please enter a genre",
                minlength: "Genre must be at least 2 characters"
            },
            rating: {
                required: "Please enter a rating",
                number: "Rating must be a number",
                min: "Rating must be at least 0",
                max: "Rating must be at most 10"
            },
            duration: {
                required: "Please enter a duration",
                number: "Duration must be a number",
                min: "Duration must be at least 0"
            },
            cast: {
                required: "Please enter a cast",
                minlength: "Cast must be at least 2 characters"
            },
            showtime: {
                required: "Please enter a show time"
            },
            price: {
                required: "Please enter a price",
                number: "Price must be a number",
                min: "Price must be at least 0"
            },
            theatre_id: {
                required: "Please enter a theatre ID",
                number: "Theatre ID must be a number",
                min: "Theatre ID must be at least 0"
            }
        }
    });
});



// admin search
document.addEventListener('DOMContentLoaded',function(){
    const searchButton = document.getElementById('searchButton');
    const searchInput = document.getElementById('searchInput');
    const suggestionContainer = document.getElementById('suggestions');
    searchButton.addEventListener('click',function(){
        const query = searchInput.value;
        if(query.length>2){
            fetch(`admin/movies/suggest?query=${encodeURIComponent(query)}`)
            .then(response => {
                return response.json();
            })
            .then(data =>{
                suggestionContainer.innerHTML='';
                if(data.length>0){
                    data.forEach(movie => {
                        const div=document.createElement('div');
                        div.textContent=movie.title;
                        div.onclick=function(){
                            $.ajax({
                                url:`movies/${movie.id}/page`,
                                method:'GET',
                                dataType: 'json',
                                success: function(data){
                                    if(data.page){
                                        window.location.href=`movies?page=${data.page}&highlight=${movie.id}`;
                                    }
                                    // highlightMovie(movie.id);
                                },
                                error:function(error){
                                    console.error(error);
                                }
                            });
                            suggestionContainer.style.display = 'none';
                        }
                        suggestionContainer.appendChild(div);
                    });
                    suggestionContainer.style.display='block';
                } else{
                    suggestionContainer.style.display= 'none';
                    alert('no movie found. ')
                }
            })
            .catch(error => console.error('Error:', error));
        }else{
            suggestionContainer.style.display='none';
        }

    });
    function highlightMovie(movieId) {
        const rows = document.querySelectorAll('table tbody tr');
        let found = false;

        rows.forEach(row => {
            const rowId = row.cells[0].textContent; // Assuming ID is in the first cell
            if (rowId == movieId) {
                row.classList.add('highlight'); // Add your highlight class
                row.scrollIntoView({ behavior: 'smooth', block: 'center' }); // Scroll to the row
                found = true;
            } else {
                row.classList.remove('highlight'); // Remove highlight from other rows
            }
        });

        if (!found) {
            alert('Movie not found.'); // Optional: Alert if not found
        }
    }
    // Hide suggestions on click outside
    document.addEventListener('click', function(e) {
        if (!suggestionContainer.contains(e.target) && e.target !== searchInput) {
            suggestionContainer.style.display = 'none';
        }
    });
    const urlParams = new URLSearchParams(window.location.search);
    const highlightId = urlParams.get('highlight');
    if (highlightId) {
        highlightMovie(highlightId);
    }
});
