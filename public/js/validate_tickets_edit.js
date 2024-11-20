// Seleziona il pulsante di invio
const submitButton = document.getElementById('submit');

// Funzione per rimuovere errori esistenti
const removeErrorMessages = (input) => {
    const errorMessages = input.parentNode.querySelectorAll('.alert.alert-danger');
    errorMessages.forEach((error) => error.remove());
};

// Funzione per mostrare errori
const showError = (input, message) => {
    const errorMessage = document.createElement('div');
    errorMessage.className = 'alert alert-danger';
    errorMessage.textContent = message;
    input.parentNode.appendChild(errorMessage);
    submitButton.disabled = true; // Disabilita il bottone
};

// Validazione del prezzo
const priceInput = document.getElementById('price');
priceInput.addEventListener('input', (e) => {
    const priceValue = parseFloat(e.target.value);
    removeErrorMessages(priceInput);

    if (isNaN(priceValue) || priceValue <= 0) {
        showError(priceInput, 'Il prezzo deve essere un numero positivo.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// Validazione dell'immagine
const fileInput = document.getElementById('cover_image');
fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    removeErrorMessages(fileInput);

    if (file && !['image/png', 'image/jpeg', 'image/gif'].includes(file.type)) {
        showError(fileInput, 'Il file selezionato non è un\'immagine valida. Sono accettati solo file .png, .jpg e .gif.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// Validazione del titolo
const nameInput = document.getElementById('title');
nameInput.addEventListener('input', (e) => {
    const inputValue = e.target.value.trim().replace(/\s+/g, ' '); // Rimuove spazi extra
    removeErrorMessages(nameInput);

    const minLength = 4;
    const maxLength = 500; // Puoi aumentare il limite massimo se necessario
    const validCharacters = /^[\p{L}\p{N}()… :,.\-\/"'’‘“”«»!?]*$/u;

    if (inputValue.length < minLength) {
        showError(nameInput, `Il testo deve avere almeno ${minLength} caratteri.`);
    } else if (inputValue.length > maxLength) {
        showError(nameInput, `Il testo deve avere non più di ${maxLength} caratteri.`);
    } else if (!validCharacters.test(inputValue)) {
        showError(nameInput, 'Il testo contiene caratteri non validi.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// Validazione della descrizione
const inputField = document.getElementById('description');
inputField.addEventListener('input', (e) => {
    // Rimuovi spazi extra e spazi iniziali/finali
    const inputValue = e.target.value.trim().replace(/\s+/g, ' ');
    removeErrorMessages(inputField);

    const minLength = 4;
    const maxLength = 1500;
    const validCharacters = /^[\p{L}\p{N}(): …,.\-\/"'’‘“”«»!?]*$/u;

    if (inputValue.length < minLength) {
        showError(inputField, `Errore: Inserisci almeno ${minLength} caratteri.`);
    } else if (inputValue.length > maxLength) {
        showError(inputField, `Errore: Inserisci non più di ${maxLength} caratteri.`);
    } else if (!validCharacters.test(inputValue)) {
        showError(inputField, 'La descrizione può contenere solo lettere, numeri e i seguenti caratteri speciali: (),.-/"\'!?');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// Validazione del campo in progress
const inProgressInput = document.getElementById('in_progress');
inProgressInput.addEventListener('change', () => {
    removeErrorMessages(inProgressInput);
    validateAllFields(); // Verifica tutti i campi
});

// Validazione degli ID (author_id, category_id, editor_id)
const authorIdInput = document.getElementById('author_id');
const categoryIdInput = document.getElementById('category_id');
const editorIdInput = document.getElementById('editor_id');

const validateSelect = (selectInput) => {
    const selectedValue = selectInput.value;
    removeErrorMessages(selectInput);

    if (selectedValue === '') {
        showError(selectInput, 'Seleziona un valore valido.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
};

authorIdInput.addEventListener('change', () => validateSelect(authorIdInput));
categoryIdInput.addEventListener('change', () => validateSelect(categoryIdInput));
editorIdInput.addEventListener('change', () => validateSelect(editorIdInput));

// Validazione dell'anno
const yearInput = document.getElementById('year');
yearInput.addEventListener('input', (e) => {
    const yearValue = parseInt(e.target.value, 10);
    removeErrorMessages(yearInput);

    if (yearValue < 1900 || yearValue > 2100) {
        showError(yearInput, 'L\'anno deve essere compreso tra 1900 e 2100.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// Validazione del volume
const volumeInput = document.getElementById('volume');
volumeInput.addEventListener('input', (e) => {
    const volumeValue = parseInt(e.target.value, 10);
    removeErrorMessages(volumeInput);

    if (volumeValue < 1) {
        showError(volumeInput, 'Il volume deve essere un numero positivo.');
    } else {
        validateAllFields(); // Verifica tutti i campi
    }
});

// Validazione dei generi
const genreCheckboxes = document.querySelectorAll('input[name="genres[]"]');

const validateGenres = () => {
    removeErrorMessages(genreCheckboxes[0]); // Rimuove errori da un checkbox (primo)

    const isChecked = Array.from(genreCheckboxes).some(checkbox => checkbox.checked);
    submitButton.disabled = !isChecked; // Abilita o disabilita il pulsante in base alla selezione
};

// Aggiungi l'evento change a tutti i checkbox dei generi
genreCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', validateGenres);
});

// Esegui la validazione all'avvio per impostare lo stato iniziale
submitButton.disabled = true; // Disabilita il pulsante di invio all'inizio
validateGenres(); // Imposta lo stato iniziale del pulsante

// Prevenzione della sottomissione del form
submitButton.addEventListener('click', (e) => {
    if (submitButton.disabled) {
        e.preventDefault(); // Previene la sottomissione del form
    }
});

// Funzione per validare tutti i campi
const validateAllFields = () => {
    const allFieldsValid = [...genreCheckboxes].some(checkbox => checkbox.checked) &&
        priceInput.value > 0 &&
        (fileInput.files.length > 0 || !fileInput.value) && // Permette di non caricare un'immagine
        nameInput.value.length >= 4 &&
        nameInput.value.length <= 50 &&
        inputField.value.length >= 4 &&
        inputField.value.length <= 1500 &&
        authorIdInput.value !== '' &&
        categoryIdInput.value !== '' &&
        editorIdInput.value !== '' &&
        yearInput.value >= 1900 &&
        yearInput.value <= 2100 &&
        volumeInput.value >= 1;

    submitButton.disabled = !allFieldsValid; // Abilita o disabilita il pulsante in base alla validità di tutti i campi
};
