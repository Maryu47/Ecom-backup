<section id="wsus__large_banner">
    <div class="container">
        <div class="row">
            <div class="cl-xl-12">
                {{-- <div class="wsus__large_banner_content" style="background: url(images/large_banner_img.jpg);">
                    <div class="wsus__large_banner_content_overlay">
                        <div class="row">
                            
                        </div>
                    </div>
                </div> --}}
                @if ($homepage_section_banner_four->banner_one->status == 1)
                <a href="{{ $homepage_section_banner_four->banner_one->banner_url }}">
                    <img class="img-fluid"
                        src="{{ asset($homepage_section_banner_four->banner_one->banner_image) }}"
                        alt="">
                </a>
                @endif
            </div>
        </div>
    </div>
</section>