function validerFormulaire() {
   
    title = document.getElementById('title').value;
   destination = document.getElementById('destination').value;
    departure = document.getElementById('departure').value;
    returnDate = document.getElementById('return').value;
    price = document.getElementById('price').value;

   
    if (title.length < 3) {
        alert("Le titre doit contenir au moins 3 caractères.");
       
    }

    destinationRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
    if (destination.length < 3 || !destinationRegex.test(destination)) {
        alert("La destination doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.");
        
    }

    if (departure === "" || returnDate === "") {
        alert("Veuillez sélectionner les dates de départ et de retour.");
       
    }

    if (departure >= returnDate) {
        alert("La date de retour doit être ultérieure à la date de départ.");
        
    }
    if (price === "" || isNaN(price) || price <= 0) {
        alert("Le prix doit être un nombre positif.");
        
    }

}
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.getElementById('addOfferButton'); 

    addButton.addEventListener('click', function(event) {
        event.preventDefault();  
        const title = document.getElementById('title').value;
        const resulttitle = document.getElementById('titlecondition');
        const destination = document.getElementById('destination').value;
        const resuldestination = document.getElementById('destinationcondition');
        const departure = document.getElementById('departure').value;
        const resultdeparture = document.getElementById('departureCondition');
        const returnDate = document.getElementById('return').value;
        const resultreturn = document.getElementById('returnCondition');
        const price = document.getElementById('price').value;
        const resultprice = document.getElementById('priceCondition');

       
        if (title.length < 3) {
            resulttitle.innerHTML = "Le titre doit contenir au moins 3 caractères.";
            resulttitle.style.color = "red";  
        } else {
            resulttitle.innerHTML = "correct";
            resulttitle.style.color = "green";  
        }

        
        const destinationRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
        if (destination.length < 3 || !destinationRegex.test(destination)) {
            resuldestination.innerHTML = "La destination doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.";
            resuldestination.style.color = "red";  
        } else {
            resuldestination.innerHTML = "correct";
            resuldestination.style.color = "green";  
        }

        
        if (departure === "") {
            resultdeparture.innerHTML = "Veuillez sélectionner une date valide.";
            resultdeparture.style.color = "red";  
        } else {
            resultdeparture.innerHTML = "correct";
            resultdeparture.style.color = "green";  
        }

        if (returnDate ==="") {
            resultreturn.innerHTML = "Veuillez sélectionner une date valide.";
            resultreturn.style.color = "red";  
        } else {
            resultreturn.innerHTML = "correct";
            resultreturn.style.color = "green";  
        }

        
        if (price === "" || isNaN(price) || price <= 0) {
            resultprice.innerHTML = "Le prix doit être un nombre positif.";
            resultprice.style.color = "red";  
        } else {
            resultprice.innerHTML = "correct";
            resultprice.style.color = "green";  
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const resultTitle = document.getElementById('titlecondition');
    const destinationInput = document.getElementById('destination');
    const resuldestination = document.getElementById('destinationcondition');
    titleInput.addEventListener('keyup', function() {
        const title = titleInput.value; 

        if (title.length < 3) {
            resultTitle.innerHTML = "Le titre doit contenir au moins 3 caractères.";
            resultTitle.style.color = "red";  
        } else {
            resultTitle.innerHTML = "Correct";
            resultTitle.style.color = "green";  
        }
    });
    destinationInput.addEventListener('keyup', function() {
        const destination = destinationInput.value; 

        const destinationRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
        if (destination.length < 3 || !destinationRegex.test(destination)) {
            resuldestination.innerHTML = "La destination doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.";
            resuldestination.style.color = "red";  
        } else {
            resuldestination.innerHTML = "correct";
            resuldestination.style.color = "green";  
        }
    });
});
