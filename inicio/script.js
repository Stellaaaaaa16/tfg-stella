<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector('.navbar-toggler').addEventListener('click', function () {
                document.querySelector('.navbar-collapse').classList.toggle('show');
            });

            document.querySelectorAll('.navbar-nav .nav-item .nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    document.querySelector('.navbar-collapse').classList.remove('show');
                });
            });

            var servicesDropdown = document.getElementById('servicesDropdown');
            var dropdownMenu = servicesDropdown.querySelector('.dropdown-menu');

            servicesDropdown.querySelector('.nav-link').addEventListener('click', function (event) {
                event.preventDefault(); 
                dropdownMenu.classList.toggle('show');
            });

          
            document.addEventListener('click', function (event) {
                if (!servicesDropdown.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });

        
            var btnScrollTop = document.getElementById("btn-scroll-top");

        
            window.addEventListener("scroll", function () {
                if (window.pageYOffset > 100) { 
                    btnScrollTop.style.display = "block";
                } else {
                    btnScrollTop.style.display = "none";
                }
            });

          
            btnScrollTop.addEventListener("click", function () {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth" 
                });
            });
        });

    </script>