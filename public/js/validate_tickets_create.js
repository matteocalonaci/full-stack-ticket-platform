// Seleziona il pulsante di invio
const submitButton = document.getElementById('submit');

// ---------------------------------------------
// FUNZIONE PER RIMUOVERE ERRORI ESISTENTI
const removeErrorMessages = (input) => {
    const errorMessages = input.parentNode.querySelectorAll('.alert.alert-danger');
    errorMessages.forEach((error) => error.remove());
};

// ---------------------------------------------
// FUNZIONE PER MOSTRARE ERRORI
const showError = (input, message) => {
    const errorMessage = document.createElement('div');
    errorMessage.className = 'alert alert-danger';
    errorMessage.textContent = message;
    input.parentNode.appendChild(errorMessage);
    submitButton.disabled = true; // Disabilita il bottone
};

// ---------------------------------------------
// VALIDAZIONE DEL TITOLO
const nameInput = document.getElementById('title');
nameInput.addEventListener('input', (e) => {
    const inputValue = e.target.value.trim().replace(/\s+/g, ' '); // Rimuove spazi extra
    removeErrorMessages(nameInput);

    const minLength = 4;
    const maxLength = 500; // Puoi aumentare il limite massimo se necessario
    const validCharacters = /^[\p{L}\p{N}():… ,.\-\/"'’‘“”«»!?]*$/u;

    if (inputValue.length < minLength) {
        showError(nameInput, `Il titolo deve avere almeno ${minLength} caratteri.`);
    } else if (inputValue.length > maxLength) {
        showError(nameInput, `Il titolo deve avere non più di ${maxLength} caratteri.`);
    } else if (!validCharacters.test(inputValue)) {
        showError(nameInput, 'Il titolo contiene caratteri non validi.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// ---------------------------------------------
// VALIDAZIONE DELLA DESCRIZIONE
const descriptionInput = document.getElementById('description');
descriptionInput.addEventListener('input', (e) => {
    const inputValue = e.target.value.trim().replace(/\s+/g, ' ');
    removeErrorMessages(descriptionInput);

    const minLength = 4;
    const maxLength = 1500;
    const validCharacters = /^[\p{L}\p{N}():… ,.\-\/"'’‘“”«»!?]*$/u;

    if (inputValue.length < minLength) {
        showError(descriptionInput, `La descrizione deve avere almeno ${minLength} caratteri.`);
    } else if (inputValue.length > maxLength) {
        showError(descriptionInput, `La descrizione deve avere non più di ${maxLength} caratteri.`);
    } else if (!validCharacters.test(inputValue)) {
        showError(descriptionInput, 'La descrizione può contenere solo lettere, numeri e i seguenti caratteri speciali: (),.-/"\'!?');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// ---------------------------------------------
// VALIDAZIONE DELLA DATA
const dateInput = document.getElementById('date');
dateInput.addEventListener('input', (e) => {
    const selectedDate = new Date(e.target.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Imposta l'ora a mezzanotte per il confronto
    removeErrorMessages(dateInput);

    if (isNaN(selectedDate.getTime())) {
        showError(dateInput, 'Per favore, inserisci una data valida.');
    } else if (selectedDate < today) {
        showError(dateInput, 'La data deve essere oggi o una data futura.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// ---------------------------------------------
// VALIDAZIONE DEGLI ID (operator_id, category_id)
const operatorIdInput = document.getElementById('operator_id');
const categoryIdInput = document.getElementById('category_id');

const validateSelect = (selectInput) => {
    const selectedValue = selectInput.value;
    removeErrorMessages(selectInput);

    if (selectedValue === '') {
        showError(selectInput, 'Seleziona un valore valido.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
};

operatorIdInput.addEventListener('change', () => validateSelect(operatorIdInput));
categoryIdInput.addEventListener('change', () => validateSelect(categoryIdInput));

// ---------------------------------------------
// FUNZIONE PER VALIDARE TUTTI I CAMPI
const validateAllFields = () => {
    const allFieldsValid =
        nameInput.value.length >= 4 &&
        descriptionInput.value.length >= 4 &&
        dateInput.value !== '' &&
        operatorIdInput.value !== '' &&
        categoryIdInput.value !== '';

    submitButton.disabled = !allFieldsValid; // Abilita o disabilita il pulsante in base alla validità di tutti i campi
};

// ---------------------------------------------
// PREVENZIONE DELLA SOTTOMISSIONE DEL FORM
submitButton.addEventListener('click', (e) => {
    if (submitButton.disabled) {
        e.preventDefault(); // Previene la sottomissione del form
    }
});

// Esegui la validazione all'avvio per impostare lo stato iniziale
submitButton.disabled = true; // Disabilita il pulsante di invio all'inizio
validateAllFields(); // Imposta lo stato iniziale del pulsante
