<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HCM NIGHT CLUB</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/Crown_03.png" type="image/x-icon" />
</head>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<body class="mainstage">
    <header>
        <a href="#" class="Navbar-logo">
            <img src="assets/img/logo-1.png" alt="HCM NIGHT CLUB">
            <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="300px" viewBox="0 0 600 100">
                <defs>

                    <filter id="filter">
                        <feFlood flood-color="#1b6d85" result="black" />
                        <feFlood flood-color="red" result="flood1" />
                        <feFlood flood-color="limegreen" result="flood2" />
                        <feOffset in="SourceGraphic" dx="3" dy="0" result="off1a"/>
                        <feOffset in="SourceGraphic" dx="2" dy="0" result="off1b"/>
                        <feOffset in="SourceGraphic" dx="-3" dy="0" result="off2a"/>
                        <feOffset in="SourceGraphic" dx="-2" dy="0" result="off2b"/>
                        <feComposite in="flood1" in2="off1a" operator="in"  result="comp1" />
                        <feComposite in="flood2" in2="off2a" operator="in" result="comp2" />

                        <feMerge x="0" width="100%" result="merge1">
                            <feMergeNode in = "black" />
                            <feMergeNode in = "comp1" />
                            <feMergeNode in = "off1b" />

                            <animate
                                    attributeName="y"
                                    id = "y"
                                    dur ="4s"

                                    values = '104px; 104px; 30px; 105px; 30px; 2px; 2px; 50px; 40px; 105px; 105px; 20px; 6ßpx; 40px; 104px; 40px; 70px; 10px; 30px; 104px; 102px'

                                    keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

                                    repeatCount = "indefinite" />

                            <animate attributeName="height"
                                     id = "h"
                                     dur ="4s"

                                     values = '10px; 0px; 10px; 30px; 50px; 0px; 10px; 0px; 0px; 0px; 10px; 50px; 40px; 0px; 0px; 0px; 40px; 30px; 10px; 0px; 50px'

                                     keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

                                     repeatCount = "indefinite" />
                        </feMerge>


                        <feMerge x="0" width="100%" y="60px" height="65px" result="merge2">
                            <feMergeNode in = "black" />
                            <feMergeNode in = "comp2" />
                            <feMergeNode in = "off2b" />

                            <animate attributeName="y"
                                     id = "y"
                                     dur ="4s"
                                     values = '103px; 104px; 69px; 53px; 42px; 104px; 78px; 89px; 96px; 100px; 67px; 50px; 96px; 66px; 88px; 42px; 13px; 100px; 100px; 104px;'

                                     keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513; 0.548; 0.577; 0.613; 1'

                                     repeatCount = "indefinite" />

                            <animate attributeName="height"
                                     id = "h"
                                     dur = "4s"

                                     values = '0px; 0px; 0px; 16px; 16px; 12px; 12px; 0px; 0px; 5px; 10px; 22px; 33px; 11px; 0px; 0px; 10px'

                                     keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513;  1'

                                     repeatCount = "indefinite" />
                        </feMerge>

                        <feMerge>
                            <feMergeNode in="SourceGraphic" />

                            <feMergeNode in="merge1" />
                            <feMergeNode in="merge2" />

                        </feMerge>
                    </filter>

                </defs>

                <g>
                    <text x="0" y="100">HCM NIGHT CLUB</text>
                </g>

        </a>
    </header>
    <section class="main-body"></section>
    <section class="event-body">
        <section class="event-wrapper">
            <div class="home-main-news-item">
                <div class="desktop-col-50">
                    <div class="home-main-picture">
                        <h4>Event war <br>23/08 - 23/09</h4>
                    </div>
                    <a href="https://clashroyale.com/blog/news/" class="home-main-news-item-content-category">
                        <h4>News</h4>
                    </a>
                </div>
                <div class="desktop-col-50 desktop-right">
                    <p class="small-text">Sep 6, 2018</p>
                    <h4>Reward up to $99</h4>
                    <p>Win collect 1 and win battle war 4. <a href="#">Read more</a></p>
                </div>
            </div>
            <div class="home-news-primary-item-holder">
                <div class="img-block img-block-1"></div>
                <a href="https://clashroyale.com/blog/news/" class="b-block b-block1">
                    <h4>Members</h4>
                </a>
                <div class="bottom-block">
                    <p class="small-text">Sep 6, 2018</p>
                    <p>Welcome to hcm night club. <a href="#">Read more</a></p>
                </div>
            </div>
            <div class="home-news-primary-item-holder">
                <div class="img-block img-block-2"></div>
                <a href="https://clashroyale.com/blog/news/" class="b-block b-block2">
                    <h4>Offline</h4>
                </a>
                <div class="bottom-block">
                    <p class="small-text">Sep 6, 2018</p>
                    <p>Party with friend every month. <a href="#">Read more</a></p>
                </div>
            </div>
            <div class="home-news-primary-item-holder">
                <div class="img-block img-block-3"></div>
                <a href="https://clashroyale.com/blog/news/" class="b-block b-block3">
                    <h4>Clips</h4>
                </a>
                <div class="bottom-block">
                    <p class="small-text">Sep 6, 2018</p>
                    <p>Renegal all clips from battles. <a href="#">Read more</a></p>
                </div>
            </div>
        </section>
    </section>

</body>
</html>