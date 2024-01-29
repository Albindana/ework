document.addEventListener("DOMContentLoaded", function () {
    function toggleDayNight() {
        var button1 = document.querySelector('.dnDiv .dayNightBtn:first-child');
        var button2 = document.querySelector('.dnDiv .dayNightBtn:last-child');

        button1.style.display = button1.style.display === 'none' ? 'block' : 'none';
        button2.style.display = button2.style.display === 'none' ? 'block' : 'none';

        var isNightMode = button2.style.display === 'block';

        applyStyling(isNightMode);

        sessionStorage.setItem('nightMode', isNightMode);
    }
    function applyStyling(isNightMode) {
        if (isNightMode) {
            document.body.style.backgroundColor = '#1a1a1a';

            var paragraphs = document.querySelectorAll('p');
            paragraphs.forEach(function (paragraph) {
                paragraph.style.color = '#fff';
            });

            var currentElements = document.querySelectorAll('.current');
            currentElements.forEach(function (currentElement) {
                currentElement.style.color = '#003f06';
            });

            var jobCardElements = document.querySelectorAll('.job-card');
            jobCardElements.forEach(function (jobCardElement) {
                jobCardElement.style.backgroundColor = 'transparent'; 
            });

            var searchTermElements = document.querySelectorAll('.searchTerm');
            searchTermElements.forEach(function (searchTermElement) {
                searchTermElement.style.backgroundColor = 'transparent';
            });

            var searchButtonElements = document.querySelectorAll('.searchButton');
            searchButtonElements.forEach(function (searchButtonElement) {
                searchButtonElement.style.backgroundColor = 'transparent';
            });

            var headerLoginAElements = document.querySelectorAll('.header-login-a');
            headerLoginAElements.forEach(function (headerLoginAElement) {
                headerLoginAElement.style.color = '#000'; 
                headerLoginAElement.addEventListener('mouseover', function () {
                    headerLoginAElement.style.color = '#18BA27';
                });
                headerLoginAElement.addEventListener('mouseout', function () {
                    headerLoginAElement.style.color = '#000'; 
                });
            });
        } else {
            document.body.style.backgroundColor = '';

            var paragraphs = document.querySelectorAll('p');
            paragraphs.forEach(function (paragraph) {
                paragraph.style.color = '';
            });

            var currentElements = document.querySelectorAll('.current');
            currentElements.forEach(function (currentElement) {
                currentElement.style.color = '';
            });

            var jobCardElements = document.querySelectorAll('.job-card');
            jobCardElements.forEach(function (jobCardElement) {
                jobCardElement.style.backgroundColor = ''; 
            });

            var searchTermElements = document.querySelectorAll('.searchTerm');
            searchTermElements.forEach(function (searchTermElement) {
                searchTermElement.style.backgroundColor = ''; 
            });


            var searchButtonElements = document.querySelectorAll('.searchButton');
            searchButtonElements.forEach(function (searchButtonElement) {
                searchButtonElement.style.backgroundColor = ''; 
            });

            var headerLoginAElements = document.querySelectorAll('.header-login-a');
            headerLoginAElements.forEach(function (headerLoginAElement) {
                headerLoginAElement.style.color = ''; 
            });
        }
    }

    var initialNightMode = sessionStorage.getItem('nightMode') === 'true';
    applyStyling(initialNightMode);

    var buttons = document.querySelectorAll('.dnDiv .dayNightBtn');
    buttons.forEach(function (button) {
        button.addEventListener('click', toggleDayNight);
    });
});