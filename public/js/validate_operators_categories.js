// Funzione per rimuovere i messaggi di errore
function removeErrorMessages(input) {
    const errorMessage = input.nextElementSibling;
    if (errorMessage && errorMessage.classList.contains('alert')) {
        errorMessage.remove();
    }
}

// Funzione per mostrare i messaggi di errore
function showError(input, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-danger';
    errorDiv.innerText = message;
    input.parentNode.insertBefore(errorDiv, input.nextSibling);
}

// Validazione del nome dell'autore
const nameInput = document.getElementById('name');
const submitButton = document.getElementById('submit');

nameInput.addEventListener('input', (e) => {
    const inputValue = e.target.value.trim().replace(/\s+/g, ' '); // Rimuove spazi extra
    removeErrorMessages(nameInput);

    const minLength = 4;
    const maxLength = 255; // Limite massimo per il nome dell'autore
    const validCharacters = /^[\p{L}\p{N}()… :,.\-\/"'’‘“”«»!?]*$/u;

    let isValid = true; // Variabile per tenere traccia della validità

    if (inputValue.length < minLength) {
        showError(nameInput, `Il nome deve avere almeno ${minLength} caratteri.`);
        isValid = false; // Non valido
    } else if (inputValue.length > maxLength) {
        showError(nameInput, `Il nome deve avere non più di ${maxLength} caratteri.`);
        isValid = false; // Non valido
    } else if (!validCharacters.test(inputValue)) {
        showError(nameInput, 'Il nome contiene caratteri non validi.');
        isValid = false; // Non valido
    } else {
        removeErrorMessages(nameInput); // Rimuove eventuali messaggi di errore
    }

    // Abilita o disabilita il pulsante di invio in base alla validità
    submitButton.disabled = !isValid;
});
