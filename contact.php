<?php include('partials-front/menu.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
  /* Container styles */
  .contact {
    background-color: #f8f8f8;
    padding: 60px 0;
  }

  /* Section header styles */
  .section-header h2 {
    font-size: 32px;
  }

  .section-header p {
    font-size: 18px;
  }

  /* Info item styles */
  .info-item {
    margin-bottom: 20px;
    opacity: 0; /* Start with opacity set to 0 */
    animation: fadeIn 1s ease-in-out forwards; /* CSS animation for fading in */
  }

  .info-item i {
    font-size: 24px;
    margin-right: 20px;
    color: #007bff; /* Blue color for icons */
  }

  .info-item h3 {
    font-size: 24px;
    margin-bottom: 10px;
  }

  .info-item p {
    font-size: 18px;
  }

  /* Keyframes for fade-in animation */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  <div class="container">
    <div class="section-header">
      <h2>Contact</h2>
      <p>Need Help? <span>Contact Us</span></p>
    </div>

    <div class="row gy-4">

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center">
          <i class="icon fa fa-map-marker-alt flex-shrink-0"></i>
          <div>
            <h3>Our Address</h3>
            <img src = "images/feumap.png">
            <p>Corporate Woods cor. South Corporate Avenues, Wood District, Filinvest City, Alabang, Muntinlupa City 1781</p>
          </div>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center">
          <i class="icon fa fa-envelope flex-shrink-0"></i>
          <div>
            <h3>Email Us</h3>
            <p>alabitessupport@gmail.com</p>
          </div>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center">
          <i class="icon fa fa-phone flex-shrink-0"></i>
          <div>
            <h3>Call Us</h3>
             <p><img src="images/R2K.jpg" style="width: 120px;">+63 947 710 2348</p>
             <p><img src="images/cia.jpg" style="width: 120px;">+63 945 500 1603</p>
             <p><img src="images/graciously.jpg" style="width: 120px;">+63 917 501 9624</p>
          </div>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-6">
        <div class="info-item d-flex align-items-center">
          <i class="icon fa fa-clock flex-shrink-0"></i>
          <div>
            <h3>Opening Hours</h3>
            <div><strong>Mon-Sat:</strong> 7AM - 5PM; <strong>Sunday:</strong> Closed</div>
          </div>
        </div>
      </div><!-- End Info Item -->

    </div>

  </div>
</section><!-- End Contact Section -->

<?php include('partials-front/footer.php'); ?>
