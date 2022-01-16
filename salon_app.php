<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="C:\Users\Migle\Desktop\projektas kursams\fontawesome\css\all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

</head>

<body>
    <header>
        <nav id="top-nav"></nav>
        <nav>
            <div id="nav-wrapper" class="clearfix">
                <a href="index.php">
                    <img id="logoImg" src="fullLogo.jpg" alt="logo image" />
                </a>
                <ul>
                    <a class="hover" href="index.php">PAGRINDINIS</a>
                    <li>
                        <a class="hover" href="client_registrations.php">MANO REGISTRACIJOS</a>
                    </li>
                    <li>
                        <i class="nav-bar" aria-hidden="true"></i>
                        <i class="down-arrow fas fa-chevron-down"></i>
                        <a class="hover">DAUGIAU</a>
                        <div class="dropdown">
                            <a class="hover" href="article.php?id=1">APIE MUS</a>
                            <a class="hover" href="article.php?id=2">NAUJIENOS</a>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <main class="<?php echo $mainClass ?? '' ?>">
        <?php echo $content ?? '' ?>
    </main>
    <footer>
        <div class="footer-wrapper">
            <form class="contact-form" action="mailto:info@paws&pals.lt" method="post" enctype="text/plain">
                <header>Susisiekite su Paws&pals:</header>

                <label>Jūsų vardas:</label>
                <input type="text" name="Your_name" value="">

                <label>Elektoninio pašto adresas:</label>
                <input type="text" name="email" value="">

                <label>Jūsų žinutė:</label>
                <textarea name="message" rows="5" cols="50"> </textarea>

                <input type="submit" name="" value="Siųsti">
            </form>
        </div>
    </footer>
</body>

</html>