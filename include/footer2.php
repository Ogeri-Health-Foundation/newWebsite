<footer>
    <div id="footer-container">
        <div class="footer">
            <h2 class="f-h2">LiFi Infinity Limited</h2>
            <p class="f-p">Experience ultra-fast, secure, and interference-free wirelesscommunication powered by LiFi technology.</p>
        </div>
        <div class="footer" id="f-contacts">
            <h2 class="f-h2">Contacts</h2>
            <ul id="f-ul">
                <li class="f-li">Pippins, Cherry Drive, Forty Green, Beaconsfield, Buckinghamshire. HP9 1XP</li>
                <li class="f-li"><a href="mailto:contact@lifitn.com">contact@lifitn.com</a></li>
                <li class="f-li"><a href="tel:+1800854-36-80">+1 800 854-36-80</a></li>
            </ul>
            <div id="social-media">
                <img src="./assets/icons/facebook.svg" alt="facebook icon" />
                <img src="./assets/icons/instagram.svg" alt="instagram icon" />
                <img src="./assets/icons/twitter.svg" alt="twitter icon" />
            </div>
        </div>
        <div class="footer">
            <form method="POST" action="./database/contactController.php">
                <h2 class="f-h2">Contact Us</h2>
                <p><input name="full_name" type="text" class="f-input" placeholder="First and Last Names" required></p>
                <p><input name="email" type="text" class="f-input" placeholder="Email Address" required></p>
                <p><input name="phone" type="text" class="f-input" placeholder="Phone Number" required></p>
                <p>
                    <textarea name="msg" placeholder="Message" rows="3" required></textarea>
                </p>
                <div id="f-button-div"><input type="submit" id="f-button" value="Submit"></div>
            </form>
        </div>
    </div>
</footer>
<script src="./js/main.js"></script>
<script src="./js/formsModal.js"></script>
</body>

</html>