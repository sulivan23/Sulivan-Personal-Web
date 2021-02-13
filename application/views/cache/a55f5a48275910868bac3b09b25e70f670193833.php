
<?php $__env->startSection('content'); ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>
  </head>
  <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
      <div class="hero-container" data-aos="fade-in">
        <?php $__currentLoopData = $home; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $describe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <h1><?php echo e($describe->my_name); ?></h1>
        <p>I'm <span class="typed" data-typed-items="<?php echo e($describe->description); ?>"></span></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </section><!-- End Hero -->

    <main id="main">

      <!-- ======= About Section ======= -->
      <section id="about" class="about">
        <div class="container">

          <div class="section-title">
            <h2>About</h2>
            <p><?php echo e($desc->value); ?></p>
          </div>

          <div class="row">
            <div class="col-lg-4" data-aos="fade-right">
              <img src="<?php echo e(base_url()); ?>assets/img/<?php echo e($photo_about->value); ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
              <h3><?php echo e($job->value); ?></h3>
              <p class="font-italic">
                There is a little bit about me : 
              </p>
              <div class="row">
                <div class="col-lg-12">
                  <ul>
                    <div class="row">
                    <?php $__currentLoopData = $about; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-lg-6">
                        <li><i class="icofont-rounded-right"></i> <strong><?php echo e($about->description); ?> : </strong><?php echo e($about->value); ?></li>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </ul>
                </div>
              </div>
              <p>
                <?php echo e($little_desc->value); ?>

              </p>
            </div>
          </div>

        </div>
      </section><!-- End About Section -->

      <!-- ======= Facts Section ======= -->
      <section id="facts" class="facts section-bg">
        <div class="container">

          <div class="section-title">
            <h2>Skills</h2>
            <p>I have one more years experience with Web Programming. Im focus on backend with my main languange, that is PHP.
            But im still have experience with Frontend too. Now im tried to make some feature send real time data.</p>
          </div>

          <div class="row no-gutters">

            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <div class="col-lg-2 col-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
              <?php echo $rows->font; ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>

        </div>
      </section><!-- End Facts Section -->

      <!-- ======= Resume Section ======= -->
      <section id="resume" class="resume">
        <div class="container">

          <div class="section-title">
            <h2>Resume</h2>
            <p>After graduate from Vocational High School, i work at Lintasarta. </p>
          </div>

          <div class="row">
            <div class="col-lg-6" data-aos="fade-up">

              <h3 class="resume-title">Education</h3>

              <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rows_edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
              <div class="resume-item">
                <h4><?php echo e($rows_edu->education_name); ?></h4>
                <h5><?php echo e($rows_edu->start_year. " - ". $rows_edu->finish_year); ?></h5>
                <p><em><?php echo e($rows_edu->field); ?></em></p>
                <p><?php echo e($rows_edu->description); ?></p>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <h3 class="resume-title">Internship</h3>
              <?php $__currentLoopData = $internship; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_intern): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
              <div class="resume-item pb-0">
                <h4><?php echo e($row_intern->company); ?> </h4>
                <h5><?php echo e($row_intern->start_year. " - ". $row_intern->finish_year); ?></h5>
                <p><em><?php echo e($row_intern->internship_position); ?></em></p>
                <p><?php echo e($row_intern->description); ?></p>
                <ul>
                  <?php $__currentLoopData = $detail_intern; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $var_intern): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php if($var_intern->internship_id == $row_intern->internship_id): ?> 
                      <li><?php echo e($var_intern->job_desc); ?></li>
                    <?php endif; ?> 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <h3 class="resume-title">Professional Experience</h3>
              <?php $__currentLoopData = $experience; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="resume-item">
                <h4><?php echo e($row_ex->job_position); ?> </h4>
                <h5> <?php echo e($row_ex->start_year. " - ". $row_ex->finish_year ." - ".$row_ex->year. " year ". $row_ex->month. " month"); ?></h5>
                <p><em><?php echo e($row_ex->company); ?> </em></p>
                <ul>
                  <?php $__currentLoopData = $detail_experience; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $var_ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($var_ex->experience_id == $row_ex->experience_id): ?>
                    <li><?php echo e($var_ex->job_desc); ?></li>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
                      
      </section><!-- End Resume Section -->

      <!-- ======= Portfolio Section ======= -->
      <section id="portfolio" class="portfolio section-bg">
        <div class="container">

          <div class="section-title">
            <h2>Portfolio</h2>
            <p>Many applications that i have made. like Library System with QR Code Scanning, E-commerce, CRUD Dashboard, Membership, and many more...</p>
          </div>


          <div class="row" data-aos="fade-up" data-aos-delay="100">

            <?php $__currentLoopData = $portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_port): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-lg-4">
                  <div class="card shadow">
                      <div class="card-header p-0">
                        <img src="<?php echo e(base_url()); ?>assets/img/portfolio/<?php echo e($row_port->walpaper); ?>" class="img-fluid w-100" style="height:280px">
                      </div>
                      <div class="card-body">
                      <a href="<?php echo e(base_url()); ?>home/portfolio_details/<<?php echo e($row_port->walpaper); ?>"><h4 class="mb-4 text-primary"><?php echo e($row_port->application_name); ?></h4></a>
                        <div class="row">
                          <div class="col-lg-12">
                              <?php if(strlen($row_port->description) > 100): ?>
                                  <?php echo e(substr($row_port->description,0,100)); ?>

                              <?php else: ?> 
                                  <?php echo $row_port->description; ?>

                              <?php endif; ?> 
                          </div>
                      </div>
                  </div>
                  <div class="card-footer bg-white">
                        <i class="devicon-php-plain colored" style="font-size:50px;"></i>
                        <i class="devicon-mysql-plain-wordmark colored" style="font-size:50px;"></i>
                      </span>
                  </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="text-center my-4" data-aos="fade-up">
            <button class="btn btn-primary text-white" id="view">View All</button>
        </div>
      </section><!-- End Portfolio Section -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <h2>Contact</h2>
            <p>Im feel free to discuss. Please don't hestiate to contact.</p>
          </div>

          <div class="row" data-aos="fade-in">

            <div class="col-lg-5 d-flex align-items-stretch">
              <div class="info">
                <div class="address">
                  <i class="icofont-google-map"></i>
                  <h4>Location:</h4>
                  <p><<?php echo e($location->value); ?></p>
                </div>

                <div class="email">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p><?php echo e($email->value); ?> </p>
                </div>

                <div class="phone">
                  <i class="icofont-phone"></i>
                  <h4>Call:</h4>
                  <p><?php echo e($phone->value); ?></p>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5780160896156!2d107.0085279351456!3d-6.187183700008511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6989674621932b%3A0x10189427ea23fbf4!2sJl.%20Ujung%20Harapan%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1609431448729!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
              </div>

            </div>
                  
            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
              <form id="mail_form" method="post" role="form" class="php-email-form">
              <div class="alert" style="display:none;"></div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your name">
                    <div class="validate"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name">Your Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                    <div class="validate"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <input id="url" value="<?php echo e(base_url()); ?>" type="hidden">
                  <label for="name">Message</label>
                  <textarea class="form-control" name="message" rows="10" placeholder="Message"></textarea>
                  <div class="validate"></div>
                </div>
                  <input class="form-control" type="hidden" name="<?php echo e($token_name); ?>" value="<?php echo e($token); ?>" rows="10">
                <div class="text-center"><button type="submit" id="send_msg">Send Message</button></div>
              </form>
            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="container">
        <div class="copyright">
          &copy; <strong><span><?php echo e(date('Y')); ?></span> All Rights Reserved</strong>
        </div>
        <div class="credits">
          Modified By <a href="irvansulistio.com">Irvan Sulistio</a>
        </div>
      </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?php echo e(base_url()); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/counterup/counterup.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/venobox/venobox.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/typed.js/typed.min.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/vendor/aos/aos.js"></script>
    <script src="//cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo e(base_url()); ?>assets/js/main.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/js/particle-js/particles.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/js/particle-js/app.js"></script>
    <!-- Tambahan JS -->
    <script src="<?php echo e(base_url()); ?>assets/vendor/pnotify/core/dist/pnotify.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/js/serialize.js"></script>
    <script src="<?php echo e(base_url()); ?>assets/js/Sulivan.js"></script>
  </body>
  </html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('my_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/akukamu/application/views/indexprofile.blade.php ENDPATH**/ ?>