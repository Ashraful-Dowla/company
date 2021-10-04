@extends('layouts.master-home')

@section('content')
<section id="portfolio" class="portfolio">
    <div class="container py-5">
        <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-app">App</li>
                    <li data-filter=".filter-card">Card</li>
                    <li data-filter=".filter-web">Web</li>
                </ul>
            </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">

            @foreach ($portfolio_images as $img)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <img src="{{ asset($img->image)}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <h4>App 1</h4>
                    <p>App</p>
                    <a href="{{ asset($img->image)}}" data-gall="portfolioGallery" class="venobox preview-link"
                        title="App 1"><i class="bx bx-plus"></i></a>
                    <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection