<!-- header -->
<?php include "header.php"; ?> 
<!-- slider -->
<?php include "slider.php"; ?> 
<!-- blog -->
<div class="w-100 float-left">
<section class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-1 col-md-5">
                <h2 class="mb-5">Contact Us</h2>
                <ul class="pl-0">
                    <!-- contact items -->
                    <li class="d-flex mb-5">
                        <span class="rounded-circle mr-3 align-middle bg-white text-center c-rounded d-inline text-primary">
                            <i class=" fas fa-mobile-alt"></i>
                        </span>
                        <div class="text-center text-secondary pt-1">
                            <p>+88 0123 456 789</p>
                            <p>+88 987 654 3210</p>
                        </div>
                    </li>
                    <li class="d-flex mb-5">
                        <span class="rounded-circle mr-3 align-middle bg-white text-center c-rounded d-inline text-primary">
                            <i class="far fa-envelope"></i>
                        </span>
                        <div class="text-center text-secondary pt-1">
                            <p>info@biztrox.com</p>
                            <p>biztrox@email.com</p>
                        </div>
                    </li>
                    <li class="d-flex mb-5">
                        <span class="rounded-circle mr-3 align-middle bg-white text-center c-rounded d-inline text-primary">
                            <i class="fas fa-map-marked-alt"></i>
                            </span>
                        <div class="text-center text-secondary pt-1">
                            <p>24/B Garden Street.</p>
                            <p>Northambia, Weals, UK</p>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- form -->
            <div class="col-lg-6 col-md-7">
                <div class="p-5 rounded shadow  bg-white">
                    <form action="#" class="row">
                        <div class="col-lg-12 pb-3">
                            <h3>Contact Form</h3>
                        </div>
                        <div class="col-lg-6 pb-3">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-lg-6 pb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                        </div>
                        <div class="col-lg-12 pb-3">
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="col-lg-12 pb-3">
                            <textarea class="form-control p-2" name="message" id="message" placeholder="Your Message Here..." required style="height: 150px;"></textarea>
                        </div>
                        <div class="col-lg-12 pb-3">
                            <button class="btn btn-primary" type="submit" value="send">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>




<!-- footer -->
<?php include "footer.php"; ?> 