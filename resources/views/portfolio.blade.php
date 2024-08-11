<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>
<body>
    <div class="resume-wrapper">
        <section class="profile section-padding">
            <div class="container">
                <div class="picture-resume-wrapper">
                    <div class="picture-resume">
                        <span><<img src="{{ asset('images/2Y7A7443.JPG') }}" alt="Your Picture">
                            /></span>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="name-wrapper">
                    <h1>Deema <br/>Alkalfa</h1>
                </div>
                <div class="clearfix"></div>
                <div class="contact-info clearfix">
                    <ul class="list-titles">
                        <li>Call</li>
                        <li>Mail</li>
                        <li>Web</li>
                        <li>Home</li>
                    </ul>
                    <ul class="list-content">
                        <li>+963 948 841 029</li>
                        <li>deemamoneer@gmail.com</li>
                        <li><a href="#">deemakalfa.com</a></li>
                        <li>Grove street, San Andreas-Los Santos.</li>
                    </ul>
                </div>
                <div class="contact-presentation">
                    <p><span class="bold about-me">About me</span> <span class="black-text">I am an Information Technology Engineering student specialized in Artificial Intelligence. Studying in Damascus university.</span></p>
                </div>
                <div class="contact-social clearfix">
                    <ul class="list-titles">
                        <li>Instagram</li>

                        <li>Facebook</li>
                    </ul>
                    <ul class="list-content">
                        <li><a href="">https://www.instagram.com/deema_alkalfa/?hl=en</a></li>
                        <li><a href="">https://www.facebook.com/Deema.U.D.A</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="experience section-padding">
            <div class="container">
                <h3 class="experience-title">Experience</h3>
                <div class="experience-wrapper">
                    <div class="company-wrapper clearfix">
                        <div class="experience-title">Freelance</div>
                        <div class="time">Sep 2023 - Present</div>
                    </div>
                    <div class="job-wrapper clearfix">
                        <div class="experience-title">Backend Developer</div>
                        <div class="company-description">
                            <p>Participated in several academic projects, demonstrating my ability to work effectively in a team, meet deadlines and deliver high quality work.</p>

                <div class="experience-wrapper">
                    <div class="company-wrapper clearfix">
                        <div class="experience-title">Freelance</div>
                        <div class="time">2019 - Present</div>
                    </div>
                    <div class="job-wrapper clearfix">
                        <div class="experience-title">Private tutor</div>
                        <div class="company-description">
                            <p>Over 4-5 years of experience as a private tutor, teaching English, Math and physics to student up to Baccalaureate.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('js/portfolio.js') }}"></script>
</body>
</html>
