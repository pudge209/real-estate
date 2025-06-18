<!DOCTYPE html>
<html>
<x-app-layout>
</x-app-layout>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<style>
.star-rating {
    display: flex;
    direction: row-reverse;
    font-size: 2rem;
    unicode-bidi: bidi-override;
    color: #ddd;
    position: relative;
}

.star-rating input {
    display: none;
}

.star-rating label {
    cursor: pointer;
    color: #ddd;
    transition: color 0.2s ease-in-out;
}

.star-rating input:checked ~ label {
    color: gold;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}


        .rating-section {
        margin-top: 30px;
    }
    .average-rating span {
        font-size: 20px;
        color: gold;
    }
    .details-container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .main-image {
        width: 100%;
        max-height: 400px; /* Adjusted to fit within the viewport */
        border-radius: 8px;
        cursor: pointer;
    }

    .additional-images {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
        margin-bottom: 50px;
    }

    .additional-images img {
        flex: 1 1 calc(33.333% - 10px);
        max-width: calc(33.333% - 10px);
        max-height: 150px; /* Adjusted to fit within the viewport */
        border-radius: 8px;
        cursor: pointer;
    }

    .property-details {
        margin-top: 30px;
    }

    .property-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .property-details th, .property-details td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .property-details th {
        background-color: #f2f2f2;
        text-align: left;
    }

    .back-button {
        margin-bottom: 20px;
        display: inline-block;
    }

    /* Modal styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 60px; /* Adjust this value to ensure the close button is not hidden */
        left: 0;
        top: 35px;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        position: relative;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
    }

    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    .mySlides {
        display: none;
    }

    .cursor {
        cursor: pointer;
    }

    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 25%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .prev {
        left: 0;
        border-radius: 3px 0 0 3px;
    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    img.hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .rating-section, .reviews-section {
        margin-top: 50px;
    }

    .review-item {
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .review-update-delete-buttons,
    .rating-delete-button {
        margin-top: 10px;
    }
</style>
<br>
<div class="details-container">
    <a href="{{ url()->previous() }}" class="btn btn-secondary back-button mt-5">&leftarrow; Back</a>
    <h2>Real Estate Details</h2>
    <div class="details">
        <!-- Display Main Image -->
        <div>
            @if(!empty($real->image))
                <img src='{{ asset("storage/real-image/$real->image") }}' alt="Real Estate Image" class="main-image hover-shadow cursor" onclick="openModal();currentSlide(1)">
            @else
                <img src='{{ asset("storage/real-image/no-image.jpg") }}' alt="No Image Available" class="main-image hover-shadow cursor" onclick="openModal();currentSlide(1)">
            @endif
        </div>

        <!-- Display Additional Images -->
        <div class="additional-images">
            @foreach($real->realImages as $index => $image)
                <img src='{{ asset("storage/real-image/$image->real_image") }}' onclick="openModal();currentSlide({{ $index + 2 }})" class="hover-shadow cursor">
            @endforeach
        </div>

        <!-- The Modal/Lightbox -->
        <div id="myModal" class="modal">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">
                <!-- Display Main Image in Modal -->
                <div class="mySlides">
                    <div class="numbertext">1 / {{ 1 + count($real->realImages) }}</div>
                    @if(!empty($real->image))
                        <img src='{{ asset("storage/real-image/$real->image") }}' style="width:100%; max-height: 80vh;">
                    @else
                        <img src='{{ asset("storage/real-image/no-image.jpg") }}' style="width:100%; max-height: 80vh;">
                    @endif
                </div>
                @foreach($real->realImages as $index => $image)
                    <div class="mySlides">
                        <div class="numbertext">{{ $index + 2 }} / {{ 1 + count($real->realImages) }}</div>
                        <img src='{{ asset("storage/real-image/$image->real_image") }}' style="width:100%; max-height: 80vh;">
                    </div>
                @endforeach

                <!-- Next/previous controls -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <!-- Caption text -->
                <div class="caption-container">
                    <p id="caption"></p>
                </div>

                <!-- Thumbnail image controls -->
                <div class="additional-images">
                    @if(!empty($real->image))
                        <img class="demo" src='{{ asset("storage/real-image/$real->image") }}' onclick="currentSlide(1)" alt="Main Image">
                    @else
                        <img class="demo" src='{{ asset("storage/real-image/no-image.jpg") }}' onclick="currentSlide(1)" alt="No Image Available">
                    @endif
                    @foreach($real->realImages as $index => $image)
                        <img class="demo" src='{{ asset("storage/real-image/$image->real_image") }}' onclick="currentSlide({{ $index + 2 }})" alt="Image {{ $index + 1 }}">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="property-details">
            <table>
                <tr>
                    <th>Property</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{$real->country}}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{$real->city}}</td>
                </tr>
                <tr>
                    <td>Street</td>
                    <td>{{$real->street}}</td>
                </tr>
                <tr>
                    <td>Zip Code</td>
                    <td>{{$real->zip_code}}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{$real->status}}</td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td>{{$real->size}}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>{{$real->price}}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{$real->description}}</td>
                </tr>

                <tr>
                    <div class="rating-section">
                        <h3>Average Rating</h3>
                        <div class="average-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $averageRating)
                                    <span>&#9733;</span> <!-- Filled star -->
                                @else
                                    <span>&#9734;</span> <!-- Empty star -->
                                @endif
                            @endfor
                            ({{ number_format($averageRating, 1) }})
                        </div>
                    </div>
                </tr>

                <tr>
                    <td>Real Type</td>
                    <td>
                        @if($real->real_type == 1)
                            Residential
                            @elseif($real->real_type == 2)

                            Commercial Land
                        @elseif($real->real_type == 3)
                            Other
                        @endif
                    </td>
                </tr>
                @if($real->real_type == 1)
                    @if(!empty($real->house->rooms))
                        <tr>
                            <td>Rooms</td>
                            <td>{{$real->house->rooms}}</td>
                        </tr>
                    @endif
                    @if(!empty($real->house->bedrooms))
                        <tr>
                            <td>Bedrooms</td>
                            <td>{{$real->house->bedrooms}}</td>
                        </tr>
                    @endif
                    @if(!empty($real->house->bathrooms))
                        <tr>
                            <td>Bathrooms</td>
                            <td>{{$real->house->bathrooms}}</td>
                        </tr>
                    @endif
                    @if(!empty($real->house->garage))
                        <tr>
                            <td>Garage</td>
                            <td>{{$real->house->garage}}</td>
                        </tr>
                    @endif
                @elseif($real->real_type == 2)
                    @if(!empty($real->commercial->commercial_kind))
                        <tr>
                            <td>Commercial Kind</td>
                            <td>{{$real->commercial->commercial_kind}}</td>
                        </tr>
                    @endif
                    @if(!empty($real->commercial->parking_spot))
                        <tr>
                            <td>Parking Spot</td>
                            <td>{{$real->commercial->parking_spot}}</td>
                        </tr>
                    @endif
                @elseif($real->real_type == 3)
                    @if(!empty($real->other->type_of_use))
                        <tr>
                            <td>Type of Use</td>
                            <td>{{$real->other->type_of_use}}</td>
                        </tr>
                    @endif
                @endif
            </table>
        </div>

        <div class="rating-section">
            <h3>Rate this Property</h3>
            <form action="{{ route('real-estate.ratings.store', $real->id) }}" method="POST">
                @csrf
                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ isset($userRating) && $userRating == $i ? 'checked' : '' }} />
                        <label for="star{{ $i }}" title="{{ $i }} star">&#9733;</label>
                    @endfor
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
            </form>

            <div class="rating-delete-button">
                <form action="{{ route('real-estate.ratings.destroy', $real->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Rating</button>
                </form>
            </div>

            
        </div>


        <!-- Reviews Section -->
<div class="reviews-section">
    <h3>Customer Reviews</h3>
    @foreach ($real->reviews as $review)
        <div class="review-item">
            <p><strong>{{ $review->user->name }}</strong> ({{ $review->created_at->format('d M Y') }})</p>
            <p>{{ $review->review }}</p>

            @if(Auth::check() && Auth::id() == $review->user_id)
                <div class="review-update-delete-buttons">
                    <!-- Update Form -->
                    <form action="{{ route('real-estate.reviews.update', [$real->id, $review->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <textarea name="review" rows="2" class="form-control" required>{{ $review->review }}</textarea>
                        <button type="submit" class="btn btn-secondary mt-2">Update</button>
                    </form>

                    <!-- Delete Form -->
                    <form action="{{ route('real-estate.reviews.destroy', [$real->id, $review->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach

    <!-- Add new review -->
    <form action="{{ route('real-estate.reviews.store', $real->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="review">Add Your Review:</label>
            <textarea name="review" id="review" rows="3" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit Review</button>
    </form>
</div>


    </div>
</div>

<script>
    document.querySelectorAll('.star-rating input').forEach(input => {
        input.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>
</html>
