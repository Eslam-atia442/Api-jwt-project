@extends('gamesstation.layouts.temps')
@section('content')
   @include('gamesstation.layouts.errors')
           @include('gamesstation.layouts.messages')


    <br>
    <br>
    <br>

     @if(session('lang') == 'en')
     
    <br>
         @foreach($HomeSlidersEn as  $HomeSlider)
           <img class="mySlides" src="{{url('/')}}/{{substr($HomeSlider->full_file, -29) }}" style="width:100%">
         @endforeach
     @else
    <br>
     
         @foreach($HomeSliders as  $HomeSlider)
           <img class="mySlides" src="{{url('/')}}/{{substr($HomeSlider->full_file, -29) }}" style="width:100%">
         @endforeach
     @endif


   

        
      <!-- Games Area Strat -->
      <section class="fag-games-area section_140">

            @include('gamesstation.layouts.errors')
           @include('gamesstation.layouts.messages')
              @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
                @endif

                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="site-heading">
                     <h2 class="heading_animation">{{trans('admin.our_games')}}</span></h2>
                     
                  </div>
               </div>
            </div>
            <div class="row"
             @if(session('lang') == 'en')
                style='direction: ltr';
             @else
                style='direction: rtl';
             @endif>
               <div class="col-12">
                  <div class="games-masonary">
                     <div class="projectFilter project-btn">
                        <ul>
                           <li><a href="#" data-filter="*" class="current">{{trans('admin.show_all')}}</a></li>
                           <li><a href="#" data-filter=".latest">{{trans('admin.latest_products')}}</a></li>
                           <li><a href="#" data-filter=".offer">{{trans('admin.offers')}}</a></li>
                        </ul>
                     </div>

                     <div class="clearfix gamesContainer games" >
                        
                    


                    @isset($latest_products)
                      @foreach($latest_products as $product)
                        <div class="games-item latest">
                           <div class="games-single-item img-contain-isotope">
                              <div class="games-thumb">
                                 <div>
                                    <a href="{{ url('game-single/' . $product->id) }}">
                                    <img src="{{url('/')}}/{{substr($product->photo, -29) }}" alt="games" />
                                    </a>
                                 </div>
                              </div>
                              <div class="games-desc">
                                 <h3><a href="{{ url('game-single/' . $product->id) }}">
                                  @if(session('lang')=='ar')
                                        {{ $product->title_name_ar  }}
                                        @elseif(session('lang')=='en')
                                        {{ $product->title_name_en  }}
                                        @else
                                        {{ $product->title_name_ar }} 
                                    @endif
                                 </a></h3>
                                 <p class="game-meta">
                                    @if(session('lang')=='ar')
                                        {{$product->department_name->dep_name_ar}}
                                        @elseif(session('lang')=='en')
                                        {{$product->department_name->dep_name_en}}
                                        @else
                                        {{$product->department_name->dep_name_ar}} 
                                    @endif
                                 </p>
                                 <div class="game-action">
                                    <div class="game-price">
                                       @if($product->price_offer > 0)
                                       <h4>{{ $product->price_offer }} {{trans('admin.KWD')}}</h4>
                                       <p class="off"><del>{{ $product->price }} {{trans('admin.KWD')}}</del></p>
                                       @else
                                          <h4>{{ $product->price }} {{trans('admin.KWD')}}</h4>
                                          <h4 class="invisible">{{ $product->price_offer }} {{trans('admin.KWD')}}</h4>
                                       @endif
                                    </div>
                                    
                                 </div>
                                  <div class="game-buy">
                                       <a href="{{url('/')}}/add_to_cart2/{{$product->id}}" class="fag-btn-outline" style="display: inline-block;">{{trans('admin.buy_now')}}</a>

                                       <a class="heart" href="{{url('/wishlist/' . $product->id)}}" style="display: inline-block;">
                                        <i class="fa fa-heart"></i></a>
                                    </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        @endisset

                        @isset($offered_products)
                        @foreach($offered_products as $product)
                        <div class="games-item offer">
                           <div class="games-single-item img-contain-isotope">
                              <div class="games-thumb">
                                 <div>
                                    <a href="{{ url('game-single/' . $product->id) }}">
                                    <img src="{{url('/')}}/{{substr($product->photo, -29) }}" alt="games" />
                                    </a>
                                 </div>
                              </div>
                              <div class="games-desc">
                                 <h3><a href="{{ url('game-single/' . $product->id) }}">
                                  @if(session('lang')=='ar')
                                        {{ $product->title_name_ar  }}
                                        @elseif(session('lang')=='en')
                                        {{ $product->title_name_en  }}
                                        @else
                                        {{ $product->title_name_ar }} 
                                    @endif
                                 </a></h3>
                                 <p class="game-meta">
                                    @if(session('lang')=='ar')
                                        {{$product->department_name->dep_name_ar}}
                                        @elseif(session('lang')=='en')
                                        {{$product->department_name->dep_name_en}}
                                        @else
                                        {{$product->department_name->dep_name_ar}} 
                                    @endif
                                 </p>
                                 <div class="game-action">
                                    <div class="game-price">
                                       @if($product->price_offer > 0)
                                       <h4>{{ $product->price_offer }} {{trans('admin.KWD')}}</h4>
                                       <p class="off"><del>{{ $product->price }} {{trans('admin.KWD')}}</del></p>
                                       @else
                                          <h4>{{ $product->price }} {{trans('admin.KWD')}}</h4>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="game-buy">
                                       <a href="{{url('/')}}/add_to_cart2/{{$product->id}}" class="fag-btn-outline" style="display: inline-block;">{{trans('admin.buy_now')}}</a>
                                       <a class="heart" href="{{url('/wishlist/' . $product->id)}}" style="display: inline-block;">
                                        <i class="fa fa-heart"></i></a>
                                    </div>
                              </div>
                           </div>
                        </div> 
                        @endforeach
                        @endisset   

                      @isset($productt)
                         
                        <div class="games-item offer">
                           <div class="games-single-item img-contain-isotope">
                              <div class="games-thumb">
                                 <div>
                                    <a href="{{ url('game-single/' . $productt->id) }}">
                                    <img src="{{url('/')}}/{{substr($productt->photo, -29) }}" alt="games" />
                                    </a>
                                 </div>
                              </div>
                              <div class="games-desc">
                                 <h3><a href="{{ url('game-single/' . $productt->id) }}">
                                  @if(session('lang')=='ar')
                                        {{ $productt->title_name_ar  }}
                                        @elseif(session('lang')=='en')
                                        {{ $productt->title_name_en  }}
                                        @else
                                        {{ $productt->title_name_ar }} 
                                    @endif
                                 </a></h3>
                                 <p class="game-meta">
                                    @if(session('lang')=='ar')
                                        {{$productt->department_name->dep_name_ar}}
                                        @elseif(session('lang')=='en')
                                        {{$productt->department_name->dep_name_en}}
                                        @else
                                        {{$productt->department_name->dep_name_ar}} 
                                    @endif
                                 </p>
                                 <div class="game-action">
                                    <div class="game-price">
                                       @if($productt->price_offer > 0)
                                       <h4>{{ $productt->price_offer }} {{trans('admin.KWD')}}</h4>
                                       <p class="off"><del>{{ $productt->price }} {{trans('admin.KWD')}}</del></p>
                                       @else
                                          <h4>{{ $productt->price }} {{trans('admin.KWD')}}</h4>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="game-buy">
                                       <a href="{{url('/')}}/add_to_cart2/{{$productt->id}}" class="fag-btn-outline" style="display: inline-block;">{{trans('admin.buy_now')}}</a>
                                       <a class="heart" href="{{url('/wishlist/' . $productt->id)}}" style="display: inline-block;">
                                        <i class="fa fa-heart"></i></a>
                                    </div>
                              </div>
                           </div>
                        </div>
                        @endisset 
                        
     
                              </div>
                           </div>
                        </div>
                        <!-- end game item -->
                     </div>

                  </div>
               </div>
            </div>

         </div>


      </section>
      <!-- Games Area End -->

                                   <div class="container">
  <div class="row">
    <div class="col text-center">
      <a href="{{url('/')}}/GMZproducts" class="fag-btn"> {{trans('admin.show more')}}<span></span></a>
    </div>
  </div>
</div>
       
       
       <br>
       <br>
      

@endsection


@section('scripts')
    
    <script>
 
    /*  $(document).on('click', '#offers', function(e) {
          e.preventDefault();

        
          $.ajax({
            url: '{{route("game.offer")}}',
            method: 'post',
            data: {
              _token: "{{ csrf_token() }}",
            },
            success: function(data) {
              
              $.each( data, function( key, value ) {
                  $.each(value, function(k, v) {

                    var photo = v.photo;
                    var name_ar = v.title_name_ar;
                    var name_en = v.title_name_en;
                    var price_offer = v.price_offer;
                    var price = v.price;
                    var id = v.id;
                    
                     
                        
                  var html = '<div class="games-item mobile">' +
                           '<div class="games-single-item img-contain-isotope">' +
                              '<div class="games-thumb">' +
                                 '<div class="games-thumb-image">' +
                                    '<a href="{{ url("game-single/".'  + id + ') }}">' +
                                    '<img src="{{Storage::url(' + photo + ')}}" alt="games" />' +
                                    '</a>' +
                                 '</div>' +
                              '</div>' +
                              '<div class="games-desc">' +
                                 '<h3><a href="{{ url("game-single/".' + id + ') }}">' +
                                   ' @if(session("lang")=="ar")' +
                                          name_ar +
                                        '@elseif(session("lang")=="en")' +
                                            name_en +
                                        '@else' +
                                            name_ar + 
                                    '@endif' +
                                     '</a></h3>' +
                                
                                 '<div class="game-action">' +
                                    '<div class="game-price">' +
                                       '@if(' + price_offer > 0 + ')' +
                                       '<h4>{{' + price_offer + '}} {{trans("admin.KWD")}}</h4>' +
                                       '<p class="off"><del>{{' + price + '}} {{trans("admin.KWD")}}</del></p>' +
                                       '@else' +
                                          '<h4>{{' + price + '}} {{trans("admin.KWD")}}</h4>' +
                                       '@endif' +
                                       
                                    '</div>' +
                                    '<div class="game-buy">' +
                                       '<a href="{{url("/")}}/add_to_cart2/{{' + id + '}}"' + 
                                       'class="fag-btn-outline">{{trans("admin.buy_now")}}</a>'+
                                    '</div>' +
                                 '</div>' +
                              '</div>' +
                           '</div>' +
                        '</div>';

                      $('.games').append(html);

                        console.log(html);
            

              //console.log(data);
               
            });
          });

            }

      });
  });*/

      
    </script>  


@endsection