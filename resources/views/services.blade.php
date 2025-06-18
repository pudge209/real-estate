<!-- resources/views/services.blade.php -->

<x-app-layout>
    <style>
        .card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }
        .fas {
            color: #007bff;
        }
        .blade{
            margin-top:20px;
        }
    </style>
    <br>
<div class="blade"></div>
    <div class="container my-5">
        <h1 class="text-center mb-4">Our Services</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <!-- Service 1 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-home fa-3x mb-3"></i>
                        <h5 class="card-title">Property Buying</h5>
                        <p class="card-text">We help you find and purchase the perfect property for your needs, offering expert advice and guidance throughout the process.</p>
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-handshake fa-3x mb-3"></i>
                        <h5 class="card-title">Property Selling</h5>
                        <p class="card-text">We assist you in selling your property quickly and at the best price, using our extensive network and marketing strategies.</p>
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-search-location fa-3x mb-3"></i>
                        <h5 class="card-title">Property Rentals</h5>
                        <p class="card-text">We provide comprehensive rental services, whether you’re looking to rent a property or need help managing your rental portfolio.</p>
                    </div>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-alt fa-3x mb-3"></i>
                        <h5 class="card-title">Legal Advice</h5>
                        <p class="card-text">Our team offers expert legal advice to ensure that all your real estate transactions are compliant with current laws and regulations.</p>
                    </div>
                </div>
            </div>

            <!-- Service 5 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-money-check-alt fa-3x mb-3"></i>
                        <h5 class="card-title">Property Appraisal</h5>
                        <p class="card-text">We offer accurate and reliable property appraisals to help you determine the true market value of your real estate assets.</p>
                    </div>
                </div>
            </div>

            <!-- Service 6 -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-wrench fa-3x mb-3"></i>
                        <h5 class="card-title">Property Management</h5>
                        <p class="card-text">Our property management services cover everything from maintenance to tenant relations, ensuring your investment is well cared for.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
