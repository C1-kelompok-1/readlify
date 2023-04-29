<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Readify</title>

    <?php require 'layouts/styles.php'; ?>

</head>

<body>

    <main>
        <?php require 'layouts/navbar.php'; ?>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand me-lg-5 me-0" href="index.php">
                    <img src="assets/images/pod-talk-logo.png" class="logo-image img-fluid" alt="templatemo pod talk">
                </a>

                <form action="#" method="get" class="custom-form search-form flex-fill me-3" role="search">
                    <div class="input-group input-group-lg">    
                        <input name="search" type="search" class="form-control" id="search" placeholder="Search Podcast" aria-label="Search">

                        <button type="submit" class="form-control" id="submit">
                            <i class="bi-search"></i>
                        </button>
                    </div>
                </form>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="about.php">About</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="listing-page.php">Listing Page</a></li>

                                <li><a class="dropdown-item" href="detail-page.php">Detail Page</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>

                    <div class="ms-4">
                        <a href="#section_2" class="btn custom-btn custom-border-btn smoothscroll">Get started</a>
                    </div>
                </div>
            </div>
        </nav>


        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 text-center">

                        <h2 class="mb-0">About Pod</h2>
                    </div>

                </div>
            </div>
        </header>
        

        <section class="about-section section-padding" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="pb-5 mb-5">
                            <div class="section-title-wrap mb-4">
                                <h4 class="section-title">Our story</h4>
                            </div>

                            <p>Pod Talk php CSS Template is made by Bootstrap v5.2.2 framework. You are allowed to modify and use this template for your business websites.</p>

                            <p>You are not allowed to redistribute the downloadable template ZIP file on any other website without a permission. Please contact TemplateMo website for further information. Thank you.</p>

                            <img src="assets/images/medium-shot-young-people-recording-podcast.jpg" class="about-image mt-5 img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h4 class="section-title">Meet podcaters</h4>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="team-thumb bg-white shadow-lg">
                            <img src="assets/images/profile/cute-smiling-woman-outdoor-portrait.jpg" class="about-image img-fluid" alt="">

                            <div class="team-info">
                                <h4 class="mb-2">
                                    Taylor
                                    <img src="assets/images/verified.png" class="verified-image img-fluid" alt="">
                                </h4>

                                <span class="badge">Modeling</span>

                                <span class="badge">Fashion</span>
                            </div>

                            <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-pinterest"></a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="team-thumb bg-white shadow-lg">
                            <img src="assets/images/profile/handsome-asian-man-listening-music-through-headphones.jpg" class="about-image img-fluid" alt="">

                            <div class="team-info">
                                <h4 class="mb-2">
                                    William
                                    <img src="assets/images/verified.png" class="verified-image img-fluid" alt="">
                                </h4>

                                <span class="badge">Creative</span>

                                <span class="badge">Design</span>
                            </div>

                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="#" class="social-icon-link bi-twitter"></a>
                                    </li>

                                    <li class="social-icon-item">
                                        <a href="#" class="social-icon-link bi-facebook"></a>
                                    </li>

                                    <li class="social-icon-item">
                                        <a href="#" class="social-icon-link bi-pinterest"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-0">
                        <div class="team-thumb bg-white shadow-lg">
                            <img src="assets/images/profile/smart-attractive-asian-glasses-male-standing-smile-with-freshness-joyful-casual-blue-shirt-portrait-white-background.jpg" class="about-image img-fluid" alt="">

                            <div class="team-info">
                                <h4 class="mb-2">
                                    Chan
                                    <img src="assets/images/verified.png" class="verified-image img-fluid" alt="">
                                </h4>

                                <span class="badge">Education</span>
                            </div>

                            <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-linkedin"></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="team-thumb bg-white shadow-lg">
                            <img src="assets/images/profile/smiling-business-woman-with-folded-hands-against-white-wall-toothy-smile-crossed-arms.jpg" class="about-image img-fluid" alt="">

                            <div class="team-info">
                                <h4 class="mb-2">
                                    Candice
                                    <img src="assets/images/verified.png" class="verified-image img-fluid" alt="">
                                </h4>

                                <span class="badge">Storytelling</span>

                                <span class="badge">Business</span>
                            </div>

                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item">
                                        <a href="#" class="social-icon-link bi-twitter"></a>
                                    </li>

                                    <li class="social-icon-item">
                                        <a href="#" class="social-icon-link bi-facebook"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php require 'layouts/footer.php'; ?>

    <?php require 'layouts/scripts.php'; ?>

</body>

</html>