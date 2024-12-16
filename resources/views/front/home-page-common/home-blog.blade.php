<section class="content" style="background-color: #fffff; padding-top:10px;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; ">
        <div class="heading-text" style="text-align: center; margin-bottom: 40px;">
            <h2 style="font-size: 36px; color: #333; margin-bottom: 20px;">Browse Our Latest Blogs</h2>
            <p style="font-size: 18px; color: #666; max-width: 800px; margin: 0 auto;">
                We've included a collection of blogs with a wealth of information to help you learn more about the workshops and 
                get to know your VSCHOLAR better.
            </p>
        </div>

        <div id="blogs" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            @foreach($blog_list as $k=>$v)
            <div class="blog-item" style="background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div class="blog-item-wrap">
                    <div class="blog-image" style="height: 200px; overflow: hidden;">
                        <a href="{{url('blog-detail/'.$v->slug)}}" style="display: block; height: 100%;">
                            <img alt="{{$v->name}}" src="{{asset($v->image)}}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                        </a>
                    </div>
                    <div class="blog-item-description" style="padding: 20px;">
                        <h3 style="font-size: 20px; margin-bottom: 10px;">
                            <a href="{{url('blog-detail/'.$v->slug)}}" style="color: #333; text-decoration: none; transition: color 0.3s ease;">{{$v->name}}</a>
                        </h3>
                        <p style="color: #666; font-size: 14px; margin-bottom: 15px;">{{truncate($v->short_description, 100)}}</p>
                        <a href="{{url('blog-detail/'.$v->slug)}}" class="item-link" style="display: inline-flex; align-items: center; color: #4CAF50; text-decoration: none; font-weight: 600; transition: color 0.3s ease;">
                            Read More 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 5px; width: 18px; height: 18px;">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            #blogs {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }
        .blog-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .blog-item:hover img {
            transform: scale(1.05);
        }
        .blog-item h3 a:hover {
            color: #4CAF50;
        }
        .item-link:hover {
            color: #45a049;
        }
    </style>
</section>

