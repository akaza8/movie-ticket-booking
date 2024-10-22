@extends('layouts.main')

@section('content')
    <div class="booking-container">
        <h1 class="booking-title text-center">Book Tickets for {{ $data[0]->title }}</h1>
        <hr>

        <div class="booking-details d-flex flex-column flex-md-row justify-content-center ">
            <div class="movie-info me-md-4 text-center mb-4 mb-md-0">
                <img class="movie-poster img-fluid" src="{{ asset($data[0]->image_url) }}" alt="{{ $data[0]->title }} poster"
                    style="max-width: 300px;">
                <div class="mt-3">
                    <h2>Movie Details</h2>
                    <p><strong>Genre:</strong> {{ $data[0]->genre }}</p>
                    <p><strong>Rating:</strong> {{ $data[0]->rating }}</p>
                    <p><strong>Duration:</strong> {{ $data[0]->duration }} mins</p>
                    <p><strong>Showtime:</strong> {{ $data[0]->showtime }}</p>
                </div>
            </div>

            <div class="seat-selection mt-4 mt-md-0 text-center w-25">
                <h2 class="mb-3 mt-2">Select Seats</h2>
                <div class="seat-map d-flex flex-wrap justify-content-center w-100 text-center mx-auto">
                    @foreach ($data[1] as $seat)
                        <div class="seat {{ $seat->is_booked ? '1 bg-danger text-white' : '' }}"
                            data-seat-id="{{ $seat->id }}">
                            {{ $seat->number }}
                        </div>
                    @endforeach
                </div>
                {{-- <p class="seat-note text-center">Click on a seat to select or deselect.</p> --}}
            </div>
        </div>

        <div class="booking-summary mt-4 text-center">
            <h2>Booking Summary</h2>
            <p><strong>Selected Seats:</strong> <span id="selected-seats">None</span></p>
            <p><strong>Total Price:</strong> <span id="total-price">₹0.00</span></p>
            <button id="confirm-booking" class="btn btn-success">Confirm Booking</button>
        </div>
    </div>
    {{-- ticket Modal --}}
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketModalLabel">Booking Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Your Booking Details</h4>
                    <p><strong>Movie:</strong> <span id="ticket-movie-title"></span></p>
                    <p><strong>Showtime:</strong> <span id="ticket-showtime"></span></p>
                    <p><strong>Total Seats:</strong> <span id="ticket-selected-seats"></span></p>
                    <p><strong>Total Cost:</strong> <span id="ticket-total-cost"></span></p>
                    <div id="ticket-qr-code" class="text-center mt-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="print-ticket">Print Ticket</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            const seatPrice = {{ $data[0]->price }};
            let selectedSeats = [];
            let totalPrice = 0;
            $('.seat').on('click', function() {
                if (!$(this).hasClass('1')) {
                    $(this).toggleClass('selected');
                    const seatId = $(this).data('seat-id');

                    if (selectedSeats.includes(seatId)) {
                        selectedSeats = selectedSeats.filter(id => id !== seatId);
                        totalPrice -= seatPrice;
                    } else {
                        selectedSeats.push(seatId);
                        totalPrice += seatPrice;
                    }

                    $('#selected-seats').text(selectedSeats.length > 0 ? selectedSeats.length : 'None');
                    $('#total-price').text(`₹${totalPrice.toFixed(2)}`);
                }
            });

            $('#confirm-booking').on('click', function() {
                if (selectedSeats.length > 0) {
                    const data = {
                        user_id: {{ Auth::user()->id }},
                        movie_id: {{ $data[0]->id }},
                        total_cost: totalPrice,
                        seats: selectedSeats,
                    };
                    const url = "{{ route('booking.store') }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            if (response.message === 'success') {
                                $booked = response.seats;
                                $booked.forEach(seatId => {
                                    $(`.seat[data-seat-id='${seatId}']`).addClass(
                                        'bg-danger text-white selected');
                                });
                                $('#ticket-movie-title').text(`{{ $data[0]->title }}`);
                                $('#ticket-showtime').text(`{{ $data[0]->showtime }}`);
                                $('#ticket-selected-seats').text(response.seatNo.join(', '));
                                $('#ticket-total-cost').text('₹' + totalPrice.toFixed(2));
                                $('#selected-seats').text(0);
                                $('#total-price').text('₹' + 0.00);
                                // console.log(response.qr_code);
                                // $('#ticket-qr-code').html(response.qr_code);
                                $('#ticketModal').modal('show');
                            }
                        }

                    });
                } else {
                    alert('Please select at least one seat to book.');
                }
            });
            $('#print-ticket').on('click', function() {
                const ticketContent = `
                <h4>Your Booking Details</h4>
                <p><strong>Movie:</strong> ${$('#ticket-movie-title').text()}</p>
                <p><strong>Showtime:</strong> ${$('#ticket-showtime').text()}</p>
                <p><strong>Selected Seats:</strong> ${$('#ticket-selected-seats').text()}</p>
                <p><strong>Total Cost:</strong> ${$('#ticket-total-cost').text()}</p>
            `;

                const newWindow = window.open('', '', 'width=600,height=400');
                newWindow.document.write('<html><head><title>Print Ticket</title></head><body>');
                newWindow.document.write(ticketContent);
                newWindow.document.write('</body></html>');
                newWindow.document.close();
                newWindow.print();
            });
        });
    </script>
@endsection
