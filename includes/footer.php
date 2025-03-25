<?php
require_once 'global.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/css/footer.css">
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-section">
                <h3>Sphatik</h3>
                <p>Integrated workflow management system for Indian citizens.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?= BASE_URL ?>pages/about_us.php">About Us</a></li>
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="freelance.php">Freelance Services</a></li>
                    <li><a href="local_servies.php">Local Services</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="<?= BASE_URL ?>pages/contact_us.php">Contact Us</a></li>
                    <li><a href="<?= BASE_URL ?>pages/faq.php">FAQ</a></li>
                    <li><a href="<?= BASE_URL ?>pages/privacy.php">Privacy Policy</a></li>
                    <li><a href="<?= BASE_URL ?>pages/terms_of_service.php">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Connect With Us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Sphatik. All rights reserved.</p>
        </div>
    </div>
</footer>