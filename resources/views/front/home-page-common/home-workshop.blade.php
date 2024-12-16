<!-- <section id="page-content" style="background-color: #fffff; padding: 50px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <div class="row" style="justify-content: center;">
            <div class="content col-lg-12">
                <h2 style="text-align: center; color: #333; font-size: 36px; margin-bottom: 20px; animation: fadeInDown 0.8s ease-out;">Our Upcoming Workshops</h2>
                <p style="text-align: center; color: #666; font-size: 18px; margin-bottom: 40px; max-width: 800px; margin-left: auto; margin-right: auto; animation: fadeInUp 0.8s ease-out 0.2s both;">
                    Take a look at our upcoming workshops that will assist you in actualizing your innate talent and enhance 
                    your aptitude, allowing you to rediscover your career options. Sign up for a workshop and learn from the best.
                </p>
                <div class="workshop-carousel" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px;">
                    @foreach($workshop_list as $k=>$v)
                    <div class="workshop-item" style="background-color: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; width: calc(33.333% - 20px); margin-bottom: 30px; transition: transform 0.3s ease, box-shadow 0.3s ease; animation: fadeInUp 0.8s ease-out {{$k * 0.1 + 0.4}}s both;">
                        <div class="workshop-item-wrap" style="height: 100%; display: flex; flex-direction: column;">
                            <div class="workshop-image" style="height: 200px; overflow: hidden;">
                                <a href="{{url('workshops-detail/'.$v->slug)}}" style="display: block; height: 100%;">
                                    <img alt="{{$v->name}}" src="{{asset($v->image)}}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                </a>
                            </div>
                            <div class="workshop-item-description" style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column;">
                                <span class="workshop-meta-date" style="display: block; color: #888; font-size: 14px; margin-bottom: 10px;">
                                    <i class="fa fa-calendar-o" style="margin-right: 5px;"></i>{{date('d M Y h:i A', strtotime($v->session_date.' '.$v->session_time))}}
                                </span>
                                <h3 style="font-size: 20px; margin-bottom: 10px;">
                                    <a href="{{url('workshops-detail/'.$v->slug)}}" style="color: #333; text-decoration: none; transition: color 0.3s ease;">
                                        {{truncate($v->name, 30)}}
                                    </a>
                                </h3>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px; flex-grow: 1;">{{truncate($v->short_description, 70)}}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 18px; font-weight: bold; color: #4CAF50;">
                                        @if($v->workshop_type == 'Free') Free @else ₹{{$v->price}} @endif
                                    </span>
                                    @if(!in_array($v->id, cartproduct()))
                                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px;">
                                            @csrf
                                            <input type="hidden" value="{{ $v->id }}" name="id">
                                            <input type="hidden" value="{{ $v->name }}-Workshop" name="name">
                                            <input type="hidden" value="{{$v->price}}" name="price">
                                            <input type="hidden" value="{{ $v->image }}"  name="image">
                                            <input type="hidden" value="1" name="quantity">
                                            
                                            @if($v->total_seat > 0)
                                                <button class="btn-enroll" type="submit" style="background-color: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease, transform 0.3s ease;">Enroll Now</button>
                                                <span class="seats-left" style="background-color: #f0f0f0; color: #333; padding: 8px 15px; border-radius: 5px; font-size: 14px;">{{$v->total_seat}} Seats Left</span>
                                            @else
                                                <button type="button" class="btn-full" style="background-color: #f44336; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: not-allowed;">Seats Full</button>
                                            @endif
                                        </form>
                                    @else
                                        <button class="btn-in-cart" type="button" style="background-color: #2196F3; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: default;">In Cart</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 20px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        .workshop-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .workshop-item:hover img {
            transform: scale(1.05);
        }
        .btn-enroll:hover {
            background-color: #45a049 !important;
            transform: scale(1.05);
        }
        .workshop-item h3 a:hover {
            color: #4CAF50 !important;
        }
    </style>
</section>
 -->
