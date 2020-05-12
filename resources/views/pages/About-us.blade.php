@extends('template.mytemplate')

@section('links')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
@endsection

@section('style')
    <link rel="stylesheet" href="/styles/About-us.css">
@endsection

@section('title', 'About Us')
<!-- for htmlspecialchars of all views please see the following https://laravel.com/docs/5.7/blade#displaying-data -->

@section('content')

            <div class="container" id="mianDiv" >
                <div class="row">
                        <div class="col-md-5 col-sm-6 col-xs-10">
                                <h2 class="aboutus-title">About Us</h2>
                            <div class="feature">
                                <div class="feature-box">
                                    <div class="clearfix">
                                        
                                        <div>
                                            <h3>Work with heart and more</h4>
                                            <h4>Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in.</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-box">
                                    <div class="clearfix">
                                      
                                        <div>
                                            <h3>Reliable services</h4>
                                            <h4>Donec vitae sapien ut libero venenatis faucibu. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-box">
                                    <div class="clearfix">
                                      
                                        <div>
                                            <h3>Great support</h3>
                                            <h4>Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-5 col-sm-6 col-xs-10">
                        <!-- <div class="aboutus-banner"> -->
                            <br>
                            <br>
                            <br>
                                <!-- <img id="image" style=" height: 350px;" src="https://www.animatedimages.org/data/media/73/animated-motorbike-image-0015.gif" border="0" alt="animated-motorbike-image-0015" />            </div> -->
                                <img id="image" style=" height: 350px;" src="/pics/other/animated-motorbike-image-0015.gif" border="0" alt="animated-motorbike-image-0015" />            </div>

                            {{-- <img style="width: 350px; height: 512px;" src="https://images.vexels.com/media/users/3/156236/isolated/preview/b3c5ec863b00e35cfd10c73f1c9c5969-motorbike-rider-icon-by-vexels.png" alt=""> --}}
                            {{-- <img style="width: 350px; height: 512px;" src="/pics/other/motorbike-rider-icon-by-vexels.png" alt=""> --}}
                        <!-- </div> -->
                    </div>
                    
                </div>
      
@endsection

