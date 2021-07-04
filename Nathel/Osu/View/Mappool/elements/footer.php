</main>
<script>

    document.addEventListener('DOMContentLoaded', function (){

        let dropdown = document.getElementById("dropdown-menu");

    })

    function dropdownMenu() {

        let header = document.getElementById("mobile-menu");
        let dropdown = document.getElementById("dropdown-menu");

        header.classList.toggle('opened');header.classList.contains('opened')
        dropdown.classList.toggle('d-lg-none');header.classList.contains('opened')
        }

    }

</script>
</body>
</html>