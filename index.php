<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Hyrespree | Trusted by Startups and Enterprises</title>
  
  <meta name="description" content="Discover why Hyrespree is trusted by startups and enterprises. Read real stories and testimonials from industry leaders about the power of our advanced technology.">
  
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <nav class="nav">

    <div id="logo">
      <p>Logo</p>
    </div>


    <!-- Menu -->
    <div id="compo">
      <p>HyreSpree</p>
      <p>Our Story</p>
      <p>Services</p>
      <p>Contact Us</p>
      <p>FAQ</p>
    </div>

    <!-- Buttons -->
    <div class="but">
      <button class="btn">Contact Us</button>
    </div>

  </nav>

  <main>

    <div class="hero">
      <h1 id="hero1">Hassle-Free Hiring Experience</h2>
        <br>
        <br>
      <p id="text">
        <span>Experience a hassle-free talent acquisition process with HyreSpree. With us, you can break the barriers</span>
        <span>and blur those hassles of a hiring marketplace. We understand the challenges inherent in the hiring</span>
        <span>process. we as a company have more than two decades of experience in human resource management</span>
        <span>and hiring services. Our intensive and standardized assessment processes will assist you in finding the</span>
        <span>right candidate. We have a great deal of experience hiring for India, Singapore, and Australia.</span>
      </p>
    </div>

<section class="talent-section">
  <h2>Why Choose HyreSpree</h2>

  <div class="slider">
    <div class="slide-track">

      <div class="card">Developing Talent into Capabilities</div>
      <div class="card">Hassle-Free Hiring Experience</div>
      <div class="card">Industry-Focused Hiring Research</div>
      <div class="card">Advanced Assessment Tools</div>
      <div class="card">Cutting-Edge Hiring Strategies</div>
      <div class="card">Right Talent from the Best Pool</div>

      <!-- Duplicate cards for smooth infinite scroll -->
      <div class="card">Developing Talent into Capabilities</div>
      <div class="card">Hassle-Free Hiring Experience</div>
      <div class="card">Industry-Focused Hiring Research</div>
      <div class="card">Advanced Assessment Tools</div>
      <div class="card">Cutting-Edge Hiring Strategies</div>
      <div class="card">Right Talent from the Best Pool</div>

    </div>
  </div>
</section>


<div class="section-container">
  <div class="left-content">
    <ul>
    <li>We have an in-depth understanding of your company’s work culture and the opportunities for advancement available for successful hires, and we will represent you when speaking with prospective candidates.</li>
    <li>We leverage social media and other network-building platforms, as well as a variety of other media, to source qualified candidates.</li>
    <li>We have built a strong network and have a stable internal database of prospective candidates over the last decade, which includes not only active job seekers from the top brand portals but also passive candidates.</li>
  </ul>
  </div>
  <div class="right-content">
    <img src="../Hyrespree-startup-website\assets\26081-1-scaled-removebg-preview.png" alt="img">
  </div>
</div>

<section class="services-section">
  <h2 class="section-title">Our Services</h2>

  <div class="services-container">

    <div class="service-card">
      <h3>Cost-Effective Recruiter Marketplace</h3>
      <p>
        Connect with verified recruiters at affordable costs.
        Hire faster without compromising on quality.
      </p>
      <a href="#" class="service-link">More →</a>
    </div>

    <div class="service-card">
      <h3>Jobs Across Multiple Domains</h3>
      <p>
        Passionate to work and learn in different domains?
        HyreSpree is a one-stop place for both full-time and
        contract-based job seekers.
      </p>
      <a href="#" class="service-link">More →</a>
    </div>

    <div class="service-card">
      <h3>End-to-End HRM & Talent Acquisition</h3>
      <p>
        Complete talent acquisition solutions under one roof.
        From sourcing to hiring and HR consulting.
      </p>
      <a href="#" class="service-link">More →</a>
    </div>

  </div>
</section>
<div class="contact-section">

  <div class="left-sec">
      <h1 id="hero1" >Connect with Our Experts</h1><br><br>
      <p>All-in-one hiring platform. Easy-to-use tools for recruiters, job seekers, contract hiring, and end-to-end talent acquisition. </p>
      <h6>Complete control.</h6>
      <p>Complete control. Manage jobs, candidates, recruiters, and hiring workflows from one powerful dashboard.</p>
      <h6>Future-ready.</h6>
      <p>Future-ready. Built to adapt to evolving hiring trends and modern workforce needs.</p>
      <h6>Enterprise-ready.</h6>
      <p>Enterprise-ready. Scalable, secure, and reliable for startups, enterprises, and growing teams.</p>
  </div>

  <div class="right-sec">
     <div class="form-wrapper">
  <form action="submit_form.php" method="POST" class="contact-form">

  <input type="text" name="first_name" placeholder="First Name*" required>
  <input type="text" name="last_name" placeholder="Last Name*" required>

  <input type="email" name="email" placeholder="Email*" required>
  <input type="tel" name="phone" placeholder="Phone Number*" required>

  <input type="text" name="job_title" placeholder="Job Title*" required>
  <input type="text" name="company" placeholder="Company Name*" required>

  <textarea name="message" placeholder="How can we help?*" required></textarea>

  <button type="submit">Submit</button>
</form>

</div>
  </div>
</div>


<section class="cta-wrapper">
    <div class="cta-card">
        <h2 class="cta-heading">Book Appoitment with Our <br> Expert Recruter</h2>
        
        <p class="cta-subtext">
            Get conversational intelligence with transcription and understanding on <br> 
            the world's best speech AI platform.
        </p>

        <div class="cta-buttons">

            <a href="#" class="btn-demo">Get A Demo</a>
        </div>
    </div>
</section>


<section class="testimonials">
  <h2>Trusted by Employees Reviews</h2>
  <p class="subtitle">Discover the power of our product through real stories.</p>

  <div class="marquee">
    <div class="marquee-track">
      <?php
      require_once('db.php');
      $query = "SELECT * FROM testimonials ORDER BY id DESC";
      $result = mysqli_query($conn, $query);
      $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

      // Function to display formatted cards
      function displayCards($data) {
          foreach ($data as $row) {
              echo '
              <div class="card">
                <div class="card-content">
                    <p class="review-text">"' . htmlspecialchars($row['review']) . '"</p>
                </div>
                <div class="author">
                  <span class="author-name">' . htmlspecialchars($row['name']) . '</span>
                  <small class="author-role">' . htmlspecialchars($row['role']) . '</small>
                </div>
              </div>';
          }
      }

      if (!empty($reviews)) {
          displayCards($reviews);
          // Only duplicate if there are enough reviews to fill the screen
          // This prevents the "2 cards" issue when you only have 1 review
          if (count($reviews) > 1) {
              displayCards($reviews);
          }
      } else {
          echo "<p class='no-data'>No reviews available at the moment.</p>";
      }
      ?>
    </div>
  </div>
</section>

<section class="faq-container">
  <div class="faq-header">
    <span class="faq-badge">FAQs</span>
    <h2>Frequently Asked Questions</h2>
    <p>Everything you need to know about hiring & talent with HyreSpree</p>
  </div>

  <div class="faq-list">
    <?php
    require_once('db.php');
    $sql = "SELECT * FROM faqs ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0):
      while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="faq-card">
          <button class="faq-question" aria-expanded="false">
            <span><?= htmlspecialchars($row['question']); ?></span>
            <svg class="faq-icon" width="18" height="18" viewBox="0 0 24 24">
              <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
          <div class="faq-answer">
            <p><?= htmlspecialchars($row['answer']); ?></p>
          </div>
        </div>
      <?php endwhile;
    else: ?>
      <p class="faq-empty">No questions available yet.</p>
    <?php endif; ?>
  </div>
</section>



  </main>


  <footer>


    <footer class="footer-container">
    <div class="footer-content">
        <div class="footer-col">
            <img src="logo.png" alt="HyreSpree Logo" class="footer-logo">
            <p>HyreSpree is a leading recruitment platform connecting top talent with industry-leading organizations through innovative staffing solutions.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
            </div>
        </div>

        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Jobs</a></li>
                <li><a href="#">Candidates</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Our Services</h3>
            <ul>
                <li><a href="#">Permanent Staffing</a></li>
                <li><a href="#">Contract Hiring</a></li>
                <li><a href="#">Executive Search</a></li>
                <li><a href="#">RPO Services</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Contact Us</h3>
            <p><i class="fas fa-map-marker-alt"></i> 123 Business Way, Tech Park, India</p>
            <p><i class="fas fa-envelope"></i> info@hyrespree.com</p>
            <p><i class="fas fa-phone"></i> +91 000 000 0000</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 HyreSpree. All Rights Reserved.</p>
        <div class="footer-legal">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
        </div>
    </div>
</footer>

  </footer>

  <script>
 
  document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
      const card = button.parentElement;
      const open = document.querySelector('.faq-card.active');

      if (open && open !== card) {
        open.classList.remove('active');
        open.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
      }

      card.classList.toggle('active');
      button.setAttribute(
        'aria-expanded',
        card.classList.contains('active')
      );
    });
  });

  </script>
</body>
</html>
