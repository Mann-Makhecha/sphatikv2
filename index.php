<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sphatik - Integrated Workflow Management</title>
        <link rel="stylesheet" href="css/index.css">
    </head>

    <body>

        <?php include 'includes/header.php'; ?>

        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Welcome to Sphatik</h1>
                <p>Your integrated workflow management system for seamless service delivery</p>

            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="container">
                <h2>Our Services</h2>
                <div class="features-grid">
                    <a href="courses.php" class="feature-card">
                        <i class="fas fa-book"></i>
                        <h3>Courses</h3>
                        <p>Access quality education and skill development courses</p>
                    </a>
                    <a href="freelance.php" class="feature-card">
                        <i class="fas fa-briefcase"></i>
                        <h3>Freelance Services</h3>
                        <p>Connect with talented freelancers or offer your services</p>
                    </a>
                    <a href="#" class="feature-card">
                        <i class="fas fa-truck"></i>
                        <h3>Delivery Partner</h3>
                        <p>Efficient delivery partner assignment system</p>
                    </a>
                    <a href="local_services.php" class="feature-card">
                        <i class="fas fa-wrench"></i>
                        <h3>Local Services</h3>
                        <p>Find reliable local service providers</p>
                    </a>

                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="benefits">
            <div class="container">
                <h2>Why Choose Sphatik?</h2>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <i class="fas fa-award"></i>
                        <h3>Quality Assurance</h3>
                        <p>All our service providers and courses are thoroughly vetted for quality</p>
                    </div>
                    <div class="benefit-card">
                        <i class="fas fa-layer-group"></i>
                        <h3>Integrated Platform</h3>
                        <p>Access all services through a single, unified platform</p>
                    </div>
                    <div class="benefit-card">
                        <i class="fas fa-chart-line"></i>
                        <h3>Support & Growth</h3>
                        <p>Dedicated support and opportunities for personal/professional growth</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Stats Section -->
        <section class="stats">
            <div class="container">
                <?php
                require_once 'includes/db.php';

                // Fetch active users count (combining both users and members tables)
                $userQuery = "SELECT 
                    (SELECT COUNT(*) FROM users WHERE status = 'active') +
                    (SELECT COUNT(*) FROM members WHERE role = 'user' AND status = 'verified' AND activity = 'active') 
                    as total_users";
                $userResult = mysqli_query($conn, $userQuery);
                $userCount = mysqli_fetch_assoc($userResult)['total_users'];

                // Fetch verified service providers
                $providerQuery = "SELECT COUNT(*) as provider_count 
                    FROM members 
                    WHERE role = 'local_service_provider' 
                    AND status = 'verified' 
                    AND activity = 'active'";
                $providerResult = mysqli_query($conn, $providerQuery);
                $providerCount = mysqli_fetch_assoc($providerResult)['provider_count'];

                // Fetch active courses
                $courseQuery = "SELECT COUNT(*) as course_count FROM courses WHERE status = 'active'";
                $courseResult = mysqli_query($conn, $courseQuery);
                $courseCount = mysqli_fetch_assoc($courseResult)['course_count'];

                // Fetch unique cities from members
                $cityQuery = "SELECT COUNT(DISTINCT SUBSTRING_INDEX(address, ',', -2)) as city_count 
                    FROM members 
                    WHERE status = 'verified' 
                    AND activity = 'active'";
                $cityResult = mysqli_query($conn, $cityQuery);
                $cityCount = mysqli_fetch_assoc($cityResult)['city_count'];
                ?>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $userCount; ?>+</span>
                        <span class="stat-label">Active Users</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $providerCount; ?>+</span>
                        <span class="stat-label">Service Providers</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $courseCount; ?>+</span>
                        <span class="stat-label">Online Courses</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $cityCount; ?>+</span>
                        <span class="stat-label">Cities Covered</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <div class="container">
                <h2>How It Works</h2>
                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h3>Create Account</h3>
                        <p>Sign up as a user, service provider, instructor, or freelancer</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h3>Choose Service</h3>
                        <p>Browse through our wide range of services and courses</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h3>Connect</h3>
                        <p>Connect with providers or enroll in courses</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h3>Get Started</h3>
                        <p>Begin your journey of learning or service delivery</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Section -->
        <section class="featured">
            <div class="container">
                <h2>Featured Offerings</h2>
                <div class="featured-grid">
                    <div class="featured-card">
                        <h3>Popular Courses</h3>
                        <ul>
                            <li>Web Development</li>
                            <li>Data Structures</li>
                            <li>Python Programming</li>
                            <li>Database Management</li>
                        </ul>
                    </div>
                    <div class="featured-card">
                        <h3>Top Services</h3>
                        <ul>
                            <li>Plumbing Services</li>
                            <li>Electrical Work</li>
                            <li>Home Cleaning</li>
                            <li>Car Repair</li>
                        </ul>
                    </div>
                    <div class="featured-card">
                        <h3>Freelance Categories</h3>
                        <ul>
                            <li>Web Design</li>
                            <li>Content Writing</li>
                            <li>Digital Marketing</li>
                            <li>Mobile Development</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta">
            <div class="container">
                <h2>Ready to Get Started?</h2>
                <p>Join our growing community of learners and service providers</p>
                <div class="cta-buttons">
                    <a href="auth/select.php" class="btn primary-btn">Sign Up Now</a>
                    <a href="pages/contact_us.php" class="btn secondary-btn">Contact Us</a>
                </div>
            </div>
        </section>

        <?php include 'includes/footer.php'; ?>

        <script>
            // Animate stats numbers
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                const target = parseInt(stat.textContent);
                let count = 0;
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps

                const updateCount = () => {
                    if (count < target) {
                        count += increment;
                        stat.textContent = Math.ceil(count) + '+';
                        requestAnimationFrame(updateCount);
                    } else {
                        stat.textContent = target + '+';
                    }
                };

                // Start animation when element is in viewport
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        updateCount();
                        observer.disconnect();
                    }
                });

                observer.observe(stat);
            });
        </script>
    </body>

</html>