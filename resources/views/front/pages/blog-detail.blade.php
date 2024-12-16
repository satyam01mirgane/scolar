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
                                    <span class="post-meta-comments">
                                        <a href=""><i class="fa fa-comments-o"></i>({{ count($comment) }}) Comments</a>
                                    </span>
                                    <span class="post-meta-category">
                                        <a href=""><i class="fa fa-tag"></i>{{ ucfirst($category_details->name) }}</a>
                                    </span>
                                    <div class="post-meta-share">
                                        <a class="btn btn-xs btn-slide btn-facebook" href="https://www.facebook.com/VSCHOLAR LLP">
                                            <i class="fab fa-facebook-f"></i>
                                            <span>Facebook</span>
                                        </a>
                                        <a class="btn btn-xs btn-slide btn-twitter" href="https://twitter.com/VSCHOLAR 4" data-width="100">
                                            <i class="fab fa-twitter"></i>
                                            <span>Twitter</span>
                                        </a>
                                        <a class="btn btn-xs btn-slide btn-instagram" href="https://www.instagram.com/VSCHOLAR _llp/" data-width="118">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </a>
                                        <a class="btn btn-xs btn-slide btn-googleplus" href="https://in.linkedin.com/company/VSCHOLAR -llp" data-width="80">
                                            <i class="fab fa-linkedin-in"></i>
                                            <span>LinkedIn</span>
                                        </a>
                                        <a class="btn btn-xs btn-slide btn-googleplus" href="mailto:info@VSCHOLAR.in" data-width="80">
                                            <i class="icon-mail"></i>
                                            <span>Mail</span>
                                        </a>
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

                <!-- Newsletter -->
                <div class="widget widget-newsletter">
                    <form class="widget-subscribe-form" novalidate action="#" role="form">
                        <h4 class="widget-title">Newsletter</h4>
                        <small>Stay informed on our latest news!</small>
                        <div class="input-group">
                            <input type="email" required name="widget-subscribe-form-email" id="subs_email" class="form-control required email" placeholder="Enter your Email">
                            <span class="input-group-btn">
                                <button type="button" id="widget-subscribe-submit-button" class="btn btn-primary saveNews"><i class="fa fa-paper-plane"></i></button>
                            </span>
                        </div>
                        <span id="msg"></span>
                    </form>
                </div>
                <!-- End Newsletter -->
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</section>

@include('front.common.footer')
