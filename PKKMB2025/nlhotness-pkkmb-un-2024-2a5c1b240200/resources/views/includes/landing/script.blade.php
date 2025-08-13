<script>
    let planet = document.getElementById('planet');
    let planett = document.getElementById('planett');
    let bintang = document.getElementById('bintang');
    let title1 = document.getElementById('title1');
    let title2 = document.getElementById('title2');
    let text1 = document.getElementById('text1');
    let text2 = document.getElementById('text2');

    window.addEventListener('scroll', function(){
        let value = window.scrollY;
        planet.style.top = value * 1.25 + 'px';
    })
</script>

{{-- Hamburger --}}
<script>
    const hamburger = document.querySelector('#hamburger');
    const navMenu = document.querySelector('#nav-menu');

    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('hamburger-active');
        navMenu.classList.toggle('hidden');
    });

    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

{{-- Table Content --}}
<script>
    function openCity(evt, cityName) {
    
        var i, tabcontent, tablinks;

        //Memanggil Semua Element class tabcontent
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        //Memanggi Semua Element class "tablinks" dan remove class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";

    }

    // Default Open
    document.getElementById("defaultOpen").click();
</script>

{{-- LottieFiles --}}
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>