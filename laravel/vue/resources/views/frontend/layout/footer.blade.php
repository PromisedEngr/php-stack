
    <!---------- footer----------->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul class="footer-icons">
                        <li><a href="#"> <img src="{{asset('public/front/images/in.png')}}" class="img-fluid" alt=""></a> </li>
                        <li><a href="#"> <img src="{{asset('public/front/images/y.png')}}" class="img-fluid" alt=""></a> </li>
                        <li><a href="#"> <img src="{{asset('public/front/images/f.png')}}" class="img-fluid" alt=""></a> </li>
                        <li><a href="#"> <img src="{{asset('public/front/images/t.png')}}" class="img-fluid" alt=""></a> </li>
                    </ul>
                    <p>We are service provider agency. We've been helping business drive revenue eith the use of inbound marketing and sales.</p>
                </div>
                <div class="col-md-4">
                    <h3>Useful Links</h3>
                    <ul class="footer-menu">
                        <li><a href="{{route('home')}}"><i class="fas fa-chevron-right"></i>Home</a>  </li>
                     <li><a href="{{url('/about')}}"><i class="fas fa-chevron-right"></i>About</a>  </li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i>Services </a>  </li>
                     <li><a href="{{url('/contact')}}"><i class="fas fa-chevron-right"></i>Contact Us</a>  </li>
                            <li><a href="{{url('/blog')}}"><i class="fas fa-chevron-right"></i>Blog  </a>  </li>
                     <li><a href="{{route('agent.dashboard')}}"><i class="fas fa-chevron-right"></i>Agents</a>  </li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Customer     </a>  </li>
                     <li><a href="#"><i class="fas fa-chevron-right"></i>FAQs</a>  </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Contact Us</h3>
                    <ul class="contact">
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i><span>Lorem ipsum dolor sit amet, onsect etur adipiscing elit, sed do.</span></a>  </li>
                         <li><a href="#"><i class="fas fa-phone-square-alt"></i><span>1 (816) 542-0555</span></a>  </li>
                            <li><a href="#"><i class="fas fa-envelope"></i><span>info@cleaning expert.com</span></a>  </li>
                    </ul>
                </div>
            </div>
            
        </div>
        <div class="footer-bottom">
        <div class="container"><p>© CLEANING EXPERT <?php echo date('Y') ?> ALL RIGHTS RESERVED</p></div>
        </div>
    </div>
    <!----------- footer----------->