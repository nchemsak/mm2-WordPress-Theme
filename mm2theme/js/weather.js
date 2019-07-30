"use strict";
$(document).ready(function() {
    const loc = document.getElementById("location");
    const temNum = document.getElementById("temperature-num");
    const temScale = document.getElementById("temperature-scale");
    const weatherCon = document.getElementById("weather-condition");

    var newDate = new Date();
    var hour24 = newDate.getHours();

    // console.log(hour24);


    // get location
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                getWeather(position.coords.latitude, position.coords.longitude);
            });
        } else {
            loc.innerHTML = "Geolocation is not supported by this browser.";
        }
    }


    // get weather data according to the location
    function getWeather(lat, long) {
        const root = "https://fcc-weather-api.glitch.me/api/current?";
        fetch(`${root}lat=${lat}&lon=${long}`, { method: "get" })
            .then(resp => resp.json())
            .then(data => {
                updateDataToUI(data.name, data.weather, data.main.temp);
            })
            .catch(function(err) {
                console.error(err);
            });
    }

    // update the data from API to DOM
    function updateDataToUI(location, weather, temp) {
        var weatherCondition = displayWeatherOverlay(weather[0].main)
        weatherCon.innerHTML = weather[0].main;
        loc.innerHTML = location;
        temNum.innerHTML = `${temp}`;

        if (temScale.innerHTML === "C") {
            temNum.innerHTML = cToF(temNum.innerHTML).toFixed(2);
            temScale.innerHTML = "F";
        } else if (temScale.innerHTML === 'F') {
            temNum.innerHTML = fToC(temNum.innerHTML).toFixed(2);
            temScale.innerHTML = "C";
        }
    }


    function displayWeatherOverlay(x) {

        if (x == "Clouds" && (hour24 < 18 && hour24 > 6)) {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay moon" src="images/moon.gif" alt="moon" />');
            $('.header-image, .eagle-eye').append('<img class="weather-overlay clouds" src="images/clouds.gif" alt="clouds"/> <img class="weather-overlay clouds2" src="images/clouds.gif" alt="clouds" /> <img class="weather-overlay clouds3" src="images/clouds.gif" alt="clouds" /><img class="weather-overlay clouds4" src="images/clouds.gif" alt="clouds" />');
        } else if (x == "Clouds") {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay clouds" src="images/clouds.gif" alt="clouds"/> <img class="weather-overlay clouds2" src="images/clouds.gif" alt="clouds" /> <img class="weather-overlay clouds3" src="images/clouds.gif" alt="clouds" /><img class="weather-overlay clouds4" src="images/clouds.gif" alt="clouds" />');
        } else if (x == "Rain") {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay" src="images/icons/rain.gif" alt="rain" />');
        } else if (x == "Snow") {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay" src="images/icons/salt.gif" alt="snow" />');
        } else if (x == "Clear" && (hour24 < 18 && hour24 > 6)) {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay sun" src="images/sun.gif" alt="sun" />');
        } else if (x == "Clear") {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay moon" src="images/moon.gif" alt="moon" />');

        } else if (x == "Haze") {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay haze" src="images/fog01.png" alt="haze" />');

        } else if (x == "Mist") {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay haze" src="images/fog01.png" alt="mist" />');

        } else if (x == "Thunderstorm") {
            $('.header-image, .eagle-eye').append('<img class="weather-overlay" src="images/icons/rain.gif" alt="rain" />');
            $('body').addClass('lightning');
            $('.weather-overlay').addClass('lightning2');
        }
    }



    // helper function change from C to F
    function cToF(celsius) {
        return celsius * 9 / 5 + 32;
    }


    window.onload = function() {
        getLocation();
    };

});