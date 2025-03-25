<title>About Us - Sphatik</title>
<?php require_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/about.css">

<div class="about-container">
    <!-- Hero Section -->
    <section class="hero-section">
        <h1>About Sphatik</h1>
        <p class="tagline">Integrated Workforce Management System</p>
        <p class="subtitle">Derived from crystal vibrations, Sphatik represents clarity and harmony in workforce
            management,
            bringing together diverse talents and services under one unified platform.</p>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <?php
        require_once '../includes/db.php';

        // Fetch active users count (combining both users and members tables)
        $userQuery = "SELECT 
            (SELECT COUNT(*) FROM users WHERE status = 'active') +
            (SELECT COUNT(*) FROM members WHERE activity = 'active' AND role = 'user') as total_users";
        $userResult = mysqli_query($conn, $userQuery);
        $userCount = mysqli_fetch_assoc($userResult)['total_users'];

        // Fetch service providers count
        $providerQuery = "SELECT COUNT(*) as provider_count FROM members 
            WHERE role = 'local_service_provider' 
            AND status = 'verified' 
            AND activity = 'active'";
        $providerResult = mysqli_query($conn, $providerQuery);
        $providerCount = mysqli_fetch_assoc($providerResult)['provider_count'];

        // Fetch active courses count
        $courseQuery = "SELECT COUNT(*) as course_count FROM courses WHERE status = 'active'";
        $courseResult = mysqli_query($conn, $courseQuery);
        $courseCount = mysqli_fetch_assoc($courseResult)['course_count'];

        // Fetch verified instructors count
        $instructorQuery = "SELECT COUNT(*) as instructor_count FROM members 
            WHERE role = 'instructor' 
            AND status = 'verified' 
            AND activity = 'active'";
        $instructorResult = mysqli_query($conn, $instructorQuery);
        $instructorCount = mysqli_fetch_assoc($instructorResult)['instructor_count'];
        ?>

        <div class="stat-card">
            <div class="stat-number"><?php echo number_format($userCount); ?>+</div>
            <div class="stat-label">Active Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo number_format($providerCount); ?>+</div>
            <div class="stat-label">Service Providers</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo number_format($courseCount); ?>+</div>
            <div class="stat-label">Online Courses</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo number_format($instructorCount); ?>+</div>
            <div class="stat-label">Expert Instructors</div>
        </div>
    </section>

    <!-- Our Goal Section -->
    <section class="goal-section">
        <h2>Our Vision</h2>
        <p>Sphatik aims to revolutionize workforce management by creating a centralized platform that connects various
            service providers, instructors, and freelancers with users seeking their expertise. We believe in creating
            opportunities for skilled professionals while making services easily accessible to everyone.</p>
        <p>Our platform is built on the principles of transparency, quality, and reliability, ensuring that both service
            providers and users benefit from a seamless experience.</p>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <h2>What We Offer</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <h3>Course Management</h3>
                <p>Instructors can upload and manage courses, while users can enroll and learn at their own pace. Our
                    platform supports various formats including video lectures, documents, and interactive assessments.
                </p>
            </div>
            <div class="feature-card">
                <h3>Local Services</h3>
                <p>Connect with verified local service providers for daily home services including plumbing, pest
                    control, electrical work, and more. All service providers undergo thorough verification for your
                    safety.</p>
            </div>
            <div class="feature-card">
                <h3>Freelance Platform</h3>
                <p>A marketplace for freelancers to showcase their skills and connect with potential employers. Features
                    include portfolio management, secure payment system, and rating mechanism.</p>
            </div>
        </div>
    </section>

    <!-- Additional Features -->
    <section class="features-section">
        <h2>Why Choose Sphatik</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <h3>Verified Professionals</h3>
                <p>All service providers undergo strict verification process ensuring quality and reliability.</p>
            </div>
            <div class="feature-card">
                <h3>Secure Payments</h3>
                <p>Built-in secure payment gateway with escrow service for freelance projects.</p>
            </div>
            <div class="feature-card">
                <h3>24/7 Support</h3>
                <p>Round-the-clock customer support to assist both service providers and users.</p>
            </div>
        </div>
    </section>

    <!-- Team Section (Existing team section remains the same) -->
    <section class="team-section">
        <h2>Meet Our Team</h2>
        <div class="team-grid">
            <div class="team-member">
                <h3>Samkit Jain</h3>
                <p>Backend Development & Responsiveness</p>
            </div>
            <div class="team-member">
                <h3>Mann Makhecha</h3>
                <p>Frontend Development & Database Management</p>
            </div>
            <div class="team-member">
                <h3>Dhiraj Jagwani</h3>
                <p>Typography</p>
            </div>
            <div class="team-member">
                <h3>Chirag Gupta</h3>
                <p>Color Palette & UI Elements</p>
            </div>
            <div class="team-member">
                <h3>Krish Jain</h3>
                <p>Documentation & Information</p>
            </div>
            <div class="team-member">
                <h3>Het Malvaniya</h3>
                <p>Communication Support & File Management</p>
            </div>
            <div class="team-member">
                <h3>Shaan Mansuri</h3>
                <p>Code Optimization</p>
            </div>
        </div>
    </section>
</div>

<?php require_once '../includes/footer.php'; ?>