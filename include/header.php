


   <header id="header" class="px-1">
        <div class="p-2 bg-white rounded-pill">
            <img id="logo" src="./assets/img/name-logo 2.png" alt="OHF logo" class="logo">
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center w-75">
            <ul id="nav-ul">
            <li class="nav-list"><a href="./index.php" onclick="trackClick('home', 'index.php')">Home</a></li>
            <li class="nav-list"><a href="./what-we-do.php" onclick="trackClick('what we do', 'what-we-do.php')">Our Work</a></li>
            <li class="nav-list"><a href="./about.php" onclick="trackClick('about', 'about.php')">About</a></li>
            <li class="nav-list"><a href="./contact.php" onclick="trackClick('contact', 'contact.php')">Contact</a></li>

            <!-- GET INVOLVED Dropdown -->
            <li class="menu-item-has-children">
                <a href="#" id="getInvolvedToggle" class="text-white">Get Involved <i class="fa fa-caret-down"></i></a>
                <ul class="sub-menu" id="getInvolvedDropdown">
                <li><a href="donation.php" onclick="trackClick('donate', 'donation.php')">Donate</a></li>
                <li><a href="volunteer.php" onclick="trackClick('volunteer', 'volunteer.php')">Volunteer</a></li>
                <li><a href="partnership.php" onclick="trackClick('partner', 'partnership.php')">Partner</a></li>
                </ul>
            </li>
            </ul>

            <!-- Sticky CTA Buttons -->
            <div class="cta-buttons d-flex gap-2">
            <a href="donation.php#donatenow" onclick="trackClick('donate', 'donation.php')" class="btn-donate getInvolvedBtn">Donate</a>
            <a href="volunteer.php" onclick="trackClick('volunteer', 'volunteer.php')" class="btn-volunteer getInvolvedBtn">Volunteer</a>
            </div>
        </div>

        <img id="menu-icon" src="./assets/img/icons/menu-icon.png" alt="Menu Icon">
        <i class="fa fa-times" id="close-icon"></i>
    </header>

    <div id="top-mobile-bar">
        <img id="logo2" src="./assets/img/name-logo.svg" alt="OHF logo" class="logo">
        <button type="button" id="menu-icon2" class="th-menu-toggle d-lg-none">
            <i class="fas fa-bars" style="color: var(--theme-color);"></i>
        </button>
    </div>
    <nav id="mobile-menu">
        <img src="assets/img/logo 24b 1.png" alt="OHF Logo">

        <ul id="mobile-nav-ul">
            <li class="nav-list"><a href="./index.php" >Home</a></li>
            <li class="nav-list"><a href="./about.php" >About Us</a></li>
            <li class="nav-list"><a href="./what-we-do.php">Our Work</a></li>
            <!-- <li class="nav-list"><a href="./events.php" >Events</a></li>
            <li class="nav-list"><a href="./blog.php" >Blogs</a></li> -->
            <li class="nav-list"><a href="./contact.php" >Contact Us</a></li>

            <li class="nav-list" id="getInvolvedItem">
            <a href="javascript:void(0)" id="toggleGetInvolved">
                    Get Involved <i class="fa fa-caret-down" aria-hidden="true"></i>
                </a>
                <ul class="dropdown-content" id="getInvolvedDropdownMobile">
                    <li><a href="donation.php" >Donations</a></li>
                    <li><a href="community-member.php" >Community Members</a></li>
                    <li><a href="partnership.php" >Partners</a></li>
                    <li><a href="volunteer.php" >Volunteer</a></li>
                </ul>
            </li>
           
             <li class="nav-list btn-donate getInvolvedBtn"><a href="./donation.php#donatenow" >Donate</a></li>
            <li class="nav-list btn-volunteer getInvolvedBtn"><a href="./volunteer.php" >Volunteer</a></li>
        </ul>

        <i class="fa fa-times" id="mobile-menu-close"></i>
    </nav>

    <!-- modal -->
    <div class="modal" id="modal">
        <div class="modal-content" id="modalContent">
            <div id="formContainer">
            </div>
        </div>
    </div>


    <button id="scrollToTopBtn" title="Go to top">&#8679;</button>