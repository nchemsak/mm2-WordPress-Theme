<?php get_header(); ?>



  <!--                       <?php
                                if(has_nav_menu('primary'))
                                    { wp_nav_menu(array(
                                        'theme_location'  => 'primary',
                                        'container'       => 'div',
                                        'menu_class'      => 'nav navbar-nav',
                                        'menu_id'         => 'primary',
                                        'echo'            => true,
                                        'fallback_cb'     => 'wp_page_menu',
                                        'before'          => '',
                                        'after'           => '',
                                        'link_before'     => '',
                                        'link_after'      => '',
                                        'depth'           => 0,
                                        'walker'          => new wp_bootstrap_navwalker()
                                    )); 
                                }
                            ?>
                    -->




<body id="homepage" onload="DisplayInfo()">
    <div class="overlay">
        <div class="overlay-content">
            <div class="container">
                Hi!
                <br /> <br />
                <span class="d-none d-md-block">Use your computer<br />keyboard "arrow keys"<img src="/public_html/wp-content/themes/mm2theme/images/icons/arrowkey.png" class="arrow-key" alt="keyboard arrow key" /><br />to control the bee.<br />
                    <br />
                </span><br /><br />Or use the navigation links below <i class="fa fa-toggle-down"></i>
                <a href="javascript:void(0)" class="closebtn blink" onclick="closeNav()">Close Help</a>
            </div>
        </div>
    </div>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div id="main" class="col-xs-12 col-lg-8">
                    <section id="main-content" class="scroll">
                        <div class="header-image">
                            <img src="/public_html/wp-content/themes/mm2theme/images/mm2.png" class="img-fluid" />
                            <a href="#" onclick="toggleQuote(); return false;" class="h1-animation">
                                <h1 class="homepage-h1">Ephemeral Wave</h1>
                            </a> 
                            <div id="home-page-quote" class="scroll-up d-none">
                                <p>"You didn’t come into this world. You came out of it, like a wave from the ocean. <br />You are not a stranger here."</p><br />
                                <p>"The moon tells me a secret: 'As full and bright as I am, this light is not my own. A million light reflections pass over me.' The source is bright and endless."</p><br />
                                <p>"Wash out this tired notion that the best is yet to come."</p><br />
                                <p>"Life is a waterfall. We're one in the river, and one again after the fall"</p><br />
                                <p>"You are a function of what the whole universe is doing in the same way that a wave is a function of what the whole ocean is doing."</p><br />
                            </div>
                        </div>
                    </section>
                </div>
                <div id="sidebar" class="col-xs-12 col-lg-4">
                    <section id="side-nav-list" class="toggle options-menu-off">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 column-1">
                                <h2> Map
                                </h2>
                                <section class="eagle-eye">
                                    <img class="bee1 toggle show-bee" src="/public_html/wp-content/themes/mm2theme/images/icons/Bee1.ico">
                                    <img class="bee2 toggle show-bee" src="/public_html/wp-content/themes/mm2theme/images/icons/Bee2.ico">
                                    <a id="play_button" class="seizure" href="#" next="#" value="ATTACK" onclick="attack()"> Attack!
                                        <audio id="audio" src="/public_html/wp-content/themes/mm2theme/audio/slap.mp3"></audio>
                                    </a>
                                       <a id="play_button_buzz" href="#" next="#" value="buzz" onclick="buzz();">Buzz!
                                        <audio id="buzz" src="/public_html/wp-content/themes/mm2theme/audio/buzz.mp3"></audio>
                                    </a>
                                </section>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 column-2">
                                <div class="row">
                                    <div class="col-6 col-md-12">
                                        <div id="location" class="info">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div id="temp" class="info">Temp</div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div id="temperature" class="info">
                                            <span id="temperature-num"></span><span>°</span><span id="temperature-scale">C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div id="weather" class="info">Weather</div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div id="weather-condition" class="info"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div id="options-row">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-3 col-xl-3">'<a href="#" onclick="firstVisit(); return false;">H</a>' Help</div>
                    <div class="col-xs-12 col-md-6 col-lg-3 col-xl-3">Day = 332</div>
                    <div class="col-xs-12 col-md-6 col-lg-3 col-xl-3">Year = 2019</div>
                    <div class="col-xs-12 col-md-6 col-lg-3 col-xl-3">Compass = <span class="direction north"></span></div>
                </div>
            </div>
            <section id="character-section">
                <div class="row">
                    <div class="col-xs-12 col-lg-6"><span class="name">1) <a href="/character">Character</a></span></div>
                    <div class="col-xs-12 col-lg-6"><span class="name">2) <a href="/drum-machine">Drum Machine</a></span></div>
                    <div class="col-xs-12 col-lg-6"><span class="name">3) <a href="/art">Art</a></span></div>
                    <div class="col-xs-12 col-lg-6"><span class="name">4) <a href="/fermentation">Fermentation</a></span></div>
                    <!--                     <div class="col-xs-12 col-lg-6"><span class="name">5) <a href="/milkweed-for-monarchs">Monarch Butterfly</a></span></div>
 -->
                    <div class="col-xs-12 col-lg-6"><span class="name">5) <a href="/rss">RSS Feed</a></span></div>
                    <div class="col-xs-12 col-lg-6"><span class="name">6) <a href="/katsura">Katsura Tree</a></span></div>
                    <div class="col-xs-12 col-lg-6"><span class="name">7) <a href="/coding">Coding</a></span></div>
                    <div class="col-xs-12 col-lg-6"><span class="name">8) <a href="/ducks">Ducks</a></span></div>
                </div>
            </section>
        </div>
        <div class="container">
            <div class="weather-info">
                <div id="location" class="info"></div>
                <div id="temperature" class="info">
                    <span id="temperature-num"></span>
                    <!-- <span>°</span> -->
                    <!-- <span id="temperature-scale"></span> -->
                </div>
                <div id="weather-condition" class="info"></div>
            </div>
        </div>
    </div>
</body>


 <?php get_footer(); ?>  
