<?php
require_once "dbConn.php";
$db = new dbConn();
$conn = $db->connectDB();

require_once "Product.php";
$productObj = new Product($conn);
$products = $productObj->getAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="body.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
      
   
      <div class="header">
      <div class="left-section">
        <img src="images/logo.png" alt="Logo" height="150px" width="150px">
      </div>
      <div class="middle-section">
            <a href="homepage.php">Home</a>
            <a href="#eat&drink">Eat & Drink</a>
            <a href="contact.php">Contact</a>
            <a href="#about">About</a>
      </div>
      <div class="right-section">
        <button class="rezervo">
            <a href="registerpage.php" id="link">Reserve Now</a>
        </button>
      </div>
      </div>

    <div class="hero">
        <div class="bg"></div>
    </div>

 
<div class="slider-section">
  <div class="slider">
    <?php foreach ($products as $p): ?>
      <div class="slide">
        <?php if ($p['image']): ?>
          <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['title']) ?>">
        <?php endif; ?>
        <h3 class="slide-title"><?= htmlspecialchars($p['title']) ?></h3>
      </div>
    <?php endforeach; ?>
  </div>
</div>




  <div class="grid-container" id="eat&drink">
  <?php foreach ($products as $p): ?>
    <?php
      $class = "";
      if ($p['title'] === "Ushqimet tona") $class = "eat-div";
      else if ($p['title'] === "Pijet tona") $class = "drink-div";
      else if ($p['title'] === "Këndi i lojërave") $class = "playArea-div";
      else if ($p['title'] === "Lokacioni") $class = "location-div";
      else if ($p['title'] === "Ambienti") $class = "ambient-div";
      else if ($p['title'] === "Parkingu") $class = "parking-div";
    ?>
    <div class="<?= $class ?>">
      <?php if ($p['image']): ?>
        <img src="<?= htmlspecialchars($p['image']) ?>" alt="product-image" class="<?= str_replace('-div','-image',$class) ?>">
      <?php endif; ?>
      <div class="<?= str_replace('-div','-grid',$class) ?>">
        <p class="<?= str_replace('-div','-paragraph',$class) ?>">
          <?= htmlspecialchars($p['description']) ?>
        </p>
        <button class="button">Shiko me shume</button>
      </div>
    </div>
  <?php endforeach; ?>
</div>



  <div class="footer-container" id="about">
    <div class="footer-grid">
         <p class="about">
           Në Restorantin Holiday, çdo vizitë është një përvojë e plotë që bashkon shijen, natyrën dhe mikpritjen.<br>
           Pjatat tona pasqyrojnë traditën e Podgurit, të përgatitura me përbërës të freskët dhe të prezantuara me kujdes modern.
          </p>
          <p class="rights">Copyright © 2025 Zambaket. All rights reserved.</p>
          <div class="links">
          <a href="#">Advertise</a>
          <a href="#">Support</a>
          <a href="#">Our Company</a>
          <a href="#">Contact</a>
          </div> 
    </div>
  </div>
    
<script>
  let slider = document.querySelector('.slider');
  let slideWidth = 320; 
  let interval = 3500;  

  setInterval(() => {
    if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
      slider.scrollTo({ left: 0, behavior: 'smooth' });
    } else {
      slider.scrollBy({ left: slideWidth, behavior: 'smooth' });
    }
  }, interval);
</script>



</body>
</html>



   <!-- 
    <div class="grid-container">
      <div class="eat-div">
    <div>
      <img class="eat-image" src="images/food.jpg" alt="eat-image">
    </div>
    <div class="eat-grid">
      <p class="eat-paragraph">
        Në restorantin tonë, çdo pjatë është një udhëtim shijesh.
        Përgatitur me përbërës të freskët dhe të zgjedhur me kujdes,
        ushqimet tona kombinojnë traditën me kreativitetin modern.
      </p>
      <button class="button">
        Shiko me shume
      </button>
    </div>
  </div>

  <div class="drink-div">
    <div>
      <img class="drink-image" src="images/drinks.jpg" alt="drink-image">
    </div>
    <div class="drink-grid">
      <p class="drink-paragraph">
        Pijet tona janë menduar për të plotësuar çdo shije dhe për të sjellë freski në çdo moment.
        Çdo gotë është një eksperiencë më vete nga freskia e frutave deri te eleganca e verës,
        pijet tona janë krijuar për të kënaqur çdo klient.
      </p>
      <button class="button">
        Shiko me shume
      </button>
    </div>
  </div>

  <div class="playArea-div">
    <div>
      <img class="playArea-image" src="images/Img6.png" alt="playArea-image">
    </div>
    <div class="playArea-grid">
      <p class="playArea-paragraph">
        Në restorantin tonë, fëmijët gëzojnë një kënd lojërash të sigurt dhe argëtues,
        ku mund të luajnë e të shijojnë momente të gëzueshme ndërsa prindërit relaksohen.
        Kjo hapësirë e veçantë është menduar për të sjellë buzëqeshje dhe energji pozitive për më të vegjlit.
      </p>
       <button class="button">
        Shiko me shume
      </button>
    </div>
  </div>

  <div class="location-div">
    <div>
      <img class="location-image" src="images/lokacion.png" alt="location-image">
    </div>
    <div class="location-grid">
      <p class="location-paragraph">
        Restoranti ynë ndodhet në një vend të veçantë, pranë Burimit të Istogut,
        ku uji i kristaltë buron mes gjelbërimit dhe krijon një atmosferë të qetë e relaksuese.
        rrethuar nga malet madhështore të Istogut, lokacioni ynë ofron një pamje të mrekullueshme
        natyrore, ideale për të shijuar ushqimin në harmoni me tingujt e natyrës.
      </p>
      <button class="button">
        Shiko me shume
      </button>
    </div>
  </div>


  <div class="ambient-div">
    <div>
      <img class="ambient-image" src="images/ambienti.png" alt="ambient-image">
    </div>
    <div class="ambient-grid">
      <p class="ambient-paragraph">
       Rreth restorantit shtrihet një mjedis i gjelbër dhe i qetë,
       ku lumi me ujë të pastër rrjedh mes gurëve dekorativë dhe shatërvanëve të vegjël.
       Tingulli i ujit bashkohet me gjelbërimin përreth, 
       duke krijuar një atmosferë të relaksuar dhe të veçantë për çdo vizitor.
      </p>
      <button class="button">
        Shiko me shume
      </button>
    </div>
  </div>

  <div class="parking-div">
    <div>
      <img class="parking-image" src="images/parking.png" alt="parking-image">
    </div>
    <div class="parking-grid">
      <p class="parking-paragraph">
      Restoranti ynë ofron hapësirë të bollshme për parkim ,
      ofron dy zona të përshtatshme për parkim:
      një hapësirë të gjerë në fillim të hyrjes dhe një tjetër më afër ndërtesës, 
      e menduar posaçërisht për personat që kanë vështirësi në ecje.
      Kjo organizim siguron qasje të lehtë dhe komoditet për çdo vizitor.
      </p>
      <button class="button">
        Shiko me shume
      </button>
    </div>
  </div>
  </div>  -->
