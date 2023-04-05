<div class="slide-pic foot-content" data-index="6" style="height: 592px; z-index: 1;">
    <footer class="home">

        <div class="topsection">
            <h2>Where you can find us</h2>
            <div class="dek"></div>
        </div>

        <div class="map-wrapper">

            <!-- Map Locations -->
            <div class="locmaps">

                <div class="locmap">
                    <img src="/assets/frontend/CORE Real Estate_files/flatiron_map.png" alt="">
                    <p></p><p><strong>HEADQUARTERS</strong><br>
                     {{ getWebsiteInfo()->location }}<br>
                    <a href="tel:212-419-8580" target="_blank" rel="noopener noreferrer">{{ getWebsiteInfo()->phone }}</a></p>
                    <p></p>
                </div>


            </div>

            <div class="footer-extras">

                <!-- Back to Top -->
                <div class="btt">
                    <a href="https://corenyc.com/#" target="_self">
                        <svg width="19px" height="10px" viewBox="0 0 19 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="APPROVED-PAGES" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="19-Homepage---7-(option2)-Locations" transform="translate(-791.000000, -977.000000)" fill="#D8D8D8">
                                    <polygon id="Rectangle-23" transform="translate(800.428932, 986.428932) rotate(-135.000000) translate(-800.428932, -986.428932) " points="807.096194 979.76167 807.096194 993.096194 793.76167 993.096194"></polygon>
                                </g>
                            </g>
                        </svg><br>
                        Back To Top </a>
                </div>

                <!-- Disclaimer -->
                <div class="disclaimer">
                    <p class="text-center w-75 m-auto"><a href="https://corenyc.com/1228857-2/" target="_self">STANDARDIZED OPERATING PROCEDURE FOR PURCHASERS OF REAL ESTATE </a><br>
                        Disclaimer: {{  getWebsiteInfo()->disclaimer  }}
                    </p>
                </div>

            </div><!-- ./footer-extras -->

        </div><!-- ./map-wrapper -->

        <!-- Footer Bar -->
        <div class="footer-bar-home">

            <div class="footer-bar-wrapper">

                <!-- Footer Icon Links -->
                <div class="footicons">
                    <a  href="http://www.leveragere.com/" target="_blank">
                        <img style="height:34px; width:34px;" src="{{ getWebsiteInfo()->logo }}">
                    </a>
                    <a href="http://pledge1percent.org/" target="_blank">
                        <img style="height:34px; width:34px;" src="{{ getWebsiteInfo()->logo }}">
                    </a>
                </div>

                <!-- Footer Nav -->
                <nav class="footer-link-contain">
                    <span class="houseicon">
                        <i class="fa fa-house"></i>
                    </span>
                    <ul id="menu-footer-links" class="footer-links"><li id="menu-item-29317" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29317"><a href="" target="_self">Disclaimer</a></li>
                        <li id="menu-item-27192" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-27192"><a href="https://corenyc.com/sitemap.xml" target="_self">Sitemap</a></li>
                    </ul>                <span class="copy">© {{ getWebsiteInfo()->copyright }}</span>
                </nav>

                <!-- Social Links -->
                <div class="social">
                    <ul>
                        <li><a href="{{ getWebsiteInfo()->linkedin }}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getWebsiteInfo()->instagram }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getWebsiteInfo()->copyright }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getWebsiteInfo()->twitter }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div><!-- ./footer-bar-wrapper -->
        </div><!-- ./footer-bar-home -->
    </footer>
</div>

