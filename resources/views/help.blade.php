<!-- resources/views/help.blade.php -->

<x-app-layout>
    <style>
        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-header {
            margin-bottom: 0.5rem;
        }

        .accordion-body {
            font-size: 1rem;
            color: #6c757d;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #343a40;
        }
        .space{
            margin-top: 70px;
        }
    </style>
<div class="space"></div>
    <div class="container my-5">
        <h1 class="text-center mb-4 mt-5">Help & FAQs</h1>

        <div class="accordion" id="helpAccordion">

            <!-- Question 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How do I list my property for sale?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        To list your property for sale, navigate to the "Sell Property" section, fill in the required details, and submit the listing. Our team will review it and publish it on our platform.
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How do I find rental properties?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        To find rental properties, use the search bar on the homepage, select the "Rent" option, and filter results by location, price range, and other preferences.
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        What are the fees for listing a property?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        Listing a property on our platform is free of charge. However, if you opt for additional marketing services or premium listings, fees may apply. Please contact our support team for detailed information.
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        How do I contact customer support?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        You can contact our customer support by clicking on the "Contact Us" link in the footer or by sending an email directly to support@yourdomain.com.
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        How do I update my property listing?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        To update your property listing, log in to your account, go to "My Listings," and select the property you want to update. Make the necessary changes and save them.
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
