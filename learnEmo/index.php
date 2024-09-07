<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnEmo</title>
    <link rel="stylesheet" href="styles/indexstyle.css?v=1.0">


    
</head>
<body>
    <div id="navbar">
        <div class="container">
            <nav>
            <h1>LearnEmo</h1>
                <ul id="menu">
                    <li><a href="#header">Anasayfa</a></li>
                    <li><a href="#about">Hakkında</a></li>
                    <li><a href="#contact">İletişim</a></li>
                    <li><a href="register.php">Giriş</a></li>
                   
                    <img class="small-screen" src="images/cancel.png" onclick="exitmenu()"> <!---used for small size-->
                </ul>
                <img class="small-screen" src="images/menu.png" onclick="openmenu()"> <!---used for small size-->
            </nav>
            

        </div>
    </div> 
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="leftcolumn">
                    <div class="left-image">
                        <img src="images/emoties.gif">
                    </div>
                    <style>
    .left-image img {
        width: 600px; /* Genişliği ayarlayabilirsin */
        height: auto; /* Yükseklik, genişliğe göre otomatik ayarlanır */
    }
</style>

         
                </div>
                <div class="rightcolumn">
                    <h1>Duygularınızı Keşfedin ve Yönetmeyi Öğrenin!</h1>
                    <h3>Hoş geldiniz! LearnEmo, çocuklar için özel olarak tasarlanmış bir eğitim platformudur.
                         AI teknolojileriyle desteklenen eğlenceli ve öğretici modüllerimiz, çocukların duygusal zekalarını geliştirmelerine yardımcı olur.</h3>
                </div>
            </div>
        </div>
    </div>
<!-- About Page -->
<div id="about">
    <div class="container">
        <div class="row">
            <div class="about-col1">
                <img src="images/about2.gif" alt="EmoLearn Görseli" class="about-image">
            </div>
            <div class="about-col2">
                <h1 class="subtitle">EmoLearn ile Neler Yapabilirsiniz?</h1>
               
                <div class="donete-cont">
                <div>
                   
                    <h3>1.Duygu Tanıma</h3>
                    <p>Metin ve ifadelerini kullanarak duyguları öğrenin ve tanıyın.
                     EmoLearn, çocukların duygusal ifadelerini analiz ederek onları anlamalarına yardımcı olur.</p>
                </div>
                <div>
                   
                    <h3>2.Eğlenceli Duygusal Eğitim:</h3>
                    <p>Eğlenceli senaryolar ve oyunlar aracılığıyla duygusal farkındalığı artırın.
                    Çocuklar, duygusal durumlarla başa çıkmayı eğlenceli bir şekilde öğrenirler.</p>
                    
                </div>
                <div>
                    
                    <h3>3.Kapsamlı EQ Testleri:</h3>
                    <p>Duygusal zekalarını ölçen ve gelişimlerini takip eden testlerle çocukların ilerlemesini gözlemleyin.</p>
                    
                </div>
                <div>
                  
                    <h3>4.Stres ve Farkındalık Egzersizleri:</h3>
                    <p>Basit ve eğlenceli mindfulness egzersizleri ve nefes teknikleri ile çocuklar, stresle başa çıkmayı öğrenirler.</p>
                    
                </div>


            </div>
                <div class="content active-one" id="goals">
                    
                </div>
                <div class="content" id="why">
                    <ul>
                    
                </div>
                <div class="content" id="process">
                    
                </div>
                <div class="content" id="process2">
                  
                </div>
            </div>
            <div class="about-col1">
                <img src="images/about.gif" alt="EmoLearn Görseli" class="about-image">
            </div>
        </div>
    </div>

    
    <!--contact part-->
    
    <div id="contact">
        <div class="container">
            <div class="row">
                <div class="left-col">
                    <h1 class="subtitle">Bizimle İletişime geçin !</h1>
                    <p><img src="images/gmail.png"> zeynaai@gmail.com</p>
                    <p><img src="images/phone.png">05123456789</p>
                    <div class="social-media">
                        <a href="https://www.instagram.com"><img src="images/instagram.png"width="50px" height="50px"></a>
                        <a href="https://www.twitter.com/"><img src="images/twitter.png"width="50px" height="50px"></a>
                        <a href="https://api.whatsapp.com"><img src="images/whatsapp.png" width="50px" height="50px"></a>
                    </div>
                </div>
                <div class="right-col">
                    <form>
                        <input type="text" name="Name" placeholder="Adın" required>
                        <input type="email" name="email" placeholder="Mail adresin" required>
                        <textarea name="Message"  rows="6" placeholder="Mesajın"></textarea>
                        <button type="submit"class="btn">Gönder</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>

    

    <script>

        var tablinks=document.getElementsByClassName("tab-links");
        var tabcontents=document.getElementsByClassName("content");
        function opentab(name){
            for(tablink of tablinks ){
                tablink.classList.remove("active");
            }
            for(tabcontent of tabcontents ){
                tabcontent.classList.remove("active-one");
            }
            event.currentTarget.classList.add("active");
            document.getElementById(name).classList.add("active-one");
        }

    </script>
    <script>
        var menu=document.getElementById("menu");
        function openmenu(){
            menu.style.right ="0"
        }
        function exitmenu(){
            menu.style.right ="-200px"
        }
    </script>
</body>
</html>