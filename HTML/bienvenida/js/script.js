const messages = {
    es: {
        header: "Letras Interconectadas",
        subheader: "Por favor escoja su idioma",
        welcome: "Bienvenidos"
    },
    otomi: {
        header: "Ngi mbe̱ ga xtsʼo ngi mbe̱ ga xi",
        subheader: "Ntsi̱ thi nghi xi̱ da btsi̱ da da",
        welcome: "Ngi mbe̱ ga xi̱"
    },
    nahuatl: {
        header: "Tlahtōlli Miktlanēj",
        subheader: "Tlāhcuīcāyōtl ieh huān kēh mētztli",
        welcome: "Tlāhcuīcāyōtl"
    }
};

let currentLanguage = "es";
let headerElement = document.getElementById("header");
let subheaderElement = document.getElementById("subheader");
let welcomeElement = document.getElementById("welcomeMessage");

function changeLanguage(language) {
    currentLanguage = language;
    headerElement.style.opacity = 0;
    subheaderElement.style.opacity = 0;
    welcomeElement.style.opacity = 0;

    setTimeout(() => {
        headerElement.textContent = messages[currentLanguage].header;
        subheaderElement.textContent = messages[currentLanguage].subheader;
        welcomeElement.textContent = messages[currentLanguage].welcome;
        headerElement.style.opacity = 1;
        subheaderElement.style.opacity = 1;
        welcomeElement.style.opacity = 1;
    }, 500);
}

function rotateLanguage() {
    if (currentLanguage === "es") {
        changeLanguage("otomi");
    } else if (currentLanguage === "otomi") {
        changeLanguage("nahuatl");
    } else {
        changeLanguage("es");
    }

    setTimeout(rotateLanguage, 5000); // Cambiar cada 5 segundos
}

rotateLanguage();

document.getElementById("greenButton").addEventListener("click", function() {
    changeLanguage("otomi");
});

document.getElementById("whiteButton").addEventListener("click", function() {
    changeLanguage("es");
});

document.getElementById("redButton").addEventListener("click", function() {
    changeLanguage("nahuatl");
});