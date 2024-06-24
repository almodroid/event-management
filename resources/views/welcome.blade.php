<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فعالية خميس مشيط</title>
    <link href="https://fonts.googleapis.com/css2?family=Kufam&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <h1>حيّاك في خميس مشيط</h1>
            <p>حيث الجبال الخضراء والطبيعة الزاهية التي تسر الناظر</p>
            <button>اشتر تذكرتك الآن</button>
        </div>
    </header>
    <section class="main-image">
        <img src="{{ asset('images/1.png') }}" alt="جبال خميس مشيط">
    </section>
    <section class="activities">
        <h2>كل الفعاليات الرهيبة في مكان واحد</h2>
        <p>اكتشف مجموعة متنوعة من الفعاليات الحصرية التي نقدمها. من الحفلات الموسيقية والعروض المسرحية إلى المعارض الفنية والأحداث الرياضية، سيجد كل زائر ما يبحث عنه.</p>
        <div class="activity-icons">
            <div class="activity">
                <img src="{{ asset('images/trampoline.png') }}" alt="ترامبولين">
                <p>ترامبولين</p>
            </div>
            <div class="activity">
                <img src="{{ asset('images/doughnut.png') }}" alt="زحليقة الدونات">
                <p>زحليقة الدونات</p>
            </div>
            <div class="activity">
                <img src="{{ asset('images/climbing.png') }}" alt="جدار التسلق">
                <p>جدار التسلق</p>
            </div>
            <div class="activity">
                <img src="{{ asset('images/zipline.png') }}" alt="Zipline">
                <p>Zipline</p>
            </div>
        </div>
    </section>
    <section class="event-info">
        <h2>معلومات الفعالية</h2>
        <ul>
            <li><span>وقت الفعالية:</span> 04:00 م</li>
            <li><span>تاريخ الفعالية:</span> من 11-06-2024 إلى 09-09-2024</li>
            <li><span>التذاكر:</span> 50.00 SAR</li>
            <li><span>موقع الفعالية:</span> خميس مشيط</li>
        </ul>
        <p>لا تفوتك التذاكر! احصل عليها الآن.</p>
        <button>اشتر تذكرتك الآن</button>
    </section>
    <footer>
        <div class="container">
            <div class="social-media">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter/X</a>
            </div>
            <div class="privacy">
                <a href="#">سياسة الخصوصية</a>
                <a href="#">الشروط والأحكام</a>
                <a href="#">اتصل بنا</a>
            </div>
            <div class="about-us">
                <a href="#">فريقنا</a>
                <a href="#">تاريخنا</a>
                <a href="#">الوظائف</a>
            </div>
            <p>الطريق الصحيح لتنظيم الفعاليات</p>
        </div>
    </footer>
</body>
</html>
