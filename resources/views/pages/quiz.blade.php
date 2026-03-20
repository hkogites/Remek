<!doctype html>
<html lang="hu">
<head>
    <title>Kvíz - SmartVoyager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="/oldal/images/logokicsi.png">
    
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

        @include('components.navbar')

        <style>
            .quiz-container {
                min-height: 100vh;
                padding: 80px 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .quiz-card {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                overflow: hidden;
            }
            .quiz-image {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
            .quiz-content {
                padding: 40px;
            }
            .quiz-question {
                font-size: 24px;
                font-weight: 700;
                color: #333;
                margin-bottom: 30px;
                text-align: center;
            }
            .quiz-options {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .quiz-option {
                background: white;
                border: 2px solid #e0e0e0;
                border-radius: 12px;
                padding: 18px 24px;
                font-size: 16px;
                color: #333;
                cursor: pointer;
                transition: all 0.3s ease;
                text-align: center;
                font-weight: 500;
            }
            .quiz-option:hover {
                border-color: #667eea;
                background: #f8f9ff;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
            }
            .quiz-option.selected {
                border-color: #667eea;
                background: #667eea;
                color: white;
            }
            .quiz-progress {
                text-align: center;
                margin-top: 30px;
                color: #666;
                font-size: 14px;
            }
            .quiz-navigation {
                display: flex;
                justify-content: space-between;
                margin-top: 30px;
                gap: 15px;
            }
            .quiz-btn {
                flex: 1;
                padding: 14px 28px;
                border: none;
                border-radius: 10px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .quiz-btn-primary {
                background: #667eea;
                color: white;
            }
            .quiz-btn-primary:hover:not(:disabled) {
                background: #5568d3;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            }
            .quiz-btn-secondary {
                background: #e0e0e0;
                color: #666;
            }
            .quiz-btn-secondary:hover:not(:disabled) {
                background: #d0d0d0;
            }
            .quiz-btn:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
            .question-slide {
                display: none;
            }
            .question-slide.active {
                display: block;
                animation: fadeIn 0.4s ease;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>

        <div class="quiz-container">
            <div class="container">
                <div class="quiz-card">
                    <form id="quizForm" method="POST" action="{{ route('quiz.submit') }}">
                        @csrf
                        
                        <!-- Kérdés 1 -->
                        <div class="question-slide active" data-question="1">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen típusú nyaralást preferálsz?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Kalandos, természetközeli</div>
                                    <div class="quiz-option" data-answer="2">Tengerparti pihenés</div>
                                    <div class="quiz-option" data-answer="3">Városlátogatás, kultúra</div>
                                    <div class="quiz-option" data-answer="4">Történelmi helyszínek</div>
                                </div>
                                <input type="hidden" name="answers[1]" class="answer-input">
                                <div class="quiz-progress">1 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 2 -->
                        <div class="question-slide" data-question="2">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Melyik évszakban szeretsz utazni?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Tél - hó és hideg</div>
                                    <div class="quiz-option" data-answer="2">Tavasz - mérsékelt időjárás</div>
                                    <div class="quiz-option" data-answer="3">Nyár - meleg és napsütés</div>
                                    <div class="quiz-option" data-answer="4">Ősz - hűvös, színes</div>
                                </div>
                                <input type="hidden" name="answers[2]" class="answer-input">
                                <div class="quiz-progress">2 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 3 -->
                        <div class="question-slide" data-question="3">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen hosszú utazást tervezel?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Hétvége (2-3 nap)</div>
                                    <div class="quiz-option" data-answer="2">Rövid (4-6 nap)</div>
                                    <div class="quiz-option" data-answer="3">Közepes (7-10 nap)</div>
                                    <div class="quiz-option" data-answer="4">Hosszú (10+ nap)</div>
                                </div>
                                <input type="hidden" name="answers[3]" class="answer-input">
                                <div class="quiz-progress">3 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 4 -->
                        <div class="question-slide" data-question="4">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Mi a költségvetésed?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Takarékos (50-100k Ft)</div>
                                    <div class="quiz-option" data-answer="2">Közepes (100-200k Ft)</div>
                                    <div class="quiz-option" data-answer="3">Komfortos (200-300k Ft)</div>
                                    <div class="quiz-option" data-answer="4">Prémium (300k+ Ft)</div>
                                </div>
                                <input type="hidden" name="answers[4]" class="answer-input">
                                <div class="quiz-progress">4 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 5 -->
                        <div class="question-slide" data-question="5">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen ételt preferálsz?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Mediterrán konyha</div>
                                    <div class="quiz-option" data-answer="2">Halételek, tenger gyümölcsei</div>
                                    <div class="quiz-option" data-answer="3">Fűszeres, egzotikus</div>
                                    <div class="quiz-option" data-answer="4">Változatos, nemzetközi</div>
                                </div>
                                <input type="hidden" name="answers[5]" class="answer-input">
                                <div class="quiz-progress">5 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 6 -->
                        <div class="question-slide" data-question="6">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen programokat szeretsz?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Múzeumok, galériák</div>
                                    <div class="quiz-option" data-answer="2">Túrázás, természetjárás</div>
                                    <div class="quiz-option" data-answer="3">Strandolás, napozás</div>
                                    <div class="quiz-option" data-answer="4">Vásárlás, gasztronómia</div>
                                </div>
                                <input type="hidden" name="answers[6]" class="answer-input">
                                <div class="quiz-progress">6 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 7 -->
                        <div class="question-slide" data-question="7">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen éghajlatot kedvelsz?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Hideg, havas</div>
                                    <div class="quiz-option" data-answer="2">Mérsékelt, hűvös</div>
                                    <div class="quiz-option" data-answer="3">Meleg, napos</div>
                                    <div class="quiz-option" data-answer="4">Változékony</div>
                                </div>
                                <input type="hidden" name="answers[7]" class="answer-input">
                                <div class="quiz-progress">7 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 8 -->
                        <div class="question-slide" data-question="8">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Kivel utaznál?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Egyedül</div>
                                    <div class="quiz-option" data-answer="2">Párral</div>
                                    <div class="quiz-option" data-answer="3">Családdal</div>
                                    <div class="quiz-option" data-answer="4">Barátokkal</div>
                                </div>
                                <input type="hidden" name="answers[8]" class="answer-input">
                                <div class="quiz-progress">8 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 9 -->
                        <div class="question-slide" data-question="9">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen szállást preferálsz?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Hostel, egyszerű</div>
                                    <div class="quiz-option" data-answer="2">Boutique hotel</div>
                                    <div class="quiz-option" data-answer="3">Resort, all-inclusive</div>
                                    <div class="quiz-option" data-answer="4">Apartman, önellátó</div>
                                </div>
                                <input type="hidden" name="answers[9]" class="answer-input">
                                <div class="quiz-progress">9 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 10 -->
                        <div class="question-slide" data-question="10">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen tevékenységet szeretsz?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Extrém sportok</div>
                                    <div class="quiz-option" data-answer="2">Vízi sportok</div>
                                    <div class="quiz-option" data-answer="3">Kulturális programok</div>
                                    <div class="quiz-option" data-answer="4">Fotózás, sétálás</div>
                                </div>
                                <input type="hidden" name="answers[10]" class="answer-input">
                                <div class="quiz-progress">10 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 11 -->
                        <div class="question-slide" data-question="11">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen közlekedést preferálsz?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Autóbérlés, saját tempó</div>
                                    <div class="quiz-option" data-answer="2">Tömegközlekedés</div>
                                    <div class="quiz-option" data-answer="3">Szervezett túrák</div>
                                    <div class="quiz-option" data-answer="4">Gyalogosan, biciklivel</div>
                                </div>
                                <input type="hidden" name="answers[11]" class="answer-input">
                                <div class="quiz-progress">11 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 12 -->
                        <div class="question-slide" data-question="12">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Mennyire szereted a tömeget?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Kerülöm, csendet keresek</div>
                                    <div class="quiz-option" data-answer="2">Nem zavar, de nem keresem</div>
                                    <div class="quiz-option" data-answer="3">Szeretem a nyüzsgést</div>
                                    <div class="quiz-option" data-answer="4">Imádom a fesztiválokat</div>
                                </div>
                                <input type="hidden" name="answers[12]" class="answer-input">
                                <div class="quiz-progress">12 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 13 -->
                        <div class="question-slide" data-question="13">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen fotókat szeretsz készíteni?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Természet, tájképek</div>
                                    <div class="quiz-option" data-answer="2">Építészet, városképek</div>
                                    <div class="quiz-option" data-answer="3">Tengerpart, naplemente</div>
                                    <div class="quiz-option" data-answer="4">Emberek, utcakép</div>
                                </div>
                                <input type="hidden" name="answers[13]" class="answer-input">
                                <div class="quiz-progress">13 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 14 -->
                        <div class="question-slide" data-question="14">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Milyen zenét hallgatsz utazás közben?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Chill, ambient</div>
                                    <div class="quiz-option" data-answer="2">Klasszikus, opera</div>
                                    <div class="quiz-option" data-answer="3">Pop, slágerek</div>
                                    <div class="quiz-option" data-answer="4">Helyi, népzene</div>
                                </div>
                                <input type="hidden" name="answers[14]" class="answer-input">
                                <div class="quiz-progress">14 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Kérdés 15 -->
                        <div class="question-slide" data-question="15">
                            <img src="/oldal/images/banner.png" alt="Utazás" class="quiz-image">
                            <div class="quiz-content">
                                <h2 class="quiz-question">Mi a legfontosabb egy utazásban?</h2>
                                <div class="quiz-options">
                                    <div class="quiz-option" data-answer="1">Kikapcsolódás, pihenés</div>
                                    <div class="quiz-option" data-answer="2">Kaland, élmények</div>
                                    <div class="quiz-option" data-answer="3">Kultúra, tanulás</div>
                                    <div class="quiz-option" data-answer="4">Jó ár-érték arány</div>
                                </div>
                                <input type="hidden" name="answers[15]" class="answer-input">
                                <div class="quiz-progress">15 / 15 kérdés</div>
                            </div>
                        </div>

                        <!-- Navigációs gombok -->
                        <div class="quiz-content">
                            <div class="quiz-navigation">
                                <button type="button" class="quiz-btn quiz-btn-secondary" id="prevBtn" style="display:none;">Vissza</button>
                                <button type="button" class="quiz-btn quiz-btn-primary" id="nextBtn" disabled>Következő</button>
                                <button type="submit" class="quiz-btn quiz-btn-primary" id="submitBtn" style="display:none;">Eredmény megtekintése</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                let currentQuestion = 1;
                const totalQuestions = 15;
                const answers = {};

                // Válasz kiválasztása
                $('.quiz-option').click(function() {
                    const slide = $(this).closest('.question-slide');
                    const questionNum = slide.data('question');
                    const answerValue = $(this).data('answer');

                    // Előző kijelölés törlése
                    slide.find('.quiz-option').removeClass('selected');
                    
                    // Új kijelölés
                    $(this).addClass('selected');
                    
                    // Válasz mentése
                    answers[questionNum] = answerValue;
                    slide.find('.answer-input').val(answerValue);

                    // Következő gomb engedélyezése
                    $('#nextBtn').prop('disabled', false);
                    if (questionNum === totalQuestions) {
                        $('#submitBtn').prop('disabled', false);
                    }
                });

                // Következő kérdés
                $('#nextBtn').click(function() {
                    if (currentQuestion < totalQuestions) {
                        // Aktuális elrejtése
                        $('.question-slide[data-question="' + currentQuestion + '"]').removeClass('active');
                        
                        currentQuestion++;
                        
                        // Következő megjelenítése
                        $('.question-slide[data-question="' + currentQuestion + '"]').addClass('active');
                        
                        // Gombok frissítése
                        updateButtons();
                    }
                });

                // Előző kérdés
                $('#prevBtn').click(function() {
                    if (currentQuestion > 1) {
                        // Aktuális elrejtése
                        $('.question-slide[data-question="' + currentQuestion + '"]').removeClass('active');
                        
                        currentQuestion--;
                        
                        // Előző megjelenítése
                        $('.question-slide[data-question="' + currentQuestion + '"]').addClass('active');
                        
                        // Gombok frissítése
                        updateButtons();
                    }
                });

                function updateButtons() {
                    // Vissza gomb
                    if (currentQuestion === 1) {
                        $('#prevBtn').hide();
                    } else {
                        $('#prevBtn').show();
                    }

                    // Következő / Beküldés gomb
                    if (currentQuestion === totalQuestions) {
                        $('#nextBtn').hide();
                        $('#submitBtn').show();
                        
                        // Ha már van válasz erre a kérdésre
                        if (answers[currentQuestion]) {
                            $('#submitBtn').prop('disabled', false);
                        } else {
                            $('#submitBtn').prop('disabled', true);
                        }
                    } else {
                        $('#nextBtn').show();
                        $('#submitBtn').hide();
                        
                        // Ha már van válasz erre a kérdésre
                        if (answers[currentQuestion]) {
                            $('#nextBtn').prop('disabled', false);
                        } else {
                            $('#nextBtn').prop('disabled', true);
                        }
                    }
                }

                // Form validáció beküldés előtt
                $('#quizForm').submit(function(e) {
                    if (Object.keys(answers).length < totalQuestions) {
                        e.preventDefault();
                        alert('Kérjük, válaszolj meg minden kérdést!');
                        return false;
                    }
                    // Ha minden kérdésre válaszolt, engedjük a form elküldését
                });
            });
        </script>

        <script src="/oldal/js/jquery.animateNumber.min.js"></script>
        <script src="/oldal/js/jquery.fancybox.min.js"></script>
        <script src="/oldal/js/jquery.stellar.min.js"></script>
        <script src="/oldal/js/jquery.easing.1.3.js"></script>
        <script src="/oldal/js/isotope.pkgd.min.js"></script>
        <script src="/oldal/js/aos.js"></script>
        <script src="/oldal/js/main.js"></script>
    </div>
</body>
</html>