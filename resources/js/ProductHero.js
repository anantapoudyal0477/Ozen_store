        document.getElementById('scrollButton').addEventListener('click', function (e) {
            e.preventDefault(); // prevent default jump
            document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
        });
