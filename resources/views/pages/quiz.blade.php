<!doctype html>
<html lang="en">

<head>
    <title>Utazás Teszt - Milyen úti cél illik hozzád?</title>
    <link rel="icon" type="image/png" href="/oldal/images/ikon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/oldal/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/oldal/css/bootstrap.min.css">
    <link rel="stylesheet" href="/oldal/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/oldal/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/oldal/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/oldal/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/oldal/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="/oldal/css/aos.css">
    <link rel="stylesheet" href="/oldal/css/style.css">

    <style>
        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .quiz-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        
        .question-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        
        .question-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #495057;
        }
        
        .answer-option {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            background: white;
            border: 1px solid #ced4da;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .answer-option:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }
        
        .answer-option input[type="radio"] {
            margin-right: 10px;
        }
        
        .submit-btn {
            background: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 30px auto;
            transition: background 0.3s ease;
        }
        
        .submit-btn:hover {
            background: #0056b3;
        }
        
        .progress-bar {
            height: 30px;
            background: #e9ecef;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #007bff, #28a745);
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap" id="home-section">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar site-navbar-target" role="banner">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-3 ">
                        <div class="site-logo">
                            <a href="/" class="font-weight-bold">
                                <img src="/oldal/images/logo.png" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="col-9  text-right">
                        <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>
                        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav ml-auto ">
                                <li><a href="/" class="nav-link">Kezdőlap</a></li>
                                <li><a href="/about" class="nav-link">Rólunk</a></li>
                                <li><a href="/trips" class="nav-link">Utazások</a></li>
                                <li><a href="/contact" class="nav-link">Kapcsolat</a></li>
                                <li class="active"><a href="/quiz" class="nav-link">Teszt</a></li>
                                @if(auth()->check())
                                    <li><a href="{{ route('profile') }}" class="nav-link">Profil</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="nav-link p-0" style="display:inline; background:none; border:0; padding:0; font: inherit; color: inherit; cursor:pointer;">Kijelentkezés</button>
                                        </form>
                                    </li>
                                @else
                                    <li><a href="{{ url('/bejelentkezes') }}" class="nav-link">Bejelentkezés</a></li>
                                    <li><a href="{{ url('/regisztracio') }}" class="nav-link">Regisztráció</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>  
                </div>
            </div>
        </header>

        <div class="ftco-blocks-cover-1">
            <div class="site-section-cover overlay" style="background-image: url('/oldal/images/banner.png')">
                <div class="container">
                    <div class="row align-items-center justify-content-center text-center">
                        <div class="col-md-5" data-aos="fade-up">
                            <h1 class="mb-3 text-white">Utazás Teszt</h1>
                            <p>Tudd meg, milyen úti cél illik a legjobban személyiségedhez!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section py-5">
            <div class="container">
                <div class="quiz-container">
                    <h2 class="quiz-title">Milyen típusú utazó vagy?</h2>
                    
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%">
                            <span class="progress-text">0%</span>
                        </div>
                    </div>

                    <form action="{{ route('quiz.submit') }}" method="POST" id="quizForm">
                        @csrf
                        
                        <div class="question-card">
                            <h3 class="question-title">1. Milyen típusú úticélt preferálsz?</h3>
                            <label class="answer-option">
                                <input type="radio" name="adventurous" value="5" required>
                                <span>Kalandos, extrém élmények</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="adventurous" value="3">
                                <span>Mérsékelt kalandok</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="adventurous" value="1">
                                <span>Hagyományos, biztonságos</span>
                            </label>
                        </div>

                        <div class="question-card">
                            <h3 class="question-title">2. Mennyire fontos számodra a romantika?</h3>
                            <label class="answer-option">
                                <input type="radio" name="romantic" value="5" required>
                                <span>Nagyon fontos, romantikus úti célokat keresek</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="romantic" value="3">
                                <span>Jó, ha van néhány romantikus elem</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="romantic" value="1">
                                <span>Nem fontos, inkább más jellegű</span>
                            </label>
                        </div>

                        <div class="question-card">
                            <h3 class="question-title">3. Mennyire érdekel a kultúra és történelem?</h3>
                            <label class="answer-option">
                                <input type="radio" name="cultural" value="5" required>
                                <span>Nagyon, múzeumok, történelmi helyszínek</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="cultural" value="3">
                                <span>Mérsékelten, néhány látogatás</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="cultural" value="1">
                                <span>Nem igazán, inkább pihenés</span>
                            </label>
                        </div>

                        <div class="question-card">
                            <h3 class="question-title">4. Milyen tempójú legyen az utazás?</h3>
                            <label class="answer-option">
                                <input type="radio" name="relaxed" value="5" required>
                                <span>Lassú, relaxáló, sok szabadidő</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="relaxed" value="3">
                                <span>Kiegyensúlyozott, pihenés és programok</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="relaxed" value="1">
                                <span>Tele programokkal, aktív</span>
                            </label>
                        </div>

                        <div class="question-card">
                            <h3 class="question-title">5. Mennyire vonzanak a történelmi helyszínek?</h3>
                            <label class="answer-option">
                                <input type="radio" name="historic" value="5" required>
                                <span>Nagyon, szeretem a történelmet</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="historic" value="3">
                                <span>Mérsékelten érdekel</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="historic" value="1">
                                <span>Nem igazán vonzódnak</span>
                            </label>
                        </div>

                        <div class="question-card">
                            <h3 class="question-title">6. Mennyire kedveled a modern városokat?</h3>
                            <label class="answer-option">
                                <input type="radio" name="modern" value="5" required>
                                <span>Szeretem a modern, pezsgő városokat</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="modern" value="3">
                                <span>Jó, ha van modern elem is</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="modern" value="1">
                                <span>Inkább hagyományos helyszínek</span>
                            </label>
                        </div>

                        <div class="question-card">
                            <h3 class="question-title">7. Mennyire érdekel a művészet és design?</h3>
                            <label class="answer-option">
                                <input type="radio" name="artistic" value="5" required>
                                <span>Nagyon, galériák, művészeti helyek</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="artistic" value="3">
                                <span>Mérsékelten érdekel</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="artistic" value="1">
                                <span>Nem igazán vonz</span>
                            </label>
                        </div>

                        <div class="question-card">
                            <h3 class="question-title">8. Mennyire kedveled a tengerparti nyaralást?</h3>
                            <label class="answer-option">
                                <input type="radio" name="beach" value="5" required>
                                <span>Nagyon, szeretem a tengerpartot</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="beach" value="3">
                                <span>Jó, ha van tengerparti lehetőség</span>
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="beach" value="1">
                                <span>Nem igazán kedvelem</span>
                            </label>
                        </div>

                        <button type="submit" class="submit-btn">Eredmények megtekintése</button>
                    </form>
                </div>
            </div>
        </div>

        @include('partials.footer')

    </div>

    <script src="/oldal/js/jquery-3.3.1.min.js"></script>
    <script src="/oldal/js/jquery-migrate-3.0.0.js"></script>
    <script src="/oldal/js/popper.min.js"></script>
    <script src="/oldal/js/bootstrap.min.js"></script>
    <script src="/oldal/js/owl.carousel.min.js"></script>
    <script src="/oldal/js/jquery.sticky.js"></script>
    <script src="/oldal/js/jquery.waypoints.min.js"></script>
    <script src="/oldal/js/jquery.animateNumber.min.js"></script>
    <script src="/oldal/js/jquery.fancybox.min.js"></script>
    <script src="/oldal/js/jquery.stellar.min.js"></script>
    <script src="/oldal/js/jquery.easing.1.3.js"></script>
    <script src="/oldal/js/bootstrap-datepicker.min.js"></script>
    <script src="/oldal/js/isotope.pkgd.min.js"></script>
    <script src="/oldal/js/aos.js"></script>
    <script src="/oldal/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('quizForm');
            const progressBar = document.querySelector('.progress-fill');
            const progressText = document.querySelector('.progress-text');
            const questionCards = document.querySelectorAll('.question-card');
            const totalQuestions = questionCards.length;

            function updateProgress() {
                const answered = form.querySelectorAll('input[type="radio"]:checked').length;
                const percentage = Math.round((answered / totalQuestions) * 100);
                progressBar.style.width = percentage + '%';
                progressText.textContent = percentage + '%';
            }

            // Add event listeners to all radio buttons
            form.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateProgress);
            });

            // Initial progress update
            updateProgress();
        });
    </script>

</body>

</html>
