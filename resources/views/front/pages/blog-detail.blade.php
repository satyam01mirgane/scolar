@include('front.common.header')
@include('front.common.navbar')

<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <!-- Post Content -->
            <div class="content col-lg-9">
                <!-- Blog -->
                <div id="blog" class="single-post">
                    <!-- Post single item -->
                    <div class="post-item">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="#">
                                    <img alt="" src="{{ asset($blog_detail->image) }}">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <h2>{{ $blog_detail->name }}</h2>
                                <div class="post-meta">
                                    <span class="post-meta-date">
                                        <i class="fa fa-calendar-o"></i>{{ date('d M, Y', strtotime($blog_detail->created_at)) }}
                                    </span>
                                    <span class="post-meta-category">
                                        <a href=""><i class="fa fa-tag"></i>{{ ucfirst($category_details->name) }}</a>
                                    </span>
                                    <!-- Share Button -->
                                    <div class="post-meta-share">
                                        <button class="btn btn-primary share-button" onclick="shareContent()">
                                            <i class="fa fa-share-alt"></i> Share
                                        </button>
                                    </div>
                                </div>
                                <!-- Render WYSIWYG Content -->
                                <div class="wysiwyg-content" style="text-align: justify;">
                                    {!! $blog_detail->short_description !!}
                                </div>
                                <div class="blockquote">
                                    <small><cite>{!! $blog_detail->punch_text !!}</cite></small>
                                </div>
                                <div class="wysiwyg-content" style="text-align: justify;">
                                    {!! $blog_detail->full_description !!}
                                </div>
                            </div>
                            <div class="post-navigation">
                                @if(isset($blog_detail_prev))
                                    <a href="{{ url('/blog-detail/'.$blog_detail_prev->slug) }}" class="post-prev">
                                        <div class="post-prev-title">
                                            <span>Previous Post</span>{{ $blog_detail_prev->name }}
                                        </div>
                                    </a>
                                @else
                                    <a class="post-prev">
                                        <div class="post-prev-title"><span>&nbsp;</span>No record available</div>
                                    </a>
                                @endif
                                <a href="{{ url('blog-masonry-3.html') }}" class="post-all">
                                    <i class="icon-grid"></i>
                                </a>
                                @if(isset($blog_detail_next))
                                    <a href="{{ url('/blog-detail/'.$blog_detail_next->slug) }}" class="post-next">
                                        <div class="post-next-title">
                                            <span>Next Post</span>{{ $blog_detail_next->name }}
                                        </div>
                                    </a>
                                @else
                                    <a class="post-prev">
                                        <div class="post-prev-title"><span>&nbsp;</span>No record available</div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Post Single Item -->
                </div>
            </div>
            <!-- End Post Content -->

            <!-- Sidebar -->
            <div class="sidebar sticky-sidebar col-lg-3">
                <!-- Recent Posts -->
                <div class="widget">
                    <h4 class="widget-title">Recently Posted</h4>
                    <div class="post-thumbnail-list">
                        @foreach($blog_list as $k => $v)
                            <div class="post-thumbnail-entry">
                                <img src="{{ asset($v->image) }}" alt="">
                                <div class="post-thumbnail-content">
                                    <a href="{{ url('/blog-detail/'.$v->slug) }}">{{ $v->name }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- End Recent Posts -->

               
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</section>

<!-- Add this script at the bottom of your page, before the closing body tag -->
<script>
function shareContent() {
    // Get the current page URL
    const url = window.location.href;
    const title = document.querySelector('.post-item-description h2').textContent;

    // Check if the Web Share API is supported
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        })
        .then(() => console.log('Successful share'))
        .catch((error) => console.log('Error sharing:', error));
    } else {
        // Fallback for browsers that don't support the Web Share API
        // Create a temporary input to copy the URL
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        
        // Show a notification that the link was copied
        alert('Link copied to clipboard!');
    }
}
</script>

<style>
.share-button {
    padding: 8px 15px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.share-button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

.share-button i {
    font-size: 16px;
}

/* Mobile Responsive Adjustments */
@media (max-width: 768px) {
    .post-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .post-meta-share {
        margin-top: 10px;
    }
    
    .share-button {
        width: 100%;
        justify-content: center;
    }
}
</style>

@include('front.common.footer')