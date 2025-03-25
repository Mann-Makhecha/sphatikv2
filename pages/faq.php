<title>FAQ - Sphatik</title>
<?php require_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/faq.css">

<div class="faq-container">
    <header class="faq-header">
        <h1>Frequently Asked Questions</h1>
        <p>Find answers to common questions about Sphatik's services and platform.</p>
    </header>

    <section class="faq-section">
        <h2>General Questions</h2>
        <div class="faq-item">
            <div class="faq-question">What is Sphatik?</div>
            <div class="faq-answer">
                Sphatik is an Integrated Workforce Management System that connects users with various service providers,
                instructors, and freelancers. Our platform offers course management, local services, and freelance
                opportunities all in one place.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">How do I create an account?</div>
            <div class="faq-answer">
                You can create an account by clicking the "Sign Up" button and choosing your role (User, Service
                Provider, Instructor, or Freelancer). Fill in the required information and follow the verification
                process if applicable.
            </div>
        </div>
    </section>

    <section class="faq-section">
        <h2>For Service Providers</h2>
        <div class="faq-item">
            <div class="faq-question">How can I register as a service provider?</div>
            <div class="faq-answer">
                Register as a service provider by selecting the "Service Provider" role during signup. You'll need to
                provide necessary documentation and wait for verification before you can start offering services.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">What types of services can I offer?</div>
            <div class="faq-answer">
                You can offer various local services including plumbing, electrical work, pest control, cleaning,
                delivery, and more. Make sure your service aligns with our platform's categories and guidelines.
            </div>
        </div>
    </section>

    <section class="faq-section">
        <h2>For Instructors</h2>
        <div class="faq-item">
            <div class="faq-question">How do I upload a course?</div>
            <div class="faq-answer">
                After verification, you can upload courses through your instructor dashboard. Provide course materials,
                description, and set up enrollment options. All courses undergo a review process before being published.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">What are the instructor requirements?</div>
            <div class="faq-answer">
                Instructors need to provide proof of expertise, qualifications, and teaching experience. This includes
                government ID, qualification certificates, and employment verification documents.
            </div>
        </div>
    </section>

    <section class="faq-section">
        <h2>For Freelancers</h2>
        <div class="faq-item">
            <div class="faq-question">How does the freelance system work?</div>
            <div class="faq-answer">
                Freelancers can create profiles showcasing their skills and experience. You can apply for projects, set
                your rates, and communicate with potential clients through our platform.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">How do I get paid?</div>
            <div class="faq-answer">
                Payments are processed through our secure payment system. Once a project is completed and approved, the
                payment is released to your linked account within 3-5 business days.
            </div>
        </div>
    </section>

    <div class="contact-support">
        <h3>Still have questions?</h3>
        <p>Our support team is here to help you with any queries you might have.</p>
        <a href="contact_us.php" class="support-button">Contact Support</a>
    </div>
</div>

<script>
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const item = question.parentElement;
            const isActive = item.classList.contains('active');

            // Close all other items
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                otherItem.classList.remove('active');
            });

            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
</script>

<?php require_once '../includes/footer.php'; ?>