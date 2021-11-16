<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
<main class="community-review">
         <div class="container-fluid">
            <h1 class="title">Community Reviews</h1>
            <div class="row gy-4">
               <div class="col-md-12">
                  <div class="BoxShade commutyReview">
                     <figure><img src="{{asset('assets/images/img-1.png')}}"></figure>
                     <div class="user-Detail">
                        <h5>Emily Watson</h5>
                        <p class="r-date">12 Jul 2021</p>
                        <ul class="share-up">
                           <li><a href="#">Report</a></li>
                           <li><span class="icon-thumbs-up"></span> 24</li>
                           <li><span class="icon-thumbs-down"></span> 12</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                        <a href="#" class="reply">Reply</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="BoxShade commutyReview">
                     <figure><img src="{{asset('assets/images/img-2.png')}}"></figure>
                     <div class="user-Detail">
                        <h5>Emily Watson</h5>
                        <p class="r-date">12 Jul 2021</p>
                        <ul class="share-up">
                           <li><a href="#">Report</a></li>
                           <li><span class="icon-thumbs-up"></span> 24</li>
                           <li><span class="icon-thumbs-down"></span> 12</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                        <p class="Viewrepla" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">&nbsp;</p>
                        <div class="collapse" id="collapseExample">
                           <div class="Allreply">
                              <figure><img src="{{asset('assets/images/img-2.png')}}"></figure>
                              <div class="review-detail">
                                 <h6>Emily Watson</h6>
                                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                              </div>
                           </div>
                        </div>
                        <a href="#" class="reply">Reply</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="BoxShade commutyReview">
                     <figure><img src="{{asset('assets/images/img-3.png')}}"></figure>
                     <div class="user-Detail">
                        <h5>Emily Watson</h5>
                        <p class="r-date">12 Jul 2021</p>
                        <ul class="share-up">
                           <li><a href="#">Report</a></li>
                           <li><span class="icon-thumbs-up"></span> 24</li>
                           <li><span class="icon-thumbs-down"></span> 12</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                        <figure><img src="{{asset('assets/images/img-6.png')}}"></figure>
                        <p class="Viewrepla" data-bs-toggle="collapse" href="#reviewshow1" role="button" aria-expanded="false" aria-controls="reviewshow1">&nbsp;</p>
                        <div class="collapse" id="reviewshow1">
                           <div class="Allreply">
                              <figure><img src="{{asset('assets/images/img-2.png')}}"></figure>
                              <div class="review-detail">
                                 <h6>Emily Watson</h6>
                                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                              </div>
                           </div>
                           <div class="Allreply">
                              <figure><img src="{{asset('assets/images/img-2.png')}}"></figure>
                              <div class="review-detail">
                                 <h6>Emily Watson</h6>
                                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                              </div>
                           </div>
                        </div>
                        <a href="#" class="reply">Reply</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
@include("inc/footer");
<script type="text/javascript">
    $(document).ready(function(e) {
      $(".nav-item a").removeClass("active");
      $("#community-reviews").addClass('active');
    });
 </script>