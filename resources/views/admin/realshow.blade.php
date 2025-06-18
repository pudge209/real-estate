@include('admin.header')

<body>
    <div class="wrapper">
        @include('admin.sidebar')

        <div class="main">
            @include('admin.master-nav')

            <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

            <style>
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
                    margin-bottom: 50px;5
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
                </div>
            </div>

            <script>
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

            @include('admin.footer')
