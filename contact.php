<?php
  include 'function.php';
  template_header("Contact");
?>
<section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/big_image_1.jpg);">
  <div class="container">
    <div class="row align-items-center site-hero-inner justify-content-center">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <h1>Contact Us</h1>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END section -->


<section class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="#" method="post">
              <div class="row">
                <div class="col-md-4 form-group">
                  <label for="name">Name</label>
                  <input type="text" id="name" class="form-control ">
                </div>
                <div class="col-md-4 form-group">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" class="form-control ">
                </div>
                <div class="col-md-4 form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control ">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="message">Write Message</label>
                  <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Send Message" class="btn btn-primary">
                </div>
              </div>
            </form>
      </div>
    </div>
  </div>
</section>
<!-- END section -->

<section class="overflow">
  <div class="container">
    <div class="row justify-content-center align-items-center">         
      <div class="col-lg-7 order-lg-3 order-1 mb-lg-0 mb-5">
        <img src="images/person_testimonial_1.jpg" alt="Image placeholder" class="img-md-fluid">
      </div>
      <div class="col-lg-1 order-lg-2"></div>
      <div class="col-lg-4 order-lg-1 order-2 mb-lg-0 mb-5">
        <blockquote class="testimonial">
          &ldquo; This Website is From Me to You All, learn and practice everything you learn here &rdquo;
        </blockquote>
    <p>&mdash; Pak Husni, Dosen ter <i class="fa fa-heart-o"></i></p>
      </div>
    </div>
  </div>
</section>
<!-- END section -->

<?php template_footer();?>