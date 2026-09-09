<?php
/** TEMPLATE NAME: Footer */
?>

<div class="footer">
 <div class="container">
  <div class="footer-content">
  <div class="col-left">
   <h2>Alex M Web Design</h2>
   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
  </div>
  <div class="col-middle">
   <h2>Site</h2>
   <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Contact</a></li>
   </ul>
  </div>
  <div class="col-right">
   <h2>Contact</h2>
   <p>Email: info@alexmwebdesign.com</p>
   <p>Phone: 123-456-7890</p>
   <p>Address: 123 Main St, Anytown, USA</p>
 </div>
</div>
 <hr>
 <div class="copyright">
  <h3>Copyright &copy; <?php echo date('Y'); ?> Alex M Web Design. All rights reserved.</h3>
 </div>
</div>

<?php wp_footer(); ?>