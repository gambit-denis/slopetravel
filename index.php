<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>SlopeTravel - Kosova</title>
    <style>
        :root {
            --dark-purple: #3C2749;
            --platinum: #DFDEE4;
            --space-cadet: #1B2545;
            --white: #FCFBFB;
            --redwood: #B54244;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: var(--platinum);
            color: var(--space-cadet);
        }

        header {
            background: linear-gradient(90deg, var(--dark-purple), var(--redwood));
            color: var(--white);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .contact-info {
            font-size: 14px;
        }

        nav {
    display: flex;
    gap: 10px;
  }

  nav a {
    text-decoration: none;
    padding: 8px 12px;
    color: black;
    font-size: 14px;
    border-radius: 6px;
  }
        header nav {
            display: flex;
            gap: 15px;
            text-decoration: none;
        }

        header nav a:hover{
          text-decoration: none;
        
          background: #fff;
          color: white;
        }

        header nav a {
            color: var(--white);
            text-decoration: none;
            font-weight: bold;
        }
        .shkarko-button {
    background-color: transparent;
    border: 1px solid #ccc;
    text-decoration: none;
    color: #fff;
    transition: 0.3s;
  }

  .shkarko-button:hover {
    background-color: #f0f0f0;
    color: black;
}

  .menu-button {
    background: none;
    border: none;
    cursor: pointer;
  }

        .menu-button:focus {
            outline: none;
        }
        .offers {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .offer-card {
            background-color: var(--white);
            border: 1px solid var(--dark-purple);
            border-radius: 10px;
            padding: 20px;
            flex: 1 1 calc(25% - 40px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 300px;
        }

        .offer-card img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .offer-card h5 {
            color: var(--dark-purple);
        }

        .offer-card button {
            background-color: var(--dark-purple);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .offer-card button:hover {
            background-color: var(--redwood);
        }
        .reviews-section {
  text-align: center;
  padding: 20px;
  font-family: Arial, sans-serif;
}

.reviews-section h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.overall-rating p {
  font-size: 18px;
  font-weight: bold;
}

.overall-rating span {
  color: #f39c12; /* Gold color for stars */
}

.reviews-carousel {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
}

.review {
  max-width: 300px;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 15px;
  background-color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  text-align: left;
  scroll-snap-align: center;
  flex-shrink: 0;
}

.review p {
  margin: 5px 0;
}

.arrow {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  font-size: 18px;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.arrow:hover {
  background-color: #f39c12;
  color: #fff;
}

.left-arrow {
  transform: rotate(180deg);
}

/* Responsive Design */
@media (max-width: 768px) {
  .reviews-carousel {
    flex-direction: row;
    gap: 10px;
    padding: 0 10px;
  }

  .review {
    max-width: 80%; /* Make the cards smaller */
    margin: 0 auto; /* Center the cards */
  }

  .arrow {
    display: none; /* Hide arrows on smaller screens */
  }
}

@media (max-width: 480px) {
  .reviews-section h2 {
    font-size: 20px;
  }

  .overall-rating p {
    font-size: 16px;
  }

  .review {
    font-size: 14px;
    padding: 10px;
  }
}
footer {
  background-color: #333;
  padding: 40px;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-subscription {
  flex: 1 1 30%;
  margin-right: 20px;
  text-align: left;
}

.footer-subscription h2 {
  font-size: 24px;
  margin-bottom: 15px;
  color: #f2f2f2;
}

.footer-subscription p {
  font-size: 14px;
  margin-bottom: 10px;
  line-height: 1.6;
}

.subscribe-btn {
  background-color: #d12e2e;
  color: white;
  border: none;
  padding: 12px 24px;
  border-radius: 25px;
  font-size: 16px;
  cursor: pointer;
  text-transform: uppercase;
}

.subscribe-btn:hover {
  background-color: #b92727;
}

.footer-links {
  display: flex;
  flex: 2 1 65%;
  flex-wrap: wrap;
  gap: 20px;
}

.footer-column {
  flex: 1 1 23%;
  margin-bottom: 20px;
}

.footer-column h3 {
  font-size: 16px;
  margin-bottom: 10px;
  text-transform: uppercase;
  color: #f2f2f2;
}

.footer-column ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.footer-column ul li {
  margin-bottom: 8px;
}

.footer-column ul li a {
  text-decoration: none;
  color: #ccc;
  font-size: 14px;
}

.menu-button {
                display: none;
            }

.footer-column ul li a:hover {
  color: #fff;
  text-decoration: underline;
}
.mobile-nav {
    display: none;  /* Hidden by default */
    flex-direction: column;  /* Items will stack vertically */
    position: absolute;
    top: 98px;
    left: 0;
    width: 100%;
    background-color: #222;
    color: white;
    padding: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.mobile-nav.show {
    display: flex;
    opacity: 1;
}

.mobile-nav a {
    color: white;
    text-decoration: none;
    padding: 10px;
    display: block;  /* Each link is on its own row */
}

.mobile-nav a:hover {
    background-color: #555;  /* Optional hover effect */
}

/* For displaying items in rows (horizontally) */
.mobile-nav .nav-links {
    display: flex;
    flex-wrap: wrap;  /* Allow links to wrap to the next line if needed */
    justify-content: space-between;  /* Space items evenly */
}

.mobile-nav .nav-links a {
    width: 100%;  /* Each link takes full width on mobile */
    text-align: center;  /* Center the text in each link */
}


        @media (max-width: 1024px) {
            .offer-card {
                flex: 1 1 calc(33% - 40px);
            }
    
        }

        @media (max-width: 768px) {
            header nav {
                display: none;
            }

            .menu-button {
                display: block;
             }

            .mobile-nav {
                display: flex;
            }

            .offers {
                flex-direction: column;
                align-items: center;
            }

            .offer-card {
        flex: 1 1 100%;
        max-width: 90%;
    }
        }
    </style>
</head>
<body>
    <header>
        <div ><img style="width: 44px; height: 44px;" src="icon 1.png" alt="logo"></div>
      
        <button class="menu-button" onclick="toggleMenu()"><i class="fa fa-bars" style="font-size:24px"></i></button>

            <nav>
            <a 
            href="#" 
            
            class="shkarko-button" 
            onclick="notifyUnavailable()">Shkarko aplikacionin</a>
          <a href="#offers">Ballina</a>
          <a href="support.html">Ndihma</a>
          <a href="#footer-container">Rreth Nesh</a>
          <a href="login.php">Kyqu</a>
        </nav>
    </header>
    <div class="contact-info" style="background-color: #121212; color: #fff; text-align: center; padding: 10px 10px;">
      <i class="fa fa-phone" style="font-size:18px"></i><span> +383 49 228 913</span> | <i class="fa fa-envelope" style="font-size:15px"></i> <span> support@slopetravel.com</span>
    </div>  
    <nav class="mobile-nav">
      <a 
      href="#" 
      
      class="shkarko-button" 
      onclick="notifyUnavailable()">Shkarko aplikacionin</a>
    <a href="#offers">Ballina</a>
    <a href="support.html">Ndihma</a>
    <a href="#footer-container">Rreth Nesh</a>
    <a href="login.php">Kyqu</a>
  </nav>
    <main>
        <section id="offers">
            <div style="align-items: center; justify-content: center; display: flex;">
                <h2>Ofertat</h2>
            </div>
            <div class="offers">
                <div class="offer-card">
                    <h3>Prishtinë - Amsterdam</h3>
                    <img style="width: 330px; height: 180px;" src="images/amsterdam.jpg" alt="Amsterdam">
                    <p>Shijoni luksin e Amsterdamit me akomodime premium dhe vizita te monumentet
                       ikonike si Shtëpia e Anne Frank dhe Muzeu Van Gogh.</p>
                        <div class="offer-details" style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
                          <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                              <i class="fa fa-plane" style="margin-left: 20px; font-size: 34px; color: var(--dark-purple);"></i>
                              <h5 style="margin: 0; margin-right: 20px;">24 Janar - 28 Janar</h5>
                          </div>
                          <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-building" style="margin-left: 20px; font-size: 32px; color: var(--dark-purple);" aria-hidden="true"></i>
                              <h5 style="margin: 0; margin-right: 20px;">4 ditë/3 netë</h5>
                          </div>
                          <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-suitcase" style="margin-left: 20px; font-size: 28px; color: var(--dark-purple);" aria-hidden="true"></i>
                              <h5 style="margin: 0; margin-right: 20px;">Çantë krahu pa pagesë</h5>
                          </div>
                      </div>
                        <div class="price-items" style="display: flex; justify-content: space-between; align-items: baseline;">
                            <h3 style="margin-left: 20px; color: var(--dark-purple);">299.99€</h3>
                            <p style="margin-right: 20px; color: var(--dark-purple);">Për Person</p>
                        </div>
                    <button style="align-items: center; justify-content: center;">Rezervo tani!</button>
                </div>
                <div class="offer-card">
                  <h3>Prishtinë - Milano</h3>
                  <img style="width: 330px; height: 180px;" src="images/milano.jpg" alt="Milano">
                  <p>Zhytu në zemër të Italisë me paketën tonë ekskluzive për Milano. 
                    Shijoni luksin italian dhe vizitoni monumentet ikonike si Duomo dhe Galleria Vittorio Emanuele II.</p>
                      <div class="offer-details" style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
                        <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-plane" style="margin-left: 20px; font-size: 34px; color: var(--dark-purple);"></i>
                            <h5 style="margin: 0; margin-right: 20px;">24 Janar - 28 Janar</h5>
                        </div>
                        <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                          <i class="fa fa-building" style="margin-left: 20px; font-size: 32px; color: var(--dark-purple);" aria-hidden="true"></i>
                            <h5 style="margin: 0; margin-right: 20px;">4 ditë/3 netë</h5>
                        </div>
                        <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                          <i class="fa fa-suitcase" style="margin-left: 20px; font-size: 28px; color: var(--dark-purple);" aria-hidden="true"></i>
                            <h5 style="margin: 0; margin-right: 20px;">Çantë krahu pa pagesë</h5>
                        </div>
                    </div>
                      <div class="price-items" style="display: flex; justify-content: space-between; align-items: baseline;">
                          <h3 style="margin-left: 20px; color: var(--dark-purple);">299.99€</h3>
                          <p style="margin-right: 20px; color: var(--dark-purple);">Për Person</p>
                      </div>
                  <button style="margin-top: 10px;">Rezervo tani!</button>
              </div>             
                <div class="offer-card">
                    <h3>Shkup - Budapest</h3>
                    <img style="width: 330px; height: 180px;" src="images/budapest.jpg" alt="Budapest">
                    <p style="text-align: center;"><p>Përjetoni hijeshinë e Budapestit me paketën tonë ekskluzive. 
                      Shijoni luksin hungarez dhe vizitoni monumentet ikonike.</p>
                        <div class="offer-details" style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
                          <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                              <i class="fa fa-plane" style="margin-left: 20px; font-size: 34px; color: var(--dark-purple);"></i>
                              <h5 style="margin: 0; margin-right: 20px;">24 Janar - 28 Janar</h5>
                          </div>
                          <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-building" style="margin-left: 20px; font-size: 32px; color: var(--dark-purple);" aria-hidden="true"></i>
                              <h5 style="margin: 0; margin-right: 20px;">4 ditë/3 netë</h5>
                          </div>
                          <div class="offer-detail-item" style="display: flex; align-items: center; gap: 10px;">
                            <i class="fa fa-suitcase" style="margin-left: 20px; font-size: 28px; color: var(--dark-purple);" aria-hidden="true"></i>
                              <h5 style="margin: 0; margin-right: 20px;">Çantë krahu pa pagesë</h5>
                          </div>
                      </div>
                        <div class="price-items" style="display: flex; justify-content: space-between; align-items: baseline;">
                            <h3 style="margin-left: 20px; color: var(--dark-purple);">299.99€</h3>
                            <p style="margin-right: 20px; color: var(--dark-purple);">Për Person</p>
                        </div>
                    <button>Rezervo tani!</button>
                </div>
            </div>
        </section>

        <section id="reviews">
            <div class="reviews-section">
                <h2>Klientët e kënaqur</h2>
                <div class="overall-rating">
                  <p>Vlerësimi i përgjithshëm: <span>★ 4.9</span></p>
                </div>
                <div class="reviews-carousel">
                  <button class="arrow left-arrow">←</button>
                  <div class="review">
                    <p>★★★★★ 5.0</p>
                    <p>NJ na dha të gjitha informacionet dhe kujdesej për gjithçka. Ajo bëri sugjerime të mëdha. NJ ishte e mrekullueshme për të punuar me të.</p>
                    <p><strong>FATLINDA S.</strong></p>
                    <p>03/01/2025</p>
                  </div>
                  <div class="review">
                    <p>★★★★★ 5.0</p>
                    <p>I’ve been booking with Liberty Travels since 2013. Lindsay is who I use all the time, who remembers what my budget is and the type of resorts I like. Does a great job answering all my questions.</p>
                    <p><strong>Ruth</strong></p>
                    <p>12/20/2024</p>
                  </div>
                  <div class="review">
                    <p>★★★★★ 5.0</p>
                    <p>Ju përgëzoj për themelimin e agjensionit! Super agjension! Vetëm vazhdoni!</p>
                    <p><strong>BEKIM R.</strong></p>
                    <p>05/01/2025</p>
                  </div>
                  <button class="arrow right-arrow">→</button>
                </div>
              </div>              
        </section>
        <footer>
            <div class="footer-container">
              <div class="footer-subscription">
                <h2 style="margin-bottom: 10px; font-family: serif; font-size: 2rem;">Abonohu</h2>
                <p style="margin-bottom: 20px; color: #fff;">Regjistrohu dhe prano ofertat më të fundit të Slope Travel</p>
                <form style="display: inline-flex; gap: 10px; max-width: 500px; width: 100%;">
                  <input type="email" placeholder="Email" 
                    style="flex: 1; padding: 10px; font-size: 1rem; border: 1px solid #fff; border-radius: 5px;">
                  <button type="submit" 
                    style="background-color: #fff; color: #121212; padding: 10px 20px; font-weight: bold; border: none; border-radius: 5px; cursor: pointer;">
                    Abonohu
                  </button>
                </form>
                <p style="margin-top: 20px; font-size: 0.9rem; color: #aaa;">
                  © 2025 Slope Travel - Të gjitha të drejtat e rezervuara.
                </p>
              </div>
          
              <div class="footer-links">          
                <div class="footer-column">
                  <h3>Destinacionet</h3>
                  <ul>
                    <li><a href="#">Athinë</a></li>
                    <li><a href="#">Amsterdam</a></li>
                    <li><a href="#">Barcelonë</a></li>
                    <li><a href="#">Bratislava</a></li>
                    <li><a href="#">Bruksel</a></li>
                    <li><a href="#">Berlin</a></li>
                    <li><a href="#">Budapest</a></li>
                    <li><a href="#">Cyrih</a></li>
                    <li><a href="#">Dortmund</a></li>
                    <li><a href="#">Frankfurt</a></li>
                    <li><a href="#">Hamburg</a></li>
                    <li><a href="#">Lisbonë</a></li>
                    <li><a href="#">Londër</a></li>
                    <li><a href="#">Ljubljana</a></li>
                  </ul>
                </div>
          
                <div class="footer-column">
                  <h3> </h3>
                  <ul>    
                    <br>
                    <li><a href="#">Lyon</a></li>
                    <li><a href="#">Malta</a></li>
                    <li><a href="#">Malmo</a></li>
                    <li><a href="#">Madrid</a></li>
                    <li><a href="#">Milano</a></li>
                    <li><a href="#">Oslo</a></li>
                    <li><a href="#">Pragë</a></li>
                    <li><a href="#">Pisa</a></li>
                    <li><a href="#">Paris</a></li>
                    <li><a href="#">Romë</a></li>
                    <li><a href="#">Valencia</a></li>
                    <li><a href="#">Varshavë</a></li>
                    <li><a href="#">Venecia</a></li>
                    <li><a href="#">Viena</a></li>
                  </ul>
                </div>

                <div class="footer-column">
                  <h3>NA GJENI</h3>
                  <ul>
                    <li><a href="https://www.instagram.com/slopetravel/">Facebook</a></li>
                    <li><a href="https://www.instagram.com/slopetravel/">Instagram</a></li>
                    <li><a href="https://www.youtube.com/@slopetravel">YouTube</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </footer>
          <script>
            function notifyUnavailable() {
              alert("Kjo veçori nuk është ende e disponueshme!");
            }
          </script>
           <script>
             function toggleMenu() {
    let mobileNav = document.querySelector(".mobile-nav");
    mobileNav.classList.toggle("show");  // This will toggle the 'show' class to hide/show the menu
}
        </script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/6790e6ea825083258e092891/1ii70c1je';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->
</body>
</html>
