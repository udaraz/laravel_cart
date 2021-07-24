<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-column">
                <br><br><br><br><br><br><br><br><br>
            </div>
            <div class="col-md-4 footer-column">
                <h6><x-translate text="Legal"/></h6>
                <ul>
                    <li><a href=""><x-translate text="Privacy policy"/></a></li>
                </ul>

                <h6><x-translate text="Help"/></h6>
                <ul>
                    <li><a href=""><x-translate text="Contact"/></a></li>
                </ul>
            </div>
            <div class="col-md-4 footer-column">
                <h6><x-translate text="Social Media"/></h6>
                <li class="nav-item nav-social nav-social-footer">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-linkedin"></a>
                    <a href="#" class="fa fa-youtube"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-pinterest"></a>
                </li>

            </div>
        </div>
    </div>
    <div class="container-fluid footer-copyright">
        <div class="row">
            <div class="col-md-12">
                <p><x-translate text="Copyright"/> &copy;<x-translate text="ABC Cart All rights reserved."/> </p>
            </div>
        </div>
    </div>
</footer>
<script src={{asset('assets/js/core/jquery.min.js')}}></script>
<script src={{asset('assets/js/core/bootstrap.min.js')}}></script>

@stack('custom-scripts')
</body>
</html>
